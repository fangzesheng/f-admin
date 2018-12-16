<?php

use Illuminate\Database\Seeder;

class AdminPermissionMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_permission_menu')->delete();
        \DB::table('admin_permission_menu')->insert(array(
            0 =>
                array(
                    'permission_id' => 1,
                    'menu_id' => 2,
                ),
            1 =>
                array(
                    'permission_id' => 2,
                    'menu_id' => 2,
                ),
            2 =>
                array(
                    'permission_id' => 3,
                    'menu_id' => 3,
                ),
            3 =>
                array(
                    'permission_id' => 4,
                    'menu_id' => 3,
                ),
            4 =>
                array(
                    'permission_id' => 5,
                    'menu_id' => 4,
                ),
            5 =>
                array(
                    'permission_id' => 6,
                    'menu_id' => 4,
                ),
            6 =>
                array(
                    'permission_id' => 7,
                    'menu_id' => 5,
                ),
            7 =>
                array(
                    'permission_id' => 8,
                    'menu_id' => 5,
                ),
            8 =>
                array(
                    'permission_id' => 9,
                    'menu_id' => 7,
                )
        ));
    }
}