<?php

namespace App\Repositories;

use App\Models\CustomFieldValue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CustomFieldValueRepository
 * @package App\Repositories
 * @version July 24, 2018, 9:13 pm UTC
 *
 * @method CustomFieldValue findWithoutFail($id, $columns = ['*'])
 * @method CustomFieldValue find($id, $columns = ['*'])
 * @method CustomFieldValue first($columns = ['*'])
*/
class CustomFieldValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'custom_field_id',
        'customizable_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomFieldValue::class;
    }
}
