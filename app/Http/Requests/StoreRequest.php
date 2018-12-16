<?php
/**
 * 对于后台提交的数据进行验证类
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        switch (request()->getPathInfo()) {
            case '/menus':
                $rules['category'] = 'required';
                if($mid = request()->input('id'))$rules['name'] = 'required|alpha|between:2,12|unique:admin_menus,title,'.$mid;
                else $rules['name'] = 'required|alpha|between:2,12|unique:admin_menus,title';
                $rules['order']  = 'required|numeric';
                $rules['icon']  = 'required';
                $rules['uri']  = 'required|max:12';
                $rules['roles']  = 'required';
                break;
            case '/users':

                if($uid = request()->input('id')){
                    $rules['user_name'] = 'required|alpha|between:2,12|unique:admin_users,username,'.$uid;
                    $rules['pwd']  = 'nullable|alpha_num|between:6,12|confirmed';
                    $rules['email']  = 'required|email|unique:admin_users,email,'.$uid;

                }else{
                    $rules['user_name'] = 'required|alpha|between:2,12|unique:admin_users,username';
                    $rules['pwd']  = 'required|alpha_num|between:6,12|confirmed';
                    $rules['email']  = 'required|email|unique:admin_users,email';
                    $rules['pwd_confirmation']  = 'required';
                }
                $rules['tel']  = 'required|numeric';
                $rules['sex']  = 'required|numeric';

                $rules['user_role']  = 'required|numeric';
                break;

            case '/roles':

                if($rid = request()->input('id')){
                    $rules['role_remark'] = 'required|between:2,12|alpha|unique:admin_roles,name,'.$rid;
                    $rules['role_name']  = 'required|between:2,12|unique:admin_roles,display_name,'.$rid;
                }else{
                    $rules['role_remark'] = 'required|between:2,12|alpha|unique:admin_roles,name';
                    $rules['role_name']  = 'required|between:2,12|unique:admin_roles,display_name';
                }
                $rules['role_desc'] = 'required|between:2,30';
                $rules['permission_list'] = 'array';
                break;
            case '/permissions':
                if($rid = request()->input('id')){
                    $rules['permission_name'] = 'required|between:2,12|unique:admin_permissions,name,'.$rid;
                    $rules['permission_control'] = 'required|between:2,50|unique:admin_permissions,controllers,'.$rid;

                }else{
                    $rules['permission_name']  = 'required|between:2,12|unique:admin_permissions,display_name';
                    $rules['permission_control'] = 'required|between:2,50|unique:admin_permissions,controllers';

                }
                $rules['permission_desc'] = 'required|between:2,30';
                $rules['permission_remark'] = 'required|alpha|between:2,30';
                $rules['permission_roles'] = 'required|array';
                break;
            case '/saveinfo/1':
                $rules['useremail']  = 'required|email|unique:admin_users,email,'.request()->input('id');
                $rules['usertel']  = 'required|numeric';
                $rules['usersex']  = 'required|numeric';
                break;
            case '/saveinfo/2':
                $rules['oldpwd']  = 'required|alpha_num|between:6,12|different:pwd';
                $rules['pwd']  = 'required|alpha_num|between:6,12|confirmed';
                $rules['pwd_confirmation']  = 'required';
                break;
        }
        return $rules;
    }


    public function response(array $errors)
    {
        if($errors){
            foreach ($errors as $k => $v){
                $msg = $v[0];
                break;
            }
        }
        if ($this->expectsJson()) {
            return response()->json(['status'=>0,'msg'=>$msg]);
        }
        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }

}