jQuery( function($) {
		load_session();
		refresh();
});

// 边栏 操作
function load_session() 
{
	
	// 隐藏 session-container
//	$(document).on("click",".session-container",function() {
//		$(".session-hider").click();
//	});
	// 隐藏 session-container
	$(document).on("click",".session-hider",function() {
			//$("#working-marking").attr("data-currentis","no");
			//$("#working-marking").attr("data-currentid","");
			//$("#session-container").slideUp("normal");
			$("#session-container").hide();
			$("#screen").slideUp("normal");
	});
	// 
	$(document).on("click",".seesion-menu-option",function() {
	});
	$(document).on("click",".list-option",function() { // style 被选择样式
			$(".list-option").removeClass("list-selected");
			$(this).addClass("list-selected");
	});
	
	// 显示/隐藏 边栏
	$(document).on("click",".sidebar-display-ctrl",function() {
			$(".layout-sidebar-display").animate({right:"-40%"},600);
			/*
			if($(this).attr("value") == "l") {
				$(".layout-sidebar-display").animate({right:"60px"},100);
				$(this).find(".sidebar-icon").addClass("sidebar-right");
				$(this).find(".sidebar-icon").removeClass("sidebar-left");
				$(this).attr("value","r");
			} else if($(this).attr("value") == "r") {
				$(".layout-sidebar-display").animate({right:"-320px"},100);
				$(this).find(".sidebar-icon").addClass("sidebar-left");
				$(this).find(".sidebar-icon").removeClass("sidebar-right");
				$(this).attr("value","l");
			}
			*/
	});

	// 边栏 打开联系人
	$(document).on("click",".connection-_ctrl",function() {
			var update = $(this).attr("data-update");
			if(update == "y") {
				var type = $(this).attr("data-type");
				var container = $(this).attr("data-ctn");
				//var result = LA_getConnection(type);
                var result = LA_get_connection(type);
				library_shower("init",result.html,container);
				
				$(this).attr("data-update","n");
				$(".session-option-ctrl:first-child").click();
				$(container).mCustomScrollbar({autoHideScrollbar:true,theme:"light-thin"});
			} else {
			}
	});
	// 
	$(document).on("click",".connection-geter",function() {
			// set_backer_connect
            var pageType = $("#page-Marking").attr("data-type");
            var pageVisitor = $("#page-Marking").attr("data-visitor");
            var pageBelong = $("#page-Marking").attr("data-belong");

			var update = $(this).attr("data-update");
			var get_sort = $(this).attr("data-sort");
			var container = $(this).attr("data-ctn");
			if(update == "y") {
                var result = LA_get_connection(pageType,pageVisitor,get_sort);
                if(result.status)
                {
                    //library_shower("init",result.html,container);
                    library_shower("insert",result.html,container);
                }
                else _myAlert(result.msg,3000,"fail");
				
			} else if(update == "update") {
				var type = $(this).attr("data-type");
				var container = $(this).attr("data-ctn");
				var theContainer = container + " .mCSB_container";
			}
			$(".session_work_ctn").hide();
			//$(".currentIS").removeClass("currentIS");
			//$(container).find(".people-option-ctrl:first").click();
	});
    $(document).on("click",".connect-option",function() {
        var clientWidth = getClientWidth();
        //var screenWidth = getScreenWidth();
        if(clientWidth <= 1024) $(".display-hide").hide();
        $("#card-box").show();
        $(this).addClass("selected_6").siblings(".connect-option").removeClass('selected_6');

        var src = $(this).find(".connect-portrait img").attr("src");
        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var autograph = $(this).attr("data-autograph");
        var relation = $(this).attr("data-relation");
        var relation_text  = "";
        if(relation == 1) relation_text = "";
        else if(relation == 31) relation_text = "互相关注";
        else if(relation == 51) relation_text = "已关注";
        else if(relation == 81) relation_text = "移除粉丝";

        $("#card-box").attr("data-id",id);
        $("#card-box").attr("data-name",name);
        $("#card-box").attr("data-relation",relation);

        $("#card-box").find(".card-portrait img").attr("src",src);
        $("#card-box").find(".card-name").html(name);
        $("#card-box").find(".card-autograph").html(autograph);
        $("#card-box").find(".card-relation-text").html(relation_text);


    });

	
	
	// 边栏 打开会话
	$(document).on("click",".session-shower-control",function() {

//			input_cansel();
//			$("#session-card").hide();
		$(".session-dom").hide();
		sessionToCurrent();
	});
	// 调出 Session-working
	$(document).on("click",".session-option-ctrl",function() {
			//set_backer_session 
			var myId = $(this).attr("id");
			$("#working-marking").attr("data-currentSessionIS","yes");
			$("#working-marking").attr("data-currentSession",myId);
			
			var update = $(this).attr("data-update");
			var workingId = $(this).attr("data-workingId");
			var ctrl = $(this).attr("data-ctrl");
			var sort = $(this).attr("data-sort");
			var belong = $(this).attr("data-belong");
			var item = $(this).attr("data-item");
			var userItemId = $(this).attr("data-userItemId");
			var title = $(this).find(".session-title").html();
			var theme = $(this).find(".session-theme").html();
			
			var parm = new Array();
			parm["ctrl"] = $(this).attr("data-ctrl");
			parm["workingId"] = $(this).attr("data-workingId");
			parm["sort"] = $(this).attr("data-sort");
			parm["belong"] = $(this).attr("data-belong");
			parm["item"] = $(this).attr("data-item");
			parm["userItemId"] = $(this).attr("data-userItemId");
			parm["title"] = $(this).find(".session-title").html();
			parm["theme"] = $(this).find(".session-theme").html();
			openWorking(parm);
			
			$(".session-option-ctrl").removeClass("session-piece-selected");
			$(this).addClass("session-piece-selected");
			//window.scrollTo(0,document.body.scrollHeight);
			
			$(this).find("._alert").html("");
			$(this).find("._alert").hide();
			
			//$(".currentIS").find(".working-input").focus();
	});/**/
	// 删除 当前工作项目
	$(document).on("click",".session-option-close",function() {
		var sessionP = $(this).parent().parent();
		var sort = sessionP.attr("data-sort");
		var belong = sessionP.attr("data-belong");
		var item = sessionP.attr("data-item");
		var userItemId = sessionP.attr("data-userItemId");
		LA_setSessionDelete(sort,belong,item,userItemId);
		sessionP.slideUp("500");
		sessionP.remove();
	});
	
	
	//显示 || 隐藏 内容	
	$(document).on("click",".session_content_show",function() {
			var workingP = $(this).parent().parent().parent().parent();
			if($(this).attr("data-status") == "hide") {
				$(this).attr("data-status","show");
				$(this).html("收起内容");
				//workingP.find(".session_work").slideUp();
				workingP.find(".working-content").slideDown();
				//workingP.find(".working-content").mCustomScrollbar();
				workingP.find(".working-content").mCustomScrollbar({autoHideScrollbar:true,theme:"dark-thin"});
				workingP.find(".working-content").mCustomScrollbar("scrollTo","top");
			} else {
				$(this).attr("data-status","hide");
				$(this).html("展开内容");
				workingP.find(".working-content").slideUp();
			}
	});
	
	// PC端 发送 交流 pointer.Func
	$(document).on("click",".session-adder",function() {
   		var sessionP = $(this).parent().parent();
		sessionP.find(".working-adder").click();
	});
	
	// 发送 初始化	
	$(document).on("click",".working-reset",function() {
			var sessionP = $(this).parent().parent();
			sessionP.find("textarea").attr("placeholder","");
			sessionP.find("textarea").attr("data-reply","");
			sessionP.find("textarea").val("");
			sessionP.find("textarea").focus();
			sessionP.find(".session_input_confirm").attr("data-reply","");
			sessionP.find(".session_input_confirm").attr("data-object","0");
			sessionP.find(".session_input_confirm").attr("data-point","");
	});
	
	
	// 发送 交流 atom.Func
	$(document).on("click",".working-adder",function() {
			
			var currentP = $(this).parent();
			
			var para = new Array();
			para["display"] = "session";
			para["whos"] = currentP.attr("data-belong");
			para["belong"] = currentP.attr("data-belong");
			para["item"] = currentP.attr("data-item");
			para["userItemId"] = currentP.attr("data-userItemId");
			para["objectId"] = $(this).attr("data-object");
			//para["point"] = $(this).attr("data-point");
			para["content"] = $.trim(currentP.find("textarea").val());
			para["share"] = 100;
			
			var operate = currentP.attr("data-session");
			
			var reply = $(this).attr("data-reply");
			if(operate == "chat") {
					para["operate"] = "addChat";
					para["share"] = 11;
			} else {
				if(reply == "reply") {
					para["operate"] = "addReply";
					para["share"] = 11;
				} else {
					para["operate"] = "addComment";
					para["share"] = 41;
				}
			}
			
			if(para["content"] != "") {
				
				var result = LA_addCommunication(para);
				currentP.find("textarea").val("")
				currentP.find("textarea").attr("placeholder","");
				currentP.find(".working-input").focus();
			} else {
				prompting(currentP.find("textarea"),"#fcc");
			}
			currentP.attr("data-position","bottom");
			getCurrentCommunication();
	});
	$(".working-input").bind( "keypress",function(event) {
			event = event || window.event;
			if(event.keyCode == 13) {
   				if($("#session_key").attr("value") != "17") {
   					if($(this).attr("value") != "") {
   						var sessionP = $(this).parent().parent().parent();
						sessionP.find(".working-adder").click();
					}
					event.returnValue = false;
					return false;
				}
			}
	});
	$(".working-input").bind( "keyup",function(event) {
			event = event || window.event;
			if(event.keyCode == 13 && event.ctrlKey) {
   				if($("#session_key").attr("value") == "17") {
					$(this).insertContent("\n");
				}
			}
	});
	$(".working-input").focus( function() {
			//$(this).css("top",0);
			window.scrollTo(0,document.body.scrollHeight);
	});
	
	//session 回复
	$(document).on("click",".reply_who",function() {
			var name = $(this).attr("data-name");
			var source = $(this).attr("data-source");
			var point = $(this).attr("data-point");
			sessionP = $(this).parent().parent().parent().parent().parent().parent().parent();
			sessionP.find("textarea").attr("placeholder","回复 " + name);
			sessionP.find("textarea").attr("data-reply",source);
			sessionP.find("textarea").focus();
			sessionP.find(".session_input_confirm").attr("data-reply","reply");
			sessionP.find(".session_input_confirm").attr("data-object",source);
			sessionP.find(".session_input_confirm").attr("data-point",point);
	});
		
	// 聊天
	//$(".chat_with_u").click( function() {
	//});
	
	// show card
	$(document).on("click",".people-option-ctrl",function() {
		
			var clientWidth = getClientWidth();//alert(clientWidth);
			//var screenWidth = getScreenWidth();//alert(screenWidth);
			if(clientWidth > 1280) {
				var cardObject = $("#session-card");
			} else {
				var cardObject = $("#mobile-card");
				$("#mobile-back-connection").show();
			}
			
			var id = $(this).attr("data-id");
			var ctrl = $(this).attr("data-ctrl");
			var sort = $(this).attr("data-sort");
			var session_type = $(this).attr("data-session_type");
			var belong = $(this).attr("data-belong");
			var item = $(this).attr("data-item");
			var userItemId = $(this).attr("data-userItemId");
			var relation = $(this).attr("data-relation");
			var portrait = $(this).find("img").attr("src");
			var name = $(this).attr("data-name");
			var autograph = $(this).attr("data-autograph");
			var display = $(this).attr("data-display");
			$(".currentIS").removeClass("currentIS");
			$(".mobile-page").hide();
			$(".session_work_ctn").hide();
			$(".session-card-relation-tools").hide();
			cardObject.show();
			
			$("#card-marking").attr("data-id",id);
			$("#card-marking").attr("data-ctrl",ctrl);
			$("#card-marking").attr("data-sort",sort);
			$("#card-marking").attr("data-belong",belong);
			$("#card-marking").attr("data-item",item);
			$("#card-marking").attr("data-userItemId",userItemId);
			$("#card-marking").attr("data-name",name);
			var workingId = "chat-"+belong;
			$("#card-marking").attr("data-workingId",workingId);
			
			cardObject.find(".card-portrait").attr("src",portrait);
			cardObject.find(".card-id").html("ID "+id);
			cardObject.find(".card-name").html(name);
			cardObject.find(".card-autograph").html(autograph);
			if(relation == 11) {
				cardObject.find(".card_confirm").attr("data-operate","delete_friend");
				cardObject.find(".card-relation").html("删除好友");
			} else if(relation == 21) {
				cardObject.find(".card_confirm").attr("data-operate","attention_cansel");
				cardObject.find(".card-relation").html("取消关注");
			} else if(relation == 41) {
				cardObject.find(".card_confirm").attr("data-operate","remove_fans");
				cardObject.find(".card-relation").html("移除粉丝");
			}
			
	});
	
	// PC端 私信Ta
	$(document).on("click",".card-to-message",function() {
			showPcAdder() 
			$("#show_add_pm").click();
			$(".session-hider").click();
			
			var id = $("#card-marking").attr("data-id");
			var name = $("#card-marking").attr("data-name");
			var check_result = check_pm_exists(id);
			if(check_result == 0) {
				var pm_object = $(".hidden_tool .pm_object").clone(true);
				pm_object.attr("data-id",id);
				pm_object.find(".object_name").html(name);
				$(".pm_receiver").append(pm_object);
				//$(".pm_receiver")[0].scrollTop = $(".pm_receiver_c")[0].scrollHeight;
			}
	});
	// Mobile 移动端 私信
	$(document).on("click",".mobile-card-to-message",function() {
			//$("#mobile-ctrl-adder").click();
			$("#mobile-adder-pm").click();
			var id = $("#card-marking").attr("data-belong");
			var name = $("#card-marking").attr("data-name");
			var check_result = check_pm_exists(id);
			if(check_result == 0) {
				var pm_object = $(".hidden_tool .pm_object").clone(true);
				pm_object.attr("data-id",id);
				pm_object.find(".object_name").html(name);
				//$("#mobile-adder-receiver").append(pm_object);
				$("#mobile-adder-receiver").html(pm_object);
				//$(".pm_receiver")[0].scrollTop = $(".pm_receiver_c")[0].scrollHeight;
			}
	});
	// 聊天
	$(document).on("click",".card-to-chat",function() {
			var parm = new Array();
			parm["ctrl"] = $("#card-marking").attr("data-ctrl");
			parm["workingId"] = $("#card-marking").attr("data-workingId");
			parm["sort"] = 2;
			parm["belong"] = $("#card-marking").attr("data-belong");
			parm["item"] = $("#card-marking").attr("data-item");
			parm["userItemId"] = $("#card-marking").attr("data-userItemId");
			parm["title"] = $("#card-marking").attr("data-name");
			parm["theme"] = "";
			openWorking(parm);
	});
	// show 确认
	$(document).on("click",".card_relation_btn",function() {
			$(".card-relation-tools").show();
	});
	// 取消
	$(document).on("click",".card_cansel",function() {
			$(".card-relation-tools").hide();
	});
	// 确认
	$(document).on("click",".card_confirm",function() {
			var operate = $(this).attr("data-operate");
			var id = $("#card-marking").attr("data-id");
			var ps = "";
			var result = ajax_request_connection("user",operate,id,ps);
			$(".card-relation-tools").hide();
			
			if(operate == "request_friend") {
				$(this).attr("data-operate","");
				$(".session_card_relation").html("已发送请求");
				$("#session_linkman").attr("data-update","y");
				$("#session_linkman").click();
			} else if(operate == "delete_friend") {
				$(this).attr("data-operate","");
				$(".session_card_relation").html("已解除关系");
				$("#session_linkman").attr("data-update","y");
				$("#session_linkman").click();
			} else if(operate == "attention_it") {
				$(this).attr("data-operate","attention_cansel");
				$(".session_card_relation").html("取消关注");
				$("#session_channel").attr("data-update","y");
				$("#session_channel").click();
			} else if(operate == "attention_cansel") {
				$(this).attr("data-operate","attention_it");
				$(".session_card_relation").html("关注");
				$("#session_channel").attr("data-update","y");
				$("#session_channel").click();
			} else if(operate == "remove_fans") {
				$(this).attr("data-operate","");
				$(".session_card_relation").html("已经移除");
				$("#session_fans").attr("data-update","y");
				$("#session_fans").click();
			}
	});

	
	// 私信
	$(document).on("click",".message_to_u",function() {
/*
			var input_type = $("#input_confirm").attr("value");
			if(input_type == 0) {
				$("#pm_common").click();
			} else if(input_type == 1) {
				$("#input_pm_to-do").click();
			} else if(input_type == 2) {
				$("#input_pm_timer").click();
			} else if(input_type == 3) {
				$("#input_pm_note").click();
			}
*/
			$("#show_add_pm").click();
			$("#input_pm_to-do").click();
			var check_result = check_pm_exists($(this).attr("data-id"));
			if(check_result == 0)
			{
				var pm_object = $(".hidden_tool .pm_object").clone(true);
				var the_id = $(this).attr("data-id");
				var the_name = $(this).attr("data-name");
				pm_object.attr("data-id",the_id);
				pm_object.find(".object_name").html(the_name);
				$(".pm_receiver").append(pm_object);
				//$(".pm_receiver")[0].scrollTop = $(".pm_receiver_c")[0].scrollHeight;
			}
			//load_adder();
	});
	
	//$(".view_infos").unbind("click");
	$(document).on("click",".view_infos",function() {
		var id = $(this).attr("data-id");
		var isPermission = ajax_permission(id);
		var myPermission;
		if(isPermission == "no") {
			myPermission = 98;
		} else if(isPermission == "MINE") {
			myPermission = 0;
		} else if(isPermission == "Friend") {
			myPermission = 10;
		} else {
			myPermission = 98;
		}
		
		var ctn = $(this).attr("data-ctn");
		var info_container = ctn + " .info_ctn";
		var info_result = ajax_get_TheUser(id);
		library_shower("init",info_result,info_container);
		
		var type = $(this).attr("data-type");
		var geter = $(this).attr("data-geter");
		var operate = $(this).attr("data-operate");
		var position = $(this).attr("data-position");
		library_get_display(id,type,geter,operate,position,ctn,myPermission);
		
		var ctn = $(this).attr("data-ctn");
		load_search_user();
		load_function();
	});
}

