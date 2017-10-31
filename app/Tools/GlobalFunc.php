<?php

namespace App\Tools;

use App\Tools\SQLFunc;

class GlobalFunc
{
	public function _my_replace($text) 
	{
		$SQLFunc = new SQLFunc;
		
		//$prefix_patterns = array();
		//$prefix_patterns[0] = "/\<br>/";
		//$prefix_patterns[1] = "/\&nbsp;/";
		//$prefix_patterns[2] = "/\\n/";
		//$prefix_replacements = array();
		//$prefix_replacements[0] = "\n";
		//$prefix_replacements[1] = " ";
		//$prefix_replacements[2] = "<br>";
		//$text = preg_replace($prefix_patterns, $prefix_replacements, $text);
		
		//$text = nl2br(htmlspecialchars(stripslashes($text)));
		//$text = nl2br(htmlspecialchars($text));
		//$text = nl2br($text);$string = 'The quick brown fox jumped over the lazy dog.';
		

		$patterns = array();
		$patterns[0] = "/ /";
		$patterns[1] = "/\[\{\[br]}]/";
		$patterns[2] = "/&amp;/";
		$patterns[3] = "/&quot;/";
		$patterns[4] = "/\</";
		$patterns[5] = "/\>/";
		$replacements = array();
		$replacements[0] = "&nbsp";
		//$replacements[0] = " ";
		$replacements[1] = "<br>";
		$replacements[2] = "&";
		$replacements[3] = '"';
		$replacements[4] = "&lt";
		$replacements[5] = "&gt";
		$text = preg_replace($patterns, $replacements, $text);
		
		//$pattern = "/((?:https?|http?|ftp?):\/\/(?:\w|\?|\.|\/|\=|\+|\-|\&|\%|\#|\@|\:|\[|\])+)\b/i";
		$pattern = "/((?:https?|http?|ftp?):\/\/(?:\w|\?|\.|\/|\=|\+|\-|\&|\%|\#|\@|\:|\[|\])+)\b/i";
		//$text = preg_replace($pattern,"<a class=content_link href=\\1 target=_blank title=\\1>http://lotus.link</a>",$text);
		//$text = preg_replace($pattern,'<a class=content_link href=\1 target=_blank title=\1 >\1</a>',$text);
		$text = preg_replace($pattern,'<a class=content_link href=\1 target=_blank title=\1 ><em class="link-icon"></em> 网址链接</a>',$text);
		
		/*
		$patternx = array();
		$patternx[0] = "/((?:https?|http?):\/\/(?:\w|\?|\.|\/|\=|\+|\-|\&|\%|\#)+)\b/i";
		$patternx[1] = "/^\[\d+\-\d+\]/";
		$replacementx = array();
		$replacementx[0] = "<a class=content_link href=\1 target=_blank title=\1 >\1</a>";
		$replacementx[1] = '<span class="btn little_btn item_details item" data-belong=1 data-entity=22>11</span>';
		$text = preg_replace($patternx, $replacementx, $text);
		*/
		
		$pattern = "/(\[\s*(\d+)\.(\d+)\s*\])/";
		//$text = preg_replace_callback($pattern,$this->replaceItem($text),$text);
		$text = preg_replace_callback($pattern,function($matches) {
			$SQLFunc = new SQLFunc;
			return '<span class="btn-hover itemer" data-belong='.$matches[2].' data-itemer='.$matches[3].'> '
				.'<em class="link-icon"></em> '.$SQLFunc->search_user_infos($matches[2],"name").'.'.$matches[3].' </span>';
//			return '<span class="btn-hover item" data-belong='.$matches[2].' data-item='.$matches[3].'> '
//				.$matches[1].' ['.$SQLFunc->search_user_infos($matches[2],"name").'.'.$matches[3].'] </span>';
		},$text);
		
		$pattern = "/(\@(\d+)\.(\d+)(\s*|\:|\/))/";
		//$text = preg_replace_callback($pattern,'replaceName',$text);
		$text = preg_replace_callback($pattern,function($matches) {
			$SQLFunc = new SQLFunc;
			return '<span class="btn-hover itemer" data-belong='.$matches[2].' data-itemer='.$matches[3].'>@'
				.$SQLFunc->search_user_infos($matches[2],"name").'.'.$matches[3].'</span>'.$matches[4];
		},$text);
		
		$pattern = "/(\@(\d+)(\s*|\:|\/))/";
		//$text = preg_replace_callback($pattern,'replaceName',$text);
		$text = preg_replace_callback($pattern,function($matches) {
			$SQLFunc = new SQLFunc;
			return '<span class="btn-hover whos" data-whos='.$matches[2].'> @'.$SQLFunc->search_user_infos($matches[2],"name").' </span>'.$matches[3];
		},$text);
		//$text = preg_replace($pattern,'<span class="item" data-belong=\2 data-entity=\3>\1</span>',$text);
		//preg_match_all($pattern,$text,$match);
		//for($i=0;$i<count($match[0]);$i++) {
			//$match[4][$i] = search_user_infos($match[2][$i],"name");
		//}
		//$text = preg_replace($pattern,'<span class="item" data-belong=\2 data-item=\3>'.$match[4][$i].$match[1][0].'</span>',$text);
		
		return $text;
	}

