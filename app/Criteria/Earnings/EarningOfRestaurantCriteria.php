<?php

namespace App\Criteria\Earnings;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EarningOfRestaurantCriteriaCriteria.
 *
 * @package namespace App\Criteria\Earnings;
 */
class EarningOfRestaurantCriteria implements CriteriaInterface
{
    private $restaurantId;

    /**
     * EarningOfRestaurantCriteriaCriteria constructor.
     */
    public function __construct($restaurantId)
    {
        $this->restaurantId = $restaurantId;
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
        return $model->where("restaurant_id",$this->restaurantId);
    }
}
