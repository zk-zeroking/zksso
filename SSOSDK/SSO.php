<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-15
 * Time: 02:48
 */
require_once 'SSOConfig.php';
require_once 'Rsa.php';
class SSO
{
    private static $instance;
    private function __construct(){}
    private function __clone(){}
    public static function instance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function login($callback_param = ''){
        $ssoDomain = SSOConfig::instance()->getSSODomain();

        $param = array(
            'callback' => SSOConfig::instance()->getCallbackUrl(),
            'app_id' => SSOConfig::instance()->getAppId(),
            'callback_param' =>$callback_param
        );
        $data = Rsa::instance()->encrypt($param);
        header("Location:{$ssoDomain}/sso/login?referer=app&data={$data}");
    }
}