	public function _replace_blank($text) 
	{
		
		$patterns = array();
		$patterns[0] = "/\\n/";
		//$patterns[1] = "/ /";
		$replacements = array();
		$replacements[0] = "<br>";
		//$replacements[1] = "&nbsp";
		$text = preg_replace($patterns, $replacements, $text);
		
		return $text;
	}

	public function replaceItem($matches) 
	{
		$SQLFunc = new SQLFunc;
		return '<span class="btn-hover item" data-belong='.$matches[2].' data-item='.$matches[3].'> '
			.$matches[1].' ['.$SQLFunc->search_user_infos($matches[2],"name").'.'.$matches[3].'] </span>';
	}
	
	public function replaceName($matches) 
	{
		$SQLFunc = new SQLFunc;
		return '<span class="btn-hover item" data-belong='.$matches[2].' data-item='.$matches[3].'> @'
			.$SQLFunc->search_user_infos($matches[2],"name").'.'.$matches[3].' </span>'.$matches[4];
	}
    

	
	public function object_array($array) // 对象变数组
	{  
		if(is_object($array)) 
		{
			$array = (array)$array;  
		}
		if(is_array($array)) 
		{
			foreach($array as $key=>$value) {
				$array[$key] = $this->object_array($value);
			} 
		}
		return $array;  
	}
    

