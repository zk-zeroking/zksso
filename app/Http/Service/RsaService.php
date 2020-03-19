<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-15
 * Time: 02:22
 */

namespace App\Http\Service;


use App\Exceptions\SsoConfigException;
use Illuminate\Support\Facades\Config;

class RsaService
{
    private $private_key = '';
    private $public_key = '';

    private static $instance;
    private function __construct()
    {
        $this->private_key = Config::get('sso.rsa.private_key');
        $this->public_key = Config::get('sso.rsa.public_key');
        if (empty($this->public_key) || empty($this->private_key)) {
            throw new SsoConfigException(SsoConfigException::NO_RSA_KEY);
        }
    }
    private function __clone(){}
    public static function instance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 用私钥加密参数
     * @param $data
     * @return string
     */
    public function encrypt($data) {
        $encrypted = '';
        $data = json_encode($data);
        openssl_private_encrypt($data,$encrypted,$this->private_key);
        return $this->base64Handle($encrypted,'encrypt');
    }

    /**
     * 用公钥加密参数
     * @param $data
     * @return string
     */
    public function pubEncrypt($data) {
        $encrypted = '';
        $data = json_encode($data);
        openssl_private_encrypt($data,$encrypted,$this->public_key);
        return $this->base64Handle($encrypted,'encrypt');
    }

    /**
     * 解密用公钥加密的参数
     * @param $data
     * @return bool
     */
    public function decrypt($data) {
        $decrypted='';
        $data = $this->base64Handle($data,'decrypt');
        openssl_private_decrypt($data,$decrypted,$this->private_key);
        return json_decode($decrypted,true);
    }

    private function base64Handle($data, $type = 'encrypt'){
        if ($type == 'encrypt') {
            return base64_encode($data);
        } else if ($type == 'decrypt') {
            $data = str_replace(' ','+',$data);
            return base64_decode($data);
        } else {
            return $data;
        }
    }
}