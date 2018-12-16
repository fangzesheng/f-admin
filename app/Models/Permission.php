<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\AdminPermissionInterface;
use App\Models\Traits\AdminPermissionTrait;
class Permission extends Model implements AdminPermissionInterface
{
    use AdminPermissionTrait;
    protected $table = 'admin_permissions';
    public function roleToIds()
    {
        $roles =$this->roles;
        $ids = [];
        if (count($roles) > 0) {
            foreach ($roles as $role) {
                if (is_object($role)) {
                    $ids[] = $role->id;
                } else if (is_array($role) && isset ($role['id'])) {
                    $ids[] = $role['id'];
                }
            }
        }
        return $ids;
    }

    public function menuToIds()
    {
        $menus = $this->menus;
        $ids = [];
        if (count($menus) > 0) {
            foreach ($menus as $menu) {
                if (is_object($menu)) {
                    $ids[] = $menu->id;
                } else if (is_array($menu) && isset ($menu['id'])) {
                    $ids[] = $menu['id'];
                }
            }
        }
        return $ids;
    }
}
