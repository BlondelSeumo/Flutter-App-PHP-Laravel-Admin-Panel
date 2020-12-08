<?php

namespace App\Http\Controllers\API;

use App\Criteria\Earnings\EarningOfUserCriteria;
use App\Criteria\Foods\FoodsOfUserCriteria;
use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Criteria\Restaurants\RestaurantsOfManagerCriteria;
use App\Http\Controllers\Controller;
use App\Repositories\EarningRepository;
use App\Repositories\FoodRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Exceptions\RepositoryException;

class DashboardAPIController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  RestaurantRepository */
    private $restaurantRepository;
    /**
     * @var FoodRepository
     */
    private $foodRepository;
    /**
     * @var EarningRepository
     */
    private $earningRepository;

    public function __construct(OrderRepository $orderRepo, EarningRepository $earningRepository, RestaurantRepository $restaurantRepo, FoodRepository $foodRepository)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->restaurantRepository = $restaurantRepo;
        $this->foodRepository = $foodRepository;
        $this->earningRepository = $earningRepository;
    }

    /**
     * Display a listing of the Faq.
     * GET|HEAD /faqs
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function manager($id, Request $request)
    {
        $statistics = [];
        try{

            $this->earningRepository->pushCriteria(new EarningOfUserCriteria(auth()->id()));
            $earning['description'] = 'total_earning';
            $earning['value'] = $this->earningRepository->all()->sum('restaurant_earning');
            $statistics[] = $earning;

            $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
            $ordersCount['description'] = "total_orders";
            $ordersCount['value'] = $this->orderRepository->all('orders.id')->count();
            $statistics[] = $ordersCount;

            $this->restaurantRepository->pushCriteria(new RestaurantsOfManagerCriteria(auth()->id()));
            $restaurantsCount['description'] = "total_restaurants";
            $restaurantsCount['value'] = $this->restaurantRepository->all('restaurants.id')->count();
            $statistics[] = $restaurantsCount;

            $this->foodRepository->pushCriteria(new FoodsOfUserCriteria(auth()->id()));
            $foodsCount['description'] = "total_foods";
            $foodsCount['value'] = $this->foodRepository->all('foods.id')->count();
            $statistics[] = $foodsCount;


        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($statistics, 'Statistics retrieved successfully');
    }
}
