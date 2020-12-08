<?php

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('restaurants')->delete();

        factory(\App\Models\Restaurant::class,10)->create();

//        $restaurantNames = array(
//            "Endeavor Restaurant",
//            "Dynamics Restaurant",
//            "Galactic Restaurant",
//            "Cosmos Restaurant",
//            "Flashpoint Restaurant",
//            "Restaurant Cap",
//            "Great Restaurant",
//            "Restaurant Drive",
//            "Restaurant Wizard",
//            "GoldenGate Restaurant",
//            "Restaurant Property",
//            "Restaurant Pros",
//            "Restaurant More",
//            "Pascal Restaurant");
//
//        \DB::table('restaurants')->insert(array(
//            0 =>
//                array(
//                    'id' => 1,
//                    'name' => 'Galactic Restaurant',
//                    'description' => 'Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
//                    'address' => '3515 Rosewood Lane Manhattan, NY 10016',
//                    'latitude' => '37.42796133580664',
//                    'longitude' => '-122.085749655962',
//                    'phone' => '+136 226 5669',
//                    'mobile' => '+163 525 9432',
//                    'information' => '<p>Monday - Thursday 10:00AM - 11:00PM</p><p>Friday - Sunday 12:00PM - 5:00AM</p>',
//                    'admin_commission' => 15.0,
//                    'delivery_fee' => 7.0,
//                    'delivery_range' => 7.0,
//                    'default_tax' => 8.0,
//                    'closed' => 0,
//                    'available_for_delivery' => 1,
//                    'created_at' => '2019-08-30 11:51:04',
//                    'updated_at' => '2020-03-29 17:20:42',
//                ),
//            1 =>
//                array(
//                    'id' => 2,
//                    'name' => 'The Lonesome Dove',
//                    'description' => 'Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
//                    'address' => '2911 Corpening Drive South Lyon, MI 48178',
//                    'latitude' => '37.42196133580664',
//                    'longitude' => '-122.086749655962',
//                    'phone' => '+136 226 5669',
//                    'mobile' => '+163 525 9432',
//                    'information' => '<p>Monday - Thursday 10:00AM - 11:00PM</p><p>Friday - Sunday 12:00PM - 5:00AM</p>',
//                    'admin_commission' => 30.0,
//                    'delivery_fee' => 5.0,
//                    'delivery_range' => 7.0,
//                    'default_tax' => 8.0,
//                    'closed' => 0,
//                    'available_for_delivery' => 1,
//                    'created_at' => '2019-08-30 12:15:09',
//                    'updated_at' => '2020-03-29 17:36:33',
//                ),
//            2 =>
//                array(
//                    'id' => 3,
//                    'name' => 'Golden Palace',
//                    'description' => 'Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
//                    'address' => '2572 George Avenue Mobile, AL 36608',
//                    'latitude' => '37.4226133580664',
//                    'longitude' => '-122.086759655962',
//                    'phone' => '+136 226 5669',
//                    'mobile' => '+163 525 9432',
//                    'information' => '<p>Monday - Thursday 10:00AM - 11:00PM</p><p>Friday - Sunday 12:00PM - 5:00AM<br></p>',
//                    'admin_commission' => 10.0,
//                    'delivery_fee' => 4.0,
//                    'delivery_range' => 7.0,
//                    'default_tax' => 8.0,
//                    'closed' => 0,
//                    'available_for_delivery' => 1,
//                    'created_at' => '2019-08-30 12:17:02',
//                    'updated_at' => '2020-03-29 17:36:19',
//                ),
//            3 =>
//                array(
//                    'id' => 4,
//                    'name' => 'La Perla Restaurant',
//                    'description' => '<p>Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<br></p>',
//                    'address' => '360 Jody Road Chester Heights, PA 19017',
//                    'latitude' => '37.42196233580664',
//                    'longitude' => '-122.086743655962',
//                    'phone' => '+136 226 5669',
//                    'mobile' => '+163 525 9432',
//                    'information' => '<p>Monday - Thursday 10:00AM - 11:00PM</p><p>Friday - Sunday 12:00PM - 5:00AM</p>',
//                    'admin_commission' => 25.0,
//                    'delivery_fee' => 6.0,
//                    'delivery_range' => 7.0,
//                    'default_tax' => 8.0,
//                    'closed' => 0,
//                    'available_for_delivery' => 1,
//                    'created_at' => '2019-10-09 16:12:20',
//                    'updated_at' => '2020-03-29 17:36:09',
//                ),
//        ));


    }
}