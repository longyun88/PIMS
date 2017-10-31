<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LongyunController extends Controller
{
    //
    public function index() 
    {
    	return view("guest");
    }

    public function link()
    {
        return view("longyun.link");
    }
}
