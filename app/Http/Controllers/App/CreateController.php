<?php

namespace App\Http\Controllers\App;

use App\App;
use App\Http\Controllers\Controller;
use App\Http\Service\AppService;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function index(){
        $user = AppService::getUserList();
        return view('app.form')->with('users',$user)->with('app',new App());
    }
    public function create(Request $request) {
        $app = new App();
        $app->name = $request->post('name');
        $app->domain = $request->post('domain');
        $app->uuid = md5(env('APP_KEY').$app->domain.time());
        $app->save();
        $app->manageUsers($request->post('admin'));
        echo (json_encode(['msg'=>'success']));exit;

    }
}
