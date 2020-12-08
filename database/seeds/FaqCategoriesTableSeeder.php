<?php

use Illuminate\Database\Seeder;

class FaqCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faq_categories')->delete();
        
        \DB::table('faq_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Foods',
                'created_at' => '2019-08-31 12:31:52',
                'updated_at' => '2019-08-31 12:31:52',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Services',
                'created_at' => '2019-08-31 12:32:03',
                'updated_at' => '2019-08-31 12:32:03',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Delivery',
                'created_at' => '2019-08-31 12:32:11',
                'updated_at' => '2019-08-31 12:32:11',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Misc',
                'created_at' => '2019-08-31 12:32:17',
                'updated_at' => '2019-08-31 12:32:17',
            ),
        ));
        
        
    }
}