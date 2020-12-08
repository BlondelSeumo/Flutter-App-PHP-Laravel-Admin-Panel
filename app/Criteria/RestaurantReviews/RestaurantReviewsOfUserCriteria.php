<?php
/**
 * File name: RestaurantReviewsOfUserCriteria.php
 * Last modified: 2020.05.04 at 09:04:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\RestaurantReviews;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RestaurantReviewsOfUserCriteria.
 *
 * @package namespace App\Criteria\RestaurantReviews;
 */
class RestaurantReviewsOfUserCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $userId;

    /**
     * RestaurantReviewsOfUserCriteria constructor.
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
            return $model->select('restaurant_reviews.*');
        } else if (auth()->user()->hasRole('manager')) {
            return $model->join("user_restaurants", "user_restaurants.restaurant_id", "=", "restaurant_reviews.restaurant_id")
                ->where('user_restaurants.user_id', $this->userId)
                ->groupBy('restaurant_reviews.id')
                ->select('restaurant_reviews.*');
        } else if (auth()->user()->hasRole('driver')) {
            return $model->join("driver_restaurants", "driver_restaurants.restaurant_id", "=", "restaurant_reviews.restaurant_id")
                ->where('driver_restaurants.user_id', $this->userId)
                ->groupBy('restaurant_reviews.id')
                ->select('restaurant_reviews.*');
        } else if (auth()->user()->hasRole('client')) {
            return $model->where('restaurant_reviews.user_id', $this->userId)
                ->groupBy('restaurant_reviews.id')
                ->select('restaurant_reviews.*');
        }
    }
}
