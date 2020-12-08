<?php
/**
 * File name: FoodReviewController.php
 * Last modified: 2020.06.11 at 16:10:52
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Http\Controllers;

use App\Criteria\FoodReviews\FoodReviewsOfUserCriteria;
use App\DataTables\FoodReviewDataTable;
use App\Http\Requests\CreateFoodReviewRequest;
use App\Http\Requests\UpdateFoodReviewRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\FoodRepository;
use App\Repositories\FoodReviewRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class FoodReviewController extends Controller
{
    /** @var  FoodReviewRepository */
    private $foodReviewRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var FoodRepository
     */
    private $foodRepository;

    public function __construct(FoodReviewRepository $foodReviewRepo, CustomFieldRepository $customFieldRepo, UserRepository $userRepo
        , FoodRepository $foodRepo)
    {
        parent::__construct();
        $this->foodReviewRepository = $foodReviewRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
        $this->foodRepository = $foodRepo;
    }

    /**
     * Display a listing of the FoodReview.
     *
     * @param FoodReviewDataTable $foodReviewDataTable
     * @return Response
     */
    public function index(FoodReviewDataTable $foodReviewDataTable)
    {
        return $foodReviewDataTable->render('food_reviews.index');
    }

    /**
     * Show the form for creating a new FoodReview.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->pluck('name', 'id');
        $food = $this->foodRepository->groupedByRestaurants();

        $hasCustomField = in_array($this->foodReviewRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodReviewRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('food_reviews.create')->with("customFields", isset($html) ? $html : false)->with("user", $user)->with("food", $food);
    }

    /**
     * Store a newly created FoodReview in storage.
     *
     * @param CreateFoodReviewRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodReviewRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodReviewRepository->model());
        try {
            $foodReview = $this->foodReviewRepository->create($input);
            $foodReview->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.food_review')]));

        return redirect(route('foodReviews.index'));
    }

    /**
     * Display the specified FoodReview.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function show($id)
    {
        $this->foodReviewRepository->pushCriteria(new FoodReviewsOfUserCriteria(auth()->id()));
        $foodReview = $this->foodReviewRepository->findWithoutFail($id);

        if (empty($foodReview)) {
            Flash::error('Food Review not found');

            return redirect(route('foodReviews.index'));
        }

        return view('food_reviews.show')->with('foodReview', $foodReview);
    }

    /**
     * Show the form for editing the specified FoodReview.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $this->foodReviewRepository->pushCriteria(new FoodReviewsOfUserCriteria(auth()->id()));
        $foodReview = $this->foodReviewRepository->findWithoutFail($id);
        if (empty($foodReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.food_review')]));
            return redirect(route('foodReviews.index'));
        }
        $user = $this->userRepository->pluck('name', 'id');
        $food = $this->foodRepository->groupedByRestaurants();


        $customFieldsValues = $foodReview->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodReviewRepository->model());
        $hasCustomField = in_array($this->foodReviewRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('food_reviews.edit')->with('foodReview', $foodReview)->with("customFields", isset($html) ? $html : false)->with("user", $user)->with("food", $food);
    }

    /**
     * Update the specified FoodReview in storage.
     *
     * @param int $id
     * @param UpdateFoodReviewRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateFoodReviewRequest $request)
    {
        $this->foodReviewRepository->pushCriteria(new FoodReviewsOfUserCriteria(auth()->id()));
        $foodReview = $this->foodReviewRepository->findWithoutFail($id);

        if (empty($foodReview)) {
            Flash::error('Food Review not found');
            return redirect(route('foodReviews.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->foodReviewRepository->model());
        try {
            $foodReview = $this->foodReviewRepository->update($input, $id);


            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $foodReview->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.food_review')]));

        return redirect(route('foodReviews.index'));
    }

    /**
     * Remove the specified FoodReview from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        $this->foodReviewRepository->pushCriteria(new FoodReviewsOfUserCriteria(auth()->id()));
        $foodReview = $this->foodReviewRepository->findWithoutFail($id);

        if (empty($foodReview)) {
            Flash::error('Food Review not found');

            return redirect(route('foodReviews.index'));
        }

        $this->foodReviewRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.food_review')]));

        return redirect(route('foodReviews.index'));
    }

    /**
     * Remove Media of FoodReview
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $foodReview = $this->foodReviewRepository->findWithoutFail($input['id']);
        try {
            if ($foodReview->hasMedia($input['collection'])) {
                $foodReview->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
