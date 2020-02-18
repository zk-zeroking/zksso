<?php
/**
 * Created by PhpStorm.
 * User: zeroking
 * Date: 2020-02-19
 * Time: 04:50
 */

namespace App\Http\Service;


use Illuminate\Support\Facades\DB;

class ThirdAccountService
{
    private static $instance;
    private function __construct()
    {
    }
    private function __clone(){}
    public static function instance(){
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function bind($platform,$open_id,$usre_id) {
        $count = DB::table('third_account')
            ->where([
                'platform' => $platform,
                'user_id' =>$usre_id,
                'third_open_id' => $open_id
            ])
            ->count();
        if ($count) {
            return false;
        } else {
            DB::table('third_account')->insert([
                'platform' => $platform,
                'user_id' =>$usre_id,
                'third_open_id' => $open_id
            ]);
            return true;
        }
    }

}