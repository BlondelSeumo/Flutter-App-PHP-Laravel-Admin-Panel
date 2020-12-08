<?php

namespace App\Repositories;

use App\Models\Driver;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DriverRepository
 * @package App\Repositories
 * @version March 25, 2020, 9:47 am UTC
 *
 * @method Driver findWithoutFail($id, $columns = ['*'])
 * @method Driver find($id, $columns = ['*'])
 * @method Driver first($columns = ['*'])
*/
class DriverRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'delivery_fee',
        'total_orders',
        'earning',
        'available'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Driver::class;
    }
}
