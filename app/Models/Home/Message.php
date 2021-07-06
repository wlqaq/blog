<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Home\HomeUser;

class Message extends Model
{
    use HasFactory;
    protected $table = 'message';
    /**rutrun with name message*/
    public function getAllmessageByNum($num){

        $all =  Message::offset($num)->limit($num*2)->orderBy('createtime')->get();


        foreach($all as $k => $v){
             $all[$k]['name'] = $v->homeuser->name;
             //unset($all[$k]['homeuser']);
        }
        return $all;
    }
    public function homeuser(){
        return $this->belongsTo(HomeUser::class,'uid','id');
    }
}
