<?php

use Illuminate\Database\Seeder;

class AdminPermissionRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_permission_role')->delete();
        \DB::table('admin_permission_role')->insert(array(
            0 =>
                array(
                    'permission_id' => 1,
                    'role_id' => 1,
                ),
            1 =>
                array(
                    'permission_id' => 2,
                    'role_id' => 1,
                ),
            2 =>
                array(
                    'permission_id' => 3,
                    'role_id' => 1,
                ),
            3 =>
                array(
                    'permission_id' => 4,
                    'role_id' => 1,
                ),
            4 =>
                array(
                    'permission_id' => 5,
                    'role_id' => 1,
                ),
            5 =>
                array(
                    'permission_id' => 6,
                    'role_id' => 1,
                ),
            6 =>
                array(
                    'permission_id' => 7,
                    'role_id' => 1,
                ),
            7 =>
                array(
                    'permission_id' => 8,
                    'role_id' => 1,
                ),
            8 =>
                array(
                    'permission_id' => 9,
                    'role_id' => 1,
                )
        ));


    }
}