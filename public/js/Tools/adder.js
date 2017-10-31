jQuery( function($) {


    //
    $(document).on("click",".input-option",function() {
        var title = $(this).attr("data-titler");
        $(".header-body").html(title);
        $(this).addClass("selected_1").siblings(".input-option").removeClass("selected_1");
        load_uploadify();
    });


    $(document).on("click","#inputF-working",function() {

        var Tselected = $(this).attr("data-select");
        if( $(this).attr("data-selected") == "selected" ) {
            $(this).removeClass(Tselected);
            $(this).attr("data-selected","0");
            $(".input_important").hide();

            $("#adder-mark").attr("data-working","0");
        } else {
            $(this).addClass(Tselected);
            $(this).attr("data-selected","selected");
            $(".input_important").show();
            $("#important_general").click();

            $("#adder-mark").attr("data-working","1");
        }
    });
    $(document).on("click","#inputF-timing",function() {

        var Tselected = $(this).attr("data-select");
        if( $(this).attr("data-selected") == "selected" ) {
            $(this).removeClass(Tselected);
            $(this).attr("data-selected","0");
            $(".inputB_time").hide();
            $(".input_time").hide();

            $("#adder-mark").attr("data-time-type","0");
        } else {
            $(this).addClass(Tselected);
            $(this).attr("data-selected","selected");
            $(".inputB_time").show();
            $("#input_agenda_once").click();
        }
    });
    // 一次性 or 周期
    $(document).on("click","#input_agenda_once",function() {
        $("#adder-mark").attr("data-time-type","1");
        $("#input_confirm").attr("data-form","1");
        $(".input_once").show();
        $(".input_cycle").hide();
    });
    $(document).on("click","#input_agenda_cycle",function() {
        $("#adder-mark").attr("data-time-type","2");
        $("#input_confirm").attr("data-form","2");
        $(".input_once").hide();
        $(".input_cycle").show();
    });

    // + 私信
    $(document).on("click","#show_add_pm",function() {

        if($("#input_item_ctn").attr("value") != "pm") {

            $("#adder-mark").attr("data-operate","add");
            $("#adder-mark").attr("data-display","item");
            $("#adder-mark").attr("data-sort","19");

            var input_ctn = $("#input_item_ctn");
            //input_empty();
            $("#input_item_ctn").find(".input_tools").hide();
            //$("#input_item_ctn").find(".input_pm").show();
            $("#input_item_ctn").find(".adderRow_Share").hide();
            $("#input_item_ctn").find(".adderRow_Goods").hide();
            $("#input_item_ctn").find(".adderRow_Receiver").show();
            $("#input_item_ctn").slideDown();
            $("#input_item_ctn").find("#input_theme").focus();
            $("#input_item_ctn").find("#input_content").attr("placeholder","");
            $("#input_item_ctn").attr("value","pm");

            //$("#input_pm_work").click();
            $("#input_share_none").click();
        }
    });

    // + 笔记
    $(document).on("click","#show_add_note",function() {

        if($("#input_item_ctn").attr("value") != "note") {

            $("#adder-mark").attr("data-operate","add");
            $("#adder-mark").attr("data-display","item");
            $("#adder-mark").attr("data-sort","21");
            $("#adder-mark").attr("value","note");

            var input_ctn = $("#input_item_ctn");
            //input_empty();
            $("#input_item_ctn").find(".input_tools").hide();
            $("#input_item_ctn").find(".adderRow_Share").show();
            $("#input_item_ctn").find(".adderRow_Goods").hide();
            $("#input_item_ctn").find(".adderRow_Receiver").hide();
            $("#input_item_ctn").slideDown();
            $("#input_item_ctn").find("#input_theme").focus();
            $("#input_item_ctn").find("#input_content").attr("placeholder","笔记可修改");
            $("#input_item_ctn").attr("value","note");

            $("#input_share_none").show();
            $("#input_share_none").click();
        }
    });
    // + 微博
    $(document).on("click","#show_add_words",function() {
        if($("#input_item_ctn").attr("value") != "words") {

            $("#adder-mark").attr("data-operate","add");
            $("#adder-mark").attr("data-display","item");
            $("#adder-mark").attr("data-sort","41");

            var input_ctn = $("#input_item_ctn");
            //input_empty();
            $("#input_item_ctn").find(".adderRow_Share").show();
            $("#input_item_ctn").find(".adderRow_Goods").hide();
            $("#input_item_ctn").find(".adderRow_Receiver").hide();
            //$("#input_item_ctn").find(".input_words").show();
            $("#input_item_ctn").slideDown();
            $("#input_item_ctn").find("#input_theme").focus();
            $("#input_item_ctn").find("#input_content").attr("placeholder","说点什么…");
            $("#input_item_ctn").attr("value","words");


            $("#input_share_all").click();
            //$("#input_words_all").click();
        }
    });
    // + 提问
    $(document).on("click","#show_add_ask",function() {
        if($("#input_item_ctn").attr("value") != "question") {

            $("#adder-mark").attr("data-operate","add");
            $("#adder-mark").attr("data-display","item");
            $("#adder-mark").attr("data-sort","44");

            var input_ctn = $("#input_item_ctn");
            //input_empty();
            $("#input_item_ctn").find(".adderRow_Share").show();
            $("#input_item_ctn").find(".adderRow_Goods").hide();
            $("#input_item_ctn").find(".adderRow_Receiver").hide();
            $("#input_item_ctn").slideDown();
            $("#input_item_ctn").find("#input_theme").focus();
            $("#input_item_ctn").find("#input_content").attr("placeholder","提问详情");
            $("#input_item_ctn").attr("value","help");

            $("#input_share_none").hide();
            $("#input_share_all").click();
        }
    });


    // + 商品
    $(document).on("click","#show_add_goods",function() {

        if($("#input_item_ctn").attr("value") != "goods") {

            $("#adder-mark").attr("data-operate","add");
            $("#adder-mark").attr("data-display","item");
            $("#adder-mark").attr("data-sort","48");

            var input_ctn = $("#input_item_ctn");
            //input_empty();
            $("#input_item_ctn").find(".adderRow_Share").show();
            $("#input_item_ctn").find(".adderRow_Goods").show();
            $("#input_item_ctn").find(".adderRow_Receiver").hide();
            $("#input_item_ctn").slideDown();
            $("#input_item_ctn").find("#input_theme").focus();
            $("#input_item_ctn").find("#input_content").attr("placeholder","商品描述");
            $("#input_item_ctn").attr("value","goods");

            $("#input_share_none").hide();
            $("#input_share_all").click();
            $("#input_goods_new").click();
        }
    });
    $(document).on("click","#input_goods_new",function() { // 商品 （新商品）
        $("#adder-mark").attr("data-type","1");
        $("#adder-mark").attr("data-form","0");
        $("#input_item_ctn").find(".input_header_text").html("+ 新商品");
        $("#input_item_ctn").find("#input_price").show();
        $("#input_item_ctn").find("#input_theme").focus();
    });
    $(document).on("click","#input_goods_second",function() { // 商品 （二手品）
        $("#adder-mark").attr("data-type","2");
        $("#adder-mark").attr("data-form","0");
        $("#input_item_ctn").find(".input_header_text").html("+ 二手商品");
        $("#input_item_ctn").find("#input_price").show();
        $("#input_item_ctn").find("#input_theme").focus();
    });
    $(document).on("click","#input_goods_service",function() { // 商品 （服务）
        $("#adder-mark").attr("data-type","3");
        $("#adder-mark").attr("data-form","0");
        $("#input_item_ctn").find(".input_header_text").html("+ 服务");
        $("#input_item_ctn").find("#input_price").show();
        $("#input_item_ctn").find("#input_theme").focus();
    });
    $(document).on("click","#input_goods_give",function() { // 商品 （闲置 免费送）
        $("#adder-mark").attr("data-type","9");
        $("#adder-mark").attr("data-form","0");
        $("#input_item_ctn").find(".input_header_text").html("+ 免费送物品");
        $("#input_item_ctn").find("#input_price").hide();
        $("#input_item_ctn").find("#input_theme").focus();
    });

    //$(".select_receiver-selector").unbind("click");
    $(document).on("click",".select_receiver-selector",function() {
        $(".receiver-selector").toggle("normal");
        $("#screen").toggle("normal");

        $("#receiver_contact").click();

        //$(".selector_entity").mCustomScrollbar({autoHideScrollbar:true,set_height:false,theme:"dark-thin"});
        //$(".selector_entity").mCustomScrollbar("update");
        //$("#ssss").mCustomScrollbar({autoHideScrollbar:true,theme:"dark-thin"});
        //$("#ssss").mCustomScrollbar("update");
    });
    // 选择联系人类别 [ 联系人 | 群组 | 项目	]
    $(document).on("click",".receiver_category",function() { // 选择联系人

        var update = $(this).attr("data-update");
        if(update == "y") {
            var type = $(this).attr("data-type");
            var container = $(this).attr("data-ctn");
            var result = ajax_getReceiver(type);
            library_shower("init",result,container);
            $(this).attr("data-update","n");
        }
        $(".receiver_category").removeClass("receiver_selected");
        $(this).addClass("receiver_selected");
    });

    $(document).on("click",".object_delete",function() { // 删除 选择联系人
        $(this).parent().remove();
    });

    // 取消
    $(document).on("click",".input_cansel",function() {
        input_cansel();
        remove_upload_image(); // @ this page down
    });
    // 确认
    $(document).on("click","#input_confirm",function() {

        var obj_theme = $("#input_theme");
        var obj_content = $("#input_content");
        var obj_tag = $("#input_tag");

        var theme = obj_theme.val();
        var content = obj_content.val();
        var tag = $.trim(obj_tag.val());
        tag = handle_tag(tag);
        var attaching = $(this).attr("data-attaching");
        var attachment = $(this).attr("data-attachment");
        $(".upImage_page").each( function() {
            attaching += ($(this).find("img").attr("src") + "<|>");
        });
        $("#input_confirm").attr("data-attaching",attaching);

        var operate = $(this).attr("data-operate");
        var display = $(this).attr("data-display");
        var id = $(this).attr("data-id");
        var userItemId = $(this).attr("data-userItemId");

        var sort = $(this).attr("data-sort");
        var type = $(this).attr("data-type");
        var form = $(this).attr("data-form");

        var share = $("#input_share").attr("data-selected");
        var important = $("#input_important").attr("data-selected");

        var adderObj = $("#input_item_ctn");
        adder_confirm(adderObj);

    });


    // 删除 上传图片
    $(document).on("click",".upImage_delete",function() {
        var theParent = $(this).parent();
        var thePath = theParent.find("img").attr("src");
        theParent.removeClass("upImage_page");
        theParent.remove();

        LA_deleteFile(thePath);
    });

})

