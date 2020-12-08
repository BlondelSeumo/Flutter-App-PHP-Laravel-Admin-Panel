<?php

use Illuminate\Database\Seeder;

class NutritionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nutrition')->delete();
        factory(\App\Models\Nutrition::class,50)->create();
        /*
        \DB::table('nutrition')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 1,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 2,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 3,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 3,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 3,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 2,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 5,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 5,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 5,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 9,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 7,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 14,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 16,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 7,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 13,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 13,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 9,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 12,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 6,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 3,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 2,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 12,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 10,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 10,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 6,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 3,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 3,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 4,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 12,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 8,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 9,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 13,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 9,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 16,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 5,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Sugar',
                'quantity' => 100,
                'food_id' => 11,
                'created_at' => '2019-08-31 10:55:28',
                'updated_at' => '2019-08-31 10:55:28',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Proteins',
                'quantity' => 20,
                'food_id' => 15,
                'created_at' => '2019-10-09 13:26:28',
                'updated_at' => '2019-10-09 13:26:28',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Lipide',
                'quantity' => 63,
                'food_id' => 10,
                'created_at' => '2019-10-17 23:10:54',
                'updated_at' => '2019-10-17 23:11:31',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Proteins',
                'quantity' => 100,
                'food_id' => 5,
                'created_at' => '2019-10-17 23:11:06',
                'updated_at' => '2019-10-17 23:11:06',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Sugar',
                'quantity' => 14,
                'food_id' => 16,
                'created_at' => '2019-10-17 23:11:17',
                'updated_at' => '2019-10-17 23:11:17',
            ),
        ));*/
        
        
    }
}