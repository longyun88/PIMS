<?php

namespace App\Tools;

use DB, Session, Auth, LRedis;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Tools\GlobalFunc;
use App\Tools\ProcessingData;

use App\Jobs\ProcessAttaching;
use App\Repositories\ItemRepository;


class SQLFunc
{
	use DispatchesJobs;
/*
	创建用户
*/

	public function is_Password($myID,$password) // 判断 密码是否正确
	{
			$prePassword = $this->search_user_infos($myID,"password");
			if($password == $prePassword) {
				return "YES";
			} else {
				return "NO";
			}
	}
	
/*
	// set
*/
	public function search_user_infos($id,$value) // 查找 用户信息
	{
    	$tableUserLog = "my_home.user_log";
    	
    	$datas = DB::table($tableUserLog)->select($tableUserLog.'.*')->where('id', '=', $id)->first();

		$globalF = new GlobalFunc;
		$infos = $globalF->object_array($datas);
 
		if($value == "all") {
			$return = $infos;
		} else if($value == "password") {
			$return = $infos["password"];
		} else if($value == "name") {
			$return = $infos["nickname"];
		} else if($value == "location") {
			$return = $infos["location"];
		} else if($value == "sort") {
			$return = $infos["sort"];
		} else if($value == "type") {
			$return = $infos["type"];
		}

		return $return;

	}
	public function set_Userlog($myID,$type,$value,$share) // 设置 用户信息
	{
		$tableUserLog = "my_home.user_log";
		
		if($type == "password") 
		{
			$paraA["password"] = $value;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "passname") 
		{
			$paraA["passname"] = $value;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "username") 
		{
			$paraA["name"] = $value;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "realname") 
		{
			$paraA["realname"] = $value;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "autograph") 
		{
			$paraA["autograph"] = $value;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "phone") 
		{
			$paraA["phone"] = $value;
			$paraA["phoneShared"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "email") 
		{
			$paraA["email"] = $value;
			$paraA["emailShared"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "company") 
		{
			$values = explode("-",$value);
			$company = $values[0];
			$depart = $values[1];
			$position = $values[2];
			$paraA["emcompanyail"] = $company;
			$paraA["companyDepartment"] = $depart;
			$paraA["companyPosition"] = $position;
			$paraA["companyShared"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "timer") 
		{
			$paraA["timer"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "note") 
		{
			$paraA["note"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "ask") 
		{
			$paraA["ask"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "answer") 
		{
			$paraA["answer"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		} else if($type == "birth") 
		{
			$paraA["birth"] = strtotime($value);
			$paraA["birthShared"] = $share;
			DB::table($tableUserLog)->where('id', $myID)->update($paraA);
		}
	}
	public function setShared($myID,$type,$share) 
	{
		$sql="UPDATE my_home.user_log set {$type}={$share} where id={$myID}"; 
		DB::statement($sql);
	}
	
	public function selectInfos($id) // 查询 uers_item 表字段
	{
    	$tableUserItem = "my_home.users_item";
    	$datas = DB::table($tableUserItem)->select('*')->where('id', $id)->first();
		$globalF = new GlobalFunc;
		$infos = $globalF->object_array($datas);
		return $infos;
	}
	
	
/**/
	// SQL.Operations
	public function getTheTable($table,$whereAttr,$whereValue) // 通用函数 查询某一个字段
	{
    	$datas = DB::table($table)->select('*')->where($whereAttr, $whereValue)->first();
		$globalF = new GlobalFunc;
		$infos = $globalF->object_array($datas);
		return $infos;
	}
	public function getTheTableValue($table,$attr,$whereAttr,$whereValue) // 通用函数 查询某一个字段某一个值
	{
    	$value = DB::table($table)->where($whereAttr, $whereValue)->value($attr);
		return $value;
	}
	public function setTheTable($table,$attr,$value,$whereAttr,$whereValue) // 通用函数 设置一个字段
	{
		DB::table($table)->where($whereAttr, $whereValue)->update([$attr => $value]);
	}
	public function setTableINC($table,$attr,$num,$whereAttr,$whereValue) // 通用函数 递增
	{
		DB::table($table)->where($whereAttr, $whereValue)->increment($attr, $num);
	}
	public function setTableDEC($table,$attr,$num,$whereAttr,$whereValue) // 通用函数 递减
	{
		DB::table($table)->where($whereAttr, $whereValue)->decrement($attr, $num);
	}
	public function getItemRank($id) // 查询user_log itemRank 字段
	{
		$tableUserLog = "my_home.user_log";
    	$itemRank = DB::table($tableUserLog)->where('id', '=', $id)->value("itemRank");
		return $itemRank;
	}
/*
	ITEMs
*/
	public function modifyAttribute($id,$attr,$value) // 更改 users_item 一条属性x
	{
//		$sql="UPDATE my_home.users_item set {$attr}={$value} where id={$id}"; 
		$tableUserItem = "my_home.users_item";
		DB::table($tableUserItem)->where('id', $id)->update([$attr => $value]);
	}
	public function setINC($id,$attr,$num) // 更改 users_item 一条属性 +n
	{
//		$sql="UPDATE my_home.users_item set {$attr} = {$attr} + {$num} where id = {$id}";
		$tableUserItem = "my_home.users_item";
		DB::table($tableUserItem)->where('id', $id)->increment($attr, $num);
	}
	public function setDEC($id,$attr,$num)  // 更改 users_item 一条属性 -n
	{
//		$sql="UPDATE my_home.users_item set {$attr} = {$attr} - {$num} where id = {$id}";
		$tableUserItem = "my_home.users_item";
		DB::table($tableUserItem)->where('id', $id)->decrement($attr, $num);
	}
	// set Attribute
	public function setOrigin($id,$originUserItemId,$originBelong) // 设置 引用	
	{ 
		//$sql="UPDATE my_home.users_item set originUserItemId = {$originUserItemId},originBelong = {$originBelong},originItem = {$originItem} where id = {$id}";
		$tableUserItem = "my_home.users_item";
		$paraA["originUserItemId"] = $originUserItemId;
		$paraA["originBelong"] = $originBelong;
		DB::table($tableUserItem)->where('id', $id)->update($paraA);
            //->update(['originUserItemId' => $originUserItemId,'originBelong' => $originBelong,'originItem' => $originItem]);
	}
	public function setQuote($id,$quoteUserItemId,$quoteBelong,$quoteContent) // 设置 转发
	{ 
		//$sql="UPDATE my_home.users_item set quoteUserItemId = {$quoteUserItemId},quoteBelong = {$quoteBelong},quoteItem = {$quoteItem},quoteContent = {quoteContent} where id = {$id}";
		$tableUserItem = "my_home.users_item";
		$paraA["quoteUserItemId"] = $quoteUserItemId;
		$paraA["quoteBelong"] = $quoteBelong;
		$paraA["quoteContent"] = $quoteContent;
		DB::table($tableUserItem)->where('id', $id)->update($paraA);
	}
	public function setTimer($id,$timeType,$startType,$start,$endedType,$ended,$remindType,$remind) // 设置 时间
	{
			$sql="UPDATE my_home.users_item set timeType={$timeType},
				start_type={$startType},start={$start},ended_type={$endedType},end_time={$ended}
				where id = {$id}";
				//startType={$startType},start={$start},endedType={$endedType},ended={$ended}
				//emindType={$remindType},remind={$remind} where id = {$id}";
		DB::statement($sql);
	}
	public function setAttaching($belong,$item,$userItem,$attaching) // 设置 附图
	{
			$belongDB = "db".$belong;
			$this->modifyAttribute($userItem,"attaching",$attaching);
			return "set Attaching success";
	}
	
/**/
	// 添加 adder item
	public function operateAddItem($para) // 添加 item
	{

		$tableUserLog = "my_home.user_log";
		$tableUserItem = "my_home.users_item";
		
		$myID = $para["myID"];
		$db = $para["db"];
		$time = $para["time"];
		$sort = $para["sort"];
		$type = $para["type"];
		$form = $para["form"];
		$share = $para["share"];
		
		/**/
//		$id = $this->insertTheItem($para);
//		$para["item"] = $id;
		if(!isset($para["belong"])) 
		{
			$para["belong"] = $myID;
		}
		$this->setTableINC($tableUserLog,'itemRank',1,'id',$myID);
		$myRank = $this->getItemRank($myID);
		$para["item"] = $myRank;
//        $userItemId = $this->insertUsersItem($para);
        $itemRepo = new ItemRepository;
        $insertItem = $itemRepo->insert_item($para);
        $userItemId = $insertItem->id;


        // 是否引用
		if( !isset($para["quoteIS"]) )  $quoteIS = 0;
        else $quoteIS = $para["quoteIS"];
		
		if($quoteIS == 1) // 引用 （转发）
		{ 
			$quoteUserItemId = $para["quoteUserItemId"];
			$quoteBelong = $para["quoteBelong"];
			
			if($sort == 41) $this->setINC($quoteUserItemId,"forwardNum",1);
			
			$infos = $this->selectInfos($quoteUserItemId);
			if( isset($infos["originBelong"]) ) 
			{
				$originUserItemId = $infos["originUserItemId"];
				$originBelong = $infos["originBelong"];
				if( !isset($infos["theme"]) && !isset($infos["content"]) ) 
				{
					//$quoteContent = "@".$quoteBelong." //".$infos["quoteContent"];
					$quoteContent = "@".$quoteBelong.'.'.$quoteUserItemId." // ".$infos["quoteContent"];
				} else {
					if( !isset($infos["quoteContent"]) ) 
					{
						//$quoteContent = "@".$quoteBelong." : ".$infos["theme"]."  ".$infos["content"]."".$infos["quoteContent"];
						$quoteContent = "@".$quoteBelong.'.'.$quoteUserItemId.": ".$infos["theme"]." ".$infos["content"]."".$infos["quoteContent"];
					} else 
					{
						//$quoteContent = "@".$quoteBelong." : ".$infos["theme"]."  ".$infos["content"]."//".$infos["quoteContent"];
						$quoteContent = "@".$quoteBelong.'.'.$quoteUserItemId.": ".$infos["theme"]." ".$infos["content"]."// ".$infos["quoteContent"];
					}
				}
			} else {
				$originUserItemId = $quoteUserItemId;
				$originBelong = $quoteBelong;
				$quoteContent = NULL;
			}
			$this->setOrigin($userItemId,$originUserItemId,$originBelong);
			$this->setQuote($userItemId,$quoteUserItemId,$quoteBelong,$quoteContent);
		}

        else if($para["sort"] == 19) // 添加私信 // $addId = addPM($para);
		{
			$receiverIds = $para["receiverIds"];
			$receiverIds = rtrim($receiverIds,"|");
			$this->modifyAttribute($userItemId,"receiverIds",$receiverIds); // 收件人
			$receivers = explode("|",$receiverIds);
			if( count($receivers) == 1 ) 
			{
				$this->modifyAttribute($userItemId,"objectId",$receiverIds); // 收件人
			}
			$this->sendPM($receivers,$myID,$id,$userItemId,$time);
		}

		return $addId;
	}
	public function operateModifyItem($para) // 修改内容
	{
		$db = $para["db"];
		$itemId = $para["itemId"];
		$userItemId = $para["userItemId"];
		$time = $para["time"];
    	$tableUserItem = "my_home.users_Item";
		$tableMyMines = $db.".my_Mines";
		
		$this->modifyContent($para);
		$this->setINC($userItemId,"version",1);
		
    	$this->setTheTable($tableUserItem,"modified",$time,"id",$userItemId);
		$this->setTheTable($tableMyMines,"modified",$time,"userItemId",$userItemId);
		
	}
	public function sendPM($receivers,$myID,$itemId,$userItemId,$time) // PM 私信
	{
		for($i=0;$i<count($receivers);$i++)
		{
			if( $receivers[$i] != $myID ) 
			{
				$receiverId = $receivers[$i];
				$receiverDB = "db".$receivers[$i];
				
				$mineId = $this->insertMyMine($receiverDB,19,2,0,$userItemId);
				//$this->setMyInfoINC($receiverDB,19,"unread",1); 
				$this->addSession($receiverId,9,1,$myID,$itemId,$userItemId,0,$time);
			}
		}
	}
	public function insertUsersItem($para) // 插入 users_item 表
	{
		$tableUsersItem = "my_home.users_item";
		
		$paraA["time"] = $para["time"];
		$paraA["modified"] = $para["time"];
		$paraA["sort"] = $para["sort"];
		$paraA["type"] = $para["type"];
		$paraA["form"] = $para["form"];
		$paraA["belongId"] = $para["belong"];
		$paraA["itemId"] = $para["item"];
		$paraA["sourceId"] = $para["source"];
		if(!isset($para["object"])) // 对象
		{
			$paraA["objectId"] = NULL;
		} else {
			$paraA["objectId"] = $para["object"];
		}
		if(!isset($para["theme"])) // 主题
		{
			$paraA["theme"] = NULL;
		} else {
			$paraA["theme"] = $para["theme"];
		}
		if(!isset($para["content"])) // 内容
		{
			$paraA["content"] = "";
		} else {
			$paraA["content"] = $para["content"];
		}
		if(!isset($para["attaching"])) // 附图
		{
			$paraA["attaching"] = NULL;
		} else {
			$paraA["attaching"] = $para["attaching"];
			$thisAttaching = $para["attaching"]; 
			dispatch(new ProcessAttaching($thisAttaching));
		}
		if(!isset($para["attachment"])) // 附件
		{
			$paraA["attachment"] = NULL;
		} else {
			$paraA["attachment"] = $para["attachment"];
		}
		if(!isset($para["tag"])) // 关键字
		{
			$paraA["tag"] = NULL;
		} else {
			$paraA["tag"] = $para["tag"];
		}
		$paraA["isShared"] = $para["share"];
		
		$userItemId = DB::table($tableUsersItem)->insertGetId($paraA);
		return $userItemId;
	}
	public function insertMyMines($para) // 插入 my_Mines 表
	{
		$db = $para["db"];
		$tableMyMines = $db.".my_Mines";
		
		$paraA["sort"] = $para["sort"];
		$paraA["type"] = $para["type"];
		$paraA["form"] = $para["form"];
		$paraA["belongType"] = $para["belongType"];
		$paraA["userItemId"] = $para["userItemId"];
		$paraA["belongId"] = $para["belongId"];
		$paraA["itemId"] = $para["itemId"];
		$paraA["time"] = $para["time"];
		$paraA["modified"] = $para["time"];
		$paraA["timeType"] = $para["timeType"];
		if($paraA["timeType"] != 0)
		{
			$paraA["start_time"] = $para["start_time"];
			$paraA["end_time"] = $para["end_time"];
			$paraA["isFocused"] = $para["isFocused"];
		}
		$paraA["isWorked"] = $para["isWorked"];
		if($paraA["isWorked"] != 0)
		{
			$paraA["importance"] = $para["importance"];
		}
		$paraA["isShared"] = $para["isShared"];
		$minesId = DB::table($tableMyMines)->insertGetId($paraA);
		return $minesId;
	}
	public function isset_myMines($db,$userItemId) // 
	{
		$tableMyMines = $db.".my_Mines";
    	$datas = DB::table($tableMyMines)->select('*')->where('userItemId', '=', $userItemId)->first();

    	if( isset($datas) ) {
			$globalF = new GlobalFunc;
			$exist = $globalF->object_array($datas);
    	} else {
			$exist = 0;
    	}
		return $exist;
	}
	public function modifyContent($para)  // 修改字段内容
	{
//		$sql="UPDATE my_home.users_item set 
//			theme=:theme,content=:content,attaching=:attaching,attachment=:attachment,tag=:tag,modified=:last where id=:id";
//		$sql="UPDATE my_home.users_item set theme=:theme,content=:content,tag=:tag,modified=:last where id=:id";
		
		$userItemId = $para["userItemId"];
		$paraA["theme"] = $para["theme"];
		$paraA["content"] = $para["content"];
		$paraA["tag"] = $para["tag"];
		$paraA["modified"] = $para["time"];
		if( isset($para["attaching"]) ) 
		{
			$paraA["attaching"] = $para["attaching"];
		}
		if( isset($para["attachment"]) ) 
		{
			$paraA["attachment"] = $para["attachment"];
		}
		//$share = $para["share"];
		
		$tableUserItem = "my_home.users_item";
		DB::table($tableUserItem)->where('id', $userItemId)->update($paraA);

	}
	
/**/
	// 删除 delete item
	public function operateDeleteItem($db,$sort,$userItemId) // 删除 操作
	{
		$infos = $this->selectInfos($userItemId);
		$this->deleteMyMines($db,$userItemId); // step 删除 my_mines 表
		$this->deleteUserItem($userItemId); // step 删除 userItem 表
		
		
		if($sort == 19) {
			//deletePM($db,$sort,$id);
		} else if($sort == 21) { 
		} else if($sort == 48) { 
		}
		
		if($infos["isWorked"] != 0) // 待办事
		{
		}
		
		if($infos["timeType"] != 0) // 时间
		{
		}
		
		$attaching = $infos["attaching"]; // 删除 附图
		if(isset($attaching)) 
		{
			$attachings = explode("<|>",$attaching);
			for($i=0;$i<count($attachings);$i++) 
			{
				$thisAttaching = explode("-/",$attachings[$i]);
				$thisAttachingType = $thisAttaching[0];
				if($thisAttachingType == "qingbo") 
				{
					$publicPath = public_path();
					$urlOrigin = $publicPath."/images/origin/".$thisAttaching[1];	
					$urlImg690 = $publicPath."/images/img690/".$thisAttaching[1];
					$urlImg160 = $publicPath."/images/img160/".$thisAttaching[1];
					if(file_exists($urlOrigin)) {
						unlink($urlOrigin);
					}
					if(file_exists($urlImg690)) {
						unlink($urlImg690);
					}
					if(file_exists($urlImg160)) {
						unlink($urlImg160);
					}
				}
			}
		}
		
//		$unlikeFile = public_path()."/images/db120/image_20170324180908_698.jpg";
//		//unlink("/images/db120/image_20170324175540_195.png");
//		//unlink(public_path("/images/db120/image_20170324175540_195.png"));
//		unlink($unlikeFile);
	}
	public function deleteTheTable($table,$attr,$value) // 删除 任意表
	{
		DB::table($table)->where($attr, $value)->delete();
	}
	public function deleteUserItem($id) // 删除 users_item 表
	{ 
		$tableUserItem = "my_home.users_item";
		DB::table($tableUserItem)->where('id', '=', $id)->delete();
	}
	public function deleteMyMines($db,$userItemId) // 删除 my_Unfinished 表
	{
		$tableMyMines = $db.".my_Mines";
		DB::table($tableMyMines)->where('userItemId', '=', $userItemId)->delete();
	}
	
	

/**/
	// geter
	public function geter($para)
	{
		
		$myID = $para["myID"];
		$id = $para["id"];
		$db = "db".$id;
		$type = $para["type"];
		$geter = $para["geter"];
		$operate = $para["operate"];
		$position = $para["position"];
		$permission = $para["permission"];
		
		//设置
		if($geter == "MySetting") { 
			$data = $this->getMySetting();
		}
		else if($geter == "Mine")
		{ 
			$data = $this->getMine($myID,"common",$operate,0,$position,$permission,"modified");
		}
		else if($geter == "MineX")
		{ 
			$data = $this->getMine(0,$operate,$position,$permission);
		}
		else if($geter == "News") // 消息
		{ 
			$data = $this->getMinesX("special",$operate,10,$position,$permission,"id");
		}
		else if($geter == "PMAll") // 私信
		{ 
			$data = $this->getMinesX("special",$operate,19,$position,$permission,"id");
		}
		else if($geter == "PMIn") // 收件
		{ 
			$data = $this->getMinesX("PMIn",$operate,19,$position,$permission,"id");
		}
		else if($geter == "PMOut") // 发件
		{
			$data = $this->getMine($myID,"special",$operate,19,$position,$permission,"id");
		}
		else if($geter == "AboutMe")
		{ 
			$data = $this->getAboutMe($operate,$position);
		}
		else if($geter == "MyUnfinished") // 代办
		{ 
			$data = $this->getMyWorking();
		}
		else if($geter == "MyFinished")
		{
			$data = $this->getMyFinished($operate,$position);
		}
		else if($geter == "MyNotebook")
		{
			$data = $this->getMine($myID,"special",$operate,21,$position,$permission,"modified");
		}
		else if($geter == "MyUtterance")
		{ 
			$data = $this->getMine($myID,"special",$operate,41,$position,$permission,"id");
		}
		else if($geter == "MyAskbar")
		{ 
			$data = $this->getMine($myID,"special",$operate,44,$position,$permission,"id");
		}
		else if($geter == "MyStore")
		{ 
			$data = $this->getMine($myID,"special",$operate,48,$position,$permission,"id");
		}
		else if($geter == "myCollection")
		{ 
			$data = $this->getMinesX("myCollection",$operate,0,$position,$permission,"modified");
		}
		else if($geter == "MyAnswerbar")
		{ 
			$data = $this->getMinesX("myAnswer",$operate,0,$position,$permission,"modified");
		}
		else if($geter == "getSchedule") // 日程
		{ 
			$globalF = new GlobalFunc;
			$start = $globalF->_get_this_month_start_unix();
			$ended = $globalF->_get_this_month_ended_unix();
			$data = $this->getIntervalScheduleDisplay($db,$start,$ended);
		} else if($geter == "MySchedule") // 日程
		{ 
			$globalF = new GlobalFunc;
			$start = $globalF->_get_this_month_start_unix();
			$ended = $globalF->_get_this_month_ended_unix();
			$data = $this->getIntervalScheduleDisplay($db,$start,$ended);
		} else if($geter == "Friends") // 好友的
		{ 
			$data = $this->getFriends("all",$operate,0,$position);
		} else if($geter == "FriTimer") 
		{ 
			$data = $this->getFriends("FriTimer",$operate,0,$position);
		} else if($geter == "FriNotebook") 
		{ 
			$data = $this->getFriends("special",$operate,21,$position);
		} else if($geter == "FriUtterance") 
		{ 
			$data = $this->getFriends("special",$operate,41,$position);
		} else if($geter == "FriAskbar") 
		{ 
			$data = $this->getFriends("special",$operate,44,$position);
		} else if($geter == "FriStore") 
		{ 
			$data = $this->getFriends("special",$operate,48,$position);
		} else if($geter == "His") // 他的
		{ 
			$data = $this->getHis($id,"all",$operate,0,$position,$permission);
		} else if($geter == "HisTimer") { 
			$data = $this->getHis($id,"Timer",$operate,0,$position,$permission);
		} else if($geter == "HisNotebook") { 
			$data = $this->getHis($id,"special",$operate,21,$position,$permission);
		} else if($geter == "HisUtterance") { 
			$data = $this->getHis($id,"special",$operate,41,$position,$permission);
		} else if($geter == "HisAskbar") { 
			$data = $this->getHis($id,"special",$operate,44,$position,$permission);
		} else if($geter == "HisAnswerbar") { 
		} else if($geter == "HisStore") { 
			$data = $this->getHis($id,"special",$operate,48,$position,$permission);
		} else if($geter == "Recommend") // 推荐
		{ 
			$data = $this->getRecommend(0,$operate,$position);
		} else if($geter == "RecTimer") { 
			$data = $this->getRecommend(22,$operate,$position);
		} else if($geter == "RecNotebook") { 
			$data = $this->getRecommend(21,$operate,$position);
		} else if($geter == "RecAskbar") { 
			$data = $this->getRecommend(24,$operate,$position);
		} else if($geter == "Guest") // 游客
		{ 
			$data = $this->getGuest("all",$operate,0,$position);
		} else if($geter == "GuestNotebook") { 
			$data = $this->getGuest("special",$operate,21,$id);
		} else if($geter == "GuestUtterance") { 
			$data = $this->getGuest("special",$operate,41,$id);
		} else if($geter == "GuestAskbar") { 
			$data = $this->getGuest("special",$operate,44,$id);
		} else if($geter == "GuestStore") {  
			$data = $this->getGuest("special",$operate,48,$id);
		} else if($geter == "GuestTimer") 
		{ 
			$data = $this->getGuest("GuestTimer",$operate,0,$id);
		} else if($geter == "Give") // 闲置
		{ 
			$data = $this->getGuest("Give",$operate,0,$id);
		} 
		return $data;
	}
	
	public function getMyWorking() // 所有未完成待办事
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;

    	$tableMyMines = $myDB.".my_Mines";
		$tableUserItem = "my_home.users_item";
		
    	$datas = DB::table($tableMyMines)
			->join($tableUserItem, $tableUserItem.'.id', '=', $tableMyMines.'.userItemId')
			->select($tableUserItem.'.*')->where($tableMyMines.'.isWorked', '=', 1)
			->orderBy($tableMyMines.'.importance', 'desc')->orderBy($tableMyMines.'.modified', 'desc')->get();
		
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
	}
	/* 获取 日程 */
	public function getIntervalScheduleData($db,$start,$ended) // 获取 一个时间段
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
    	$tableMySchedule = $db.".my_Mines";
		$tableUserItem = "my_home.users_item";
		
    	$datas = DB::table($tableMySchedule)
			->join($tableUserItem, $tableUserItem.'.id', '=', $tableMySchedule.'.userItemId')
  			->where($tableMySchedule.'.isFocused', '=', 1)
  			->where(function ($query) use($tableMySchedule,$start,$ended) {
	  			$query->where($tableMySchedule.'.timeType', '>', 1)
	  				->orWhere(function ($query) use($tableMySchedule,$start,$ended) {
	  					$query
		  					->where(function ($query) use($tableMySchedule,$start,$ended) {
		  							$query->where($tableMySchedule.'.start', '>=', $start)->where($tableMySchedule.'.start', '<=', $ended);})
		  					->orWhere(function ($query) use($tableMySchedule,$start,$ended) {
		  							$query->where($tableMySchedule.'.ended', '>=', $start)->where($tableMySchedule.'.ended', '<=', $ended);})
		  					->orWhere(function ($query) use($tableMySchedule,$start,$ended) {
		  							$query->where($tableMySchedule.'.start', '<=', $start)->where($tableMySchedule.'.ended', '>=', $ended);});
	  			});
  			})
			->select($tableUserItem.'.*', $tableMySchedule.'.id as minesId')
			->orderBy($tableMySchedule.'.timeType', 'desc')->orderBy($tableMySchedule.'.ended', 'asc')->orderBy($tableMySchedule.'.start', 'asc')->get();
		
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
//    	$displayShow = $this->showDatasToDisp($datasT);
//    	return $displayShow;
	}
	public function getIntervalScheduleDisplay($db,$start,$ended) // 获取 一个时间段
	{ 
		$datasT = $this->getIntervalScheduleData($db,$start,$ended);
    	$displayShow = $this->showDatasToDisp($datasT);
    	return $displayShow;
	}
	public function getMomentSchedule($db,$moment) // 获取某 一时刻
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
    	$tableMySchedule = $db.".my_Mines";
		$tableUserItem = "my_home.users_item";

    	$datas = DB::table($tableMySchedule)
			->join($tableUserItem, $tableUserItem.'.id', '=', $tableMySchedule.'.userItemId')
  			->where($tableMySchedule.'.timeType', 1)
  			->where($tableMySchedule.'.start', '<=', $moment)
  			->where($tableMySchedule.'.ended', '>=', $moment)
			->select($tableUserItem.'.*', $tableMySchedule.'.id as focusedID')
			->orderBy($tableMySchedule.'.timeType', 'desc')->orderBy($tableMySchedule.'.ended', 'asc')->orderBy($tableMySchedule.'.start', 'asc')->get();
		
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
    	//$displayShow = $this->showDatasToDisp($datasT);
    	//return $displayShow;
	}
	public function getMine($myID,$getSort,$getType,$sort,$id,$permission,$orderType) // 我的 
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		
		$tableUserItem = "my_home.users_item";
    	$sql = DB::table($tableUserItem)->select('*')->where('belongId', '=', $myID)->where('isShared', '>=', $permission)->orderBy($orderType, 'desc')->limit(30);
		
		if($getSort == "all") 
		{
		}
		else if($getSort == "common")
		{
	    	$sql = $sql->where('sort', '>', 20);
		}
		else if($getSort == "special")
		{
	    	$sql = $sql->where('sort', '=', $sort);
		}
		
		if($getType == "init") 
		{
		}
		else if($getType == "more")
		{
	    	$sql = $sql->where($orderType, '<', $id);
		}
		
		$datas = $sql->get();
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
    	//$displayShow = $this->showDatasToDisp($datasT);
    	//return $displayShow;
	}
	public function getMinesX($getSort,$getType,$sort,$id,$permission,$orderType) // 我的 my_mines join users_item
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		$myDB = "db120";
    	
    	$tableUserItem = "my_home.users_item";
    	$tableMyMines = $myDB.".my_Mines";
    	
    	$sql = DB::table($tableMyMines)
		 ->join($tableUserItem, $tableMyMines.'.userItemId', '=', $tableUserItem.'.id')
		 ->select($tableUserItem.'.*', $tableMyMines.'.id as MinesId')
		 ->where($tableUserItem.'.isShared', '>=', $permission)
		 ->orderBy($tableMyMines.'.'.$orderType, 'desc')->limit(30);
						 
		if($getSort == "all")
		{
		} else if($getSort == "common") 
		{
	    	$sql = $sql->where($tableMyMines.'.belongId', '=', $myID)->where($tableMyMines.'.sort', '>', 20);
		} else if($getSort == "special") 
		{
	    	$sql = $sql->where($tableMyMines.'.belongId', '=', $myID)->where($tableMyMines.'.sort', '=', $sort);
		} else if($getSort == "PMin") 
		{
	    	$sql = $sql->where($tableMyMines.'.sort', '=', 19)->where($tableMyMines.'.type', '=', 2);
		} else if($getSort == "myCollection") 
		{
	    	$sql = $sql->where($tableMyMines.'.isCollected', '=', 1);
	    	//$sql = $sql->where($tableMyMines.'.sort', '>', 20);
		} else if($getSort == "myAnswer") 
		{
	    	$sql = $sql->where($tableMyMines.'.isAnswered', '=', 1);
		}
		 
		
		if($getType == "init") 
		{
		} else if($getType == "more") 
		{
	    	$sql = $sql->where($tableMyMines.'.'.$orderType, '<', $id);
		} else if($getType == "new") 
		{
	    	$sql = $sql->where($tableMyMines.'.'.$orderType, '>', $id);
		}
		
		$datas = $sql->get();
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
    	//$displayShow = $this->showDatasToDisp($datasT);
    	//return $displayShow;
	}
	public function getHis($hisId,$getSort,$getType,$sort,$id,$permission) // 他的
	{
		$tableUserItem = "my_home.users_item";
		$sql = DB::table($tableUserItem)->select('*')->where('belongId', '=', $hisId)->where('isShared', '>=', $permission)->orderBy('id', 'desc')->limit(30);
		
		if($getSort == "all") 
		{
		} else if($getSort == "special") 
		{
	    	$sql = $sql->where('sort', '=', $sort);
		} else if($getSort == "Timer") 
		{
	    	$sql = $sql->where('timeType', '>', 0);
		}
		
		if($getType == "init") 
		{
		} else if($getType == "more") 
		{
			$sql = $sql->where('id', '<', $id);;
		}
		
		$datas = $sql->get();
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
    	//$displayShow = $this->showDatasToDisp($datasT);
    	//return $displayShow;
	}
	public function getFriends($getSort,$getType,$sort,$id) // 好友分享
	{
//		$sql="select {$home_db}.users_item.* from {$home_db}.users_item inner join {$my_db}.my_connection 
//			on {$home_db}.users_item.belongId = {$my_db}.my_connection.userId 
//			where {$home_db}.users_item.isShared > 8 and {$my_db}.my_connection.relationship < 41
//			order by {$home_db}.users_item.id desc limit 30";

		$myID = Auth::user()->id;
		$myDB = "db".$myID;
    	$tableUserItem = "my_home.users_item";
    	$tableMyConn = $myDB.".my_connection";
		
    	$sql = DB::table($tableMyConn)
		 ->join($tableUserItem, $tableUserItem.'.belongId', '=', $tableMyConn.'.userId')
		 ->where($tableUserItem.'.isShared', '>=', 40)
		 ->where($tableMyConn.'.relationship', '<', 41)
		 ->select($tableUserItem.'.*')
		 ->orderBy($tableUserItem.'.id', 'desc')->limit(30);
				 
		if($getSort == "all") 
		{
		} else if ($getSort == "special") 
		{
	    	$sql = $sql->where($tableUserItem.'.sort', '=', $sort);
		} else if ($getSort == "FriTimer") 
		{
	    	$sql = $sql->where($tableUserItem.'.timeType', '>', 0);
		}
		
				 
		if($getType == "init") 
		{
		} else if($getType == "more") 
		{
	    	$sql = $sql->where($tableUserItem.'.id', '<', $id);
		}
		
		$datas = $sql->get();
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
    	//$displayShow = $this->showDatasToDisp($datasT);
    	//return $displayShow;
	}
	public function getGuest($getSort,$getType,$sort,$id) // 游客访问
	{ 
		//$sql="select * from my_home.users_item where (isShared > 98) order by id desc limit 30";
    	$tableUserItem = "my_home.users_item";
    	$sql = DB::table($tableUserItem)->select('*')->where('isShared', '>=', 98)->orderBy('id', 'desc')->limit(30);
				
		if($getSort == "all") 
		{
		}
		else if ($getSort == "special")
		{
	    	$sql = $sql->where('sort', '=', $sort);
		}
		else if ($getSort == "GuestTimer")
		{
	    	$sql = $sql->where('timeType', '>', 0);
		}
		else if ($getSort == "Give")
		{
	    	$sql = $sql->where('sort', '=', 48)->where('type', '=', 9);
		}
		
		if($getType == "init") 
		{
		}
		else if($getType == "more")
		{
		    $sql = $sql->where('id', '<', $id);
		}
		
		$datas = $sql->get();
    	$datasT = $this->handleMyDataToArray($datas);
    	return $datasT;
    	//$displayShow = $this->showDatasToDisp($datasT);
    	//return $displayShow;
	}
	public function getRecommend($sort,$getType,$id) // 系统推荐
	{
	}
	
	public function searchGuestItem($search,$getType,$position,$permission) 
	{
		$tableUserItem = "my_home.users_item";
		$searchText = "%".$search."%";
		$sql = DB::table($tableUserItem)->select('*')->where('theme', 'like', $searchText)->where('isShared', '>=', $permission)->orderBy('id', 'desc')->limit(30);
		if($getType == "init") 
		{
		} else if($getType == "more") 
		{
    		$sql = $sql->where('id', '<', $position);
		}
		
		$datas = $sql->get();
    	if( isset($datas) ) {
    		$datasO = $this->handleMyDataToArray($datas);
			$processingD = new ProcessingData();
  			$itemsP = $processingD->pocessItems($datasO);	// 数组
    	} else {
  			$itemsP = $datas;
    	}
		return $itemsP;
	}
	public function searchItem($myID,$search,$getType,$position,$permission) 
	{
		$tableUserItem = "my_home.users_item";
		$searchText = "%".$search."%";
  		$datas = DB::table($tableUserItem)->select('*')
			//->where(function ($query) use($search,$searchText) { $query->where('id', $search)->orWhere('theme', 'like', $searchText)->orWhere('tag', 'like', $searchText); })
			->where('belongId', '=', $myID)->where('isShared', '>=', $permission)
			->where(function ($query) use($searchText) { $query->where('theme', 'like', $searchText)->orWhere('tag', 'like', $searchText); })
			->orderBy('id', 'desc')->limit(30);
		
		if($getType == "init") 
		{
		} else if($getType == "more") 
		{
    		$sql = $sql->where('id', '<', $position);
		}
		
		$datas = $sql->get();
    	if( isset($datas) ) {
    		$datasO = $this->handleMyDataToArray($datas);
			$processingD = new ProcessingData();
  			$itemsP = $processingD->pocessItems($datasO);	// 数组
    	} else {
  			$itemsP = $datas;
    	}
		return $itemsP;
	}
	
	public function getTheItem($id) // 获取一个 item data
	{
		$tableUserItem = "my_home.users_item";
    	$datas = DB::table($tableUserItem)->select('*')->where('id', '=', $id)->first();
    	if( isset($datas) ) {
			$globalF = new GlobalFunc;
			$infos = $globalF->object_array($datas);
			return $infos;
    	} else {
			return $datas;
    	}
	}
	public function showTheItem($id) // 获取一个item show 
	{ 
	
		$theItem = $this->getTheItem($id);
		if( !isset($theItem) ) {
			//$belong=str_replace('db','',$db);
			$belong=0;
			$items[0]["isset"] = "_none";
			$items[0]["belongId"] = $belong;
			$items[0]["sourceId"] = $belong;
			$items[0]["itemId"] = $id;
			$items[0]["id"] = $id;
		} else {
			$items[0] = $theItem;
		}
		
		$processingD = new ProcessingData();
  		$datasP = $processingD->pocessItems($items);	// 数组
    	$displayShow = $this->showDatasToDisp($datasP);
		return $displayShow;
	}
	public function showTheNote($id) // 获取一个item show 
	{
		$theItem = $this->getTheItem($id);
		if( !isset($theItem) ) {
//			$belong=str_replace('db','',$db);
            $belong=$id;
			$items[0]["isset"] = "_none";
			$items[0]["belongId"] = $belong;
			$items[0]["sourceId"] = $belong;
			$items[0]["id"] = $id;
		} else {
			$items[0] = $theItem;
		}
		
		$processingD = new ProcessingData();
  		$datasP = $processingD->pocessItems($items);	// 数组
    	$displayShow = $this->showDatasToNote($datasP);
		return $displayShow;		
	}
	
	
	
	
	
/*
*/
	public function insertCommunication($para) // 添加 交流 users_commnunication
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		
		$tableUserCommu = "my_home.users_Communication";
		
		$userItemId = $para["userItemId"];
		$item = $para["item"];
		
		$paraA["time"] = $para["time"];
		$paraA["sort"] = $para["sort"];
		$paraA["type"] = $para["type"];
		$paraA["userItemId"] = $para["userItemId"];
		$paraA["belongId"] = $para["belong"];
		$paraA["itemId"] = $para["item"];
		$paraA["sourceId"] = $para["source"];
		$paraA["isShared"] = $para["share"];
		
		if( !isset($para["object"]) || ($para["object"] == $myID) ) 
		{
			if($para["sort"] == 1) 
			{
				$paraA["objectId"] = 0;
			} else if ($para["sort"] == 2) 
			{
				$paraA["objectId"] = $para["object"];
			}
		} else {
			$paraA["objectId"] = $para["object"];
		}
		
  		if( isset($para["point"]) ) // 是否是回复，有指向
  		{
  			$paraA["pointId"] = $para["point"];
  		} else {
  			$paraA["pointId"] = NULL;
  		}
		
  		if( isset($para["score"]) ) // 是否是回复，有指向
  		{
  			$paraA["score"] = $para["score"];
  		} else {
  			$paraA["score"] = 0;
  		}
		
  		if( isset($para["content"]) ) // 内容
  		{
			$paraA["content"] = $para["content"];
  		} else {
  			$paraA["content"] = NULL;
  		}
  		
  		if( isset($para["version"]) ) // item 版本
  		{
			$paraA["itemVersion"] = $para["version"];
  		} else {
  			$paraA["itemVersion"] = NULL;
  		}
		

		$communicationId = DB::table($tableUserCommu)->insertGetId($paraA);
		return $communicationId;
	}
	// chat || comment
	public function getCommunication($display,$getOperate,$getSort,$getType,$belong,$item,$userItemId,$sort,$type,$location,$permission) 
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		$tableCommunication = "my_home.users_Communication";
		$tableMyConnection = $myDB.".my_Connection";
		
		//$order = "desc" | "asc";
		if($display == "comment") $order = "desc";
		else if($display == "communication") $order = "desc";
		
		$db = "db".$belong;
		if($item == 0) {
			$db = $myDB;
			$getSort = "chat";
		}
		
		if($myID == "guest" || $myID == "") $myID = -1;

		if($getOperate == "chat") // 聊天
		{
	    	$sql = DB::table($tableCommunication)->select('*')->where('sort', '=', 2)
	    			->where(function ($query) use($myID,$belong) { 
	    				$query->where(function ($query) use($myID,$belong) { $query->where('source_id', $belong)->where('object_id', $myID); })
	    				->orWhere(function ($query) use($myID,$belong) { $query->where('source_id', $myID)->where('object_id', $belong); });
	    			})->orderBy('id', 'desc')->limit(20);
		}
		else if($getOperate == "all") // 全部评论
		{
	    	$sql = DB::table($tableCommunication)->select('*')->where('item_id', '=', $userItemId)
	    		->where(function ($query) use($permission,$myID) 
	    			{ $query->where('isShared', '>=', $permission)
	    				->orWhere(function ($query) use($myID) { $query->where('source_id', $myID)->orWhere('object_id', $myID); });
	    			})->orderBy('id', 'desc')->limit(20);
		}
		else if($getOperate == "mine") //与我相关
		{
	    	$sql = DB::table($tableCommunication)->select('*')->where('item_id', '=', $userItemId)
	    		->where(function ($query) use($myID) { $query->where('source_id', $myID)->orWhere('object_id', $myID); })
	    		->orderBy('id', 'desc')->limit(20);
		}
		else if($getOperate == "friend") // 好友评论
		{
	    	$sql = DB::table($tableCommunication)
				->join($tableMyConnection, function ($join) use($tableCommunication,$tableMyConnection) {
						$join->on($tableCommunication.'.source_id', '=', $tableMyConnection.'.userId')
								->on($tableCommunication.'.object_id', '=', $tableMyConnection.'.userId')
								->orOn(function ($joinX) use($tableCommunication,$tableMyConnection) {
										$joinX->on($tableCommunication.'.source_id', '=', $tableMyConnection.'.userId')
												->where($tableCommunication.'.object_id', '=', 0);
									})
								->where($tableMyConnection.'.relationship', '<', 41);
					})
				->select($tableCommunication.'.*')
	  			->where($tableCommunication.'.item_id', '=', $userItemId)
	  			->where($tableCommunication.'.isShared', '>', $permission)
				->orderBy($tableCommunication.'.id', 'desc')->limit(20);
		} 
		
		// getSort
		if($getSort == "common") $sql = $sql->where($tableCommunication.'.sort', '>=', $sort);
		else if($getSort == "special") $sql = $sql->where($tableCommunication.'.sort', '=', $sort);
		
		// getType
		if($getType == "more") $sql = $sql->where($tableCommunication.'.id', '<', $location);
		else if($getType == "new") $sql = $sql->where($tableCommunication.'.id', '>', $location);

		$datas = $sql->get();
  		$datasT = $this->handleMyDataToArray($datas);
		$communications = $this->pocessCommunication($datasT);
		return $communications;
	}
	
