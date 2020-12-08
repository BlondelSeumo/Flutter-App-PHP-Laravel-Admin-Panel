<?php

namespace App\Repositories;

use App\Models\FoodOrder;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FoodOrderRepository
 * @package App\Repositories
 * @version August 31, 2019, 11:18 am UTC
 *
 * @method FoodOrder findWithoutFail($id, $columns = ['*'])
 * @method FoodOrder find($id, $columns = ['*'])
 * @method FoodOrder first($columns = ['*'])
*/
class FoodOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'price',
        'quantity',
        'food_id',
        'order_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FoodOrder::class;
    }
}
