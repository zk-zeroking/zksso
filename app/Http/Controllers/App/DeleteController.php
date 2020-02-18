<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function del(Request $request) {
        DB::table('app_user')->where('app_id',$request->post('id'))->delete();
        DB::table('app')->delete($request->post('id'));
        echo (json_encode(['msg'=>'success']));exit;
    }
}
