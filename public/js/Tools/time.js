jQuery( function($) {


    // 显示日历
    $(document).on("click",".show_calendar",function() {
        //$("#schedule_calendar").toggle();
        $("#schedule_calendar").show();
    });

    //清空时间选项
    $(document).on("click",".time_empty",function() {
        var clearTarget = $(this).attr("value");
        $(clearTarget).val("");
        $(clearTarget).attr("name","0");
        $(clearTarget).attr("data-value","");
        $(clearTarget).attr("data-type","0");
    });

    // 调出 “时间选择器” 一次性时间
    $(document).on("click",".show_time_selector",function() {
        var type = $(this).attr("data-type");
        var target_url = "#" + $(this).attr("id");
        $("#time_confirm").attr("data-target",target_url);
        $("#time_selector").show("normal");
        $("#screen").show("normal");
        if(type == 1) {
            $("#select_time_none").click();
            $("#time_selector .clock_isset").show();
        } else if(type == 2) {
            $("#select_time_none").click();
            $("#time_selector .clock_isset").hide();
        }
        $("#time_selector .day_show").click();
    });
    // 调出 “时间选择器” 周期性时间
    $(document).on("click",".show_cycle_selector",function() {
        var target_url = "#" + $(this).attr("id");
        $("#cycle_confirm").attr("data-target",target_url);
        $("#cycle_selector").show("normal");
        $("#screen").show("normal");
        time_init("#cycle_selector");
        $("#select_cycle_week").click();
        $("#select_cycle_clock").click();
    });

    /* 月份 month selecter */
    // 开启 月份选择器
    $(document).on("click",".show_month_selector",function() {
        var xx = $(document).scrollTop();
        var X = $(this).offset().top;
        var Y = $(this).offset().left;

        $("#month_selector").css("top",X - xx + 40);
        $("#month_selector").css("left",Y - 60);
        $("#month_selector").show("normal");
        $("#clock_selector").hide();
        $("#screen_s").show("normal");
        $("#month_confirm").attr("data-target",$(this).attr("value"));

        var ctn = $($(this).attr("value"));

        var year = ctn.find(".result_year").val();
        var month = ctn.find(".result_month").val();
        var result = year + "年 " + month + "月";

        $("#month_selector").find(".result_year").val(year);
        $("#month_selector").find(".result_month").val(month);
        $("#month_selector").find(".time_result").html(result);

        //show_selected_month(year,month);
    });
    // 选择“年”
    $(document).on("click","#month_selector .year",function() {
        $("#month_selector .year").removeClass("time-selected");
        $(this).addClass("time-selected");

        $("#month_selector").find(".result_year").val($(this).html());

        var year = $("#month_selector").find(".result_year").val();
        var month = $("#month_selector").find(".result_month").val();
        var result = year + "年 " + month + "月";
        $("#month_selector").find(".time_result").html(result);
    });
    // 选择“月
    $(document).on("click","#month_selector .month",function() {
        $("#month_selector .month").removeClass("time-selected");
        $(this).addClass("time-selected");

        $("#month_selector").find(".result_month").val($(this).html());

        var year = $("#month_selector").find(".result_year").val();
        var month = $("#month_selector").find(".result_month").val();
        var result = year + "年 " + month + "月";
        $("#month_selector").find(".time_result").html(result);
    });
    // 月份选择器--“确定”
    $(document).on("click","#month_confirm",function() {
        $("#month_selector").hide();
        var target = $($(this).attr("data-target"));

        var year = $("#month_selector").find(".result_year").val();
        var month = $("#month_selector").find(".result_month").val();
        var result = year + "年" + month + "月";

        target.find(".result_year").val(year);
        target.find(".result_month").val(month);
        target.find(".show_month_selector").html(result);

        target.find(".day_show").click();
        $("#month_selector").hide();
        $("#screen_s").hide("normal");

        show_selected_time("#schedule_calendar");
    });
    // 月份选择器--“取消”
    $(document).on("click","#month_cansel",function() {
        $("#month_selector").hide();
        $("#screen_s").hide("normal");
    });


    //选择“时”
    $(document).on("click","#clock_selector .hour",function() {
        $("#clock_selector .hour").removeClass("time-selected");
        $(this).addClass("time-selected");

        $("#clock_selector").find(".result_hour").val($(this).html());
        $("#time_selector").find(".result_hour").val($(this).html());

        var the_hour = $("#time_selector").find(".result_hour").val();
        var the_minute = $("#time_selector").find(".result_minute").val();
        var the_result = the_hour + ":" + the_minute;
        $("#time_selector").find(".time_select_clock").html(the_result);
    });
    //选择“分”
    $(document).on("click","#clock_selector .minute",function() {
        $("#clock_selector .minute").removeClass("time-selected");
        $(this).addClass("time-selected");

        $("#clock_selector").find(".result_minute").val($(this).attr("value"));
        $("#time_selector").find(".result_minute").val($(this).html());

        //var the_hour = $("#clock_selector").find(".result_hour").val();
        //var the_minute = $("#clock_selector").find(".result_minute").val();
        var the_hour = $("#time_selector").find(".result_hour").val();
        var the_minute = $("#time_selector").find(".result_minute").val();
        var the_result = the_hour + ":" + the_minute;
        $("#clock_selector").find(".time_result").html(the_result);
        $("#time_selector").find(".time_select_clock").html(the_result);
    });
    //选择“时”
    $(document).on("click","#cycle_selector .hour",function() {
        $("#cycle_clock_selector .hour").removeClass("time-selected");
        $(this).addClass("time-selected");

        $("#cycle_clock_selector").find(".result_hour").val($(this).html());
        $("#cycle_selector").find(".result_hour").val($(this).html());

        var the_hour = $("#cycle_selector").find(".result_hour").val();
        var the_minute = $("#cycle_selector").find(".result_minute").val();
        var the_result = the_hour + ":" + the_minute;
        $("#cycle_selector").find(".time_select_clock").html(the_result);
    });
    //选择“分”
    $(document).on("click","#cycle_selector .minute",function() {
        $("#cycle_clock_selector .minute").removeClass("time-selected");
        $(this).addClass("time-selected");

        $("#clock_selector").find(".result_minute").val($(this).attr("value"));
        $("#cycle_selector").find(".result_minute").val($(this).html());

        var the_hour = $("#cycle_selector").find(".result_hour").val();
        var the_minute = $("#cycle_selector").find(".result_minute").val();
        var the_result = the_hour + ":" + the_minute;
        $("#clock_selector").find(".time_result").html(the_result);
        $("#cycle_selector").find(".time_select_clock").html(the_result);
    });


    //年 - 前一页
    $(document).on("click","#time_year_previous",function() {
        $("#time_year .year").each( function() {
            $(this).html(parseInt($(this).html()) - 12);
        });
        var year = $("#month_selector").find(".result_year").val();
        var month = $("#month_selector").find(".result_month").val();
        show_selected_month(year,month);
    });
    //年 - 后一页
    $(document).on("click","#time_year_next",function() {
        $("#time_year .year").each( function() {
            $(this).html(parseInt($(this).html()) + 12);
        });
        var year = $("#month_selector").find(".result_year").val();
        var month = $("#month_selector").find(".result_month").val();
        show_selected_month(year,month);
    });


    //更新 月份de日期
    $(document).on("click",".day_show",function() {
        var container = $(this).attr("data-ctn");
        var ctn = $(container);

        var year = ctn.find(".result_year").val();
        var month = ctn.find(".result_month").val();
        var day = ctn.find(".result_day").val();
        var hour = ctn.find(".result_hour").val();
        var minute = ctn.find(".result_minute").val();

        time_init("#time_selector");
        //show_month_day(year,month,container); // 显示 选择年月-日期
    });

    // 隐藏日历
    $(document).on("click",".calendar_hider",function() {
        $("#schedule_calendar").hide();
    });
    // 日历 - 显示日历
    $(document).on("click","#show_calendar",function() {
        var container = $(this).attr("data-ctn");
        var ctn = $(container);

        var year = ctn.find(".result_year").val();
        var month = ctn.find(".result_month").val();
        if(year == "") {
            time_init(container);
            year = ctn.find(".result_year").val();
            month = ctn.find(".result_month").val();
        }
        create_calendar(year,month);
    });
    // 日历 - 上个月
    $(document).on("click",".month_previous",function() {
        var container = $("#schedule_calendar");

        var year = container.find(".result_year").val();
        var month = container.find(".result_month").val();
        if(month == 1) {
            month = 12;
            year = parseInt(year) - 1;
        } else {
            month = parseInt(month) - 1;
        }

        container.find(".result_month").val(month);
        container.find(".result_year").val(year);
        var result = year + "年" + month + "月";
        container.find(".show_month_selector").html(result);

        $("#show_calendar").click();
        $("#schedule_calendar").show();
    });
    // 日历 - 下个月
    $(document).on("click",".month_next",function() {
        var container = $("#schedule_calendar");

        var year = container.find(".result_year").val();
        var month = container.find(".result_month").val();
        if(month == 12) {
            month = 1;
            year = parseInt(year) + 1;
        } else {
            month = parseInt(month) + 1;
        }

        container.find(".result_month").val(month);
        container.find(".result_year").val(year);
        var result = year + "年" + month + "月";
        container.find(".show_month_selector").html(result);

        $("#show_calendar").click();
        $("#schedule_calendar").show();
    });
    // 日历 显示当天日程
    $(document).on("click",".calendar_day",function() {
        if($(this).find(".day").html() != "") {

            $("#schedule_calendar").find(".result_day").val($(this).find(".day").html());

            $(".calendar_day").removeClass("time-selected");
            $(this).addClass("time-selected");

            var year = $("#schedule_calendar").find(".result_year").val();
            var month = $("#schedule_calendar").find(".result_month").val();
            var day = $("#schedule_calendar").find(".result_day").val();


            var the_month = $(this).parent().parent().attr("data-id");
            var the_day = the_month + "." + day;
            var the_week = $(this).attr("data-week");

            //var the_month = year + "-" + Appendzero(month);
            //var the_monthh = year + "." + month;
            //var the_dayy = year + "-" + month + "." + day;

            var the_ctn = $(this).parent().parent().attr("data-ctn");//alert(the_ctn);
            var schedule_ctn = $(the_ctn);

            schedule_ctn.find(".item-container").each ( function() {
                //if($(this).attr("data-calendar") == the_month) {
                    var days = $(this).attr("data-days").split(" ");
                    for(var j=0; j<days.length ;j++) {
                        if(days[j] == the_day) {
                            $(this).show();
                            break;
                        } else {
                            //$(this).hide();
                            var weeks = $(this).attr("data-weeks").split(" ");
                            for(var k=0; k<weeks.length ;k++) {
                                if(weeks[k] == the_week) {
                                    $(this).show();
                                    break;
                                } else {
                                    $(this).hide();
                                }
                            }
                        }
                    }
                //} else {
                //    $(this).hide();
                //}
            });
            //layer.msg(the_ctn);
            /*schedule_ctn.find(".item-container[data-form!='0']").each ( function() {
             if($(this).attr("data-calendar") == the_month) {
             var weeks = $(this).attr("data-weeks").split(" ");
             for(var j=0; j<weeks.length ;j++) {
             if(weeks[j] == the_week) {
             $(this).show();
             break;
             } else {
             $(this).hide();
             }
             }
             } else {
             $(this).hide();
             }
             });*/

            //var screenWidth = getScreenWidth();
            var clientWidth = getClientWidth();
            if(clientWidth < 1024) $("#schedule_calendar").hide();

            $(the_ctn).show();

            var body_show = the_month + "-" + Appendzero(day);
            $(".header-body").html(body_show);
        }
    });

    $(document).on("click",".get-Schedule",function() {

        $("#show_calendar").click();

    });



    // 选择一次性时间--“确定”
    $(document).on("click","#time_confirm",function() {
        var target = $($(this).attr("data-target"));
        var type = $(this).attr("name");
        var selector = $("#time_selector");

        var year = selector.find(".result_year").val();
        var month = selector.find(".result_month").val();
        var day = selector.find(".result_day").val();
        var hour = selector.find(".result_hour").val();
        var minute = selector.find(".result_minute").val();

        if(type == 1) {
            var the_time = year + "-" + month + "-" + day + "  " + hour + ":" + minute;
        } else if(type == 2) {
            var the_time = year + "-" + month + "-" + day;
        }

        target.val(the_time);
        target.attr("name",type);
        target.attr("data-value",the_time);
        target.attr("data-type",type);
        $("#time_cancel").click();
    });

    // 选择一次性时间--“取消”
    $(document).on("click","#time_cancel",function() {
        $(".tool-timer").hide("normal");
        $("#screen_s").hide("normal");
        $("#screen").hide("slow");
        $("#clock_selector").hide("slow");
    });

    // 选择周期时间--“确定”
    $(document).on("click","#cycle_confirm",function() {
        var target = $($(this).attr("data-target"));
        var type = $(this).attr("name");
        var selector = $("#cycle_selector");

        var year = selector.find(".result_year").val();
        var month = selector.find(".result_month").val();
        var day = selector.find(".result_day").val();
        var week = selector.find(".result_week").val();
        var hour = selector.find(".result_hour").val();
        var minute = selector.find(".result_minute").val();

        if(week == 0) {
            var weekShow = "日";
        } else if(week == 1) {
            var weekShow = "一";
        } else if(week == 2) {
            var weekShow = "二";
        } else if(week == 3) {
            var weekShow = "三";
        } else if(week == 4) {
            var weekShow = "四";
        } else if(week == 5) {
            var weekShow = "五";
        } else if(week == 6) {
            var weekShow = "六";
        }

        if(type == 1) {
            var the_time = "每周" + weekShow + "  " + hour + ":" + minute;
            var result_time = week + "-" + hour + ":" + minute;
        } else if(type == 2) {
            var the_time = "每周" + weekShow;
            var result_time = week;
        }

        target.attr("name",type);
        target.val(the_time);
        target.attr("data-result",result_time);
        target.attr("data-type",type);
        target.attr("data-value",result_time);
        $("#cycle_cancel").click();
    });

    // 选择周期时间--“取消”
    $(document).on("click","#cycle_cancel",function() {
        $(".tool-timer").hide("normal");
        $("#screen_s").hide("normal");
        $("#screen").hide("slow");
        $("#cycle_selector").hide("slow");
    });

    // 选择 详细时间 clock
    $(document).on("click","#select_time_clock",function() {
        $("#time_confirm").attr("name","1");
        $("#clock_selector").show("normal");
        $(".time_select_clock").show("normal");
        //$(".time_select_clock").click();

        $("#month_selector").hide();

        var hour = $("#time_selector").find(".result_hour").val();
        var minute = $("#time_selector").find(".result_minute").val();
        var result = hour + ":" + minute;
        $("#clock_selector").find(".result_hour").val(hour);
        $("#clock_selector").find(".result_minute").val(minute);
        $("#clock_selector").find(".time_result").html(result);

        show_selected_clock("#clock_selector",hour,minute);
    });

    // 关闭 详细时间 clock
    $(document).on("click","#select_time_none",function() {
        $("#time_confirm").attr("name","2");
        $("#clock_selector").hide("normal");
        $(".time_select_clock").hide("normal");
    });
    //时钟选择器
    $(document).on("click",".time_select_clock",function() {
        var xx = $(document).scrollTop();
        var X = $(this).offset().top;
        var Y = $(this).offset().left;
        //$("#clock_selector").css("top",X - xx - 20);
        //$("#clock_selector").css("left",Y + 300);
        $("#month_selector").hide();
        //$("#screen_s").show("normal");
        //$("#clock_confirm").attr("data-target",$(this).attr("value"));

        var ctn = $($(this).attr("value"));
        var hour = ctn.find(".result_hour").val();
        var minute = ctn.find(".result_minute").val();
        var result = hour + ":" + minute;

        $("#clock_selector").find(".result_hour").val(hour);
        $("#clock_selector").find(".result_minute").val(minute);
        $("#clock_selector").find(".time_result").html(result);

        show_selected_clock("#clock_selector",hour,minute);
    });



    // 选择 详细时间 clock
    $(document).on("click","#select_cycle_clock",function() {
        $("#cycle_confirm").attr("name","1");
        $(".time_select_clock").show("normal");
        $("#cycle_clock_selector").show();

        var hour = $("#cycle_selector").find(".result_hour").val();
        var minute = $("#cycle_selector").find(".result_minute").val();
        var result = hour + ":" + minute;
        $("#cycle_clock_selector").find(".result_hour").val(hour);
        $("#cycle_clock_selector").find(".result_minute").val(minute);
        $("#cycle_clock_selector").find(".time_result").html(result);
        $("#cycle_clock_selector").find(".cycle_clock_selected").html(result);

        show_selected_clock("#cycle_clock_selector",hour,minute);
    });

    // 关闭 详细时间 clock
    $(document).on("click","#select_cycle_none",function() {
        $("#cycle_confirm").attr("name","2");
        $(".time_select_clock").hide("normal");
        $("#cycle_clock_selector").hide();
    });

    //
    $(document).on("click","#select_cycle_week",function() {
        $("#cycle_week").show("normal");
        $("#cycle_month").hide("normal");
        var theWeek = $("#cycle_selector").find(".result_week").val();
        var theClick = ".cycle_week[data-selected=" + theWeek + "]";
        $(theClick).click();
    });
    //
    $(document).on("click","#select_cycle_month",function() {
        $("#cycle_month").show("normal");
        $("#cycle_week").hide("normal");
    });

    //
    $(document).on("click",".cycle_week",function() {
        var the_week = $(this).attr("data-selected");
        var the_week_show = "周" + the_week;
        //$("#cycle_confirm").attr("name","2");
        $("#cycle_selector").find(".result_week").val(the_week);
        $("#cycle_selector").find(".selector_show").html($(this).html());
        $(".cycle_week").removeClass("radior_selected");
        $(this).addClass("radior_selected");
    });


    // 选择 日期
    $(document).on("click",".selector_day",function() {
        var the_day = $(this).find(".day").html();
        var select_day = the_day + "日";
        if(the_day != "") {
            $("#time_selector").find(".result_day").val(the_day);
            $("#time_selector").find(".time_select_day").html(select_day);

            $(".selector_day").removeClass("time-selected");
            $(this).addClass("time-selected");
        }
    });

    // 上个月
    $(document).on("click",".time_month_previous",function() {
        var container = $("#time_selector");

        var year = container.find(".result_year").val();
        var month = container.find(".result_month").val();
        if(month == 1) {
            month = 12;
            year = parseInt(year) - 1;
        } else {
            month = parseInt(month) - 1;
        }

        container.find(".result_month").val(month);
        container.find(".result_year").val(year);
        var result = year + "年" + month + "月";
        container.find(".show_month_selector").html(result);

        show_month_day(year,month,"#time_selector"); // 显示 选择年月-日期
    });
    // 下个月
    $(document).on("click",".time_month_next",function() {
        var container = $("#time_selector");

        var year = container.find(".result_year").val();
        var month = container.find(".result_month").val();
        if(month == 12) {
            month = 1;
            year = parseInt(year) + 1;
        } else {
            month = parseInt(month) + 1;
        }

        container.find(".result_month").val(month);
        container.find(".result_year").val(year);
        var result = year + "年" + month + "月";
        container.find(".show_month_selector").html(result);

        show_month_day(year,month,"#time_selector"); // 显示 选择年月-日期
    });


})


