<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use Auth, Session, Image;

use App\UserItem;
use App\Item;

use App\Tools\GlobalFunc;
use App\Tools\SQLFunc;
use App\Tools\ProcessingData;
use App\Tools\Permissions;
use App\Repositories\UserRepository;
use App\Repositories\ItemRepository;
use App\Repositories\RelationRepository;

class EntranceController extends Controller
{
    
    public function index() // 入口函数
    {
		if(Auth::check()) {
			return redirect('/home');
			Session::put('id',Auth::user()->id);
    	} else {
			return redirect('/guest');
			Session::put('id',0);
    	}

    }
    public function loginPage() // 登陆页面
    {
    	return  view('page.login');
    }
    public function logoutPage() // 退出页面
    {
    	Session::forget('isLog');
    	Session::forget('mine');
    	Session::forget('myID');
    	Session::forget('myDB');
    	Session::forget('alert');
		return redirect('/login');
    }
    public function userPage($id) // 退出页面
    {
		$userRepo = new UserRepository;
    	$userInfo = $userRepo->info($id);

    	if(Auth::check()) {
			$my_id = Auth::id();
			if($my_id == $id)
			{
				$relation = 1;
			}
			else
			{
				$relation = 0;
				$relationRepo = new RelationRepository;
				$my_relation = $relationRepo->relation($my_id,$id);
				$his_relation = $relationRepo->relation($id,$my_id);
			}
    	}
		else
		{
			$relation = 0;
			$my_relation = 0;
			$his_relation = 0;
		}
    	
    	$user["id"] = $id;
    	$user["sort"] = $userInfo["sort"];
    	$user["name"] = $userInfo["nickname"];
		$user["relation"] = $relation;
		$user["my_relation"] = empty($my_relation) ? 0 : $my_relation;
		$user["his_relation"] = empty($his_relation) ? 0 : $his_relation;
		return  view("page.user")->with('user',$user);
    }
    public function itemPage($id) // 退出页面
    {
		$itemRepo = new ItemRepository;
		$itemInfo = $itemRepo->info($id);
		if($itemInfo)
		{
			$item_belong_id = $itemInfo->belongId;
			if(Auth::check())
			{
				$my_id = Auth::id();
				if($my_id == $item_belong_id)
				{
					$relation = 1;
					$permission = 21;
				} else
				{
					$relation = 0;
					$relationRepo = new RelationRepository;
					$my_relation = $relationRepo->relation($my_id,$id);
					$his_relation = $relationRepo->relation($id,$my_id);
					if($his_relation != 0 && $his_relation <= 40) $permission = 41;
					else $permission = 99;
				}
			}
			else
			{
				$relation = 0;
				$my_relation = 0;
				$his_relation = 0;
				$permission = 99;
			}
			$item = $itemRepo->get_the_item($id,$permission);
		}

		$user["belong_id"] = empty($item_belong_id) ? 0 : $item_belong_id;
		$user["belong_name"] = empty($item[0]->belongUser->name) ? '' : $item[0]->belongUser->name;
		$user["relation"] = $relation;
		$user["my_relation"] = empty($my_relation) ? 0 : $my_relation;
		$user["his_relation"] = empty($his_relation) ? 0 : $his_relation;

		return  view("page.item")->with(['user' => $user,'datas' => $item]);
    }
    
    public function imageThumb($url) // 小图展示
	{
    	
  		$breaker = 0;
  		//$url = substr($url, 0, -4);
    	$imageUrl = base64_decode($url); // 解密
    	//$imageUrl = decrypt($url); // 解密
    	
    	$httpType = strpos($imageUrl,"http://");
    	$httpsType = strpos($imageUrl,"https://");
    	
  		if( $httpType === 0 || $httpsType === 0 ) // 引用类型
  		{
   			$img = Image::make($imageUrl);
  			$breaker = 1;
  		} else //local
  		{
  			$myImageUrl = public_path($imageUrl);
  			if(is_readable($myImageUrl))
  			{
   				$img = Image::make($myImageUrl);
  				$breaker = 1;
  			} else 
  			{
  				$breaker = 0;
  			}
  		}
  		
  		if($breaker == 1) 
  		{
			//return $img->response('jpg');
	   		$width = $img->width();
	   		$height = $img->height();
	   		if($width >$height)
	   		{
	   			$img->heighten(160);
	   		} else 
	   		{
	   			$img->widen(160);
	   		}
	   		$img->resizeCanvas(160,160);
   			//$img->resize(160,160);
   			//$img->fit(160);
			return $img->response('jpg');
  		}
	}
    
    public function in() // 进入函数
    {
    	Session::put('isLog','iamloged');
    	Session::put('mine',122);
    	Session::put('myID',122);
    	Session::put('myDB','db122');
    }
    public function out() // 退出函数
    {
    	Session::forget('isLog');
    	Session::forget('mine');
    }
    
