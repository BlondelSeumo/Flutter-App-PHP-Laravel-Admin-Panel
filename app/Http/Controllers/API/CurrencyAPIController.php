<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use App\Repositories\CustomFieldRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CurrencyController
 * @package App\Http\Controllers\API
 */
class CurrencyAPIController extends Controller
{
    /** @var  CurrencyRepository */
    private $currencyRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;



    public function __construct(CurrencyRepository $currencyRepo, CustomFieldRepository $customFieldRepo )
    {
        parent::__construct();
        $this->currencyRepository = $currencyRepo;
        $this->customFieldRepository = $customFieldRepo;

    }

    /**
     * Display a listing of the Currency.
     * GET|HEAD /currencies
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->currencyRepository->pushCriteria(new RequestCriteria($request));
            $this->currencyRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $currencies = $this->currencyRepository->all();

        return $this->sendResponse($currencies->toArray(), 'Currencies retrieved successfully');
    }

    /**
     * Display the specified Currency.
     * GET|HEAD /currencies/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Currency $currency */
        if (!empty($this->currencyRepository)) {
            $currency = $this->currencyRepository->findWithoutFail($id);
        }

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        return $this->sendResponse($currency->toArray(), 'Currency retrieved successfully');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->currencyRepository->model());
        try {
            $currency = $this->currencyRepository->create($input);
            $currency->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($currency->toArray(),__('lang.saved_successfully',['operator' => __('lang.currency')]));
    }


    /**
     * Update the specified Currency in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $currency = $this->currencyRepository->findWithoutFail($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->currencyRepository->model());
        try {
            $currency = $this->currencyRepository->update($input, $id);


            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $currency->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($currency->toArray(),__('lang.updated_successfully',['operator' => __('lang.currency')]));

    }

    /**
     * Remove the specified Currency from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $currency = $this->currencyRepository->findWithoutFail($id);

        if (empty($currency)) {
            return $this->sendError('Currency not found');
        }

        $currency = $this->currencyRepository->delete($id);

        return $this->sendResponse($currency,__('lang.deleted_successfully',['operator' => __('lang.currency')]));
    }
}
