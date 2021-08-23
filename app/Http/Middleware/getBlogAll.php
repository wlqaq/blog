<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        if (!Cache::has("bloginfo")){
            $blogall = DB::table('blogall')->where('name','=','niee')->first();
            $blogall = serialize($blogall);
            Cache::add('bloginfo',$blogall);
        }

        view()->composer(
           '*',
            function ($view){
                //dd(unserialize(Cache::get('bloginfo')));
                $blogall = unserialize(Cache::get('bloginfo'));
                $view->with('blogall',$blogall);
            }
        );
        return $next($request);
    }
}
