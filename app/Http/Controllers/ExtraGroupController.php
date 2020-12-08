<?php

namespace App\Http\Controllers;

use App\DataTables\ExtraGroupDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExtraGroupRequest;
use App\Http\Requests\UpdateExtraGroupRequest;
use App\Repositories\ExtraGroupRepository;
use App\Repositories\CustomFieldRepository;

use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class ExtraGroupController extends Controller
{
    /** @var  ExtraGroupRepository */
    private $extraGroupRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    

    public function __construct(ExtraGroupRepository $extraGroupRepo, CustomFieldRepository $customFieldRepo )
    {
        parent::__construct();
        $this->extraGroupRepository = $extraGroupRepo;
        $this->customFieldRepository = $customFieldRepo;
        
    }

    /**
     * Display a listing of the ExtraGroup.
     *
     * @param ExtraGroupDataTable $extraGroupDataTable
     * @return Response
     */
    public function index(extraGroupDataTable $extraGroupDataTable)
    {
        return $extraGroupDataTable->render('extra_groups.index');
    }

    /**
     * Show the form for creating a new extraGroup.
     *
     * @return Response
     */
    public function create()
    {
        
        
        $hasCustomField = in_array($this->extraGroupRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->extraGroupRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('extra_groups.create')->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Store a newly created extraGroup in storage.
     *
     * @param CreateextraGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateExtraGroupRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->extraGroupRepository->model());
        try {
            $extraGroup = $this->extraGroupRepository->create($input);
            $extraGroup->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.extra_group')]));

        return redirect(route('extraGroups.index'));
    }

    /**
     * Display the specified ExtraGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $extraGroup = $this->extraGroupRepository->findWithoutFail($id);

        if (empty($extraGroup)) {
            Flash::error('Extra Group not found');

            return redirect(route('extraGroups.index'));
        }

        return view('extra_groups.show')->with('extraGroup', $extraGroup);
    }

    /**
     * Show the form for editing the specified ExtraGroup.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $extraGroup = $this->extraGroupRepository->findWithoutFail($id);
        
        

        if (empty($extraGroup)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.extra_group')]));

            return redirect(route('extraGroups.index'));
        }
        $customFieldsValues = $extraGroup->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->extraGroupRepository->model());
        $hasCustomField = in_array($this->extraGroupRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('extra_groups.edit')->with('extraGroup', $extraGroup)->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Update the specified ExtraGroup in storage.
     *
     * @param  int              $id
     * @param UpdateExtraGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExtraGroupRequest $request)
    {
        $extraGroup = $this->extraGroupRepository->findWithoutFail($id);

        if (empty($extraGroup)) {
            Flash::error('Extra Group not found');
            return redirect(route('extraGroups.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->extraGroupRepository->model());
        try {
            $extraGroup = $this->extraGroupRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $extraGroup->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.extra_group')]));

        return redirect(route('extraGroups.index'));
    }

    /**
     * Remove the specified ExtraGroup from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $extraGroup = $this->extraGroupRepository->findWithoutFail($id);

        if (empty($extraGroup)) {
            Flash::error('Extra Group not found');

            return redirect(route('extraGroups.index'));
        }

        $this->extraGroupRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.extra_group')]));

        return redirect(route('extraGroups.index'));
    }

        /**
     * Remove Media of ExtraGroup
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $extraGroup = $this->extraGroupRepository->findWithoutFail($input['id']);
        try {
            if($extraGroup->hasMedia($input['collection'])){
                $extraGroup->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
