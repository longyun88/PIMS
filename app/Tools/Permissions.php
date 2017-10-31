<?php

namespace App\Tools;

use Session;

class Permissions
{
    
	// 处理数据 返回 Data Show
	public function IssetLogin()
	{
		dd(Session::has('isLog'));
		if(Session::has('isLog')) {
			return "logIS";
		} else {
			return "logNo";
		}
	}
	

	
}
