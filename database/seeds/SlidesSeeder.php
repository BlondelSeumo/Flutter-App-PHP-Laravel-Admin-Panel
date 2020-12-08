<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SlidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('slides')->delete();

        factory(\App\Models\Slide::class, 5)->create();
        try {
            \DB::table('permissions')->insert(array(

                array(
                    'id' => 189,
                    'name' => 'slides.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 190,
                    'name' => 'slides.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 191,
                    'name' => 'slides.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 192,
                    'name' => 'slides.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 193,
                    'name' => 'slides.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 194,
                    'name' => 'slides.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            ));
        } catch (Exception $exception) {
        }
        try {
            \DB::table('role_has_permissions')->insert(array(
                array(
                    'permission_id' => 189,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 190,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 191,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 192,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 193,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 194,
                    'role_id' => 2,
                ),

            ));
        } catch (Exception $exception) {
        }
        try {
            \DB::table('app_settings')->insert(array(
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
        } catch (Exception $exception) {
        }
    }
}
