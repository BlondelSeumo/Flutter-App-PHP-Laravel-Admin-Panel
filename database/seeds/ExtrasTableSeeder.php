<?php

use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('extras')->delete();
        factory(\App\Models\Extra::class,50)->create();

//        $extras = [];
//
//        for ($i = 1; $i < 26; $i++) {
//            $extras[] = array(
//                'id' => $i,
//                'name' => 'Tuna',
//                'description' => '<p>Add some tuna</p>',
//                'price' => 3.0,
//                'food_id' => 1,
//                'extra_group_id' => 1,
//                'created_at' => '2019-08-30 12:39:50',
//                'updated_at' => '2019-08-30 12:39:50',
//            );
//        }
//
//
//        DB::table('extras')->insert($extras);


    }
}