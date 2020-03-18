<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-12
 * Time: 02:14
 */

namespace App\Http\Service;


use App\Sso\RefererUser;
use Illuminate\Support\Facades\Auth;

class SSORefererService
{
    public static function setSSORefererAppId($refererAppId){
        return RefererUser::setAppId($refererAppId);
    }
    public static function setSSORefererUrl($refererUrl) {
        return RefererUser::setRefererUrl($refererUrl);
    }
    public static function setSSOCallbackUrl($url) {
        return RefererUser::setCallbackUrl($url);
    }
    public static function setCallbackParam($param) {
        return RefererUser::setCallbackParam($param);
    }

    public static function getSSORefererAppId(){
        return RefererUser::getAppId();
    }
    public static function getSSORefererUrl() {
        return RefererUser::getRefererUrl();
    }
    public static function getSSOCallbackUrl() {
        return RefererUser::getCallbackUrl();
    }
    public static function getCallbackParam() {
        return RefererUser::getCallbackParam();
    }

    public static function delRefererLog(){
        return RefererUser::destruct();
    }

}