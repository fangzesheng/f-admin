<?php
/**
 * 用户登陆
 *
 * @author      fzs
 * @Time: 2017/07/14 15:57
 * @version     1.0 版本号
 */
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers {authenticated as oriAuthenticated;}
    use AuthenticatesUsers {login as doLogin;}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        if($request->input('verity')==session('code'))return $this->doLogin($request);
        else return redirect('/login')->withErrors([trans('fzs.login.false_verify')]);
    }
    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
        Log::addLogs(trans('fzs.login.login_info'),'/login',$user->id);
        return $this->oriAuthenticated($request, $user);
    }

}
