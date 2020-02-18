<?php

namespace App\Http\Controllers\App;

use App\App;
use App\Http\Controllers\Controller;
use App\Http\Service\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function index(Request $request) {

        $user = AppService::getUserList();
        $app = DB::table('app')->where('id',$request->get('id'))->first();
        return view('app.form')->with('app',$app)->with('users',$user);
    }
    public function edit(Request $request) {
        $app = App::find($request->post('id'));
        $app->name = $request->post('name');
        $app->domain = $request->post('domain');
        $app->save();
        $app->manageUsers($request->post('admin'));
        echo (json_encode(['msg'=>'success']));exit;

    }
}
