<?php

namespace App\Criteria\Earnings;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EarningOfUserCriteria.
 *
 * @package namespace App\Criteria\Earnings;
 */
class EarningOfUserCriteria implements CriteriaInterface
{
    private $userId;

    /**
     * EarningOfUserCriteria constructor.
     * @param $restaurantId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }


    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model;
        }else if((auth()->user()->hasRole('manager'))){
            return $model->join("user_restaurants", "user_restaurants.restaurant_id", "=", "earnings.restaurant_id")
                ->groupBy('earnings.id')
                ->where('user_restaurants.user_id', $this->userId);
        }else{
            return $model;
        }
    }
}
