<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-15
 * Time: 02:50
 */

require_once 'SSOConfig.php';

class Rsa
{
    private $public_key = <<<PUBLICKEY

PUBLICKEY;

    private static $instance;
    private function __construct()
    {
        $this->public_key = SSOConfig::instance()->getRsaPublicKey();
    }
    private function __clone(){}
    public static function instance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 用公钥加密参数
     * @param $data
     * @param string $encrypted
     * @return string
     */
    public function encrypt($data,$encrypted = '') {
        $encrypt = openssl_public_encrypt($data,$encrypted,$this->public_key);
        return $this->dataHandle($encrypt,'encrypt');
    }

    /**
     * 解密用私钥加密的参数
     * @param $data
     * @param string $decrypted
     * @return bool
     */
    public function decrypt($data,$decrypted='') {
        $data = $this->dataHandle($data,'decrypt');
        return openssl_public_decrypt($data,$decrypted,$this->public_key);
    }

    private function dataHandle($data, $type = 'encrypt'){
        if ($type == 'encrypt') {
            return base64_encode($data);
        } else if ($type == 'decrypt') {
            return base64_decode($data);
        } else {
            return $data;
        }
    }

}