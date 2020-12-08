<?php

namespace App\Http\Controllers;

use App\Criteria\Earnings\EarningOfRestaurantCriteria;
use App\Criteria\Restaurants\RestaurantsOfManagerCriteria;
use App\DataTables\RestaurantsPayoutDataTable;
use App\Http\Requests\CreateRestaurantsPayoutRequest;
use App\Http\Requests\UpdateRestaurantsPayoutRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\EarningRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\RestaurantsPayoutRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class RestaurantsPayoutController extends Controller
{
    /** @var  RestaurantsPayoutRepository */
    private $restaurantsPayoutRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;
    /**
     * @var EarningRepository
     */
    private $earningRepository;

    public function __construct(RestaurantsPayoutRepository $restaurantsPayoutRepo, CustomFieldRepository $customFieldRepo, RestaurantRepository $restaurantRepo, EarningRepository $earningRepository)
    {
        parent::__construct();
        $this->restaurantsPayoutRepository = $restaurantsPayoutRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->restaurantRepository = $restaurantRepo;
        $this->earningRepository = $earningRepository;
    }

    /**
     * Display a listing of the RestaurantsPayout.
     *
     * @param RestaurantsPayoutDataTable $restaurantsPayoutDataTable
     * @return Response
     */
    public function index(RestaurantsPayoutDataTable $restaurantsPayoutDataTable)
    {
        return $restaurantsPayoutDataTable->render('restaurants_payouts.index');
    }

    /**
     * Show the form for creating a new RestaurantsPayout.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('manager')){
            $this->restaurantRepository->pushCriteria(new RestaurantsOfManagerCriteria(auth()->id()));
        }
        $restaurant = $this->restaurantRepository->pluck('name', 'id');

        $hasCustomField = in_array($this->restaurantsPayoutRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantsPayoutRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('restaurants_payouts.create')->with("customFields", isset($html) ? $html : false)->with("restaurant", $restaurant);
    }

    /**
     * Store a newly created RestaurantsPayout in storage.
     *
     * @param CreateRestaurantsPayoutRequest $request
     *
     * @return Response
     */
    public function store(CreateRestaurantsPayoutRequest $request)
    {
        $input = $request->all();
        $earning = $this->earningRepository->findByField('restaurant_id',$input['restaurant_id'])->first();
        if($input['amount'] > $earning->restaurant_earning){
            Flash::error('The payout amount must be less than restaurant earning');
            return redirect(route('restaurantsPayouts.create'))->withInput($input);
        }
        $input['paid_date'] = Carbon::now();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantsPayoutRepository->model());
        try {
            $this->earningRepository->update(['restaurant_earning'=>$earning->restaurant_earning - $input['amount']], $earning->id);
            $restaurantsPayout = $this->restaurantsPayoutRepository->create($input);
            $restaurantsPayout->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.restaurants_payout')]));

        return redirect(route('restaurantsPayouts.index'));
    }

    /**
     * Display the specified RestaurantsPayout.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $restaurantsPayout = $this->restaurantsPayoutRepository->findWithoutFail($id);

        if (empty($restaurantsPayout)) {
            Flash::error('Restaurants Payout not found');

            return redirect(route('restaurantsPayouts.index'));
        }

        return view('restaurants_payouts.show')->with('restaurantsPayout', $restaurantsPayout);
    }

    /**
     * Show the form for editing the specified RestaurantsPayout.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $restaurantsPayout = $this->restaurantsPayoutRepository->findWithoutFail($id);
        $restaurant = $this->restaurantRepository->pluck('name', 'id');


        if (empty($restaurantsPayout)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.restaurants_payout')]));

            return redirect(route('restaurantsPayouts.index'));
        }
        $customFieldsValues = $restaurantsPayout->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantsPayoutRepository->model());
        $hasCustomField = in_array($this->restaurantsPayoutRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('restaurants_payouts.edit')->with('restaurantsPayout', $restaurantsPayout)->with("customFields", isset($html) ? $html : false)->with("restaurant", $restaurant);
    }

    /**
     * Update the specified RestaurantsPayout in storage.
     *
     * @param int $id
     * @param UpdateRestaurantsPayoutRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRestaurantsPayoutRequest $request)
    {
        $restaurantsPayout = $this->restaurantsPayoutRepository->findWithoutFail($id);

        if (empty($restaurantsPayout)) {
            Flash::error('Restaurants Payout not found');
            return redirect(route('restaurantsPayouts.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantsPayoutRepository->model());
        try {
            $restaurantsPayout = $this->restaurantsPayoutRepository->update($input, $id);


            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $restaurantsPayout->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.restaurants_payout')]));

        return redirect(route('restaurantsPayouts.index'));
    }

    /**
     * Remove the specified RestaurantsPayout from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $restaurantsPayout = $this->restaurantsPayoutRepository->findWithoutFail($id);

        if (empty($restaurantsPayout)) {
            Flash::error('Restaurants Payout not found');

            return redirect(route('restaurantsPayouts.index'));
        }

        $this->restaurantsPayoutRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.restaurants_payout')]));

        return redirect(route('restaurantsPayouts.index'));
    }

    /**
     * Remove Media of RestaurantsPayout
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $restaurantsPayout = $this->restaurantsPayoutRepository->findWithoutFail($input['id']);
        try {
            if ($restaurantsPayout->hasMedia($input['collection'])) {
                $restaurantsPayout->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
