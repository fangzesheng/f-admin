<?php
/**
 * 用户登陆过后首页以及一些公共方法
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Controllers;
use App\Models\Admin;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class HomeController extends BaseController
{
    /**
     * 后台首页
     */
    public function index() {
        $menu = new Admin();
        return view('admin.index',['menus'=>$menu->menus(),'mid'=>$menu->getMenuId(),'parent_id'=>$menu->getParentMenuId()]);
    }
    /**
     * 验证码
     */
    public function verify(){
        $phrase = new PhraseBuilder;
        $code = $phrase->build(4);
        $builder = new CaptchaBuilder($code, $phrase);
        $builder->setBackgroundColor(255, 255, 255);
        $builder->build(130,40);
        $phrase = $builder->getPhrase();
        Session::flash('code', $phrase); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
    }
    /**
     * 欢迎首页
     */
    public function welcome(){
        return view('admin.welcome',['sysinfo'=>$this->getSysInfo()]);
    }
    /**
     * 排序
     */
    public function changeSort(Request $request){
        $data = $request->all();
        if(is_numeric($data['id'])){
            $res = DB::table('admin_'.$data['name'])->where('id',$data['id'])->update(['order'=>$data['val']]);
            if($res)return $this->resultJson('fzs.common.success', 1);
            else return $this->resultJson('fzs.common.fail', 0);
        }else{
            return $this->resultJson('fzs.common.wrong', 0);
        }
    }
    /**
     * 获取系统信息
     */
    protected function getSysInfo(){
        $sys_info['ip'] 			= GetHostByName($_SERVER['SERVER_NAME']);
        $sys_info['phpv']           = phpversion();
        $sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['time']           = date("Y-m-d H:i:s");
        $sys_info['domain'] 		= $_SERVER['HTTP_HOST'];
        $mysqlinfo = DB::select("SELECT VERSION() as version");
        $sys_info['mysql_version']  = $mysqlinfo[0]->version;
        return $sys_info;
    }
}
