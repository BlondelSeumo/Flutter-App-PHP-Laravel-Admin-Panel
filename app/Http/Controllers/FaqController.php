<?php

namespace App\Http\Controllers;

use App\DataTables\FaqDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Repositories\FaqRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\FaqCategoryRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class FaqController extends Controller
{
    /** @var  FaqRepository */
    private $faqRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var FaqCategoryRepository
  */
private $faqCategoryRepository;

    public function __construct(FaqRepository $faqRepo, CustomFieldRepository $customFieldRepo , FaqCategoryRepository $faq_categoryRepo)
    {
        parent::__construct();
        $this->faqRepository = $faqRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->faqCategoryRepository = $faq_categoryRepo;
    }

    /**
     * Display a listing of the Faq.
     *
     * @param FaqDataTable $faqDataTable
     * @return Response
     */
    public function index(FaqDataTable $faqDataTable)
    {
        return $faqDataTable->render('faqs.index');
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Response
     */
    public function create()
    {
        $faqCategory = $this->faqCategoryRepository->pluck('name','id');
        
        $hasCustomField = in_array($this->faqRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->faqRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('faqs.create')->with("customFields", isset($html) ? $html : false)->with("faqCategory",$faqCategory);
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param CreateFaqRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->faqRepository->model());
        try {
            $faq = $this->faqRepository->create($input);
            $faq->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.faq')]));

        return redirect(route('faqs.index'));
    }

    /**
     * Display the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        return view('faqs.show')->with('faq', $faq);
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);
        $faqCategory = $this->faqCategoryRepository->pluck('name','id');
        

        if (empty($faq)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.faq')]));

            return redirect(route('faqs.index'));
        }
        $customFieldsValues = $faq->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->faqRepository->model());
        $hasCustomField = in_array($this->faqRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('faqs.edit')->with('faq', $faq)->with("customFields", isset($html) ? $html : false)->with("faqCategory",$faqCategory);
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param  int              $id
     * @param UpdateFaqRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqRequest $request)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');
            return redirect(route('faqs.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->faqRepository->model());
        try {
            $faq = $this->faqRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $faq->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.faq')]));

        return redirect(route('faqs.index'));
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        $this->faqRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.faq')]));

        return redirect(route('faqs.index'));
    }

        /**
     * Remove Media of Faq
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $faq = $this->faqRepository->findWithoutFail($input['id']);
        try {
            if($faq->hasMedia($input['collection'])){
                $faq->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
