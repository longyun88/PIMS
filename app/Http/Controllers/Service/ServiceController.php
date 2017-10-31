<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth, DB, Session;

use App\Tools\SQLFunc;
use App\Tools\GlobalFunc;
use App\Tools\ProcessingData;

class ServiceController extends Controller
{
    public function ajaxSetAttaching(Request $request) // 设置 附图
    {
    	$belongId = $request->input('belongId');
    	$itemId = $request->input('itemId');
    	$userItemId = $request->input('userItemId');
    	$attaching = $request->input('attaching');
		
    	$sqlFunc = new SQLFunc;
    	$datas = $sqlFunc->setAttaching($belongId,$itemId,$userItemId,$attaching);
    	
    	$data["log"] = $datas;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
	public function swfUpfile(Request $request) // 上传文件
	{
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
			
		$savePath = 'http://longyun.pub:8080/images/'.$myDB.'/';  //图片存储路径
		$savePicName = time();  //图片存储名称   
    	
//		$src=base64_decode($_POST['pic']);
//		$pic1=base64_decode($_POST['pic1']);   
//		$pic2=base64_decode($_POST['pic2']);  
//		$pic3=base64_decode($_POST['pic3']);  
		
    	$postSrc = $request->input('pic');
    	$postPic1 = $request->input('pic1');
    	$postPic2 = $request->input('pic2');
    	$postPic3 = $request->input('pic3');
    	
		$src=base64_decode($postSrc);
		$pic1=base64_decode($postPic1);   
		$pic2=base64_decode($postPic2);  
		$pic3=base64_decode($postPic3);  
		
		//$file_form = end(explode('.',$pic1));
		
		$file_src = $savePath.$savePicName."_src_".date("YmdHis")."_".rand(100, 999).".jpg";
		$filename162 = $savePath.$savePicName."_162.jpg"; 
		$filename48 = $savePath.$savePicName."_48.jpg"; 
		$filename20 = $savePath.$savePicName."_20.jpg"; 
		
		if($src) {
			file_put_contents($file_src,$src);
		}
		
		//file_put_contents($filename162,$pic1);
		//file_put_contents($filename48,$pic2);
		//file_put_contents($filename20,$pic3);
		
		file_put_contents($file_src,$pic1);
		file_put_contents($savePath."portrait.jpg",$pic1);
		file_put_contents($savePath."portrait_tem.jpg",$pic1);
		
		//$rs['scr'] = $_POST['pic1'];
		$rs['status'] = 1;
		//$rs['picUrl'] = $savePath.$savePicName;
		
		//print json_encode($rs);
		
    	$jsonData = json_encode($rs);
    	return $jsonData;
	}
	public function ajaxProcessPortrait(Request $request) // 处理头像
	{
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
    	$myId = $request->input('myId');
    	$picUrl = $request->input('picUrl');
    	
		$sourcePath = './images/';  //图片存储路径
		$sourceFile = $sourcePath.$picUrl;  //图片存储路径
		$savePath = './images/'.$myDB.'/';  //图片存储路径
		$saveFile = $savePath.$picUrl;  //图片存储路径
		
		//file_put_contents($saveFile,$sourceFile);
		//file_put_contents($savePath."portrait.jpg",$sourceFile);
		//file_put_contents($savePath."portrait_tem.jpg",$sourceFile);
		
		copy($sourceFile,$savePath."portrait.jpg");
		copy($sourceFile,$savePath."portrait_tem.jpg");
		rename($sourceFile,$saveFile);
		
		$return["picUrl"] = $saveFile;
    	$jsonData = json_encode($return);
    	return $jsonData;
	}
	public function ajaxSetSetting(Request $request) // 设置 用户信息
	{
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
    	$type = $request->input('type');
    	$value = $request->input('value');
    	$share = $request->input('share');
    	
	    $sqlFunc = new SQLFunc;
	    $result = $sqlFunc->set_Userlog($myID,$type,$value,$share);
	    
		$return["result"] = "is";
    	$jsonData = json_encode($return);
    	return $jsonData;
	}
	public function ajaxIsPassword(Request $request) // 设置 密码是否正确
	{
    	$myID = $request->input('mine');
    	$password = $request->input('password');
    	
	    $sqlFunc = new SQLFunc;
	    $result = $sqlFunc->is_Password($myID,$password);
		$return["result"] = $result;
    	$jsonData = json_encode($return);
    	return $jsonData;
	}
	
    //

    
    public function ajaxRegisterUser(Request $request) // 注册 新用户
    {
    	$name = $request->input('name');
    	
		$para["sort"] = $request->input('sort');
		$para["name"] = $request->input('name');
		$para["phone"] = $request->input('phone');
		$para["password"] = $request->input('password');
		$para["realname"] = $request->input('realname');
		$para["gender"] = $request->input('gender');
		
	    $sqlFunc = new SQLFunc;
		$return = $sqlFunc->addaNewUser($para);
		
		//$return["log"] = "success";
		//$return["userID"] = $para["sort"].".".$para["realname"];
    	$jsonData = json_encode($return);
    	return $jsonData;
    }

    
    public function ajaxSearchUser(Request $request) // 查找用户
    {
    	$search = $request->input('search');
    	$sqlFunc = new SQLFunc;
    	$datas = $sqlFunc->searchUsers($search);
    	$displayShow = $sqlFunc->showDatasToUser($datas);
		
    	$data["html"] = $displayShow;
    	$data["count"] = count($datas);
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxHandleConnRelation(Request $request) // 处理关系
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
    	$postMyId = $request->input('postMyId');
    	$operate = $request->input('operate');
    	$type = $request->input('type');
    	$objectUserId = $request->input('objectId');
    	$userId = $request->input('userId');
    	$userSort = $request->input('userSort');
    	$postItemId = $request->input('itemId');
    	$postUserItemId = $request->input('userItemId');
    	$ps = $request->input('ps');
    	
    	$time = time();
    	if( isset($myID) ) 
    	{
	    	if($myID == $postMyId)
	    	{
	    		$sqlFunc = new SQLFunc;
		    	if($operate == "addAttention")
		    	{
		    		$datas = $sqlFunc->addRelationAttention($myID,$userId,$userSort,$time);
		    	} else if($operate == "attention_C") 
		    	{
		    		$datas = $sqlFunc->deleteRelationAttention($myID,$userId);
		    	}
		    	$data["status"] = "success";
	    		$data["html"] = $sqlFunc->showTheUser($userId);
	    	} else {
		    	$data["status"] = "fail";
		    	$data["explain"] = "userChanged";
	    	}
    	} else 
    	{
		    	$data["status"] = "fail";
		    	$data["explain"] = "unLog";
    	}
    	
    	
    	
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    
    public function ajaxPermissionS(Request $request) // 获取 权限
    {
    	$type = $request->input('type');
    	$pageVisitor = $request->input('pageVisitor');
    	$pageBelong = $request->input('pageBelong');
    	$itemBelong = $request->input('itemBelong');
    	//$relationWho = $request->input('relationWho');

		
		// 判断是否登录
		if(Auth::check()) { // 登陆
			$myID = Auth::user()->id;
			$myDB = "db".$myID;
			$isLog["log"] = "yes";
			
			// 判断是否更改用户
			if($pageVisitor == $myID) {
				$isLog["change"] = "no";
			} else {
				$isLog["change"] = "yes";
			}
			
			// geter 权限
			if($type == "geter") 
			{
				// 判断 页面 归属关系
				if($pageBelong == "guest") {
					$isLog["belongRelation"] = "Guest";
					$isLog["geterHisPV"] = 98;
				} else if ($pageBelong == $myID) {
					$isLog["belongRelation"] = "MINE";
					$isLog["geterHisPV"] = 0;
				} else {
	    			$sqlFunc = new SQLFunc;
	    			$relation = $sqlFunc->isConnection($pageBelong);
					if($relation == 11) {
						$isLog["belongRelation"] = "Friend";
						$isLog["geterHisPV"] = 41;
					} else {
						$isLog["belongRelation"] = "Stranger";
						$isLog["geterHisPV"] = 98;
					}
				}
			} else if($type == "itemOper") // 操作权限
			{
				// 判断 item 归属关系
				if($itemBelong == $myID) {
					$isLog["itemRelation"] = "MINE";
				} else {
	    			$sqlFunc = new SQLFunc;
	    			$relation = $sqlFunc->isConnection($itemBelong);
					if($relation == 11) {
						$isLog["itemRelation"] = "Friend";
						$isLog["itemHisPV"] = 41;
					} else {
						$isLog["itemRelation"] = "Stranger";
						$isLog["itemHisPV"] = 98;
					}
				}
			}
			
		}
		else { // 没有登录
			$isLog["log"] = "no";
		}
		if($pageBelong == "guest") {
			$isLog["belongRelation"] = "Guest";
			$isLog["geterHisPV"] = 98;
		}

		$data = $isLog;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    
    public function ajaxGetConnection(Request $request) // get Connection
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$type = $request->input('type');
		
    	$sqlFunc = new SQLFunc;
		
		if($type == "getLinkman") {
			$peoples = $sqlFunc->getMyConnection("linkman");
		} else if($type == "getFollow") {
			$peoples = $sqlFunc->getMyConnection("follow");
		} else if($type == "getFans") {
			$peoples = $sqlFunc->getMyConnection("fans");
		} else if($type == "getGroup") {
			$peoples = $sqlFunc->getMyConnection("group");
		} else if($type == "getProject") {
			$peoples = $sqlFunc->getMyConnection("project");
		} 
		
    	$displayShow = $sqlFunc->showDatasToPeople($peoples);
    	//$displayShow = "123";
    	$data["html"] = $displayShow;
    	$jsonData = json_encode($data);
    	return $jsonData;
		
    }
    
    public function ajaxGetWeekNumber(Request $request) // 获取 周数
    {
		date_default_timezone_set('PRC');
	
		$day = $request->input('day');
		$stamp = strtotime($day);
		$weekNum = date("W",$stamp);
		
    	$data["num"] = $weekNum;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxGeterDisp(Request $request) // get Display
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$time = time();
    	
		$id = $request->input('id');
		$type = $request->input('type');
		$geter = $request->input('geter');
		$operate = $request->input('operate');
		$position = $request->input('position');
		$permission = $request->input('permission');
		
		$para["myID"] = $myID;
		$para["id"] = $id;
		$para["type"] = $type;
		$para["geter"] = $geter;
		$para["operate"] = $operate;
		$para["position"] = $position;
		$para["permission"] = $permission;
	
    	$sqlFunc = new SQLFunc;
    	$datas = $sqlFunc->geter($para);
//		dd($datas);
		$itemsCount = count($datas);
		
		if($itemsCount > 0) 
		{
			$processingD = new ProcessingData();
  			$datasP = $processingD->pocessItems($datas);	// 数组
    		$displayShow = $sqlFunc->showDatasToDisp($datasP);
    		$last_Item = $datas[$itemsCount - 1];
    	} else 
    	{
    		$displayShow = "";
    	}
  	
		if($itemsCount < 30) 
		{
    		$data["isset"] = "n";
		} else 
		{
    		$data["isset"] = "y";
		}
		
		
		if($geter == "MyWorking") 
		{
    		$data["location"] = 0;
    		$data["modified"] = 0;
    		$data["mines"] = 0;
		} else if($geter == "MySchedule") 
		{
		} else 
		{
    		if( isset($last_Item["id"]) )
    		{
    			$data["location"] = $last_Item["id"];
    		} else 
    		{
    			$data["location"] = 0;
    		}
    		
    		if( isset($last_Item["modified"]) )
    		{
    			$data["modified"] = $last_Item["modified"];
    		} else 
    		{
    			$data["modified"] = 0;
    		}
    		
    		if( isset($last_Item["MinesId"]) )
    		{
    			$data["mines"] = $last_Item["MinesId"];
    		} else
    		{
    			$data["mines"] = 0;
    		}
		}

    	$data["html"] = $displayShow;
    	$data["count"] = $itemsCount;
    	$jsonData = json_encode($data);
    	return $jsonData;
    	
    }
    public function ajaxGeterSearch(Request $request) // get Search 查找 ITEM
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$belong = $request->input('belong');
		$geter = $request->input('geter');
		$text = $request->input('searchText');
		$getType = $request->input('getType');
		$position = $request->input('position');
		$permission = $request->input('permission');
		
		$belongDB = "db".$belong;
		if($myID == 0) {
			$belongDB = $myDB;
		}
		
    	$sqlFunc = new SQLFunc;
		if($geter == "Guest") {
			$items = $sqlFunc->searchGuestItem($text,$getType,$position,$permission);
		} else {
			$items = $sqlFunc->searchItem($myID,$text,$getType,$position,$permission);
		}
  		
		
		$count = count($items);
		
		if($count >0) {
			for($i=0;$i<count($items);$i++) {
				$items[$i]["theme"] = preg_replace("/(".$text.")/i","<font color='red'>\\1</font>",$items[$i]["theme"]);
				$items[$i]["tag_show"] = preg_replace("/(".$text.")/i","<font color='red'>\\1</font>",$items[$i]["tag"]);
			}
			$locationId = $items[$count- 1]["id"];
    		//$displayShow = $sqlFunc->showDatasToDisp($items);
    		$datas = $items;
			$displayShow = view('assign.item',compact('datas'))->__toString();
		} else {
			$locationId = 0;
			$displayShow = "";
		}
		
		if($count < 30) {
			$isset_more = "n";
		} else {
			$isset_more = "y";
		}
		
		
    	$data["html"] = $displayShow;
    	$data["location"] = $locationId;
    	$data["isset"] = $isset_more;
    	$data["modified"] = 0;
    	$data["mines"] = 0;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxGetSchedule(Request $request) // get Schedule 日程
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
    	
		$geter = $request->input('geter');
		$type = $request->input('type');
		$text = $request->input('text');
		$start = $request->input('start');
		$ended = $request->input('ended');
		
		
		
		if( !isset($myID) || $myID == "" || $myID == "guest" ) 
		{
			$myDB = "db100";
		}
		
		if($geter == "GuestSchedule") 
		{
			$myDB = "db100";
		} else if($geter == "HisSchedule") 
		{
			//$myDB = "db100";
		} 
		
    	$sqlFunc = new SQLFunc;
		$globalF = new GlobalFunc;
		if($type == "month") {
			$stamp = strtotime($text."-1");
			$start = $globalF->_get_month_start_unix($stamp);
			$ended = $globalF->_get_month_ended_unix($stamp);
		
			$agendas = $sqlFunc->getIntervalScheduleData($myDB,$start,$ended);//echo $ended;
			
				for($i=0;$i<count($agendas);$i++)
				{
					$agendas[$i]["time_calendar"] = $text;
				}
			
		} else if($type == "day") {
			$stamp = strtotime($text);
			$start = $globalF->_get_day_start_unix($stamp);
			$ended = $globalF->_get_day_ended_unix($stamp);
	
			$agendas = $sqlFunc->getIntervalScheduleData($myDB,$start,$ended);
		}
		
		$processingD = new ProcessingData();
  		$datasP = $processingD->pocessItems($agendas);	// 数组
    	$displayShow = $sqlFunc->showDatasToDisp($datasP);

    	$data["html"] = $displayShow;
    	$data["count"] = count($agendas);
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxGetTheItem(Request $request)
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
    	
		$belong = $request->input('belong');
		$belongDB = "db".$belong;
		$userItemId = $request->input('userItemId');
		
    	$sqlFunc = new SQLFunc;
		$items = $sqlFunc->showTheItem($userItemId);
		
    	$data["html"] = $items;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxGetTheModify(Request $request) // 
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
    	
		$userItemId = $request->input('userItemId');
		
    	$sqlFunc = new SQLFunc;
		$item = $sqlFunc->getTheItem($userItemId);
		
    	$data["theme"] = $item["theme"];
    	$data["content"] = $item["content"];
    	$data["tag"] = $item["tag"];
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxModifyTag(Request $request) // 修改 关键字 Tag
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
    	$tableUserItem = "my_home.users_Item";
    	
		$userItemId = $request->input('userItemId');
		$tag = $request->input('tag');
		
    	$sqlFunc = new SQLFunc;
    	$sqlFunc->setTheTable($tableUserItem,"tag",$tag,"id",$userItemId);
		$items = $sqlFunc->showTheItem($userItemId);
		
    	$data["html"] = $items;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxAddCommunication(Request $request) // add Communication 添加评论
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
    	
		$operate = $request->input('operate');
		$display = $request->input('display');
		$userItemId = $request->input('userItemId');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$objectId = $request->input('objectId');
		$point = $request->input('point');
		$content = $request->input('content');
		$share = $request->input('share');
		
		$belongDB = "db".$belong;
		
		$para["myID"] = $myID;
		$para["myDB"] = $myDB;
		$para["db"] = $belongDB;
		$para["operate"] = $operate;
		$para["time"] = time();
		$para["userItemId"] = $userItemId;
		$para["belong"] = $belong;
		$para["item"] = $item;
		$para["source"] = $myID;
		$para["object"] = $objectId;
		$para["point"] = $point;
		$para["content"] = $content;
		$para["share"] = $share;
		//$para["version"] = $version;
		
    	$sqlFunc = new SQLFunc;
    	if($operate == "addChat") 
    	{
    		$newCommuId = $sqlFunc->addChat($para);
			$displayShow = $sqlFunc->showTheCommunication($myDB,$newCommuId,$display);
    	}
        else
    	{
    		$newCommuId = $sqlFunc->addComment($para);
			$displayShow = $sqlFunc->showTheCommunication($belongDB,$newCommuId,$display);
    	}
    	
    	$data["html"] = $displayShow;
    	//$data["count"] = count($newCommu);
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxGetCommunication(Request $request) // get Communication 获取评论
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
    	
		$display = $request->input('display');
		$getOperate = $request->input('getOperate');
		$getSort = $request->input('getSort');
		$getType = $request->input('getType');
		$whos = $request->input('whos');
		$belong = $whos;
		$item = $request->input('item');
		$userItemId = $request->input('userItemId');
		$sort = $request->input('sort');
		$location = $request->input('location');
		$permission = $request->input('permission');
		
    	$sqlFunc = new SQLFunc;
    	$communications = $sqlFunc->getCommunication($display,$getOperate,$getSort,$getType,$belong,$item,$userItemId,$sort,1,$location,$permission);
    	$count = count($communications);
    	
		if($count == 0)
		{
			$displayShow = "";
			$count = "0";
			$dataMinId = "0";
			$dataMaxId = "0";
		} else 
		{
    		$minId = $communications[0]["id"];
    		$maxId = $communications[$count-1]["id"];
    		
    		if( $maxId >= $minId ) 
    		{
    			$dataMinId = $minId;
    			$dataMaxId = $maxId;
    		} else 
    		{
    			$dataMinId = $maxId;
    			$dataMaxId = $minId;
    		}
    		
			if($display == "comment") 
			{
				$displayShow = $sqlFunc->showDatasToComment($communications);
			} else if($display == "communication") 
			{
				$displayShow = $sqlFunc->showDatasToCommunication($communications);
			}
		}
    	
    	$data["html"] = $displayShow;
    	$data["count"] = $count;
    	$data["minId"] = $dataMinId;
    	$data["maxId"] = $dataMaxId;
    	
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
/**/
	// Session
    public function ajaxRefreshing(Request $request)
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		$tableUserLog = "my_home.user_log";
		
		$time = time();
		
		$pageSession = $request->input('pageSession');
		$session = Session::get('alert');
		
    	$sqlFunc = new SQLFunc;
		$refresh = $sqlFunc->getTheTable($tableUserLog,"id",$myID);
		$sessionAlert = $refresh["session_alert"];
		$sessionUpdateId = $refresh["session_id"];
		$sessionUpdateTime = $refresh["session_last_time"];
		$sessionReadTime = $refresh["session_read_time"];
	    
		if($sessionAlert > 0) // 提示音
		{
			$data["alert"] = "alert"; // 不提示
		}
		
		if($pageSession != $sessionUpdateId) // 刷新 refreshing
		{
			$data["refresh"] = "refresh"; // 
		} else {
			$data["refresh"] = "refresh"; // 
		}
		if($sessionUpdateTime > $sessionReadTime) // 刷新 refreshing
		{
			$data["refresh"] = "refresh"; // 
		}
		
	    $paraLog["session_alert"] = 0;
	    $paraLog["session_read_time"] = $time;
		DB::table($tableUserLog)->where("id", $myID)->update($paraLog);
	    
		Session::put('alert.id',$sessionUpdateId);
    	$data["sessionNum"] = $sessionUpdateId;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxGetSessionList(Request $request)
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		$tableUserLog = "my_home.user_log";
		$tableMySession = $myDB.".my_Session";
		
		$getType = $request->input('getType');
			
    	$sqlFunc = new SQLFunc;
		$session = $sqlFunc->getTheTable($tableUserLog,"id",$myID);
		$news = $sqlFunc->getTheTable($tableMySession,"sort",9);
		$PM = $sqlFunc->getTheTable($tableMySession,"sort",10);
		
    	$data["sessionUnread"] = $session["session_unread"];
    	$data["newsUnread"] = $news["unreadNum"];
    	$data["PMUnread"] = $PM["unreadNum"];
    	
		$sessionData = $sqlFunc->getMySession($myDB,$getType);
		$displayShow = $sqlFunc->showDatasToSession($sessionData);
		//$displayShow = "123212321";
    	$data["html"] = $displayShow;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxGetSessionWork(Request $request)
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$sort = $request->input('sort');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$userItemId = $request->input('userItemId');
			
    	$sqlFunc = new SQLFunc;
		$sessionWork = $sqlFunc->getSessionWork($sort,$belong,$item,$userItemId);
		$displayShow = $sqlFunc->showDatasToSessionWork($sessionWork);
		
    	$data["html"] = $displayShow;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxSetSessionZero(Request $request)
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$sort = $request->input('sort');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$userItemId = $request->input('userItemId');
		
    	$sqlFunc = new SQLFunc;
		$sqlFunc->setSessionZero($myDB,$sort,$belong,$item);
		
    	$data["log"] = "success";
    	
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxSetSessionDelete(Request $request)
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$sort = $request->input('sort');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$userItemId = $request->input('userItemId');
    }
    
    
    public function ajaxAdderItem(Request $request) // 添加 ITEM
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$db = $myDB;
		
		$time = time();
		
		$operate = $request->input('operate');
		$ItemId =$request->input('item');
		$userItemId = $request->input('userItemId');
		$display = $request->input('display');

		$sort = $request->input('sort');
		$type = $request->input('type');
		$form = $request->input('form');
		if(!isset($type)) {
			$type = 0;
		}
	
		$theme = $request->input('theme');
		$content = $request->input('content');
		$tag = $request->input('tag');
		$attaching = $request->input('attaching');
		$attachment = $request->input('attachment');
		$receiverIds = $request->input('receiverIds');
		
		if($attaching == "") {
			$attaching = NULL;
		} else {
			$attaching = rtrim($attaching,"<|>");
		}
		if($attachment == "") {
			$attachment = NULL;
		}
		
		$price = $request->input('price');
		if(!isset($price)) 
		{
			$price = NULL;
		}
		$working = $request->input('working');
		if(!isset($working)) 
		{
			$working = NULL;
		}
		$importance = $request->input('importance');
		if(!isset($importance)) 
		{
			$importance = NULL;
		}
		
		$quoteBelong = $request->input('quoteBelong');
		$quoteItem = $request->input('quoteItem');
	
		$share = $request->input('share');
		if(!isset($share)) 
		{
			$share = 0;
		}
	
		$timeType = $request->input('timeType');
		if(!isset($timeType)) 
		{
			$timeType = 0;
		}
		$start = $request->input('start');
		$ended = $request->input('ended');
		$remind = $request->input('remind');
		$start_type = $request->input('start_type');
		$ended_type = $request->input('ended_type');
		$remind_type = $request->input('remind_type');
		//$remind = 0;
		//$remind_type = 0;
		
		
		$globalF = new GlobalFunc;
		if($timeType == 1) // 一次性日程
		{ 
				if($start_type == 1) {
					$start = strtotime($start);
				} else if($start_type == 2) {
					$start = strtotime($start);
				} else if($start_type == 0) {
					$start = $globalF->_get_today_start_unix();
				}
	
				if($ended_type == 1) {
					$ended = strtotime($ended);
				} else if($ended_type == 2) {
					$ended = strtotime($ended) + (3600*24-1);
				} else if($ended_type == 0) {
					if($start_type == 0) {
						$ended = $globalF->_get_today_ended_unix();
					} else {
						$ended = $globalF->_get_day_ended_unix($start);
					}
				}
	
				/*if($remind_type == 1) {
					$remind = strtotime($remind);
				} else if($remind_type == 2) {
					$remind = strtotime($remind) + (3600*8);
				} else if($remind_type == 0) {
					$remind = 0;
				}*/
		} else if($timeType == 2) // 周期型日程
		{ 
				$week = date("w");
				$starts = explode("-",$start);
				$start_week = $starts[0];
				$endeds = explode("-",$ended);
				$ended_week = $endeds[0];
				
				if($start_type == 1) {
					$start = strtotime($starts[1]);
					$start = $start + 60*60*24*($start_week - $week);
				} else if($start_type == 2) {
					$start = $globalF->_get_today_start_unix() + 60*60*24*($start_week - $week);
				}
	
				if($ended_type == 1) {
					$ended = strtotime($endeds[1]);
					if($ended_week >= $start_week) {
						$ended = $ended + 60*60*24*($ended_week - $week);
					} else {
						$ended = $ended + 60*60*24*($ended_week + 7 - $week);
					}
				} else if($ended_type == 2) {
					if($ended_week >= $start_week) {
						$ended = $globalF->_get_today_ended_unix() + 60*60*24*($ended_week - $week);
					} else {
						$ended = $globalF->_get_today_ended_unix() + 60*60*24*($ended_week + 7 - $week);
					}
					//$ended = strtotime($ended) + (3600*24-1);
				} else if($ended_type == 0) {
					if($start_type == 0) {
						$ended = $globalF->_get_today_ended_unix();
					} else {
						$ended = $globalF->_get_day_ended_unix($start);
					}
				}
				
				if($start_type == 0) {
					//$start = _get_today_start_unix();
					if($ended_type == 0) {
						$ended = $globalF->_get_today_start_unix();
					} else {
						$start = $globalF->_get_day_start_unix($ended);
					}
				}
		} 
	
		$object = $request->input('objectId');
		
		if($sort == 21) // 可修改性
		{
			$isRevisable = 1;
		} else {
			$isRevisable = 0;
		}
	
		$para["source"] = $myID;
		$para["object"] = $object;
		
		$para["myID"] = $myID;
		$para["my_id"] = $myID;
		$para["db"] = $myDB;
		$para["itemId"] = $ItemId;
		$para["userItemId"] = $userItemId;
		$para["time"] = $time;
		$para["sort"] = $sort;
		$para["type"] = $type;
		$para["form"] = $form;
		$para["timeType"] = $timeType;
		$para["start"] = $start;
		$para["ended"] = $ended;
		$para["remind"] = $remind;
		$para["startType"] = $start_type;
		$para["endedType"] = $ended_type;
		$para["remindType"] = $remind_type;
		$para["theme"] = $theme;
		$para["content"] = $content;
		$para["attaching"] = $attaching;
		$para["attachment"] = $attachment;
		$para["price"] = $price;
		$para["tag"] = $tag;
		$para["share"] = $share;
		$para["working"] = $working;
		$para["importance"] = $importance;
		$para["quoteIS"] = 0;
		$para["isRevisable"] = $isRevisable;
		$para["receiverIds"] = $receiverIds;
		
		
	
    	$sqlFunc = new SQLFunc;
		if($operate == "add") 
		{
			$para["rank"] = 0;
    		$newItem = $sqlFunc->operateAddItem($para);
		} else if($operate == "modify") 
		{
    		$sqlFunc->operateModifyItem($para);
    		$newItem = $userItemId;
		}
		
    	$datas = $sqlFunc->showTheItem($newItem);
    	
    	//$data["html"] = "123";
    	$data["html"] = $datas;
    	$data["itemId"] = $newItem;
    	$data["isset"] = "xyz";
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    
/*
	// item.operation
*/
    public function ajaxItemDelete(Request $request) // item.operation 删除
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$sort = $request->input('sort');
		$userItemId = $request->input('userItemId');

    	$sqlFunc = new SQLFunc;
		$sqlFunc->operateDeleteItem($myDB,$sort,$userItemId);
		
    	$data["sort"] = $sort;
    	$data["name"] = "xyz";
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxItemShare(Request $request) // item.operation 分享
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$operate = $request->input('operate');
		$userItemId = $request->input('userItemId');
		$share = $request->input('share');
		
    	$sqlFunc = new SQLFunc;
		$sqlFunc->modifyAttribute($userItemId,"isShared",$share);
		
		$datas = $sqlFunc->showTheItem($userItemId);
    	$data["html"] = $datas;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxItemFavor(Request $request) // item.operation 点赞
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$operate = $request->input('operate');
		$userItemId = $request->input('userItemId');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$time = time();
		
    	$sqlFunc = new SQLFunc;
    	if($operate == "favorIt")
    	{
			$sqlFunc->addIt("favorIt",$myID,$userItemId,$belong,$item,$time,"",99);
		} else if($operate == "favorCansel") 
		{
			$sqlFunc->canselIt("favorCansel",$myID,$userItemId,$belong,$item,$time,"",99);
		}
		
		$datas = $sqlFunc->showTheItem($userItemId);
    	$data["html"] = $datas;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxItemScore(Request $request) // item.operation 打分
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$operate = $request->input('operate');
		$userItemId = $request->input('userItemId');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$content = $request->input('content');
		$score = $request->input('score');
		$time = time();
		
    	$sqlFunc = new SQLFunc;
		$sqlFunc->addIt("scoreIt",$myID,$userItemId,$belong,$item,$time,$content,$score);
		
		$datas = $sqlFunc->showTheItem($userItemId);
    	$data["html"] = $datas;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxItemAddIt(Request $request) // item.operation 收藏/+待办/+关注
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$operate = $request->input('operate');
		$display = $request->input('display');
		$userItemId = $request->input('userItemId');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$content = $request->input('content');
		$share = $request->input('share');
		
		$time = time();
	
    	$sqlFunc = new SQLFunc;
    	
		if($operate == "collect") 
		{
			$sqlFunc->addIt("collectIt",$myID,$userItemId,$belong,$item,$time,$content,$share);
		} else if($operate == "collect_cansel") 
		{
			$sqlFunc->canselIt("canselCollect",$myID,$userItemId,$belong,$item,$time,$content,$share);
		} else if($operate == "workIt") 
		{
			$sqlFunc->addIt("workIt",$myID,$userItemId,$belong,$item,$time,$content,$share);
		} else if($operate == "workIt_cansel") 
		{
			$sqlFunc->canselIt("canselWork",$myID,$userItemId,$belong,$item,$time,$content,$share);
		} else if($operate == "focusIt") 
		{
			$sqlFunc->addIt("focusIt",$myID,$userItemId,$belong,$item,$time,$content,$share);
		} else if($operate == "focusIt_cansel") 
		{
			$sqlFunc->canselIt("canselFocus",$myID,$userItemId,$belong,$item,$time,$content,$share);
		} 
	
		$belongDB = "db".$belong;
		if($display == "item") {
			$datas = $sqlFunc->showTheItem($userItemId);
		} else if ($display == "note") {
			$datas = $sqlFunc->showTheNote($userItemId);
		} else if ($display == "origin") {
			$datas = "";
		}
		
    	$data["html"] = $datas;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    public function ajaxItemForward(Request $request) // item.operation 转发
    {
		$myID = (Auth::check()) ? Auth::user()->id : 0;
		$myDB = "db".$myID;
		
		$time = time();
		$userItemId = $request->input('userItemId');
		$belong = $request->input('belong');
		$item = $request->input('item');
		$theme = $request->input('theme');
		$share = $request->input('share');
		
		$para["quoteUserItemId"] = $userItemId;
		$para["quoteBelong"] = $belong;
		$para["quoteItem"] = $item;
	
		$para["myID"] = $myID;
		$para["db"] = $myDB;
		$para["source"] = $myID;
		$para["time"] = $time;
		$para["sort"] = 41;
		$para["type"] = 99;
		$para["form"] = 0;
		$para["theme"] = $theme;
		$para["share"] = $share;
		$para["quoteIS"] = 1;
		$para["timeType"] = 0;
		$para["working"] = 0;
		$para["importance"] = NULL;
		$para["price"] = NULL;
		$para["isRevisable"] = 0;
		
    	$sqlFunc = new SQLFunc;
		$newItem = $sqlFunc->operateAddItem($para);
	
		$datas = $sqlFunc->showTheItem($newItem);
		
		//$datas = $userItemId;
    	$data["html"] = $datas;
    	$jsonData = json_encode($data);
    	return $jsonData;
    }
    
    public function ajaxDeleteFile(Request $request) // 删除文件
    {
		$file = $request->input('file');
		$targetFile = public_path().$file;
		if(file_exists($targetFile)) 
		{
			unlink($targetFile);
		}
    }
    public function ajaxUploadify(Request $request) // 上传文件
    {
//		$tokens = $request->input('tokens');
//		$myDB = "db".$tokens;
//		
//	// Define a destination
//		$targetFolder = '../images/'.$myDB.'/'; // Relative to the root
//	
//		//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
//		
//		$sFileName = $_FILES['Filedata']['name'];
//		$sOriginalFileName = $sFileName;
//		$sExtension = substr($sFileName, (strrpos($sFileName, '.') + 1));//找到扩展名
//		$sExtension = strtolower($sExtension);
//		$cFileName = "image_".date("YmdHis")."_".rand(100, 999).".".$sExtension;
//		
//		$tempFile = $_FILES['Filedata']['tmp_name'];
//		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
//		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
//		$targetFile = rtrim($targetPath,'/') . '/' . $cFileName;
//		
//		
//		$attachName = '../images/' . $myDB . '/' . $cFileName;
//		
//	/*	
//		// Validate the file type
//		$fileTypes = array('png','jpg','jpeg','gif','bmp'); // File extensions
//		$fileParts = pathinfo($_FILES['Filedata']['name']);
//		
//		if(in_array(strrpos($fileParts['extension']),$fileTypes)) {
//			move_uploaded_file($tempFile,$targetFile);
//		} else {
//			echo '<br>Invalid file type.';
//		}
//	*/
//		$targetFile = iconv('UTF-8', 'GBK', $targetFile);
//		move_uploaded_file($tempFile,$targetFile);
		//$attachName = '../images/A.png';
		//return $attachName;
    }
    
	public function test()
	{
		echo "ServiceController.php success.";
	}
	
	
}
