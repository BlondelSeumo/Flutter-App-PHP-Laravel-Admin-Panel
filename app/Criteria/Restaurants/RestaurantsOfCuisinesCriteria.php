<?php

namespace App\Criteria\Restaurants;


use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RestaurantsOfCuisinesCriteria.
 *
 * @package namespace App\Criteria\Restaurants;
 */
class RestaurantsOfCuisinesCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * RestaurantsOfCuisinesCriteria constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        if(!$this->request->has('cuisines')) {
            return $model;
        } else {
            $cuisines = $this->request->get('cuisines');
            if (in_array('0',$cuisines)) {
                return $model;
            }
            return $model->join('restaurant_cuisines', 'restaurant_cuisines.restaurant_id', '=', 'restaurants.id')
                ->whereIn('restaurant_cuisines.cuisine_id', $this->request->get('cuisines'))->groupBy('restaurants.id');
        }
    }
}
