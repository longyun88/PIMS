<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

//use Request;
use LRedis;

class socketController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('guest');
	}
	public function index()
	{
		return view('socket');
	}
	public function writemessage()
	{
		return view('writemessage');
	}
	public function sendMessage(){
		$redis = LRedis::connection();
		//$redis->publish('message', Request::input('message'));
		//$message = "nihao";
		//$message["name"] = "nihao";
		
		$dataObj = array("name"=>"cui","age"=>12,"myID"=>3);
		//$dataObj = (object)$dataObj;
		//$redis->publish('mychannel', $dataObj);
		$redis->publish('mychannel', json_encode($dataObj));
		
		
		//$message = Request::input('message');
		//$redis->publish('message', $message);
		return redirect('writemessage');
	}
	
	
	public function mySocketTest(Request $request)
	{
		//$para["myID"] = $request->input('id');
		//$para["name"] = $request->input('name');
		$para["myID"] = 120;
		$para["myName"] = "socketName";
		$para["age"] = 20;
    	$jsonData = json_encode($para);
    	
		$redis = LRedis::connection();
		$redis->publish('laravelSessionChannel', $jsonData);
		//LRedis::publish('laravelSessionChannel', $jsonData);
//		
//    	return $jsonData;
	}
}
