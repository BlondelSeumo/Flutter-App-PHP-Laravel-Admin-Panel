<?php

namespace App\Http\Controllers;

use App\DataTables\FoodOrderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFoodOrderRequest;
use App\Http\Requests\UpdateFoodOrderRequest;
use App\Repositories\FoodOrderRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\FoodRepository;
                use App\Repositories\ExtraRepository;
                use App\Repositories\OrderRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class FoodOrderController extends Controller
{
    /** @var  FoodOrderRepository */
    private $foodOrderRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var FoodRepository
  */
private $foodRepository;/**
  * @var ExtraRepository
  */
private $extraRepository;/**
  * @var OrderRepository
  */
private $orderRepository;

    public function __construct(FoodOrderRepository $foodOrderRepo, CustomFieldRepository $customFieldRepo , FoodRepository $foodRepo
                , ExtraRepository $extraRepo
                , OrderRepository $orderRepo)
    {
        parent::__construct();
        $this->foodOrderRepository = $foodOrderRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->foodRepository = $foodRepo;
                $this->extraRepository = $extraRepo;
                $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the FoodOrder.
     *
     * @param FoodOrderDataTable $foodOrderDataTable
     * @return Response
     */
    public function index(FoodOrderDataTable $foodOrderDataTable)
    {
        return $foodOrderDataTable->render('food_orders.index');
    }

    /**
     * Show the form for creating a new FoodOrder.
     *
     * @return Response
     */
    public function create()
    {
        $food = $this->foodRepository->pluck('name','id');
                $extra = $this->extraRepository->pluck('name','id');
                $order = $this->orderRepository->pluck('id','id');
        $extrasSelected = [];
        $hasCustomField = in_array($this->foodOrderRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodOrderRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('food_orders.create')->with("customFields", isset($html) ? $html : false)->with("food",$food)->with("extra",$extra)->with("extrasSelected",$extrasSelected)->with("order",$order);
    }

    /**
     * Store a newly created FoodOrder in storage.
     *
     * @param CreateFoodOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodOrderRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodOrderRepository->model());
        try {
            $foodOrder = $this->foodOrderRepository->create($input);
            $foodOrder->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.food_order')]));

        return redirect(route('foodOrders.index'));
    }

    /**
     * Display the specified FoodOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $foodOrder = $this->foodOrderRepository->findWithoutFail($id);

        if (empty($foodOrder)) {
            Flash::error('Food Order not found');

            return redirect(route('foodOrders.index'));
        }

        return view('food_orders.show')->with('foodOrder', $foodOrder);
    }

    /**
     * Show the form for editing the specified FoodOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $foodOrder = $this->foodOrderRepository->findWithoutFail($id);
        $food = $this->foodRepository->pluck('name','id');
                $extra = $this->extraRepository->pluck('name','id');
                $order = $this->orderRepository->pluck('id','id');
        $extrasSelected = $foodOrder->extras()->pluck('extras.id')->toArray();

        if (empty($foodOrder)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.food_order')]));

            return redirect(route('foodOrders.index'));
        }
        $customFieldsValues = $foodOrder->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->foodOrderRepository->model());
        $hasCustomField = in_array($this->foodOrderRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('food_orders.edit')->with('foodOrder', $foodOrder)->with("customFields", isset($html) ? $html : false)->with("food",$food)->with("extra",$extra)->with("extrasSelected",$extrasSelected)->with("order",$order);
    }

    /**
     * Update the specified FoodOrder in storage.
     *
     * @param  int              $id
     * @param UpdateFoodOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodOrderRequest $request)
    {
        $foodOrder = $this->foodOrderRepository->findWithoutFail($id);

        if (empty($foodOrder)) {
            Flash::error('Food Order not found');
            return redirect(route('foodOrders.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodOrderRepository->model());
        try {
            $foodOrder = $this->foodOrderRepository->update($input, $id);
            $input['extras'] = isset($input['extras']) ? $input['extras'] : [];
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $foodOrder->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.food_order')]));

        return redirect(route('foodOrders.index'));
    }

    /**
     * Remove the specified FoodOrder from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $foodOrder = $this->foodOrderRepository->findWithoutFail($id);

        if (empty($foodOrder)) {
            Flash::error('Food Order not found');

            return redirect(route('foodOrders.index'));
        }

        $this->foodOrderRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.food_order')]));

        return redirect(route('foodOrders.index'));
    }

        /**
     * Remove Media of FoodOrder
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $foodOrder = $this->foodOrderRepository->findWithoutFail($input['id']);
        try {
            if($foodOrder->hasMedia($input['collection'])){
                $foodOrder->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
