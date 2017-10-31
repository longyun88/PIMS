<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use DB;
use App\Tools\SQLFunc;

class ModifyController extends Controller
{
    //
    public function index()
    {
    	echo "Start <br/>";
    	
//    	$this->changeUserId(1013,11111); // 更改用户ID
//    	dd("changeUserId.sucess");

    	//$this->deleteCommunication(1175); // 删除
    	
    	//$this->modifyHomeDB(); // 添加或修改字段 属性 Attribute
    	//$this->modifyHome_update();
    	
    	//$this->modifyFunc();
    	
    	//echo "modifySQL_setTable";
    	//$this->modifySQL_setTable("my_item",1,182,"sort",32,"isRevisable",1);
    	//$this->modifySQL_setTable("my_item",333,334,"sort",32,"isRevisable",1);
    	//$this->modifySQL_setTable("my_item",1011,1013,"sort",32,"isRevisable",1);
    	//dd("modifySQL_setTable");
    	
    	//$this->modifyAttachingFunc();
    	echo "Ended <br/>";
    }
    
    protected function deleteCommunication($userItemId)
    {
		$tableCommunication = "my_home.users_communication";
		DB::table($tableCommunication)->where("userItemId", $userItemId)->delete();
    }
    
    protected function modifyAttachingFunc() 
    {
    	echo "modifyAttachingFunc <br/>";
    	$sqlFunc = new SQLFunc;
		$tableUsersItem = "my_home.users_item";
    	$datas = DB::table($tableUsersItem)->select('id','belongId','itemId','attaching')->where('attaching', '!=', "")->get();
    	//dd($datas);
		for($i=0;$i < count($datas);$i++) 
		{
			$belongId = $datas[$i]->belongId;
			$itemId = $datas[$i]->itemId;
			$userItemId = $datas[$i]->id;
			$attaching = $datas[$i]->attaching;
			
			//$sqlFunc->setAttaching($belongId,$itemId,$userItemId,$attaching);
			//echo $userItemId."-".$belongId."-".$itemId."-"."<br/>";
		}
    }
    
    protected function modifyFunc() 
    {
    	echo "modifySQL_Func Start <br/>";
    	$this->modifySQL_Func(1,5);
    	$this->modifySQL_Func(21,22);
    	$this->modifySQL_Func(60,182);
    	$this->modifySQL_Func(333,334);
    	$this->modifySQL_Func(1011,1013);
    	$this->modifySQL_Func(1024,1025);
    	$this->modifySQL_Func(11111,11121);
    	dd("modifySQL_Func End");
    }
    
	protected function modifyHomeDB() // 添加或修改 my_home 字段 属性 Attribute
	{
    		echo "modifyHomeDB Start <br/>";
    		
//			$sql="create table if not exists user_verification
//			(
//				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
//				sort TINYINT UNSIGNED NOT NULL UNIQUE DEFAULT 0,
//				type TINYINT UNSIGNED NOT NULL UNIQUE DEFAULT 0,
//				userId INT UNSIGNED NOT NULL DEFAULT 0,
//				verificationCode VARCHAR(64) NOT NULL DEFAULT '',
//				time BIGINT UNSIGNED NOT NULL DEFAULT 0,
//				deadline BIGINT UNSIGNED NOT NULL
//			) ENGINE=MyISAM DEFAULT CHARSET=utf8";

			//$sql="alter table my_home.users_item add scoreAVG VARCHAR(8) NULL DEFAULT '0' AFTER attentionNum"; // 插入一个字段
			//$sql="alter table my_home.users_item add isFavor TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER completeTime"; // 插入一个字段
			//$sql="alter table my_home.users_item modify scoreAVG FLOAT(3,1) NOT NULL DEFAULT 0"; // 修改一个字段
			//$sql="alter table my_home.users_item modify scoreTotal INT NOT NULL DEFAULT 0"; // 修改一个字段
			$sql="alter table my_home.users_communication modify replyNum INT NOT NULL DEFAULT 0"; // 修改一个字段
			
			
			
			//$sql="alter table my_home.users_item change favourNum favorNum INT UNSIGNED NOT NULL DEFAULT 0"; // 修改一个字段名
			 
			
			//$sql="alter table my_home.users_communication add score TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER tip"; // 插入一个字段
			
			//$sql="alter table my_home.user_log add sessionType TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER unread "; // 插入一个字段
			//$sql="alter table my_home.user_log modify name VARCHAR(64) NOT NULL DEFAULT ''"; // 修改一个字段
			
			//$sql="alter table my_home.user_log add UNIQUE('name') "; // 添加约束
			//$sql="alter table my_home.user_log drop index name"; // 去掉约束
			
			//$sql="delete from my_home.users_item where sort = 19 or sort =1";
			
			//$sql="alter table my_home.users_communication drop column oppositeId"; // 删除一列
			
			DB::statement($sql);
    		echo "modifyHomeDB End <br/>";
	}
	
