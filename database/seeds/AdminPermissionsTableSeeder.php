<?php

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_permissions')->delete();
        \DB::table('admin_permissions')->insert(array(
            0 =>
                array(
                    'id'                => 1,
                    'name'              => 'userlist',
                    'display_name'      => '用户管理查看',
                    'description'       => '用户管理查看',
                    'controllers'       => 'UserController@get',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            1 =>
                array(
                    'id'                => 2,
                    'name'              => 'userhandle',
                    'display_name'      => '用户管理编辑',
                    'description'       => '用户管理编辑',
                    'controllers'       => 'UserController@post',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            2 =>
                array(
                    'id'                => 3,
                    'name'              => 'rolelist',
                    'display_name'      => '角色管理查看',
                    'description'       => '角色管理查看',
                    'controllers'       => 'RoleController@get',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            3 =>
                array(
                    'id'                => 4,
                    'name'              => 'rolehandle',
                    'display_name'      => '角色管理编辑',
                    'description'       => '角色管理编辑',
                    'controllers'       => 'RoleController@post',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            4 =>
                array(
                    'id'                => 5,
                    'name'              => 'perlist',
                    'display_name'      => '权限管理查看',
                    'description'       => '权限管理查看',
                    'controllers'       => 'PermissionController@get',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            5 =>
                array(
                    'id'                => 6,
                    'name'              => 'perhandle',
                    'display_name'      => '权限管理编辑',
                    'description'       => '权限管理编辑',
                    'controllers'       => 'PermissionController@post',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            6 =>
                array(
                    'id'                => 7,
                    'name'              => 'menulist',
                    'display_name'      => '菜单管理查看',
                    'description'       => '菜单管理查看',
                    'controllers'       => 'MenuController@get',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            7 =>
                array(
                    'id'                => 8,
                    'name'              => 'menuhandle',
                    'display_name'      => '菜单管理编辑',
                    'description'       => '菜单管理编辑',
                    'controllers'       => 'MenuController@post',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                ),
            8 =>
                array(
                    'id'                => 9,
                    'name'              => 'loglist',
                    'display_name'      => '日志管理查看',
                    'description'       => '日志管理查看',
                    'controllers'       => 'LogController@get',
                    'created_at'        => date('Y-m-d H:i:s',time()),
                    'updated_at'        => date('Y-m-d H:i:s',time()),
                )
        ));
    }
}