	// 返回一个有今天明天的完整时间
	//eg 后天 5:20 | 05.01 18:20 | 2013.06.03 11:11
	public function _time_point_switch($stamp) 
	{
		global $today_start_unix;	//今天开始；
		global $today_ended_unix;	//今天结束；

		global $yesterday_start_unix;	//昨天开始；
		global $yesterday_ended_unix;	//昨天结束；

		global $beforeday_start_unix;	//前天开始；
		global $beforeday_ended_unix;	//前天结束；

		global $tomorrow_start_unix;	//明天开始；
		global $tomorrow_ended_unix;	//明天结束；

		global $afterday_start_unix;	//后天开始；
		global $afterday_ended_unix;	//后天结束；

		global $this_year_start_unix;	//今年开始；
		global $this_year_ended_unix;	//今年结束；

		$this->_time_unix_init();

		if( ($stamp >= $beforeday_start_unix) && ($stamp < $yesterday_start_unix) ) {
			return "前天".date(" H:i",$stamp);
		} elseif( ($stamp >= $yesterday_start_unix) && ($stamp < $today_start_unix) ) {
			return "昨天".date(" H:i",$stamp);
		} elseif( ($stamp >= $today_start_unix) && ($stamp <= $today_ended_unix) ) {
			return "今天".date(" H:i",$stamp);
		} elseif( ($stamp >= $today_ended_unix) && ($stamp < $tomorrow_ended_unix) ) {
			return "明天".date(" H:i",$stamp);
		} elseif( ($stamp >= $tomorrow_ended_unix) && ($stamp < $afterday_ended_unix) ) {
			return "后天".date(" H:i",$stamp);
		} else {
			if( ($this_year_start_unix <= $stamp) && ($stamp <= $this_year_ended_unix) ) {
				return date("m.d H:i",$stamp);
				//return date("n月j日 H:i",$stamp);
			} else {
				//return date("Y.m.d H:i",$stamp);
				//return date("Y/n/j H:i",$stamp);
				return date("Y.n.j H:i",$stamp);
				//return date("Y-n-j H:i",$stamp);
			}
		}

	}
	// 返回一个有今天明天的日期
	public function _date_switch($stamp) 
	{
		global $today_start_unix;	//今天开始；
		global $today_ended_unix;	//今天结束；

		global $yesterday_start_unix;	//昨天开始；
		global $yesterday_ended_unix;	//昨天结束；

		global $beforeday_start_unix;	//前天开始；
		global $beforeday_ended_unix;	//前天结束；

		global $tomorrow_start_unix;	//明天开始；
		global $tomorrow_ended_unix;	//明天结束；

		global $afterday_start_unix;	//后天开始；
		global $afterday_ended_unix;	//后天结束；

		global $this_year_start_unix;	//今年开始；
		global $this_year_ended_unix;	//今年结束；

		$this->_time_unix_init();

		if( ( $beforeday_start_unix <= $stamp ) && ($stamp <= $beforeday_ended_unix) ) {
			return date("前天(n.j)",$stamp);
		} elseif( ( $yesterday_start_unix <= $stamp ) && ($stamp <= $yesterday_ended_unix) ) {
			return date("昨天(n.j)",$stamp);
		} elseif( ($stamp >= $today_start_unix) && ($stamp <= $today_ended_unix) ) {
			return date("今天(n.j)",$stamp);
		} elseif( ( $tomorrow_start_unix <= $stamp ) && ($stamp <= $tomorrow_ended_unix) ) {
			return date("明天(n.j)",$stamp);
		} elseif( ( $afterday_start_unix <= $stamp ) && ($stamp <= $afterday_ended_unix) ) {
			return date("后天(n.j)",$stamp);
		} else {
			if( ($this_year_start_unix <= $stamp) && ($stamp <= $this_year_ended_unix) ) {
				return date("m.d",$stamp);
			} else {
				return date("Y-m-d",$stamp);
			}
		}

	}
	
	
	
