<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-19
 * Time: 03:22
 */

namespace App\Http\Service;

use App\Sso\RefererUser;
use Illuminate\Support\Facades\Request;
use League\Flysystem\Config;

require_once 'QQ_API/qqConnectAPI.php';
class QQService
{
    private static $instance;
    private static $qq;
    private function __construct()
    {
        $qqConfig = Config::get('sso.third_platform.qq');
        $qqConfig['callback'] = $this->getCallbackUrl();
        self::$qq = new \QC();
    }
    private function __clone(){}
    public static function instance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function qq(){
        return self::$qq;
    }
    private function getCallbackUrl(){
        $host = Request::server('HTTP_HOST');

        $host = $host . 'qq/login/callback';
        if (RefererUser::isSsoReferer()) {
            $referferData = [
              'app_id' => RefererUser::getAppId(),
              'callback'  => RefererUser::getCallbackUrl(),
                'callback_param' => RefererUser::getCallbackParam(),
            ];
            $referferDataEnt = RsaService::instance()->pubEncrypt($referferData);
            $host = $host . '/' . $referferDataEnt;
        }
        return $host;
    }
}