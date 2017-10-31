@extends('master')


@section('MySpecial')
    <script>
        jQuery( function($) {

            $("#guestAll").click();
//            var clientWidth = getClientWidth();
//            var screenWidth = getScreenWidth();
//            if(clientWidth <= 720) {
//                //$("#footer-main").click();
//                $("#guest_float_all").click();
//            } else if( (clientWidth > 720) && (clientWidth <= 1280) ) {
//                $("#guestAll").click();
//            } else if(clientWidth > 1280) {
//            }
            var browserVerson = getVerson();
            //alert(browserVerson.versions.mobile);
            guestSocketFuncs();
//layer.msg(returnCitySN["cip"]+','+returnCitySN["cname"]);
        });

        function guestSocketFuncs()
        {
            var socket = io.connect('http://'+document.domain+':8899');

            //var myID = Math.floor(Math.random()*10+1);
            //var myID = parseInt($("#page-Marking").attr("data-id"));
            var myID = 0;
            var myName = "guest";

            var dataObj = {
                myID:myID,
                myName:myName
            };
            socket.emit('guestInit', dataObj); //�������������Ϣ

            socket.on('guestChannel', function (data) {
                //refresh();
                //alert(data);
            });
//
//		socket.on('userInit', function (data) {
//			//socket.emit('message', {rp:"fine,thank you"}); //�������������Ϣ
//			$( "#messages" ).append( "<p> userInit "+data.myID + " - " + data.name + " - " + data.id +"</p>" );
//		});
//		socket.on('message', function (data) {
//			//socket.emit('message', {rp:"fine,thank you"}); //�������������Ϣ
//			$( "#messages" ).append( "<p> message "+data+"</p>" );
//		});


        }
    </script>
@endsection


@section('title','轻博吧')

@section('content')

<div class="layout-hidden">
    <span id="replace_content _none" style="display:none"></span>
    <input type="hidden" id="page-Marking" value="" data-type="Guest" data-log="loginIS"
           data-visitor="{{ (Auth::check()) ? Auth::user()->id : 0 }}"
           data-belong="guest"
           data-mine="{{ (Auth::check()) ? Auth::user()->id : 0 }}"
           data-id="{{ (Auth::check()) ? Auth::user()->id : 0 }}"
           data-ip=""
    />
</div>

{{--头部--}}
<div class="LB-page1 _mainLeft layout-header">

    <div class="header-side header-left _left" data-info="{{--左上角--}}">
        <div class="btn _option display-hide clicker _none" id="">
            <span class="btn _option clicker"><em class="iconer left-icon _bold"></em></span>
        </div>
        <div class="btn _option display-hide header-controller-option schedule_ctn show_calendar mouseover _left _none" data-show="#schedule_calendar">
            <div class=""> 日历 </div>
        </div>
    </div>
    <div class="header-center text-row _left" data-info="{{--guest.头-标题--}}"><span class="header-body">轻博吧</span></div>
    <div class="header-side header-right _right _display720" data-info="{{--右上角--}}"><span class="btn _bold show-sidebar">≡</span></div>

    <div class="header-search header-search-right1 _none"  data-info="{{--guest.查找--}}">
        <div class="search-option">
            <input type="text" class="input_ph _cfff geter_search_content" id="guest_search_content" placeholder="关键字查找……" data-placeholder="关键字查找……"
                   data-click="#guest_search_item" />
        <span class="search_query_submit geter_search " id="guest_search_item" data-belong="Guest"
              data-geter="Guest"
              data-getType="init"
              data-position="0"
              data-search="#guest_search_content"
              data-more="#guest_search_more"
              data-ctn="#guest_search_ctn"

              data-hide=".display-hide" data-show="#guest_search_ctn"
        ><em class="iconer search-icon"></em></span>
        </div>
    </div>
    <span class="showers selectorT titler" id="intermediater"></span>

</div>


{{--侧边栏--}}
<div class="layout-sidebar _sidebar120 _display721" data-info="">

    <div class="btn _hover7 sidebar-piece sidebar-portrait"><img src="/images/favcion.png" class="_hover2 " /></div>

    @if(Auth::check())
    <div class="btn _hover7 sidebarPiSp index_home"><span class="option-title">返回主页</span></div>
    @else
    <div class="btn _hover7 sidebarPiSp index_log showUserLog"><span class="option-title"> 登录 </span></div>
    @endif

    <div class="btn _hover7 BoxRow" title="" data-info="{{--首页--}}">
        <div class="_option menu-option" id="guestAll"
             data-show="#guest_ctn"
             data-clicker="#get-Guest"
             data-titler-text="轻博吧"
             data-url="/guest/all"
        ><span class="option-title"><em class="iconer mine-icon"></em><span class="texter">全部</span></span></div>
    </div>
    <div class="btn _hover7 BoxRow" title="" data-info="{{--时刻--}}">
        <div class="_option menu-option" id="guestTimer"
             data-show="#timer_guest_ctn"
             data-clicker="#get-GuestTimer"
             data-titler-text="轻博日程"
             data-url="/guest/timer"
        ><span class="option-title"><em class="iconer timer-icon"></em><span class="texter">日程</span></span></div>
    </div>
    <div class="btn _hover7 BoxRow" title="" data-info="{{--提问--}}">
        <div class="_option menu-option" id="guestAsk"
             data-show="#askbar_guest_ctn"
             data-clicker="#get-GuestAskbar"
             data-titler-text="轻博提问"
             data-url="/guest/ask"
        ><span class="option-title"><em class="iconer ask-icon"></em><span class="texter">提问</span></span></div>
    </div>
    <div class="btn _hover7 BoxRow" title="" data-info="{{--商品--}}">
        <div class="_option menu-option" id="guestGoods"
             data-show="#store_guest_ctn"
             data-clicker="#get-GuestStore"
             data-titler-text="轻博商品"
             data-url="/guest/goods"
        ><span class="option-title"><em class="iconer iconfont icon-cart"></em><span class="texter">商品</span></span></div>
    </div>
    <div class="btn _hover7 BoxRow sidebar-piece-special" title="" data-info="{{--闲置--}}">
        <div class="_option menu-option" id="guestGive"
             data-show="#give_guest_ctn"
             data-clicker="#get-Give"
             data-titler-text="闲置免费送"
             data-url="/guest/give"
        ><span class="option-title"><em class="iconer give-icon"></em><span class="texter">闲置</span></span></div>
    </div>

    <div class="btn _hover7 BoxRow  MarT1" title="" data-info="日历">
        <div class="_option menu-option clicker" id="float_calendar"
             data-show="#schedule_calendar .show_calendar"
             data-clicker=".geter-Schedule"
        ><span class="option-title"><em class="iconer agenda-icon"></em><span class="texter">日历</span></span></div>
    </div>

