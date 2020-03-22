<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-13
 * Time: 13:17
 */

namespace App\Http\Controllers;


use App\Http\Service\RsaService;
use App\Http\Service\SSORefererService;
use App\Http\Service\SSOTokenService;
use App\Sso\RefererUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SSOController extends Controller
{
    public function login(){
        var_dump([
            DB::table('app')
                ->leftJoin('app_user','app.id','=','app_user.app_id')
                ->where(['app.uuid' => SSORefererService::getSSORefererAppId(), 'app_user.user_id' => Auth::id()])
                ->toSql(),
            SSORefererService::getSSORefererAppId(),
            Auth::id()
        ]);die();
        if(
            DB::table('app')
                ->leftJoin('app_user','app.id','=','app_user.app_id')
                ->where(['app.uuid' => SSORefererService::getSSORefererAppId(), 'app_user.user_id' => Auth::id()])
                ->count()
        ){
            $callbackParam = SSORefererService::getCallbackParam();
            $userId = Auth::id();
            $param = [
                'user_id' => $userId,
                'callback_param' => $callbackParam,
                'token' => SSOTokenService::createToken($userId,SSORefererService::getSSORefererAppId())
            ];
        } else {
            $param = [
                'errcode' => '10001',
                'errmsg' => 'no auth'
            ];
        }
        $callbackUrl = SSORefererService::getSSOCallbackUrl();

        $data =RsaService::instance()->encrypt($param);
        $url = $callbackUrl .'?data='.$data;
        SSORefererService::delRefererLog();
        header('Location:'.$url);
    }

}