	protected function modifyHome_update()  // 修改 my_home 字段 值 VALUE
	{
		echo "modifyHome_update - Start </br>";
		//$sql="UPDATE my_home.users_item set originUserItemId = {$originUserItemId},originBelong = {$originBelong},originItem = {$originItem} where id = {$id}";
		
		$tableUserLog = "my_home.user_log";
		$tableUserItem = "my_home.users_item";
		$tableUserCommuni = "my_home.users_communication";
		// 
//		$paraA["commentNum"] = 0;
//		$paraA["collectNum"] = 0;
//		$paraA["itemRank"] = 0;
//		DB::table($tableUserLog)->update($paraA);
//		DB::table($tableUserItem)->update($paraA);
//		DB::table($tableUserItem)->where('sort', 48)->update($paraA);
		//DB::table($tableUserCommuni)->delete();
		
		echo "modifyHome_update - End </br>";
	}
	
	
	
	protected function modifySQL_setTable($table,$startNum,$endedNum,$whereAttr,$whereValue,$setAttr,$setValue) // 修改集体字段值
	{
		$paraA[$setAttr] = $setValue;
		
		for($i=$startNum;$i < $endedNum;$i++) 
		{
			$db = "db".$i;
			//$table = "my_item";
			$tableMyTable = $db.".".$table;
			
			//$whereAttr = "sort";
			//$whereValue = "1";
			//$paraA["isRevisable"] = 0;
			$paraA[$setAttr] = $setValue;
			
			$datas = DB::table('information_schema.TABLES')->select("*")->where('TABLE_SCHEMA',$db)->where('TABLE_NAME',$table)->first();
	    	if( isset($datas) ) {
				DB::table($tableMyTable)->where($whereAttr,$whereValue)->update($paraA);
				//DB::table($tableMyTable)->update($paraA);
				echo $i."yes </br>";
	    	} else {
				//echo $i."no </br>";
	    	}
	    }
	}
	
