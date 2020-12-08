<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
//        \DB::table('orders')->insert(array (
//            0 =>
//            array (
//                'id' => 1,
//                'user_id' => 19,
//                'order_status_id' => 1,
//                'tax' => 10.0,
//                'delivery_fee' => 5.0,
//                'hint' => '',
//                'created_at' => '2020-03-29 17:38:45',
//                'updated_at' => '2020-03-29 17:50:26',
//                'payment_id' => 3,
//                'delivery_address_id' => 1,
//                'driver_id' => NULL,
//            ),
//            1 =>
//            array (
//                'id' => 2,
//                'user_id' => 19,
//                'order_status_id' => 1,
//                'tax' => 10.0,
//                'delivery_fee' => 5.0,
//                'hint' => '',
//                'created_at' => '2020-03-29 17:50:26',
//                'updated_at' => '2020-03-29 17:50:26',
//                'payment_id' => NULL,
//                'delivery_address_id' => 2,
//                'driver_id' => NULL,
//            ),
//            2 =>
//            array (
//                'id' => 3,
//                'user_id' => 19,
//                'order_status_id' => 5,
//                'tax' => 10.0,
//                'delivery_fee' => 5.0,
//                'hint' => '',
//                'created_at' => '2020-03-29 17:52:16',
//                'updated_at' => '2020-03-29 18:10:18',
//                'payment_id' => 4,
//                'delivery_address_id' => 1,
//                'driver_id' => 22,
//            ),
//            3 =>
//            array (
//                'id' => 4,
//                'user_id' => 19,
//                'order_status_id' => 1,
//                'tax' => 10.0,
//                'delivery_fee' => 7.0,
//                'hint' => '',
//                'created_at' => '2020-03-29 17:59:00',
//                'updated_at' => '2020-03-29 17:59:00',
//                'payment_id' => 5,
//                'delivery_address_id' => 2,
//                'driver_id' => NULL,
//            ),
//            4 =>
//            array (
//                'id' => 5,
//                'user_id' => 20,
//                'order_status_id' => 5,
//                'tax' => 10.0,
//                'delivery_fee' => 7.0,
//                'hint' => '',
//                'created_at' => '2020-03-29 18:00:28',
//                'updated_at' => '2020-03-29 18:08:21',
//                'payment_id' => 6,
//                'delivery_address_id' => 4,
//                'driver_id' => 22,
//            ),
//            5 =>
//            array (
//                'id' => 6,
//                'user_id' => 20,
//                'order_status_id' => 5,
//                'tax' => 10.0,
//                'delivery_fee' => 7.0,
//                'hint' => '',
//                'created_at' => '2020-03-29 18:01:12',
//                'updated_at' => '2020-03-29 18:09:09',
//                'payment_id' => 7,
//                'delivery_address_id' => 4,
//                'driver_id' => 22,
//            ),
//        ));
        
        
    }
}