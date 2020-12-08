<?php

use Illuminate\Database\Seeder;

class DeliveryAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('delivery_addresses')->delete();

        factory(\App\Models\DeliveryAddress::class,15)->create();
        
//        \DB::table('delivery_addresses')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'description' => 'Home Address',
//                'address' => 'Rue de Dunkerque',
//                'latitude' => '132',
//                'longitude' => '6.584',
//                'is_default' => 1,
//                'user_id' => 19,
//                'created_at' => '2019-12-06 15:30:23',
//                'updated_at' => '2019-12-06 16:23:20',
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'description' => 'Work Address',
//                'address' => '4722 Villa Drive',
//                'latitude' => '136',
//                'longitude' => '-122.086749655962',
//                'is_default' => 0,
//                'user_id' => 19,
//                'created_at' => '2019-12-06 16:23:03',
//                'updated_at' => '2019-12-06 16:23:25',
//            ),
//            2 =>
//            array (
//                'id' => 4,
//                'description' => 'Home',
//                'address' => '12 Street 78',
//                'latitude' => NULL,
//                'longitude' => NULL,
//                'is_default' => 1,
//                'user_id' => 20,
//                'created_at' => '2020-03-29 18:00:22',
//                'updated_at' => '2020-03-29 18:00:22',
//            ),
//        ));
        
        
    }
}