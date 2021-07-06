<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    //获取用户名
    public function getName($name){
        return DB::table('admin')->where('name','=',$name)->first();
    }
    //检查密码
    public function cheakPasswd($name,$pass){
        $res = DB::table('admin')->where(['name'=>$name,'password'=>$pass])->first();

       return $res;
    }
}
