<?php

namespace App\Repositories;

use App\Models\RestaurantsPayout;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RestaurantsPayoutRepository
 * @package App\Repositories
 * @version March 25, 2020, 9:48 am UTC
 *
 * @method RestaurantsPayout findWithoutFail($id, $columns = ['*'])
 * @method RestaurantsPayout find($id, $columns = ['*'])
 * @method RestaurantsPayout first($columns = ['*'])
*/
class RestaurantsPayoutRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'restaurant_id',
        'method',
        'amount',
        'paid_date',
        'note'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RestaurantsPayout::class;
    }
}
