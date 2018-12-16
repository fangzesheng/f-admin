<?php
namespace App\Models\Interfaces;

interface AdminMenuInterface
{

    /**
     * 与角色的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
    /**
     * 与权限的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms();

    /**
     * 保存角色
     * @param $roles
     */
    public function saveRoles($roles);
}
