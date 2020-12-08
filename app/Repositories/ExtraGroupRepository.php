<?php

namespace App\Repositories;

use App\Models\ExtraGroup;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ExtraGroupRepository
 * @package App\Repositories
 * @version April 6, 2020, 10:47 am UTC
 *
 * @method ExtraGroup findWithoutFail($id, $columns = ['*'])
 * @method ExtraGroup find($id, $columns = ['*'])
 * @method ExtraGroup first($columns = ['*'])
*/
class ExtraGroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ExtraGroup::class;
    }
}
