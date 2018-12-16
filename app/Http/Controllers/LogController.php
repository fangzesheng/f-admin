<?php
/**
 * 日志管理
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Controllers;
use App\Models\Log;
use Illuminate\Http\Request;
class LogController extends Controller
{
    /**
     * 日志列表
     */
    public function index(Request $request)
    {
        return $this->show($request);
    }
    /**
     * 根据条件日志列表查询
     */
    public function show(Request $request)
    {
        $sql = Log::with('user.roles');
        $sql->leftJoin(config('admin.user_table') . " as users", "users.id" , "=", "admin_logs.admin_id");
        if(true == $request->has('title')&&true == $request->has('status')) {
            $sql->where('admin_logs.'.$request->input('status'), 'LIKE', '%'.trim($request->input('title')).'%');
        }
        if(true == $request->has('begin')) {
            $sql->where('admin_logs.log_time', '>=', trim($request->input('begin')));
        }
        $sql->select('admin_logs.*');
        $pager = $sql->orderBy('admin_logs.id', 'desc')->paginate()->appends($request->all());
        return view('logs.list', ['pager'=>$pager,'input'=>$request->all()]);
    }
}
