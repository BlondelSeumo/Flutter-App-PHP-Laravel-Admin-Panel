<?php

namespace App\Http\Controllers;

use App\DataTables\EarningDataTable;
use App\Http\Requests\CreateEarningRequest;
use App\Http\Requests\UpdateEarningRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\EarningRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class EarningController extends Controller
{
    /** @var  EarningRepository */
    private $earningRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var RestaurantRepository
  */
private $restaurantRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(EarningRepository $earningRepo, CustomFieldRepository $customFieldRepo , RestaurantRepository $restaurantRepo, OrderRepository $orderRepository)
    {
        parent::__construct();
        $this->earningRepository = $earningRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->restaurantRepository = $restaurantRepo;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the Earning.
     *
     * @param EarningDataTable $earningDataTable
     * @return Response
     */
    public function index(EarningDataTable $earningDataTable)
    {
        return $earningDataTable->render('earnings.index');
    }

    /**
     * Show the form for creating a new Earning.
     *
     * @return Response
     */
    public function create()
    {

        $restaurants = $this->restaurantRepository->all();
        foreach ($restaurants as $restaurant){
            $restaurantId = $restaurant->id;
            $this->earningRepository->firstOrCreate(['restaurant_id'=>$restaurantId])->first();
        }
        return redirect(route('earnings.index'));
    }

    /**
     * Store a newly created Earning in storage.
     *
     * @param CreateEarningRequest $request
     *
     * @return Response
     */
    public function store(CreateEarningRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->earningRepository->model());
        try {
            $earning = $this->earningRepository->create($input);
            $earning->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.earning')]));

        return redirect(route('earnings.index'));
    }

    /**
     * Display the specified Earning.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $earning = $this->earningRepository->findWithoutFail($id);

        if (empty($earning)) {
            Flash::error('Earning not found');

            return redirect(route('earnings.index'));
        }

        return view('earnings.show')->with('earning', $earning);
    }

    /**
     * Show the form for editing the specified Earning.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $earning = $this->earningRepository->findWithoutFail($id);
        $restaurant = $this->restaurantRepository->pluck('name','id');
        

        if (empty($earning)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.earning')]));

            return redirect(route('earnings.index'));
        }
        $customFieldsValues = $earning->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->earningRepository->model());
        $hasCustomField = in_array($this->earningRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('earnings.edit')->with('earning', $earning)->with("customFields", isset($html) ? $html : false)->with("restaurant",$restaurant);
    }

    /**
     * Update the specified Earning in storage.
     *
     * @param  int              $id
     * @param UpdateEarningRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEarningRequest $request)
    {
        $earning = $this->earningRepository->findWithoutFail($id);

        if (empty($earning)) {
            Flash::error('Earning not found');
            return redirect(route('earnings.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->earningRepository->model());
        try {
            $earning = $this->earningRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $earning->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.earning')]));

        return redirect(route('earnings.index'));
    }

    /**
     * Remove the specified Earning from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $earning = $this->earningRepository->findWithoutFail($id);

        if (empty($earning)) {
            Flash::error('Earning not found');

            return redirect(route('earnings.index'));
        }

        $this->earningRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.earning')]));

        return redirect(route('earnings.index'));
    }

        /**
     * Remove Media of Earning
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $earning = $this->earningRepository->findWithoutFail($input['id']);
        try {
            if($earning->hasMedia($input['collection'])){
                $earning->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
