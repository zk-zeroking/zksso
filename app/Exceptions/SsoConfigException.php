<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-03-19
 * Time: 16:25
 */

namespace App\Exceptions;



use Throwable;

class SsoConfigException extends \Exception
{
    const DEFAULT_MSG = 'sso配置异常';

    const NO_RSA_KEY = 100001;

    private $msg  = [
      self::NO_RSA_KEY => '没有正确配置rsa公钥私钥',
    ];

    public function __construct(int $code = 0, Throwable $previous = null)
    {
        if (isset($this->msg[$code])) {
            $message = $this->msg[$code];
        } else {
            $message = self::DEFAULT_MSG;
        }
        parent::__construct($message, $code, $previous);
    }
}