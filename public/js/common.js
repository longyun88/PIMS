jQuery( function ($) {
    /*$.fn.extend({
        insertContent: function(myValue, t) {
            var $t = $(this)[0];
            if (document.selection) { //ie
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
                sel.moveStart('character', -l);
                var wee = sel.text.length;
                if (arguments.length == 2) {
                    var l = $t.value.length;
                    sel.moveEnd("character", wee + t);
                    t <= 0 ? sel.moveStart("character", wee - 2 * t - myValue.length) : sel.moveStart("character", wee - t - myValue.length);

                    sel.select();
                }
            } else if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
                if (arguments.length == 2) {
                    $t.setSelectionRange(startPos - t, $t.selectionEnd + t);
                    this.focus();
                }
            }
            else {
                this.value += myValue;
                this.focus();
            }
        }
    });*/
    common();
    load_common();
    load_setting();
    load_user();

    var currentState = history.state;
    window.onpopstate = function (event) {
        var history_state = event.state;
        if(history_state.page == "Guest")
        {
            if(history_state.geter == "Guest") $("#guestAll").click();
            else if(history_state.geter == "GuestTimer") $("#guestTimer").click();
            else if(history_state.geter == "GuestAskbar") $("#guestAsk").click();
            else if(history_state.geter == "GuestGoods") $("#guestGoods").click();
            else if(history_state.geter == "Give") $("#guestGive").click();
        }

        //console.log('location: ' + document.location);
        //console.log('state: ' + JSON.stringify(event.state));
    };

    //$("html").niceScroll();

    var scrollTop = -1;
    //var scrollHandler = function(){
    //    scrollTop = $(window).scrollTop();
    //    $(window).scroll(function(){
    //        scrollTop!==-1 && $(this).scrollTop(scrollTop);
    //    });
    //};
    //$(".box-page").hover(function() {
    //    layer.msg($(window).scrollTop());
    //    $(window).scroll(scrollHandler);
    //});
    //$(".box-page").mouseleave(function() {
    //    layer.msg($(window).scrollTop());
    //    scrollTop = 1;
    //    $(window).off("scroll", scrollHandler);
    //});

    //$(document).on("hover",".stop-window-scroll",function(){
    //        layer.msg($(window).scrollTop());
    //        scrollTop = $(window).scrollTop();
    //    }, function(){
    //        scrollTop = -1;
    //});
    $('.stop-window-scroll').hover(function(){
        scrollTop = $(window).scrollTop();
    }, function(){
        scrollTop = -1;
    });
    $(window).scroll(function() {
        scrollTop!==-1 && $(this).scrollTop(scrollTop);
    });


    $(document).on("click",function() {
        $(".itemFlowTool").slideUp(200);
        //$(".layout-float").hide(200);
    });
    $(window).scroll(function() {
        var nScrollTop = $(window).scrollTop();
        $("#page-Marking").attr("data-scrollTop",nScrollTop);
        $(".layout-float").slideUp(200);
        var clientWidth = getClientWidth();
        //var screenWidth = getScreenWidth();
        if(clientWidth <= 720) {
            $(".layout-sidebar").fadeOut();
            $(".layout-sidebar-back").hide();
        }
    });
    $(document).on("mousewheel DOMMouseScroll", function (e) {

        var delta =
            (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) ||  // chrome & ie
            (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1));              // firefox

        //if (delta > 0) console.log("wheelup"); // 向上滚
        //else if (delta < 0) console.log("wheeldown"); // 向下滚

        var clientWidth = getClientWidth();
        //var screenWidth = getScreenWidth();
        if(clientWidth <= 720)
        {
            $(".layout-sidebar").fadeOut();
            $(".layout-sidebar-back").hide();
        }
    });
		
		var urlPathName = window.location.pathname;// layer.msg(urlPathName);
		if(urlPathName == "/guest/all") {
			_intermediater("guestAll");
		}
        else if(urlPathName == "/guest/timer") {
			_intermediater("guestTimer");
		}
        else if(urlPathName == "/guest/ask") {
			_intermediater("guestAsk");
		}
        else if(urlPathName == "/guest/goods") {
			_intermediater("guestGoods");
		}
		
		
		// 注册IP地址
		$("#page-Marking").attr("data-ip",returnCitySN["cip"]);
		$("#page-Marking").attr("data-ipName",returnCitySN["cname"]);
		//layer.msg(returnCitySN["cip"]+','+returnCitySN["cname"]);
		//layer.msg(ILData[0]+','+ILData[1]+','+ILData[2]+','+ILData[3]);
		
		
/*
		window.onbeforeunload = onbeforeunload_handler; 
		function onbeforeunload_handler()
		{
			var warning="您还没有退出，是否退出？";          
			return warning;
		}  

		window.onunload = onunload_handler;
		function onunload_handler()
		{
			jQuery.ajax
			({
				url:"logout.php",
				cache:false,
				type:"post",
				data:{},
				success:function(data)
				{	
				}				
			});
		}
*/


	
});

// angular.js
var myApp = angular.module('pimsApp', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('[%');
	$interpolateProvider.endSymbol('%]');
});
myApp.controller("myCtrl",function($scope) {
});

function socketSessionHim($sessionId) 
{
	socket.emit('sessionHim', 120); //向服务器发送消息
}


