<?php

use Illuminate\Database\Seeder;

class CouponPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \DB::table('permissions')->insert(array(

                array(
                    'id' => 183,
                    'name' => 'coupons.index',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 184,
                    'name' => 'coupons.create',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 185,
                    'name' => 'coupons.store',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 186,
                    'name' => 'coupons.edit',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 187,
                    'name' => 'coupons.update',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),

                array(
                    'id' => 188,
                    'name' => 'coupons.destroy',
                    'guard_name' => 'web',
                    'created_at' => '2020-08-23 14:58:02',
                    'updated_at' => '2020-08-23 14:58:02',
                    'deleted_at' => NULL,
                ),
            ));

            \DB::table('role_has_permissions')->insert(array(
                array(
                    'permission_id' => 183,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 184,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 185,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 186,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 187,
                    'role_id' => 2,
                ),
                array(
                    'permission_id' => 188,
                    'role_id' => 2,
                ),


                array(
                    'permission_id' => 183,
                    'role_id' => 3,
                ),
                array(
                    'permission_id' => 186,
                    'role_id' => 3,
                ),
                array(
                    'permission_id' => 187,
                    'role_id' => 3,
                ),


                array(
                    'permission_id' => 183,
                    'role_id' => 4,
                ),

                array(
                    'permission_id' => 183,
                    'role_id' => 5,
                ),

            ));
        } catch (Exception $exception) {
        }
    }
}