	public function timerSwitchDate($stamp) // 日程专属 - 转换为日期
	{
		global $today_start_unix;	//今天开始；
		global $today_ended_unix;	//今天结束；

		global $yesterday_start_unix;	//昨天开始；
		global $yesterday_ended_unix;	//昨天结束；

		global $beforeday_start_unix;	//前天开始；
		global $beforeday_ended_unix;	//前天结束；

		global $tomorrow_start_unix;	//明天开始；
		global $tomorrow_ended_unix;	//明天结束；

		global $afterday_start_unix;	//后天开始；
		global $afterday_ended_unix;	//后天结束；

		global $this_year_start_unix;	//今年开始；
		global $this_year_ended_unix;	//今年结束；

		$this->_time_unix_init();

		if( ( $beforeday_start_unix <= $stamp ) && ($stamp <= $beforeday_ended_unix) ) {
			return date("n月j日 (前天)",$stamp);
		} elseif( ( $yesterday_start_unix <= $stamp ) && ($stamp <= $yesterday_ended_unix) ) {
			return date("n月j日 (昨天)",$stamp);
		} elseif( ($stamp >= $today_start_unix) && ($stamp <= $today_ended_unix) ) {
			return date("n月j日 (今天)",$stamp);
		} elseif( ( $tomorrow_start_unix <= $stamp ) && ($stamp <= $tomorrow_ended_unix) ) {
			return date("n月j日 (明天)",$stamp);
		} elseif( ( $afterday_start_unix <= $stamp ) && ($stamp <= $afterday_ended_unix) ) {
			return date("n月j日 (后天)",$stamp);
		} else {
			if( ($this_year_start_unix <= $stamp) && ($stamp <= $this_year_ended_unix) ) {
				return date("n月j日",$stamp);
			} else {
				return date("Y-m-d",$stamp);
			}
		}

	}
	public function timerSwitchTime($stamp) // 日程专属 - 转换为具体时间
	{
		global $today_start_unix;	//今天开始；
		global $today_ended_unix;	//今天结束；

		global $yesterday_start_unix;	//昨天开始；
		global $yesterday_ended_unix;	//昨天结束；

		global $beforeday_start_unix;	//前天开始；
		global $beforeday_ended_unix;	//前天结束；

		global $tomorrow_start_unix;	//明天开始；
		global $tomorrow_ended_unix;	//明天结束；

		global $afterday_start_unix;	//后天开始；
		global $afterday_ended_unix;	//后天结束；

		global $this_year_start_unix;	//今年开始；
		global $this_year_ended_unix;	//今年结束；

		$this->_time_unix_init();

		if( ($stamp >= $beforeday_start_unix) && ($stamp < $yesterday_start_unix) ) {
			return "前天".date(" H:i",$stamp);
		} elseif( ($stamp >= $yesterday_start_unix) && ($stamp < $today_start_unix) ) {
			return "昨天".date(" H:i",$stamp);
		} elseif( ($stamp >= $today_start_unix) && ($stamp <= $today_ended_unix) ) {
			return "今天".date(" H:i",$stamp);
		} elseif( ($stamp >= $today_ended_unix) && ($stamp < $tomorrow_ended_unix) ) {
			return "明天".date(" H:i",$stamp);
		} elseif( ($stamp >= $tomorrow_ended_unix) && ($stamp < $afterday_ended_unix) ) {
			return "后天".date(" H:i",$stamp);
		} else {
			if( ($this_year_start_unix <= $stamp) && ($stamp <= $this_year_ended_unix) ) {
				//return date("m月d日 H:i",$stamp);
				return date("n月j日 H:i",$stamp);
			} else {
				//return date("Y.m.d H:i",$stamp);
				//return date("Y/n/j H:i",$stamp);
				return date("Y-n-j H:i",$stamp);
				//return date("Y-n-j H:i",$stamp);
			}
		}

	}
    
    
    
    
	// 处理数据 返回 Data Show
	public function _time_switch($stamp) {
		global $today_start_unix;	//今天开始；
		global $today_ended_unix;	//今天结束；

		global $yesterday_start_unix;	//昨天开始；
		global $yesterday_ended_unix;	//昨天结束；

		global $beforeday_start_unix;	//前天开始；
		global $beforeday_ended_unix;	//前天结束；

		global $tomorrow_start_unix;	//明天开始；
		global $tomorrow_ended_unix;	//明天结束；

		global $afterday_start_unix;	//后天开始；
		global $afterday_ended_unix;	//后天结束；

		global $this_year_start_unix;	//今年开始；
		global $this_year_ended_unix;	//今年结束；

		$this->_time_unix_init();

		if( ($stamp >= $beforeday_start_unix) && ($stamp < $yesterday_start_unix) ) {
			return "前天".date(" H:i",$stamp);
		}
		elseif( ($stamp >= $yesterday_start_unix) && ($stamp < $today_start_unix) ) {
			return "昨天".date(" H:i",$stamp);
		}
		elseif( ($stamp >= $today_start_unix) && ($stamp <= $today_ended_unix) ) {
			return "今天".date(" H:i",$stamp);
		}
		elseif( ($stamp >= $today_ended_unix) && ($stamp < $tomorrow_ended_unix) ) {
			return "明天".date(" H:i",$stamp);
		}
		elseif( ($stamp >= $tomorrow_ended_unix) && ($stamp < $afterday_ended_unix) ) {
			return "后天".date(" H:i",$stamp);
		}
		else {
			if( ($this_year_start_unix <= $stamp) && ($stamp <= $this_year_ended_unix) ) {
				return date("n月j日 H:i",$stamp);
			} else {
				return date("Y-n-j H:i",$stamp);
			}
		}

	}
	
	
	// 初始化时间戳 global $time_stamp
	public function _time_unix_init() {

		global $today_start_unix;	//今天开始；
		global $today_ended_unix;	//今天结束；

		global $yesterday_start_unix;	//昨天开始；
		global $yesterday_ended_unix;	//昨天结束；

		global $beforeday_start_unix;	//前天开始；
		global $beforeday_ended_unix;	//前天结束；

		global $tomorrow_start_unix;	//明天开始；
		global $tomorrow_ended_unix;	//明天结束；

		global $afterday_start_unix;	//后天开始；
		global $afterday_ended_unix;	//后天结束；

		global $this_year_start_unix;	//今年开始；
		global $this_year_ended_unix;	//今年结束；


		$today_start_unix = $this->_get_today_start_unix();
		$today_ended_unix = $today_start_unix + (3600*24-1);

		$yesterday_start_unix = $today_start_unix - 3600*24;
		$yesterday_ended_unix = $today_ended_unix - 3600*24;

		$beforeday_start_unix = $yesterday_start_unix - 3600*24;
		$beforeday_ended_unix = $yesterday_ended_unix - 3600*24;

		$tomorrow_start_unix = $today_start_unix + 3600*24;
		$tomorrow_ended_unix = $today_ended_unix + 3600*24;

		$afterday_start_unix = $tomorrow_start_unix + 3600*24;
		$afterday_ended_unix = $tomorrow_ended_unix + 3600*24;

		$this_year_start_unix = $this->_get_this_year_start_unix();
		$this_year_ended_unix = $this->_get_this_year_ended_unix();

	}
	
