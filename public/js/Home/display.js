jQuery( function($) {

    $(document).on("click",".menu-option",function() {

        $(".menu_tool").hide();
        $(".display-hide").hide();

        //var shower = $(this).attr("data-show");
        //$(shower).show();
        var showText = $(this).attr("data-show");
        var showers = showText.split(" ");
        for (var j=0;j<showers.length;j++) {
            $(showers[j]).show();
        }

        $(".menu-option").removeClass("_selected7");
        $(this).addClass("_selected7");
        var title_text = $(this).attr("data-titler-text");
        $(".header-body").html(title_text);
        var clicker = $(this).attr("data-clicker");
        $(clicker).click();

        $(".layout-sidebar-back").hide();
        var clientWidth = getClientWidth();
        //var screenWidth = getScreenWidth();
        if(clientWidth <= 720) $(".layout-sidebar").fadeOut();

    });
    $(document).on("click",".geterDisp",function() {

        var update = $(this).attr("data-update");
        var id = $("#page-Marking").attr("data-belong");
        var type = $(this).attr("data-type");
        var geter = $(this).attr("data-geter");
        var operate = $(this).attr("data-operate");
        var ctn = $(this).attr("data-ctn");

        var geters=new Object();
        geters.geter = geter;
        geters.get_type = operate;
        geters.geter_sort = $(this).attr("data-geter-sort");
        geters.get_first = $(this).attr("data-position-first");
        geters.get_last = $(this).attr("data-position-last");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");
        geters.his_id = pageBelong;

        var update = $(this).attr("data-update");
        if(update == "y")
        {
            _geter(geters,pageType,pageVisitor,ctn);
            $(this).attr("data-update","n");
            //window.scrollTo(0,0);
            history.pushState({page:pageType, geter:geters.geter}, geters.geter, "?page="+geters.geter);
        }
        console.log('state: ' + geters.geter);

    });
    // 查找内容
    $(document).on("click",".geter_search",function() {

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");
        //var relationWho = $("#page-Marking").attr("data-belong");

        var geter = $(this).attr("data-geter");
        var getType = $(this).attr("data-getType");
        var position = $(this).attr("data-position");
        var ctn = $(this).attr("data-ctn");
        container = ctn + " .entity_ctn";

        var permission = 100;
        if(geter == "Guest") {
            permission = 98;
        } else if(geter == "MINE") {
            var permission = 0;
        } else if(geter == "HIS") {
        }

        if(getType == "init") {
            var getMore = $(this).attr("data-more");
            var getSearch = $(this).attr("data-search");
            var searchText = $(getSearch).val();
            $(getMore).attr("data-content",searchText);

            if(searchText == "") {
                prompting($(getSearch),"#fcc");
                $(getSearch).focus();
            } else {
                var allowText = "allow";
            }
        } else if(getType == "more") {
            var searchText = $(this).attr("data-content");
            var allowText = "allow";
        }

        if(allowText == "allow")
        {
            var result = LA_geterSearch(pageBelong,geter,searchText,getType,position,permission);
            var html = result.html;
            var isset = result.isset;
            var modified = result.modified;
            var minesId = result.mines;
            var location = result.location;
            if(getType == "init") {
                library_shower("init",html,container);
            } else if(getType == "more") {
                library_shower("more",html,container);
            }
            setMore(ctn,isset,location,modified,minesId);
            $(".optionerX1").removeClass("_selected7");
            $(getSearch).attr("placeholder",searchText);
            $(getSearch).attr("data-placeholder",searchText);
            $(getSearch).val("");
        }
    });
    $(".geter_search_content").bind( "keyup", function(event) {
        //$(document).on("keyup",".geter_search_content",function(event) {
        if(event.keyCode == 13) {
            var the_click = $(this).attr("data-click");
            $(the_click).click();
        }
    });
    // 查找 用户 user
    $(document).on("click","#search_user",function() {
        var the_search = $("#search_content").val();
        if(the_search != "") {
            //prompting($("#search_content"),"#ccf");
            //$("#search_content").focus();
        } else {
        }
        var result = LA_searchUser(the_search);
        var container = "#search_user_ctn .entity_ctn";
        library_shower("init",result.html,container);

        $(".display_ctn").hide();
        $("#search_user_ctn").show("normal");
        $(".menu-selected").removeClass("menu-selected");

    });
    $(document).on("keyup","#search_content",function(event) {
        if(event.keyCode == 13) {
            $("#search_user").click();
        }
    });

})


