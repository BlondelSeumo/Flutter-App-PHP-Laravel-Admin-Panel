<?php

namespace App\Criteria\Restaurants;

use App\Models\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RestaurantsOfManagerCriteria.
 *
 * @package namespace App\Criteria\Restaurants;
 */
class RestaurantsOfManagerCriteria implements CriteriaInterface
{
    /**
     * @var User
     */
    private $userId;

    /**
     * RestaurantsOfManagerCriteria constructor.
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
        return $model->join('user_restaurants','user_restaurants.restaurant_id','=','restaurants.id')
            ->where('user_restaurants.user_id',$this->userId);
    }
}