	public function getTheCommunication($id)
	{
		$tableCommunication = "my_home.users_Communication";
		$datas = DB::table($tableCommunication)->select('*')->where('id', '=', $id)->first();
    	if( isset($datas) ) {
			$globalF = new GlobalFunc;
			$infos = $globalF->object_array($datas);
			return $infos;
    	} else {
			return $datas;
    	}
	}
	public function showTheCommunication($db,$id,$display)
	{
		$data = $this->getTheCommunication($id);
		$datasT[0] = $data;
		$communications = $this->pocessCommunication($datasT);
		
		if($display == "comment" || $display == "item") {
			$displayShow = $this->showDatasToComment($communications);
		} else if($display == "communication") {
			$displayShow = $this->showDatasToCommunication($communications);
		}
		return $displayShow;
	}
	public function pocessCommunication($comments) // show Communications
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		
		$globalF = new GlobalFunc;
		
		for($i=0;$i<count($comments);$i++)
		{
			$comments[$i]["entity"] = $comments[$i]["item_id"];
			$comments[$i]["item"] = $comments[$i]["item_id"];
			$comments[$i]["source"] = $comments[$i]["source_id"];
			$comments[$i]["object"] = $comments[$i]["object_id"];
			
			if($comments[$i]["source_id"] == $myID) {
				$comments[$i]["reply_isset"] = "_none";
				$comments[$i]["whos"] = "communication_mine";
				$comments[$i]["float"] = "_right";
			}
			else {
				$comments[$i]["float"] = "_left";
			}
			
			if($comments[$i]["sort"] == 1) {
			}
			else if($comments[$i]["sort"] == 2) {
				$comments[$i]["reply_isset"] = "_none";
				$comments[$i]["object_isset"] = "_none";
				
			}
			else if($comments[$i]["sort"] == 11) {
				if($comments[$i]["type"] == 1) {
					$comments[$i]["header"] = "完成了工作";
				} else if($comments[$i]["type"] == 2) {
					$comments[$i]["header"] = "重新添加工作";
				} else if($comments[$i]["type"] == 11) {
					$comments[$i]["header"] = "完成代办 & 通知对方";
				} else if($comments[$i]["type"] == 12) {
					$comments[$i]["header"] = "重新添加代办 & 通知对方";
				}
			}
			else if($comments[$i]["sort"] == 15) {
				$comments[$i]["header"] = " 修改信息记录 ";
			}
			else if($comments[$i]["sort"] == 19) {
				if($comments[$i]["type"] == 1) {
					$comments[$i]["header"] = "添加代办";
				} else if($comments[$i]["type"] == 2) {
					$comments[$i]["header"] = "删除代办";
				} else if($comments[$i]["type"] == 3) {
					$comments[$i]["header"] = "添加日程";
				} else if($comments[$i]["type"] == 4) {
					$comments[$i]["header"] = "删除日程";
				} else if($comments[$i]["type"] == 11) {
					$comments[$i]["header"] = "添加代办 & 通知对方";
				} else if($comments[$i]["type"] == 12) {
					$comments[$i]["header"] = "删除代办 & 通知对方";
				} else if($comments[$i]["type"] == 13) {
					$comments[$i]["header"] = "添加日程 & 通知对方";
				} else if($comments[$i]["type"] == 14) {
					$comments[$i]["header"] = "删除日程 & 通知对方";
				}
			}
			else if($comments[$i]["sort"] == 21) {
				if($comments[$i]["type"] == 1) {
					$comments[$i]["header"] = "+为代办";
				}
                else if($comments[$i]["type"] == 2) {
					$comments[$i]["header"] = " 取消待办";
				}
			}
			else if($comments[$i]["sort"] == 22) {
				if($comments[$i]["type"] == 1) {
					$comments[$i]["header"] = " +为日程";
				} else if($comments[$i]["type"] == 2) {
					$comments[$i]["header"] = " 取消日程";
				}
			}
			else if($comments[$i]["sort"] == 20) {
				if($comments[$i]["type"] == 1) {
					$comments[$i]["header"] = " +为收藏";
				} else if($comments[$i]["type"] == 2) {
					$comments[$i]["header"] = " 取消收藏";
				}
			} else if($comments[$i]["sort"] == 48) 
			{
				//$comments[$i]["content"] = "打赏了  ￥".$comments[$i]["tip"];
				
				$comments[$i]["header"] = " 打赏 ";
				$comments[$i]["tips"] = " ￥".$comments[$i]["tip"];
			} else if($comments[$i]["sort"] == 49) 
			{
				if($comments[$i]["type"] == 1) 
				{
					$comments[$i]["header"] = "打了".$comments[$i]["score"]."颗星";
				} else if($comments[$i]["type"] == 2) 
				{
					$comments[$i]["header"] = "（重新）打了".$comments[$i]["score"]."颗星";
				}
			} else if($comments[$i]["sort"] == 50) 
			{
				if($comments[$i]["type"] == 1) 
				{
					$comments[$i]["header"] = "点了赞";
				} else if($comments[$i]["type"] == 2) 
				{
					$comments[$i]["header"] = "取消了赞";
				}
			}    
			
//			$comments[$i]["time_show"] = $globalF->_time_switch($comments[$i]["time"]);
			if($comments[$i]["content"] == "") {
				$comments[$i]["content_isset"] = "_none";
			}
			else {
				$comments[$i]["content_notset"] = "_none";
				$comments[$i]["content"] = $globalF->_my_replace($comments[$i]["content"]);
				//$comments[$i]["content"] = $globalF->_replace_blank($comments[$i]["content"]);
			}
			$comments[$i]["posterName"] = $this->search_user_infos($comments[$i]["source"],"name");
			
			if($comments[$i]["object_id"] == 0) {
				$comments[$i]["object_isset"] = "_none";
			}
			else {
				$comments[$i]["objectName"] = $this->search_user_infos($comments[$i]["object_id"],"name");
			}
			
		}
		return $comments;
	}

	public function addTheCommunication($para) // 添加 交流
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		$tableUserCommu = "my_home.users_Communication";
		
		$db = $para["db"];
		$userItemId = $para["userItemId"];
		$belong = $para["belong"];
		$belongDB = "db".$belong;
		$item = $para["item"];
		
		$userCommuId = $this->insertCommunication($para);
		$this->setINC($userItemId,"commentNum",1); 
		return $userCommuId;
	}
	public function addComment($para) // 添加 评论
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		$tableUserCommu = "my_home.users_Communication";
		
		$operate = $para["operate"];
		$userItemId = $para["userItemId"];
		$belong = $para["belong"];
		$item = $para["item"];
		$time = $para["time"];
		$object = $para["object"];
		$point = $para["point"];
		
		$belongDB = "db".$belong;
		
		
		if($operate == "addComment") // 评论
		{
			$para["sort"] = 1;
			$para["type"] = 1;
		} else if($operate == "addReply") // 回复
		{
			$para["sort"] = 1;
			$para["type"] = 2;
		} else if($operate == "addChat") // 回复
		{
			$para["sort"] = 2;
			$para["type"] = 0;
		}
		
		$newCommuId = $this->addTheCommunication($para);
		
		$this->addSession($myID,1,1,$belong,$item,$userItemId,0,$time);
		if($belong != $myID) 
		{
			$this->addSession($belong,1,1,$belong,$item,$userItemId,1,$time);
		}
		
		if($operate == "addComment") // 评论
		{
			$this->setTheTable($tableUserCommu,"dialog",$newCommuId,"id",$newCommuId);
		} else if($operate == "addReply") // 回复
		{
			$userPointCommu = $this->getTheTable($tableUserCommu,"id",$point);
			$userDialog = $userPointCommu["dialog"];
			$this->setTheTable($tableUserCommu,"dialog",$userDialog,"id",$newCommuId);
			
			if( ($object != $myID) & ($object != $belong) ) 
			{
				$objectDB = "db".$object;
				$this->addSession($object,1,1,$belong,$item,$userItemId,1,$time);
			}
		}
		return $newCommuId;
	}
	public function addChat($para)
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		$tableUserCommu = "my_home.users_Communication";
		
		$db = $para["db"];
		$belong = $para["belong"];
		$belongDB = "db".$belong;
		$hisID = $para["belong"];
		$hisDB = "db".$belong;
		$time = $para["time"];
		
		
		$para["sort"] = 2;
		$para["type"] = 1;
		$para["object"] = $belong;
			
		$userCommuId = $this->insertCommunication($para);
		
		$this->addSession($myID,2,1,$belong,0,0,0,$time);
		if($myID != $belong) // 和别人聊天
		{
			$this->addSession($hisID,2,1,$myID,0,0,1,$time);
		}
		
		return $userCommuId;
	}
	
	
