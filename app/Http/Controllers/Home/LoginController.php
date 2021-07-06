<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;
use App\Models\Home\HomeUser;
class LoginController extends Controller
{
    public function login(Request $request){
        //验证数据
        $validatedData = $request->validate([
            //验证未通过会返回422错误
            'email' => 'email',
            'passwd' => 'required',
        ]);
        //已登录
        if(\session()->get('homeuser')){
            return  $data=['status'=>0,'message'=>'你已经登录，无须重复'];
        }
        $data = \request()->all();
        if($data){
            $hasHomeUser =new HomeUser();
            //用户密码是否正确
            if($hasHomeUser->hasHomeUser($data['email'])&& $hasHomeUser->checkPasswd($data['email'],$data['passwd'])){
               session()->put('homeuser',$data['email']);
               return  $data=['status'=>0,'message'=>'登录成功'];
            }else{

                return  $data=['status'=>1,'message'=>'用户或密码不正确'];
            }

        }
    }
	public function getsession(){
		return \session()->get('homeuser');
	}
}
