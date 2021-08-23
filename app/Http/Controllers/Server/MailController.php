<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    /**
     * $to 发送的邮箱
     *@return 返回邮箱验证码。
     */
    $Redis = New Redis();
    $redis = $Redis->cconnect('127.0.0.1', 6379);
    public function send($to){
        //生成随机数】
       $code = \rand(10000,999999);

       $this->redis->expire($code,30*60);
       Mail::raw('验证码', function ($message) use ($code,$to){
           $message ->to($to)->subject('验证码为:'.$code.'打死都不告诉别人');
       });
        return $code;
    }
    /**
     * $code
     *@return ture过期
     */
    public checkcodetimeout($code){
        return $this->redis->ttl($code) == -2?ture:falsa;
    }
}