/*
*/
	public function insertSession($para) 
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		
		$db = $para["db"];
		$tableMySession = $db.".my_Session";
		
		$paraA["lastTime"] = $para["time"];
		$paraA["sort"] = $para["sort"];
		$paraA["type"] = $para["type"];
		$paraA["belongId"] = $para["belong"];
		$paraA["itemId"] = $para["item"];
		$paraA["userItemId"] = $para["userItemId"];
		$paraA["unreadNum"] = $para["unread"];
		
  		if( isset($para["alert"]) ) // 
  		{
  			$paraA["alert"] = $para["alert"];
  		} 
		
//			$sql="INSERT INTO {$db}.my_Session (sort,type,belongId,itemId,userItemId,unreadNum,lastTime,alert) 
//				VALUES(:sort,:type,:belong,:item,:userItemId,:unread,:time,:alert)";
		$newSessionId = DB::table($tableMySession)->insertGetId($paraA);
		return $newSessionId;
	}
	public function deleteSession($db,$id) 
	{
		$sql="delete from {$db}.my_Session where id = {$id}";
		DB::statement($sql);
	}
	public function toLastSession($db,$id) 
	{
		$tableMySession = $db.".my_Session";
    	$datas = DB::table($tableMySession)->select('*')->where('id', '=', $id)->first();
		$globalF = new GlobalFunc;
		$infos = $globalF->object_array($datas);
		unset($infos["id"]);
		$paraA = $infos;
		$newSessionId = DB::table($tableMySession)->insertGetId($paraA);
		$this->deleteSession($db,$id);
		return $newSessionId;
	}
	public function getMySessionInfos($db,$id) 
	{
    	$tableMySession = $db.".my_Session";
    	$datas = DB::table($tableMySession)->select('*')->where('id', '=', $id)->first();
		$globalF = new GlobalFunc;
		$infos = $globalF->object_array($datas);
		return $infos;
	}
	public function resetMySession($db,$sort,$time) 
	{
		$sql="UPDATE {$db}.my_Session set unreadNum=0,alert=NULL,lastTime={$time} where sort = {$sort}";
		DB::statement($sql);
	}
	public function setSessionZero($db,$sort,$belong,$item) 
	{
		if($sort == 1) {
			$sql="UPDATE {$db}.my_Session set unreadNum=0,alert=NULL where sort = {$sort} and belongId = {$belong} and itemId = {$item}";
		} else if($sort == 2) {
			$sql="UPDATE {$db}.my_Session set unreadNum=0,alert=NULL where sort = {$sort} and belongId = {$belong}";
		}
		DB::statement($sql);
	}
	
	
	public function addSession($sessionBelong,$sort,$type,$belong,$item,$userItemId,$unread,$time) 
	{
		//$sessionID = substr($db,2,strlen($db)-2); 
		$sessionDB = "db".$sessionBelong;
		$sessionBelong = (int)$sessionBelong;
		
		$tableUserLog = "my_home.user_log";
		$tableMySession = $sessionDB.".my_Session";
		
		$para["db"] = $sessionDB;
		$para["time"] = $time;
		$para["sort"] = $sort;
		$para["type"] = $type;
		$para["belong"] = $belong;
		if($item != "") 
		{
			$para["item"] = $item;
		}
		$para["userItemId"] = $userItemId;
		$para["unread"] = $unread;
		if($unread != 0) 
		{
			$para["alert"] = 1;
			$paraSession["alert"] = 1;
			$paraLog["alert"] = 1;
		} 
		
		$exist = $this->isSessionExist($sessionDB,$sort,$type,$belong,$userItemId);
		if($exist == 0) // no exist
		{ 
			$sessionId = $this->insertSession($para);
		} else // exist 
		{ 
			$sessionId = $exist["id"];
			$paraSession["lastTime"] = $time;
			DB::table($tableMySession)->where('id', $sessionId)->increment("unreadNum", $unread, $paraSession);
		} 
		
		$paraLog["sessionUpdateTime"] = $time;
		$paraLog["sessionUpdateId"] = $sessionId;
		DB::table($tableUserLog)->where('id', $sessionBelong)->increment("unread", $unread, $paraLog);
		
		$paraSTS["myID"] = $sessionBelong;
		$this->socketToSession($paraSTS);
		
		return $sessionId;
	}
	public function isSessionExist($db,$sort,$type,$belong,$userItemId) // 判断已有session是否存在
	{
    	$tableMySession = $db.".my_Session";
		if( $sort == 1) {
    		$datas = DB::table($tableMySession)->select('*')->where('sort', $sort)->where('userItemId', $userItemId)->first();
		} else if($sort == 2) {
    		$datas = DB::table($tableMySession)->select('*')->where('sort', $sort)->where('belongId', $belong)->first();
		} else if( $sort == 9 || $sort == 10 ) {
    		$datas = DB::table($tableMySession)->select('*')->where('sort', $sort)->first();
		}
		
		if( isset($datas) ) {
			$globalF = new GlobalFunc;
			$exist = $globalF->object_array($datas);
		} else {
			$exist = 0;
		}
		return $exist;
	}
	
	public function getMySession($db,$getSort) 
	{
    	$tableMySession = $db.".my_Session";
    	$sql = DB::table($tableMySession)->select('*')->orderBy('lastTime', 'desc');
		if($getSort == "pc") 
		{
			$sql = $sql->where('sort', '<', 6);
		}
		else if($getSort == "mobile")
		{
			$sql = $sql->where('sort', '<', 99);
		}
		
    	$datas = $sql->get();
    	if( isset($datas) ) {
    		$datasO = $this->handleMyDataToArray($datas);
  			$sessionP = $this->pocessSessions($getSort,$datasO);	// 数组
  			//$sessionP = $datasO;
    	} else {
  			$sessionP = $datas;
    	}
		return $sessionP;
	}
	public function pocessSessions($getSort,$infos) 
	{
		$globalFunc = new GlobalFunc;
		$random = rand(1000,9999);
		for($i=0;$i<count($infos);$i++)
		{
			$infos[$i]["random"] = $random;
			$infos[$i]["theme_isset"] = "_none";
			$infos[$i]["content_isset"] = "_none";
			
			$belong = $infos[$i]["belongId"];
			$belongDB = "db".$belong;
			$itemId = $infos[$i]["itemId"];
			$userItemId = $infos[$i]["userItemId"];
			$infos[$i]["belongDB"] = $belongDB;
			$belong_name = $this->search_user_infos($belong,"name");
			//$source_name = $this->search_user_infos($source,"name");
			
			$infos[$i]["belong"] = $belong;
			$infos[$i]["item"] = $itemId;
			$infos[$i]["belong_name"] = $belong_name;
			//$infos[$i]["source_name"] = $source_name;
			
			if($getSort == "pc") {
				$infos[$i]["controller"] = "";
			} else if($getSort == "mobile") {
				$infos[$i]["controller"] = "";
			}
			
			if($infos[$i]["sort"] == 1) // item
			{ 
				$infos[$i]["session_sort_name"] = "";
				$infos[$i]["session_type"] = "item";
				$infos[$i]["ctrl"] = "item-".$belong."-".$itemId;
				$infos[$i]["header"] = $belong_name.".".$itemId;
				
				$belongItemInfo = $this->selectInfos($userItemId);
				if($belongItemInfo["theme"] == "") {
					$infos[$i]["theme"] = $globalFunc->_my_replace($belongItemInfo["content"]);
				} else {
					$infos[$i]["theme"] = $belongItemInfo["theme"];
				}
			} else if($infos[$i]["sort"] == 2) // chat
			{ 
				$infos[$i]["session_type"] = "chat";
				$infos[$i]["ctrl"] = "chat-".$belong;
				$infos[$i]["header"] = $belong_name;
			} else if($infos[$i]["sort"] == 3) // 群聊
			{ 
				$infos[$i]["session_type"] = "groupChat";
				$infos[$i]["name"] = $belong_name;
				$infos[$i]["ctrl"] = "";
			} else if($infos[$i]["sort"] == 9) // 私信
			{ 
				$infos[$i]["session_sort_name"] = "私信";
				$infos[$i]["session_type"] = "pm";
				$infos[$i]["ctrl"] = "PM";
				$infos[$i]["header"] = "私信";
			} else if($infos[$i]["sort"] == 10) // 消息
			{ 
				$infos[$i]["session_sort_name"] = "消息";
				$infos[$i]["session_type"] = "news";
				$infos[$i]["ctrl"] = "news";
				$infos[$i]["header"] = "消息";
			}
			
			if($infos[$i]["unreadNum"] == 0) 
			{
				$infos[$i]["unread_isset"] = "_none";
			}
			
		}
		return $infos;
	}
	public function getSessionWork($sort,$belong,$item,$userItemId)
	{
		$globalFunc = new GlobalFunc;
		$processingD = new ProcessingData();
		
		$db = "db".$belong;
		$session["session"] = $sort;
		$session["time_isset"] = "_none";
		$session["time_isset"] = "";
		$session["random"] = rand(100,999);
		
		if( $sort == 1 ) 
		{
			$session["operate"] = "item";
			$session["item_isset"] = "";
			$session["chat_isset"] = "_none";
			$infos = $this->selectInfos($userItemId);
			if($infos != "") {
				$session["type"] = $infos["type"];
				$session["time_isset"] = "_none";
				
				if($infos["theme"] == "") {
					$session["theme"] = "无主题";
					$session["theme"] = $globalFunc->_my_replace($infos["content"]);
					$session["content_isset"] = "_none";
				} else {
					$session["theme"] = $globalFunc->_my_replace($infos["theme"]);
				}	
				if($infos["content"] == "") {
					$session["content_isset"] = "_none";
				} else {
					$session["content"] = $globalFunc->_my_replace($infos["content"]);
					$session["content"] = $globalFunc->_replace_blank($session["content"]);
				}
				
				if($infos["sort"] == 1) {
					$session["session_sort_name"] = "(消息)";
				}
                else if($infos["sort"] == 2) {
					$session["session_sort_name"] = "(对话)";
				}
                else if($infos["sort"] == 19) {
					$session["session_sort_name"] = "(私信)";
				}
                else if($infos["sort"] == 21) {
					$session["session_sort_name"] = "(笔记)";
				}
                else if($infos["sort"] == 44) {
					$session["session_sort_name"] = "(提问)";
				}
                else if($infos["sort"] == 48) {
					if($infos["type"] == 1) {
						$session["session_sort_name"] = "(商品)";
					} else if($infos["type"] == 2) {
						$session["session_sort_name"] = "(二手品)";
					} else if($infos["type"] == 3) {
						$session["session_sort_name"] = "(服务)";
					} else if($infos["type"] == 9) {
						$session["session_sort_name"] = "(闲置免费送)";
					}
				}  
				
				if($infos["timeType"] != 0) {
					//$session["session_sort_name"] = "(时刻)";
					$session["content_isset"] = "_none";
					$session["time_isset"] = "";
						$time["form"] = $infos["form"];
						$time["timeType"] = $infos["timeType"];
						$time["start_time"] = $infos["start_time"];
						$time["end_time"] = $infos["end_time"];
						$time["remind"] = $infos["remind"];
						$time["start_type"] = $infos["start_type"];
						$time["end_type"] = $infos["end_type"];
						$time["remind_type"] = $infos["remind_type"];
						$timeResult = $processingD->pocessItemTime($time);		// 处理时间的函数
						$session["timers"] = $timeResult;
				}
			} else {
					$session["theme"] = "此条信息已被作者删除 或 设置为隐私内容！";
					$session["content_isset"] = "_none";
					$session["time_isset"] = "_none";
			}
		} else if( $sort == 2 ) 
		{
			$session["operate"] = "chat";
			$session["item_isset"] = "_none";
			$session["chat_isset"] = "";
			$session["content_isset"] = "_none";
			$session["time_isset"] = "_none";
		}
		
		$session["name"] = $this->search_user_infos($belong,"name");
		$session["belong"] = $belong;
		$session["item"] = $item;
		$session["userItemId"] = $userItemId;
		$session["entity"] = $item;
	
		return $session;
	}
	
