<?php
/**
 * File name: RestaurantReviewController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\RestaurantReviews\RestaurantReviewsOfUserCriteria;
use App\DataTables\RestaurantReviewDataTable;
use App\Http\Requests\CreateRestaurantReviewRequest;
use App\Http\Requests\UpdateRestaurantReviewRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\RestaurantReviewRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class RestaurantReviewController extends Controller
{
    /** @var  RestaurantReviewRepository */
    private $restaurantReviewRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;

    public function __construct(RestaurantReviewRepository $restaurantReviewRepo, CustomFieldRepository $customFieldRepo, UserRepository $userRepo
        , RestaurantRepository $restaurantRepo)
    {
        parent::__construct();
        $this->restaurantReviewRepository = $restaurantReviewRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
        $this->restaurantRepository = $restaurantRepo;
    }

    /**
     * Display a listing of the RestaurantReview.
     *
     * @param RestaurantReviewDataTable $restaurantReviewDataTable
     * @return Response
     */
    public function index(RestaurantReviewDataTable $restaurantReviewDataTable)
    {
        return $restaurantReviewDataTable->render('restaurant_reviews.index');
    }

    /**
     * Show the form for creating a new RestaurantReview.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->pluck('name', 'id');
        $restaurant = $this->restaurantRepository->pluck('name', 'id');

        $hasCustomField = in_array($this->restaurantReviewRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantReviewRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('restaurant_reviews.create')->with("customFields", isset($html) ? $html : false)->with("user", $user)->with("restaurant", $restaurant);
    }

    /**
     * Store a newly created RestaurantReview in storage.
     *
     * @param CreateRestaurantReviewRequest $request
     *
     * @return Response
     */
    public function store(CreateRestaurantReviewRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantReviewRepository->model());
        try {
            $restaurantReview = $this->restaurantReviewRepository->create($input);
            $restaurantReview->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.restaurant_review')]));

        return redirect(route('restaurantReviews.index'));
    }

    /**
     * Display the specified RestaurantReview.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $restaurantReview = $this->restaurantReviewRepository->findWithoutFail($id);

        if (empty($restaurantReview)) {
            Flash::error('Restaurant Review not found');

            return redirect(route('restaurantReviews.index'));
        }

        return view('restaurant_reviews.show')->with('restaurantReview', $restaurantReview);
    }

    /**
     * Show the form for editing the specified RestaurantReview.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->restaurantReviewRepository->pushCriteria(new RestaurantReviewsOfUserCriteria(auth()->id()));
        $restaurantReview = $this->restaurantReviewRepository->findWithoutFail($id);
        if (empty($restaurantReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.restaurant_review')]));

            return redirect(route('restaurantReviews.index'));
        }
        $user = $this->userRepository->pluck('name', 'id');
        $restaurant = $this->restaurantRepository->pluck('name', 'id');


        $customFieldsValues = $restaurantReview->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantReviewRepository->model());
        $hasCustomField = in_array($this->restaurantReviewRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('restaurant_reviews.edit')->with('restaurantReview', $restaurantReview)->with("customFields", isset($html) ? $html : false)->with("user", $user)->with("restaurant", $restaurant);
    }

    /**
     * Update the specified RestaurantReview in storage.
     *
     * @param int $id
     * @param UpdateRestaurantReviewRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateRestaurantReviewRequest $request)
    {
        $this->restaurantReviewRepository->pushCriteria(new RestaurantReviewsOfUserCriteria(auth()->id()));
        $restaurantReview = $this->restaurantReviewRepository->findWithoutFail($id);

        if (empty($restaurantReview)) {
            Flash::error('Restaurant Review not found');
            return redirect(route('restaurantReviews.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->restaurantReviewRepository->model());
        try {
            $restaurantReview = $this->restaurantReviewRepository->update($input, $id);


            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $restaurantReview->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.restaurant_review')]));

        return redirect(route('restaurantReviews.index'));
    }

    /**
     * Remove the specified RestaurantReview from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        $this->restaurantReviewRepository->pushCriteria(new RestaurantReviewsOfUserCriteria(auth()->id()));
        $restaurantReview = $this->restaurantReviewRepository->findWithoutFail($id);

        if (empty($restaurantReview)) {
            Flash::error('Restaurant Review not found');

            return redirect(route('restaurantReviews.index'));
        }

        $this->restaurantReviewRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.restaurant_review')]));

        return redirect(route('restaurantReviews.index'));
    }

    /**
     * Remove Media of RestaurantReview
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $restaurantReview = $this->restaurantReviewRepository->findWithoutFail($input['id']);
        try {
            if ($restaurantReview->hasMedia($input['collection'])) {
                $restaurantReview->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
