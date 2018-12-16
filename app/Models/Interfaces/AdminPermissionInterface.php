<?php
namespace App\Models\Interfaces;

interface AdminPermissionInterface
{

    /**
     * 与角色的多对多关系.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
    /**
     * 与菜单的多对多关系.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus();

    /**
     * 保存角色
     * @param $roles
     * @return mixed
     */
    public function saveRoles($roles);

    /**
     * 保存菜单
     * @param $menus
     * @return mixed
     */
    public function saveMenus($menus);


}