	//获得今天开始的时间戳
	public function _get_today_start_unix() {
		return strtotime(date("Y-m-d",time()));
	}
	//获得今天结束的时间戳
	public function _get_today_ended_unix() {
		return strtotime(date("Y-m-d",time())) + (3600*24-1);
	}

	//获得本周开始的时间戳
	public function _get_this_week_start_unix() {
		return ($this->_get_today_start_unix() - ((date("N")-1)*3600*24));
	}
	//获得本周结束的时间戳
	public function _get_this_week_ended_unix() {
		return $this->_get_this_week_start_unix() + (7*3600*24-1);
	}

	//获得本月开始的时间戳
	public function _get_this_month_start_unix() {
		return strtotime(date("Y-m",time())."-1");
	}
	//获得本月结束的时间戳
	public function _get_this_month_ended_unix() {
		return (strtotime(date("Y",time())."-".(date("m",time()) + 1)."-1") - 1);
	}

	//获得本年开始的时间戳
	public function _get_this_year_start_unix() {
		return strtotime(date("Y",time())."-1-1");
	}
	//获得本年结束的时间戳
	public function _get_this_year_ended_unix() {
		return strtotime(date("Y",time())."-12-31 23:59:59");
	}

	//获取某一天 开始 || 结束 时间戳
	public function _get_day_start_unix($stamp) {
		return strtotime(date("Y-m-d",$stamp));
	}
	public function _get_day_ended_unix($stamp) {
		return strtotime(date("Y-m-d",$stamp)) + (3600*24-1);
	}

	// 获取某一周 开始 || 结束 时间戳
	public function _get_week_start_unix($stamp) {
		return ( $this->_get_day_start_unix($stamp) - ((date("N",$stamp)-1)*3600*24) );
	}
	public function _get_week_ended_unix($stamp) {
		return $this->_get_week_start_unix($stamp) + (7*3600*24-1);
	}

