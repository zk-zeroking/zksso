<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-15
 * Time: 02:22
 */

namespace App\Http\Service;


class RsaService
{
    private $private_key = <<<PRIVATEKEY
-----BEGIN PRIVATE KEY-----
MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAKRCGPKYEr5NWVJE
uJBg00NCHnR46iM5vdOykcJzmr38aTtxHyJcCJwr1MNoCdPw/CQmOfDi6IptI9ec
311WMKU+VRijUKCIrnFZcdThATptW9HggjB7UVsM1d6k5ks5PTPZVc/59MA3fZm5
+3IS993gZF7RnrMnpQ7qGojnEfjXAgMBAAECgYBxsA30Wq0eagrYlhfoVhvjAXBy
zP3BQ8XPMFkSbVE9DecH7VPPREPxU6T/WpLyzmi13H9d6q9ooAGeykUPJQilOpK2
ee6CFG1d8Nn907PzM6v1a0k935IcNPj8fg6qatBaFGZwqSA4o/7xqpEfB9/XIN7D
C/bqtEG++qAa08ydAQJBAM00MUfd96elx6p6Qq8lEOqiFCloEWgZ+tamy2V8pjUo
4CIXO0PZ75h/vnYuAhNYRPoi4FMJB/Ev/hEog6z10N8CQQDM6ytfNlymQHRqp9gC
cUxp5disi2Veb6gM4zcOlnnMkxSRxGBuIXy1bvhgxeNw9MFwpvgRWx3rtYWJCQQf
EX8JAkBUrYj4gxxDTiHKs5D4/W6xpBh1zcABGVdtZH7ibkGYBjoXV0bZhQFeCLjr
w6iPmwk7v1Cac0uXt5o8Ml/D69w5AkBk9Cre8mo8oZ54+Q2rTmQF++1+PAKJvtp8
1ufF8Q46Ye+NTMDxIOBOhkgpbPR7LqmqNSgbbNdVy4zpER8Nq1H5AkAPGSNCD9px
2fEweq1JlNMNQyvmhsQtKMeP71zOnfqT0x+iCWlACqm65aKI2f5unVM+OHUar4/k
tMYcht0kftqM
-----END PRIVATE KEY-----

PRIVATEKEY;


    private static $instance;
    private function __construct()
    {
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