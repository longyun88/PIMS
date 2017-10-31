<?php

namespace App\Tools;

use Session;
use Image;

use App\Tools\GlobalFunc;
use App\Tools\SQLFunc;


class ProcessingData
{
	
	public function pocessItems($item) // 处理数据 返回 Data Show
	{
		$globalFunc = new GlobalFunc;
		$SQLFunc = new SQLFunc;
		
		$myID = Session::get('myID');
		$myDB = Session::get('myDB');
		
		$random = rand(1000,9999);
		for($i=0;$i<count($item);$i++)
		{
			// 属性 初始化
			$item[$i]["random"] = $random;
		
			$item[$i]["isset_none"] = "_none";
			
			$item[$i]["header_isset"] = "_none";
			$item[$i]["timeIS"] = "_none";
			$item[$i]["infosIS"] = "_none";
			$item[$i]["attachingIS"] = "_none";
			$item[$i]["attachmentIS"] = "_none";
			$item[$i]["price_IS"] = "_none";
			$item[$i]["senderIS"] = "_none";
			$item[$i]["receiverIS"] = "_none";
			$item[$i]["quoteIS"] = "_none";
			$item[$i]["originIS"] = "_none";
			
			$item[$i]["newsIS"] = "_none";
			$item[$i]["sourcePortrait_IS"] = "_none";
			
			// 初始化按钮为空
			$item[$i]["forwardIS"] = "_none";
			$item[$i]["delete_IS"] = "_none";
			$item[$i]["modify_IS"] = "_none";
			$item[$i]["share_IS"] = "_none";
			$item[$i]["workItIS"] = "_none"; 
			$item[$i]["workItCIS"] = "_none";
			$item[$i]["focusIS"] = "_none";
			$item[$i]["focusCIS"] = "_none";
			$item[$i]["collectIS"] = "_none";
			$item[$i]["collectCIS"] = "_none";
			$item[$i]["favorIS"] = "_none";
			$item[$i]["favorCIS"] = "_none";
			
			$item[$i]["other_timeIS"] = "_none";
			$item[$i]["attachingIsset"] = 0;
				
					
			// 名字
			if($item[$i]["belongId"] == 0) {
				$item[$i]["belongName"] = "longyun";
			} else {
				$item[$i]["belongName"] = $SQLFunc->search_user_infos($item[$i]["belongId"],"name");
				$item[$i]["source_name"] = $SQLFunc->search_user_infos($item[$i]["sourceId"],"name");
			}
			
				
			// ITEM 是否存在
			// 
			if( isset($item[$i]["isset"]) )
			{
				if($item[$i]["isset"] == "_none") // 不存在
				{
					$item[$i]["isset_none"] = "";
						
					$item[$i]["receivers"] = array();
					$item[$i]["tag"] = array();
					$item[$i]["attachingShower"] = array();
					$item[$i]["origin"]["originAttaching"] = array();
				}  
			}
			else  // 存在
			{ 
				$item[$i]["id"] = $item[$i]["id"];
				$item[$i]["belong"] = $item[$i]["belongId"];
				$item[$i]["source"] = $item[$i]["sourceId"];
				$item[$i]["object"] = $item[$i]["objectId"];
			
				$id = $item[$i]["id"];
				$belong = $item[$i]["belongId"];
				$source = $item[$i]["sourceId"];
				
				$item[$i]["userItemId"] = $item[$i]["id"];
				
				
				if($item[$i]["belongId"] == $item[$i]["sourceId"]) // 是否为同一人
				{ 
					$item[$i]["sourcePortrait_IS"] = "_none";
				} else {
					$item[$i]["sourcePortrait_IS"] = "";
				}
				
				// 对象
				if( isset($item[$i]["objectId"]) ) 
				{
					//$item[$i]["object_name"] = SQLFunc->search_user_infos($item[$i]["objectId"],"name");
				} 
			


				// 属性 可视化
				
					$item[$i]["receivers"] = array();
				
					$item[$i]["time"] = $item[$i]["time"];//时间
					$item[$i]["time_show"] = $globalFunc->_time_switch($item[$i]["time"]);
					
					// 修改时间
					if($item[$i]["modified"] == "") {
						$item[$i]["modifiedIS"] = "_none";
					} else {
						$item[$i]["modified"] = $item[$i]["modified"];
						$item[$i]["modified_show"] = $globalFunc->_time_switch($item[$i]["modified"]);
						$item[$i]["timer_isset"] = "_none";
					}
					//完成时间
//					if($item[$i]["completedTime"] == "") {
//						$item[$i]["cpd_timeIS"] = "_none";
//					} else {
//						$item[$i]["cpd"] = $item[$i]["completedTime"];
//						$item[$i]["cpd_show"] = $globalFunc->_time_switch($item[$i]["cpd"]);
//						$item[$i]["timer_isset"] = "_none";
//					}
					
					// important
					if($item[$i]["importance"] == "" || $item[$i]["importance"] == 0) {
						$item[$i]["infos_imp"] = "";
					} else if($item[$i]["importance"] == 1) {
						$item[$i]["importance_show"] = "一般事项";
						$item[$i]["importanceColor"] = "_grey";
					} else if($item[$i]["importance"] == 2) {
						$item[$i]["importance_show"] = "中等事项";
						$item[$i]["importanceColor"] = "_green";
					} else if($item[$i]["importance"] == 3) {
						$item[$i]["importance_show"] = "重要";
						$item[$i]["importanceColor"] = "_blue";
					} else if($item[$i]["importance"] == 4) {
						$item[$i]["importance_show"] = "紧急";
						$item[$i]["importanceColor"] = "_orange";
					} else if($item[$i]["importance"] == 5) {
						$item[$i]["importance_show"] = "重要&紧急";
						$item[$i]["importanceColor"] = "_red";
					}
					
					if($item[$i]["theme"] == "") // 主题
					{
						//$item[$i]["themeIS"] = "_none";
						if($item[$i]["sort"] == 11) {
							$item[$i]["themeIS"] = "_none";
						} else if($item[$i]["sort"] == 19) {
							$item[$i]["theme"] = "";
							$item[$i]["themeIS"] = "_none";
						} else {
							$item[$i]["theme"] = "无主题";
						}
					} else {
						//$item[$i]["theme"] = htmlspecialchars($item[$i]["theme"]);
						$item[$i]["theme"] = $globalFunc->_my_replace($item[$i]["theme"]); // 特殊字符处理
						$item[$i]["theme"] = $globalFunc->_replace_blank($item[$i]["theme"]); // 空格，换行
					}
					
					if($item[$i]["content"] == "") // 内容
					{
						$item[$i]["contentIS"] = "_none";
					} else {
						//$item[$i]["content"] = htmlspecialchars($item[$i]["content"]);
						$item[$i]["content"] = $globalFunc->_my_replace($item[$i]["content"]); // 特殊字符处理
						$item[$i]["content"] = $globalFunc->_replace_blank($item[$i]["content"]); // 空格，换行
					}
						
					if($item[$i]["tag"] == "") // 关键字
					{
						$item[$i]["tag_tool_show"] = "添加标签";
						$item[$i]["tag"] = array();
					} else {
						$item[$i]["tag"] = explode(" ",$item[$i]["tag"]);
						$item[$i]["tag_show"] = $item[$i]["tag"];
						$item[$i]["tag_tool_show"] = "修改标签";
					}
					
					if($item[$i]["attaching"] == "") // 附图
					{
						$item[$i]["attachingShower"] = array();
					} else {
						$item[$i]["attachingIsset"] = 1;
						$item[$i]["attachingOptions"] = explode("<|>",$item[$i]["attaching"]);
					}
					
					
					// 评论数
					if($item[$i]["commentNum"] == 0) {
						if($item[$i]["commentNum"] == 19) {
							$item[$i]["commentShow"] = "回复";
						} else if($item[$i]["commentNum"] == 44) {
							$item[$i]["commentShow"] = "回答";
						} else {
							$item[$i]["commentShow"] = "评论";
						}
					} else {
						$item[$i]["commentShow"] = $item[$i]["commentNum"];
					}
					// 点赞数
					if($item[$i]["favorNum"] == 0) {
						$item[$i]["favorShow"] = "赞";
					} else {
						$item[$i]["favorShow"] = $item[$i]["favorNum"];
					}
					// 打分
					if($item[$i]["scoreNum"] == 0) {
						$item[$i]["scoreIS"] = "_none";
					} else {
					}
					// 收藏数
					if($item[$i]["collectNum"] == 0) {
						$item[$i]["collect"] = "";
					} else {
						$item[$i]["collect"] = $item[$i]["collectNum"];
					}
					// 关注数
					if($item[$i]["focusNum"] == 0) {
						$item[$i]["focus"] = "";
					} else {
						$item[$i]["focus"] = $item[$i]["focusNum"];
					}
					// 追踪数
					if($item[$i]["attentionNum"] == 0) {
						$item[$i]["attent"] = "";
					} else {
						$item[$i]["attent"] = "(".$item[$i]["attentNum"].")";
					}
					// 转发数
					if($item[$i]["forwardNum"] == 0){
						$item[$i]["forwardShow"] = "转发";
					} else {
						$item[$i]["forwardShow"] = $item[$i]["forwardNum"];
					}
					// 打赏
					if($item[$i]["tip"] == 0) {
						$item[$i]["tips"] = "";
					} else {
						$item[$i]["tips"] = "￥".$item[$i]["tip"];
					}
					// 转发
					if($item[$i]["isShared"] > 98) {
						$item[$i]["forwardIS"] = "";
					}
					
				
				
				// belong who 我的 | 其他人的
				if($belong == $myID) {
					$item[$i]["itemBelong"] = "belongMine";
				} else {
					$item[$i]["itemBelong"] = "belongOthers";
				}
				
				if($item[$i]["itemBelong"] == "belongMine") // 我的
				{ 
					$item[$i]["mineIS"] = "";
					$item[$i]["othersIS"] = "_none";
					//$item[$i]["source_isset"] = "_none";
					$item[$i]["delete_IS"] = "";
					$item[$i]["modify_IS"] = "";
					$item[$i]["rank_show_isset"] = "_none";
					$item[$i]["comment_sort"] = "all";
					
					//isShared
					$item[$i]["share_IS"] = "";
					if($item[$i]["isShared"] == 0) {
						$item[$i]["share_show"] = "分享";
						$item[$i]["share_status"] = "0";
					} else if($item[$i]["isShared"] == 41) {
						$item[$i]["share_show"] = "好友可见";
						$item[$i]["share_status"] = "41";
					} else if($item[$i]["isShared"] == 100) { 
						$item[$i]["share_show"] = "所有人可见";
						$item[$i]["share_status"] = "100";
					}
					
					// 代办or置顶
					if($item[$i]["isWorked"] == 1) {
						$item[$i]["workItIS"] = "_none"; 
						$item[$i]["workItCIS"] = "";
					} else {
						$item[$i]["workItIS"] = ""; 
						$item[$i]["workItCIS"] = "_none";
					}
					// 代办or置顶
					if($item[$i]["isFavor"] == 1) {
						$item[$i]["favorIS"] = "_none"; 
						$item[$i]["favorCIS"] = "";
					} else {
						$item[$i]["favorIS"] = ""; 
						$item[$i]["favorCIS"] = "_none";
					}
					
				} else if($item[$i]["itemBelong"] == "belongOthers") // 其他人的
				{ 
					$item[$i]["mineIS"] = "_none";
					$item[$i]["modify_IS"] = "_none";
					$item[$i]["othersIS"] = "";
					$item[$i]["other_timeIS"] = "";
					$item[$i]["rank_show_isset"] = "_none";
					$item[$i]["comment_sort"] = "friend";
					$item[$i]["comment_special"] = "friend";
					
					if( isset($myDB) ) // 已经登陆
					{
						// 是否收藏 | 关注 | 待办
						$others = $SQLFunc->isset_myMines($myDB,$item[$i]["userItemId"]);
						if($others == 0) {
							// 点赞
							$item[$i]["favorIS"] = ""; 
							$item[$i]["favorCIS"] = "_none";
							// 收藏
							$item[$i]["collectIS"] = ""; 
							$item[$i]["collectCIS"] = "_none";
							// 待办
							$item[$i]["workItIS"] = ""; 
							$item[$i]["workItCIS"] = "_none";
							// 关注
							if($item[$i]["timeType"] != 0) { 
								$item[$i]["focusIS"] = "";
								$item[$i]["focusCIS"] = "_none";
							}
						} else {
							 // 点赞
							if($others["isFavor"] == 1) {
								$item[$i]["favorIS"] = "_none"; 
								$item[$i]["favorCIS"] = "";
							} else {
								$item[$i]["favorIS"] = ""; 
								$item[$i]["favorCIS"] = "_none";
							}
							 // 收藏
							if($others["isCollected"] == 1) {
								$item[$i]["collectIS"] = "_none"; 
								$item[$i]["collectCIS"] = "";
							} else {
								$item[$i]["collectIS"] = ""; 
								$item[$i]["collectCIS"] = "_none";
							}
							// 代办or置顶
							if($others["isWorked"] == 1) {
								$item[$i]["workItIS"] = "_none"; 
								$item[$i]["workItCIS"] = "";
							} else {
								$item[$i]["workItIS"] = ""; 
								$item[$i]["workItCIS"] = "_none";
							}
							// 关注
							if($others["isFocused"] == 1) {
								$item[$i]["focusIS"] = "_none";
								$item[$i]["focusCIS"] = "";
							} else {
								$item[$i]["focusIS"] = "";
								$item[$i]["focusCIS"] = "_none";
							}
						}
					} else // 游客访问
					{
							$item[$i]["favorIS"] = ""; 
							$item[$i]["favorCIS"] = "_none";
							$item[$i]["collectIS"] = ""; 
							$item[$i]["workItIS"] = ""; 
							$item[$i]["focusIS"] = "";
					}
				} 
				
				// 是否是时间的信息 Timer
				if($item[$i]["timeType"] != 0) {
					$item[$i]["timeIS"] = "";
					if($item[$i]["sort"] == 2) {
						$time["form"] = $item[$i]["form"];
					} else if($item[$i]["sort"] == 9) {
						$time["form"] = 1;
					}
					$time["timeType"] = $item[$i]["timeType"];
					$time["start"] = $item[$i]["start"];
					$time["ended"] = $item[$i]["ended"];
					$time["remind"] = $item[$i]["remind"];
					$time["startType"] = $item[$i]["startType"];
					$time["endedType"] = $item[$i]["endedType"];
					$time["remindType"] = $item[$i]["remindType"];
			
					$time_handle = $this->pocessItemTime($time);		//处理时间的函数 location：最下
					$item[$i]["timers"] = $time_handle;
					
				} else {
							$item[$i]["focusIS"] = "_none";
							$item[$i]["focusCIS"] = "_none";
				}
				
				if($myID == "guest") // 游客访问
				{ 
					$item[$i]["write_IS"] = "_none";
				}
				
				
				if( isset($item[$i]["originUserItemId"]) ) //引用
				{
					$item[$i]["originIS"] = "";
					$item[$i]["themeIS"] = "_none";
					$item[$i]["contentIS"] = "_none";
					
					$originUserItemId = $item[$i]["originUserItemId"];
					$originBelong = $item[$i]["originBelong"];
					
					$theOriginItem = $SQLFunc->getTheItem($originUserItemId);
					if( isset($theOriginItem) ) 
					{
						$theOriginItemP = $this->pocessItemOrigin($theOriginItem);
						$item[$i]["origin"] = $theOriginItemP;	
						$item[$i]["origin"]["isset_none"] = "_none";
						
						$item[$i]["attachingShower"] = array();
						$item[$i]["origin"]["originAttaching"] = array();
						$item[$i]["attachingIsset"] = 1;
						$item[$i]["attachingOptions"] = explode("<|>",$item[$i]["origin"]["attaching"]);
						$item[$i]["attachingStyle"] = "_itemRO";
						
					} else 
					{
						$item[$i]["origin"]["belong_isset"] = "_none";
						$item[$i]["origin"]["belongName"] = search_user_infos($originBelong,"name");	
						$item[$i]["originIS"] = "_none";
						$item[$i]["origin"]["belong"] = $originBelong;
						$item[$i]["origin"]["id"] = $originUserItemId;
						$item[$i]["origin"]["source_isset"] = "_none";
						$item[$i]["origin"]["timeIS"] = "_none";
						$item[$i]["origin"]["toolsIS"] = "_none";
						$item[$i]["origin"]["themeIS"] = "_none";
						$item[$i]["origin"]["content"] = "原文已被原作者 删除 或 取消分享 ！";
						$item[$i]["origin"]["originAttaching"] = array();
						$item[$i]["origin"]["originAttachingIS"] = "_none";
					}
					
					// quote 内容
					if($item[$i]["theme"] == "") 
					{
						$item[$i]["theme"] = "转发";
					}
					
					if($item[$i]["quoteContent"] == "") 
					{
						$item[$i]["quoteContent"] = $item[$i]["theme"];
					} else 
					{
						$item[$i]["quoteContent"] = $item[$i]["theme"]." // ".$item[$i]["quoteContent"];
					}
					$item[$i]["quoteContent"] = $globalFunc->_replace_blank($item[$i]["quoteContent"]);
					$item[$i]["quoteContent"] = $globalFunc->_my_replace($item[$i]["quoteContent"]);
					
					$item[$i]["quoteIS"] = "";
				} else 
				{
					$item[$i]["origin"]["originAttaching"] = array();
				}
				
				if($item[$i]["attachingIsset"] == 1) 
				{
						$item[$i]["attachingIS"] = "";
						//$item[$i]["attachingShower"] = $item[$i]["attaching"];
						$attachingNum = count($item[$i]["attachingOptions"]);
						if($attachingNum == 1) 
						{
							$item[$i]["attaching_styleNum"] = 1;
							$item[$i]["attachingShowerClick"] = "One";
						} else if($attachingNum == 2 || $attachingNum == 4) 
						{
							$item[$i]["attaching_styleNum"] = 0;
						} else 
						{
							$item[$i]["attaching_styleNum"] = 0;
						} 
						
						for($n=0;$n < $attachingNum;$n++)
						{
							$thisAttaching = explode("-/",$item[$i]["attachingOptions"][$n]);
							if(count($thisAttaching) == 1)
							{
								$thisAttachingType = "origin";
								$thisAttachingUrl = $thisAttaching[0];
								$item[$i]["attachingShower"][$n]["type"] = $thisAttachingType;
								$item[$i]["attachingShower"][$n]["imgUrl"] = $thisAttachingUrl;
							} else 
							{
								$thisAttachingType = $thisAttaching[0];
								$thisAttachingUrl = $thisAttaching[1];
								$item[$i]["attachingShower"][$n]["type"] = $thisAttachingType;
								$item[$i]["attachingShower"][$n]["imgUrl"] = $thisAttachingUrl;
							}
;
							if($thisAttachingType == "qingbo") 
							{
								$item[$i]["attachingShower"][$n]["imgSrc"] = "/images/img160/".$thisAttachingUrl;
								//$item[$i]["attachingShower"][$n]["imgSrc"] = "/images/origin/".$thisAttachingUrl;
							} else if($thisAttachingType == "sinaimg") 
							{
								$item[$i]["attachingShower"][$n]["imgSrc"] = "http://wx1.sinaimg.cn/thumb150/".$thisAttachingUrl;
							} else 
							{
								$item[$i]["attachingShower"][$n]["imgSrc"] = $thisAttachingUrl;
							}
//					   		$item[$i]["attachingShower"][$n]["type"] = 1;
//					   		$item[$i]["attachingShower"][$n]["imgUrl"] = 1;
//					   		$item[$i]["attachingShower"][$n]["imgSrc"] = 1;

//							$attachingURL = $item[$i]["attachingOptions"][$n];
//							$urlEncode = base64_encode($attachingURL);
//							//$urlEncode = encrypt($thisURL);
//					   		$item[$i]["attachingShower"][$n]["origin"] = $attachingURL;
//					   		$item[$i]["attachingShower"][$n]["encode"] = "http://".$_SERVER['HTTP_HOST']."/thumb160/".$urlEncode;
						}
				} else 
				{
					$item[$i]["attachingShower"] = array();
					$item[$i]["origin"]["attachingShower"] = array();
				}
				
				
				// sortName 
				if($item[$i]["sort"] == 11) // 消息 News
				{ 
					$item[$i]["sortName"] = "消息";
					$item[$i]["toolsIS"] = "_none";
					$item[$i]["newsIS"] = "";
					
					$item[$i]["later_isset"] = "_none";
					$item[$i]["addFriend_IS"] = "_none";
					$item[$i]["refuseFriend_IS"] = "_none";
					
					if($item[$i]["type"] == 12) { // 申请加为好友
						$item[$i]["source_isset"] = "_none";
						$item[$i]["content"] = "向";
						$item[$i]["contentTwo"] = "发出好友申请";
						if($item[$i]["isCompleted"] == 0) {
							$item[$i]["status"] = "等待中";
						} else if($item[$i]["isCompleted"] == 1) {
							$item[$i]["status"] = "已经为好友";
						} else if($item[$i]["isCompleted"] == 2) {
							$item[$i]["status"] = "对方拒绝";
						} 
					} else if($item[$i]["type"] == 13) { // 好友请求
						$item[$i]["object_isset"] = "_none";
						$item[$i]["content"] = "想与你成为好友";
					
						if($item[$i]["isCompleted"] == 0) {
							$item[$i]["later_isset"] = "";
							$item[$i]["addFriend_IS"] = "";
							$item[$i]["refuseFriend_IS"] = "";
						} else if($item[$i]["isCompleted"] == 1) {
							$item[$i]["status"] = "已经为好友";
							$item[$i]["later_isset"] = "_none";
							$item[$i]["addFriend_IS"] = "_none";
							$item[$i]["refuseFriend_IS"] = "_none";
						} else if($item[$i]["isCompleted"] == 2) {
							$item[$i]["status"] = "已经拒绝";
							$item[$i]["addFriend_IS"] = "_none";
							$item[$i]["refuseFriend_IS"] = "_none";
						}
					} else if($item[$i]["type"] == 14) {	// 关注了Ta
						$item[$i]["source_isset"] = "_none";
						$item[$i]["content"] = "关注了";
					} else if($item[$i]["type"] == 15) {	// 被关注
						$item[$i]["content"] = "关注了你";
					}
				
//					if($item[$i]["ps"] == "") {
//						$item[$i]["ps_isset"] = "_none";
//					}
				} else if($item[$i]["sort"] == 19) // 私信 PM
				{ 
					$item[$i]["source_isset"] = "";
					$item[$i]["share_IS"] = "_none";
					$item[$i]["modify_IS"] = "_none";
				
					$item[$i]["cpd_timeIS"] = "_none";
					$item[$i]["delete_IS"] = "_none";
					$item[$i]["collectIS"] = "_none"; 
					$item[$i]["collectCIS"] = "_none";
					
					$item[$i]["comment_sort"] = "special";
					$item[$i]["comment_special"] = "all";
					
					// 私信类型 收件 || 发件
					if($item[$i]["sourceId"] == $myID) // 发件 pmOUT
					{
						$item[$i]["sortName"] = "发信";
						$item[$i]["itemTYPE"] = "pmOut";
						$item[$i]["comment_object"] = $item[$i]["object"];
						$item[$i]["receiverIS"] = "";
						
						$objects = explode("|", $item[$i]["receiverIds"]);
						for($j=0;$j<count($objects);$j++) 
						{
							$item[$i]["receivers"][$j]["id"] = $objects[$j];
							$item[$i]["receivers"][$j]["name"] = "@".$SQLFunc->search_user_infos($objects[$j],"name");
						}
						
					} else // 收件 pmIN
					{
							$item[$i]["sortName"] = "收信";
							$item[$i]["itemTYPE"] = "pmIn";
							$item[$i]["belong_isset"] = "_nones";
							$item[$i]["comment_object"] = $item[$i]["source"];
							$item[$i]["senderIS"] = "";
							
							//是否已读
							if($item[$i]["isRead"] == 0) {
								//$item[$i]["unread_isset"] = "_hide";
							} else {
								//$item[$i]["unread_btn_isset"] = "_none";
							}
							$item[$i]["unread_btn_isset"] = "_none";
					}
					
				} else if($item[$i]["sort"] == 21) // 笔记
				{ 
					$item[$i]["itemTYPE"] = "Note";
					$item[$i]["sortName"] = "笔记";
					if($item[$i]["type"] == 3) {
						$item[$i]["forwardIS"] = "_none";
						if($quoteItem["isShared"] < 99) {
							$item[$i]["share_IS"] = "_none";
						}
					} 
				} else if($item[$i]["sort"] == 44) // 提问
				{ 
					$item[$i]["itemTYPE"] = "Ask";
					$item[$i]["sortName"] = "提问";
				} else if($item[$i]["sort"] == 41) // 发布
				{  
					$item[$i]["modify_IS"] = "_none";
					$item[$i]["share_IS"] = "_none";
					
					if($item[$i]["type"] == 1) {
						$item[$i]["itemTYPE"] = "Microblog";
						$item[$i]["sortName"] = "微博";
						$item[$i]["sortName"] = "";
						$item[$i]["comment_sort"] = "all";
					} else if($item[$i]["type"] == 2) {
						$item[$i]["itemTYPE"] = "Circle";
						$item[$i]["sortName"] = "朋友圈";
						$item[$i]["sortName"] = "";
						//$item[$i]["comment_sort"] = "Circle";
						$item[$i]["comment_sort"] = "special";
						$item[$i]["comment_special"] = "friend";
					}
						
				
				} else if($item[$i]["sort"] == 48) // 商品
				{ 
					$item[$i]["itemTYPE"] = "Godds";
					if($item[$i]["type"] == 1) {
						$item[$i]["sortName"] = "(新品)";
					} else if($item[$i]["type"] == 2) {
						$item[$i]["sortName"] = "(二手品)";
					} else if($item[$i]["type"] == 3) {
						$item[$i]["sortName"] = "(服务)";
					} else if($item[$i]["type"] == 9) {
						$item[$i]["sortName"] = "(免费送)";
					}
					$item[$i]["price_IS"] = "";
				} 
				
			}
		}

		return $item;
	}
	
