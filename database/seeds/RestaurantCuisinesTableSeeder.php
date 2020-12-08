<?php

use Illuminate\Database\Seeder;

class RestaurantCuisinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('restaurant_cuisines')->delete();
        \DB::table('restaurant_cuisines')->insert(
            [
                array(
                    'restaurant_id' => 1,
                    'cuisine_id' => 2,
                ),
                array(
                    'restaurant_id' => 3,
                    'cuisine_id' => 4,
                ),
                array(
                    'restaurant_id' => 2,
                    'cuisine_id' => 3,
                ),
                array(
                    'restaurant_id' => 5,
                    'cuisine_id' => 6,
                ),
                array(
                    'restaurant_id' => 2,
                    'cuisine_id' => 2,
                ),
                array(
                    'restaurant_id' => 6,
                    'cuisine_id' => 3,
                ),
                array(
                    'restaurant_id' => 7,
                    'cuisine_id' => 1,
                ),
                array(
                    'restaurant_id' => 8,
                    'cuisine_id' => 5,
                ),
                array(
                    'restaurant_id' => 7,
                    'cuisine_id' => 2,
                ),
                array(
                    'restaurant_id' => 9,
                    'cuisine_id' => 1,
                ),
                array(
                    'restaurant_id' => 1,
                    'cuisine_id' => 4,
                ),
                array(
                    'restaurant_id' => 10,
                    'cuisine_id' => 5,
                )
            ]
        );
    }
}
