<?php

namespace App\Repositories;

use App\Models\OrderStatus;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderStatusRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method OrderStatus findWithoutFail($id, $columns = ['*'])
 * @method OrderStatus find($id, $columns = ['*'])
 * @method OrderStatus first($columns = ['*'])
*/
class OrderStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return OrderStatus::class;
    }
}
