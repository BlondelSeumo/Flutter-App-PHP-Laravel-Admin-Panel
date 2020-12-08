<?php

namespace App\Repositories;

use App\Models\RestaurantReview;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RestaurantReviewRepository
 * @package App\Repositories
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @method RestaurantReview findWithoutFail($id, $columns = ['*'])
 * @method RestaurantReview find($id, $columns = ['*'])
 * @method RestaurantReview first($columns = ['*'])
*/
class RestaurantReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'rate',
        'user_id',
        'restaurant_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RestaurantReview::class;
    }
}
