@extends('master')

@section('MySpecial')
	{{--include('homeMaster')--}}
	<link rel="stylesheet" type="text/css" href="/css/session.css" />
	<script type="text/javascript" src="/js/session.js"></script>
    <script>
        jQuery( function($) {
            $("#sidebar-mine").click();
//            var clientWidth = getClientWidth();//alert(clientWidth);
//            var screenWidth = getScreenWidth();//alert(screenWidth);
//            if(clientWidth <= 720) {
//                $("#footer-mine").click();
//            } else if( (clientWidth > 720) && (clientWidth <= 1024) ) {
//                $("#sidebar-mine").click();
//            } else if(clientWidth > 1024) {
//                $("#sidebar-mine").click();
//            }
//            var browserVerson = getVerson();
            //alert(browserVerson.versions.mobile);

            socketFuncs();
        });

        function socketFuncs()
        {
            //var socket = io.connect('http://longyun.pub:8899');
            var socket = io.connect('http://'+document.domain+':8899');

            //var myID = Math.floor(Math.random()*10+1);
            var myID = parseInt($("#page-Marking").attr("data-id"));
            var myName = "home";

            var dataObj = {
            myID:myID,
            myName:myName
            };
            socket.emit('userInit', dataObj); //�������������Ϣ

            socket.on('sessionChannel', function (data) {
            refresh();
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

@section('title','我的主页')

@section('content')
<div class="layout-hidden">
    <span id="replace_content _none" style="display:none"></span>
    <input type="hidden" id="page-Marking" value=""
           data-type="Home"
           data-visitor="{{ Auth::id() }}"
           data-belong="{{ Auth::id() }}"
           data-mine="{{ Auth::id() }}"
           data-ip=""
    />
    <input type="hidden" class="" id="card-marking" data-info="名片 标记" />
    <input type="hidden" class="" id="working-marking" data-info="会话 标记" />
</div>

{{--home.header 头部--}}
<div class="LB-page1 _mainLeft layout-header" data-info="{{--home.header--}}">

    <div class="header-side header-left _left" data-info="{{--左边容器--}}">
        <div class="btn _option display-hide header-backer clicker _none " data-clicker="" id="header-backer" data-info="返回">
            <div class="_f12 " id="header-backer-title">〈 </div>
        </div>
    </div>
    <div class="header-center" data-info="{{--中间容器--}}">
        <div class="btn _option" id="header-title" data-info="{{--头-标题--}}">
            <span class="header-body text-row"> 全部信息 </span>
            <span class="_hover7 mouseover display-hide" data-show="#schedule_calendar" id="header-calendar"></span>
        </div>
    </div>
    <div class="header-side header-right _right _display720" data-info="{{--右边容器--}}"><span class="btn _bold show-sidebar">≡</span></div>

    <div class="header-search header-search-right1 _display1024s _none" data-info="{{--查找--}}">
        <div class="search-option">
            <input  type="text" class="input_ph _cfff _bg1 geter_search_content" id="search_tag" placeholder="查找 我的 …" data-placeholder="查找 我的 …"
                    data-click="#search_confirm" >
        <span class=" search_confirms search_query_submit geter_search shower titler" id="search_confirm" data-belong="{{ Session::get('mine') }}"
              data-geter="MINE"
              data-type=""
              data-getType="init"
              data-position="0"
              data-search="#search_tag"
              data-more="#search_more"
              data-ctn="#home_search_ctn"
              data-hide=".display-hide"
              data-show="#home_search_ctn"
              data-titler-target=".header-body" data-titler-text="查找"
        ><em class="iconer search-icon"></em></span>
            <span class="btn search_return _none" id="search_return" data-click="">Back</span>
        </div>
    </div>
    <div class="header-search header-search-right2 _display1024s _none" data-info="{{--home.查找 user--}}">
        <div class="search-option" data-info="查找 user">
            <input type="text" class="input_ph _f12 _cfff _bg1" id="search_content" placeholder="找人 ……" data-placeholder="找人……" />
        <span class="btn menu_btn_single shower search_query_submit" id="search_user"
              data-hide=".display-hide"
              data-show="#search_user_ctn"
        ><em class="iconer search-icon"></em></span>
        </div>
    </div>

</div>


{{--边栏--}}
<div class="layout-sidebar sidebar _display721" data-info="{{--home.sidebar--}}">

    <div class="btn _hover7 sidebar-piece sidebar-portrait" title="设置" data-info="{{--头像设置--}}">
        <div class="_option sidebar-portrait" id="show-setting"
             data-show="#setting-page" data-titler-text="设置"
        ><img src="/images/portrait/user{{ Auth::id() }}.jpg" /></div>
        <span class="option-title _none"> {{ Session::get('setting_show') }} </span>
    </div>

    <div class="btn _hover7 sidebarPiSp" title="退出">
        <div class="_option logout"><span class="option-title"> 退出 </span></div>
    </div>

    <div class="sidebar-row">
    <div class="btn _hover7 BoxRow sidebarPiSp" title="adder">

        <div class="_option clicker" data-clicker="#show_add_note">
        <span class="option-title menu-option"
              data-show="#item-adder"
        ><em class="adder-icon _f20 _bold"></em></span>
        </div>

    </div>

    <div class="btn _hover7 BoxRow" title="我的全部信息" data-info="{{--我的全部信息--}}">
        <div class="_option menu-option LB-Mark showerH clicker" id="sidebar-mine"
             data-show="#mine_ctn"
             data-titler-text="全部信息"
             data-clicker="#get-Mine"
        ><span class="option-title"><em class="iconer mine-icon"></em><span class="texter"> 我 ≡ </span></span></div>
    </div>
    </div>

    <div class="sidebar-row">
    <div class="btn _hover7 BoxRow" title="待办事" data-info="{{--待办事--}}">
        <div class="_option menu-option LB-Mark showerH clicker" id="side-work"
             data-show="#unfinised_ctn"
             data-titler-text="我的待办事"
             data-clicker="#get-MyUnfinished"
        ><span class="option-title">
                <em class="iconer work-icon"></em><span class="texter"> 待办 {{ Session::get('unfinished') or '' }} </span></span>
            <span class="menu_text _box1 p-rightop1 works_count _none" data-num="0">{{ Session::get('unfinished') or '' }}</span>
        </div>
    </div>
    <div class="btn _hover7 BoxRow" title="日程" data-info="{{--日程--}}">
        <div class="_option menu-option" id="side-agenda"
             data-show="#header-calendar #schedule_calendar .show_calendar"
             data-titler-text="我的日程"
             data-clicker=".geter-Schedule"
        ><span class="option-title"><em class="iconer agenda-icon"></em><span class="texter"> 日程 </span></span></div>
    </div>
    </div>

    <div class="sidebar-row">
    <div class="btn _hover7 BoxRow" title="求助" data-info="{{--求助--}}">
        <div class="_option menu-option" id="side-ask"
             data-show="#Home_askbar_ctn"
             data-LB="#Home_askbar_ctn"
             data-titler-text="我的求助"
             data-clicker="#get-MyAskbar"
        ><span class="option-title text-row"><em class="iconer ask-icon"></em><span class="texter"> 提问 </span></span></div>
    </div>
    <div class="btn _hover7 BoxRow" title="商品" data-info="{{--商品--}}">
        <div class="_option menu-option" id="side-goods"
             data-show="#Home_store_ctn"
             data-LB="#Home_store_ctn"
             data-titler-text="我的商品"
             data-clicker="#get-MyStore"
        ><span class="option-title"><em class="iconer goods-icon"></em><span class="texter"> 商品 </span></span></div>
    </div>
    </div>

    <div class="sidebar-row">
    <div class="btn _hover7 BoxRow" data-info="{{--收藏--}}">
        <div class="_option menu-option" id="sidebar-collect"
             data-show="#Home_collect_ctn"
             data-LB="#Home_collect_ctn"
             data-titler-text="我的收藏"
             data-clicker="#get-myCollection"
        ><span class="option-title"><em class="iconer collect-icon"></em><span class="texter"> 收藏 </span></span></div>
    </div>
    {{----}}
    <div class="btn _hover7 BoxRow _none" data-info="{{--闲置免费送--}}">
    </div>

    <div class="btn _hover7 BoxRow _none" data-info="{{--密友圈--}}">
        <div class="_option menu-option" id="side-friend"
             data-hide=".display-hide"
             data-show="#header-float-friend #friends_ctn"
             data-LB="#friends_ctn"
             data-titler-text="密友圈"
             data-clicker="#get-Friends"
        ><span class="option-title"><em class="iconer discover-icon"></em><span class="texter"> 密友圈 </span></span></div>
    </div>

    <div class="btn _hover7 BoxRow" data-info="{{--我的关注--}}">
            <div class="_option menu-option" id="side-friend"
                 data-hide=".display-hide"
                 data-show="#header-float-friend #friends_ctn"
                 data-LB="#friends_ctn"
                 data-titler-text="我的关注"
                 data-clicker="#get-Friends"
            ><span class="option-title"><em class="iconer discover-icon"></em><span class="texter"> 关注 </span></span></div>
        </div>
    <div class="btn _hover7 BoxRow" data-info="{{--全站推荐--}}">
        <a class="_option menu-option LB-Mark showerH clicker backer_Me" id="side-guest"
           href="/guest" target="_blank"
        ><span class="option-title"><em class="iconer guest-icon"></em><span class="texter"> 推荐 </span></span></a>
    </div>
    <div class="btn _hover7 BoxRow _none" data-info="{{--全站推荐--}}">
        <div class="_option menu-option" id="side-guest"
             data-show="#header-float-recommend #guest_ctn"
             data-LB="#guest_ctn"
             data-titler-text="全站推荐"
             data-clicker="#get-Guest"
        ><span class="option-title"><em class="iconer guest-icon"></em><span class="texter"> 推荐 </span></span></div>
    </div>
    </div>

    <div class="sidebar-row">
    <div class="btn _hover7 BoxRow" data-info="{{--收件箱--}}">
        <div class="_option menu-option" id="sidebar-pmin"
             data-show="#pmbox_ctn"
             data-titler-text="私信箱"
             data-clicker="#get-PMAll"
        ><span class="option-title"><em class="iconer pmin-icon"></em><span class="texter"> 私信 {{ Session::get('PM_unread') or '' }} </span></span>
            <span class="pm_dom _dom  _none" id=""></span>
        <span class="menu_text _box1 p-rightop1 _num pm_num {{ Session::get('PM_isset') or '' }}" data-num="{{ Session::get('PM_unread') or '' }}">
            {{ Session::get('PM_unread') or '' }}
        </span>
        </div>
    </div>
    <div class="btn _hover7 BoxRow _none" data-info="{{--收件箱--}}">
        <div class="_option menu-option" id="sidebar-pmin"
             data-show="#inbox_ctn"
             data-titler-text="收件箱"
             data-clicker="#get-PMIn"
        ><span class="option-title"><em class="iconer pmin-icon"></em><span class="texter"> 收件 {{ Session::get('PM_unread') or '' }} </span></span>
            <span class="pm_dom _dom  _none" id=""></span>
        <span class="menu_text _box1 p-rightop1 _num pm_num {{ Session::get('PM_isset') or '' }}" data-num="{{ Session::get('PM_unread') or '' }}">
            {{ Session::get('PM_unread') or '' }}
        </span>
        </div>
    </div>
    <div class="btn _hover7 BoxRow _none" data-info="{{--发件箱--}}">
        <div class="_option menu-option" id="sidebar-pmout"
             data-show="#outbox_ctn"
             data-titler-text="收件箱"
             data-clicker="#get-PMOut"
        ><span class="option-title text-row"><em class="iconer pmout-icon"></em><span class="texter"> 发件 </span></span></div>
    </div>
    <div class="btn _hover7 BoxRow" data-info="{{--消息--}}" data-info="{{----}}">
        <div class="_option menu-option" id="sidebar-news"
             data-hide=".display-hide"
             data-show="#news_ctn"
             data-titler-text="消息"
             data-clicker="#get-News"
        ><span class="option-title"><em class="iconer news-icon"></em><span class="texter"> 消息 </span></span>
            <span class="news_dom inbox-rightop _dom _none" id="menu_news_dom"></span>
        <span class="menu_text _box1 p-rightop1 _num news_num {{ Session::get('newsIsset') or '' }} " data-num="{{ Session::get('newsUnread') or '' }}">
            {{ Session::get('newsUnread') or '' }}
        </span>
        </div>
    </div>
    </div>

    <div class="sidebar-row">
    <div class="btn _hover7 BoxRow _display1281" data-info="{{--会话--}}">
        <div class="_option menu-option screen-shower" id="side-session-UOE"
             data-show="#session-container"
             data-hide=".session-dom"
             data-clicker="#session-session-UOE"
        ><span class="option-title "><em class="iconer chat-icon"></em><span class="texter"> 对话 </span></span></div>
        <span class="session-dom inbox-rightop _dom _none"></span>
    </div>
    <div class="btn _hover7 BoxRow _display1281" data-info="{{--联系人--}}">
        <div class="_option menu-option shower screen-showers" id="side-connection-UOE"
             data-show="#linkman-list-ctn"
             data-titler-text="我的好友"
             data-clicker="#get-people"
        ><span class="option-title "><em class="iconer connect-icon"></em><span class="texter"> 好友 </span></span></div>
    </div>
    </div>


</div>
<div class="layout-sidebar-back btn _none"></div>


<div class="connection-geter" id="get-people"
     data-update="y" data-sort="{{config('relation.get.sort.friend')}}" data-ctn="#linkman-list-ctn .list-page"></div>
<div class="connection-geter" data-update="y" data-sort="{{config('relation.get.sort.follow')}}" data-ctn="#follow-list-ctn"></div>
<div class="connection-geter" data-update="y" data-sort="{{config('relation.get.sort.fans')}}" data-ctn="#fans-list-ctn"></div>

<div class="connection-ctrl-PE" data-update="y" id="get-MyGroup" data-type="getGroup" data-ctn="#session-list-group .session-display"></div>
<div class="connection-ctrl-PE" data-update="y" id="get-MyProject" data-type="getProject" data-ctn="#project_container .session-display"></div>


<div class="LB-page _mainLeft display-hide _none" id="session-list-ctn"><div class="list-page"></div></div>
<div class="LB-page _mainLeft display-hide _none" id="linkman-list-ctn"><div class="list-page"></div></div>
<div class="LB-page _mainLeft display-hide _none" id="follow-list-ctn"><div class="list-page"></div></div>
<div class="LB-page _mainLeft display-hide _none" id="fans-list-ctn"><div class="list-page"></div></div>


<div id="card-markingss" class="shower set_backer_connect" data-show="#mobile-card #header-backer" ></div>


{{-- PC端 会话 session-container--}}
<div class="session-container session-hiders _none" id="session-container" data-info="{{--会话--}}">
    <div class="session-ctn">

        <span class="_hoverB _bolds session_hider session-hider"><em class="iconer closer-icon"></em></span>

        <div class="session-left-ctn" id="">
            <div class="_hoverB seesion-menu-option shower session-shower-control" id="session-session-UOE" data-info="{{--会话--}}"
                 data-update="y" data-permission="MINE"
                 data-type="getSession"
                 data-ctn="#session_container .session-display"
                 data-hide=".session-list-container"
                 data-show="#session-list-session"
                 data-selector=".seesion-menu-option" data-selected="selected_4"
                 data-click="#"
            ><span class="option-text"> 会话 </span></div>
            <div class="_hoverB seesion-menu-option shower clicker" id="session-linkman-UOE" data-info="{{--好友--}}"
                 data-hide=".session-list-container"
                 data-show="#session-list-linkman"
                 data-selector=".seesion-menu-option" data-selected="selected_4"
                 data-clicker="#get-MyLinkman"
            ><span class="option-text"> 好友 </span></div>
            <div class="_hoverB seesion-menu-option shower clicker" id="session-follow-UOE" data-info="{{--关注--}}"
                 data-hide=".session-list-container"
                 data-show="#session-list-follow"
                 data-selector=".seesion-menu-option" data-selected="selected_4"
                 data-clicker="#get-MyFollow"
            ><span class="option-text"> 关注 </span></div>
            <div class="_hoverB seesion-menu-option shower clicker" id="session-fans-UOE" data-info="{{--粉丝--}}"
                 data-hide=".session-list-container"
                 data-show="#session-list-fans"
                 data-selector=".seesion-menu-option" data-selected="selected_4"
                 data-clicker="#get-MyFans"
            ><span class="option-text"> 粉丝 </span></div>
            <div class="_hoverB seesion-menu-option shower clicker _none" id="session-group-UOE" data-info="{{--群/组--}}"
                 data-hide=".session-list-container"
                 data-show="#group_container"
                 data-selector=".seesion-menu-option" data-selected="selected_4"
                 data-clicker="#get-MyGroup"
            ><span class="option-text"> 群/组 </span></div>
            <div class="_hoverB seesion-menu-option shower clicker _none" id="session-project-UOE" data-info="{{--项目--}}"
                 data-hide=".session-list-container"
                 data-show="#project_container"
                 data-selector=".seesion-menu-option" data-selected="selected_4"
                 data-clicker="#get-MyProject"
            ><span class="option-text"> 项目 </span></div>
        </div>

        <div class="session-center-ctn" id="">
            <div class="session-list-container session-list-option" id="session-list-session"><div class="session-display"> session_container </div></div>
            <div class="session-list-container session-list-option" id="session-list-linkman"><div class="session-display"> linkman_container </div></div>
            <div class="session-list-container session-list-option" id="session-list-follow"><div class="session-display"> follow_container </div></div>
            <div class="session-list-container session-list-option" id="session-list-fans"><div class="session-display"> fans_container </div></div>
            <div class="session-list-container session-list-option" id="session-list-group"><div class="session-display"> group_container </div></div>
            <div class="session-list-container session-list-option" id="session-list-project"><div class="session-display"> project_container </div></div>
        </div>

        <div class="session-right-ctn" id="">
            <div class="working-page session-working-clone" id=""></div>
            <div class="working-page session_work_ctn" id="session-card" data-info="{{-- PC端 名片 #session-card --}}">
                <div class="session-card-row session-card-header"><div class="session-card-portrait"><img class="card-portrait" src=""></div></div>
                <div class="session-card-row"><span class="session-text card-name _f18 _bold"></span></div>
                <div class="session-card-row"><span class="session-text card-id _f14 _bold"></span></div>
                <div class="session-card-row"><span class="session-text session-btn card-relation card_relation_btn  _f14"></span></div>
                <div class="session-card-row card-relation-tools _none">
                    <span class="btn-hover _f14 session-text session-btn card_confirm"> 确认 </span>
                    <span class="btn-hover _f14 session-text session-btn card_cansel"> 取消 </span>
                </div>
                <div class="session-card-row"><span class="session-text card-autograph _f14"></span></div>
                <div class="session-card-row"></div>
                <div class="session-card-row">
                    <div class="session-card-box">
                        <div class="btn session-card-tool card-to-chat _left"> 聊天 </div>
                        <div class="btn session-card-tool card-to-message _right"> 私信 </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


{{-- 名片 card --}}
<div class="display-hide box-page stop-window-scroll _none" id="card-box" data-info="{{--名片--}}">
<div class="entity-ctn">
    <div class="card-container card-back-white card-header">
        <div class="card-portrait">
            <img  src="/images/portrait//user{{ Auth::user()->id }}.jpg"></div>
        <div class="card-body"><span class="_bold card-name">测试账号名字</span><span class="card-relation-text _right">互相关注</span></div>
    </div>

    <div class="card-container card-back-white">
        <div class="card-title">个性签名</div>
        <div class="card-body">
            <span class="card-autograph">当我不去想我是谁的时候我是谁？当我不去想我是谁的时候我是谁？当我不去想我是谁的时候我是谁？</span>
        </div>
    </div>

    <div class="card-container">
        <div class="btn card-btn card-btn-special" data-info="{{--聊天--}}">
            <div class="btn card-to-chat">发消息</div>
        </div>
        <div class="btn card-btn" data-info="{{--私信--}}">
            <div class="btn card-to-message">私信</div>
        </div>
        <div class="btn card-btn card-relation-tool _none" data-info="{{--关系--}}">
            <div class="btn card-operate-relation">取消关注</div>
        </div>
    </div>

    <div class="card-container card-back-white card-tool-ctn _none">
        <div class="btn card-btn card-btn-special">
            <span class="card_confirm">确认</span>
        </div>
        <div class="btn card-btn">
            <span class="card_cansel">取消</span>
        </div>
    </div>

    <div class="card-container _none">
    </div>

</div>
</div>
{{-- Mobile 会话 mobile-working --}}
<div class="LB-page _mainLeft mobile-page display-hide working-page list-page mobile-working mobile-working-clone _none" id=""
     data-session="" data-operate=""
     data-sort="" data-type=""
     data-belong="" data-item=""
     data-position="bottom"
>
    <span class="working-adder" data-object="0" data-reply=""></span>
    <div class="working-reset"></div>
    <div class="mobile-working-header"></div>
    <div class="mobile-working-body working-communication"></div>
    <div class="mobile-working-footer fixed-foot" data-role="footer" data-position="fixed" data-tap-toggle="false" data-fullscreen="true">
        <div class="working-input-ctn"><textarea class="working-input" placeholder=""></textarea></div>
    </div>
</div>


<div class="geterDisp" id="get-"  data-geter="" data-ctn="#"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>




{{--查找 ITEM--}}
<div class="LB-page _mainLeft display-hide" id="home_search_ctn" data-info="{{--查找 ITEM--}}">
    <div class="entity_ctn"></div>
    <div class="more geter_search" id="search_more"  data-belong="{{ Session::get('mine') or '' }}"
         data-geter="MINE" data-ctn="#home_search_ctn" data-content="" data-permission="MINE" data-getType="more" data-position=""> 更多 </div>
</div>

{{--设置 setting--}}
<div class="geterDisp" id="get-MySetting"  data-geter="MySetting" data-ctn="#setting-page"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"
></div>
<div class="LB-page _mainLeft display-hide" id="setting-page" data-info="设置 setting">
    <div class="item-page">
        <div class="entity_ctn"></div>
    </div>
</div>

{{--消息 news--}}
<div class="geterDisp" id="get-News" data-geter="News" data-ctn="#news_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"
></div>
<div class="LB-page _mainLeft display-hide" id="news_ctn" data-info="{{--消息--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp"  data-geter="News" data-ctn="#news_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>


{{--我的全部信息--}}
<div class="geterDisp" id="get-Mine" data-geter="{{config('display.geter.home.mine')}}" data-geter-sort="Mine" data-ctn="#mine_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="mine_ctn" data-info="{{--我的全部信息--}}">
    <div class=" item-page">
        <div class="item-container _none"> 全部 </div>
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.mine')}}" data-geter-sort="Mine" data-ctn="#mine_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>

{{--日历--}}
<input type="hidden" class="geter-Schedule clicker" data-geter="{{config('display.geter.home.schedule')}}"
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


{{--收件箱 pmAll--}}
<div class="geterDisp" id="get-PMAll" data-geter="{{config('display.geter.home.pm')}}" data-geter-sort="Mine" data-ctn="#pmbox_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="pmbox_ctn" data-info="{{--收件箱--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.pm')}}" data-geter-sort="Mine" data-ctn="#pmbox_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position="" > 更多 </div>
    </div>
</div>
{{--收件箱 pmOut--}}
<div class="geterDisp" id="get-PMIn" data-geter="{{config('display.geter.home.pmIn')}}" data-geter-sort="Mine" data-ctn="#inbox_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="inbox_ctn" data-info="{{--收件箱--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.pmIn')}}" data-geter-sort="Mine" data-ctn="#inbox_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position="" > 更多 </div>
    </div>
</div>
{{--发件箱 pmIn--}}
<div class="geterDisp" id="get-PMOut" data-geter="{{config('display.geter.home.pmOut')}}" data-geter-sort="Mine" data-ctn="#outbox_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"></div>
<div class="LB-page _mainLeft display-hide" id="outbox_ctn" data-info="{{--发件箱--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.pmOut')}}" data-geter-sort="Mine" data-ctn="#outbox_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position="" > 更多发件 </div>
    </div>
</div>


{{--待办 ing--}}
<div class="geterDisp" id="get-MyUnfinished"  data-geter="{{config('display.geter.home.working')}}" data-geter-sort="Mine" data-ctn="#unfinised_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="unfinised_ctn" data-info="{{--待办--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
    </div>
</div>
{{--待办 已完成--}}
<div class="geterDisp" id="get-MyFinished" data-geter="{{config('display.geter.home.finished')}}" data-geter-sort="Mine" data-ctn="#finised_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="finised_ctn" data-info="{{--已完成--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.finished')}}" data-geter-sort="Mine" data-ctn="#finised_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>
{{--我的笔记--}}
<div class="geterDisp" id="get-MyNotebook" data-geter="{{config('display.geter.home.note')}}" data-geter-sort="Mine" data-ctn="#notebook_mine_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="notebook_mine_ctn" data-info="{{--我的笔记--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.note')}}" data-geter-sort="Mine" data-ctn="#notebook_mine_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>
{{--我的求助--}}
<div class="geterDisp" id="get-MyAskbar" data-geter="{{config('display.geter.home.ask')}}" data-geter-sort="Mine" data-ctn="#Home_askbar_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="Home_askbar_ctn" data-info="{{--我的求助--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.ask')}}" data-geter-sort="Mine" data-ctn="#Home_askbar_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>
{{--我的帮助--}}
<div class="LB-page _mainLeft  item-page display-hide" id="helpbar_mine_ctn" data-info="{{--我的帮助--}}">
    <div class="entity_ctn"></div>
    <div class="more geterDisp" data-update="y" data-permission="MINE"
         data-type="more" data-geter="MyHelpbar" data-operate="more" data-position="" data-ctn="#helpbar_mine_ctn"
    >更多</div>
</div>
{{--发布 微博&朋友圈--}}
<div class="geterDisp" id="get-MyUtterance"  data-geter="{{config('display.geter.home.word')}}" data-geter-sort="Mine" data-ctn="#release_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="release_ctn" data-info="{{--发布--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp"  data-geter="MyRelease" data-ctn="#release_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>
{{--我的商品--}}
<div class="geterDisp" id="get-MyStore" data-geter="{{config('display.geter.home.goods')}}" data-geter-sort="Mine" data-ctn="#Home_store_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="Home_store_ctn" data-info="{{--我的商品--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.goods')}}" data-geter-sort="Mine" data-ctn="#Home_store_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>


{{--我的收藏--}}
<div class="geterDisp" id="get-myCollection" data-geter="{{config('display.geter.home.collect')}}" data-geter-sort="Others" data-ctn="#Home_collect_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"
></div>
<div class="LB-page _mainLeft display-hide" id="Home_collect_ctn" data-display="collection" data-info="{{--我的收藏--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.collect')}}" data-geter-sort="Others" data-ctn="#Home_collect_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position="" >更多</div>
    </div>
</div>


{{--好友圈--}}
<div class="geterDisp" id="get-Friends" data-geter="{{config('display.geter.home.friend')}}" data-geter-sort="Friend" data-ctn="#friends_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"></div>
<div class="LB-page _mainLeft display-hide" id="friends_ctn" data-info="{{--好友圈--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.friend')}}" data-geter-sort="Friend" data-ctn="#friends_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>

{{--好友时刻--}}
<div class="geterDisp" id="get-FriTimer" data-geter="{{config('display.geter.home.friTimer')}}" data-geter-sort="Friend" data-ctn="#fri-timer-ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0" ></div>
<div class="LB-page _mainLeft display-hide" id="fri-timer-ctn" data-info="{{--好友时刻--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.friTimer')}}" data-geter-sort="Friend" data-ctn="#fri-timer-ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>
{{--好友求助--}}
<div class="geterDisp" id="get-FriAskbar" data-geter="{{config('display.geter.home.friAsk')}}" data-geter-sort="Friend" data-ctn="#fri_askbar_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"></div>
<div class="LB-page _mainLeft display-hide" id="fri_askbar_ctn" data-info="{{--好友提问--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.friAsk')}}" data-geter-sort="Friend" data-ctn="#fri_askbar_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>
{{--好友商品--}}
<div class="geterDisp" id="get-FriStore" data-geter="{{config('display.geter.home.friGoods')}}" data-geter-sort="Friend" data-ctn="#fri_store_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"></div>
<div class="LB-page _mainLeft display-hide" id="fri_store_ctn" data-info="{{--好友商品--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.friGoods')}}" data-geter-sort="Friend" data-ctn="#fri_store_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>



{{--闲置免费送--}}
<div class="geterDisp" id="get-Give" data-geter="{{config('display.geter.home.give')}}" data-geter-sort="Mine" data-ctn="#give_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"></div>
<div class="LB-page _mainLeft display-hide" id="give_ctn" data-info="{{--闲置免费送--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-geter="{{config('display.geter.home.give')}}" data-geter-sort="Mine" data-ctn="#fri_store_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>


{{--全站推荐--}}
<div class="geterDisp" id="get-Guest"  data-geter="Guest" data-ctn="#guest_ctn"
     data-update="y" data-permission="MINE" data-type="get" data-operate="init" data-position="0"></div>
<div class="LB-page _mainLeft display-hide" id="guest_ctn" data-info="{{--游客推荐--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp"  data-geter="Guest" data-ctn="#guest_ctn"
             data-update="y" data-permission="MINE" data-type="more" data-operate="more" data-position=""> 更多 </div>
    </div>
</div>


<div class="LB-page _mainLeft display-hide" id="search_user_ctn" data-info="{{--查找用户--}}">
    <div class=" item-page">
        <div class="entity_ctn"></div>
        <div class="more geterDisp" data-update="y" data-permission="MINE" >更多</div>
    </div>
</div>
<div class="LB-page _mainLeft display-hide" id="user_card_ctn" data-info="{{--用户主页--}}">
    <div class="info_ctn"></div>
    <div class="entity_ctn"></div>
    <div class="more geterDisp" data-update="y" data-permission="MINE"  > 更多 </div>
</div>


<div class="layout-sidebar-display _none" id="">
    <div class="sidebar-display-ctrl" id="sidebar-display-ctrl" title="收起边栏" value="r">
        <div class="sidebar-icon sidebar-right"></div>
    </div>
    <div class="sidebar-display-ctn">
    </div>
</div>


	@include('tools.tool')
	@include('tools.adder')
	@include('tools.time')

@endsection
