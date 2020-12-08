<?php
/**
 * File name: FoodsOfCuisinesCriteria.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Foods;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FoodsOfCuisinesCriteria.
 *
 * @package namespace App\Criteria\Foods;
 */
class FoodsOfCuisinesCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * FoodsOfCuisinesCriteria constructor.
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
        if (!$this->request->has('cuisines')) {
            return $model;
        } else {
            $cuisines = $this->request->get('cuisines');
            if (in_array('0', $cuisines)) { // means all cuisines
                return $model;
            }
            return $model->join('restaurant_cuisines', 'restaurant_cuisines.restaurant_id', '=', 'foods.restaurant_id')
                ->whereIn('restaurant_cuisines.cuisine_id', $this->request->get('cuisines', []))->groupBy('foods.id');
        }
    }
}
