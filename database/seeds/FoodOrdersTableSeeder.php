<?php

use Illuminate\Database\Seeder;

class FoodOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('food_orders')->delete();

    }
}