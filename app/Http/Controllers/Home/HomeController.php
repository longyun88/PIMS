<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{
    // 进入函数
    public function in()
    {
        $user = User::where("id",120)->first();
        Auth::login($user,true);
        session()->put('isLog','iamloged');
        session()->put('mine',120);
        session()->put('myID',120);
        session()->put('myDB','db120');
    }
    // 退出函数
    public function out()
    {
        Auth::logout();
        session()->put('isLog','');
        session()->put('mine',0);
        session()->put('myID',0);
        session()->put('myDB','db0');
    }
}