function common() 
{

	/*window.onscroll=function() {layer.msg(window.innerHeight);
		//window.scrollTo(0,document.body.scrollHeight);
		//$(".fixed-head").css("top",$(window).scrollTop());
		//$(".fixed-head").css({'position':'absolute',"top":$(window).scrollTop()});
		//$(".fixed-foot").css({'position':'absolute',"top":$(window).scrollTop()+$(window).height()-96});
		//$(".fixed-head").css({'position':'absolute','top':'0'});
	}*/
	
	$(".mouseover").mouseover( function() {
		$( $(this).attr("data-hide") ).hide();
		$( $(this).attr("data-show") ).show();
	});
	$(".mouseleave").mouseleave( function() {
		//$( $(this).attr("data-show") ).hide();
		$(this).hide();
	});


	//回复输入框的回车效应
	$(document).on("paste cut keydown keyup focus blur enter",".textarea-auto",function() {
			$(this).height($(this)[0].scrollHeight - 0);
	});

	
	$(document).on("click",".showUserLog",function() {
		showUserLogin();
	});
	

	/*页面中登陆*/
	$(document).on("click","#userlogin-confirm",function() {
		
		var logNameObj = $("#userlogin_account");
		var logPassObj = $("#userlogin_password");
		
		var logName = logNameObj.val();
		var logPass= logPassObj.val();
		
		if(logName != "") {
			if(logPass != "") {
			} else {
				prompting(logPassObj,"#fcc");
			}
		} else {
			prompting(logNameObj,"#fcc");
		}
		
		var logInfo = LA_userLogin(logName,logPass);
		
		if(logInfo.status) {
			$("#user-login .UR_tip").html("登录成功！");
			$("#user-login .UR_tip").slideDown();
			$(".logNO").hide();
			$(".logIS").show();
			
			var myID = logInfo.myID;
			$(".item-container").attr("data-mine",myID);
			$(".index_home").show();
			$(".index_log").hide();
			
			$("#page-Marking").attr("data-log","iamloged");
			$("#page-Marking").attr("data-visitor",myID);
			$("#page-Marking").attr("data-mine",myID);
			$("#page-Marking").attr("data-id",myID);
			$("#page-Marking").attr("data-db","db"+myID);
			
			
		} else {
			$("#user-login .UR_tip").html("用户名或密码不正确！");
			$("#user-login .UR_tip").slideDown();
		}
	});
	$(document).on("keyup","#userlogin_password",function(event) {
   			if(event.keyCode == 13) {
				$("#userlogin-confirm").click();
			}
	});
	$(document).on("click",".userlogin-cansel",function() {
		resetUserLogin();
	});
	
}
function load_common() 
{
	
	// 输入方式
	//$(document).unbind("keydown");
	$(document).bind("keydown",function(event) {
			if(event.keyCode == 17) {
				$("#session_key").attr("value","17");
			}
	});
	//$(document).unbind("keyup");
	$(document).bind("keyup",function(event) {
			if(event.keyCode == 17) {
				$("#session_key").attr("value","");
			}
	});

	$(document).on("focus",".input_ph",function() { // 输入框 获得焦点
			$(this).attr("placeholder","");
	});
	//$(".input_ph").blur( function() {
	$(document).on("blur",".input_ph",function() { // 输入框 失去焦点
			$(this).attr("placeholder",$(this).attr("data-placeholder"));
	});
	
	$(document).on("mouseover",".changeText",function() { // 输入框 失去焦点
			$(this).html($(this).attr("data-overText"));
	});
	$(document).on("mouseout",".changeText",function() { // 输入框 失去焦点
			$(this).html($(this).attr("data-outText"));
	});
	
	
	$(document).on("click",".clickfocuser",function() { // 获得定位焦点
		var focuser = $(this).attr("data-clickfocuser");
		$(focuser).focus();
	});
	$(document).on("blur",".blurhider",function() { // 失去焦点，隐藏浮动菜单
		var hider = $(this).attr("data-blurhider");
		$(hider).hide();
	});




	$(document).on("click",".index_home",function() { // 返回主页
			location.href = "/home";
	});
	$(document).on("click",".logout",function() { // 退出登录
			location.href = "/login/logout";
	});
	$(document).on("click",".login",function() { // 登录页 - 登陆
			location.href = "/login";
	});
	$(document).on("click",".login-register",function() { // 登陆页 - 注册
			//location="login.php?register";
			location.href = "login?register";
	});
	
	

	$(document).on("click",".off-page",function() { // 关闭当前页
			window.close();
	});

	$(document).on("click",".radiorOnly",function() {
		var Tselected = $(this).attr("data-select");
		if( $(this).attr("data-selected") == "selected") {
			$(this).removeClass(Tselected);
			$(this).attr("data-selected","0");
		} else {
			$(this).addClass(Tselected);
			$(this).attr("data-selected","selected");
		}
	});
	

	$(document).on("click",".redirector",function() { // 重新定位
			var targeturl = $(this).attr("data-url");
			window.location.href = targeturl;
	});
	$(document).on("click",".redirect",function() { // 重新定位
			var targeturl = $(this).attr("data-url");
			window.open(targeturl);
	});
	$(document).on("click",".whos",function() { // 打开用户主页 指向 /u
			var targeturl = window.location.protocol + '//' + window.location.host + '/u/' + $(this).attr("data-whos");
			window.open(targeturl);
	});
	$(document).on("click",".itemer",function() { // 打开item page 指向 "ITEM"  /i
			//layer.msg(window.location.pathname+" "+window.location.href);//window.location.href | window.location.pathname | window.location.protocol
			var targeturl = window.location.protocol + '//' + window.location.host + '/i/' + $(this).attr("data-itemer");
			window.open(targeturl);
	});
	
	$(document).on("click",".switcher",function() { // 开关
			var selected_Style = $(this).attr("data-style");
			if($(this).hasClass(selected_Style)) {
				$(this).removeClass(selected_Style);
				$(this).attr("data-selected","0");
			} else {
				$(this).addClass(selected_Style);
				$(this).attr("data-selected","1");
			}
	});
	
	$(document).on("click",".radior",function() { // 单选框 ONLY
			var parent_num = $(this).attr("data-parent");
			var radio_parent = $(this);
			for(var i = 0;i < parent_num;i++) {
				var radio_parent = radio_parent.parent();
			}
			
			var the_selected = $(this).attr("data-selected");
			radio_parent.attr("data-selected",the_selected);
			
			var selected_Style = $(this).attr("data-style");
			radio_parent.find(".radior").removeClass(selected_Style);
			$(this).addClass(selected_Style);
	});

    // 单选框 只有样式
    $(document).on("click",".radior_0",function() {
        var radio_parent = $(this).parents(".radior-parent");
        var selected_Style = radio_parent.attr("data-style");
        $(this).addClass(selected_Style).siblings(".radior_0").removeClass(selected_Style);
    });
    // 单选框 有样式 & 有选项值
    $(document).on("click",".radior_1",function() {
        var radio_parent = $(this).parents(".radior-parent");
        var selected_Style = radio_parent.attr("data-style");
        $(this).addClass(selected_Style).siblings(".radior_1").removeClass(selected_Style);
        radio_parent.attr("data-selected",$(this).attr("data-selected"));
    });
	
	//$(".switch_selecter").unbind("click"); // 单选框
	$(document).on("click",".switch_selecter",function() {
			if($(this).hasClass("selected")) {
				$(this).removeClass("selected");
				$(this).attr("value","");
			} else {
				$(this).addClass("selected");
				$(this).attr("value","selected");
			}
	});
	
	//$(".btn_switch").unbind("click"); // 开关
	$(document).on("click",".btn_switch",function() {
			var the_selected = $(this).attr("data-selected");
			if($(this).hasClass(the_selected)) {
				$(this).removeClass(the_selected);
				$(this).attr("value","");
			} else {
				$(this).addClass(the_selected);
				$(this).attr("value",the_selected);
			}
	});
	
	$(document).on("click",".btn_radio",function() { // 单选框 - 多选一
			var parent_num = $(this).attr("data-parent");
			var the_parent = $(this);
			for(var i = 0;i < parent_num;i++)
			{
				var the_parent = the_parent.parent();
			}
			
			var the_selected = $(this).attr("data-selected");
			the_parent.find(".btn_radio").removeClass(the_selected);
			$(this).addClass(the_selected);
	});
	
	$(document).on("click",".radio_selecter",function() { // 单选框 - 多选一  ONLY
			var radio_parent = $($(this).attr("data-parent"));
			radio_parent.find(".radio_selecter").removeClass("selected");
			$(this).addClass("selected");
	});
	
	$(document).on("click",".box_shower",function(e) { // 显示 or 隐藏 ONLY
			var box_parent = $($(this).attr("data-parent"));
			var box_shower = $($(this).attr("data-shower"));
			box_parent.find(box_shower).toggle();
			e.stopPropagation();
	});
	
	$(document).on("click",".boxes_shower",function() { // 显示 or 隐藏
			var parent_num = $(this).attr("data-parent");
			var box_parent = $(this);
			var box_shower = $(this).attr("data-shower");
			for(var i = 0;i < parent_num;i++)
			{
				var box_parent = box_parent.parent();
			}
			box_parent.find(box_shower).toggle();
			box_parent.find("input").focus();
	});
	
	$(document).on("click",".hider",function() { // 隐藏
			var the_num = $(this).attr("data-parent");
			var the_parent = $(this);
			for(var i = 0;i < the_num;i++) {
				var the_parent = the_parent.parent();
			}
			the_parent.hide("normal");
	});

	$(document).on("click",".closer",function() { // 关闭
			var the_num = $(this).attr("data-parent");
			var the_parent = $(this);
			for(var i = 0;i < the_num;i++) {
				var the_parent = the_parent.parent();
			}
			the_parent.remove();
	});

	$(document).on("click",".remover",function() { // 删除
			var the_num = $(this).attr("data-parent");
			var the_parent = $(this);
			for(var i = 0;i < the_num;i++)
			{
				var the_parent = the_parent.parent();
			}
			the_parent.remove();
	});
	
	
	$(document).on("click",".pusher",function() {
		var clicker = $(this).attr("data-click");
		$(clicker).click();
	});
	
	
	$(document).on("click",".seter",function() { // 设置属性
		var setTarget = $(this).attr("data-setTarget");
		var setAttr = $(this).attr("data-setAttr");
		var setValue = $(this).attr("data-setValue");
		$(setTarget).attr(setAttr,setValue);
	});
	
	$(document).on("click",".clicker",function() { // 定向点击
		var clicker = $(this).attr("data-clicker");
		$(clicker).click();
	});
	
	$(document).on("click",".back-P",function() { // 指定位置返回点击
		var cilcker = $(this).attr("data-cilckerbackP");
		$("#page-Marking").attr("data-clicker",cilcker);
	});
	
	$(document).on("click",".clickerback",function() { // 指定位置返回点击
		var cilckerbackTarget = $(this).attr("data-cilckerbackTarget");
		var cilckerbackBtn = $(this).attr("data-cilckerbackBtn");
		$(cilckerbackTarget).attr("data-clicker",cilckerbackBtn);
	});
	
	$(document).on("click",".cilckerbackId",function() {
		var cilckerback = $(this).attr("data-cilckerback");
		var clicker = "#" + $(this).attr("id");
		$(cilckerback).attr("data-clicker",clicker);
	});
	
	$(document).on("click",".titler",function() {
		var titler_text = $(this).attr("data-titler-text");
		var titler_target = $(this).attr("data-titler-target");
		$(titler_target).html(titler_text);
	});
	
	$(document).on("click",".selectorT",function() {
			var selected = $(this).attr("data-selected");
			var selectorText = $(this).attr("data-selector");
			var selectorTarget = $(this).attr("data-selectorT");
			var selectors = selectorText.split(" ");
			for (var j=0;j<selectors.length;j++) {
				$(selectors[j]).removeClass(selected);
			}
			$(selectorTarget).addClass(selected);
	});

	$(document).on("click",".selector",function() {
			var selected = $(this).attr("data-selected");
			var selectorText = $(this).attr("data-selector");
			var selectors = selectorText.split(" ");
			for (var j=0;j<selectors.length;j++) {
				$(selectors[j]).removeClass(selected);
			}
			$(this).addClass(selected);
	});

	$(document).on("click",".toggler",function() {
		
			var showText = $(this).attr("data-show");
			var showers = showText.split(" ");
			for (var j=0;j<showers.length;j++) {
				$(showers[j]).toggle();
			}
	});
	
	$(document).on("click",".LB-Mark",function() {
		
		var myClicker = $(this).attr("id");
		var myBacker = "#"+myClicker;
		var myLB = $(this).attr("data-LB");
		
		var showText = $(this).attr("data-show");
		var hideText = $(this).attr("data-hide");
		
		var M_LB_Current = $("#page-Marking").attr("data-LB-Current");
		var M_backer_Current = $("#page-Marking").attr("data-backer-Current");
		
		var currentLBH = document.body.scrollTop;
		var myScroll = $(myLB).attr("data-scroll");
		
		if(M_LB_Current != myLB) {
			$("#page-Marking").attr("data-LB-Current",myLB);
			$("#page-Marking").attr("data-LB-Last",M_LB_Current);
			
			$("#page-Marking").attr("data-backer-Current",myBacker);
			$("#page-Marking").attr("data-backer-Last",M_backer_Current);
			
		}
		//$("#currentLB").offset().top = ;
		//$(currentLB).css("top",xx);
		//$(currentLB)[0].style.height = xx;
		
			$(M_LB_Current).attr("data-scroll",currentLBH);
			$(hideText).hide();
			$(myLB).show();
			document.body.scrollTop = myScroll;
	});
	$(document).on("click",".shower",function() {
			var hideText = $(this).attr("data-hide");
			var hiders = hideText.split(" ");
			for (var i=0;i<hiders.length;i++) {
				$(hiders[i]).hide();
			}
			
			var showText = $(this).attr("data-show");
			var showers = showText.split(" ");
			for (var j=0;j<showers.length;j++) {
				$(showers[j]).show();
			}
	});
	$(document).on("click",".hideres",function() {
			var hideText = $(this).attr("data-hide");
			var hiders = hideText.split(" ");
			for (var i=0;i<hiders.length;i++) {
				$(hiders[i]).hide();
			}
	});
	
	$(document).on("click",".hiders",function() {
			$( $(this).attr("data-hider") ).hide();
	});
	
	
	//$(".cilcker").unbind("click");
	$(document).on("click",".setheadbacker",function() { // 指定返回按键的属性
		var clicker = $(this).attr("data-backer-clicker");
		var html = $(this).attr("data-backer-html");
		$("#header-backer").attr("data-clicker",clicker);
		$("#header-backer-title").html(html);
	});
	
		
	// 关闭第一层屏幕
	$(document).on("click","#screen",function() {
			$("#screen").slideUp("normal");
			$("#time_selector").hide("normal");
			$("#clock_selector").hide("normal");
			$("#cycle_selector").hide("normal");
			$("#set_infos_container").hide("normal");
			$("#common_tools_add_grpup_confirm").hide("normal");
			$(".receiver_selector").hide("normal");
			$(".session_hide").click();
	});
	// 打开第一层屏幕
	$(document).on("click",".screen-shower",function() {
			$("#screen").slideDown("normal");
	});
	// 隐藏第一层屏幕
	$(document).on("click",".screen-hider",function() {
			$("#screen").slideUp("normal");
	});
	// 打开第一层屏幕
	$(document).on("click",".screen_show",function() {
			$("#screen").slideDown("normal");
	});
	// 隐藏第一层屏幕
	$(document).on("click",".screen_hide",function() {
			$("#screen").slideUp("normal");
	});
	
	// 关闭第二层屏幕
	$(document).on("click","#screen_s",function() {
			$("#screen_s").slideUp("normal");
			$("#month_selector").slideUp("normal");
	});
	// 打开第二层屏幕
	$(document).on("click",".screen_s_show",function() {
			$("#screen_s").show("normal");
	});
	// 隐藏第二层屏幕
	$(document).on("click",".screen_s_hide",function() {
			$("#screen_s").slideUp("normal");
	});

    $(document).on("click",".show-sidebar",function() {
        $(".layout-sidebar").fadeIn();
        $(".layout-sidebar-back").show();
    });
    $(document).on("click touchmove",".layout-sidebar-back",function() {
        $(".layout-sidebar-back").hide();
        var clientWidth = getClientWidth();
        //var screenWidth = getScreenWidth();
        if(clientWidth <= 720) {
            $(".layout-sidebar").fadeOut();
        }
    });


	
}
// 设置
function load_setting() 
{


    $(document).on("click","#show-setting",function() {

        $(".display-hide").hide();
        $("#setting-page").show();

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_get_setting(pageVisitor,pageType);
        if(result.status) $("#setting-page .entity_ctn").html(result.html);
        else _myAlert(result.msg, 2750,"fail");
    });
    $(document).on("click","#setting-submit",function() {
        var setting_form = $("#setting-form");
        var password_pre = $('input[name=password_pre]').val();
        var password_new = $('input[name=password_new]').val();
        var password_confirm = $('input[name=password_confirm]').val();
        if(password_new != "")
        {
            if(password_pre == "")
            {
                $('input[name=password_pre]').focus();
                prompting($('input[name=password_pre]'),"#fcc");
                return false;
            }
            if(password_new != password_confirm)
            {
                _myAlert("两次密码输入不一致！",2750,"fail");
                $('input[name=password_new]').val("");
                $('input[name=password_confirm]').val("");
                return false;
            }
        }


        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var post_text = "&page_visitor="+pageVisitor+"&page_type="+pageType+"&";
        $.post('/setting/set', post_text+setting_form.serialize(), function(data){
            if(data.status)
            {
                _myAlert("修改成功",2750,"success");
                $('input[name=password_pre]').val("");
                $('input[name=password_new]').val("");
                $('input[name=password_confirm]').val("");
            }
            else _myAlert(data.msg,2750,"fail");
        }, 'json');

    });


	$(document).on("click","#info_submit",function() {
			$("#info_name");
			$("#info_birthday");
	});

	$(document).on("click","#info_cansel",function() {
			$("#set_infos_container").hide();
			$("#screen").css("display","none");
	});
	
	$(document).on("click","#info_birthday",function() {
			var target_url = "#info_birthday";
			$("#date_confirm").attr("data-target",target_url);
			$("#select_date").show("fast");
			$("#screen_s").show("fast");
			date_init();
	});



	$(document).on("click","#open_file",function() {
			$("#up_files").click();	
	});
	//$("#up_files").change( function() {
	$(document).on("click","#up_files",function() {
			var tem_val = $(this).val().split("\\");
			var the_val = tem_val[tem_val.length - 1];
			$("#open_file").val(the_val);	
	});
	$(document).on("click","#upload_portrait_confirm",function() {
			setTimeout ( function() {
					if( ($("#open_file").val() != "") &&  ($("#open_file").val() != "重新选择") ) {
						var db = $("#session_db").val();
						var url = "./images/" + db + "/portrait_tem.jpg?time()3";
						$(".upload_portrait_show img").attr("src",url);
						$("#open_file").val("重新选择");
					}	
			},1000);
	});
	$(document).on("click","#up_portrait_confirm",function() {
			var type = "confirm";
			var the_result = operate_up_portrait(type);

			var db = $("#session_db").val();
			var url = "./images/" + db + "/portrait.jpg?time()1";

			if(the_result == 1)
			{
				$(".upload_portrait_ctn").hide();
				$(".upload_portrait_show img").attr("src",url);
				$(".info_portrait img").attr("src",url);
				$(".header_img img").attr("src",url);
			}
	});
	$(document).on("click","#up_portrait_cansel",function() {
			var type = "cansel";
			var the_result = operate_up_portrait(type);

			var db = $("#session_db").val();
			var url = "./images/" + db + "/portrait.jpg?time()2";

			$(".upload_portrait_ctn").hide();
			$(".upload_portrait_show img").attr("src",url);
			
	});
	
	
	// setting 设置 点击 编辑按钮
	$(document).on("click",".set_edit",function() {
			var target = $(this).attr("data-parent");
			var shared = $(target).attr("data-share");
			
			$(target).find(".set_selector").removeClass("selected");
			$(target).find(".set_selector[data-share="+shared+"]").addClass("selected");
	});
	// 修改 信息
	// 修改密码
	$(document).on("click",".set_password_confirm",function() {
			var parent = $(this).attr("data-parent");
			var mine = $(this).attr("data-mine");
			var type = $(this).attr("data-type");
			var obj_pre = $("#card_pre_password");
			var obj_new = $("#card_new_password");
			var obj_confirm = $("#card_confirm_password");
			var preP = obj_pre.val();
			var newP = obj_new.val();
			var confirmP = obj_confirm.val();
			if(preP != "") {
				if( (newP != "") && (confirmP != "") ) {
					if(newP == confirmP) {
						var allow = LA_isPassword
						if(allow.result == "YES") {
							LA_setSetting(type,newP,0);
							$(parent).find(".set_info").html("修改成功！");
							obj_pre.val("");
							obj_new.val("");
							obj_confirm.val("");
							//$(parent).find(".box_shower").click();
							//prompting(obj_pre,"#ccf");
						} else {
							obj_pre.val("");
							obj_pre.focus();
							prompting(obj_pre,"#fcc");
							$(parent).find(".set_info").html("原密码不正确！");
						}
					} else {
						obj_new.val("");
						obj_confirm.val("");
						obj_new.focus();
						prompting(obj_new,"#fcc");
						prompting(obj_confirm,"#fcc");
						$(parent).find(".set_info").html("两次密码不一致！");
					}
				} else if( (newP == "") && (confirmP == "") ) {
					prompting(obj_new,"#fcc");
					prompting(obj_confirm,"#fcc");
				} else if(newP == "") {
					prompting(obj_new,"#fcc");
				} else if(confirmP == "") {
					prompting(obj_confirm,"#fcc");
				}
			} else {
				obj_pre.focus();
				prompting(obj_pre,"#fcc");
			}
	});

}
// 查找用户 
function load_user() 
{
	$(document).on("click",".request_friend_confirm",function() {
			var id = $(this).attr("data-id");
			var operate = $(this).attr("data-type");
			var ps = $(this).parent().parent().find(".request_friend_ps").val();
			var result = ajax_request_connection("user",operate,id,ps);
			var pieceP = $(this).parent().parent().parent().parent();
			pieceP.replaceWith(result);
	});

	
	$(document).on("click",".page_relation",function() {
        var operate = $(this).attr("data-operate");
        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_operate_relation(pageVisitor,operate,pageBelong);
        if(result.status) location.reload();
        else _myAlert(result.msg,2750,"fail");
	});
	$(document).on("click",".user_attention",function() {
			var userP = $(this).parent().parent().parent().parent();
			var userId = userP.attr("data-id");
			var userSort = userP.attr("data-sort");
			var operate = $(this).attr("data-operate");
			
			var pageType = $("#page-Marking").attr("data-type");
			var pageVisitor = $("#page-Marking").attr("data-visitor");
			var pageBelong = $("#page-Marking").attr("data-belong");
		
			var para = new Array();
			para["postMyId"] = pageVisitor;
			para["operate"] = operate;
			para["userId"] = userId;
			para["userSort"] = userSort;
			var result = LA_handle_connection(para);
			if(result.status == "success") 
			{
				userP.replaceWith(result.html);
			} else {
				if(result.explain == "unLog") {
					_alertLogin();
				} else if(result.explain == "userChanged") {
					_alertRefresh(); 
				}
				//layer.msg(result.status);
			}
			
			
	});
	// 取消
	$(document).on("click",".ReConfirm_cansel",function() {
		
			$(this).parent().parent().parent().find(".relation_shower").hide();
	});
	$(document).on("click",".u_handle_relation",function() {
			
			var operate = $(this).attr("data-operate");
			var id = $(this).attr("data-id");
			var ps = "";
			var result = ajax_request_connection("user",operate,id,ps);
			
			if(operate == "request_friend") {
				$(this).html("已发送请求");
				$(this).attr("data-operate","");
				$("#session_linkman").attr("data-update","y");
			} else if(operate == "delete_friend") {
				$(this).html("已解除关系");
				$(this).attr("data-operate","");
				$("#session_linkman").attr("data-update","y");
			} else if(operate == "attention_it") {
				$(this).html("取消关注");
				$(this).attr("data-operate","attention_cansel");
				$("#session_channel").attr("data-update","y");
			} else if(operate == "attention_cansel") {
				$(this).html("关注");
				$(this).attr("data-operate","attention_it");
				$("#session_channel").attr("data-update","y");
			}
	});
}


