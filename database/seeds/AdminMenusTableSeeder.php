<?php

use Illuminate\Database\Seeder;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_menus')->delete();
        \DB::table('admin_menus')->insert(array (
            0 => 
                array (
                    'id'            => 1,
                    'parent_id'     => 0,
                    'order'         => 4,
                    'title'         => '权限设置',
                    'icon'          => '&#xe614;',
                    'uri'           => 'url:/qx',
                    'routes'        => 'url:',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            1 =>
                array (
                    'id'            => 2,
                    'parent_id'     => 1,
                    'order'         => 5,
                    'title'         => '用户管理',
                    'icon'          => '&#xe612;',
                    'uri'           => '/users',
                    'routes'        => 'url:/users',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            2 =>
                array (
                    'id'            => 3,
                    'parent_id'     => 1,
                    'order'         => 6,
                    'title'         => '角色管理',
                    'icon'          => '&#xe631;',
                    'uri'           => '/roles',
                    'routes'        => 'url:/roles',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            3 =>
                array (
                    'id'            => 4,
                    'parent_id'     => 1,
                    'order'         => 7,
                    'title'         => '权限管理',
                    'icon'          => '&#xe629;',
                    'uri'           => '/permissions',
                    'routes'        => 'url:/permissions',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            4 =>
                array (
                    'id'            => 5,
                    'parent_id'     => 1,
                    'order'         => 8,
                    'title'         => '菜单管理',
                    'icon'          => '&#xe62a;',
                    'uri'           => '/menus',
                    'routes'        => 'url:/menus',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            5 =>
                array (
                    'id'            => 6,
                    'parent_id'     => 0,
                    'order'         => 1,
                    'title'         => '日志设置',
                    'icon'          => '&#xe632;',
                    'uri'           => '/log',
                    'routes'        => 'url:',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            6 =>
                array (
                    'id'            => 7,
                    'parent_id'     => 6,
                    'order'         => 2,
                    'title'         => '日志管理',
                    'icon'          => '&#xe621;',
                    'uri'           => '/logs',
                    'routes'        => 'url:/logs',
                    'created_at'    => date('Y-m-d H:i:s',time()),
                    'updated_at'    => date('Y-m-d H:i:s',time()),
                ),
            )
        );
    }
}