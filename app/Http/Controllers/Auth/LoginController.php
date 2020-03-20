<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Service\SSORefererService;
use App\Http\Service\ThirdAccountService;
use App\Providers\RouteServiceProvider;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if($request->has('open_id')) {
            ThirdAccountService::instance()->bind(
                $request->post('platform'),
                $request->post('open_id'),
                $user->id
            );
        }
        redirect()->intended($this->redirectPath());
    }
    public function showLoginForm(Request $request)
    {
        if ($request->has('data')) {
            $qqLoginUrl = route('qq_login',['data' => $request->get('data')]);
        } else {
            $qqLoginUrl = route('qq_login');
        }
        return view('auth.login')->with('qq_login_url',$qqLoginUrl);
    }
    public function redirectPath()
    {
        if (SSORefererService::getSSORefererAppId()) {
            return redirect('/sso/login?data ='. SSORefererService::getUrlQuery());
        }
    }
}
