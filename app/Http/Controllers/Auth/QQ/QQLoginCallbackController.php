<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-19
 * Time: 03:26
 */

namespace App\Http\Controllers\Auth\QQ;


use App\Http\Controllers\Controller;
use App\Http\Service\QQService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QQLoginCallbackController extends Controller
{
    public function index(Request $request){
        $qq = QQService::instance()->qq();
        $qq->qq_callback();
        $openId = $qq->get_openid();
        $thirdAccount = DB::table('third_account')
            ->where([
                'platform' => 'qq',
                'third_open_id' => $openId
            ]);
        if ($thirdAccount->count()) {
            $thirdAccount = $thirdAccount->get(['user_id']);
            $user = User::find($thirdAccount->get('user_id'));
            Auth::login($user);
            return redirect('/home');
        } else {
            return redirect('/login')->with('open_id',$openId)->with('platform','qq');
        }
    }

}