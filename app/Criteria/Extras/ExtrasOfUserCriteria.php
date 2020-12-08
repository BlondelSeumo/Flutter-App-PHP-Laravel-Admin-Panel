<?php
/**
 * File name: ExtrasOfUserCriteria.php
 * Last modified: 2020.04.30 at 08:24:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Extras;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ExtrasOfUserCriteria.
 *
 * @package namespace App\Criteria\Extras;
 */
class ExtrasOfUserCriteria implements CriteriaInterface
{

    /**
     * @var User
     */
    private $userId;

    /**
     * ExtrasOfUserCriteria constructor.
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
            return $model;
        } elseif (auth()->user()->hasRole('manager')) {
            return $model->join('foods', 'extras.food_id', '=', 'foods.id')
                ->join('user_restaurants', 'user_restaurants.restaurant_id', '=', 'foods.restaurant_id')
                ->groupBy('extras.id')
                ->select('extras.*')
                ->where('user_restaurants.user_id', $this->userId);
        } elseif (auth()->user()->hasRole('driver')) {
            return $model->join('foods', 'extras.food_id', '=', 'foods.id')
                ->join('driver_restaurants', 'driver_restaurants.restaurant_id', '=', 'foods.restaurant_id')
                ->groupBy('extras.id')
                ->select('extras.*')
                ->where('driver_restaurants.user_id', $this->userId);
        } else {
            return $model;
        }
    }
}
