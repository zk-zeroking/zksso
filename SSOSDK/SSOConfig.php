<?php



class SSOConfig{

    private $config =  array(
        'sso_domain' => '',
        'callback_url' => '',//例如：https://yourdomain.com/callback
        'rsa_public_key' => '',
        'app_id' => ''
    );

    private static $instance;
    private function __construct(){}
    private function __clone(){}
    public static function instance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function get($key){
        return $this->config[$key];
    }
    public function getSSODomain(){
        return $this->get('sso_domain');
    }
    public function getCallbackUrl(){
        return $this->get('callback_url');
    }
    public function getRsaPublicKey(){
        return $this->get('rsa_public_key');
    }
    public function getAppId(){
        return $this->get('app_id');
    }
}