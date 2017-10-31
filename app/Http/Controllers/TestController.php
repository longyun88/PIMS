<?php
namespace App\Http\Controllers;

use App\Repositories\DisplayRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\M3Result;
use Crypt;
use DB;
use Mail;
use LRedis;
use Image;
use App\Item;
use App\MyDB;
use App\Tools\SQLFunc;
use App\Tools\GlobalFunc;
use App\Tools\ProcessingData;
use App\Jobs\ProcessAttaching;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Controller;
use App\Models\Item as LItem;
use App\Models\Communication;
use App\Repositories\UserItemRepository;
use App\Repositories\ItemRepository;


class TestController extends Controller
{
    //use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function index() 
    {
    	$this->testALL("func");
    }
    
	public function testImage($url) // testImage
	{
    	$imageUrl = 'http://wx4.sinaimg.cn/large/0061hrMily1fe9hrchoccj31ue0wytk0.jpg';
    	$imageUrl = 'images/db126/image_20170324121649_231.jpg';
    	$imageUrl = 'http://wx1.sinaimg.cn/mw690/006gNvXEly1fe2dj3yn2aj30zk1hcaj9.jpg';
    	
  		$breaker = 0;
    	
    	$type = strpos($imageUrl,"http://");
    	
  		if($type === 0) // 引用类型
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
   		echo $breaker;
	}

