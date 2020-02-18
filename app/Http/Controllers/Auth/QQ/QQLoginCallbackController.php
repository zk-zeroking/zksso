<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-19
 * Time: 03:26
 */

namespace App\Http\Controllers\Auth\QQ;


use App\Http\Controllers\Controller;
use App\Http\Service\QQService;
use Illuminate\Http\Request;

class QQLoginCallbackController extends Controller
{
    public function index(Request $request){
        $qq = QQService::instance()->qq();
        $qq->qq_callback();
        $openId = $qq->get_openid();

    }

}