    function setFunc() 
    {
			return view('setFunc');
    }
    
    function viewDates($datasA,$shower) 
    {
		$processingD = new ProcessingData();
  		$datasP = $processingD->pocessItems($datasA);	// 数组
  		$datas = collect($datasP);	// 集合
		$items = view('assign.item',compact('datas'));
		return  view($shower)->with('items',$items);
    }
    
    
    public function myAll() // 游客 - 时刻
    {
  		$Item = new Item();
		$datasO = $Item->getMyAll();
		for($i=0;$i<count($datasO);$i++) {
			$datasO[$i] = $datasO[$i]["original"];
		}
		dd($datasO);
		//$datasA = $datasO->toArray();	// 数组
		return $this->viewDates($datasO,"home");
    }
    public function homeAll() // 返回 我的主页
    {
//    	if(Session::has('isLog')) {
		if(Auth::check()) {
			$myID = (Auth::check()) ? Auth::user()->id : 0;
	    	Session::put('random',rand(0,999));
			
    		$sqlFunc = new SQLFunc;
    		$userInfo = $sqlFunc->search_user_infos($myID,"all");
	    	Session::put('myName',$userInfo["nickname"]);
	    	
			return  view("page.home");
    	} else {
//    		echo "<script language='javascript' type='text/javascript'>";
//			echo "window.location.href='/login'";
//			echo "</script>";
			return redirect('/login');
    	}
    }
    public function homeAlls() // 测试 geterMineX
    {
    	Session::put('isLog','iamloged');
    	Session::put('mine',122);
    	Session::put('myID',122);
    	Session::put('myDB','db122');
    	
  		$Item = new SQLFunc();
		$datasO = $Item->getMineX(0,'init',0,0); // 返回 数组
		dd($datasO);
		echo $datasO;
    }
   
    
    public function guestAll() // 游客访问主页
    {
//    		$userItem = new UserItem();
//			$datasO = $userItem->getGuestAll();
//    		$datas = $datasO;

//			$datasT = $datasO->toArray();	// 数组
//    		//dd($datasT);
//			$processingD = new ProcessingData();
//    		$datasW = $processingD->pocessItems($datasT);	// 数组
//
//    		
//    		$datas = collect($datasW);	// 集合
//    		
//			$items = view('assign.item',compact('datas'));
//			//$aaa = view('test',compact('datas'));
//			//$aaa = view('test',$datas);
//			//return  view('guest')->with('items',$items);

	    	if(Session::has('isLog')) {
				$guest["login_isset"] = "_none";
				$guest["home_isset"] = "";
	    	} else {
				$guest["login_isset"] = "";
				$guest["home_isset"] = "_none";
	    	}
			//return  view('guest',compact('guest'));
			return  view('page.guest')->with('guest',$guest);
			//return  $guestView;
    }
    public function guestTimer() // 游客 - 时刻
    {
  		$userItem = new UserItem();
		$datasO = $userItem->getGuestAssign(22);
		$datasT = $datasO->toArray();	// 数组
		$processingD = new ProcessingData();
  		$datasW = $processingD->pocessItems($datasT);	// 数组
  		$datas = collect($datasW);	// 集合
		$items = view('assign.item',compact('datas'));
		return  view('page.guest')->with('items',$items);
    }
    public function guestAsk() // 游客 - 提问
    {
  		$userItem = new UserItem();
		$datasO = $userItem->getGuestAssign(24);
		$datasT = $datasO->toArray();	// 数组
		$processingD = new ProcessingData();
  		$datasW = $processingD->pocessItems($datasT);	// 数组
  		$datas = collect($datasW);	// 集合
		$items = view('assign.item',compact('datas'));
		return  view('page.guest')->with('items',$items);
    }
    public function guestGoods() // 游客 - 商品
    {
  		$userItem = new UserItem();
		$datasO = $userItem->getGuestAssign(88);
		$datasT = $datasO->toArray();	// 数组
		$processingD = new ProcessingData();
  		$datasW = $processingD->pocessItems($datasT);	// 数组
  		$datas = collect($datasW);	// 集合
		$items = view('assign.item',compact('datas'));
		return  view('page.guest')->with('items',$items);
    }
    public function guestGive() // 游客 - 闲置
    {
  		$userItem = new UserItem();
		$datasO = $userItem->getGive();
		$datasT = $datasO->toArray();	// 数组
		$processingD = new ProcessingData();
  		$datasW = $processingD->pocessItems($datasT);	// 数组
  		$datas = collect($datasW);	// 集合
		$items = view('assign.item',compact('datas'));
		return  view('page.guest')->with('items',$items);
    }
    
}
