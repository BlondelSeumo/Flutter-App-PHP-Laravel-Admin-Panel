<?php

namespace App\Repositories;

use App\Models\NotificationType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NotificationTypeRepository
 * @package App\Repositories
 * @version September 4, 2019, 10:27 am UTC
 *
 * @method NotificationType findWithoutFail($id, $columns = ['*'])
 * @method NotificationType find($id, $columns = ['*'])
 * @method NotificationType first($columns = ['*'])
*/
class NotificationTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NotificationType::class;
    }
}
