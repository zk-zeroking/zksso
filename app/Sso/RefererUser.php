<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-03-18
 * Time: 12:59
 */

namespace App\Sso;


class RefererUser
{
    /**
     * @var RefererUser $instance
     */
    private static $instance = null;

    private static $appId = '';
    private static $refererUrl = '';
    private static $callbackUrl = '';
    private static $callbackParam = '';

    private function __construct(){}
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    public static function destruct(){
        return self::$instance = new self();
    }
    public function set($key,$val) {
        if (property_exists($this,$key)){
            self::${$key} = $val;
            return true;
        } else {
            return false;
        }
    }
    public function get($key) {
        if (property_exists($this,$key)){
            return self::${$key};
        } else {
            return '';
        }
    }
    public static function setAppId($id) {
        return self::getInstance()->set('appId',$id);
    }

    public static function setRefererUrl($url) {
        return self::getInstance()->set('refererUrl',$url);
    }

    public static function setCallbackUrl($callbackUrl) {
        return self::getInstance()->set('callbackUrl', $callbackUrl);
    }

    public static function setCallbackParam($param) {
        return self::getInstance()->set('callbackParam',$param);
    }

    public static function getAppId() {
        return self::getInstance()->get('appId');
    }

    public static function getRefererUrl() {
        return self::getInstance()->get('refererUrl');
    }

    public static function getCallbackUrl() {
        return self::getInstance()->get('callbackUrl');
    }

    public static function getCallbackParam() {
        return self::getInstance()->get('callbackParam');
    }
    /**
     * get instance
     * @return RefererUser
     */
    private static function getInstance(){
        if (!(self::$instance instanceof RefererUser)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}