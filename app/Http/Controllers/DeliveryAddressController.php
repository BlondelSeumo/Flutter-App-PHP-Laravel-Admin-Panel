<?php

namespace App\Http\Controllers;

use App\DataTables\DeliveryAddressDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDeliveryAddressRequest;
use App\Http\Requests\UpdateDeliveryAddressRequest;
use App\Repositories\DeliveryAddressRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class DeliveryAddressController extends Controller
{
    /** @var  DeliveryAddressRepository */
    private $deliveryAddressRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var UserRepository
  */
private $userRepository;

    public function __construct(DeliveryAddressRepository $deliveryAddressRepo, CustomFieldRepository $customFieldRepo , UserRepository $userRepo)
    {
        parent::__construct();
        $this->deliveryAddressRepository = $deliveryAddressRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the DeliveryAddress.
     *
     * @param DeliveryAddressDataTable $deliveryAddressDataTable
     * @return Response
     */
    public function index(DeliveryAddressDataTable $deliveryAddressDataTable)
    {
        return $deliveryAddressDataTable->render('delivery_addresses.index');
    }

    /**
     * Show the form for creating a new DeliveryAddress.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->pluck('name','id');
        
        $hasCustomField = in_array($this->deliveryAddressRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->deliveryAddressRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('delivery_addresses.create')->with("customFields", isset($html) ? $html : false)->with("user",$user);
    }

    /**
     * Store a newly created DeliveryAddress in storage.
     *
     * @param CreateDeliveryAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryAddressRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->deliveryAddressRepository->model());
        try {
            $deliveryAddress = $this->deliveryAddressRepository->create($input);
            $deliveryAddress->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.delivery_address')]));

        return redirect(route('deliveryAddresses.index'));
    }

    /**
     * Display the specified DeliveryAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');

            return redirect(route('deliveryAddresses.index'));
        }

        return view('delivery_addresses.show')->with('deliveryAddress', $deliveryAddress);
    }

    /**
     * Show the form for editing the specified DeliveryAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);
        $user = $this->userRepository->pluck('name','id');
        

        if (empty($deliveryAddress)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.delivery_address')]));

            return redirect(route('deliveryAddresses.index'));
        }
        $customFieldsValues = $deliveryAddress->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->deliveryAddressRepository->model());
        $hasCustomField = in_array($this->deliveryAddressRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('delivery_addresses.edit')->with('deliveryAddress', $deliveryAddress)->with("customFields", isset($html) ? $html : false)->with("user",$user);
    }

    /**
     * Update the specified DeliveryAddress in storage.
     *
     * @param  int              $id
     * @param UpdateDeliveryAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryAddressRequest $request)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');
            return redirect(route('deliveryAddresses.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->deliveryAddressRepository->model());
        try {
            $deliveryAddress = $this->deliveryAddressRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $deliveryAddress->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.delivery_address')]));

        return redirect(route('deliveryAddresses.index'));
    }

    /**
     * Remove the specified DeliveryAddress from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');

            return redirect(route('deliveryAddresses.index'));
        }

        $this->deliveryAddressRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.delivery_address')]));

        return redirect(route('deliveryAddresses.index'));
    }

        /**
     * Remove Media of DeliveryAddress
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($input['id']);
        try {
            if($deliveryAddress->hasMedia($input['collection'])){
                $deliveryAddress->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
