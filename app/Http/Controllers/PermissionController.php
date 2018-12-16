<?php
/**
 * 权限管理
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Controllers;
use App\Http\Requests\StoreRequest;
use App\Models\Log;
use App\Models\Permission;
use App\Models\Role;
use App\Service\DataService;
use Illuminate\Http\Request;
class PermissionController extends BaseController
{
    /**
     * 权限列表
     */
    public function index(){
        return view('permissions.list',['list'=>Permission::get()->toArray()]);
    }
    /**
     * 权限编辑列表
     */
    public function edit($id=0)
    {
        $info = $id?Permission::find($id):[];
        $role = $info?$info->roleToIds():[];
        return view('permissions.edit', ['id'=>$id,'info'=>$info,'roles'=>Role::all(),'rolelist'=>$role]);
    }
    /**
     * 权限增加保存
     */
    public function store(StoreRequest $request){
        $model = new Permission();
        $permission = DataService::handleDate($model,$request->all(),'permissions-add_or_update');
        if($permission['status']==1)Log::addLogs(trans('fzs.permissions.handle_permission').trans('fzs.common.success'),'/permissions/story');
        else Log::addLogs(trans('fzs.permissions.handle_permission').trans('fzs.common.fail'),'/permissions/destroy');
        return $permission;
    }
    /**
     * 权限删除
     */
    public function destroy($id)
    {
        if (is_config_id($id, "admin.permission_table_cannot_manage_ids", false))return $this->resultJson('fzs.permissions.notdel', 0);
        $model = new Permission();
        $permission = DataService::handleDate($model,['id'=>$id],'permissions-delete');
        if($permission['status']==1)Log::addLogs(trans('fzs.permissions.del_permission').trans('fzs.common.success'),'/permissions/destroy/'.$id);
        else Log::addLogs(trans('fzs.permissions.del_permission').trans('fzs.common.fail'),'/permissions/destroy/'.$id);
        return $permission;
    }
}
