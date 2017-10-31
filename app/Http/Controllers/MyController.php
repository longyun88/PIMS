<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use DB;
use Session;

use App\Tools\GlobalFunc;
use App\Tools\SQLFunc;

class MyController extends Controller
{
    //use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function index() 
    {
    	header("Content-Type: text/xml;charset=utf-8");  
    	//告诉浏览器不要缓存数据  
		header("Cache-Control: no-cache");
    	$name = "s崔s234";
    	$data = 
    		[
    			'name' => '崔龙云' ,
    			'age' => 241
    		];
    	//return view("my");
    	//return view("my",compact('name'));
    	return view("my",$data);
    }
    
    public function xx() 
    {
    	$name = "s崔s234";
    	$data = 
    		[
    			'name' => '崔龙云' ,
    			'age' => 241
    		];
    	//return view("my");
    	//return view("my",compact('name'));
    	return view("my",$data);
    }
    
    
    public function monitorLog($type,$order) 
	{
		$globalFunc = new GlobalFunc;
		$SQLFunc = new SQLFunc;
		
    	$tableUserLog = "my_home.user_log";
    	$tableUserLogin = "my_home.user_login";
    	
		if($type == "log") {
			//$sql="select * from my_home.user_log order by id desc";
		   $datas = DB::table($tableUserLog)->select('*')->orderBy($order, 'desc')->get();
		} else if($type == "login") {
		   $datas = DB::table($tableUserLogin)->select('*')->orderBy('id', 'desc')->limit(100)->get();
		}
		
		$datas = $SQLFunc->handleMyDataToArray($datas);
		
		if($type == "log") {
			for($i=0;$i<count($datas);$i++) {
				$datas[$i]["registerShow"] =  $globalFunc->_time_switch($datas[$i]["register"]);
				$datas[$i]["lastShow"] =  $globalFunc->_time_switch($datas[$i]["last"]);
			}
			$data["assignHTML"] = view('assign.assignMonitorLog',compact('datas'))->__toString();
		} else if($type == "login") {
			for($i=0;$i<count($datas);$i++) {
				$datas[$i]["timeShow"] =  $globalFunc->_time_switch($datas[$i]["time"]);
			}
			$data["assignHTML"] = view('assign.assignMonitorLogin',compact('datas'))->__toString();
		}
		
    	
		return  view("monitor")->with("data",$data);	
	}
    
	
}
