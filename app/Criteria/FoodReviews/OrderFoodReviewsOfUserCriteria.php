<?php
/**
 * File name: OrderFoodReviewsOfUserCriteria.php
 * Last modified: 2020.05.04 at 09:04:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\FoodReviews;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderFoodReviewsOfUserCriteria.
 *
 * @package namespace App\Criteria\FoodReviews;
 */
class OrderFoodReviewsOfUserCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $userId;

    /**
     * OrderFoodReviewsOfUserCriteria constructor.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->select('food_reviews.*');
        } else if (auth()->user()->hasRole('manager')) {
            return $model->join("foods", "foods.id", "=", "food_reviews.food_id")
                ->join("user_restaurants", "user_restaurants.restaurant_id", "=", "foods.restaurant_id")
                ->where('user_restaurants.user_id', $this->userId)
                ->groupBy('food_reviews.id')
                ->select('food_reviews.*');

        } else if (auth()->user()->hasRole('driver')) {
            return $model->join("foods", "foods.id", "=", "food_reviews.food_id")
                ->join("driver_restaurants", "driver_restaurants.restaurant_id", "=", "foods.restaurant_id")
                ->where('driver_restaurants.user_id', $this->userId)
                ->groupBy('food_reviews.id')
                ->select('food_reviews.*');

        } else if (auth()->user()->hasRole('client')) {
            return $model->newQuery()->join("foods", "foods.id", "=", "food_reviews.food_id")
                ->join("food_orders", "food_orders.food_id", "=", "foods.id")
                ->join("orders", "food_orders.order_id", "=", "orders.id")
                ->where('orders.user_id', $this->userId)
                ->groupBy('food_reviews.id')
                ->select('food_reviews.*');
        } else {
            return $model->select('food_reviews.*');
        }
    }
}