/*
	// data -> display
*/	
    public function handleMyDataToArray($datas) // 返回的数组内是对象 实现对象转成数组
    {
    	if( isset($datas) ) 
    	{
			$globalF = new GlobalFunc;
			for($i=0;$i<count($datas);$i++) {
				$datas[$i] = $globalF->object_array($datas[$i]);
			}
		}
    	return $datas;
    }
    public function showDatasToDisp($datasT) // 数组参数 | 返回 ITEM Display
    {
		//$processingD = new ProcessingData();
  		//$datasW = $processingD->pocessItems($datasT);	// 数组
  		//$datas = $datasW;
  		//$datas = collect($datasW);	// 集合
  		
  		$datas = $datasT;
		$items = view('assign.item',compact('datas'))->__toString();
		//$items = $items->all();
    	return $items;
    }
    public function showDatasToNote($datasT) // 数组参数 | 返回 ITEM Note
    {
  		$datas = $datasT;
		$items = view('assign.note',compact('datas'))->__toString();
    	return $items;
    }
    public function showDatasToComment($datasT) // 数组参数 | 返回 Comment
    {
  		$datas = $datasT;
		$datasF = view('assign.comment',compact('datas'))->__toString();
    	return $datasF;
    }
    public function showDatasToCommunication($datasT) // 数组参数 | 返回 Communacation
    {
//			if($display == "communication") // 正序排列
//			{
//				$globalF = new GlobalFunc;
//				$datasT = $globalF->_my_array_multisort($datasT,"id","SORT_ASC");
//			}
		$globalF = new GlobalFunc;
		//$datasT = $globalF->_my_array_multisort($datasT,"id","SORT_ASC");
		//$datasTs = $globalF->_my_sort($datasT,"id","SORT_ASC");
		//array_multisort($datasT,'SORT_ASC',$datasT);
		$collection = collect($datasT);
		$sorted = $collection->sortBy('id');
		$datasT = $sorted->values()->all();
		
  		$datas = $datasT;
		$datasF = view('assign.communication',compact('datas'))->__toString();
    	return $datasF;
    }
    public function showDatasToUser($datasT) // 数组参数 | 返回 User
    {
  		$datas = $datasT;
		$datasF = view('assign.assignUser',compact('datas'))->__toString();
    	return $datasF;
    }
    public function showDatasToPeople($datasT) // 数组参数 | 返回 People
    {
  		$datas = $datasT;
		$datasF = view('assign.assignPeople',compact('datas'))->__toString();
    	return $datasF;
    }
    public function showDatasToSession($datasT) // 数组参数 | 返回 Session List
    {
  		$datas = $datasT;
		$datasF = view('assign.assignSessionOption',compact('datas'))->__toString();
    	return $datasF;
    }
    public function showDatasToSessionWork($datasT) // 数组参数 | 返回 Session Work
    {
  		$data = $datasT;
		$datasF = view('assign.assignSessionWork',compact('data'))->__toString();
    	return $datasF;
    }

