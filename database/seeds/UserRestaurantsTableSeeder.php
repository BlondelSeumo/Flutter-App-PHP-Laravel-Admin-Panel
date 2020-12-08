<?php

use Illuminate\Database\Seeder;

class UserRestaurantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {


        \DB::table('user_restaurants')->delete();

        \DB::table('user_restaurants')->insert(array(
            0 =>
                array(
                    'user_id' => 1,
                    'restaurant_id' => 2,
                ),
            1 =>
                array(
                    'user_id' => 1,
                    'restaurant_id' => 5,
                ),
            2 =>
                array(
                    'user_id' => 2,
                    'restaurant_id' => 3,
                ),
            3 =>
                array(
                    'user_id' => 2,
                    'restaurant_id' => 4,
                ),
            5 =>
                array(
                    'user_id' => 1,
                    'restaurant_id' => 6,
                ),
            6 =>
                array(
                    'user_id' => 1,
                    'restaurant_id' => 3,
                ),
        ));


    }
}