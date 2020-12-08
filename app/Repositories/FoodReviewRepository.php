<?php

namespace App\Repositories;

use App\Models\FoodReview;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FoodReviewRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:38 pm UTC
 *
 * @method FoodReview findWithoutFail($id, $columns = ['*'])
 * @method FoodReview find($id, $columns = ['*'])
 * @method FoodReview first($columns = ['*'])
*/
class FoodReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'rate',
        'user_id',
        'food_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FoodReview::class;
    }
}