/*
	我的连接
*/

	public function insertMyConnection($db,$userId,$sort,$relation,$time) 
	{
		//$sql="insert into {$db}.my_Connection(sort,userId,relationship,startTime) values(:sort,:id,:relation,:time)";
		$tableMyConnection = $db.".my_Connection";
		$paraAarry["sort"] = $sort;
		$paraAarry["userId"] = $userId;
		$paraAarry["relationship"] = $relation;
		$paraAarry["startTime"] = $time;
		$id = DB::table($tableMyConnection)->insertGetId($paraAarry);
		return $id;
	}
	public function setMyRelation($db,$userId,$relation) // 是否与我有连接，是不是好友，
	{
    	$tableMyConnection = $db.".my_Connection";
    	$this->setTheTable($tableMyConnection,"relationship",$relation,"userId",$userId);
	}
	public function isConnection($id) // 是否与我有连接，是不是好友，
	{
		//$sql="select relationship from {$myDB}.my_Connection where userId = {$id}";
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
		$tableMyConnection = $myDB.".my_Connection";
		if($myDB) 
		{
	    	//$data = DB::table($tableMyConnection)->select('relationship')->where('userId', $id)->first();
	    	$data = DB::table($tableMyConnection)->where('userId', $id)->value('relationship');
		
			$isFriend = "";
			if($data) {
				$isFriend = $data;//->relationship;
			} else {
				$isFriend = "no";
			}
		}
		return $isFriend;
	}
	public function isMyRelation($whosDB,$objectId) // 是否与我有连接，是不是好友，
	{
    	$tableMyConnection = $whosDB.".my_Connection";
		//$sql="select relationship from {$whosDB}.my_Connection where userId = {$id}";
    	//$data = DB::table($myTable)->select($myTable.'.relationship')->where($myTable.'.userId', $id)->first();
    	$data = DB::table($tableMyConnection)->where('userId', $objectId)->value('relationship');
    	//$datas = $datas->toArray(); // to 数组
    	//$datas[$i] = $globalF->object_array($datas[$i]);
	
		$isFriend = "";
		if($data) {
			$isFriend = $data;//->relationship;
		} else {
			$isFriend = "no";
		}
		
		return $isFriend;
	}
	public function addConnRelation($whosDB,$objectId,$userSort,$relation,$time) // 添加关系
	{
		$isRelation = $this->isMyRelation($whosDB,$objectId);
		if($isRelation == "no") 
		{
			$return = $this->insertMyConnection($whosDB,$objectId,$userSort,$relation,$time);
		} else 
		{
			$this->setMyRelation($whosDB,$objectId,$relation);
			$return = $isRelation;
		}
		return $return;
	}
	
	public function addRelationAttention($myId,$objectId,$userSort,$time)
	{
		$myDB = "db".$myId;
		$objectDB = "db".$objectId;
		
		$isMyRelation = $this->isMyRelation($myDB,$objectId);
		if($isMyRelation == "no") {
			$return = $this->insertMyConnection($myDB,$objectId,$userSort,40,$time);
		} else 
		{
			if($isMyRelation < 40) {
			} else if($isMyRelation > 60) {
				$this->setMyRelation($myDB,$objectId,40);
			} else {
				$this->setMyRelation($myDB,$objectId,31);
			}
		}
		
		$isHisRelation = $this->isMyRelation($objectDB,$myId);
		if($isHisRelation == "no") {
			$return = $this->insertMyConnection($objectDB,$myId,1,60,$time);
		} else 
		{
			if($isHisRelation < 40) {
			} else if($isHisRelation > 60) {
				$this->setMyRelation($objectDB,$myId,60);
			} else {
				$this->setMyRelation($objectDB,$myId,31);
			}
		}
		
		//$myReturn = $this->addConnRelation($myDB,$objectId,$userSort,40,$time); // 添加我的关注
		//$objectReturn = $this->addConnRelation($objectDB,$myId,1,61,$time); // 添加对方的粉丝
		return $isMyRelation;
	}
	public function deleteRelationAttention($myId,$objectId)
	{
		$myDB = "db".$myId;
		$objectDB = "db".$objectId;
		
		$isMyRelation = $this->isMyRelation($myDB,$objectId);
		if($isMyRelation == "no") {
		} else 
		{
			if($isMyRelation < 40) {
				$this->setMyRelation($myDB,$objectId,60);
			} else if($isMyRelation > 60) {
				$this->setMyRelation($myDB,$objectId,93);
			} else {
				$this->setMyRelation($myDB,$objectId,93);
			}
		}
		
		$isHisRelation = $this->isMyRelation($objectDB,$myId);
		if($isHisRelation == "no") {
			$return = $this->insertMyConnection($objectDB,$myId,1,60,$time);
		} else 
		{
			if($isHisRelation < 40) {
				$this->setMyRelation($objectDB,$myId,40);
			} else if($isHisRelation > 60) {
				$this->setMyRelation($objectDB,$myId,94);
			} else {
				$this->setMyRelation($objectDB,$myId,94);
			}
		}
		
		//$myReturn = $this->addConnRelation($myDB,$objectId,$userSort,40,$time); // 添加我的关注
		//$objectReturn = $this->addConnRelation($objectDB,$myId,1,61,$time); // 添加对方的粉丝
		return $isMyRelation;
	}
	
	public function getMyConnection($type) 
	{
		$myID = Auth::user()->id;
		$myDB = "db".$myID;
    	
    	$tableUserLog = "my_home.user_log";
		$tableMyConnection = $myDB.".my_Connection";
		
		if($type == "linkman") {
	    	$datas = DB::table($tableMyConnection) ->join($tableUserLog, $tableUserLog.'.id', '=', $tableMyConnection.'.userId')
			 //->where($tableMyOthers.'.'.$field, '=', $value)
			 ->where($tableMyConnection.'.relationship', '=', 31)
			 //->select($tableUserLog.'.*', $tableMyConnection.'.relationship as relationship')
			 ->select($tableUserLog.'.*', $tableMyConnection.'.relationship')
			 ->orderBy($tableUserLog.'.name', 'asc')->get();
//			$sql="select {$home_db}.user_log.*,{$myDB}.my_Connection.relationship
//				from {$myDB}.my_Connection inner join {$home_db}.user_log on {$home_db}.user_log.id = {$myDB}.my_Connection.userId
//				where {$myDB}.my_Connection.relationship = 11
//				order by {$home_db}.user_log.name asc";
		} else if($type == "follow") {
	    	$datas = DB::table($tableMyConnection) ->join($tableUserLog, $tableUserLog.'.id', '=', $tableMyConnection.'.userId')
			 //->where($tableMyOthers.'.'.$field, '=', $value)
			 ->where($tableMyConnection.'.relationship', '=', 40)
			 ->select($tableUserLog.'.*', $tableMyConnection.'.relationship')
			 ->orderBy($tableUserLog.'.name', 'asc')->get();
		} else if($type == "fans") {
	    	$datas = DB::table($tableMyConnection) ->join($tableUserLog, $tableUserLog.'.id', '=', $tableMyConnection.'.userId')
			 //->where($tableMyOthers.'.'.$field, '=', $value)
			 ->where($tableMyConnection.'.relationship', '=', 60)
			 ->select($tableUserLog.'.*', $tableMyConnection.'.relationship')
			 ->orderBy($tableUserLog.'.name', 'asc')->get();
		} else if($type == "group") {
	    	$datas = DB::table($tableMyConnection) ->join($tableUserLog, $tableUserLog.'.id', '=', $tableMyConnection.'.userId')
			 //->where($tableMyOthers.'.'.$field, '=', $value)
			 ->where($tableMyConnection.'.sort', '=', 6)
			 ->select($tableUserLog.'.*', $tableMyConnection.'.relationship')
			 ->orderBy($tableUserLog.'.name', 'asc')->get();
		} 
		
    	$datasT = $this->handleMyDataToArray($datas);
		$peoples = $this->showConnections($datasT);
		return $peoples;
	}
	
	public function showConnections($infos) 
	{
		$getDisplay = "";
		for($i=0;$i<count($infos);$i++)
		{
			$infos[$i]["random"] = rand(1000,9999);
			if($getDisplay == "pc") {
				$infos[$i]["controller"] = "card-ctrl";
			} else if($getDisplay == "mobile") {
				$infos[$i]["controller"] = "mobile-card-ctrl";
			}
			//$belong = $infos[$i]["belongId"];
			//$itemId = $infos[$i]["itemId"];
			//$belong_name = search_user_infos($belong,"name");
			//$source_name = search_user_infos($source,"name");
		}
		return $infos;
	}
	
	
	
	public function searchUsers($search) // 查找用户
	{
		$tableUserLog = "my_home.user_log";
		if( Session::has('isLog') ) {
			$myID = Session::get('myID');
		} else {
			$myID = 0;
		}
		$searchText = "%".$search."%";
		if($search == "") {
			//$sql="select id,name,sort,type,location,autograph from {$home_db}.user_log where id != {$my_id} order by id desc";
    		$datas = DB::table($tableUserLog)->select('id','name','sort','type','location','autograph')->where('id', '!=', $myID)->orderBy('id', 'desc')->get();
		}
		else {
			//$sql="select id,name,sort,type,location,autograph from {$home_db}.user_log where (id = :search or name like :search) and id != {$my_id} order by id desc";
    		$datas = DB::table($tableUserLog)->select('id','name','sort','type','location','autograph')
    		->where('id', 'like', $searchText)->orWhere('name', 'like', $searchText)->orderBy('id', 'desc')->get();
		}

    	$datasT = $this->handleMyDataToArray($datas);
		$users = $this->showUsers($datasT);
		return $users;
	}
	public function searchTheUser($id) // 查找用户，用 id 查找
	{
		$users[0] = $this->search_user_infos($id,"all");
		$users = $this->showUsers($users);
		return $users;
	}
	public function showTheUser($id) // 查找用户，用 id 查找
	{
		$users = $this->searchTheUser($id);
    	$displayShow = $this->showDatasToUser($users);
		return $displayShow;
	}
	public function showUsers($users) // show 返回用户 user Display
	{ 
		$globalFunc = new GlobalFunc;
		$random = rand(1000,9999);
		
		for($i=0;$i<count($users);$i++)
		{
			$users[$i]["ReRequest"] = "_none";
			$users[$i]["ReDelete"] = "_none";
			$users[$i]["ReAttention"] = "_none";
			$users[$i]["ReCansel"] = "_none";
			$users[$i]["attention_isset"] = "_none";
			$users[$i]["attentionC_isset"] = "_none";
			
			$users[$i]["random"] = $random;
			$location = $users[$i]["location"];
			$autograph = $users[$i]["autograph"];
			
			if($users[$i]["autograph"] == "") {
				$users[$i]["autograph_isset"] = "_none";
			} else {
				$users[$i]["autograph"] = $globalFunc->_my_replace($autograph);
			}

			$isConnection = $this->isConnection($users[$i]["id"]);
			if($isConnection == "no") 
			{
				$users[$i]["operationText"] = "关注";
				$users[$i]["ReRequest"] = "";
				$users[$i]["ReAttention"] = "";
				$users[$i]["attention_isset"] = "";
				
			} else if($isConnection == "21") // 好友关系
			{
				$users[$i]["operationText"] = "解除关系";
				$users[$i]["ReDelete"] = "";
				$users[$i]["attentionC_isset"] = "";
			} else if($isConnection == "31") // 互相关注
			{
				$users[$i]["attentionC_isset"] = "";
				$users[$i]["attentionC_text"] = "互相关注";
			} else if($isConnection == "40") // 已关注
			{
				$users[$i]["operationText"] = "取消关注";
				$users[$i]["ReCansel"] = "";
				$users[$i]["attentionC_isset"] = "";
				$users[$i]["attentionC_text"] = "已关注";
			} else if($isConnection == "3") {
			} else if($isConnection == "4") {
			} else if($isConnection == "12") {
				$users[$i]["operation_show"] = "已经发送请求";
			} else {
				$users[$i]["attention_isset"] = "";
			}

		}
		
		return $users;
	}


