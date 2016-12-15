<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    //用户成功进行登录认证后的跳转页面
    protected $redirectPath = 'auth/dashboard';

    //用户登录认证失败后的跳转页面
    protected $loginPath = 'auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'bindWechat', 'unbindWechat']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function wechat()
    {
        $openid = session('wechat.oauth_user')->id;
        $user = User::where('wechat', $openid)->first();
        if (empty($user)) {
            //如果第一次使用微信登录，则创建一个未命名用户
            $user = User::create([
                'name' => 'unnamed_' . Uuid::uuid(),
                'email' => 'none@email.' . Uuid::uuid(),
                'password' => bcrypt(str_random(40)),
                'wechat' => $openid,
            ]);
        }

        //登录该用户
        Auth::loginUsingId($user->id);

        return redirect(config('wechat.oauth.callback'));
    }

    public function bindWechat()
    {
        $openid = session('wechat.oauth_user')->id;
        $nickname = session('wechat.oauth_user')->nickname;

        $user = Auth::user();
        //已绑定
        if ($user->wechat) {
            return back()->withErrors(trans('auth.wechat.binded', ['nickname' => $nickname]));
        }
        $user->wechat = $openid;
        $user->save();
    }

    public function unbindWechat()
    {
        $user = Auth::user();
        //未绑定
        if (empty($user->wechat)) {
            return back()->withErrors(trans('auth.wechat.unbind'));
        }
        if (empty(array_except($user->loginWay(), ['wechat']))) {
            return back()->withErrors(trans('auth.wechat.only'));
        }
        $user->wechat = '';
        $user->save();
    }
}
