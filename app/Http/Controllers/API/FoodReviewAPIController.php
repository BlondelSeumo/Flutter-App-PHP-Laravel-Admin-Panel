<?php

namespace App\Http\Controllers\API;


use App\Models\FoodReview;
use App\Repositories\FoodReviewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class FoodReviewController
 * @package App\Http\Controllers\API
 */

class FoodReviewAPIController extends Controller
{
    /** @var  FoodReviewRepository */
    private $foodReviewRepository;

    public function __construct(FoodReviewRepository $foodReviewRepo)
    {
        $this->foodReviewRepository = $foodReviewRepo;
    }

    /**
     * Display a listing of the FoodReview.
     * GET|HEAD /foodReviews
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->foodReviewRepository->pushCriteria(new RequestCriteria($request));
            $this->foodReviewRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $foodReviews = $this->foodReviewRepository->all();

        return $this->sendResponse($foodReviews->toArray(), 'Food Reviews retrieved successfully');
    }

    /**
     * Display the specified FoodReview.
     * GET|HEAD /foodReviews/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var FoodReview $foodReview */
        if (!empty($this->foodReviewRepository)) {
            $foodReview = $this->foodReviewRepository->findWithoutFail($id);
        }

        if (empty($foodReview)) {
            return $this->sendError('Food Review not found');
        }

        return $this->sendResponse($foodReview->toArray(), 'Food Review retrieved successfully');
    }

    /**
     * Store a newly created FoodReview in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $uniqueInput = $request->only("user_id","food_id");
        $otherInput = $request->except("user_id","food_id");
        try {
            $foodReview = $this->foodReviewRepository->updateOrCreate($uniqueInput,$otherInput);
        } catch (ValidatorException $e) {
            return $this->sendError('Food Review not found');
        }

        return $this->sendResponse($foodReview->toArray(),__('lang.saved_successfully',['operator' => __('lang.food_review')]));
    }
}
