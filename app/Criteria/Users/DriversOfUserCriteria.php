<?php
/**
 * File name: DriversOfUserCriteria.php
 * Last modified: 2020.08.20 at 16:23:39
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Criteria\Users;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class DriversOfUserCriteria.
 *
 * @package namespace App\Criteria\Drivers;
 */
class DriversOfUserCriteria implements CriteriaInterface
{
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
        if(auth()->user()->hasRole('admin')){
            return $model->whereHas("roles", function($q){ $q->where("name", "driver"); });
        }else if (auth()->user()->hasRole('manager')){
            // restaurants of this user
            $restaurantsIds = array_column(auth()->user()->restaurants->toArray(), 'id');

            return $model->join('driver_restaurants','driver_restaurants.user_id','=','users.id')
                ->whereIn('driver_restaurants.restaurant_id',$restaurantsIds)
                ->distinct('driver_restaurants.user_id')
                ->select('users.*');
        }
    }
}
