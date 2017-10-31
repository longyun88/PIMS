<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('mail/sendReminderEmail','MailController@sendReminderEmail');

Route::get('socket', 'SocketController@index');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');
Route::post('socketTest', 'SocketController@mySocketTest');


Route::get('/in', 'EntranceController@in');
Route::get('/out', 'EntranceController@out');
//	Route::post('/service/loginConfirm', 'Service\ServiceController@ajaxLogin');	// 登陆
//	Route::post('/service/userLogin', 'Service\ServiceController@ajaxUserLogin');	// 登陆

Route::get('/login', 'EntranceController@loginPage');
Route::get('/logout', 'EntranceController@logoutPage');



	Route::get('/', 'EntranceController@index');
//	Route::get('/', ['middleware' => 'access', 'uses' => 'EntranceController@index']);
	
	Route::get('/setFunc', 'EntranceController@setFunc'); // 设置附图
	
	Route::get('/home', 'EntranceController@homeAll');
	Route::get('/homes', 'EntranceController@homeAlls');
	//Route::get('/homeX', 'EntranceController@homeAllX');
	
	Route::get('/imageH/{url?}', 'TestController@testImage');	// 测试 图片处理
	Route::get('/thumb160/{url?}', 'EntranceController@imageThumb');	// 测试 图片处理
	
	
	Route::get('/monitor/{type?}/{sort?}', 'MyController@monitorLog');
	//Route::get('/monitor/login', 'MyController@monitorLogIn');
	
	
	Route::get('/u/{id?}', 'EntranceController@userPage'); // PIMS.userPage
	Route::get('/i/{id?}', 'EntranceController@itemPage'); // PIMSI.itemPage
	
	/*游客页面*/
	Route::get('/guest', 'EntranceController@guestAll');
	Route::get('/guest/all', 'EntranceController@guestAll');
	Route::get('/guest/timer', 'EntranceController@guestTimer');
	Route::get('/guest/ask', 'EntranceController@guestAsk');
	Route::get('/guest/goods', 'EntranceController@guestGoods');
	Route::get('/guest/give', 'EntranceController@guestGive');
	
	//Route::get('/guest', 'GuestController@index');
	
	Route::get('/modifySQL', 'ModifyController@index');
	
	Route::get('/x', 'MyController@index');
	Route::get('/xx', 'MyController@xx');


	Route::post('/upfile', 'Service\ServiceController@swfUpfile');	// 上传 头像
	Route::post('/service/processPortrait', 'Service\ServiceController@ajaxProcessPortrait');	// 上传 头像
	Route::post('/service/setSetting', 'Service\ServiceController@ajaxSetSetting');	// 设置 用户信息
	Route::post('/service/isPassword', 'Service\ServiceController@ajaxIsPassword');	// 设置 用户信息
	

	/*Ajax*/
	
	Route::post('/service/checkName', 'Service\ServiceController@ajaxCheckName');	// 检测 名字
	Route::post('/service/checkPhone', 'Service\ServiceController@ajaxCheckPhone');	// 检测 手机号
	Route::post('/service/registerUser', 'Service\ServiceController@ajaxRegisterUser');	// 注册 新用户

	
	Route::post('/service/setAttaching', 'Service\ServiceController@ajaxSetAttaching');	// set 设置附图
	
	Route::post('/service/searchUser', 'Service\ServiceController@ajaxSearchUser');	// 查找用户
	Route::post('/service/handleConnRelation', 'Service\ServiceController@ajaxHandleConnRelation');	// 处理关系 
	
	
	Route::post('/service/isPermissionS', 'Service\ServiceController@ajaxPermissionS');	// 获取（所有）权限
	
	Route::post('/service/getConnection', 'Service\ServiceController@ajaxGetConnection'); // 获取 联系人
	
	Route::post('/service/geterDisplay', 'Service\ServiceController@ajaxGeterDisp'); // geter Display
	Route::post('/service/geterSearch', 'Service\ServiceController@ajaxGeterSearch'); // geter Display
	Route::post('/service/getSchedule', 'Service\ServiceController@ajaxGetSchedule'); // geter Schedule 日程
	
	Route::post('/service/getTheItem', 'Service\ServiceController@ajaxGetTheItem'); // get the Item
	Route::post('/service/getTheModify', 'Service\ServiceController@ajaxGetTheModify'); // get the content 修改内容
	Route::post('/service/modifyTag', 'Service\ServiceController@ajaxModifyTag'); // get the content 修改内容
	
	Route::post('/service/addCommunication', 'Service\ServiceController@ajaxAddCommunication'); // add Communication
	Route::post('/service/getCommunication', 'Service\ServiceController@ajaxGetCommunication'); // geter Communication
	
	/* session */ 
	Route::post('/service/refreshing', 'Service\ServiceController@ajaxRefreshing'); // 获取 会话列表
	Route::post('/service/getSessionList', 'Service\ServiceController@ajaxGetSessionList'); // 获取 会话-列表
	Route::post('/service/getSessionWork', 'Service\ServiceController@ajaxGetSessionWork'); // 获取 会话工作 Working
	Route::post('/service/setSessionZero', 'Service\ServiceController@ajaxSetSessionZero'); // set 提示清零
	Route::post('/service/setSessionDelete', 'Service\ServiceController@ajaxSetSessionDelete'); // set 提示清零
	
	/* adder */
	Route::post('/service/adderItem', 'Service\ServiceController@ajaxAdderItem');	// 添加 Adder ITEM
	
	/* item.operation */ 
	Route::post('/service/itemDelete', 'Service\ServiceController@ajaxItemDelete'); // 删除 ITEM
	Route::post('/service/itemShare', 'Service\ServiceController@ajaxItemShare'); // ITEM 分享 设置权限
	Route::post('/service/itemFavor', 'Service\ServiceController@ajaxItemFavor'); // ITEM 点赞 设置权限
	Route::post('/service/itemScore', 'Service\ServiceController@ajaxItemScore'); // ITEM 打分 设置权限
