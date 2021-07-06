<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home\LabelModel;
class Label extends Controller
{
    public function index(){
        $labels = LabelModel::get();
        return $labels;
    }
    //
}