function adder_confirm(adderObj) // adder 功能函数 添加ITEM
{
    var pageType = $("#page-Marking").attr("data-type");
    var pageVisitor = $("#page-Marking").attr("data-visitor");
    var pageBelong = $("#page-Marking").attr("data-belong");

    var adder = new Object();

    //var adderObj = adderObj;
    var adderMark = $("#adder-mark");

    adder.operate = adderMark.attr("data-operate");
    adder.display = adderMark.attr("data-display");
    adder.id = adderMark.attr("data-id");

    adder.sort = adderMark.attr("data-sort");
    adder.type = adderMark.attr("data-type");
    adder.form = adderMark.attr("data-form");

    adder.working = adderMark.attr("data-working");
    adder.importance = 0;
    if(adder.working == 0) adder.importance = 0;
    else adder.importance = adderObj.find(".adderInput-Importance").attr("data-selected");

    adder.share = adderObj.find(".adderInput-Share").attr("data-selected");
    adder.price = 0;

    var adderTheme = adderObj.find(".adderInput-Theme");
    var adderContent = adderObj.find(".adderInput-Content");
    var adderTag = adderObj.find(".adderInput-Tag");

    adder.theme = adderTheme.val();
    adder.content = adderContent.val();
    var tag = $.trim(adderTag.val());
    adder.tag = handle_tag(tag);

    var input_judge = "deny";
    input_judge = judge_adder_text(adderObj);

    var time_type = adderMark.attr("data-time-type");
    adder.time_type = time_type;
    // time_type
    if(adder.operate == "add")
    {
        if(adder.time_type == 1)
        {
            adderObj.find(".adder_theme");

            var adderOnlyStart = adderObj.find(".adderInput-Only-Start");
            var adderOnlyEnded= adderObj.find(".adderInput-Only-Ended");

            var start_type = adderOnlyStart.attr("data-type");
            var start_time = adderOnlyStart.attr("data-value");
            var end_type = adderOnlyEnded.attr("data-type");
            var end_time = adderOnlyEnded.attr("data-value");

            if( (start_type == 0) && (end_type == 0) )
            {
                input_judge = "time-deny";
                prompting(adderOnlyStart,"#fcc");
                prompting(adderOnlyEnded,"#fcc");
            }
            else
            {
                input_judge = time_judge(start_type,start_time,end_type,end_time);
                if(input_judge == "allow")
                {
                    adder.start_type = start_type;
                    adder.start_time = start_time;
                    adder.end_type = end_type;
                    adder.end_time = end_time;
                }
            }
        }
        else if(adder.time_type == 1)
        {
            var adderCycleStart = adderObj.find(".adderInput-Cycle-Start");
            var adderCycleEnded= adderObj.find(".adderInput-Cycle-Ended");

            var start_type = adderCycleStart.attr("data-type");
            var start_time = adderCycleStart.attr("data-value");
            var end_type = adderCycleEnded.attr("data-type");
            var end_time = adderCycleEnded.attr("data-value");

            if( (start_type == 0) && (end_type == 0) )
            {
                input_judge = "deny";
                prompting(adderCycleStart,"#fcc");
                prompting(adderCycleEnded,"#fcc");
            }
            if(input_judge == "allow")
            {
                adder.start_type = start_type;
                adder.start_time = start_time;
                adder.end_type = end_type;
                adder.end_time = end_time;
            }
        }
    }

    // 私信
    if(adder.sort == 19)
    {
        adder.share = "31";
        var adderReceiver = adderObj.find(".adderRow_Receiver");
        var object_judge = "deny";
        var object_ids = "";
        adderObj.find(".pm_object").each( function() {
            object_ids += ($(this).attr("data-id") + "|");
        });

        if(object_ids == "")
        {
            prompting(adderReceiver,"#fcc");
            input_judge = "receiver-deny";
        }
        var receiverIds = object_ids.slice(0,-1);

    }

    if(adder.sort == 48) // 商品
    {
        if(input_judge == "allow" && adder.operate == "add")
        {
            if(adder.type == 9) adder.price = 0;
            else
            {
                input_judge = judge_adder_price(adderObj);
                adder.price = adderObj.find(".adderInput-Price").val();
            }
        }
    }

    adder.attaching = "";
    adder.attachment = "";
    adderObj.find(".upImage-option").each( function() {
        adder.attaching += ("qingbo-/" + $(this).find("img").attr("data-picName") + "<|>");
    });

    if(input_judge == "allow")
    {
        var adderResult = LA_add_item(pageType,pageVisitor,adder);
        if(adderResult.status)
        {
            _myAlert(adderResult.msg,3000,"success");
            var adderHTML = adderResult.html;

            //if(working != 0) setWorkingINC();

            if(adder.operate == "add")
            {
                library_shower("insert",adderResult.html,"#mine_ctn .entity_ctn");
                $("#get-Mine").attr("data-update","y");
                $("#sidebar-mine").click();
            }
            else if(adder.operate == "modify")
            {
                var operatingClass = ".item-" + adder.id;
                library_shower("replace",adderHTML,operatingClass);
            }
            adder_empty();
        }
        else _myAlert(adderResult.msg,3000,"fail");
    }
    else layer.msg(input_judge);
}