//	Route::post('/service/itemCollect', 'Service\ServiceController@ajaxItemCollect'); // 收藏
//	Route::post('/service/itemWorkIt', 'Service\ServiceController@ajaxItemWorkIt'); // 添加待办
//	Route::post('/service/itemFocusIt', 'Service\ServiceController@ajaxItemFocusIt'); // 关注
	Route::post('/service/itemCollect', 'Service\ServiceController@ajaxItemAddIt'); // 收藏
	Route::post('/service/itemWorkIt', 'Service\ServiceController@ajaxItemAddIt'); // 添加待办
	Route::post('/service/itemFocusIt', 'Service\ServiceController@ajaxItemAddIt'); // 关注
	Route::post('/service/itemForward', 'Service\ServiceController@ajaxItemForward'); // 关注
	
	Route::post('/service/getWeekNumber', 'Service\ServiceController@ajaxGetWeekNumber');	// get 第几周
	
	Route::post('/service/deleteFile', 'Service\ServiceController@ajaxDeleteFile'); // 删除指定文件
	Route::post('/service/uploadify', 'Service\ServiceController@ajaxUploadify'); // 上传文件
	
	
	/*测试*/
	Route::get('/testC', 'TestController@index');
	Route::get('/testC/{type?}', 'TestController@testALL');	// 测试 登陆 
	Route::get('/testC/ajax', 'TestController@testAjax');	// 测试 ajax是否实现	yes
	//Route::get('/test/testSQL/{id}?', 'TestController@testSQL');	// 测试 创建数据库
	Route::get('/test/register/{id?}', 'TestController@testRegister');	// 测试 注册用户 创建数据库 
	Route::get('/test/db/{id?}', 'TestController@testDB');	// 测试 注册用户 创建数据库 
	Route::get('/test/search/{id?}', 'TestController@test_selectInfos');	// 测试 查询不存在 
	Route::get('/test/log/{account?}/{password?}', 'TestController@test_is_LoginConfirm');	// 测试 登陆 
	Route::get('/test/insert', 'TestController@testInsert');	// 测试 登陆 
	Route::get('/test/updates', 'TestController@test_update');	// 测试 登陆 



Route::group(['prefix' => 'login', 'namespace' => 'Home'], function () {

    Route::post('submit', 'LoginController@login');	// 登陆
    Route::get('logout', 'LoginController@logout');	// 退出

    Route::post('check/name','LoginController@check_name');
    Route::post('check/phone','LoginController@check_phone');
    Route::post('check/email','LoginController@check_email');


    Route::post('register','LoginController@registerAction');

});


/*
 * 设置
 */
Route::group(['prefix' => 'setting', 'namespace' => 'Home', 'middleware' => ['access','login','page','home']], function () {

    Route::post('get','SettingController@getAction');
    Route::post('set','SettingController@setAction');
});


Route::group(['prefix' => 'dialog', 'namespace' => 'Home','middleware' => ['login']], function () {
	Route::get('add','DialogController@addAction');
	Route::get('delete','DialogController@deleteAction');
	Route::get('get','DialogController@getAction');

});

/**
 * geter
 */
Route::group(['prefix' => 'geter', 'namespace' => 'Home','middleware' => ['access']], function () {

	Route::post('display','DisplayController@geterAction');
    Route::post('schedule','DisplayController@geterAction');

	Route::get('display/guest','DisplayController@geterAction');
	Route::get('display/user','DisplayController@geterAciton');

	Route::group(['middleware' => 'page-mine'], function () {
		Route::get('delete','DisplayController@item_delete');
		Route::get('share','DisplayController@item_share');
    });
});


Route::group(['prefix' => 'communication', 'namespace' => 'Home', 'middleware' => ['page']], function () {

    Route::group(['middleware' => 'login'], function () {
        Route::post('add','CommunicationController@addAction');
    });

    Route::post('get','CommunicationController@getAction');

});

/**
 *
 */