/*
	ajax
*/	
	public function addIt($operateSort,$myID,$userItemId,$belong,$item,$time,$content,$share) // item.collect 收藏
	{
			$myDB = "db".$myID;
			$tableUserItem = "my_home.users_Item";
			$tableMyMines = $myDB.".my_Mines";
			
			$belongDB = "db".$belong;
			$paraC["belongDB"] = $belongDB;
			$paraC["type"] = 1;
			
			$isset = $this->isset_myMines($myDB,$userItemId);
			if($isset == 0) 
			{
				$isInsertMyMine = "yes";
				$isScored = 0;
			} else
			{
				$isInsertMyMine = "no";
				if($isset["score"] == 0) 
				{
					$isScored = 0;
				} else 
				{
					$isScored = 1;
				}
			}
			
			$paraIsFocusIt = 0;
			if($operateSort == "favorIt") // 收藏
			{
				$paraSort = 50;
				$paraAttr = "isFavor";
				$paraTime = "favorTime";
				$paraValue = 1;
				$this->setINC($userItemId,"favorNum",1);
			}
			else if($operateSort == "collectIt") // 收藏
			{
				$paraSort = 20;
				$paraAttr = "isCollected";
				$paraTime = "collectTime";
				$paraValue = 1;
				$this->setINC($userItemId,"collectNum",1);
			}
			else if($operateSort == "workIt") // + 待办
			{
				$paraSort = 21;
				$paraAttr = "isWorked";
				$paraTime = "workTime";
				$paraValue = 1;
			}
			else if($operateSort == "focusIt") // 关注
			{
				$paraSort = 22;
				$paraAttr = "isFocused";
				$paraTime = "focusTime";
				$paraValue = 1;
				$paraIsFocusIt = 1;
				$this->setINC($userItemId,"focusNum",1);
			}
			else if($operateSort == "scoreIt") // 关注
			{
				$paraSort = 49;
				$paraAttr = "score";
				$paraTime = "scoreTime";
				$paraValue = $share;
				if($isScored == 1)
				{
					$this->setDEC($userItemId,"scoreTotal",(int)$isset["score"]);
					$paraC["type"] = 2;
				} else 
				{
					$this->setINC($userItemId,"scoreNum",1);
				}
				$this->setINC($userItemId,"scoreTotal",(int)$paraValue);
				$itemInfo = $this->selectInfos($userItemId);
				$scoreNum = (int)$itemInfo["scoreNum"];
				$scoreTotal = (int)$itemInfo["scoreTotal"];
				if($scoreNum == 0) 
				{
					$scoreAVG = 0;
				} else
				{
					$scoreAVG = ($scoreTotal*2)/$scoreNum;
				}
  				$this->setTheTable($tableUserItem,"scoreAVG",$scoreAVG,"id",$userItemId);
//    			$sql="UPDATE my_home.users_item set scoreAVG=(scoreTotal*2)/scoreNum where id = {$userItemId}";
//				DB::statement($sql);
				$share = 99;
				$paraC["score"] = $paraValue;
			}
//			
    		if( $myID == $belong ) // 是自己的
			{
				// set user_item
				if($operateSort != "scoreIt") 
				{
    				$this->setTheTable($tableUserItem,$paraAttr,$paraValue,"id",$userItemId);
				} 
    			$this->setTheTable($tableUserItem,"modified",$time,"id",$userItemId);
    			$paraBelongType = 1;
			}
			else {
    			$paraBelongType = 9;
			}
			
			
			if($isInsertMyMine == "yes") 
			{
				$itemIfos = $this->selectInfos($userItemId);
				// 添加 my_mines
				$paraM["db"] = $myDB;
				$paraM["sort"] = $itemIfos["sort"];
				$paraM["type"] = $itemIfos["type"];
				$paraM["form"] = $itemIfos["form"];
				$paraM["belongType"] = $paraBelongType;
				$paraM["userItemId"] = $userItemId;
				$paraM["belongId"] = $belong;
				$paraM["itemId"] = $item;
				$paraM["time"] = $time;
				$paraM["timeType"] = $itemIfos["timeType"];
				if($paraM["timeType"] != 0)
				{
					$paraM["start_time"] = $itemIfos["start_time"];
					$paraM["end_time"] = $itemIfos["ended"];
					$paraM["isFocused"] = $paraIsFocusIt;
				}
				$paraM["start_time"] = $itemIfos["start_time"];
				$paraM["end_time"] = $itemIfos["end_time"];
				$paraM["isWorked"] = 0;
				$paraM["importance"] = 0;
				$paraM["isShared"] = $share;
				$minesId = $this->insertMyMines($paraM);
			} 
			// set my_mines
//    		$this->setTheTable($tableMyMines,$paraAttr,$paraValue,"userItemId",$userItemId);
//			$this->setTheTable($tableMyMines,"modified",$time,"userItemId",$userItemId);
//			$this->setTheTable($tableMyMines,$paraTime,$time,"userItemId",$userItemId);
			$paraSM[$paraAttr] = $paraValue;
			$paraSM[$paraTime] = $time;
			$paraSM["modified"] = $time;
			DB::table($tableMyMines) ->where('userItemId', $userItemId)->update($paraSM);
//			
			// 添加 communication
			$paraC["db"] = $belongDB;
			$paraC["sort"] = $paraSort;
			$paraC["time"] = $time;
			$paraC["userItemId"] = $userItemId;
			$paraC["belong"] = $belong;
			$paraC["item"] = $item;
			$paraC["source"] = $myID;	
			$paraC["content"] = $content;
			$paraC["share"] = $share;
			$this->addTheCommunication($paraC);
			
			$this->addSession($myID,1,$paraSort,$belong,$item,$userItemId,0,$time);
			if( ($belong != $myID) && ($share > 20) ) 
			{
				$this->addSession($belong,1,$paraSort,$belong,$item,$userItemId,1,$time);
			}
			//return $isset;
	}
	public function canselIt($operateSort,$myID,$userItemId,$belong,$item,$time,$content,$share) // item.collect 取消收藏
	{
			$myDB = "db".$myID;
			$tableUserItem = "my_home.users_Item";
			$tableMyMines = $myDB.".my_Mines";
			
			$belongDB = "db".$belong;
			$para["belongDB"] = $belongDB;
			
			if($operateSort == "favorCansel") // 取消收藏
			{
				$paraSort = 50;
				$paraAttr = "isFavor";
				$this->setDEC($userItemId,"favorNum",1);
			} else if($operateSort == "canselCollect") // 取消收藏
			{
				$paraSort = 20;
				$paraAttr = "isCollected";
				$this->setDEC($userItemId,"collectNum",1);
			} else if($operateSort == "canselWork") // 取消待办
			{
				$paraSort = 21;
				$paraAttr = "isWorked";
			}  else if($operateSort == "canselFocus") // 取消关注
			{
				$paraSort = 22;
				$paraAttr = "isFocused";
				$this->setDEC($userItemId,"focusNum",1);
			} 
			
			if( $myID == $belong ) // 是自己的
			{
				// set user_item
    			$this->setTheTable($tableUserItem,$paraAttr,99,"id",$userItemId);
    			$this->setTheTable($tableUserItem,"modified",$time,"id",$userItemId);
			}
			
			// set my_mines
    		$this->setTheTable($tableMyMines,$paraAttr,99,"userItemId",$userItemId);
    		$this->setTheTable($tableMyMines,"modified",$time,"userItemId",$userItemId);
    		
			// 添加 communication
			$para["db"] = $belongDB;
			$para["sort"] = $paraSort;
			$para["type"] = 2;
			$para["time"] = $time;
			$para["userItemId"] = $userItemId;
			$para["belong"] = $belong;
			$para["item"] = $item;
			$para["source"] = $myID;
			$para["content"] = $content;
			$para["share"] = $share;
			$this->addTheCommunication($para);
		
			$this->addSession($myID,1,$paraSort,$belong,$item,$userItemId,0,$time);
			if($share > 0) {
				$this->addSession($belong,1,$paraSort,$belong,$item,$userItemId,1,$time);
			}
	}


	public function socketToSession($para)
	{
		//$para["myID"] = 120;
		//$para["myName"] = "socketName";
    	$jsonData = json_encode($para);
    	
		$redis = LRedis::connection();
		$redis->publish('laravelSessionChannel', $jsonData);
		//LRedis::publish('laravelSessionChannel', $jsonData);
	}
	
	public function test()
	{
		echo "SQLFunc.php success.";
	}

}
