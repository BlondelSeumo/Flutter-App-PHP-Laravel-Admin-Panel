<?php

namespace App\Http\Controllers\API;


use App\Models\RestaurantsPayout;
use App\Repositories\RestaurantsPayoutRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class RestaurantsPayoutController
 * @package App\Http\Controllers\API
 */

class RestaurantsPayoutAPIController extends Controller
{
    /** @var  RestaurantsPayoutRepository */
    private $restaurantsPayoutRepository;

    public function __construct(RestaurantsPayoutRepository $restaurantsPayoutRepo)
    {
        $this->restaurantsPayoutRepository = $restaurantsPayoutRepo;
    }

    /**
     * Display a listing of the RestaurantsPayout.
     * GET|HEAD /restaurantsPayouts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->restaurantsPayoutRepository->pushCriteria(new RequestCriteria($request));
            $this->restaurantsPayoutRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $restaurantsPayouts = $this->restaurantsPayoutRepository->all();

        return $this->sendResponse($restaurantsPayouts->toArray(), 'Restaurants Payouts retrieved successfully');
    }

    /**
     * Display the specified RestaurantsPayout.
     * GET|HEAD /restaurantsPayouts/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var RestaurantsPayout $restaurantsPayout */
        if (!empty($this->restaurantsPayoutRepository)) {
            $restaurantsPayout = $this->restaurantsPayoutRepository->findWithoutFail($id);
        }

        if (empty($restaurantsPayout)) {
            return $this->sendError('Restaurants Payout not found');
        }

        return $this->sendResponse($restaurantsPayout->toArray(), 'Restaurants Payout retrieved successfully');
    }
}
