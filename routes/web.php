<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//首页
Route::get('/getsession', "App\Http\Controllers\Home\LoginController@getsession"); //gethomeuser
Route::get('/', 'App\Http\Controllers\Home\IndexController@index')->middleware(['getBlogAll']);
Route::get('/message', 'App\Http\Controllers\Home\IndexController@message')->middleware(['getBlogAll']);
//前台登录
Route::post('upload','App\Http\Controllers\UploadImg@index');
Route::namespace('App\Http\Controllers\Home')->group(function(){
    Route::post('/login','LoginController@login');
    Route::post('/home/code','myCenter@checkCode');//验证码验证
    Route::get('/home/mycenter','myCenter@index')->middleware(['getBlogAll']);//个人中心
    Route::post('/message','myCenter@send');//留言
});
Route::namespace('App\Models\Home')->group(function (){
   Route::get('/label','label@getAllLabel');


});

//后台路由Controllers
Route::prefix('admin')->middleware(['getBlogAll'])->namespace('App\Http\Controllers\Admin')->group(function (){
    //登录路由
    Route::get('/login','LoginController@login');
    //退出登录
    Route::get('/loginout','LoginController@loginOut');
    //登录处理
    Route::Post('/dologin','LoginController@dologin');
    Route::get('/login/noassion','LoginController@noassion');
    Route::get('/home/label','LabelController@index');
    Route::middleware(['hasroute','isLogin'])->group(function (){
        //后台首页
        Route::get('/index','IndexController@index')->middleware('App\Http\Middleware\IsLogin');
        //后台欢迎页面
        Route::get('/welcome','IndexController@welcome')->middleware('App\Http\Middleware\IsLogin');
        //角色列表资源路由
        Route::resource('role',"RoleController");
        //权限资源路由
        Route::resource('permission',"PermissionController");//权限路由
        Route::resource('admin',"AdminController");//管理员管理
        Route::get('/role/auth/{id}','RoleController@auth');//添加角色权限路由
        Route::get('/admin/auth/{role_id}','AdminController@auth');
        Route::post('/admin/doauth','AdminController@doauth');
        Route::post('/role/doauth','RoleController@doauth');
        Route::resource('tabs',"TabsController");//标签路由
    });

});
