<?php

namespace App\Repositories;

use App\Models\Favorite;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 * @version August 30, 2019, 3:29 pm UTC
 *
 * @method Favorite findWithoutFail($id, $columns = ['*'])
 * @method Favorite find($id, $columns = ['*'])
 * @method Favorite first($columns = ['*'])
*/
class FavoriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'food_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Favorite::class;
    }
}
