<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-15
 * Time: 03:42
 */

namespace App\Http\Service;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SSOTokenService
{
    public static function createToken($userId, $appId, $salt = ''){
        $string = Auth::id() . env('APP_KEY') . time() .$salt;
        $token = md5($string);
        Cache::add($token,[
            'userId' => $userId,
            'appId' => $appId
        ],7200);
        return $token;
    }
    public static function checkToken($token,$appId){
        if (Cache::has($token)) {
            if (Cache::get($token)['appId'] == $appId) {
                return true;
            }
        }
        return false;
    }

}