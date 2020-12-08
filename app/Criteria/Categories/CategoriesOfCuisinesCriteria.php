<?php
/**
 * File name: CategoriesOfCuisinesCriteria.php
 * Last modified: 2020.05.04 at 09:04:18
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\Categories;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoriesOfCuisinesCriteria.
 *
 * @package namespace App\Criteria\Categories;
 */
class CategoriesOfCuisinesCriteria implements CriteriaInterface
{

    /**
     * @var array
     */
    private $request;

    /**
     * CategoriesOfCuisinesCriteria constructor.
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
            return $model->join('foods', 'foods.category_id', '=', 'categories.id')
                ->join('restaurant_cuisines', 'restaurant_cuisines.restaurant_id', '=', 'foods.restaurant_id')
                ->whereIn('restaurant_cuisines.cuisine_id', $this->request->get('cuisines', []))->select('categories.*')->groupBy('categories.id');
        }
    }
}