function check_pm_exists(check_id) // 私信操作 判断收件人是否存在
{
	var success = 0;
	$(".pm_receiver .pm_object").each( function() {
			if($(this).attr("data-id") == check_id) {
				success = 1;
				return $(this);
			}
	});
	return success;
}



function openWorking(parm) // 打开 working 实体【】
{
	var workingId =  parm["workingId"];
	var exist = "#"+workingId;
	var sort = parm["sort"];
	var belong = parm["belong"];
	var userItemId = parm["userItemId"];
	var item = parm["item"];
	var title = parm["title"];
	var theme = parm["theme"];
	
	$(".currentIS").removeClass("currentIS");
	$(".working-page").hide();
	//$(".display-hide").hide();
	if(sort == 1 || sort == 2) {
		if($(exist).size() == 0) {
			createWorking(parm);
			LA_setSessionZero(sort,belong,item,userItemId);
		} else {
			//$(exist).slideDown();
			$(exist).show();
			$(exist).find(".working-input").focus();
			$(exist).addClass("currentIS");
		}
		$("#working-marking").attr("data-currentid",workingId);
		$("#working-marking").attr("data-currentIS","yes");
	} else if(sort == 9) {
		$("#get-PMIn").click();
		$(".display-hide").hide();
		$("#inbox_ctn").show();
		$("#mobile-back-session").show();
		//$("#header-ctrl-mine").show();
		  
	} else if(sort == 10) {
		$("#get-News").click();
	}
	
	var clientWidth = getClientWidth();//alert(clientWidth);
	var screenWidth = getScreenWidth();//alert(screenWidth);
	if(clientWidth > 1024) {
			$(".currentIS").find(".working-communication").mCustomScrollbar("scrollTo","bottom");
	} else {
		$(".header-body").html(title);
		$("#header-title").show();
		//$("#header-backer").show();
	}
}

