<?php
/**
 * rbac管理
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Middleware;

use App\Utils\UrlUtils;
use Closure, Log;
use Illuminate\Http\JsonResponse;
use App\Models\Admin;
class Permission
{
    /**
     * 权限处理
     *
     * @access public
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = new Admin();
        $restfulParams = UrlUtils::toRestfulParams();
        $url = $restfulParams[UrlUtils::URL];
        $controller = $restfulParams[UrlUtils::CONTROLLER];
        $method = $restfulParams[UrlUtils::CLASS_METHOD];
        $className = $restfulParams[UrlUtils::CLASS_NAME];
        $requestMethod = $restfulParams[UrlUtils::REAL_METHOD];
        $auth = '';
        $menu = [];
        $permissionName = '';
        $allPermissions = $admin->permissions();
        $permissionRules = [
            strtolower($controller .'@'. $method),
            strtolower($className .'@'. $method),
            strtolower($controller .'@'. $requestMethod),
            strtolower($className .'@'. $requestMethod),
            strtolower($controller),
            strtolower($className),
        ];
        foreach ($permissionRules as $p) {
            if (isset($allPermissions[$p])) {
                $permission = $allPermissions[$p];
                $auth = $permission[config('admin.permission_name')];
                $permissionName = $permission[config('admin.permission_display_name')];
                break;
            }
        }
        $allMenus = $admin->allMenus();
        $urlMatchMaxLen = 0;
        foreach ($allMenus as $m) {
            $params = explode(":", $m['routes']);
            if (empty($params[0]) || empty($params[1])) continue;
            if (($params[0] == 'url' && starts_with($url, $params[1]))) {
                $len = strlen($params[1]);
                if ($len > $urlMatchMaxLen) {
                    $menu = $m;
                }
            } else if($params[0] == 'controller' && in_array(strtolower($params[1]), $permissionRules) ) {
                $menu = $m;
                break;
            }
        }
        if (!empty($menu)) {
            $pmid = isset($menu[config('admin.menu_table_parent_id_key')]) ? $menu[config('admin.menu_table_parent_id_key')] : 0;
            $mid =  isset($menu[config('admin.menu_table_id_key')]) ? $menu[config('admin.menu_table_id_key')] : 0;
            $admin->setMenuId($pmid, $mid);
        }
        if ($admin->hasRole(config('admin.role_admin'))) {
            return $next($request);
        }
        if (!empty($auth)) {
            if (!$admin->can($auth)) {
                if ($request->ajax()) {
                    return new JsonResponse(['msg'=>trans('fzs.common.no_permission'),'status'=>0], 200);
                } else {
                    exit(trans('fzs.common.no_permission'));
                }
            }
        }
        return $next($request);
    }

}