	// 获取某一月 开始 || 结束 时间戳
	public function _get_month_start_unix($stamp) {
		return strtotime(date("Y-m",$stamp)."-1");
	}
	public function _get_month_ended_unix($stamp) {
		$yearN = date("Y",$stamp);
		$monthN = date("m",$stamp);
		if($monthN == 12) {
			$yearN = $yearN +1; 
			$monthN = 1;
		} else {
			$monthN = $monthN + 1;
		}
		$timestr = $yearN."-".$monthN."-1";
		//return (strtotime(date("Y",$stamp)."-".(date("m",$stamp) + 1)."-1") - 1);
		return strtotime($timestr) - 1;
	}

	// 获取 某一年 开始 || 结束 时间戳
	function _get_year_start_unix($stamp) {
		return strtotime(date("Y",$stamp)."-1-1");
	}
	function _get_year_ended_unix($stamp) {
		return strtotime(date("Y",$stamp)."-12-31 23:59:59");
	}



	
	// 是否同一天 return 0 || 1
	public function _is_same_day($stamp_1,$stamp_2) {
		if( $this->_get_day_start_unix($stamp_1) ==$this-> _get_day_start_unix($stamp_2) ) {
			return 1;
		} else {
			return 0;
		}
	}
	// 是否同一周 return 0 || 1
	public function _is_same_week($stamp_1,$stamp_2) {
		if( $this->_get_week_start_unix($stamp_1) == $this->_get_week_start_unix($stamp_2) ) {
			return 1;
		} else {
			return 0;
		}
	}
	// 是否同一月 return 0 || 1
	public function _is_same_month($stamp_1,$stamp_2) {
		if( $this->_get_month_start_unix($stamp_1) == $this->_get_month_start_unix($stamp_2) ) {
			return 1;
		} else {
			return 0;
		}
	}
	// 是否同一年 return 0 || 1
	public function _is_same_year($stamp_1,$stamp_2) {
		if( $this->_get_year_start_unix($stamp_1) == $this->_get_year_start_unix($stamp_2) ) {
			return 1;
		} else {
			return 0;
		}
	}
	
	
	
	// 获得IP
	public function getRealIpAddr() 
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}
	public function GetIP() 
	{
		if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if ($_SERVER["HTTP_CLIENT_IP"]) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		} else if ($_SERVER["REMOTE_ADDR"]) {
			$ip = $_SERVER["REMOTE_ADDR"];
		} else if (getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} else if (getenv("REMOTE_ADDR")) {
			$ip = getenv("REMOTE_ADDR");
		} else {
			$ip = "Unknown";
		}

		return $ip;
	}
	public function Get_IP() 
	{
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
			$ip = getenv("HTTP_CLIENT_IP"); 
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
			$ip = getenv("HTTP_X_FORWARDED_FOR"); 
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
			$ip = getenv("REMOTE_ADDR"); 
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
			$ip = $_SERVER['REMOTE_ADDR']; 
		else 
			$ip = "unknown"; 
		return($ip); 
	}
	public function get_onlineip() 
	{
		$onlineip = "";
		if(getenv(HTTP_CLIENT_IP) && strcasecmp(getenv(HTTP_CLIENT_IP), unknown)) {
			$onlineip = getenv(HTTP_CLIENT_IP);
		} elseif(getenv(HTTP_X_FORWARDED_FOR) && strcasecmp(getenv(HTTP_X_FORWARDED_FOR), unknown)) {
			$onlineip = getenv(HTTP_X_FORWARDED_FOR);
		} elseif(getenv(REMOTE_ADDR) && strcasecmp(getenv(REMOTE_ADDR), unknown)) {
			$onlineip = getenv(REMOTE_ADDR);
		} elseif(isset($_SERVER[REMOTE_ADDR]) && $_SERVER[REMOTE_ADDR] && strcasecmp($_SERVER[REMOTE_ADDR], unknown)) {
			$onlineip = $_SERVER[REMOTE_ADDR];
		}
		return $onlineip;
	}
	
	
	
	
	
}
