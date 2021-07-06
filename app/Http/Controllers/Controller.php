<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function ifsuccess($res){
        if ($res){
            $data=[
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        return $data;
    }
    public function ifsuccessMessage($res,$SMessage,$LMessage){
        if ($res){
            $data=[
                'status'=>0,
                'message'=>$SMessage
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>$LMessage
            ];
        }
        return $data;
    }
}
