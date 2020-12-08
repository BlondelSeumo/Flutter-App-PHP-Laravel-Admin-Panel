<?php

namespace App\Http\Controllers;

use App\DataTables\OrderStatusDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderStatusRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Repositories\OrderStatusRepository;
use App\Repositories\CustomFieldRepository;

use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class OrderStatusController extends Controller
{
    /** @var  OrderStatusRepository */
    private $orderStatusRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    

    public function __construct(OrderStatusRepository $orderStatusRepo, CustomFieldRepository $customFieldRepo )
    {
        parent::__construct();
        $this->orderStatusRepository = $orderStatusRepo;
        $this->customFieldRepository = $customFieldRepo;
        
    }

    /**
     * Display a listing of the OrderStatus.
     *
     * @param OrderStatusDataTable $orderStatusDataTable
     * @return Response
     */
    public function index(OrderStatusDataTable $orderStatusDataTable)
    {
        return $orderStatusDataTable->render('order_statuses.index');
    }

    /**
     * Show the form for creating a new OrderStatus.
     *
     * @return Response
     */
    public function create()
    {
        
        
        $hasCustomField = in_array($this->orderStatusRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderStatusRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('order_statuses.create')->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Store a newly created OrderStatus in storage.
     *
     * @param CreateOrderStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderStatusRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderStatusRepository->model());
        try {
            $orderStatus = $this->orderStatusRepository->create($input);
            $orderStatus->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.order_status')]));

        return redirect(route('orderStatuses.index'));
    }

    /**
     * Display the specified OrderStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderStatus = $this->orderStatusRepository->findWithoutFail($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');

            return redirect(route('orderStatuses.index'));
        }

        return view('order_statuses.show')->with('orderStatus', $orderStatus);
    }

    /**
     * Show the form for editing the specified OrderStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderStatus = $this->orderStatusRepository->findWithoutFail($id);
        
        

        if (empty($orderStatus)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.order_status')]));

            return redirect(route('orderStatuses.index'));
        }
        $customFieldsValues = $orderStatus->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->orderStatusRepository->model());
        $hasCustomField = in_array($this->orderStatusRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('order_statuses.edit')->with('orderStatus', $orderStatus)->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Update the specified OrderStatus in storage.
     *
     * @param  int              $id
     * @param UpdateOrderStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderStatusRequest $request)
    {
        $orderStatus = $this->orderStatusRepository->findWithoutFail($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');
            return redirect(route('orderStatuses.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderStatusRepository->model());
        try {
            $orderStatus = $this->orderStatusRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $orderStatus->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.order_status')]));

        return redirect(route('orderStatuses.index'));
    }

    /**
     * Remove the specified OrderStatus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderStatus = $this->orderStatusRepository->findWithoutFail($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');

            return redirect(route('orderStatuses.index'));
        }

        $this->orderStatusRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.order_status')]));

        return redirect(route('orderStatuses.index'));
    }

        /**
     * Remove Media of OrderStatus
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $orderStatus = $this->orderStatusRepository->findWithoutFail($input['id']);
        try {
            if($orderStatus->hasMedia($input['collection'])){
                $orderStatus->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
