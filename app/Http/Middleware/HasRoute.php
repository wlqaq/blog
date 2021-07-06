<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class HasRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
  //检查用户是否登录
       if(!session()->get('user')){

           return  redirect('/admin/login')->with('errors','你尚未登录');
       }
       //超级管理员
       if(session()->get('root')){
            return $next($request);
       }
       $route = \Route::current()->getActionName();
       if (!session()->get('hasroute')){
            //当前管理员用户
            $user = session()->get('user');

            //根据管理员用户名查找信息
            $uid = DB::table('admin')->where(['name'=>$user])->first()->id;
            if($uid === 1){
                \session()->put('root',$uid);
                return $next($request);
            }
            //查找用户角色权限
            $role = DB::table('user_role')->where(['uid'=>$uid])->first();
            //获取角色id数组
            $role = array_filter(explode(',',$role->role_id));

            $perms = '';
            foreach ($role as $v){
                $perms .= DB::table('role_permission')->where(['role_id'=>$v])->first()->permission;
            }

            //查询权限id并去重
            $permsid = array_unique( array_filter(explode(',',$perms)));

            $perms = [];

            foreach ( $permsid as $v){
                $perms[$v] = DB::table('permission')->where(['id'=>$v])->first()->urls;
            }

            session()->put('hasroute', $perms);
        }



        //判断路由是否在权限列表中
        if (in_array($route,session()->get('hasroute'))){
            return $next($request);

        }else{
           return  redirect('/admin/login/noassion');
        }
        return $next($request);
    }
}
