jQuery( function($) {

    $(document).on('click','.depart_modify_status',function(){
        var $this = $(this);
        var trial_id = $this.attr("data-trial");
        var location_id = $this.attr("data-id");
        var _token = $("input[name=_token]").val();
        var htmlx = '<div><input type="radio" name="trial-status" value="0" checked="checked" data-text="招募中"> 招募中</div>'
            +'<div><input type="radio" name="trial-status" value="1" data-text="招募完成"> 招募完成</div>'
            +'<div><input type="radio" name="trial-status" value="2" data-text="招募未开始"> 招募未开始</div>';

        layer.confirm('选择状态'+htmlx,{
            btn: ["确定","取消"]
        },function(){
            var location_status = $("input[name=trial-status]:checked").val();
            var status_text = $("input[name=trial-status]:checked").attr("data-text");
            $.post(
                '/admintriallocation/modifystatus',
                { trial_id: trial_id, location_id: location_id, location_status: location_status, _token:_token },
                function(data) {
                    if(data.result){
                        layer.msg(data.msg);
                        $this.parent().parent().find(".status-text").html(status_text);
                    } else{
                        layer.msg(data.msg);
                    }
                }, 'json');
        });
    });

    // 选定item项
    $(document).on("click",".operating",function() {
        $(".entity_operating").removeClass("entity_operating");
        $(this).parents(".item-container").addClass("entity_operating");
    });

    // 确认对话框 确认
    $(document).on("click",".confirm_is",function() {
        var itemObject = $(".entity_operating");
        var father = $(".entity_operating").parent().parent();
        var operate_type = $(this).attr("value");

        var item_identity = itemObject.attr("data-identity");
        var id = itemObject.attr("data-id");
        var sort = itemObject.attr("data-sort");
        var type = itemObject.attr("data-type");
        var form = itemObject.attr("data-form");
        var belong = itemObject.attr("data-belong");
        var item = itemObject.attr("data-item");
        var source = itemObject.attr("data-source");
        var entity = itemObject.attr("data-entity");
        var location = itemObject.attr("data-location");

        var MINE = itemObject.attr("data-mine");

        var originUserItemId = itemObject.attr("data-originUserItemId");
        var originBelong = itemObject.attr("data-originBelong");
        var quoteUserItemId = itemObject.attr("data-quoteUserItemId");
        var quoteBelong = itemObject.attr("data-quoteBelong");


        var start = itemObject.attr("data-start");
        var ended = itemObject.attr("data-ended");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");


        if(operate_type == "add_friend") // 添加好友
        {
            ajax_handle_request("request",operate_type,source,item,userItemId);
            $(".entity_operating").find(".news_request").addClass("_none");
            $(".entity_operating").find(".item_status").html("已经为好友");
            set_update("linkman","y");
        } else if(operate_type == "refuse_friend") // 拒绝
        {
            ajax_handle_request("request",operate_type,source,item,userItemId);
            $(".entity_operating").find(".news_request").addClass("_none");
            $(".entity_operating").find(".item_status").html("已经拒绝");
        } else if(operate_type == "quote_collect") // origin 收藏
        {
            if(operateResult.itemRelation == "MINE") {
                myAlertOnTop("不能收藏自己，重新刷新页面试试！",2500,"#eb7350");
            } else  {
                var theITEM = LA_collect("collect","origin",originUserItemId,originBelong,originItem,"",11);
            }
        } else if(operate_type == "quote_collect_cansel")
        {
            var theITEM = LA_collect("collect_cansel","origin",originUserItemId,originBelong,originItem,"",11);

        } else if(operate_type == "quote_workIt") // origin + 待办
        {
            var theITEM = LA_workIt("workIt","origin",originUserItemId,originBelong,originItem,"",11);
        } else if(operate_type == "quote_workIt_cansel")
        {
            var theITEM = LA_workIt("workIt_cansel","origin",originUserItemId,originBelong,originItem,"",11);
        } else if(operate_type == "quote_focus") // origin + 日程
        {
            if(operateResult.itemRelation == "MINE") {
                myAlertOnTop("不能关注自己，重新刷新页面试试！",2500,"#eb7350");
            } else  {
                var theITEM = LA_focusIt("focusIt","origin",originUserItemId,originBelong,originItem,"",11);
            }
        } else if(operate_type == "quote_focus_cansel")
        {
            var theITEM = LA_focusIt("focusIt_cansel","origin",originUserItemId,originBelong,originItem,"",11);
        } else
        {
            layer.msg("误操作");
        }

        itemChange(item_identity,theITEM.html);
        $(".confirm_not").click();

    });

    // 确认对话框 取消
    $(document).on("click",".confirm_not",function() {
        $(".entity_operating").removeClass("entity_operating");
        operate_confirm_hide();
    });

    $(document).on("click",".itemDown",function(event) {
        //var itemOBJ = $(this).parentsUntil($(".entity-ctn"), ".item-container");
        var itemOBJ = $(this).parents(".item-container");
        itemOBJ.find(".itemFlowTool").toggle();
        event.stopPropagation();
    });


    // 弹出 确认窗口
    $(document).on("click",".showConfirmor",function() {

        var X = $(this).offset().top;
        var Y = $(this).offset().left;
        operate_confirm_show(X,Y);

        var operate_type = $(this).attr("data-type");
        var operate_tip = $(this).attr("data-tip");
        operate_confirm_set(operate_type,operate_tip);

    });

    $(document).on("click",".btn_module_cansel",function() {
        var itemObject = $(this).parent().parent().parent().parent();
        itemObject.find(".item-module").hide();
        itemObject.find(".btn_show").attr("data-static","hide");
    });
    // 显示 指定ITEM工具
    $(document).on("click",".btn_show",function() {

        var item_object = $(this).parents(".item-container");
        $(".entity_operating").removeClass("entity_operating");
        item_object.addClass("entity_operating");
        var show = ".entity_operating " + $(this).attr("data-show");

        var whos = $(".entity_operating").attr("data-belong");
        var item = $(".entity_operating").attr("data-item");
        var userItemId = $(".entity_operating").attr("data-userItemId");
        var sort = $(this).attr("data-sort");
        var type = $(this).attr("data-type");
        var getSort = "all";

        var myPermission = 0;

        if($(this).attr("data-static") == "show") {
            $(this).attr("data-static","hide");
            $(show).hide();
            item_object.find(".item-module").hide();
        } else {
            $(".entity_operating").find(".btn_show").attr("data-static","hide");
            $(this).attr("data-static","show");
            $(".entity_operating").find(".item-module").hide();
            $(show).show();
            $(".entity_operating").find(".module_display").show();
            $(show).find(".defaultClicker").click();
            //
            $(show).find(".text_focus").focus();

            if(type == "show_write") {
                var writes = ajax_getWrites(whos,item);
                $(".entity_operating").find(".module_display").html(writes);
            }
            else if(type == "show_comment") {
                //item_object.find(".comment_get[data-sort="+ sort +"]").click();
            }
            else if(type == "show_complete") {
                item_object.find(".btn_complete_inform").hide();
            }
            else if(type == "show_pm_complete") {
                item_object.find(".btn_complete_inform").show();
            }
            else if(type == "share") {
                var status = $(this).attr("data-status");
                item_object.find(".share_share .radior[data-selected="+ status +"]").click();


                //var comments = LA_getCommunication("comment","all","common","init",whos,item,userItemId,19,0,myPermission);
                //$(".entity_operating").find(".module_display").html(comments.html);
            }
        }
    });
    // 获取 评论
    $(document).on("click",".comment_get",function() {

        var item_object = $(this).parents(".item-container");

        var item_id = item_object.attr("data-id");
        var belong_id = item_object.attr("data-belong");
        var permission = $(this).attr("data-selected");

        var myPermission = 0;
        item_object.find(".module_display").show();

        var geters=new Object();
        geters.item_id = item_id;
        geters.geter_sort = $(this).attr("data-geter-sort");
        geters.get_display = "comment";
        geters.get_type = "init";
        geters.get_sort = $(this).attr("data-sort");
        geters.get_first = $(this).attr("data-position-first");
        geters.get_last = $(this).attr("data-position-last");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_get_communication(pageVisitor,item_id,geters);
        if(result.status) item_object.find(".module_display").html(result.html);
        else _myAlert(result.msg,2750,"fail");
    });
    // 记笔记
    $(document).on("click",".btn_write_confirm",function() {

        var sort = 3;
        var type = 3;
        var form = 0;
        var share = 0;
        var theme = $(".entity_operating").find(".note_theme").val();
        var content = $(".entity_operating").find(".note_content").val();
        var tag = $.trim($(".entity_operating").find(".note_tag").val());
        var quoteBelong = $(".entity_operating").attr("data-belong");
        var quoteItem = $(".entity_operating").attr("data-item");

        var the_result =  ajax_add_note("add","note",0,sort,type,form,theme,content,tag,share,quoteBelong,quoteItem);
        $(".entity_operating").find(".module_write_show").prepend(the_result);

        $(".entity_operating").find(".note_theme").val("");
        $(".entity_operating").find(".note_content").val("");
        $(".entity_operating").find(".note_tag").val("");

        $("#menu_notebook_mine").attr("data-update","y");
    });

    $(document).on("click",".item-delete",function() {

        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-type");
        var item_id = itemObject.attr("data-id");
        var whos= itemObject.attr("data-belong");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        layer.confirm(
            "你确定删除吗？",
            {
                btn: ["确定","取消"]
            },
            function()
            {
                var result = LA_item_delete(pageVisitor,item_id);
                if(result.status) $(".entity_operating").slideUp();
                else _myAlert(result.msg,2750,"fail");
                layer.closeAll('dialog');
            }
        );


    });


    // 点赞
    $(document).on("click",".itemFover",function() {

        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-type");
        var item_id = itemObject.attr("data-id");
        var whos= itemObject.attr("data-belong");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_favor(pageVisitor,item_id,operate);
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");

    });
    // 分享
    $(document).on("click",".btn_share",function() {

        var itemObject = $(this).parents(".item-container");

        var operate = "";
        var item_identity = itemObject.attr("data-identity");
        var whos= itemObject.attr("data-belong");
        var id = itemObject.attr("data-id");
        var share = itemObject.find(".share_share").attr("data-selected");
        var status = itemObject.find(".share_share").attr("data-status");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        if(share != status) {
            var result = LA_item_share(pageVisitor,id,share);
            if(result.status) itemChange(item_identity,result.html);
            else _myAlert(result.msg,2750,"fail");
        } else {
            layerAlertNoChange();
        }

    });
    // 打分
    $(document).on("click",".btn_score_confirm",function() {

        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var belong = itemObject.attr("data-belong");
        var item_id = itemObject.attr("data-id");
        var content = itemObject.find(".score_text").val();
        var score = itemObject.find(".score_score").attr("data-selected");
        var status = itemObject.find(".score_score").attr("data-status");
        var content = itemObject.find(".score_text").val();

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        if(score != 0)
        {
            if(score != status)
            {
                var result = LA_item_score(pageVisitor,item_id,score,content);
                if(result.status) itemChange(item_identity,result.html);
                else _myAlert(result.msg,2750,"fail");
            }
            else _myAlert("分数没有变化",2750,"warn");
        }
        else _myAlert("请先选择分数",2750,"warn");

    });
    // 收藏
    $(document).on("click",".btn_collect_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-operate");
        var belong = itemObject.attr("data-belong");
        var item_id = itemObject.attr("data-id");
        var content = itemObject.find(".collect_text").val();
        var share = itemObject.find(".collect_share").attr("data-selected");


        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_collect(pageVisitor,item_id,operate,content,share,"item");
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");
    });
    // 移除 收藏
    $(document).on("click",".btn_collectC_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-operate");
        var item_id = itemObject.attr("data-id");
        var content = itemObject.find(".collectC_text").val();
        var share = itemObject.find(".collectC_share").attr("data-selected");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_collect(pageVisitor,item_id,operate,content,share,"item");
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");
    });
    // 待办 & 取消待办
    $(document).on("click",".btn_workIt_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-operate");
        var item_id = itemObject.attr("data-id");
        var sort = itemObject.attr("data-sort");
        var content = itemObject.find(".workIt_text").val();
        var share = itemObject.find(".workIt_share").attr("data-selected");
        if(sort == 19) share = 19;

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_workIt(pageVisitor,item_id,operate,content,share,"item");
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");
    });
    // 移除 待办
    $(document).on("click",".btn_workItC_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-operate");
        var item_id = itemObject.attr("data-id");
        var content = itemObject.find(".workItC_text").val();
        var share = itemObject.find(".workItC_share").attr("data-selected");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_workIt(pageVisitor,item_id,operate,content,share,"item");
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");
    });
    // 关注
    $(document).on("click",".btn_focus_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var father = itemObject.parent().parent();
        $(".entity_operating").removeClass("entity_operating");
        itemObject.addClass("entity_operating");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-operate");
        var item_id = itemObject.attr("data-id");
        var sort = itemObject.attr("data-sort");
        var content = itemObject.find(".focus_text").val();
        var share = itemObject.find(".focus_share").attr("data-selected");
        if(sort == 19) share = 9;

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_agendaIt(pageVisitor,item_id,operate,content,share,"item");
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");
    });
    // 取消 关注
    $(document).on("click",".btn_focusC_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var item_identity = itemObject.attr("data-identity");

        var operate = $(this).attr("data-operate");
        var item_id = itemObject.attr("data-id");
        var content = itemObject.find(".focusC_text").val();
        var share = itemObject.find(".focusC_share").attr("data-selected");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var result = LA_item_agendaIt(pageVisitor,item_id,operate,content,share,"item");
        if(result.status) itemChange(item_identity,result.html);
        else _myAlert(result.msg,2750,"fail");

    });
    //转发微博
    $(document).on("click",".btn_forward",function() {
        var itemObject = $(this).parents(".item-container");
        var father = itemObject.parent().parent();
        $(".entity_operating").removeClass("entity_operating");
        itemObject.addClass("entity_operating");
        var item_identity = itemObject.attr("data-identity");

        var userItemId = itemObject.attr("data-userItemId");
        var belong = itemObject.attr("data-belong");
        var item = itemObject.attr("data-item");
        var share = itemObject.find(".forward-Share").attr("data-selected");

        var forwardText = itemObject.find(".forward_text");
        var theme = $.trim(forwardText.val());
        if(theme == "") {
            prompting(forwardText,"#fcc");
        } else {

            var pageType = $("#page-Marking").attr("data-type");
            var pageVisitor = $("#page-Marking").attr("data-visitor");
            var pageBelong = $("#page-Marking").attr("data-belong");
            //var relationWho = $("#page-Marking").attr("data-belong");

            var operateResult = handleItemPermission("operCommon",pageType,pageVisitor,pageBelong,belong);
            if(operateResult.confirm == "yes")
            {
                var theITEM = LA_forward(userItemId,belong,item,theme,share);
                myAlertOnTop("发布成功！",2500,"#0db20d"); // 提示发布成功
                forwardText.val("");
                itemObject.find(".btn_forward_cansel").click();
            }
        }

    });
    // 发送 评论
    $(document).on("click",".btn_comment",function() {

        var itemObject = $(this).parents(".item-container");
        var comment_Text = itemObject.find(".comment_text");
        var content = $.trim(comment_Text.val());

        var adder = new Object();
        adder.operate = "comment";
        adder.display = "item";
        adder.item_id = itemObject.attr("data-id");
        adder.item_belong = itemObject.attr("data-belong");
        adder.share = itemObject.find(".comment_share").attr("data-selected");
        adder.content = content

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");
        if(content != "")
        {
            var result = LA_item_add_communication(pageVisitor,adder);
            if(result.success)
            {
                itemObject.find(".module_display").prepend(result.html);
                comment_Text.val("");
                _myAlert(result.msg,2000,"success");
            }
            else _myAlert(result.msg,2000,"fail");
        }
        else prompting(comment_Text,"#fcc");

    });
    // 显示 回复框
    $(document).on("click",".show_reply",function() {
        var commentObject = $(this).parents(".comment-container");
        commentObject.find(".comment_reply").toggle();
        commentObject.find(".comment_reply .reply_text").focus();
        commentObject.find(".defaultClicker").click();
    });
    // 回复 取消
    $(document).on("click",".btn_reply_cansel",function() {
        var commentObject = $(this).parents(".comment-container");
        commentObject.find(".comment_reply").toggle();
    });
    // 回复 发送
    $(document).on("click",".btn_reply",function() {

        var itemObject = $(this).parents(".item-container");
        var commentObject = $(this).parents(".comment-container");
        var reply_Text = commentObject.find(".reply_text");
        var content = $.trim(reply_Text.val());

        var adder = new Object();
        adder.operate = "reply";
        adder.display = "item";
        adder.item_id = itemObject.attr("data-id");
        adder.item_belong = itemObject.attr("data-belong");
        adder.point = commentObject.attr("data-id");
        adder.object = commentObject.attr("data-source");
        adder.share = commentObject.find(".reply_share").attr("data-selected");
        adder.content = content

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        if(content != "")
        {
            var result = LA_item_add_communication(pageVisitor,adder);
            if(result.success)
            {
                itemObject.find(".module_display").prepend(result.html);
                reply_Text.val("");
                _myAlert(result.msg,2000,"success");
            }
            else _myAlert(result.msg,2000,"fail");
        }
        else prompting(reply_Text,"#fcc");

    });


    //显示转发
    $(document).on("click",".show_forward",function() {

        var item_object = $(this).parent().parent().parent().parent();
        var objectId = item_object.attr("data-source");
        var location = item_object.attr("data-item");

        //item_object.find(".btn_forward").attr("data-sort",7);
        item_object.find(".btn_forward").attr("data-type",1);
        item_object.find(".btn_forward").attr("data-object",objectId);
        item_object.find(".btn_forward").attr("data-location",location);

        $(this).attr("value","show");
        item_object.find(".item_forward").show();
        item_object.find(".item_forward .forward_text").focus();
        item_object.find(".btn_ForM").click();
    });



    //显示 || 隐藏 内容
    $(document).on("click",".item_toggle",function() {
        var the_parent = $(this).parent().parent().parent();

        if( $(this).attr("data-status") == "hide") {
            the_parent.find(".item-content").css("max-height","9999px");
            //the_parent.find(".item-content").show();

            $(this).attr("data-status","show");
            $(this).html("收起内容");
            the_parent.find(".content_more").html("收起");
            //layer.msg( parseInt( the_parent.find(".item-content").css("height") ) );
            if( parseInt(the_parent.find(".item-content").css("height")) < 140 ) {
                $(this).hide();
                the_parent.find(".item-content_more").hide();
            }
        } else if( $(this).attr("data-status") == "show") {

            $(this).attr("data-status","hide");
            $(this).html("展开全文");
            the_parent.find(".content_more").html("全文");

            if( parseInt(the_parent.find(".item-content").css("height")) < 140 )
            {
                $(this).hide();
                //the_parent.find(".item-content_more").hide();
            }
            the_parent.find(".item-content").css("max-height","140px");
            //the_parent.find(".item-content").hide();
            the_parent.find(".item_focus").focus();
            the_parent.find(".item_focus").blur();
        }
        //layer.msg(parseInt(the_parent.find(".item-content").css("height")));
        //layer.msg($(this).parent().parent().parent().parent().scrollTop());
        //$(this).parent().parent().parent().parent().scrollTop("100px");

    });

    //显示 || 隐藏 内容
    $(document).on("click",".content_more",function() {
        $(this).parent().parent().find(".item_toggle").click();
    });

    //显示 修改内容
    $(document).on("click",".show_modify",function() {
        var itemObject = $(this).parents(".item-container");
        $(".entity_operating").removeClass("entity_operating");
        itemObject.addClass("entity_operating");

        var userItemId = itemObject.attr("data-useritemid");
        var belong = itemObject.attr("data-belong");
        var id = itemObject.attr("data-item");
        var sort = itemObject.attr("data-sort");
        var theName = itemObject.find(".item-belong .item").html();
        theName = "修改 " + theName;
        //theName = "修改 " + theName + "." + id;

        if(sort == 21)
        {
            var header_text = theName +" (笔记)";
        } else if(sort == 44)
        {
            var header_text = theName +" (提问)";
        }

        $("#input_confirm").attr("data-display","item");
        var input_ctn = $("#input_item_ctn");
        input_empty();
        $("#input_item_ctn").find(".input_header_text").html(header_text);
        $("#input_item_ctn").find(".input_tools").hide();
        $("#input_item_ctn").find(".input_receiver").hide();
        $("#input_item_ctn").find(".input_time").hide();
        $("#input_item_ctn").find(".input_theme").show();
        $("#input_item_ctn").find(".input_tag").show();
        $("#input_item_ctn").find(".input_important").hide();
        $("#input_item_ctn").find(".input_share").hide();
        $("#input_item_ctn").slideDown();
        $("#input_item_ctn").find("#input_confirm").attr("data-sort",sort);
        $("#input_item_ctn").attr("value","modify");

        var result = LA_getModify(userItemId);
        var the_theme = result.theme;
        var the_content = result.content;
        var the_tag = result.tag;

        $("#input_theme").val(the_theme);
        $("#input_content").val(the_content);
        $("#input_tag").val(the_tag);

        $(".input_ctn .input_share").hide();
        $("#input_confirm").html("修改");
        $("#input_confirm").attr("data-operate","modify");
        $("#input_confirm").attr("data-id",id);
        $("#input_confirm").attr("data-userItemId",userItemId);

        $("#adder-mark").attr("data-operate","modify");
        $("#adder-mark").attr("data-id",id);
        $("#adder-mark").attr("data-userItemId",userItemId);

        $(".display-hide").hide();
        $(".pc-adder").show();
    });

    //点击 关键字
    $(document).on("click",".tag_search",function() {
        var the_tag = $(this).attr("data-tag");

        $("#search_tag").val(the_tag);
        $("#search_confirm").click();

    });
    //修改 关键字
    $(document).on("click",".modify_tag",function() {
        var itemObject = $(this).parents(".item-container");
        $(".entity_operating").removeClass("entity_operating");
        itemObject.addClass("entity_operating");

        var id = itemObject.attr("data-id");
        var belong = itemObject.attr("data-belong");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");
        //var relationWho = $("#page-Marking").attr("data-belong");

        var operateResult = handleItemPermission("operMine",pageType,pageVisitor,pageBelong,belong);
        if(operateResult.confirm == "yes")
        {
            var result = LA_getModify(id);
            var the_tag = result.tag;
            itemObject.find(".module_tag").show();
            itemObject.find(".tag_text").val(the_tag);
            itemObject.find(".tag_text").focus();
        }
    });
    $(document).on("click",".modify_tag_confirm",function() {
        var itemObject = $(this).parents(".item-container");
        var tag_object = itemObject.find(".tag_text");
        $(".entity_operating").removeClass("entity_operating");
        itemObject.addClass("entity_operating");

        var item_identity = itemObject.attr("data-identity");
        var id = itemObject.attr("data-id");
        var belong = itemObject.attr("data-belong");
        var tag = $.trim(tag_object.val());

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");
        //var relationWho = $("#page-Marking").attr("data-belong");

        var operateResult = handleItemPermission("operMine",pageType,pageVisitor,pageBelong,belong);
        if(operateResult.confirm == "yes")
        {
            var theITEM = LA_modifyTag(id,tag);
            itemChange(item_identity,theITEM.html);
        }
    });
    $(document).on("click",".modify_tag_cansel",function() {
        var itemObject = $(this).parents(".item-container");
        $(".entity_operating").removeClass("entity_operating");
        itemObject.find(".tag_text").val("");
        itemObject.find(".module_tag").hide();
    });

    // 修改笔记
    $(document).on("click",".btn_note_modify",function() {

        $(".note_operating").removeClass("entity_operating");
        $(this).parent().parent().addClass("note_operating");

        var id = $(this).parent().parent().attr("data-item");
        showTheModify("note",id);
    });


    //显示 未读私信
    $(document).on("click",".show_unread",function() {
        var itemParent = $(this).parent().parent().parent();
        var id = itemParent.attr("data-item");
        var sort = itemParent.attr("data-sort");
        ajax_setRead(sort,id);
        $(this).remove();
        if(sort == 9) {
            setNumDEC(".pm_num");
        }
        itemParent.find("._hide").removeClass("_hide");
    });

    //显示 原图
    $(document).on("click",".showImageOrigin",function() {
        var type = $(this).attr("data-imgType");
        var originurl = $(this).attr("data-originurl");
        window.open(originurl);
    });
    //显示 大图
    $(document).on("click",".attachingShowImageOne",function() {
        var itemObject = $(this).parent().parent().parent().parent();
        itemObject.find(".attaching-Box").hide();
        itemObject.find(".attaching-Display").show();
        itemObject.find(".attaching-Display .attaching-choose-box").hide();
        itemObject.find(".attaching-Display .image-turn-buttom").hide();
        //var theSrc = $(this).find("img").attr("src");
        var type = $(this).attr("data-imgType");
        var originurl = $(this).attr("data-originurl");
        if(type == "qingbo")
        {
            var theSrc = "/images/origin/" + originurl;
            var theOriginSrc = 'http://'+document.domain+':8088/' + theSrc;
        } else if(type == "sinaimg")
        {
            var theSrc = "http://wx1.sinaimg.cn/mw1024/" + originurl;
            var theOriginSrc = "http://wx1.sinaimg.cn/large/" + originurl;
        }else
        {
            var theSrc = originurl;
        }
        itemObject.find(".attaching-media-box img").attr("src",theSrc);
        itemObject.find(".showImageOrigin").attr("data-imgType",type);
        itemObject.find(".showImageOrigin").attr("data-originurl",theOriginSrc);
    });
    //显示 大图
    $(document).on("click",".attachingShowImage",function() {
        var itemObject = $(this).parent().parent().parent().parent();
        itemObject.find(".attaching-Box").hide();
        itemObject.find(".attaching-Display").show();
        //var theSrc = $(this).find("img").attr("src");
        var type = $(this).attr("data-imgType");
        var originurl = $(this).attr("data-originurl");
        if(type == "qingbo")
        {
            var theSrc = "/images/origin/" + originurl;
            var theOriginSrc = 'http://'+document.domain+':8088/' + theSrc;
        } else if(type == "sinaimg")
        {
            var theSrc = "http://wx1.sinaimg.cn/mw690/" + originurl;
            var theOriginSrc = "http://wx1.sinaimg.cn/large/" + originurl;
        }else
        {
            var theSrc = originurl;
            var theOriginSrc = originurl;
        }
        itemObject.find(".attaching-media-box img").attr("src",theSrc);
        itemObject.find(".attachingOption[data-originurl='"+originurl+"']").addClass("attaching_choose_selected");
        itemObject.find(".showImageOrigin").attr("data-imgType",type);
        itemObject.find(".showImageOrigin").attr("data-originurl",theOriginSrc);

    });
    //隐藏 大图
    $(document).on("click",".image_hide",function() {
        var itemObject = $(this).parent().parent().parent().parent();
        itemObject.find(".attaching-Box").show();
        itemObject.find(".attaching-Display").hide();
    });
    //选择 前一张
    $(document).on("click",".turnPrev",function() {
        var itemObject = $(this).parent().parent().parent().parent().parent();
        if(itemObject.find(".attaching_choose_selected").prev().hasClass("attachingOption")) {
            itemObject.find(".attaching_choose_selected").prev().click();
        }
    });
    //选择 后一张
    $(document).on("click",".turnNext",function() {
        var itemObject = $(this).parent().parent().parent().parent().parent();
        if(itemObject.find(".attaching_choose_selected").next().hasClass("attachingOption")) {
            itemObject.find(".attaching_choose_selected").next().click();
        }
    });

    //选择 大图
    $(document).on("click",".attachingOption",function() {
            var itemObject = $(this).parent().parent().parent().parent().parent();
            itemObject.find(".attachingOption").removeClass("attaching_choose_selected");
            $(this).addClass("attaching_choose_selected");
        });


})