	public function pocessItemOrigin($item) // 处理 引用
	{
		$item["workItIS"] = "_none"; 
		$item["workItCIS"] = "_none";
		$item["collectIS"] = "_none"; 
		$item["collectCIS"] = "_none";
		$item["focusIS"] = "_none";
		$item["focusCIS"] = "_none";
						
		$globalFunc = new GlobalFunc;
		$SQLFunc = new SQLFunc;
		
		$myID = Session::get('myID');
		$myDB = Session::get('myDB');
		
		$item["belong"] = $item["belongId"];
		$item["source"] = $item["sourceId"];
		
		// belongType
		if($item["belongId"] == $myID) // belongMine
		{ 
			$item["itemBelong"] = "MINE";
			$item["othersIS"] = "_none";
			
			// 代办or置顶
			if($item["isWorked"] == 1) {
				$item["workItIS"] = "_none"; 
				$item["workItCIS"] = "";
			} else {
				$item["workItIS"] = ""; 
				$item["workItCIS"] = "_none";
			}
		} else // belongOthers
		{ 
			$item["itemBelong"] = "OTHERS";
			$item["othersIS"] = "";
			
					
			if( isset($myDB) ) // 已登陆
			{
				// 是否收藏 | 关注
				$others = $SQLFunc->isset_myMines($myDB,$item["id"]);
				if($others == 0) {
					// 收藏
					$item["collectIS"] = ""; 
					$item["collectCIS"] = "_none";
					// 代办or置顶
					$item["workItIS"] = ""; 
					$item["workItCIS"] = "_none";
					// 关注
					if($item["timeType"] != 0) { 
						$item["focusIS"] = "";
						$item["focusCIS"] = "_none";
					}
				} else {
					// 收藏
					if($others["isCollected"] == 1) {
						$item["collectIS"] = "_none"; 
						$item["collectCIS"] = "";
					} else {
						$item["collectIS"] = ""; 
						$item["collectCIS"] = "_none";
					}
					// 代办or置顶
					if($others["isWorked"] == 1) {
						$item["workItIS"] = "_none"; 
						$item["workItCIS"] = "";
					} else {
						$item["workItIS"] = ""; 
						$item["workItCIS"] = "_none";
					}
					// 关注
					if($others["isFocused"] == 1) {
						$item["focusIS"] = "_none";
						$item["focusCIS"] = "";
					} else {
						$item["focusIS"] = "";
						$item["focusCIS"] = "_none";
					}
				}
			} else // 游客访问
			{
					$item["collectIS"] = ""; 
					$item["workItIS"] = ""; 
					if($item["timeType"] != 0) 
					{ 
						$item["focusIS"] = "";
						$item["focusCIS"] = "_none";
					}
			}
			
		}
		
			
		if($item["timeType"] != 0) // 是否时刻 - 时间
		{
			$item["timeIS"] = "";
			$item["sort_name"] = "时刻";
			$time["timeType"] = $item["timeType"];
			$time["form"] = $item["form"];
			$time["start"] = $item["start"];
			$time["ended"] = $item["ended"];
			$time["remind"] = $item["remind"];
			$time["startType"] = $item["startType"];
			$time["endedType"] = $item["endedType"];
			$time["remindType"] = $item["remindType"];
			
			$timers = $this->pocessItemTime($time);		// 处理时间的函数 location：最下
			$item["timers"] = $timers;
		} else {
			$item["timeIS"] = "_none";
		}
		
		// 类型	
		if($item["sort"] == 21) {
			$item["sort_name"] = "笔记";
		} else if($item["sort"] == 41) {
			$item["sort_name"] = "";
		} else if($item["sort"] == 44) {
			$item["sort_name"] = "提问";
		} 
		
		// 归属	
		$item["belongName"] = $SQLFunc->search_user_infos($item["belongId"],"name");	
		$item["source_name"] = $SQLFunc->search_user_infos($item["sourceId"],"name");	
		$item["time_show"] = $globalFunc->_time_switch($item["time"]);
		
		
		if($item["theme"] == "") // 主题
		{
			$item["themeIS"] = "_none";
		} else {
			//$item["theme"] = $globalFunc->_my_replace($item["theme"]);
			$item["theme"] = $globalFunc->_replace_blank($item["theme"]);
		}
		
		if($item["content"] == "") // 内容
		{
			$item["contentIS"] = "_none";
		} else {
			$item["content"] = $globalFunc->_my_replace($item["content"]);
			$item["content"] = $globalFunc->_replace_blank($item["content"]);
		}
		

		
		
		if($item["forwardNum"] == 0) // 转发
		{
			$item["forward"] = "";
		} else {
			$item["forward"] = $item["forwardNum"];
		}
		
		if($item["commentNum"] == 0) // 评论
		{
			$item["comment"] = "";
		} else {
			$item["comment"] = $item["commentNum"];
		}
		
		if($item["collectNum"] == 0) // 收藏
		{
			$item["collect"] = "";
		} else {
			$item["collect"] = $item["collectNum"];
		}
		
		if($item["focusNum"] == 0) // 关注
		{
			$item["focus"] = "";
		} else {
			$item["focus"] = "".$item["focusNum"]."";
		}
		
		$item["forwardIS"] = "_none";
		if($item["isShared"] > 98) 
		{
			$item["forwardIS"] = "";
		}
			
		return $item;
	}
	
