<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home\Message as ModelsMessage;
use Illuminate\Support\Facades\DB;

class Message extends Controller
{
    //
    public function getAllMessage(Request $request,$num){
        $msg = new ModelsMessage();
        return $msg->getAllmessageByNum($num);
    }
    //留言统计
    public function getmesscount(){
        return DB::table("message")->count();
    }
}
