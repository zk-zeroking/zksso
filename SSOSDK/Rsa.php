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
     * @return string
     */
    public function encrypt($data) {
        $jsonStr = json_encode($data);
        $encryptStr = '';
        foreach (str_split($jsonStr,117) as $str) {
            $encrypted = '';
            openssl_public_encrypt($str,$encrypted,$this->public_key);
            $encryptStr .= $encrypted;
        }
        return $this->dataHandle($encryptStr,'encrypt');
    }

    /**
     * 解密用私钥加密的参数
     * @param $data
     * @return bool
     */
    public function decrypt($data) {
        $data = $this->dataHandle($data,'decrypt');
        $decryptStr = '';
        foreach (str_split($data,128) as $str) {
            $decrypted='';
            openssl_public_decrypt($str,$decrypted,$this->public_key);
            $decryptStr .= $decrypted;

        }
        return json_decode($decryptStr ,true);
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