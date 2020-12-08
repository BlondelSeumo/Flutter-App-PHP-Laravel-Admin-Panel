<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('favorites')->delete();

        factory(\App\Models\Favorite::class,30)->create();
        
//        \DB::table('favorites')->insert(array (
//            0 =>
//            array (
//                'id' => 3,
//                'food_id' => 1,
//                'user_id' => 18,
//                'created_at' => '2019-08-30 16:31:52',
//                'updated_at' => '2019-08-30 16:31:53',
//            ),
//            1 =>
//            array (
//                'id' => 14,
//                'food_id' => 2,
//                'user_id' => 18,
//                'created_at' => '2019-10-09 13:42:45',
//                'updated_at' => '2019-10-09 13:42:45',
//            ),
//            2 =>
//            array (
//                'id' => 16,
//                'food_id' => 3,
//                'user_id' => 1,
//                'created_at' => '2019-10-17 23:22:26',
//                'updated_at' => '2019-10-17 23:22:26',
//            ),
//            3 =>
//            array (
//                'id' => 25,
//                'food_id' => 1,
//                'user_id' => 1,
//                'created_at' => '2019-10-18 13:40:22',
//                'updated_at' => '2019-10-18 13:40:22',
//            ),
//            4 =>
//            array (
//                'id' => 26,
//                'food_id' => 1,
//                'user_id' => 19,
//                'created_at' => '2019-12-15 20:15:03',
//                'updated_at' => '2019-12-15 20:15:03',
//            ),
//            5 =>
//            array (
//                'id' => 27,
//                'food_id' => 5,
//                'user_id' => 19,
//                'created_at' => '2019-12-15 20:22:20',
//                'updated_at' => '2019-12-15 20:22:20',
//            ),
//            6 =>
//            array (
//                'id' => 28,
//                'food_id' => 3,
//                'user_id' => 19,
//                'created_at' => '2020-03-25 21:44:56',
//                'updated_at' => '2020-03-25 21:44:56',
//            ),
//        ));
        
        
    }
}