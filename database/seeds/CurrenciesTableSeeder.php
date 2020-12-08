<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'US Dollar',
                'symbol' => '$',
                'code' => 'USD',
                'decimal_digits' => 2,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:50:48',
                'updated_at' => '2019-10-22 15:50:48',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Euro',
                'symbol' => '€',
                'code' => 'EUR',
                'decimal_digits' => 2,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:51:39',
                'updated_at' => '2019-10-22 15:51:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Indian Rupee',
                'symbol' => 'টকা',
                'code' => 'INR',
                'decimal_digits' => 2,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:52:50',
                'updated_at' => '2019-10-22 15:52:50',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Indonesian Rupiah',
                'symbol' => 'Rp',
                'code' => 'IDR',
                'decimal_digits' => 0,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:53:22',
                'updated_at' => '2019-10-22 15:53:22',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Brazilian Real',
                'symbol' => 'R$',
                'code' => 'BRL',
                'decimal_digits' => 2,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:54:00',
                'updated_at' => '2019-10-22 15:54:00',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cambodian Riel',
                'symbol' => '៛',
                'code' => 'KHR',
                'decimal_digits' => 2,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:55:51',
                'updated_at' => '2019-10-22 15:55:51',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Vietnamese Dong',
                'symbol' => '₫',
                'code' => 'VND',
                'decimal_digits' => 0,
                'rounding' => 0,
                'created_at' => '2019-10-22 15:56:26',
                'updated_at' => '2019-10-22 15:56:26',
            ),
        ));
        
        
    }
}