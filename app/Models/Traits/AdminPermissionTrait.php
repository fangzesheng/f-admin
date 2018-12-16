<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Config;

trait AdminPermissionTrait
{

    /**
     * 与角色的多对多关系.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('admin.role'), Config::get('admin.permission_role_table'),
            Config::get('admin.permission_foreign_key'), Config::get('admin.role_foreign_key'));
    }

    /**
     * 与菜单的多对多关系.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Config::get('admin.menu'), Config::get('admin.permission_menu_table'),
            Config::get('admin.permission_foreign_key'), Config::get('admin.menu_foreign_key'));
    }

    /**
     * 保存角色
     * @param $roles
     * @return mixed
     */
    public function saveRoles($roles)
    {
        if (!empty($roles)) {
            $this->roles()->sync($roles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * 保存菜单
     * @param $menus
     * @return mixed
     */
    public function saveMenus($menus)
    {
        if (!empty($menus)) {
            $this->menus()->sync($menus);
        } else {
            $this->menus()->detach();
        }
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($permission) {
            if (!method_exists(Config::get('admin.permission'), 'bootSoftDeletes')) {
                $permission->roles()->sync([]);
                $permission->menus()->sync([]);
            }
            return true;
        });
    }


    /**
     * Controller对应的权限
     * @return array
     */
    public static function controllerPermissions()
    {
        $permissions = static::with('menus')->get()->toArray();
        $methods = [];
        foreach ($permissions as $permission) {
            $controllers = $permission[Config::get('admin.permission_controller')];
            if (!empty($controllers)) {
                $_controllerArr = explode(';', $controllers);
                foreach ($_controllerArr as $str) {
                    $c = explode('@', $str);
                    $controller = strtolower($c[0]);
                    $size = count($c);
                    if ($size > 1) {
                        for($i = 1; $i < $size; $i++) {
                            $method = strtolower($c[$i]);
                            if (empty($method)) {
                                $methods[$controller] = $permission;
                            } else {
                                $methods[$controller.'@'.$method] = $permission;
                            }
                        }
                    } else {
                        $methods[$controller] = $permission;
                    }
                }
            }
        }
        return $methods;
    }
}