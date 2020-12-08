<?php

namespace App\Criteria\Nutrition;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NutritionOfUserCriteria.
 *
 * @package namespace App\Criteria\Nutrition;
 */
class NutritionOfUserCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $userId;

    /**
     * NutritionOfUserCriteria constructor.
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
            return $model->join('foods', 'nutrition.food_id', '=', 'foods.id')
                ->join('user_restaurants', 'user_restaurants.restaurant_id', '=', 'foods.restaurant_id')
                ->groupBy('nutrition.id')
                ->select('nutrition.*')
                ->where('user_restaurants.user_id', $this->userId);
        } elseif (auth()->user()->hasRole('driver')) {
            return $model->join('foods', 'nutrition.food_id', '=', 'foods.id')
                ->join('driver_restaurants', 'driver_restaurants.restaurant_id', '=', 'foods.restaurant_id')
                ->groupBy('nutrition.id')
                ->select('nutrition.*')
                ->where('driver_restaurants.user_id', $this->userId);
        } else {
            return $model;
        }
    }
}