function createWorking(parm) // 创建 working 实体
{
	var workingId =  parm["workingId"];
	var sort = parm["sort"];
	var belong = parm["belong"];
	var item = parm["item"];
	var userItemId = parm["userItemId"];
	
	var clientWidth = getClientWidth();//alert(clientWidth);
	var screenWidth = getScreenWidth();//alert(screenWidth);
	if(clientWidth > 1280) {
		var theData = LA_getSessionWork(sort,belong,item,userItemId);
		var session_clone = $(".session-working-clone").clone(true);
		session_clone.prepend(theData.html);
		var theSession = session_clone.find(".session-working");
		$(".session-working-clone").before(theSession);
		
	} else {
		var theSession = $(".mobile-working-clone").clone(true);
		theSession.removeClass("mobile-working-clone");
		$(".mobile-working-clone").before(theSession);
	}
	
	theSession.attr("id",workingId);
	theSession.attr("data-sort",sort);
	theSession.attr("data-belong",belong);
	theSession.attr("data-item",item);
	if(sort == "1") {
		theSession.attr("data-session","item");
	} else if(sort == "2") {
		theSession.attr("data-session","chat");
	}
	theSession.addClass("currentIS");
	
	if(sort == 1) {
		var commuResult = LA_getCommunication("communication","all","all","init",belong,item,userItemId,0,0,0);
	} else if(sort == 2) {
		var commuResult = LA_getCommunication("communication","chat","all","init",belong,item,userItemId,0,0,0);
	}
	
	theSession.find(".working-communication").html(commuResult.html);
		
		theSession.attr("data-minId",commuResult.minId);
		theSession.attr("data-maxId",commuResult.maxId);
		theSession.attr("data-last",commuResult.maxId);
		
	if(clientWidth > 1024) {
		theSession.find(".working-communication").mCustomScrollbar({autoHideScrollbar:true,theme:"dark-thin"});// {autoHideScrollbar:true,theme:"rounded-dots-dark"}
		theSession.find(".working-communication").mCustomScrollbar("scrollTo","bottom");
	} else {
		var session_clone = $("#mobile-working-clone").clone(true);
	}
	
	theSession.show();
	//theSession.find(".working-input").focus();
}