Route::group(['prefix' => 'item', 'namespace' => 'Home', 'middleware' => ['access','login','page']], function () {

    Route::post('adder','ItemController@adderAction');

    Route::post('favor','ItemController@item_favor');
    Route::post('score','ItemController@item_score');
    Route::post('work','ItemController@item_work');
    Route::post('agenda','ItemController@item_agenda');
    Route::post('collect','ItemController@item_collect');

    Route::group(['middleware' => 'item-mine'], function () {
        Route::post('delete','ItemController@item_delete');
        Route::post('share','ItemController@item_share');
    });
});

/**
 *
 */
Route::group(['prefix' => 'relation', 'namespace' => 'Home','middleware' => ['login','page','home']], function () {

    Route::group(['middleware' => 'home'], function () {
        Route::post('get','RelationController@getAction');
    });
    Route::post('operate','RelationController@operateAction');

});


Route::group(['prefix' => 'up', 'namespace' => 'Home'], function () {
	Route::get('login','LoginController@login');
	Route::get('logout','LoginController@logout');
});



Route::post('/myapi/test', 'TestController@test_myapi');	// 测试 csrf_token

Route::get('/testLaravel/{type?}', 'TestController@testLaravel');
Route::get('/testProgram/{type?}', 'TestController@testProgram');


	
	// 测试
	Route::get('/test', function () {
	    //return view('test');
	    //echo "1";
	    
	    //return redirect()->route('/testC');
	    //$url = route('profile');
	    $route = Route::current();
	    $name = Route::currentRouteName();
		$action = Route::currentRouteAction();
	    return $route->uri;
	});
	// 测试
	Route::get('/testLearning', function () {
	    return view('testLearning');
	});
	// 测试
	Route::post('/myapik', function () {
		$return["test"] = "123";
    	$jsonData = json_encode($return);
    	return $jsonData;
	});

	

	

	
	
	
	Route::get('/sqlsx', function() // 集合操作
	{
			
			$arr = ['one','two','three'];
			$collection = collect($arr);
			$r = $collection->take(2); // 取值
			$r = $collection->take(-2); // 取值
			return $r;


//			$arr = ['one'=>'a','two'=>2,'three'=>3];
//			$collection = collect($arr);
//			$r = $collection->has(1);// 有没有键
//			return $r ? '有' : '没有';
			
			
//			$arr = ['one','two','three'];
//			$collection = collect($arr);
//			$r = $collection->contains('one'); // 有没有值
//			return $r ? '有' : '没有';
			
			//return $collection->all(); // 输出原型
			
			//dd($collection); // 显示集合
			
			
			
			//$user = new App\User();
			//$users = $user->all();
			//dd($users);
			//return $users->all(); // 返回原型
			//$users->toArray();
			
			//return $user->userRead();
	});
	
	Route::any('/les17', function() // 会话
	{
			//Session::put('name','lala'); // 指定值
			//return Session::get('name'); // 获取值
			//Session::forget('name'); // 删除
			return Session::pull('username'); // 使用一次并删除
			//dd(Session::has('namse')); // 判断是否存在
	});
	
	Route::any('/les17dd', function() // 会话
	{
			dd(Session::all()); // 
	});
	
	Route::any('/les17ses', function() // 会话
	{
			session(['username'=>'hanmeimei']); // 
	});
	
	Route::any('/les16', function() // 文件 
	{
			//dd(Request::file()); // 
			//dd(Request::file('profile')); // 
			//dd(Request::hasFile('profile')); // 
			//dd(Request::file('profile')->getSize()); // 获取大小
			//dd(Request::file('profile')->getClientOriginalName()); // 获取文件上传的原名称
			dd(Request::file('profile')->getClientOriginalExtension()); // 文件后缀名
	});
	
	Route::any('/les15', function() // 用户请求 get 第15课 请求历史
	{
			//return Request::flash(); // 除了参数的值
			//return Request::flashOnly('name'); // 除了参数的值
			return Request::flashExcept('name'); // 除了参数的值
	});
	Route::any('/les15old', function() // 用户请求 get 第15课 请求历史
	{
			dd(Request::old()); // 除了参数的值
	});
	
	Route::any('/l14', function() // 用户请求 get 第14课 请求检索
	{
			//dd(Request::all()); // 
			//dd(Request::only('name')); // 只有参数指定的值
			//dd(Request::except('name')); // 除了参数的值
			//dd(Request::url()); // 除了参数的值
			dd(Request::fullUrl()); // 除了参数的值
	});
	
	Route::any('/les13', function() // 用户请求 get 第13课 请求实例
	{
			//return Input::get('name');
			//return Request::input('name');
			//return Request::query();
			//return Request::query('name');
			//return Request::get('fName',"hanmeimei"); // 如果没有，则取第二个参数值
			//dd(Request::has('age')); // 值是否存在
			//dd(Request::exists('name')); // 键是否存在
	});
	
	Route::any('/les12', function() // 用户请求 get 第12课
	{
			//return Input::get('name');
			//return Request::input('name');
			return Request::all();
	});
	
	Route::get('/form', function() // 用户请求 post 第12课
	{
			return view('form');
	});
