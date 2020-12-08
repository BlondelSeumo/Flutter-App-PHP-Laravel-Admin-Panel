<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('galleries')->delete();
        factory(\App\Models\Gallery::class,20)->create();
        
//        \DB::table('galleries')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'description' => '<p>Our Team</p>',
//                'restaurant_id' => 1,
//                'created_at' => '2019-08-30 12:35:38',
//                'updated_at' => '2019-08-30 12:35:38',
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'description' => '<p>Our Hall</p>',
//                'restaurant_id' => 1,
//                'created_at' => '2019-08-31 17:00:43',
//                'updated_at' => '2019-08-31 17:01:06',
//            ),
//            2 =>
//            array (
//                'id' => 3,
//                'description' => '<p>Our Tables</p>',
//                'restaurant_id' => 1,
//                'created_at' => '2019-10-16 19:39:42',
//                'updated_at' => '2019-10-16 19:39:42',
//            ),
//            3 =>
//            array (
//                'id' => 4,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Team</span><br></p>',
//                'restaurant_id' => 2,
//                'created_at' => '2019-10-16 19:40:20',
//                'updated_at' => '2019-10-16 19:40:20',
//            ),
//            4 =>
//            array (
//                'id' => 5,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Hall</span><br></p>',
//                'restaurant_id' => 2,
//                'created_at' => '2019-10-16 19:40:38',
//                'updated_at' => '2019-10-16 19:40:38',
//            ),
//            5 =>
//            array (
//                'id' => 6,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Tables</span><br></p>',
//                'restaurant_id' => 2,
//                'created_at' => '2019-10-16 19:40:56',
//                'updated_at' => '2019-10-16 19:40:56',
//            ),
//            6 =>
//            array (
//                'id' => 7,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Hall</span><br></p>',
//                'restaurant_id' => 3,
//                'created_at' => '2019-10-16 19:41:41',
//                'updated_at' => '2019-10-16 19:41:41',
//            ),
//            7 =>
//            array (
//                'id' => 8,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Team</span><br></p>',
//                'restaurant_id' => 3,
//                'created_at' => '2019-10-16 19:41:56',
//                'updated_at' => '2019-10-16 19:41:56',
//            ),
//            8 =>
//            array (
//                'id' => 9,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Tables</span><br></p>',
//                'restaurant_id' => 3,
//                'created_at' => '2019-10-16 19:42:12',
//                'updated_at' => '2019-10-16 19:42:12',
//            ),
//            9 =>
//            array (
//                'id' => 10,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Hall</span><br></p>',
//                'restaurant_id' => 4,
//                'created_at' => '2019-10-16 19:42:24',
//                'updated_at' => '2019-10-16 19:42:24',
//            ),
//            10 =>
//            array (
//                'id' => 11,
//            'description' => '<p><span style="color: rgb(33, 37, 41);">Our Teal</span><br></p>',
//                'restaurant_id' => 4,
//                'created_at' => '2019-10-16 19:42:38',
//                'updated_at' => '2019-10-16 19:42:38',
//            ),
//        ));
        
        
    }
}