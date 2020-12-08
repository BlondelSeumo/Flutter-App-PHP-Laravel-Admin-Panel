<?php

namespace App\Repositories;

use App\Models\Food;
use Illuminate\Container\Container as Application;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class FoodRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method Food findWithoutFail($id, $columns = ['*'])
 * @method Food find($id, $columns = ['*'])
 * @method Food first($columns = ['*'])
 */
class FoodRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'discount_price',
        'description',
        'ingredients',
        'weight',
        'package_items_count',
        'unit',
        'featured',
        'restaurant_id',
        'category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Food::class;
    }

    /**
     * get my foods
     **/
    public function myFoods()
    {
        return Food::join("user_restaurants", "user_restaurants.restaurant_id", "=", "foods.restaurant_id")
            ->where('user_restaurants.user_id', auth()->id())->get();
    }

    public function groupedByRestaurants()
    {
        $foods = [];
        foreach ($this->all() as $model) {
            if(!empty($model->restaurant)){
                $foods[$model->restaurant->name][$model->id] = $model->name;
            }
        }
        return $foods;
    }
}
