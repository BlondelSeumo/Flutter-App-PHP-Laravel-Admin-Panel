<?php

namespace App\Http\Controllers;

use App\Criteria\Coupons\CouponsOfManagerCriteria;
use App\Criteria\Coupons\CouponsOfUserCriteria;
use App\Criteria\Foods\FoodsOfUserCriteria;
use App\Criteria\Restaurants\ActiveCriteria;
use App\Criteria\Restaurants\RestaurantsOfUserCriteria;
use App\DataTables\CouponDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\DiscountableRepository;
use App\Repositories\FoodRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\CategoryRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class CouponController extends Controller
{
    /** @var  CouponRepository */
    private $couponRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var FoodRepository
     */
    private $foodRepository;
    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var DiscountableRepository
     */
    private $discountableRepository;

    public function __construct(CouponRepository $couponRepo, CustomFieldRepository $customFieldRepo, FoodRepository $foodRepo
        , RestaurantRepository $restaurantRepo
        , CategoryRepository $categoryRepo , DiscountableRepository $discountableRepository)
    {
        parent::__construct();
        $this->couponRepository = $couponRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->foodRepository = $foodRepo;
        $this->restaurantRepository = $restaurantRepo;
        $this->categoryRepository = $categoryRepo;
        $this->discountableRepository = $discountableRepository;
    }

    /**
     * Display a listing of the Coupon.
     *
     * @param CouponDataTable $couponDataTable
     * @return Response
     */
    public function index(CouponDataTable $couponDataTable)
    {
        return $couponDataTable->render('coupons.index');
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function create()
    {
        $this->foodRepository->pushCriteria(new FoodsOfUserCriteria(auth()->id()));
        $food = $this->foodRepository->groupedByRestaurants();

        $this->restaurantRepository->pushCriteria(new RestaurantsOfUserCriteria(auth()->id()));
        $this->restaurantRepository->pushCriteria(new ActiveCriteria());
        $restaurant = $this->restaurantRepository->pluck('name', 'id');

        $category = $this->categoryRepository->pluck('name', 'id');

        $foodsSelected = [];
        $restaurantsSelected = [];
        $categoriesSelected = [];

        $hasCustomField = in_array($this->couponRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->couponRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('coupons.create')->with("customFields", isset($html) ? $html : false)->with("food", $food)->with("restaurant", $restaurant)->with("category", $category)->with("foodsSelected", $foodsSelected)->with("restaurantsSelected", $restaurantsSelected)->with("categoriesSelected", $categoriesSelected);
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param CreateCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->couponRepository->model());
        try {
            $coupon = $this->couponRepository->create($input);
            $discountables = [];
            if(isset($input['foods'])){
                foreach ($input['foods'] as $foodId){
                    $discountables[] = ["discountable_type"=>"App\Models\Food","discountable_id"=>$foodId];
                }
            }
            if(isset($input['restaurants'])){
                foreach ($input['restaurants'] as $restaurantId){
                    $discountables[] = ["discountable_type"=>"App\Models\Restaurant","discountable_id"=>$restaurantId];
                }
            }
            if(isset($input['categories'])){
                foreach ($input['categories'] as $categoryId){
                    $discountables[] = ["discountable_type"=>"App\Models\Category","discountable_id"=>$categoryId];
                }
            }
            $coupon->discountables()->createMany($discountables);
            $coupon->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.coupon')]));

        return redirect(route('coupons.index'));
    }

    /**
     * Display the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        return view('coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->couponRepository->pushCriteria(new CouponsOfUserCriteria(auth()->id()));

        $coupon = $this->couponRepository->all()->firstWhere('id', '=', $id);

        if (empty($coupon)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.coupon')]));

            return redirect(route('coupons.index'));
        }
        $this->foodRepository->pushCriteria(new FoodsOfUserCriteria(auth()->id()));
        $food = $this->foodRepository->groupedByRestaurants();

        $this->restaurantRepository->pushCriteria(new RestaurantsOfUserCriteria(auth()->id()));
        $this->restaurantRepository->pushCriteria(new ActiveCriteria());
        $restaurant = $this->restaurantRepository->pluck('name', 'id');

        $category = $this->categoryRepository->pluck('name', 'id');

        $foodsSelected = $coupon->discountables()->where("discountable_type","App\Models\Food")->pluck('discountable_id');
        $restaurantsSelected = $coupon->discountables()->where("discountable_type","App\Models\Restaurant")->pluck('discountable_id');
        $categoriesSelected = $coupon->discountables()->where("discountable_type","App\Models\Category")->pluck('discountable_id');

        $customFieldsValues = $coupon->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->couponRepository->model());
        $hasCustomField = in_array($this->couponRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('coupons.edit')->with('coupon', $coupon)->with("customFields", isset($html) ? $html : false)->with("food", $food)->with("restaurant", $restaurant)->with("category", $category)->with("foodsSelected", $foodsSelected)->with("restaurantsSelected", $restaurantsSelected)->with("categoriesSelected", $categoriesSelected);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateCouponRequest $request)
    {
        $this->couponRepository->pushCriteria(new CouponsOfUserCriteria(auth()->id()));

        $coupon = $this->couponRepository->all()->firstWhere('id', '=', $id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');
            return redirect(route('coupons.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->couponRepository->model());
        try {
            $coupon = $this->couponRepository->update($input, $id);
            $discountables = [];
            if(isset($input['foods'])){
                foreach ($input['foods'] as $foodId){
                    $discountables[] = ["discountable_type"=>"App\Models\Food","discountable_id"=>$foodId];
                }
            }
            if(isset($input['restaurants'])){
                foreach ($input['restaurants'] as $restaurantId){
                    $discountables[] = ["discountable_type"=>"App\Models\Restaurant","discountable_id"=>$restaurantId];
                }
            }
            if(isset($input['categories'])){
                foreach ($input['categories'] as $categoryId){
                    $discountables[] = ["discountable_type"=>"App\Models\Category","discountable_id"=>$categoryId];
                }
            }
            $coupon->discountables()->delete();
            $coupon->discountables()->createMany($discountables);


            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $coupon->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.coupon')]));

        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepository->findWithoutFail($id);

        if (empty($coupon)) {
            Flash::error('Coupon not found');

            return redirect(route('coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.coupon')]));

        return redirect(route('coupons.index'));
    }

    /**
     * Remove Media of Coupon
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $coupon = $this->couponRepository->findWithoutFail($input['id']);
        try {
            if ($coupon->hasMedia($input['collection'])) {
                $coupon->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