function _intermediater(id)
{
	var theID = "#" + id;
	var hidex = $(theID).attr("data-hide");
	var showx = $(theID).attr("data-show");
	var selectorx = $(theID).attr("data-selector");
	var selectedx = $(theID).attr("data-selected");
	var targetx = $(theID).attr("data-titler-target");
	var textx = $(theID).attr("data-titler-text");
	
	$("#intermediater").attr("data-hide",hidex);
	$("#intermediater").attr("data-show",showx);
	$("#intermediater").attr("data-selector",selectorx);
	$("#intermediater").attr("data-selected",selectedx);
	$("#intermediater").attr("data-selectorT",theID);
	$("#intermediater").attr("data-titler-target",targetx);
	$("#intermediater").attr("data-titler-text",textx);
	
	$("#intermediater").click();
}
function library_shower(type,result,container) 
{
	if(type == "init") {
		$(container).html(result);
	} else if(type == "more") {
		$(container).append(result);
	} else if(type == "insert") {
		$(container).prepend(result);
	} else if(type == "replace") {
		$(container).replaceWith(result);
	}
}
function itemChange(itemIdentity,itemHtml)
{
	library_shower("replace",itemHtml,".item-container[data-identity=" + itemIdentity + "]");
}

/**/
function layerAlertCustom(customWidth,customText,customTime)	// 提示 需要登陆
{
	var clientWidth = getClientWidth();
	var screenWidth = getScreenWidth();
	var theLeft = (clientWidth - customWidth)/2;
	var theLeftPx = theLeft + "px";
	var customWidthPx = customWidth + "px";
	
	layer.msg(customText,{time:customTime,area: [ customWidthPx, '48px'],offset:['200px', theLeftPx]});
}
function layerAlertLog()	// 提示 需要登陆
{
	var clientWidth = getClientWidth();
	var screenWidth = getScreenWidth();
	var theLeft = clientWidth/2 - 60;
	var theLeftPx = theLeft + "px";
	layer.msg('请先登录',{time:2000,area: ['120px', '48px'],offset:['160px', theLeftPx]});
}
function layerAlertNoChange()	// 提示 没有改变
{
    _myAlert("没有修改状态",2750,"warn");
}
function myAlertOnTop(text,time,color)	// 头部提示 功能构建函数
{
	$("#my-AlertOnTop").html(text);
	$("#my-AlertOnTop").css("background",color);
	$("#my-AlertOnTop").slideDown();
	setTimeout('$("#my-AlertOnTop").slideUp()',time);
}