function create_calendar(year,month) // 创建 日历
{
    var the_month = year + "-" + Appendzero(month);

    var calendar_id = "calendar-" + the_month;
    var calendar_ctn = "#" + calendar_id;

    var schedule_id = "schedule-" + the_month;
    var schedule_ctn = "#" + schedule_id;

    if ($(calendar_ctn).length == 0) {

        $(".display-hide").hide();
        var schedule_clone = $("#schedule_clone").clone(true);
        schedule_clone.attr("id",schedule_id);
        schedule_clone.attr("data-id",the_month);
        schedule_clone.attr("data-ctn",calendar_ctn);
        schedule_clone.addClass("schedule_ctn");
        $("#schedule_clone").after(schedule_clone);

        var geter = $(".get-MySchedule").attr("data-geter");

        var pageType = $("#page-Marking").attr("data-type");
        var pageVisitor = $("#page-Marking").attr("data-visitor");
        var pageBelong = $("#page-Marking").attr("data-belong");

        var geters=new Object();
        geters.geter = $(".geter-Schedule").attr("data-geter");
        geters.geter_sort = "Month";
        geters.geter_value = the_month;

        //var result = LA_get_schedule(geter,"month",the_month,0,0);
        var result = LA_geter(geters,pageType,pageVisitor);
        show_agendas("init",schedule_ctn,result);
        //var the_container = schedule_ctn + " .entity_ctn";
        //library_shower("init",result.html,the_container);

        $(schedule_ctn).show();
        schedule_clone.show();

        var time_clone = $("#schedule_calendar .time_clone").clone(true);
        time_clone.removeClass("time_clone");
        time_clone.addClass("calendar_month");

        time_clone.attr("id",calendar_id);
        time_clone.attr("data-id",the_month);
        time_clone.attr("data-ctn",schedule_ctn);
        time_clone.attr("data-year",year);
        time_clone.attr("data-month",month);
        $("#schedule_calendar").append(time_clone);
        $("#schedule_calendar .calendar_month").hide();
        $(calendar_ctn).show();

        show_month_day(year,month,calendar_ctn); // 显示 选择年月-日期
        show_calendar_num(schedule_ctn); // 显示 日历 日程数
    } else {

        $("#schedule_calendar .calendar_month").hide();
        $(calendar_ctn).show();
        $(".display-hide").hide();
        $(schedule_ctn).show();
    }
    show_selected_time("#schedule_calendar");
}
function show_calendar_num(schedule_ctn) // 显示 日历 日程数
{
    var calendar_ctn = $(schedule_ctn).attr("data-ctn");
    var the_month = $(schedule_ctn).attr("data-id");
    var items = schedule_ctn + " .item-container";

    $(calendar_ctn).find(".agendaN").attr("data-num","0");
    $(calendar_ctn).find(".agendaN").html("");

    $(items).each( function() {
        var time_type = $(this).attr("data-time-type");
        if(time_type == 1) {
            var days = $(this).attr("data-days").split(" ");
            for(var j=0; j<days.length ;j++) {
                var the_day = days[j].split(".");
                if(the_day[0] == the_month) {
                    var xx = "._day[data-day=" + the_day[1] + "]";
                    var agendaN = $(calendar_ctn).find(xx).find(".agendaN");
                    agendaN.attr("data-num",parseInt(agendaN.attr("data-num")) + 1);
                    agendaN.html(agendaN.attr("data-num"));
                }
            }
        } else {
            var weeks = $(this).attr("data-weeks").split(" ");//alert(weeks[0]);
            for(var k=0; k<weeks.length ;k++) {
                var yy = "._day[data-day!=''][data-week=" + weeks[k] + "]";
                $(calendar_ctn).find(yy).each( function() {
                    var agendaNx = $(this).find(".agendaN");
                    agendaNx.attr("data-num",parseInt(agendaNx.attr("data-num")) + 1);
                    agendaNx.html(agendaNx.attr("data-num"));
                });
                //var agendaN = $(calendar_ctn).find(yy).parent().find(".agendaN");
                //agendaN.attr("data-num",parseInt(agendaN.attr("data-num")) + 1);
                //agendaN.html(agendaN.attr("data-num"));
            }
        }
        $(".calendar_month ._day").removeClass("time-selected");
        $(this).addClass("time-selected");
    });
}
function update_calendar_num() // 更新 日历 日程数
{
    $(".schedule_ctn").each( function() {
        var schedule_ctn = "#" + $(this).attr("id");
        show_calendar_num(schedule_ctn);
    });
}
function time_init(container) // 初始化 时间
{
    var nowTime = new Date();
    var the_year = nowTime.getFullYear();
    var the_month = nowTime.getMonth() + 1;
    var the_day = nowTime.getDate();
    var the_hour = Appendzero(nowTime.getHours());
    var the_minute = Appendzero(nowTime.getMinutes());
    var the_week = nowTime.getDay();

    var ctn = $(container);

    ctn.find(".result_year").val(the_year);
    ctn.find(".result_month").val(the_month);
    ctn.find(".result_day").val(the_day);
    ctn.find(".result_hour").val(the_hour);
    ctn.find(".result_minute").val(the_minute);
    ctn.find(".result_week").val(the_week);
    ctn.find(".result_week").attr("data-week",the_week);

    var year = ctn.find(".result_year").val();
    var month = ctn.find(".result_month").val();
    var day = ctn.find(".result_day").val();
    var hour = ctn.find(".result_hour").val();
    var minute = ctn.find(".result_minute").val();

    var select_month = year + "年" + month + "月";
    var select_day = day + "日";
    var select_clock = hour + ":" + minute;
    ctn.find(".show_month_selector").html(select_month);
    ctn.find(".time_select_day").html(select_day);
    ctn.find(".time_select_clock").html(select_clock);

    if(container == "#schedule_calendar") {
        //ctn.find(".calendar_day").click();
    } else if (container == "#time_selector") {
        show_month_day(year,month,container); // 显示 选择年月de-日期
    } else if (container == "#cycle_selector") {
    }
}
function show_month_day(year,month,container) // 显示 选择年月de-日期 JS基本函数
{
    var time_day = $(container).find(".day");
    var time_week = $(container).find(".week");

    var theday = new Date(year,(month - 1),1);

    var weekday = new Date(year,(month - 1),1).getDay();
    var lastDay = new Date(year,month, 0).getDate();
    var dayss = parseFloat(year) + "-" + parseFloat(month) + "-1";//alert(dayss);
    //var theweek = new Date(year,(month - 1),1).WeekNumOfYear;
    var weekData = LA_getWeekNumber(dayss);
    var theweek = weekData.num;
    theweek = parseInt(theweek);

    if(weekday == 0) {
        weekday = 7;
    }
    weekday = weekday - 1;

    $(container).find(".day").attr("data-day","");
    /*
     for(var i = (weekday); i < (lastDay + weekday); i++) {
     var xx = i - weekday + 1;
     time_day.get(i).innerHTML = xx;
     $(container).find(".day:eq(" + i + ")").attr("data-day",xx);
     }

     for(var j = 0; j < weekday; j++) {
     //time_day.get(j).innerHTML = "";
     }

     for(var k = (lastDay + weekday); k < 42 ; k++) {
     //time_day.get(k).innerHTML = "";
     }
     */

    time_day.each( function() {
        $(this).html("");
        $(this).attr("data-day","");
        var num = $(this).attr("date-num");
        var xxday = num - weekday;
        if(xxday > 0 && xxday < lastDay + 1) {
            $(this).html(xxday);
        }
        $(this).attr("data-day",$(this).html());
        $(this).parent().attr("data-day",$(this).html());
        //$(this).attr("value",$(this).html());
    });

    for(var l = 0; l < 6; l++) {
        if(theweek == 52 || theweek == 53 || theweek == 54 || theweek == 55) {
            time_week.get(l).innerHTML = theweek + l;
            theweek = 0;
        } else {
            time_week.get(l).innerHTML = theweek + l;
        }
    }

    time_week.each( function() {
        $(this).attr("value",$(this).html());
    });
    show_selected_time(container);
}
function show_selected_time(container) // 初始化 日期的选择
{
    var ctn = $(container);

    var year = ctn.find(".result_year").val();
    var month = ctn.find(".result_month").val();
    var day = ctn.find(".result_day").val();
    var hour = ctn.find(".result_hour").val();
    var minute = ctn.find(".result_minute").val();

    ctn.find(".day").removeClass("time-selected");
    if(container == "#schedule_calendar") {
        var the_month = year + "-" + Appendzero(month);
        var the_ctn = "#calendar-" + the_month;
        //var the_day = the_ctn + " ._day[data-day=" + day + "]";alert(the_day);
        var the_day = the_ctn + "  .calendar_day[data-day=" + day + "]";
        ctn.find(the_day).click();
    } else if(container == "#time_selector") {
        var the_day = ".day[data-day=" + day + "]";
        ctn.find(the_day).click();
        //$(".calendar_month ._day").removeClass("time-selected");
        //$(this).addClass("time-selected");
    }
}
function show_selected_month(year,month) // 初始化 月份选择器
{
    var the_year = ".year:contains(" + year + ")";
    $("#time_year .year").removeClass("time-selected");
    $("#time_year").find(the_year).addClass("time-selected");

    var the_month = ".month[value=" + Appendzero(month) + "]";
    $("#time_month .month").removeClass("time-selected");
    $("#time_month").find(the_month).addClass("time-selected");
}
function show_selected_clock(ctn,hour,minute) // 初始化 时钟选择器
{
    var theHour = ".hour[value=" + hour + "]";
    $(ctn).find(".hour").removeClass("time-selected");
    $(ctn).find(theHour).addClass("time-selected");
    var theMinute = ".minute[value=" + minute + "]";
    $(ctn).find(".minute").removeClass("time-selected");
    $(ctn).find(theMinute).addClass("time-selected");
}

