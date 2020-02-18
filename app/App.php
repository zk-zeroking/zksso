<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class App extends Model
{
    protected $table = 'app';
    public function manageUsers($users){
        if(!$this->id) {
            throw new \Exception('error');
        }
        $appUsers = DB::table('app_user')->where('app_id',$this->id)->get('user_id');
        if ($appUsers->count() > 0) {
            var_dump(111);die;
            $delUsers = DB::table('app_user')->whereNotIn('user_id',$users)->delete();
            $addUsers = [];
            $appUsersIds = array_values($appUsers);
            foreach ($users as $id) {
                if (!in_array($id,$appUsersIds)) {
                    $addUsers[] = ['app_id' => $this->id, 'user_id'=>$id];
                }
            }
        } else {
            foreach ($users as $id) {
                $addUsers[] = ['app_id' => $this->id, 'user_id'=>$id];
            }
        }
        if (!empty($addUsers)) {
            DB::table('app_user')->insert($addUsers);
        }
    }
}
