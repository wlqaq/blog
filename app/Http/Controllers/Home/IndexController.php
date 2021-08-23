<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    //首页
	public function index(){
        //获取友情链接
        $tags = DB::table('tags')->where('isfriendly','=','1')->get();
		return \view('home.index',\compact('tags'));
	}
    //留言板
    public function message(){
        return \view('home.message');
    }
    //关于
    public function about(){
	    return \view('home.about');
    }
}
