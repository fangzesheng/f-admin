<?php
namespace App\Models\Interfaces;

interface AdminUsersInterface
{
    /**
     * 与角色的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * 检查用户是是否有角色.
     *
     * @param string|array $name       角色名.
     * @param bool         $requireAll 是否有全部请求权限
     *
     * @return bool
     */
    public function hasRole($name, $requireAll = false);

    /**
     * 检查用户是否有权限
     *
     * @param string|array $permission 权限名
     * @param bool         $requireAll 是否有全部请求权限
     *
     * @return bool
     */
    public function can($permission, $requireAll = false);

    /**
     * 保存角色
     *
     * @param mixed $roles
     */
    public function saveRoles($roles);
}