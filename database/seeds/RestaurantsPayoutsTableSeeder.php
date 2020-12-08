<?php

use Illuminate\Database\Seeder;

class RestaurantsPayoutsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('restaurants_payouts')->delete();
        
    }
}