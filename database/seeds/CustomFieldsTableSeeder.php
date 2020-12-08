<?php

use Illuminate\Database\Seeder;

class CustomFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('custom_fields')->delete();
        
        \DB::table('custom_fields')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'phone',
                'type' => 'text',
                'values' => NULL,
                'disabled' => 0,
                'required' => 0,
                'in_table' => 0,
                'bootstrap_column' => 6,
                'order' => 2,
                'custom_field_model' => 'App\\Models\\User',
                'created_at' => '2019-09-06 21:30:00',
                'updated_at' => '2019-09-06 21:31:47',
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'bio',
                'type' => 'textarea',
                'values' => NULL,
                'disabled' => 0,
                'required' => 0,
                'in_table' => 0,
                'bootstrap_column' => 6,
                'order' => 1,
                'custom_field_model' => 'App\\Models\\User',
                'created_at' => '2019-09-06 21:43:58',
                'updated_at' => '2019-09-06 21:43:58',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'address',
                'type' => 'text',
                'values' => NULL,
                'disabled' => 0,
                'required' => 0,
                'in_table' => 0,
                'bootstrap_column' => 6,
                'order' => 3,
                'custom_field_model' => 'App\\Models\\User',
                'created_at' => '2019-09-06 21:49:22',
                'updated_at' => '2019-09-06 21:49:22',
            ),
        ));
        
        
    }
}