</div>
<div class="layout-sidebar-back btn _none"></div>


{{--游客搜索--}}
<div class="LB-page _mainLeft display-hide" id="guest_search_ctn" data-info="{{--游客搜索--}}">
    <div class="LB-page1 _mainLeft120 layout-header">
        <div class="header-left _left"><span class="btn _option clicker"><em class="iconer left-icon _bold"></em></span></div>
        <div class="header-center text-row _left"><span></span></div>
        <div class="header-right _right _display720"><span class="btn _bold show-sidebar">···</span></div>
    </div>
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="item-container more geter_search" id="guest_search_more"  data-belong="Guest" data-geter="Guest" data-ctn="#guest_search_ctn"
             data-permission="Guest" data-content="" data-getType="more" data-position="">更多</div>
    </div>
</div>


{{--游客全部--}}
<div class="geterDisp" id="get-Guest"  data-geter="{{config('display.geter.guest.all')}}" data-ctn="#guest_ctn"
     data-update="y" data-permission="Guest" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="guest_ctn" data-info="{{--轻博吧--}}">
    <div class="item-page">
        <div class="entity_ctn"></div>
        <div class="item-container more geterDisp"  data-geter="{{config('display.geter.guest.all')}}" data-ctn="#guest_ctn"
             data-update="y" data-permission="Guest" data-type="more" data-operate="more" data-position="">更多</div>
    </div>
</div>


{{--游客时刻--}}
<div class="geterDisp" id="get-GuestTimer" data-geter="{{config('display.geter.guest.timer')}}" data-ctn="#timer_guest_ctn"
     data-update="y" data-permission="Guest" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="timer_guest_ctn" data-info="{{--时刻--}}">
    <div class="item-page">
        <div class="entity_ctn"></div>
        <div class="item-container more geter"  data-geter="{{config('display.geter.guest.timer')}}" data-ctn="#timer_guest_ctn"
             data-update="y" data-permission="Guest" data-type="more" data-operate="more" data-position="">更多</div>
    </div>
</div>


{{--游客求助--}}
<div class="geterDisp" id="get-GuestAskbar"  data-geter="{{config('display.geter.guest.ask')}}" data-ctn="#askbar_guest_ctn"
     data-update="y" data-permission="Guest" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="askbar_guest_ctn" data-info="{{--提问--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geter"  data-geter="{{config('display.geter.guest.ask')}}" data-ctn="#askbar_guest_ctn"
             data-update="y" data-permission="Guest" data-type="more" data-operate="more" data-position="">更多</div>
    </div>
</div>


{{--游客商品--}}
<div class="geterDisp" id="get-GuestStore"  data-geter="{{config('display.geter.guest.goods')}}" data-ctn="#store_guest_ctn"
     data-update="y" data-permission="Guest" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="store_guest_ctn" data-info="{{--商品--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geter"  data-geter="{{config('display.geter.guest.goods')}}" data-ctn="#store_guest_ctn"
             data-update="y" data-permission="Guest" data-type="more" data-operate="more" data-position="">更多</div>
    </div>
</div>


{{--游客免费送--}}
<div class="geterDisp" id="get-Give"  data-geter="{{config('display.geter.guest.give')}}" data-ctn="#give_guest_ctn"
     data-update="y" data-permission="Guest" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="give_guest_ctn" data-info="{{--免费送--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geter"  data-geter="{{config('display.geter.guest.give')}}" data-ctn="#give_guest_ctn"
             data-update="y" data-permission="Guest" data-type="more" data-operate="more" data-position="">更多</div>
    </div>
</div>


{{--日历--}}
<input type="hidden" class="geter-Schedule clicker" data-geter="{{config('display.geter.guest.schedule')}}"
    data-clicker="#show_calendar"/>
<div class="LB-page _mainLeft display-hide" id="schedule_clone" data-display="schedule">
    <div class=" item-page">
        <div class="entity_ctn"></div>
    </div>
</div>
<div class="LB-page _mainLeft display-hide" id="schedule_ctn">
    <div class=" item-page">
        <div class="entity_ctn"></div>
    </div>
</div>


	@include('tools.tool')
	@include('tools.adder')
	@include('tools.time')

@endsection
