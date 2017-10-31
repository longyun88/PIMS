<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ItemRepository;

class ItemController extends Controller
{
    //
    public function index() 
    {
    	return view("guest");
    }
}
