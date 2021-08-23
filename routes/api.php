<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//前台API控制器
Route::namespace('App\Http\Controllers\Home')->group(function(){
  Route::get('/getmessage/{num}', 'Message@getAllMessage');
  Route::get('/getmesscount','Message@getmesscount'); //留言统计
});


