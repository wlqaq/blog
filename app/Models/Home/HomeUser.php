<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HomeUser extends Model
{
    use HasFactory;
    protected $hidden = ['passwd'];
    protected $table = 'homeuser';
    public function hasHomeUser($email){
        //检查用户
        return DB::table('homeuser')->where(['email'=>$email])->first();
    }
    public function checkPasswd($email,$pass){
        //检查密码
        return  DB::table('homeuser')->where(['email'=>$email,'passwd'=>$pass])->first();
    }
    public static function getIdByEmail($email){
        return DB::table('homeuser')->where('email','=',$email)->first()->id;
    }
    //一对多
    public function message(){
        return $this->hasMany('App\Models\Home\Message','uid','id');
    }
}
