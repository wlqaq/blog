<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class getBlogAll
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
        //获取博客信息
        $blogall = DB::table('blogall')->where('name','=','niee')->first();
        view()->composer(
           '*',
            function ($view){
                $blogall = DB::table('blogall')->where('name','=','niee')->first();
                $view->with('blogall',$blogall);
            }
        );
        return $next($request);
    }
}
