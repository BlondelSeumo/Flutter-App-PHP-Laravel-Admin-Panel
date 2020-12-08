<?php

use Illuminate\Database\Seeder;

class FoodReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('food_reviews')->delete();

        factory(\App\Models\FoodReview::class,30)->create();

//        \DB::table('food_reviews')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'review' => '<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br></p>',
//                'rate' => 4,
//                'user_id' => 18,
//                'food_id' => 1,
//                'created_at' => '2019-08-30 12:37:44',
//                'updated_at' => '2019-08-30 12:37:44',
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'review' => '<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br></p>',
//                'rate' => 4,
//                'user_id' => 1,
//                'food_id' => 2,
//                'created_at' => '2019-10-09 13:24:37',
//                'updated_at' => '2019-10-09 13:24:37',
//            ),
//            2 =>
//            array (
//                'id' => 3,
//                'review' => '<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br></p>',
//                'rate' => 4,
//                'user_id' => 19,
//                'food_id' => 3,
//                'created_at' => '2019-10-17 23:12:11',
//                'updated_at' => '2019-10-17 23:12:11',
//            ),
//        ));
        
        
    }
}