// Laravel 获取 geter Display 并显示
function _geterDsplay(id,type,geter,operate,position,container,permission)
{
    var geterD = LA_geterDisp(id,type,geter,operate,position,permission);

    var html = geterD.html;
    var isset = geterD.isset;
    var location = geterD.location;
    var modified = geterD.modified;
    var minesId = geterD.mines;
    var ctn = container + " .entity_ctn";

    if(geter == "MySchedule")
    {
    }
    else
    {
        library_shower(operate,html,ctn);
    }

    if(geter == "MySchedule") {
        time_init("#schedule_calendar");
        $("#show_calendar").click();
    }
    else if(geter == "GuestSchedule") {
        time_init("#schedule_calendar");
        $("#show_calendar").click();
    }
    else if(geter == "PMIn") {
        $("#menu_in_dom").hide();
    }
    else if(geter == "News") {
        $(".news_num").attr("data-num",0);
        $(".news_num").html(0);
        $(".news_num").hide();
        $("#menu_news_dom").hide();
    }
    else if(geter == "AboutMe") {
        $(".about_num").attr("data-num",0);
        $(".about_num").html(0);
        $(".about_num").hide();
        $("#menu_about_dom").hide();
    }

    if(geter == "MySchedule")
    {
    }
    else if(geter == "MyUnfinished")
    {
        $(".works_count").html(location);
        $(".works_count").attr("data-num",location);
    }
    else
    {
    }

    if(geter == "PMIn") {
        $("#menu_in_dom").hide();
    } else if(geter == "News") {
        $(".news_num").attr("data-num",0);
        $(".news_num").html(0);
        $(".news_num").hide();
        $("#menu_news_dom").hide();
    }

    setMore(container,isset,location,modified,minesId);

}
function LA_geterDisp(id,type,geter,operate,position,permission) // Laravel ajax 返回 geter Display
{
    var result;
    jQuery.ajax
    ({
        url:"/service/geterDisplay",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            id:id,
            type:type,
            geter:geter,
            operate:operate,
            position:position,
            permission:permission
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


// Laravel 获取 geter Display 并显示
function _geter(geters,page_type,page_visitor,container)
{
    var geterD = LA_geter(geters,page_type,page_visitor);
    if(geterD.status)
    {
        var geter = geters.geter;
        var html = geterD.html;
        var more = geterD.more;
        var first = geterD.location_first;
        var last = geterD.location_last;
        var ctn = container + " .entity_ctn";

        if(geter != "MySchedule") library_shower(geters.get_type,html,ctn);

        if(geter == "MySchedule") {
            time_init("#schedule_calendar");
            $("#show_calendar").click();
        }
        else if(geter == "GuestSchedule") {
            time_init("#schedule_calendar");
            $("#show_calendar").click();
        }
        else if(geter == "PMIn") {
            $("#menu_in_dom").hide();
        }
        else if(geter == "News") {
            $(".news_num").attr("data-num",0);
            $(".news_num").html(0);
            $(".news_num").hide();
            $("#menu_news_dom").hide();
        }

        if(geter == "MySchedule")
        {
        }
        else if(geter == "MyUnfinished")
        {
            $(".works_count").html(location);
            $(".works_count").attr("data-num",location);
        }
        else
        {
        }

        if(geter == "PMIn") {
            $("#menu_in_dom").hide();
        } else if(geter == "News") {
            $(".news_num").attr("data-num",0);
            $(".news_num").html(0);
            $(".news_num").hide();
            $("#menu_news_dom").hide();
        }

        setMores(container,more,first,last);
    }

}

function LA_geter(geters,page_type,page_visitor) // Laravel ajax 返回 geter Display
{
    var result;
    jQuery.ajax
    ({
        url:"/geter/display",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        traditional: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            geters:geters,
            page_type:page_type,
            page_visitor:page_visitor
        },
        success:function(data) {
            if(data.status) result = data;
            else {
                layer.msg(data.msg);
                result = false;
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });
    return result;
}
function LA_get_schedule(geter,type,text,start,ended) // Laravel 获取 日程
{
    var result;
    jQuery.ajax
    ({
        url:"/geter/getSchedule",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            geter:geter,
            type:type,
            text:text,
            start:start,
            ended:ended
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
function LA_geterSearch(belong,geter,searchText,getType,position,permission) // Laravel ajax 查询
{
    var result;
    jQuery.ajax
    ({
        url:"/service/geterSearch",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            belong:belong,
            geter:geter,
            searchText:searchText,
            getType:getType,
            position:position,
            permission:permission//,
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


// 更多选项
function setMores(container,more,first,last)
{
    var ctn = $(container);

    ctn.find(".more").attr("data-position-first",first);
    ctn.find(".more").attr("data-position-last",last);

    if(more)
    {
        ctn.find(".more").html("更多");
        ctn.find(".data-update","y");
    }
    else
    {
        ctn.find(".more").html("没有了");
        ctn.find(".data-update","n");
    }
}

// 更多选项
function setMore(container,isset,position,modified,minesId)
{
    var ctn = $(container);

    ctn.find(".more").attr("data-update",isset);
    ctn.find(".more").attr("data-position",position);
    ctn.find(".more").attr("data-modified",modified);
    ctn.find(".more").attr("data-minesId",minesId);

    if(isset == "y") {
        ctn.find(".more").html("更多");
    }
    else if(isset == "n") {
        ctn.find(".more").html("没有了");
    }
}



