<?php

namespace App\Http\Controllers;

use App\DataTables\CustomFieldDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCustomFieldRequest;
use App\Http\Requests\UpdateCustomFieldRequest;
use App\Repositories\CustomFieldRepository;

use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class CustomFieldController extends Controller
{
    /** @var  CustomFieldRepository */
    private $customFieldRepository;


    public function __construct(CustomFieldRepository $customFieldRepo)
    {
        parent::__construct();
        $this->customFieldRepository = $customFieldRepo;

    }

    /**
     * Display a listing of the CustomField.
     *
     * @param CustomFieldDataTable $customFieldDataTable
     * @return Response
     */
    public function index(CustomFieldDataTable $customFieldDataTable)
    {
        return $customFieldDataTable->render('settings.custom_fields.index');
    }

    /**
     * Show the form for creating a new CustomField.
     *
     * @return Response
     */
    public function create()
    {
        foreach (config('app_generator.fields') as $type){
            $customFieldsTypes[$type] = trans('lang.' . $type);
        }

        $customFieldModels = getModelsClasses(app_path('Models'));
        $customFieldValues = [];


        return view('settings.custom_fields.create', compact(['customFieldsTypes', 'customFieldModels', 'customFieldValues']));
    }

    /**
     * Store a newly created CustomField in storage.
     *
     * @param CreateCustomFieldRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomFieldRequest $request)
    {
        $input = $request->all();
        try {
            $customField = $this->customFieldRepository->create($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }


        Flash::success('saved successfully.');

        return redirect(route('customFields.index'));
    }

    /**
     * Display the specified CustomField.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customField = $this->customFieldRepository->findWithoutFail($id);

        if (empty($customField)) {
            Flash::error('Custom Field not found');

            return redirect(route('customFields.index'));
        }

        return view('settings.custom_fields.show')->with('customField', $customField);
    }

    /**
     * Show the form for editing the specified CustomField.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customField = $this->customFieldRepository->findWithoutFail($id);
        if (empty($customField)) {
            Flash::error('Custom Field not found');

            return redirect(route('customFields.index'));
        }

        foreach (config('app_generator.fields') as $type){
            $customFieldsTypes[$type] = trans('lang.' . $type);
        }

        $customFieldModels = getModelsClasses(app_path('Models'));
        $customFieldValues = $customField['values'] ? $customField['values'] : [];

        return view('settings.custom_fields.edit', compact(['customFieldsTypes', 'customFieldModels', 'customField', 'customFieldValues']));
    }

    /**
     * Update the specified CustomField in storage.
     *
     * @param  int $id
     * @param UpdateCustomFieldRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomFieldRequest $request)
    {
        $customField = $this->customFieldRepository->findWithoutFail($id);

        if (empty($customField)) {
            Flash::error('Custom Field not found');

            return redirect(route('customFields.index'));
        }

        $input = $request->all();
        try {
            if (!isset($input['values'])) {
                $input['values'] = null;
            }
            $customField = $this->customFieldRepository->update($input, $id);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }


        Flash::success('Custom Field updated successfully.');

        return redirect(route('customFields.index'));
    }

    /**
     * Remove the specified CustomField from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customField = $this->customFieldRepository->findWithoutFail($id);

        if (empty($customField)) {
            Flash::error('Custom Field not found');

            return redirect(route('customFields.index'));
        }

        $this->customFieldRepository->delete($id);

        Flash::success('Custom Field deleted successfully.');

        return redirect(route('customFields.index'));
    }

    /**
     * Remove Media of CustomField
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $customField = $this->customFieldRepository->findWithoutFail($input['id']);
        try {
            if ($customField->hasMedia($input['collection'])) {
                $customField->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
