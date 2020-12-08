<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /** @var  OrderRepository */
    private $orderRepository;


    /**
     * @var UserRepository
     */
    private $userRepository;

    /** @var  RestaurantRepository */
    private $restaurantRepository;
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(OrderRepository $orderRepo, UserRepository $userRepo, PaymentRepository $paymentRepo, RestaurantRepository $restaurantRepo)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->userRepository = $userRepo;
        $this->restaurantRepository = $restaurantRepo;
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordersCount = $this->orderRepository->count();
        $membersCount = $this->userRepository->count();
        $restaurantsCount = $this->restaurantRepository->count();
        $restaurants = $this->restaurantRepository->limit(4)->get();
        $earning = $this->paymentRepository->all()->sum('price');
        $ajaxEarningUrl = route('payments.byMonth',['api_token'=>auth()->user()->api_token]);
//        dd($ajaxEarningUrl);
        return view('dashboard.index')
            ->with("ajaxEarningUrl", $ajaxEarningUrl)
            ->with("ordersCount", $ordersCount)
            ->with("restaurantsCount", $restaurantsCount)
            ->with("restaurants", $restaurants)
            ->with("membersCount", $membersCount)
            ->with("earning", $earning);
    }
}