function refresh() // 刷新 session
{
	var sessionNum = $("#page-Marking").attr("data-sessionNum");
	var refreshRe = LA_refresh(sessionNum);
	var result = refreshRe.refresh;
	//layer.msg(result+"-"+refreshRe.sessionNum);
	
	$("#page-Marking").attr("data-sessionNum",refreshRe.sessionNum);
	if(refreshRe.alert == "alert") 
	{
		alartSound();
		$(".session-dom").show();
		getCurrentCommunication();
		$("#page-Marking").attr("data-sessionRefreshNum",0);
	}
	
	if(refreshRe.refresh == "refresh") 
	{
		refreshSessionList();
		$("#page-Marking").attr("data-sessionRefreshNum",0);
	}
	
}
function refreshSessionList() // 显示 session list
{
		var clientWidth = getClientWidth();//alert(clientWidth);
		var screenWidth = getScreenWidth();//alert(screenWidth);
		if(clientWidth > 1280) {
			var getType = "pc";
		} else {
			var getType = "mobile";
		}
		
		var result = LA_getSessionList(getType);
		var sessionHtml = result.html;
		// newsNum = result.newsUnread;
		//var pmNum = result.PMUnread;
		
		//showDom(newsNum,pmNum);
		
		var clientWidth = getClientWidth(); //alert(clientWidth);
		if(getType == "pc") {
			$("#session-list-session .session-display").mCustomScrollbar("destroy");
			$("#session-list-session .session-display").html(sessionHtml);
			$("#session-list-session .session-display").mCustomScrollbar({autoHideScrollbar:true,theme:"light-thin"});
			$("#session-list-session .session-display").mCustomScrollbar("scrollTo","top");
		} else {
			$("#mobile-session-list").html(sessionHtml);
		}
}
function getCurrentCommunication() // 更新 current communication
{
	//var current = $(".currentIS");
	var currentId = $(".currentIS").attr("id");
	var currentSelector = "#" + currentId;
	var current = $(currentSelector);
	if(current.size() != 0) 
	{
		var session = current.attr("data-session");
		var operate = current.attr("data-operate");
		var sort = current.attr("data-sort");
		var belong = current.attr("data-belong");
		var userItemId = current.attr("data-userItemId");
		var item = current.attr("data-item");
		var location = current.attr("data-last");
		var maxId = current.attr("data-maxId");
		var maxUserId = current.attr("data-maxUserId");
		LA_setSessionZero(sort,belong,item,userItemId);
		
		if(sort == 1) {
			var commuResult = LA_getCommunication("communication","all","all","new",belong,item,userItemId,0,location,0);
		} else if(sort == 2) {
			var commuResult = LA_getCommunication("communication","chat","all","new",belong,item,userItemId,0,location,0);
		}
		
		var clientWidth = getClientWidth();//alert(clientWidth);
		var screenWidth = getScreenWidth();//alert(screenWidth);
		if(clientWidth > 1024) {
			current.find(".working-communication .mCSB_container").append(commuResult.html);
			if(current.attr("data-position") == "bottom") {
				current.find(".working-communication").mCustomScrollbar("scrollTo","bottom");
			} 
		} else {
			current.find(".working-communication").append(commuResult.html);
			window.scrollTo(0,document.body.scrollHeight);
		}
		current.attr("data-position","");
		
		//var markup = current.find(".working-communication .communication_ctn:last").attr("data-id");
		//current.attr("data-last",markup);
		
		//current.attr("data-minId",commuResult.minId);
		current.attr("data-maxId",commuResult.maxId);
		current.attr("data-last",commuResult.maxId);
	}
}
function sessionToCurrent() // 
{
	if($("#working-marking").attr("data-currentSessionIS") == "yes") 
	{
		var surrentSession = "#" + $("#working-marking").attr("data-currentSession");
		$(surrentSession).click();
	} else {
		$(".session-option-ctrl:first").click();
	}
}


