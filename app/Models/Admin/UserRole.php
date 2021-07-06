<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRole extends Model
{
    use HasFactory;
    protected $table =  'user_role';
    public function getUserRole($uid){
        $user_role = DB::table('user_role')->where(['uid'=>$uid])->first();
        return $user_role;
    }
    public function UpdateUserRole($str,$uid){
        $res =  DB::table('user_role')->where(['uid'=>$uid])->update(['role_id'=>$str]);
        return $res;
    }
}
