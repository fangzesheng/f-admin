<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Config;

trait AdminMenuTrait
{
    /**
     * 与角色的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('admin.role'), Config::get('admin.menu_role_table'),
            Config::get('admin.menu_foreign_key'), Config::get('admin.role_foreign_key'));
    }

    /**
     * 与权限的多对多关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms()
    {
        return $this->belongsToMany(Config::get('admin.permission'), Config::get('admin.permission_menu_table'),
            Config::get('admin.menu_foreign_key'), Config::get('admin.permission_foreign_key'));
    }

    /**
     * 把权限转成角色ID,并放到到数组的roleIds
     * @param $menu
     * @return mixed
     */
    private static function transRoleIds($menu) {
        if (!empty($menu['roles'])) {
            $menu['roleIds'] = array_map(function ($item){
                return $item['id'];
            }, $menu['roles']);
        }
        else
        {
            $menu['roleIds'] = [];
        }
        return $menu;
    }

    /**
     * 把权限转成权限ID,并放到到数组的permIds
     * @param $menu 菜单数组
     * @return mixed
     */
    private static function transPermIds($menu) {
        if (!empty($menu['perms'])) {
            $menu['permIds'] = array_map(function ($item){
                return $item['id'];
            }, $menu['perms']);
        }
        else
        {
            $menu['permIds'] = [];
        }
        return $menu;
    }

    /**
     * 查找菜单
     * @param $id 菜单ID
     * @return mixed
     */
    public static function find($id)
    {
        return static::with('roles')->find($id);
    }

    /**
     * 查找带权限的菜单
     * @param $id 菜单ID
     * @return array|mixed
     */
    public static function findByRoleId($id)
    {
        $menu = [];
        $menuObj= static::with('roles')->find($id);
        if (!empty($menuObj))
        {
            $menu = $menuObj->toArray();
            $menu = static::transRoleIds($menu);
        }
        return $menu;
    }

    /**
     * 转成树结构
     * @param array $elements 树数组
     * @param int $parentId 上级ID
     * @param array $roleIds 权限ID
     * @return array
     */
    public static function toTree(array $elements = [], $parentId = 0, $roleIds = [])
    {
        $branch = [];

        if (empty($elements)) {
            $elements = static::with('roles', 'perms')->orderByRaw('`order` = 0,`order`')->get()->toArray();
        }

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $element = static::transRoleIds($element);
                $element = static::transPermIds($element);

                if (!empty($element['roleIds']) && !empty($roleIds))
                {
                    $_roles = array_intersect($element['roleIds'], $roleIds);
                    if (empty($_roles)) continue;
                }

                $children = static::toTree($elements, $element['id'], $roleIds);

                if ($children) {
                    $element['children'] = $children;
                }

                $branch[] = $element;
            }
        }

        return $branch;
    }

    /**
     * 设计分支排序
     *
     * @param array $order
     *
     * @return void
     */
    protected static function setBranchOrder(array $order)
    {
        static::$branchOrder = array_flip(array_flatten($order));

        static::$branchOrder = array_map(function ($item) {
            return ++$item;
        }, static::$branchOrder);
    }

    /**
     * 保存树类菜单
     * @param array $tree 树结构
     * @param int $parentId 上级ID
     */
    public static function saveTree($tree = [], $parentId = 0)
    {
        if (empty(static::$branchOrder)) {
            static::setBranchOrder($tree);
        }

        foreach ($tree as $branch) {
            $node = static::find($branch['id']);

            $node->parent_id = $parentId;
            $node->order = static::$branchOrder[$branch['id']];
            $node->save();

            if (isset($branch['children'])) {
                static::saveTree($branch['children'], $branch['id']);
            }
        }
    }


    /**
     * 保存角色
     * @param $roles
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
     * 删除菜单
     * @param array $options
     * @return mixed
     */
    public function delete(array $options = [])
    {
        $children = $this->where('parent_id', $this->id)->get();
        $this->where('parent_id', $this->id)->delete();
        if ($children) {
            foreach ($children as $child) {
                $child->roles()->detach();
                $child->perms()->detach();
            }
        }
        $this->roles()->detach();
        $this->perms()->detach();
        return parent::delete($options);
    }

    /**
     * 得到用户菜单
     * @param $user
     * @return array
     */
    public static function getUserMenu($user) {
        $isAdminHasAllRoles = true;
        $isAdmin = $user->hasRole('admin');
        $roles = $user->cachedRoles();
        $roleIds = [0];
        foreach ($roles as $role)
        {
            $roleIds[] = $role->id;
        }

        if ($isAdminHasAllRoles && $isAdmin) $roleIds = [];
        $menus = static::toTree([], 0, $roleIds);

        return $menus;
    }
}