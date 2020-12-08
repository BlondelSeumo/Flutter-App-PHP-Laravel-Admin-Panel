<?php

use Illuminate\Database\Seeder;

class RestaurantReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('restaurant_reviews')->delete();

        factory(\App\Models\RestaurantReview::class,20)->create();
        
//        \DB::table('restaurant_reviews')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'review' => '<p>European colonization of the Americas brought about the introduction of a large number of new ingredients</p>',
//                'rate' => 2,
//                'user_id' => 18,
//                'restaurant_id' => 2,
//                'created_at' => '2019-08-30 11:56:09',
//                'updated_at' => '2019-10-16 19:43:48',
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'review' => '<p>Americas brought about the introduction of a large number of new ingredients<br></p>',
//                'rate' => 5,
//                'user_id' => 1,
//                'restaurant_id' => 1,
//                'created_at' => '2019-08-30 11:56:52',
//                'updated_at' => '2019-08-30 11:56:52',
//            ),
//            2 =>
//            array (
//                'id' => 3,
//                'review' => 'Quis ipsum suspendisse ultrices gravida dictum fusce. Tempus quam pellentesque nec nam aliquam sem. Cras fermentum odio eu feugiat pretium.',
//                'rate' => 3,
//                'user_id' => 18,
//                'restaurant_id' => 2,
//                'created_at' => '2019-08-31 22:53:52',
//                'updated_at' => '2019-10-16 19:44:39',
//            ),
//            3 =>
//            array (
//                'id' => 4,
//                'review' => 'Platea dictumst quisque sagittis purus. Odio eu feugiat pretium nibh ipsum consequat nisl vel.',
//                'rate' => 4,
//                'user_id' => 19,
//                'restaurant_id' => 3,
//                'created_at' => '2019-10-16 19:44:15',
//                'updated_at' => '2019-10-16 19:44:15',
//            ),
//            4 =>
//            array (
//                'id' => 5,
//                'review' => 'Elementum nibh tellus molestie nunc non blandit. Risus nec feugiat in fermentum.',
//                'rate' => 2,
//                'user_id' => 20,
//                'restaurant_id' => 4,
//                'created_at' => '2019-10-16 19:45:54',
//                'updated_at' => '2019-10-16 19:45:54',
//            ),
//        ));
        
        
    }
}