function insert_adder_item(sort)
{
    var itemPageMark;
    if(sort == 19) {
        itemPageMark = $("#get-PMOut");
        //library_shower("insert",adderResult,"#outbox_ctn .entity_ctn");//layer.msg(object_ids);
        $("#get-PMOut").attr("data-update","y");
        $("#get-PMOut").click();
    } else if(sort == 21) {
        itemPageMark = $("#get-MyUnfinished");
        //library_shower("insert",adderResult,"#unfinised_ctn .entity_ctn");
        $("#get-MyUnfinished").attr("data-update","y");
        $("#get-MyUnfinished").click();
        item_count(".works_count","plus");
    } else if(sort == 22) {
        $(".schedule_ctn").remove();
        $(".calendar_date").remove();
        $("#menu_schedule").attr("data-update","y");
        $("#menu_schedule").click();
    } else if(sort == 23) {
        itemPageMark = $("#get-MyNotebook");
        //library_shower("insert",adderResult,"#notebook_mine_ctn .entity_ctn");
        $("#get-MyNotebook").attr("data-update","y");
        $("#get-MyNotebook").click();
    } else if(sort == 44) {
        itemPageMark = $("#get-MyAskbar");
        //library_shower("insert",adderResult,"#askbar_mine_ctn .entity_ctn");
        $("#get-MyAskbar").attr("data-update","y");
        $("#get-MyAskbar").click();
    } else if(sort == 41) {
        itemPageMark = $("#get-MyUtterance");
        $("#get-MyUtterance").attr("data-update","y");
        $("#get-MyUtterance").click();
    } else if(sort == 88) {
        $("#get-MyStore").attr("data-update","y");
        $("#get-MyStore").click();
    }
    var container = itemPageMark.attr("data-ctn");
    var insertCtn = container + " .entity_ctn";
    library_shower("insert",adderResult,insertCtn);
    //itemPageMarkattr.attr("data-update","y");
    //itemPageMarkattr.click();
}

