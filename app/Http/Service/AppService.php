<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-16
 * Time: 01:20
 */

namespace App\Http\Service;


use Illuminate\Support\Facades\DB;

class AppService
{
    public static function getUserList(){
        $users = DB::table('users')->get(['id','name'])->toArray();
        return $users;
    }

}