	protected function modifySQL_Func($startNum,$endedNum) // 修改集体字段
	{
		$tableUserLog = "my_home.user_log";
		$tableUserItem = "my_home.users_item";
		
		for($i=$startNum;$i < $endedNum;$i++) {
			$db = "db".$i;
			$table = "my_item";
			$dbMyItem = "db".$i.".my_item";
			$dbMyMines = "db".$i.".my_mines";
			//$table = "my_Communication";
			//$datas = DB::table('information_schema.TABLES')->select("*")->where('TABLE_SCHEMA',$db)->first();
			$datas = DB::table('information_schema.TABLES')->select("*")->where('TABLE_SCHEMA',$db)->where('TABLE_NAME',$table)->first();
			
	    	if( isset($datas) ) 
	    	{
	    		// 创建表
//			  	$sqlFunc = new SQLFunc;
//			  	$sqlFunc->create_MyMines($db);
			  	
			  	// 插入一个新字段
				//$sql="alter table {$db}.my_Mines change BoughtTime boughtTime BIGINT UNSIGNED NOT NULL DEFAULT 0"; // 修改一个字段名
				//$sql="alter table {$db}.my_Mines add isFavor TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER ended"; // 插入一个字段
				//$sql="alter table {$db}.my_Mines add favorTime BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER isFavor"; // 插入一个字段
	
				//修改字段
				//$sql="alter table {$db}.my_Item modify isRevisable TINYINT UNSIGNED NOT NULL DEFAULT 0"; // 修改一个字段
				//$sql="alter table {$db}.my_item modify attachment VARCHAR(2048)"; // 修改一个字段
				
				// 更新字段值
				//$sql="update {$db}.my_mine m, {$db}.my_item i set m.userItemId = i.userItemId where m.itemId = i.id"; // 更新一个字段
				//$sql="update {$db}.my_item set isRevisable = 0 where sort = 41 or sort = 44 or sort = 48"; // 更新一个字段
				//$paraA["belongType"] = 1;
				//$paraA["commentNum"] = 0;
				//DB::table($dbMyMines)->update($paraA);
				//DB::table($dbMyItem)->update($paraA);

				// 删除字段
				//$sql="delete from {$db}.my_others where sort = 19 or sort =1";
				//$sql="delete from {$db}.my_Communication"; // 删除字段
				//$sql="delete from {$db}.my_Session"; // 删除字段

				// 复制表格
//				$sql="insert into {$db}.my_mines (sort,type,form,userItemId,belongId,itemId,time,modified,timeType,start,ended,isShared) "
//				."select sort,type,form,userItemId,belongId,id as itemId,time,modified,timeType,start,ended,isShared from {$db}.my_Item";
				
				// 删除表
				//$sql="DROP TABLE IF EXISTS {$db}.my_item_info";
				
				DB::statement($sql);
				
				// 
//				$myItem = DB::table($dbMyItem)->select('id','userItemId')->orderBy('id', 'desc')->first();
//				$userItem = DB::table($tableUserItem)->select('id','itemId')->where('belongId', $i)->orderBy('id', 'desc')->first();
//				if( isset($myItem) )
//				{
//					if($myItem->id == $userItem->itemId) 
//					{
//						$paraA["itemRank"] = $myItem->id;
//						DB::table($tableUserLog)->where('id', '=' ,$i)->update($paraA);
//					}
//					echo $i." -/- ".$myItem->id." -/-".$userItem->itemId." -/- yes </br>";
//				}
		
				echo $i." -/- ".$db." -/-".$dbMyItem." -/- yes </br>";
	    	} else {
				//echo $i." - no </br>";
	    	}
    	
//			//$sql="alter table {$db}.my_connection engine=myisam"; // 修改引擎
//			$sql="DROP TABLE IF EXISTS {$db}.my_event"; // 删除表
//			DB::statement($sql);
//			
//			//$sql="alter table {$db}.my_session engine=myisam"; // 修改引擎
//			$sql="DROP TABLE IF EXISTS {$db}.my_forward"; // 删除表
//			DB::statement($sql);
//			
//			//$sql="alter table {$db}.my_tips engine=myisam"; // 修改引擎
//			$sql="DROP TABLE IF EXISTS {$db}.my_utterance"; // 删除表
//			DB::statement($sql);
			
			
			
			
			/*$sql="create table if not exists {$db}.my_Mine // 创建表
			(
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				sort TINYINT UNSIGNED NOT NULL DEFAULT 0,
				type TINYINT UNSIGNED NOT NULL DEFAULT 0,
				itemId BIGINT UNSIGNED
			)";*/
			
			
			//$sql="insert into db1.my_item (rank,sort,time,modified,theme,content,tag) select rank,sort,time,modified,theme,content,tag from longyun.my_item"; // 复制表
			//$sql="insert into {$db}.my_mine (sort,type,itemId) select sort,type,id as itemId from {$db}.my_item"; // 复制表
			
			
			//$sql="UPDATE {$db}.my_Item INNER JOIN {$db}.my_mine ON {$db}.my_Item.id={$db}.my_mine.itemId SET {$db}.my_Item.mineId={$db}.my_mine.id"; // 修改字段值
			//$sql="UPDATE my_home.users_item INNER JOIN {$db}.my_Unfinished ON my_home.users_item.id={$db}.my_Unfinished.userItemId 
				//SET {$db}.my_Unfinished.itemId=my_home.users_item.itemId"; // 修改字段值
			
			
			//create_Mine($db);
			//create_Others($db);
		}
	}
	
	
	protected function changeUserId($beforeId,$afterId) // 修改默认值，在修改一个
	{
		$beforeDB = "db".$beforeId;
		$afterDB = "db".$afterId;
		
		$tableUserLog = "my_home.user_log";
		$paraA["id"] = $afterId;
		$paraA["db"] = $afterDB;
		DB::table($tableUserLog)->where('id', $beforeId)->update($paraA);
		
		$this->modifyDefault($afterDB,$afterId);
	}
	protected function modifyDefault($db,$default) // 修改默认值，在修改一个
	{
			$sql="alter table {$db}.my_Item modify belongId INT UNSIGNED NOT NULL DEFAULT {$default}"; // 修改一个字段
			DB::statement($sql);
			$sql="alter table {$db}.my_Item modify sourceId INT UNSIGNED NOT NULL DEFAULT {$default}"; // 修改一个字段
			DB::statement($sql);
			$sql="alter table {$db}.my_Communication modify belongId INT UNSIGNED NOT NULL DEFAULT {$default}"; // 修改一个字段
			DB::statement($sql);
			
			echo "yes<br>";
	}
	
	
	protected function ceateUserCommunication() // 在 my_home 创建一个新的表 users_Communication
	{
			$sql="create table if not exists my_home.users_Communication
			(
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				sort TINYINT UNSIGNED NOT NULL DEFAULT 0,
				type TINYINT UNSIGNED NOT NULL DEFAULT 0,
				time BIGINT UNSIGNED NOT NULL,
				
				userItemId BIGINT UNSIGNED NOT NULL,
				belongId INT UNSIGNED NOT NULL DEFAULT 0,
				itemId INT UNSIGNED NOT NULL,
				itemVersion INT UNSIGNED,
				belongCommunicationId INT UNSIGNED NOT NULL DEFAULT 0,
				
				sourceId INT UNSIGNED NOT NULL,
				objectId INT UNSIGNED,
				pointId INT UNSIGNED,
				oppositeId INT UNSIGNED,
				dialog INT UNSIGNED,
				quoteUserItemId INT UNSIGNED,
				quoteBelong INT UNSIGNED,
				quoteItem INT UNSIGNED,
				
				content VARCHAR(2048) NOT NULL DEFAULT '',
				tip INT UNSIGNED NOT NULL DEFAULT 0,
				
				favorNum INT UNSIGNED NOT NULL DEFAULT 0,
				dislikeNum INT UNSIGNED NOT NULL DEFAULT 0,
				replyNum INT UNSIGNED NOT NULL DEFAULT 0,
				isShared TINYINT UNSIGNED NOT NULL DEFAULT 0,
				permission INT UNSIGNED NOT NULL DEFAULT 0
			) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			
			DB::statement($sql);
	}
	
	
}