function _myAlert(text,time,status)
{
    var color;
    if(status == "success") color = "#5FB878"; // 绿色
    else if(status == "fail") color = "#dd0a20"; // 红色
    else if(status == "warn") color = "#eb7350"; // 橙色
    else color = "#000";
    myAlertOnTop(text,time,color);
}
function _alertLogin()	// 提示 需要登陆
{
	myAlertOnTop("请先登录！",2750,"#dd0a20"); // 红色
	//myAlertOnTop("请先登录！",2500,"#eb7350"); // 橙色
}
function _alertRefresh()	// 提示 需要更新
{
	myAlertOnTop("用户信息有变动，重新刷新页面试！",2750,"#dd0a20"); // 红色
}
function _alertRefuse()	// 提示 没有权限
{
	myAlertOnTop("权限有误，重新刷新页面试试！",2750,"#dd0a20"); // 红色
}


function resetUserLogin() 
{
	$("#user-login").slideUp();
	$("#user-login .UR_header").html("请先登录");
	$("#user-login .UR_tip").html("");
	$("#userlogin_password").val("");
	$(".logNO").show();
	$(".logIS").hide();
}
function showUserLogin() 
{
	$(".logNO").show();
	$(".logIS").hide();
	$("#user-login").slideDown();
}


function LA_userLogin(account,password)
{
	var result;
	jQuery.ajax
	({
		url:"/login/submit",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			account:account,
			password:password//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}


// permission 权限
function LA_PermissionS(type,pageVisitor,pageBelong,itemBelong) // Laravel ajax 返回 权限
{
	var result;
	jQuery.ajax
	({
		url:"/service/isPermissionS",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			type:type,
			pageVisitor:pageVisitor,
			pageBelong:pageBelong,
			itemBelong:itemBelong//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result.log);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function handleItemPermission(operateBelong,pageType,pageVisitor,pageBelong,itemBelong) // 获取 item 操作权限
{
	var permResult = LA_PermissionS("itemOper",pageVisitor,pageBelong,itemBelong);
	//var confirmResult = new Array();
	var confirmResult = permResult;
	
	if(permResult.log == "yes") // 已经登陆
	{ 
		if(operateBelong == "operCommon") 
		{
			confirmResult.confirm = "yes";
		} else if(operateBelong == "operMine") 
		{
			if(permResult.itemRelation == "MINE") // item.belong=mine
			{ 
				confirmResult.confirm = "yes";
			} else // item.belong=others
			{ 
				confirmResult.confirm = "no";
				_alertRefuse();
			}
		} else if(operateBelong == "operOthers") 
		{
			if(permResult.itemRelation == "MINE") // item.belong=mine
			{ 
				confirmResult.confirm = "no";
				_alertRefuse();
			} else // item.belong=others
			{ 
				confirmResult.confirm = "yes";
			}
		} else 
		{
			confirmResult.confirm = "yes";
		}
	} else // 未登录
	{ 
		confirmResult.confirm = "no";
		_alertLogin();
	}
	
	return confirmResult;
}




function LA_getConnection(type) // Laravel ajax 获取联系人
{
	var result;
	jQuery.ajax
	({
		url:"/service/getConnection",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			type:type//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result.status);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function LA_get_connection(page_type,page_visitor,get_sort) // Laravel ajax 获取联系人
{
    var result;
    jQuery.ajax
    ({
        url:"/relation/get",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_type:page_type,
            page_visitor:page_visitor,
            get_sort:get_sort
        },
        success:function(data) {
            result = data;
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}
// 收件人 ……
function ajax_getReceiver(type)
{
	var result;
	jQuery.ajax
	({
		url:"ajax.get.receiver.php",
		async:false,
		cache:false,
		type:"post",
		dataType:"text",
		data:
		{
			type:type
		},
		success:function(data)
		{
			result = $.trim(data);//layer.msg(result);
		}
	});
	return result;
}



function LA_handle_connection(para) // Laravel ajax 请求添加好友
{
	var postMyId = para["postMyId"];
	var type = para["type"];
	var operate = para["operate"];
	var userId = para["userId"];
	var userSort = para["userSort"];
	var ps = para["ps"];
	
	var result;
	jQuery.ajax
	({
		url:"/service/handleConnRelation",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			postMyId:postMyId,
			type:type,
			operate:operate,
			userId:userId,
			userSort:userSort,
			ps:ps
		},
		success:function(data) {
			result = data;
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}

function LA_operate_relation(page_visitor,operate,object_id) // Laravel ajax 请求添加好友
{
    var result;
    jQuery.ajax
    ({
        url:"/relation/operate",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            operate:operate,
            object_id:object_id
        },
        success:function(data) {
            result = data;
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}




function LA_add_item(page_type,page_visitor,adder) // Laravel ajax adderItem
{
	var result;
	jQuery.ajax
	({
		url:"/item/adder",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			page_type:page_type,
            page_visitor:page_visitor,
			adder:adder
		},
		success:function(data) {
			result = data;
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
			myAlertOnTop("发布失败！",2750,"#dd0a20"); // 提示添加ITEM失败
		}
	});
	return result;
}



function LA_item_add_communication(page_visitor,adder) // Laravel ajax 添加 评论
{
    var result;
    jQuery.ajax
    ({
        url:"/communication/add",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            adder:adder
        },
        success:function(data) {
            result = data;
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}

function LA_addCommunication(para) // Laravel ajax 添加 评论
{
	var operate= para["operate"];
	var display= para["display"];
	var userItemId = para["userItemId"];
	var belong = para["belong"];
	var item = para["item"];
	var objectId = para["objectId"];
	var point = para["point"];
	var content = para["content"];
	var share = para["share"];
	
	var result;
	jQuery.ajax
	({
		url:"/communication/add",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			operate:operate,
			display:display,
			userItemId:userItemId,
			belong:belong,
			item:item,
			objectId:objectId,
			point:point,
			content:content,
			share:share//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}



// ajax 获取 打赏
function ajax_getTips(display,get,whos,entity,location,permission) 
{
	var result;
	jQuery.ajax
	({
		url:"ajax.get.tips.php",
		async:false,
		cache:false,
		type:"post",
		dataType:"text",
		data:
		{
			display:display,
			get:get,
			whos:whos,
			entity:entity,
			location:location,
			permission:permission
		},
		success:function(data)
		{
			result = $.trim(data);//layer.msg(result);
		}
	});
	return result;
}
// ajax 获取 笔记
function ajax_getWrites(whos,item) {
	var result;
	jQuery.ajax
	({
		url:"ajax.get.writes.php",
		async:false,
		cache:false,
		type:"post",
		dataType:"text",
		data:
		{
			whos:whos,
			item:item
		},
		success:function(data)
		{
			result = $.trim(data);//layer.msg(result);
		}
	});
	return result;
}

// ajax 设置 清零
function ajax_reset(operate) {
	var result;
	jQuery.ajax
	({
		url:"ajax.reset.php",
		async:false,
		cache:false,
		type:"post",
		data:
		{
			operate:operate
		},
		success:function(data)
		{
			result = $.trim(data);
		}
	});
	return result;
}


function LA_deleteFile(file) // Laravel set 修改我的信息
{
	var result;
	jQuery.ajax
	({
		url:"/service/deleteFile",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			file:file//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}

// 设置 信息
function LA_setSetting(type,value,share) // Laravel set 修改我的信息
{
	var result;
	jQuery.ajax
	({
		url:"/service/setSetting",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			type:type,
			value:value,
			share:share//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function LA_get_setting(page_visitor,page_type) // Laravel set 修改我的信息
{
    var result;
    jQuery.ajax
    ({
        url:"/setting/get",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            page_type:page_type
        },
        success:function(data) {
            result = data;
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}
function LA_isPassword(mine,password) // Laravel 判断 密码是否正确
{
	var result;
	jQuery.ajax
	({
		url:"/service/isPassword",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			mine:mine,
			password:password//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function LA_searchUser(search) // Laravel ajax 获取 评论
{
	var result;
	jQuery.ajax
	({
		url:"/service/searchUser",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			search:search//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function LA_searchItem(tag) // Laravel ajax 查找 内容
{
	var result;
	jQuery.ajax
	({
		url:"/service/searchItem",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			searchTag:tag//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}


// 查找 好友
function ajax_get_TheUser(id) 
{
	var result;
	jQuery.ajax
	({
		url:"ajax.get.theUser.php",
		async:false,
		cache:false,
		type:"post",
		data:
		{
			id:id	
		},
		success:function(data)
		{
			result = $.trim(data);//layer.msg(result);
		}
	});
	return result;
}


function show_agendas(type,container,data) 
{
	var the_html = data.html;
	var the_num = data.count;

	var the_container = container + " .entity_ctn";
	library_shower("init",the_html,the_container);
}


function LA_getWeekNumber(day) // Laravel 获得一年中的第几周
{
	var result;
	jQuery.ajax
	({
		url:"/service/getWeekNumber",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			day:day//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}




// 设置menu刷新
function set_update(owner,type) 
{ 

	if(owner == "unfd") {
		$("#menu_unfd").attr("data-update",type);
	} else if(owner == "fd") {
		$("#menu_fd").attr("data-update",type);
	} else if(owner == "notes_mine") {
		$("#menu_show_notes_mine").attr("data-update",type);
	} else if(owner == "notes_attn") {
		$("#menu_show_notes_attn").attr("data-update",type);
	} else if(owner == "notes_fris") {
		$("#menu_show_notes_fris").attr("data-update",type);
	} else if(owner == "questions_mine") {
		$("#menu_show_questions_mine").attr("data-update",type);
	} else if(owner == "questions_fris") {
		$("#menu_show_questions_fris").attr("data-update",type);
	} else if(owner == "questions_others") {
		$("#menu_show_questions_others").attr("data-update",type);
	} else if(owner == "words_attn") {
		$("#menu_show_words_attn").attr("data-update",type);
	} else if(owner == "words_fris") {
		$("#menu_show_words_fris").attr("data-update",type);
	} else if(owner == "pms_in") {
		if( (type == "new") && ($("#menu_show_pms_in").attr("data-update") == "y") )
		{
		}
		else
		{
		$("#menu_show_pms_in").attr("data-update",type);
		}
	} else if(owner == "pms_out") {
		$("#menu_show_pms_iout").attr("data-update",type);
	} else if(owner == "about") {
		if( (type == "new") && ($("#menu_show_aboutMe").attr("data-update") == "y") )
		{
		}
		else
		{
			$("#menu_show_aboutMe").attr("data-update",type);
		}
	} else if(owner == "linkman") {
		$("#sidebar_linkman").attr("data-update",type);
	} else if(owner == "channel") {
		$("#sidebar_channel").attr("data-update",type);
	} else if(owner == "fans") {
		$("#sidebar_fans").attr("data-update",type);
	} else if(owner == "group") {
		$("#sidebar_group").attr("data-update",type);
	} else if(owner == "project") {
		$("#sidebar_project").attr("data-update",type);
	}
	
}
// 添加 | 删除 数量
function item_count(target,operate) 
{ 
	var ctn = $(target);
	var count = parseInt(ctn.attr("data-num"));
	if(operate == "plus") {
		count = count + 1;
	} else if(operate == "minus") {
		count = count - 1;
	}
	ctn.attr("data-num",count);
	ctn.html(count);
}



function setNum(ctn,num) // 设置提醒数量
{ 
	whos = $(ctn);
	var the_num = parseInt(whos.attr("data-num")) + parseInt(num);
	whos.attr("data-num",the_num);
	whos.html(the_num);
	whos.removeClass("_none");
}
function setNumDEC(ctn) // 数量-1
{ 
	whos = $(ctn);
	var the_num = parseInt(whos.attr("data-num")) - 1;
	whos.attr("data-num",the_num);
	whos.html(the_num);
	if(the_num == 0)
	{
		whos.addClass("_none");
	}
}


function checkAlnum(value) // 判断 是否是字母与数字的组合
{
	var Regx = /^[A-Za-z0-9]*$/;
	if (Regx.test(value)) {
		return true;
	} else {
		return false;
	}
}
function checkVar(value) // 判断 是否是纯字母
{
	var Regx = /^[A-Za-z]*$/;
	if (Regx.test(value)) {
		return true;
	} else {
		return false;
	}
}
function checkdigit(value) // 判断 是否是纯数字
{
		var Regx = /^[0-9]*$/;
		if (Regx.test(value)) {
			return true;
		} else {
			return false;
		}
}
function checkPhone(value)  // 判断 是否是手机
{
    var Regx = /^[1][3578]\d{9}$/;
    if (Regx.test(value)) return true;
    else return false;
}
function checkEmail(value)  // 判断 是否是邮箱
{
    var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,5}$/;
    var Regx = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,5}$/;
    if (Regx.test(value)) return true;
    else return false;
}

function checkPassname(passname) 
{
	var theReturn;
	var firstString = passname.slice(0,1);
	if( checkAlnum(passname) ) {
		if( checkVar(firstString) ) {
			theReturn = "true";
		} else {
			theReturn = "首字母必须为字母";
		}
		/*if( checkdigit(passname) ) {
			theReturn = "必须有字母";
		} else {
		}*/
	} else {
		theReturn = "只能输入字母和数字";
	}
	//theReturn = "只能输入字母和数字";
	return theReturn;
}



function Appendzero(obj) //添加前导零
{
	if(obj < 10)
	{
		return "0" + obj;
	}
	else
	{
		return obj;
	}
}

function trim(str) // 去掉两边空格
{ 
	return str.replace(/(^\s*)|(\s*$)/g, "");
}
function ltrim(str) // 去掉左边空格
{ 
	return str.replace(/(^\s*)/g,"");   
}
function rtrim(str) // 去掉右边空格
{ 
	return str.replace(/(\s*$)/g,"");   
}


function alartSound() // 声音提示
{
	 $("body").append('<embed src="sounds/ding.mp3" autostart="true" hidden="true" loop="false">');  
} 
function event_Alart(duration) 
{
	setTimeout ( function() { alartSound(); },duration);   
}

function prompting(object,bgcolor) // 错误提示
{
	setTimeout(function(){prompting_m(object,bgcolor)},100);
	setTimeout(function(){prompting_m(object,"")},350);
	setTimeout(function(){prompting_m(object,bgcolor)},600);
	setTimeout(function(){prompting_m(object,"")},950);
/*
	setTimeout(function(){prompting_m(object,bgcolor)},1000);
	setTimeout(function(){prompting_m(object,"")},1200);
*/
}
function prompting_m(object,bgcolor) 
{
	object.css("background-color",bgcolor);
}


function input_judge_price() // 判断 价格是否合法
{
	var input_judge = "";
	var obj_price = $("#input_price");
			
	if(obj_price.val() == "") {
		input_judge = "deny";
		prompting(obj_price,"#fcc");
		//prompting(obj_content,"#fcc");
		obj_price.focus();
	} else {
		if( isNaN(obj_price.val()) ) {
			input_judge = "deny";
			prompting(obj_price,"#fcc");
		} else {
			input_judge = "allow";
		}
	}
	return input_judge;
}
function input_judge_content() // 判断 内容输入是否合法
{
	var input_judge = "";
	var obj_content = $("#input_content");
			
	if(obj_content.val() == "") {
		input_judge = "deny";
		prompting(obj_content,"#fcc");
		obj_content.focus();
	} else {
		input_judge = "allow";
	}
	return input_judge;
}
function input_judge_text() // 判断 输入是否合法
{
	var input_judge = "";
	var obj_theme = $("#input_theme");
	var obj_content = $("#input_content");
			
	if( (obj_theme.val() == "") && (obj_content.val() == "") ) {
		input_judge = "deny";
		prompting(obj_theme,"#fcc");
		//prompting(obj_content,"#fcc");
		obj_theme.focus();
	} else {
		input_judge = "allow";
	}
	return input_judge;
}


function judge_adder_content(adderObj) // 判断 内容 合法性
{
	var input_judge = "";
	var obj_content = adderObj.find(".adder_content");
			
	if(obj_content.val() == "") {
		input_judge = "deny";
		prompting(obj_content,"#fcc");
		obj_content.focus();
	} else {
		input_judge = "allow";
	}
	return input_judge;
}
function judge_adder_text(adderObj) // 判断 输入 合法性
{
	var input_judge = "";
	var obj_theme = adderObj.find(".adderInput-Theme");
	var obj_content = adderObj.find(".adderInput-Content");
			
	if( (obj_theme.val() == "") && (obj_content.val() == "") ) {
		input_judge = "deny";
		prompting(obj_theme,"#fcc");
		//prompting(obj_content,"#fcc");
		obj_theme.focus();
	} else {
		input_judge = "allow";
	}
	return input_judge;
}
function judge_adder_price(adderObj) // 判断 价格 合法性
{
	var input_judge = "";
	var obj_price = adderObj.find(".adderInput-Price");
			
	if(obj_price.val() == "") {
		input_judge = "deny";
		prompting(obj_price,"#fcc");
		//prompting(obj_content,"#fcc");
		obj_price.focus();
	} else {
		if( isNaN(obj_price.val()) ) {
			input_judge = "deny";
			prompting(obj_price,"#fcc");
		} else {
			input_judge = "allow";
		}
	}
	return input_judge;
}

function time_judge(start_type,start_time,ended_type,ended_time) // 判断 时间 是否合法
{
	var result = "";
	var input_agenda_judge = "";
	var start =	Date.parse(start_time);
	var ended =	Date.parse(ended_time);

	if((start_type == "0") && (ended_type == "0")) {
		input_agenda_judge = "00";
	}
	else if((start_type == "1") && (ended_type == "1")) {
		if(start_time == ended_time) {
			input_agenda_judge = "111";
		} else {
			if(start > ended) {
				input_agenda_judge = "22";
			}
		}			
	} else if((start_type == "1") && (ended_type == "2")) {	
			if(start > ended) {
				input_agenda_judge = "22";
			}
/*			
		tem_start_result = start_time.split(" ");
		tem_start_date = tem_start_result[0].split("-");
						
		tem_ended_result = ended_time;
		tem_ended_date = tem_ended_result.split("-");

		if(tem_start_date[0] > tem_ended_date[0])
		{
			input_agenda_judge = "12";
		}
		else if(tem_start_date[0] == tem_ended_date[0])
		{
			if(tem_start_date[1] > tem_ended_date[1])
			{
				input_agenda_judge = "12";
			}
			else if(tem_start_date[1] == tem_ended_date[1])
			{
				if(tem_start_date[2] > tem_ended_date[2])
				{
					input_agenda_judge = "12";
				}
			}
		}		
*/
	} else if((start_type == "2") && (ended_type == "1")) {
			if(start > ended) {
				input_agenda_judge = "22";
			}

	} else if((start_type == "2") && (ended_type == "2")) {	
			if(start > ended) {
				input_agenda_judge = "22";
			}		
	}

	result = time_judge_result(input_agenda_judge);

	return result;
}
function time_judge_result(time_judge) 
{
	var result = "deny";
	if(time_judge == "00") {
		myAlertOnTop("开始或结束时间请至少选择一样！",2500,"#eb7350");
	} else if(time_judge == "111") {
		myAlertOnTop("开始和结束时间一样，你这是要闹哪样！",2500,"#eb7350");
	} else if(time_judge == "11") {
		myAlertOnTop("结束时间应该 >= 开始时间！",2500,"#eb7350");
	} else if(time_judge == "12") {
		myAlertOnTop("结束时间应该 >= 开始时间！",2500,"#eb7350");
	} else if(time_judge == "21") {
		myAlertOnTop("结束时间应该 >= 开始时间！",2500,"#eb7350");
	} else if(time_judge == "22") {
		myAlertOnTop("结束时间应该 >= 开始时间！",2500,"#eb7350");
	} else {
		result = "allow";
	}

	return result;
}


function handle_tag(tag) 
{
	tem_tag = tag.split(" ");
	tag = "";

	for(var i = 0;i < tem_tag.length;i++) {
		if($.trim(tem_tag[i]) != "") {
			tem_tag[i] = $.trim(tem_tag[i]) + " ";
			tag += tem_tag[i];
		}
	}
	tag = $.trim(tag);
	return tag;
}
// 转化格式
function _my_replace(content) 
{
	//content = content.replace(/\n/g,"[{[br]}]");
	//content = content.replace(/ /g,"[{[n]}]");
	return content;
}
function _my_replace_back(content) 
{
	//content = content.replace(/\n/g,"<br>");
	//content = content.replace(/ /g,"&nbsp");
	content = content.replace(/\<br>/g,"\n");
	content = content.replace(/\&nbsp;/g," ");
	content = content.replace(/\&lt;/g,"<");
	content = content.replace(/\&gt;/g,">");

	return content;
}

function uploadevent(status,picUrl,callbackdata) 
{
	//layer.msg(picUrl); //后端存储图片
	//layer.msg(callbackdata); //后端返回数据
	var myId = $("#page-Marking").attr("data-id");//layer.msg(myId);
	status += '';
	switch(status){
	case '1':
		var time = new Date().getTime();
		var filename162 = picUrl+'_162.jpg';
		var filename48 = picUrl+'_48.jpg';
		var filename20 = picUrl+"_20.jpg";
		
		var processR = LA_processPortrait(myId,picUrl);
		
		//document.getElementById('avatar_priview').innerHTML = "
		//头像1 : <img src='"+filename162+"?" + time + "'/> <br/> 
		//头像2: <img src='"+filename48+"?" + time + "'/><br/> 
		//头像3: <img src='"+filename20+"?" + time + "'/>" ;
		
		var theHTML = '<img src="./images/db' + myId + '/picUrl?' + Math.random() + '">';//layer.msg(theHTML);
		$("sidebar-portrait").html(theHTML);
		break;
	case '-1':
		//window.location.reload();
		//layer.msg("取消");
		break;
	default:
		//window.location.reload();
    } 
}

function LA_processPortrait(myId,picUrl) // Laravel 更改图片位置
{
	var result;
	jQuery.ajax
	({
		url:"/service/processPortrait",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			myId:myId,
			picUrl:picUrl//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result.sort);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}


// 收件人
function load_receiver() 
{
	$(".receiver_hider").click( function() {
			$("#screen").hide("normal");
	});
	$(".receiver").unbind("click");
	$(".receiver").click( function() {
			var check_id = $(this).attr("data-id");
			if(check_pm_exists(check_id) == 0) {
				var pm_object = $(".hidden_tool .pm_object").clone(true);
				var the_id = $(this).attr("data-id");
				var the_name = $(this).attr("data-name");
				pm_object.attr("data-id",the_id);
				pm_object.find(".object_name").html(the_name);
				$(".pm_receiver").append(pm_object);
				//$(".pm_receiver")[0].scrollTop = $(".pm_receiver_c")[0].scrollHeight;
				$(this).addClass("selected");
			} else {
				$(".pm_receiver .pm_object[data-id=" + check_id + "]").remove();
				$(this).removeClass("selected");
			}
	});
}

/*LY.Library*/
function getClientWidth() // 浏览器宽度
{
	var result = document.documentElement.clientWidth;
	return result;
}
function getScreenWidth() // 屏幕宽度
{
	var result = window.screen.width;
	return result;
}
function getVerson() // 浏览器类型
{
	var browser={
		versions:function(){
			var u = navigator.userAgent, app = navigator.appVersion;
			return { // 移动终端浏览器版本信息
				trident: u.indexOf('Trident') > -1, //IE内核
				presto: u.indexOf('Presto') > -1, //opera内核
				webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
				gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
				mobile: !!u.match(/AppleWebKit.*Mobile.*/)||!!u.match(/AppleWebKit/), //是否为移动终端
				ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
				android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
				iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
				iPad: u.indexOf('iPad') > -1, //是否iPad
				webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
			};
		 }(),
		language:(navigator.browserLanguage || navigator.language).toLowerCase()
	}
	return browser;
/*
	layer.msg("语言版本:"+browser.language 
		+ "\n 是否为苹果、谷歌内核: "+browser.versions.webKit 
		+ "\n 是否为移动终端: "+browser.versions.mobile 
		+ "\n ios终端: "+ browser.versions.ios 
		+ "\n android终端: "+browser.versions.android 
		+ "\n 是否为iPhone: "+browser.versions.iPhone 
		+ "\n 是否iPad: "+browser.versions.iPad
		+ "\n "+ navigator.userAgent);
*/
}



// function funcs
function showPcAdder() 
{
	$(".display-hide").hide();
	$(".pc-adder").show();
}



function operate_confirm_set(type,tip) // 设置 确认框 信息
{
	$(".operate_confirm").find(".confirm_is").attr("value",type);
	$(".operate_confirm").find(".confirm_tip span").html(tip);
}
function operate_confirm_show(X,Y) // 显示 确认框
{
	$(".operate_confirm").css("top",X-108);
	$(".operate_confirm").css("left",Y-80);
}
function operate_confirm_hide() // 隐藏 确认框
{
	$(".operate_confirm").css("top","-9999px");
	$(".operate_confirm").css("left","-9999px");
}

function setWorkingINC() // 待办数 +1
{
	var num = parseInt($(".works_count").html());
	num = num + 1;
	$(".works_count").html(num);
	$(".works_count").attr("data-num",num);
	$(".works_count").show();
	$("#get-MyUnfinished").attr("data-update","y");
}
function setWorkingDEC() // 待办数 -1
{
	var num = parseInt($(".works_count").html());
	num = num - 1;
	$(".works_count").html(num);
	$(".works_count").attr("data-num",num);
	$("#get-MyUnfinished").attr("data-update","y");
	if(num == 0) {
		$(".works_count").hide();
	}
}

function showTheModify(display,id) // 填充修改内容
{	
	$("#input_confirm").attr("data-display",display);
	
	var input_ctn = $("#input_item_ctn");
	input_empty();
	$("#input_item_ctn").find(".input_header").hide();
	$("#input_item_ctn").find(".input_common").show();
	$("#input_item_ctn").find(".input_header_text").html(the_html);
	$("#input_item_ctn").find(".input_receiver").hide();
	$("#input_item_ctn").find(".input_time").hide();
	$("#input_item_ctn").find(".input_theme").show();
	$("#input_item_ctn").find(".input_tag").show();
	$("#input_item_ctn").find(".input_share").hide();
	$("#input_item_ctn").slideDown();
	$("#input_item_ctn").find("#input_confirm").attr("data-sort",sort);
	$("#input_item_ctn").attr("value","modify");
	
	var result = LA_getModify(id);
	var the_theme = result.theme;
	var the_content = result.content;
	var the_tag = result.tag;

	$("#input_theme").val(the_theme);
	$("#input_content").val(the_content);
	$("#input_tag").val(the_tag);
			
	$(".input_ctn .input_share").hide();
	$("#input_confirm").html("修改");
	$("#input_confirm").attr("data-item",id);
	$("#input_confirm").attr("data-operate","modify");
}



// 上传图片
function remove_upload_image() 
{
		var attaching = $("#input_confirm").attr("data-attaching");
		var attachment = $("#input_confirm").attr("data-attachment");
		
		var thePath;
		$(".upImage_page").each( function() {
			thePath = $(this).find("img").attr("src");//layer.msg(thePath);
			LA_deleteFile(thePath);
			$(this).remove();
		});
		$("#input_confirm").attr("data-attaching","");
		$("#input_confirm").attr("data-attachment","");
}

function load_uploadify() 
{
	
	//$("#file_upload").click( function() {
		$("#file_upload").uploadify({
			
			'formData' : {
				//'_token' : $('meta[name="_token"]').attr('content'),
				//'tokens' : $('meta[name="_token"]').attr('content'),
				'myID' : $("#page-Marking").attr("data-belong"),
				'timestamp' : '111',
				'token' : '123'
			},
			'swf' : 'uploadify.swf',
			'uploader' : 'uploadifys.php',
			//'uploader' : '/service/uploadify',
			'auto' : true,
			'buttonText' : '附图',
			'fileTypeExts': '*.gif; *.jpg; *.jpeg; *.png; *.bmp',
			'fileSizeLimit':'5MB',
			'removeTimeout' : '0.1',
			'uploadLimit' : '19',
			'width' : '130',
			'height' : '34',
			onUploadError: function (file, errorCode, errorMsg, errorString) {
				
				//layer.msg($("#page-Marking").attr("data-token"));
				layer.msg('文件“' + file.name + '”上传失败，错误信息: ' + errorString);
	        },
			'onUploadSuccess': function (fileObj, data, response) {
				//data = $.trim(data);//layer.msg(data);
				var result = data;//layer.msg(typeof result);
				var resultJsonObj = eval('(' + result + ')');//layer.msg(resultJsonObj);
				//fileObj.name = ""; //layer.msg(fileObj.name);
				//var picUrl = data;
				var picUrl = resultJsonObj.picUrl;
				var picName = resultJsonObj.picName;
				var cName = resultJsonObj.cName;
				
				html = '<div class="upImage-page upImage_page upImage-option" data-name="' + fileObj.name + '"><img src="' + picUrl +
				'" class=upImage-image data-picName=' + picName + ' data-cName=' + cName + 
				'><span class="btn-hover upImage-delete upImage_delete"><em class="iconer closer-icon"></em></span></div>';
				$(".upImage-image-ctn").append(html);
				//$("#input_confirm").attr("data-attaching",$("#input_confirm").attr("data-attaching")+"./" + data +'<|>');
				//$("#input_confirm").attr("data-attaching","");
				//all_name += data;
				//layer.msg(all_name);//怎么返回这个值？？然后把他放到txt1那里去
			}
		//});
	});

	$(document).on("click",".up_start",function() {
		$('#file_upload').uploadify('upload','*');
	});
	$(document).on("click",".up_clear",function() {
		$('#file_upload').uploadify('cancel','*');
	});

}



