<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

trait AdminRoleTrait
{
    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;

        $cacheKey = 'admin_permissions_for_role_'.$this->$rolePrimaryKey;
        return Cache::tags(Config::get('admin.permission_role_table'))->remember($cacheKey, Config::get('cache.ttl'), function () {
            return $this->perms()->get();
        });
    }
    public function save(array $options = [])
    {   //both inserts and updates
        $result = parent::save($options);
        Cache::tags(Config::get('admin.permission_role_table'))->flush();
        return $result;
    }
    public function delete(array $options = [])
    {   //soft or hard
        $result = parent::delete($options);
        Cache::tags(Config::get('admin.permission_role_table'))->flush();
        return $result;
    }
    public function restore()
    {   //soft delete undo's
        $result = parent::restore();
        Cache::tags(Config::get('admin.permission_role_table'))->flush();
        return $result;
    }

    /**
     * 与用户的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'), Config::get('admin.role_user_table'),
            Config::get('admin.role_foreign_key'),Config::get('admin.user_foreign_key'));
    }

    /**
     * 与权限的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms()
    {
        return $this->belongsToMany(Config::get('admin.permission'), Config::get('admin.permission_role_table'));
    }

    /**
     * 与菜单的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Config::get('admin.menu'), Config::get('admin.menu_role_table'),
            Config::get('admin.role_foreign_key'), Config::get('admin.menu_foreign_key'));
    }

    /**
     * 当删除的时候,把角色关系也删除
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($role) {
            if (!method_exists(Config::get('admin.role'), 'bootSoftDeletes')) {
                $role->users()->sync([]);
                $role->perms()->sync([]);
                $role->menus()->sync([]);
            }

            return true;
        });
    }

    /**
     * 检查是否有权限
     *
     * @param string|array $name       权限名
     * @param bool         $requireAll All 是否检查全部权限
     *
     * @return bool
     */
    public function hasPermission($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->cachedPermissions() as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * 保存权限
     *
     * @param mixed $inputPermissions
     *
     * @return void
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->perms()->sync($inputPermissions);
        } else {
            $this->perms()->detach();
        }
    }

}
