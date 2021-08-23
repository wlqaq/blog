<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Server\MailController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Home\HomeUser;
use DB;
class myCenter extends Controller
{
    //
    public function index(){

       return \view('home.mycenter.index');
    }
    public function regedit(Request $request){
        $data = $request->all();
        checkCode($request);
        \dd($data);
    }
    public function checkCode(Request $request){
        //验证验证码
        $this->validate($request, [
            'captcha' => 'required|captcha',
        ],[
            'captcha.required' => trans('请输入验证码'),
            'captcha.captcha' => trans('验证码错误'),
        ]);
        //发送email
        $data = \request()->all();
        //\dd($data);
        $mail = new MailController();
        $code = $mail->send($data['email']);//发送邮箱验证码
       // $code = '111111';//发送邮箱验证码
        //\dd(date('Y-m-d h:i:s'));
        try{
            $res = DB::table('temp_mail_time')->insert(['code'=>$code,'email'=>$data['email'],'datatime'=>date('Y-m-d h:i:s')]);

        }catch(Exception $e) {
         print $e->getMessage();
        }

        return true;

    }
    /**send留言处理
    * 3 尚未登录
    *
    */
    public function send(Request $request){
        $data = $request->all();
        if(empty($data['email'])){
            return 3;
        }
        $uid = HomeUser::getIdByEmail($data['email']);
        $res = DB::table('message')->insert([
            'uid'=>$uid,
            'email'=>$data['email'],
            'content'=>$data['msg']
            ]);
        return $this->ifsuccessMessage($res,"留言成功","留言失败");
    }
    public function about(){
        return view('home.about');
    }

}
