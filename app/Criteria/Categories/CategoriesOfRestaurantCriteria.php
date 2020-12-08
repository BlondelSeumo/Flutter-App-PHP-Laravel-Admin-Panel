<?php

namespace App\Criteria\Categories;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoriesOfRestaurantCriteria.
 *
 * @package namespace App\Criteria\Categories;
 */
class CategoriesOfRestaurantCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * CategoriesOfRestaurantCriteria constructor.
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
        if (!$this->request->has('restaurant_id')) {
            return $model;
        } else {
            $id = $this->request->get('restaurant_id');
            return $model->join('foods', 'foods.category_id', '=', 'categories.id')
                ->where('foods.restaurant_id', $id)
                ->select('categories.*')
                ->groupBy('categories.id');
        }
    }
}
