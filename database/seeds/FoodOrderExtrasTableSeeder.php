<?php

use Illuminate\Database\Seeder;

class FoodOrderExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('food_order_extras')->delete();
    }
}