function adder_Init(adderObj)
{
    $("#adder-mark").attr("data-operate","");
    $("#adder-mark").attr("data-display","");
    $("#adder-mark").attr("data-id",0);
    $("#adder-mark").attr("data-userItemId","");
    $("#adder-mark").attr("data-sort","");
    $("#adder-mark").attr("data-type","");
    $("#adder-mark").attr("data-form","");
    $("#adder-mark").attr("data-share",0);
    $("#adder-mark").attr("data-working",0);
    $("#adder-mark").attr("data-time-type",0);

    adderObj.find(".adderInput-Theme").val("");
    adderObj.find(".adderInput-Content").val("");
    adderObj.find(".adderInput-Tag").val("");
    adderObj.find(".adderInput-Price").val("");

    adderObj.find(".adderInput-Only-Start").val("");
    adderObj.find(".adderInput-Only-Start").attr("data-name",0);
    adderObj.find(".adderInput-Only-Start").attr("data-time-type",0);
    adderObj.find(".adderInput-Only-Start").attr("data-timeResult","");

    adderObj.find(".adderInput-Only-Ended").val("");
    adderObj.find(".adderInput-Only-Ended").attr("data-name",0);
    adderObj.find(".adderInput-Only-Ended").attr("data-time-type",0);
    adderObj.find(".adderInput-Only-Ended").attr("data-timeResult","");

    adderObj.find(".adderInput-Cycle-Start").val("");
    adderObj.find(".adderInput-Cycle-Start").attr("data-name",0);
    adderObj.find(".adderInput-Cycle-Start").attr("data-time-type",0);
    adderObj.find(".adderInput-Cycle-Start").attr("data-timeResult","");

    adderObj.find(".adderInput-Cycle-Ended").val("");
    adderObj.find(".adderInput-Cycle-Ended").attr("data-name",0);
    adderObj.find(".adderInput-Cycle-Ended").attr("data-time-type",0);
    adderObj.find(".adderInput-Cycle-Ended").attr("data-timeResult","");

}

function adder_empty()
{
    $(".adder_theme").val("");
    $(".adder_content").val("");
    $(".adder_tag").val("");
    $(".adder_price").val("");
    $(".input_ctn .time_empty").click();
    $("#adder-mark").attr("data-id",0);
    $(".upImage-option").remove();
    input_empty();
    input_cansel();
}

function input_empty()
{
    $("#input_theme").val("");
    $("#input_content").val("");
    $("#input_tag").val("");
    $("#input_price").val("");
    $(".input_ctn .time_empty").click();
    $("#input_confirm").attr("data-id",0);
}
function input_cansel()
{
    $(".input_container").slideUp();
    $(".input_ctn").slideUp();

    $("#input_item_ctn").attr("value","");

    $("#input_confirm").attr("data-operate","add");
    $("#input_confirm").attr("data-id","");
    $("#input_confirm").html("确定");
    $(".input-add").removeClass("selected_1");

    var M_backer= $("#page-Marking").attr("data-backer-Current");
    $(M_backer).click();
}