	public function pocessItemTime($time) // 处理 时间
	{
		
		$globalFunc = new GlobalFunc;
		
		//date_default_timezone_set('PRC');
		
		//$form = $time["form"];
		$timeType = $time["timeType"];
		$start = $time["start"];
		$ended = $time["ended"];
		$remind = $time["remind"];
		$startType = $time["startType"];
		$endedType = $time["endedType"];
		$remindType = $time["remindType"];
/**/
		if($timeType == 1) // 一般日程
		{
			// start_show
			if($startType == 0) {
				$time["start_isset"] = "_none";
			} else if($startType == 1) {
				$time["start_show"] = $globalFunc->timerSwitchTime($start);
			} else if($startType == 2) {
				$time["start_show"] = $globalFunc->timerSwitchDate($start);
			}

			// ended_show
			if($endedType == 0) {
				$time["ended_isset"] = "_none";
			} else if($endedType == 1) {
				if($startType == 0) {
					$time["ended_show"] = $globalFunc->timerSwitchTime($ended);
				} else {
					if($globalFunc->_is_same_day($start,$ended) == 1) {
						$time["ended_show"] = $globalFunc->timerSwitchTime($ended);
					} else {
						$time["ended_show"] = $globalFunc->timerSwitchTime($ended);
					}
				}
			} else if($endedType == 2) {
				if($startType == 0) {
					$time["ended_show"] = $globalFunc->timerSwitchDate($ended);
				} else {
					if($globalFunc->_is_same_day($start,$ended) == 1) {
						$time["ended_show"] = $globalFunc->timerSwitchDate($ended);
						$time["ended_isset"] = "_none";
					} else {
						$time["ended_show"] = $globalFunc->timerSwitchDate($ended);
					}
				}
			}

			// remind_show
			if($remindType == 0) {
				$time["remind_ispast"] = "_none";
			} else {
				$time["remind_show"] = $globalFunc->_time_switch($remind);

				if($time["remind"] < time()) {
					$time["remind_ispast"] = "_over";
				} else {
					$time["remind_ispast"] = "_before";
					$time["alarm_time"] = ($remind - time())*1000;
				}
			}

			$data_days = "";
			$day_start = strtotime(date("Y-n-j",$start));
			for($i=$day_start;$i<=$ended;$i=$i+(3600*24))
			{
				$data_days .= date("Y-m.j",$i)." ";
			}

			$data_year_weeks = "";
			$year_week_start = $day_start - ((date("N",$start)-1)*3600*24);
			for($i=$year_week_start;$i<=$ended;$i=$i+(3600*24*7))
			{
				$data_year_weeks .= date("Y.W",$i)." ";
			}
			
			$month_start = strtotime(date("Y",$start)."-".(date("m",$start) + 1)."-1") - 1;
			$month_ended = strtotime(date("Y",$ended)."-".(date("m",$ended) + 1)."-1") - 1;
	
//			while($month_start <= $month_ended)
//			{
//				$data_months .= date("Y-m",$month_start)." ";
//				$month_start = $month_start + 1;
//				$month_start = strtotime(date("Y",$month_start)."-".(date("m",$month_start) + 1)."-1") - 1;
//			}
		

			$time["time_days"] = $data_days;
			$time["time_year_weeks"] = $data_year_weeks;
//			$time["time_months"] = $data_months;

		} else if($timeType == 2) // 周期日程
		{
			$weekName=array('每周日','每周一','每周二','每周三','每周四','每周五','每周六');
			if($startType == 0) {
				$time["start_isset"] = "_none";
			} else if($startType == 1) {
				$time["start_show"] = $weekName[date("w",$start)].date(" H:i",$start);
			} else if($startType == 2) {
				$time["start_show"] = $weekName[date("w",$start,$start)];
			}
			if($endedType == 0) {
				$time["ended_isset"] = "_none";
			} else if($endedType == 1) {
				$time["ended_show"] = $weekName[date("w",$ended)].date(" H:i",$ended);
			} else if($startType == 2) {
				$time["ended_show"] = $weekName[date("w",$ended)];
			}
			
			
			$week_start = date("w",$start);
			$week_ended = date("w",$ended);
			if($week_start > $week_ended) {
				$week_ended = $week_ended + 7;
			}
			for($i=$week_start;$i<=$week_ended;$i++) {
				if($i >= 7) {
					$data_weeks .= ($i-7)." ";
				} else {
					$data_weeks .= $i." ";
				}
			}
			$time["time_weeks"] = $data_weeks;
			
		}
		
		return $time;	
/*			
					if( ($item[$i]["start"] > _get_today_ended_unix()) || ($item[$i]["ended"] < _get_today_start_unix()) ) {
					} else {
						$item[$i]["isset_today"] = "_today";
					}


					if(time() < $item[$i]["start"]) {
						$item[$i]["isset_before"] = "_before";
					} else if( (time() >= $item[$i]["start"]) && (time() < $item[$i]["ended"]) ) {
						$item[$i]["isset_now"] = "_now";
					} else if(time() > $item[$i]["ended"]) {
						$item[$i]["isset_after"] = "_after";
					}
*/
	}
	
	public function test()
	{
		echo "ProcessingData.php success.";
	}
	
}
