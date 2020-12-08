<?php

use Illuminate\Database\Seeder;

class CartExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cart_extras')->delete();

    }
}