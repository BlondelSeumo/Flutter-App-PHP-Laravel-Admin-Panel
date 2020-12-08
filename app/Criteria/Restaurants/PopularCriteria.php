<?php
/**
 * File name: PopularCriteria.php
 * Last modified: 2020.05.04 at 09:04:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Restaurants;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PopularCriteria.
 *
 * @package namespace App\Criteria\Restaurants;
 */
class PopularCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * PopularCriteria constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        if ($this->request->has(['myLon', 'myLat', 'areaLon', 'areaLat'])) {

            $myLat = $this->request->get('myLat');
            $myLon = $this->request->get('myLon');
            $areaLat = $this->request->get('areaLat');
            $areaLon = $this->request->get('areaLon');

            return $model->select(DB::raw("SQRT(
                POW(69.1 * (latitude - $myLat), 2) +
                POW(69.1 * ($myLon - longitude) * COS(latitude / 57.3), 2)) AS distance, SQRT(
                POW(69.1 * (latitude - $areaLat), 2) +
                POW(69.1 * ($areaLon - longitude) * COS(latitude / 57.3), 2))  AS area count(restaurants.id) as restaurant_count"), "restaurants.*")
                ->join('foods', 'foods.restaurant_id', '=', 'restaurants.id')
                ->join('food_orders', 'foods.id', '=', 'food_orders.food_id')
                ->orderBy('restaurant_count', 'desc')
                ->orderBy('area')
                ->groupBy('restaurants.id');
        } else {
            return $model->select(DB::raw("count(restaurants.id) as restaurant_count"), "restaurants.*")
                ->join('foods', 'foods.restaurant_id', '=', 'restaurants.id')
                ->join('food_orders', 'foods.id', '=', 'food_orders.food_id')
                ->orderBy('restaurant_count', 'desc')
                ->groupBy('restaurants.id');
        }
    }
}
