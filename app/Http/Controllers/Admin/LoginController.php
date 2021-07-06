<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel as AdminModelAlias;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function doLogin(Request $request){
        if ($request->isMethod('post')) {
          $data = $request->all();
          $admin = new AdminModelAlias();

          if ($admin->getName($data['username'])){
            if ($admin->cheakPasswd($data['username'],$data['password'])){

                session()->put('user',$data['username']);
                return redirect('/admin/index');
            }else{
                return redirect('/admin/login')->with('errors','密码有误');
            }
          }else{
              return redirect('/admin/login')->with('errors','用户名不存在');
          }
        }
    }
    public function loginOut(){
        session()->flush();
        return \redirect('/admin/login');
    }
    //没有权限
    public function noassion(){

       return view('admin.noassion');
    }
}
