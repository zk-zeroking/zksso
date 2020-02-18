<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-19
 * Time: 03:32
 */

namespace App\Http\Controllers\Auth\QQ;


use App\Http\Controllers\Controller;
use App\Http\Service\QQService;

class QQLoginController extends Controller
{
    public function index(){
        QQService::instance()->qq()->qq_login();
    }
}