/* ajax 操作 */

function LA_getTheItem(userItemId) // Laravel
{
    var result;
    jQuery.ajax
    ({
        url:"/service/getTheItem",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            userItemId:userItemId//,
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
function LA_getModify(userItemId) // Laravel 获得 修改内容
{
    var result;
    jQuery.ajax
    ({
        url:"/service/getTheModify",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            userItemId:userItemId//,
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
function LA_modifyTag(userItemId,tag) // Laravel 修改 item 标签
{
    var result;
    jQuery.ajax
    ({
        url:"/service/modifyTag",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            userItemId:userItemId,
            tag:tag//,
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
function LA_item_delete(page_visitor,item_id) // item 删除
{
    var result;
    jQuery.ajax
    ({
        url:"/item/delete",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id
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

function LA_item_share(page_visitor,item_id,share) // item 分享
{
    jQuery.ajax
    ({
        url:"/item/share",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            share:share
        },
        success:function(data) {
            if(data.status) return data;
            layer.msg(data.msg);
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
}
function LA_item_favor(page_visitor,item_id,operate) // item 打分
{
    var result;
    jQuery.ajax
    ({
        url:"/item/favor",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            operate:operate
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
function LA_item_score(page_visitor,item_id,score,content) // item 打分
{
    var result;
    jQuery.ajax
    ({
        url:"/item/score",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            score:score,
            content:content
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
function LA_itemOperate(operate,display,userItemId,belong,content,share) // Laravel 操作 item : 收藏 | +待办 | +日程 |
{
    var result;
    jQuery.ajax
    ({
        url:"/service/itemCollect",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            operate:operate,
            display:display,
            sort:sort,
            userItemId:userItemId,
            belong:belong,
            item:item,
            content:content,
            share:share//,
            //_token:$('meta[name="_token"]').attr('content')
        },
        success:function(data) {
            //result = $.trim(data);
            result = data;//layer.msg(data.sort);
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}
function LA_item_collect(page_visitor,item_id,operate,content,share,display) // Laravel 收藏 | 取消收藏 item
{
    var result;
    jQuery.ajax
    ({
        url:"/item/collect",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            operate:operate,
            content:content,
            share:share,
            display:display
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
function LA_item_workIt(page_visitor,item_id,operate,content,share,display) // Laravel 待办 | 取消待办 item
{
    var result;
    jQuery.ajax
    ({
        url:"/item/work",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            operate:operate,
            content:content,
            share:share,
            display:display
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
function LA_item_agendaIt(page_visitor,item_id,operate,content,share,display) // Laravel 关注 | 取消关注 item
{
    var result;
    jQuery.ajax
    ({
        url:"/item/agenda",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            operate:operate,
            content:content,
            share:share,
            display:display
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
function LA_forward(userItemId,belong,item,theme,share) // Laravel 转发 item
{
    var result;
    jQuery.ajax
    ({
        url:"/service/itemForward",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            userItemId:userItemId,
            belong:belong,
            item:item,
            theme:theme,
            share:share//,
            //_token:$('meta[name="_token"]').attr('content')
        },
        success:function(data) {
            //result = $.trim(data);
            result = data;//layer.msg(data.html);
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}
function LA_reward(userItemId,belong,tips,content,share) // Laravel item 打赏
{
    var result;
    jQuery.ajax
    ({
        url:"/service/itemReward",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            userItemId:userItemId,
            belong:belong,
            tips:tips,
            content:content,
            share:share//,
            //_token:$('meta[name="_token"]').attr('content')
        },
        success:function(data) {
            //result = $.trim(data);
            result = data;//layer.msg(data.html);
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}


function ajax_setRead(sort,id) // 设置 私信已读
{
    var result;
    jQuery.ajax
    ({
        url:"ajax.item.read.php",
        async:false,
        cache:false,
        type:"post",
        data:
        {
            sort:sort,
            id:id
        },
        success:function(data)
        {
            result = $.trim(data);//layer.msg(result);
        }
    });
    return result;
}


function LA_get_communication(page_visitor,item_id,geters) // Laravel ajax 获取 评论
{
    var result;
    jQuery.ajax
    ({
        url:"/communication/get",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            page_visitor:page_visitor,
            item_id:item_id,
            geters:geters
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