	public function testALL($type = "phpinfo") // 
	{
    	$sqlFunc = new SQLFunc;
    	$processFunc = new ProcessingData;
    	$serviceFunc = new ServiceController;
    	$tableUserItem = "my_home.users_item";
    	$time = time();
    	if($type == "func") 
    	{
//	    	$num = strlen("你好");
//	    	$setAttr = "asd";
//	    	$setValue = "123";
//	    	$paraA[$setAttr] = $setValue;
//	    	dd($paraA[$setAttr]);

	    	
	    	$db = "db1202";
			$sessionID = substr($db,2,strlen($db)-2); 
			$paraS["myID"] = (int)$sessionID;
	    	//dd($paraS["myID"]);
			var_dump($paraS["myID"]);
	    	
    	}
        else if($type == "test")
    	{
//    		$bool = TRUE; 
//    		$bools = 0; 
//			echo gettype($bool)."<br/>"; 
//			echo is_string($bools)."<br/>"; 
//			echo gettype( is_string($bool) ); 

			//echo function_exists('isset')."123";
			
//			$dir = "../../../bin";
//			$a = scandir($dir); // 以升序排序 - 默认
//			$b = scandir($dir,1); // 以降序排序
//			dd($a);
//			//print_r($b);
			
			echo(addslashes("''"));
			echo(stripslashes("'\'"));
    	}
        else if($type == "phpinfo")
    	{
    		phpinfo(); 
    	}
        else if($type == "string")
    	{
    		echo strlen("你好 <br/>");
    		echo strrev("<br/>");
    		echo "你好";
    	}
        else if($type == "testSQL")
    	{
    		$sqlFunc->test(); 
    	}
        else if($type == "testProcess")
    	{
    		$processFunc->test(); 
    	}
        else if($type == "testService")
    	{
    		$serviceFunc->test(); 
    	}
        else if($type == "sqlDivision")
    	{
    		$userItemId = 1155;
    		$scoreNum = 33;
    		$paraAttr = "isss";
    		$paraSM[$paraAttr] = 1;
//			$sql="UPDATE my_home.users_item set scoreAVG=18.321 where id = {$userItemId}";
//			DB::statement($sql);
			//echo 240/$scoreNum;
			dd($paraSM);
			
			//DB::table($tableUserItem)->where('id', $userItemId)->increment("scoreTotal");
    	}
        else if($type == "rank")
    	{
    		$datas = $sqlFunc->getItemRank(1);
    		echo $datas;
    	}
        else if($type == "eloquent")
    	{
    		$tableUserItem = "my_home.users_item";
		    $sql = DB::table($tableUserItem)->select($tableUserItem.'.*')->orderBy($tableUserItem.'.id', 'desc')->limit(30);
		    dd($sql);
    	}
        else if($type == "mail")
    	{
    		$name = '崔龙云xx';
			$flag = Mail::send('mailTest',['name'=>$name],function($message){
				$targetAddress = 'longyun-cui@163.com';
				$message ->to($targetAddress)->subject('邮件测试');
			});
			if($flag){
			echo '发送邮件成功，请查收！';
			}else{
			echo '发送邮件失败，请重试！';
			}
    	}
        else if($type == "queue")
    	{
    		echo "Test Queue";
   			$this->dispatch(new ProcessAttaching("qingbo-/guest.jpg"));
    	}
        else if($type == "explode")
    	{
    		$xx = explode("-/","1/2");
    		echo $xx[0]; 
    	}
        else if($type == "md5")
    	{
    		echo md5("image_db126_20170324121649_231.jpg")." 231 <br/>"; 
    		echo md5("image_db126_20170326125940_589.jpg")." 589 <br/>"; 
    		echo md5("image_db126_20170331123714_535.jpg")." 535 <br/>"; 
    	}
        else if($type == "domin") // 域名
    	{
    		echo $_SERVER['SERVER_NAME']."<br/>"; //（没有端口） 
			echo $_SERVER['HTTP_HOST']."<br/>";//获取当前域名（有端口） 
			
			//echo $_SERVER["HTTP_REFERER"]; //获取来源网址,即点击来到本页的上页网址  
			echo $_SERVER['REQUEST_URI']."<br/>";//获取当前域名的后缀  
			echo dirname(__FILE__)."<br/>";//获取当前文件的物理路径  
			echo dirname(__FILE__)."/../"."<br/>";//获取当前文件的上一级物理路径  
    	}
        else if($type == "Crypt") // 加密解密测试
    	{
    		$str = "http://wx4.sinaimg.cn/large/0061hrMily1fe9hrchoccj31ue0wytk0.jpg---db126_php 自带加密、解密函数 - jiag的博客 - 博客频道_20170324121649_231";
    		$Cencrypt = Crypt::encrypt($str); // 加密
    		$Cdecrypt = Crypt::decrypt($Cencrypt); // 解密
    		echo $Cencrypt."<br/>".$Cdecrypt."<br/><br/>";
    		
    		$encrypt = encrypt($str); // 加密
    		$decrypt = decrypt($encrypt); // 解密
    		echo $encrypt."<br/>".$decrypt."<br/><br/>";
    		
    		$value3 = md5($str);
    		echo $value3."<br/>";
    		echo strlen($value3)."<br/><br/>";
    		
    		$value4 = crypt($str,$str);
    		echo $value4."<br/><br/>";
    		
    		$Bencrypt = base64_encode($str);
    		$Bdecrypt = base64_decode($Bencrypt);
    		echo $Bencrypt."<br/>".$Bdecrypt."<br/><br/>";
    		
    		$urlencode = urlencode($str);
    		$urldecode = urldecode($urlencode);
    		echo $urlencode."<br/>".$urldecode."<br/><br/>";
    		
    	}
        else if($type == "image") // intervention/image 测试
    	{
    		$imageUrl = "http://wx4.sinaimg.cn/large/0061hrMily1fe9hrchoccj31ue0wytk0.jpg";
   			//$img = Image::make(public_path('images/guests.jpg'))->greyscale();
   			$img = Image::make(public_path('test.png'));
   			//$img = Image::make('http://wx4.sinaimg.cn/large/0061hrMily1fe9hrchoccj31ue0wytk0.jpg');
   			$img = Image::make($imageUrl);
   			
   			$imgX = Image::make(public_path('test.png'));
   			//$img->insert(public_path('images\guestss.jpg'));
   			//$img->insert('public/images/guestss.png');
   			//$img->save(public_path('images/guestss.jpg'));
   			//$img = Image::canvas(80, 60, '#ccf');
   			//$img->insert(public_path('images/guestss.jpg'))->save(public_path('images/guestss.jpg'));
   			//$img->resize(600,640);
   			//$img->fit(300);
   			$imgX->widen(100);
   			//$img->widen(500);
   			//$xx = $img->widen(200);
   			//$img->heighten(500);
   			//Intervention\Image\Font size(24)
   			//$img->text("longyun123123123123");
   			//$img->sharpen(15);
   			//$img->crop(500,500,25,25);
   			//$img->crop(500,500,0,0);
//   			$img->text('longyun123123', 0, 0, function($font) {
//    //$font->file('foo/bar.ttf');
//    $font->size(48);
////    $font->color('#fdf6e3');
////    $font->align('center');
////    $font->valign('top');
////    $font->angle(45);
//});
   			//$img->insert($imgX);
   			//$img->insert(public_path('testR.jpg'));
   			//$img->save(public_path('testR.jpg'));
			//return $img->response('jpg');
			dd($img);
			
    	}
        else if($type == "session")
    	{
    		$datas = $sqlFunc->isSessionExist("db122",1,0,146,4);
    	}
        else if($type == "addsession")
    	{
    		$datas = $sqlFunc->addSession("db122",1,1,146,5,1,"1234567890");
    	}
        else if($type == "create")
    	{
	    	$db = 'db'.$id;
	    	$sql = 'create database if not exists '.$db;
	    	//DB::statement($sql);
	    	//$sqls = 'use '.$db;
	    	//DB::statement($sqls);
			//return $sql;
			
				$sql="create table if not exists {$db}.my_item_info
				(
					id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
					sort TINYINT UNSIGNED NOT NULL DEFAULT 0,
					name VARCHAR(64) NOT NULL DEFAULT '',
					num INT UNSIGNED NOT NULL DEFAULT 0,
					total INT UNSIGNED NOT NULL DEFAULT 0,
					unread INT UNSIGNED NOT NULL DEFAULT 0,
					shared INT UNSIGNED NOT NULL DEFAULT 0
				)";
				
			//DB::statement($sql);
    	}
        else if($type == "minex")
    	{
    		$datas = $sqlFunc->getMinesX("myAnswer","init",44,0,0,"modified");
    		dd($datas);
    	}
        else if($type == "insertCommu")
    	{
    		$data = array();
    		$data["type"] = 1;
    		//$data["point"] = 1;
    		
    		$para["db"] = "db120";
    		$para["time"] = 321;
    		$para["sort"] = 1;
    		$para["type"] = $data["type"];
    		$para["userItemId"] = 2000;
    		$para["item"] = 2;
    		$para["object"] = 1;
    		$para["source"] = 122;
    		$para["content"] = "你好nihao";
    		$para["share"] = 1;
    		$datas = $sqlFunc->insertCommunication($para);
    	}
        else if($type == "update")
    	{
    		//$datas = $sqlFunc->setINC(806,"collectNum",2);
    		$datas = $sqlFunc->setMyInfoSession("db120",2,2,2);
    	}
        else if($type == "collect")
    	{
    		//addCollection($myID,$db,$sort,$userItemId,$belong,$item,$time,$content,$share)
    		$datas = $sqlFunc->addCollection(120,"db146",22,808,146,5,1234,"1",1);
    	}
        else if($type == "isTodolist")
    	{
    		//addCollection($myID,$db,$sort,$userItemId,$belong,$item,$time,$content,$share)
    		//$datas = $sqlFunc->isset_myTodolist("db120",1);
    		//$datas = $sqlFunc->toLastMyTodolist("db120",40);
    		$datas = $sqlFunc->addMyTodolist("db120",1,100,107,87);
    		
    	}
        else if($type == "insertnotexists")
    	{
//			$sql="INSERT INTO my_home.users_test (username, age, tip) 
//				select ss,24,tip from dual WHERE not exists (select 1 from my_home.users_test where age = 16 and tip = 24) and age = 17 and tip = 24";
				//select username,age,tip from my_home.users_test WHERE not exists (select 1 from my_home.users_test where age = 16 and tip = 24) and age = 17 and tip = 24";
			//$sql="INSERT INTO my_home.users_test (username, age) VALUES('san',21)";
			//DB::statement($sql);
			$tableTest = 'my_home.users_test';
//			$datas = DB::table($tableTest)->whereExists(function ($query) {
//                $query->select(DB::raw(1))->from('my_home.users_test')->whereRaw('age = 17');
//            })->get();
            
//			$paraA["username"] = "sas";
//			$paraA["age"] = 22;
//			$datas = DB::table($tableTest)->whereNotExists(function ($query) use($tableTest) {
//	                //$query->select(DB::raw(1))->from($tableTest)->whereRaw('age = 17');
//	                //$query->select(1)->from($tableTest)->where('age',16);
//	                $query->DB::table($tableTest)->select(DB::raw(1))->where('age', '=', 16);
//	            })->insertGetId($paraA);
            
    		//$datas = DB::table($tableTest)->select(DB::raw(1))->where('age', '=', 16)->get();
    		//$datas = DB::table($tableTest)->select("id")->where("age",16)->orderBy("id","desc")->first();
    		//$datas = DB::table($tableTest)->where("age",16)->->max('id');
    		$datas = DB::table($tableTest)->max('id');
    		
    	}
        else if($type == "schedule")
    	{
    		$datas = $sqlFunc->getIntervalScheduleDisplay("db100",0,9999999999);
    		echo($datas);
    	}
        else if($type == "setFunc")
    	{
    		$datas = $sqlFunc->setAttaching(120,130,887,"http://ww3.sinaimg.cn/mw690/a194b7efjw1f7k0v69r8gj20u01hcwym.jpg");
    		dd($datas);
    	}
        else if($type == "setTimer")
    	{
    		unset($RType);
    		unset($R);
    		$RType = NULL;
    		$R = NULL;
    		$datas = $sqlFunc->setItemTimer("db120",118,1,2,1,1,1,$RType,$R);
    	}
        else if($type == "getCommu")
    	{
    		//getCommunication($display,$getSort,$getType,$belong,$item,$sort,$type,$location,$permission)
    		$datas = $sqlFunc->getCommunication("comment","all","init",120,130,0,0,0,0);
    		dd($datas);
    	}
        else if($type == "searchUser")
    	{
    		$datas = $sqlFunc->searchUsers("");
    		$displayShow = $sqlFunc->showDatasToUser($datas);
    		dd($displayShow);
    	}
        else if($type == "registerUser")
    	{
			$para["sort"] = 1;
			$para["name"] = "ccc";
			$para["password"] = 1;
			$para["realname"] = "testx";
			$para["gender"] = 1;
    		$datas = $sqlFunc->addaNewUser($para);
    		dd($datas);
    	}
        else if($type == "setO")
    	{
    		$sqlFunc->setItemOrigin("db120",152,1,1,1);
    	}
        else if($type == "loginT")
    	{
    		$datas = $sqlFunc->is_LoginConfirm(1000,123);
    		dd($datas);
    	}
        else if($type == "itemInfo")
    	{
    		$datas = $sqlFunc->selectItemInfos("db333",14);
    		dd($datas);
    	}
        else if($type == "getMySession")
    	{
    		$datas = $sqlFunc->getMySession("db120","pc");
    		dd($datas);
    	}
        else if($type == "create_MyItemInfo")
    	{
    		//$sqlFunc->create_MyItemInfo("db1024");
    	}
        else if($type == "testRedis")
    	{
    		
//    		$key = 'user:name:6';
//			$user ="lisis";
//			if($user){
//			    //将用户名存储到Redis中
//			    LRedis::set($key,$user);
//			}
//			
//			//判断指定键是否存在
//			if(LRedis::exists($key)){
//			    //根据键名获取键值
//			    dd(LRedis::get($key));
//			}


//$id = 123;
//$user = LRedis::get('user');
////return view('user.profile', ['user' => $user]);
//dd($user);
        
        $redis = LRedis::connection('default');
        $cacheUsers = $redis->get('userList');
        $value = $redis->lrange('uerList',0,1);
        dd($value);
        

//	        if( $cacheUsers ){
//	            $users = $cacheUsers;
//	            
//	            //$users = "1";
//	            print_r($users);
//	            //Log::info('获取用户列表，通过redis');
//	        }else{
//	            $users = "1234";
//	            $redis->set('userList', $users);
//	            print_r($users);
//	            //Log::info('获取用户列表，通过msyql');
//	        }
	        
	        
    	}
        else if($type == "getCommuni")
    	{
    		$datas = $sqlFunc->getCommunication("comment","all","init",120,57,0,1,0,10);
    		dd(count($datas));
    	}
        else if($type == "geter")
    	{
    		$para["id"] = 120;
    		$para["type"] = "Guest";
    		$para["geter"] = "Guest";
    		$para["operate"] = "init";
    		$para["position"] = 0;
    		$para["permission"] = 0;
    		$datas = $sqlFunc->geter($para);
			$itemsCount = count($datas);
			if($itemsCount > 0) {
				$processingD = new ProcessingData();
	  			$datasP = $processingD->pocessItems($datas);	// 数组
	    		$displayShow = $sqlFunc->showDatasToDisp($datasP);
				$id_location = $datas[$itemsCount - 1]["id"];
	    	} else {
	    		$displayShow = "";
				$id_location = 0;
	    	}
    		dd($datas);
    	} 
    	
    	
    	//dd($datas);
    }


