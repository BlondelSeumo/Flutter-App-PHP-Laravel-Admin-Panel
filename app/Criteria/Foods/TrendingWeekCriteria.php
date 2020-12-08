<?php
/**
 * File name: TrendingWeekCriteria.php
 * Last modified: 2020.05.04 at 09:04:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Foods;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TrendingWeekCriteria.
 *
 * @package namespace App\Criteria\Foods;
 */
class TrendingWeekCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * TrendingWeekCriteria constructor.
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

            $myLat = $this->request->get('myLat', 0);
            $myLon = $this->request->get('myLon', 0);
            $areaLat = $this->request->get('areaLat', 0);
            $areaLon = $this->request->get('areaLon', 0);

            return $model->join('restaurants', 'restaurants.id', '=', 'foods.restaurant_id')->select(DB::raw("SQRT(
            POW(69.1 * (restaurants.latitude - $myLat), 2) +
            POW(69.1 * ($myLon - restaurants.longitude) * COS(restaurants.latitude / 57.3), 2)) AS distance, SQRT(
            POW(69.1 * (restaurants.latitude - $areaLat), 2) +
            POW(69.1 * ($areaLon - restaurants.longitude) * COS(restaurants.latitude / 57.3), 2)) AS area, count(foods.id) as food_count"), 'foods.*')
                ->join('food_orders', 'foods.id', '=', 'food_orders.food_id')
                ->whereBetween('food_orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('restaurants.active','1')
                ->orderBy('food_count', 'desc')
                ->orderBy('area')
                ->groupBy('foods.id');
        } else {
            return $model->join('food_orders', 'foods.id', '=', 'food_orders.food_id')
                ->whereBetween('food_orders.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->join('restaurants', 'restaurants.id', '=', 'foods.restaurant_id')
                ->where('restaurants.active','1')
                ->groupBy('foods.id')
                ->orderBy('food_count', 'desc')
                ->select('foods.*', DB::raw('count(foods.id) as food_count'));
        }
    }
}
