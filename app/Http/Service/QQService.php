<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-19
 * Time: 03:22
 */

namespace App\Http\Service;

require_once 'QQ_API/qqConnectAPI.php';
class QQService
{
    private static $instance;
    private static $qq;
    private function __construct()
    {
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
}