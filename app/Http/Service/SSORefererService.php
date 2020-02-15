<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-12
 * Time: 02:14
 */

namespace App\Http\Service;


use Illuminate\Support\Facades\Auth;

class SSORefererService
{
    const SSO_REFERER_APP_ID_STRING = 'sso_referfer_app_id_string';
    const SSO_REFERER_URL_STRING = 'sso_referfer_url_string';
    const SSO_CALLBACK_URL_STRING = 'sso_callback_url_string';
    const SSO_CALLBACK_PARAM_STRING = 'sso_callback_PARAM_string';
    const SSO_VISIT_APP_STRING = 'sso_visit_app';

    public static function setSSORefererAppId($refererAppId){
        return self::set(self::SSO_VISIT_APP_STRING, $refererAppId);
    }
    public static function setSSORefererUrl($refererUrl) {
        return self::set(self::SSO_REFERER_URL_STRING, $refererUrl);
    }
    public static function setSSOCallbackUrl($url) {
        return self::set(self::SSO_CALLBACK_URL_STRING, $url);
    }
    public static function setCallbackParam($param) {
        return self::set(self::SSO_CALLBACK_PARAM_STRING,$param);
    }

    public static function getSSORefererAppId(){
        return self::get(self::SSO_VISIT_APP_STRING);
    }
    public static function getSSORefererUrl() {
        return self::get(self::SSO_REFERER_URL_STRING);
    }
    public static function getSSOCallbackUrl() {
        return self::get(self::SSO_CALLBACK_URL_STRING);
    }
    public static function getCallbackParam() {
        return self::get(self::SSO_CALLBACK_PARAM_STRING);
    }

    public static function delRefererLog(){
        return session()->forget([
            self::SSO_VISIT_APP_STRING,
            self::SSO_CALLBACK_PARAM_STRING,
            self::SSO_CALLBACK_URL_STRING,
            self::SSO_REFERER_URL_STRING,
            self::SSO_REFERER_APP_ID_STRING
        ]);
    }
    private static function set($key, $value) {
        return session()->put($key,$value);
    }
    private static function get($key) {
        return session()->get($key,false);
    }

}