<?php
/**
 * File name: FoodsOfCategoriesCriteria.php
 * Last modified: 2020.08.02 at 17:31:59
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */


namespace App\Criteria\Foods;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FoodsOfCategoriesCriteria.
 *
 * @package namespace App\Criteria\Foods;
 */
class FoodsOfCategoriesCriteria implements CriteriaInterface
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
        if (!$this->request->has('categories')) {
            return $model;
        } else {
            $categories = $this->request->get('categories');
            if (in_array('0', $categories)) { // means all fields
                return $model;
            }
            return $model->whereIn('category_id', $this->request->get('categories', []));
        }
    }
}