function LA_refresh(pageSession) // Laravel 获取会话列表 session list
{
	var result;
	jQuery.ajax
	({
		url:"/service/refreshing",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			pageSession:pageSession//,
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
function LA_getSessionList(getType) // Laravel get session list 获取会话列表
{
	var result;
	jQuery.ajax
	({
		url:"/service/getSessionList",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			getType:getType//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//layer.msg(result.html);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function LA_getSessionWork(sort,belong,item,userItemId) // Laravel 
{
	var result;
	jQuery.ajax
	({
		url:"/service/getSessionWork",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			sort:sort,
			belong:belong,
			item:item,
			userItemId:userItemId,//,
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
function LA_setSessionZero(sort,belong,item,userItemId) // Laravel 
{
	var result;
	jQuery.ajax
	({
		url:"/service/setSessionZero",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			sort:sort,
			belong:belong,
			item:item,
			userItemId:userItemId,//,
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
function LA_setSessionDelete(sort,belong,item,userItemId) // Laravel 
{
	var result;
	jQuery.ajax
	({
		url:"/service/setSessionDelete",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			sort:sort,
			belong:belong,
			item:item,
			userItemId:userItemId,//,
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

function showSessionDom() 
{
}

function showDom(newsNum,pmNum) 
{
	
		$(".news_num").html(newsNum);
		if(newsNum == 0) {
			$(".news_num").hide();
			$(".news_dom").hide();
		} else {
			$(".news_num").show();
			$(".news_dom").show();
			$("#get-News").attr("data-update","y");
		}
		
		$(".pm_num").html(pmNum);
		if(pmNum == 0) {
			$(".pm_num").hide();
			$(".pm_dom").hide();
		} else {
			$(".pm_num").show();
			$(".pm_dom").show();
			$("#get-PMIn").attr("data-update","y");
		}
}