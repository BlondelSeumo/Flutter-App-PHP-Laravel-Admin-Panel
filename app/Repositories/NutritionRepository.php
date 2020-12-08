<?php

namespace App\Repositories;

use App\Models\Nutrition;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NutritionRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @method Nutrition findWithoutFail($id, $columns = ['*'])
 * @method Nutrition find($id, $columns = ['*'])
 * @method Nutrition first($columns = ['*'])
*/
class NutritionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'quantity',
        'food_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Nutrition::class;
    }
}