    public function testDB($id) 
    {
    	$db = 'db'.$id;
    	//$myDB = new MyDB();
    	//$myDB->isConnection($id);
    	
    	$sqlFunc = new SQLFunc;
    	$sqlFunc->isConnection($id);
		
    }
	
	public function getTheItem($db,$id) // 获取一个item data
	{ 
		$pdo = new SQLFunc;

		$sql="select * from {$db}.my_item where id = {$id} ";
		$stmt=$pdo->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$item=$stmt->fetch();
		return $item;
	}

	
	public function test_is_LoginConfirm($account,$password) // 判断 是否可以登录
	{
		$tableUserLog = "my_home.user_log";
    	$datas = DB::table($tableUserLog)->select('*')
    		->where(function ($query) use($account) {
    				$query->where('id', $account)->orWhere('passname', $account)->orWhere('name', $account);
    				//$query->where('id', '=', $account)->orWhere('passname', '=', $account)->orWhere('name', '=', $account);
    				//$query->where('id', '=', 122)->orWhere('passname', '=', 122)->orWhere('name', '=', 122);
    			})
    		->where('password', '=', $password)
    		->first();
//    	$datas = DB::table($tableUserLog)->select('*')
//    		->where('password', '=', $password)
//    		->orWhere('id', '=', $account)
//    		->orWhere('name', '=', $account)
//    		->orWhere('passname', '=', $account)
//    		->first();
    		
		if(isset($datas)) {
			$globalF = new GlobalFunc;
			$infos = $globalF->object_array($datas);
			dd($infos);
		} else {
			return "yonghu不存在";
		}
	}
	
