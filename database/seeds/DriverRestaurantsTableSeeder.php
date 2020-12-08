<?php

use Illuminate\Database\Seeder;

class DriverRestaurantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('driver_restaurants')->delete();

        \DB::table('driver_restaurants')->insert(array(
            0 =>
                array(
                    'user_id' => 5,
                    'restaurant_id' => 1,
                ),
            1 =>
                array(
                    'user_id' => 5,
                    'restaurant_id' => 2,
                ),
            2 =>
                array(
                    'user_id' => 5,
                    'restaurant_id' => 4,
                ),
            3 =>
                array(
                    'user_id' => 6,
                    'restaurant_id' => 2,
                ),
            4 =>
                array(
                    'user_id' => 6,
                    'restaurant_id' => 3,
                ),
            5 =>
                array(
                    'user_id' => 6,
                    'restaurant_id' => 4,
                ),
        ));


    }
}