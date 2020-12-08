<?php
/**
 * File name: FoodsOfRestaurantCriteria.php
 * Last modified: 2020.04.30 at 08:24:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Foods;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FoodsOfRestaurantCriteria.
 *
 * @package namespace App\Criteria\Foods;
 */
class FoodsOfRestaurantCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $restaurantId;

    /**
     * FoodsOfRestaurantCriteria constructor.
     */
    public function __construct($restaurantId)
    {
        $this->restaurantId = $restaurantId;
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
        return $model->where('restaurant_id', '=', $this->restaurantId);
    }
}
