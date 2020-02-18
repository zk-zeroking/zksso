<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index(){
        return view('app.list');
    }
    public function get(Request $request){
        $db = DB::table('app');
        $count = $db->count();
        $list = $db
            ->skip(($request->get('page')-1) * $request->get('limit') )
            ->limit($request->get('limit'))
            ->get()->toArray();
        return json_encode(
            [
                "code"=> 0,
                  "msg"=> 'success',
                  "count"=> $count, //解析数据长度
                  "data"=> $list //解析数据列表
            ]
        );
    }
}
