<?php

use Illuminate\Database\Seeder;

class AdminRoleMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_role_menu')->delete();
        \DB::table('admin_role_menu')->insert(array(
            0 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 1,
                ),
            1 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 2,
                ),
            2 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 3,
                ),
            3 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 4,
                ),
            4 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 5,
                ),
            5 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 6,
                ),
            6 =>
                array(
                    'role_id' => 1,
                    'menu_id' => 7,
                )
        ));
    }
}