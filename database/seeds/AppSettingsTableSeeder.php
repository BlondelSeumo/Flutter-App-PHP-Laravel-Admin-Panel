<?php
/**
 * File name: AppSettingsTableSeeder.php
 * Last modified: 2020.05.24 at 18:23:55
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

use Illuminate\Database\Seeder;

class AppSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('app_settings')->delete();

        \DB::table('app_settings')->insert(array(
            array(
                'id' => 7,
                'key' => 'date_format',
                'value' => 'l jS F Y (H:i:s)',
            ),
            array(
                'id' => 8,
                'key' => 'language',
                'value' => 'en',
            ),
            array(
                'id' => 17,
                'key' => 'is_human_date_format',
                'value' => '1',
            ),
            array(
                'id' => 18,
                'key' => 'app_name',
                'value' => 'Food Delivery',
            ),
            array(
                'id' => 19,
                'key' => 'app_short_description',
                'value' => 'Manage Mobile Application',
            ),
            array(
                'id' => 20,
                'key' => 'mail_driver',
                'value' => 'smtp',
            ),
            array(
                'id' => 21,
                'key' => 'mail_host',
                'value' => 'smtp.hostinger.com',
            ),
            array(
                'id' => 22,
                'key' => 'mail_port',
                'value' => '587',
            ),
            array(
                'id' => 23,
                'key' => 'mail_username',
                'value' => 'fooddelivery@smartersvision.com',
            ),
            array(
                'id' => 24,
                'key' => 'mail_password',
                'value' => '',
            ),
            array(
                'id' => 25,
                'key' => 'mail_encryption',
                'value' => 'ssl',
            ),
            array(
                'id' => 26,
                'key' => 'mail_from_address',
                'value' => 'fooddelivery@smartersvision.com',
            ),
            array(
                'id' => 27,
                'key' => 'mail_from_name',
                'value' => 'Smarter Vision',
            ),
            array(
                'id' => 30,
                'key' => 'timezone',
                'value' => 'America/Montserrat',
            ),
            array(
                'id' => 32,
                'key' => 'theme_contrast',
                'value' => 'light',
            ),
            array(
                'id' => 33,
                'key' => 'theme_color',
                'value' => 'primary',
            ),
            array(
                'id' => 34,
                'key' => 'app_logo',
                'value' => '020a2dd4-4277-425a-b450-426663f52633',
            ),
            array(
                'id' => 35,
                'key' => 'nav_color',
                'value' => 'navbar-light bg-white',
            ),
            array(
                'id' => 38,
                'key' => 'logo_bg_color',
                'value' => 'bg-white',
            ),
            array(
                'id' => 66,
                'key' => 'default_role',
                'value' => 'admin',
            ),
            array(
                'id' => 68,
                'key' => 'facebook_app_id',
                'value' => '518416208939727',
            ),
            array(
                'id' => 69,
                'key' => 'facebook_app_secret',
                'value' => '93649810f78fa9ca0d48972fee2a75cd',
            ),
            array(
                'id' => 71,
                'key' => 'twitter_app_id',
                'value' => 'twitter',
            ),
            array(
                'id' => 72,
                'key' => 'twitter_app_secret',
                'value' => 'twitter 1',
            ),
            array(
                'id' => 74,
                'key' => 'google_app_id',
                'value' => '527129559488-roolg8aq110p8r1q952fqa9tm06gbloe.apps.googleusercontent.com',
            ),
            array(
                'id' => 75,
                'key' => 'google_app_secret',
                'value' => 'FpIi8SLgc69ZWodk-xHaOrxn',
            ),
            array(
                'id' => 77,
                'key' => 'enable_google',
                'value' => '1',
            ),
            array(
                'id' => 78,
                'key' => 'enable_facebook',
                'value' => '1',
            ),
            array(
                'id' => 93,
                'key' => 'enable_stripe',
                'value' => '1',
            ),
            array(
                'id' => 94,
                'key' => 'stripe_key',
                'value' => 'pk_test_pltzOnX3zsUZMoTTTVUL4O41',
            ),
            array(
                'id' => 95,
                'key' => 'stripe_secret',
                'value' => 'sk_test_o98VZx3RKDUytaokX4My3a20',
            ),
            array(
                'id' => 101,
                'key' => 'custom_field_models.0',
                'value' => 'App\\Models\\User',
            ),
            array(
                'id' => 104,
                'key' => 'default_tax',
                'value' => '10',
            ),
            array(
                'id' => 107,
                'key' => 'default_currency',
                'value' => '$',
            ),
            array(
                'id' => 108,
                'key' => 'fixed_header',
                'value' => '0',
            ),
            array(
                'id' => 109,
                'key' => 'fixed_footer',
                'value' => '0',
            ),
            array(
                'id' => 110,
                'key' => 'fcm_key',
                'value' => 'AAAAHMZiAQA:APA91bEb71b5sN5jl-w_mmt6vLfgGY5-_CQFxMQsVEfcwO3FAh4-mk1dM6siZwwR3Ls9U0pRDpm96WN1AmrMHQ906GxljILqgU2ZB6Y1TjiLyAiIUETpu7pQFyicER8KLvM9JUiXcfWK',
            ),
            array(
                'id' => 111,
                'key' => 'enable_notifications',
                'value' => '1',
            ),
            array(
                'id' => 112,
                'key' => 'paypal_username',
                'value' => 'sb-z3gdq482047_api1.business.example.com',
            ),
            array(
                'id' => 113,
                'key' => 'paypal_password',
                'value' => 'JV2A7G4SEMLMZ565',
            ),
            array(
                'id' => 114,
                'key' => 'paypal_secret',
                'value' => 'AbMmSXVaig1ExpY3utVS3dcAjx7nAHH0utrZsUN6LYwPgo7wfMzrV5WZ',
            ),
            array(
                'id' => 115,
                'key' => 'enable_paypal',
                'value' => '1',
            ),
            array(
                'id' => 116,
                'key' => 'main_color',
                'value' => '#ea5c44',
            ),
            array(
                'id' => 117,
                'key' => 'main_dark_color',
                'value' => '#ea5c44',
            ),
            array(
                'id' => 118,
                'key' => 'second_color',
                'value' => '#344968',
            ),
            array(
                'id' => 119,
                'key' => 'second_dark_color',
                'value' => '#ccccdd',
            ),
            array(
                'id' => 120,
                'key' => 'accent_color',
                'value' => '#8c98a8',
            ),
            array(
                'id' => 121,
                'key' => 'accent_dark_color',
                'value' => '#9999aa',
            ),
            array(
                'id' => 122,
                'key' => 'scaffold_dark_color',
                'value' => '#2c2c2c',
            ),
            array(
                'id' => 123,
                'key' => 'scaffold_color',
                'value' => '#fafafa',
            ),
            array(
                'id' => 124,
                'key' => 'google_maps_key',
                'value' => 'AIzaSyAT07iMlfZ9bJt1gmGj9KhJDLFY8srI6dA',
            ),
            array(
                'id' => 125,
                'key' => 'mobile_language',
                'value' => 'en',
            ),
            array(
                'id' => 126,
                'key' => 'app_version',
                'value' => implode('.', str_split(substr(config('installer.currentVersion', 'v100'), 1, 3))),
            ),
            array(
                'id' => 127,
                'key' => 'enable_version',
                'value' => '1',
            ),
            array(
                'id' => 128,
                'key' => 'default_currency_id',
                'value' => '1',
            ),
            array(
                'id' => 129,
                'key' => 'default_currency_code',
                'value' => 'USD',
            ),
            array(
                'id' => 130,
                'key' => 'default_currency_decimal_digits',
                'value' => '2',
            ),
            array(
                'id' => 131,
                'key' => 'default_currency_rounding',
                'value' => '0',
            ),
            array(
                'id' => 132,
                'key' => 'currency_right',
                'value' => '0',
            ),
            array(
                'id' => 133,
                'key' => 'home_section_1',
                'value' => 'search',
            ),
            array(
                'id' => 134,
                'key' => 'home_section_2',
                'value' => 'slider',
            ),
            array(
                'id' => 135,
                'key' => 'home_section_3',
                'value' => 'top_restaurants_heading',
            ),
            array(
                'id' => 136,
                'key' => 'home_section_4',
                'value' => 'top_restaurants',
            ),
            array(
                'id' => 137,
                'key' => 'home_section_5',
                'value' => 'trending_week_heading',
            ),
            array(
                'id' => 138,
                'key' => 'home_section_6',
                'value' => 'trending_week',
            ),
            array(
                'id' => 139,
                'key' => 'home_section_7',
                'value' => 'categories_heading',
            ),
            array(
                'id' => 140,
                'key' => 'home_section_8',
                'value' => 'categories',
            ),
            array(
                'id' => 141,
                'key' => 'home_section_9',
                'value' => 'popular_heading',
            ),
            array(
                'id' => 142,
                'key' => 'home_section_10',
                'value' => 'popular',
            ),
            array(
                'id' => 143,
                'key' => 'home_section_11',
                'value' => 'recent_reviews_heading',
            ),
            array(
                'id' => 144,
                'key' => 'home_section_12',
                'value' => 'recent_reviews',
            )
        ));


    }
}