	public function testInsert() 
	{
		$para["name"] = "da";
		$para["age"] = 24;
		$para["tip"] = NULL;
		$this->test_insert_UserLoginIn($para);
	}
	
	public function test_insert_UserLoginIn($para) // 
	{
		//$sql="INSERT INTO my_home.user_login ( type,time,belongId,ip ) VALUES ( :type,:time,:belong,:ip )";
		$tableUserLogin = "my_home.users_test";
		
		$paraAarry["username"] = $para["name"];
		$paraAarry["age"] = $para["age"];
		$paraAarry["tip"] = $para["tip"];
		//$paraAarry["ip"] = $ip;
		
		DB::table($tableUserLogin)->insert($paraAarry);
	}
	
	public function test_update() // 
	{
    	$sqlFunc = new SQLFunc;
    	//$sqlFunc->setItemQuote("db120",73,23,12,15,"测test update 测试");
    }

    public function test_myapi(Request $request) // 检验 注册名
    {
    	$test = $request->input('test');
		$return["test"] = $test;
    	$jsonData = json_encode($return);
    	return $jsonData;
    }

	public function testLaravel($type = "type")
	{
		if($type == "type")
		{
			dd($type);
		}
		else if($type == "item")
		{
			dd(LItem::find(1229)->communications()->where("sourceId",120)->get());
		}
		else if($type == "empty")
		{
			$v = true;
//			dd(isset($v));
			dd(empty($v));
		}
		else if($type == "commu")
		{
			$id = 536;
			$item = Communication::findOrFail($id);
			if($item) dd($item->items);
			dd($item);
		}
		else if($type == "crypt")
		{
			$password = "nsdoajoga";

			$p_encrypt = encrypt($password);
			echo "【encrypt】 => ".$p_encrypt."<br/>";

			$password_en = password_enCode($password);
			echo "【password_enCode】 => ".$password_en."<br/>";
			if (password_check($password , $password_en)) echo "密码匹配"."<br/>";
			else echo "密码错误"."<br/>";

			$hash1 = hash_hmac("md5", $password, "abc123");
			echo "【hash_hmac md5】 => ".$hash1."<br/>";
			$hash2 = hash_hmac("sha1", $password, "abc123");
			echo "【hash_hmac sha1】 => ".$hash2."<br/>";
			$hash3 = hash_hmac("sha256", $password, "abc123");
			echo "【hash_hmac sha256】 => ".$hash3."<br/>";

			$p_md5 = md5($password);
			echo "【md5】 => ".$p_md5."<br/>";
			$p_md5md5 = md5(md5($password));
			echo "【md5(md5)】 : ".$p_md5md5."<br/>";

			$sha1 = sha1($password);
			echo "【sha1】 => ".$sha1."<br/>";
			$sha1sha1 = sha1($sha1);
			echo "【sha1(sha1)】 => ".$sha1sha1."<br/>";

			$password_h = password_hash($password, PASSWORD_BCRYPT);
			echo "【password_hash】 : ".$password_h."<br/>";

			if (password_verify($password , $password_h)) echo "密码匹配"."<br/>";
			else echo "密码错误"."<br/>";

			$password_md5h = password_hash($p_md5, PASSWORD_BCRYPT);
			echo "【password_hash md5(passwork)】 ： ".$password_md5h."<br/>";

			if (password_verify($p_md5 , $password_md5h)) echo "密码匹配"."<br/>";
			else echo "密码错误"."<br/>";

			$bcrypt1 = bcrypt($password);
			$bcrypt2 = bcrypt($password);
			if($bcrypt1 == $bcrypt2) dd("yes");
			dd("not");
		}
		else if($type == "sql_sort")
		{
			$items = LItem::limit(10)->get();
			$itemss = $items->toArray();
			$communication = Communication::limit(10)->get();
			$communicationss = $communication->toArray();
			$xx = array_merge($communicationss,$itemss);
			$ss = collect($xx);

			$sorted = $communication->sortBy('userItemId');
			dd($sorted->toArray());
		}
		else if($type == "in_array")
		{
			if(in_array("Guests",config('display.geter.guest'))) dd(113);
		}
		else if($type == "func")
		{
			$this->testFucn(null,45);
		}
        else if($type == "sql")
        {
            $name = DB::connection()->getDatabaseName();
            echo $name;
        }
	}

	public function testProgram($type = "type")
	{
		if($type == "type")
		{
			dd($type);
		}
        else if ($type == "truncate")
        {
            dd("注释");
            $table = "relations";
//            DB::table($table)->truncate();
            dd("end");
        }
        else if ($type == "relation_init")
        {
            dd("注释");
//            $table_relations = "relations";
//            DB::table($table_relations)->truncate();
//            $table_user = "user_log";
//            $users = DB::table($table_user)->select("id")->get();
//            foreach($users as $v)
//            {
//                $id = $v->id;
//                $insert = ['type' => 1, 'belong_id' => $id, 'object_id' => $id, 'relationship' => 1];
//                DB::table($table_relations)->insert($insert);
//            }
            dd("end");
        }

	}

	public function testFucn($p1 = "test",$p2 = 0,$p3 = [])
	{
		$data[0] = ($p1 === null) ? "test" : $p1;
		$data[1] = ($p2 === null) ? 0 : $p2;
		$data[2] = ($p3 === null) ? [] : $p3;
		dd($data);
	}


}
