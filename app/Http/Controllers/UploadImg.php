<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImg extends Controller
{
    //
    public function index(Request $Request){
        $path = $Request->file('msgimg')->store('avatars');
        dd($path);
      

    }
}
