<?php

use Illuminate\Database\Seeder;

class FavoriteExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('favorite_extras')->delete();
        
        \DB::table('favorite_extras')->insert(array (
            0 => 
            array (
                'extra_id' => 1,
                'favorite_id' => 1,
            ),
            1 => 
            array (
                'extra_id' => 1,
                'favorite_id' => 5,
            ),
            2 => 
            array (
                'extra_id' => 5,
                'favorite_id' => 3,
            ),
            3 => 
            array (
                'extra_id' => 2,
                'favorite_id' => 6,
            ),
            4 => 
            array (
                'extra_id' => 3,
                'favorite_id' => 2,
            ),
        ));
        
        
    }
}