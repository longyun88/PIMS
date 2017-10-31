@extends('master')

@section('MySpecial')
	{{--本页面的特殊引用 css or js 文件--}}
	<script>
        jQuery( function($) {

            $("#HIS-ALL").click();
//            var clientWidth = getClientWidth();//alert(clientWidth);
//            var screenWidth = getScreenWidth();//alert(screenWidth);
//            if(clientWidth <= 720) {
//                $("#HIS-ALL").click();
//            } else if( (clientWidth > 720) && (clientWidth <= 1280) ) {
//                $("#HIS-ALL").click();
//            } else if(clientWidth > 1280) {
//                $("#HIS-ALL").click();
//            }
            //var browserVerson = getVerson();
            //alert(browserVerson.versions.mobile);
        });
    </script>
@endsection

@section('title')
	{{ $user['name'] or '' }}的主页
@endsection


@section('content')

	<div class="layout-hidden _none">
		<span id="replace_content" style="display:none"></span>
		<input type="hidden" id="session_key" value="">
		<input type="hidden" id="page-Marking" value=""
			   data-type="User"
			   data-log=""
               data-belong="{{ $user['id'] or '' }}"
			   data-visitor="{{ Auth::check() ? Auth::id() : 0 }}"
			   data-mine="{{ Auth::check() ? Auth::id() : 0 }}"
		/>
	</div>

	{{--头部--}}
	<div class="layout-header _mainLeft layout-B">

		<div class="header-side header-left _left" data-info="{{--左上角--}}">
		</div>
		<div class="header-side header-right _right" data-info="{{--右上角--}}">
			<div class="_option _hover2 display-hide _none" data-info="{{----}}">
				<div class="_option shower mouseover" id="" data-info="主页"
					 data-show="#menu_mine_ctn"
					 data-hide=".layout-float"
				><span class="option-title"> · · · </span></div>
			</div>
			<div class="_option _hover2 display-hide _none" data-info="{{----}}">
				<div class="_option shower mouseover" id="" data-info="好友圈"
					 data-show="#menu_friend_ctn"
					 data-hide=".layout-float"
				><span class="option-title"> · · · </span></div>
			</div>
		</div>
		<div class="header-center" data-info="{{--中间容器--}}">
			<div class="btn _option header-body text-row" data-info="{{--头-标题--}}"></div>
		</div>

		<div class="header-search header-search-right1 _none"  data-info="{{--查找--}}">
			<div class="search-option">
				<input  type="text" class="input_ph _cfff _bg1 geter_search_content" id="u_search_content" placeholder="搜索" data-placeholder="搜索"
						data-click="#u_search_item" >
			<span class="search_query_submit geter_search shower" id="u_search_item" data-belong="{{--{$ID}--}}"
				  data-geter="HIS"
				  data-type=""
				  data-getType="init"
				  data-position="0"
				  data-search="#u_search_content"
				  data-more="#u_search_more"
				  data-ctn="#u_search_ctn"
				  data-show="#u_search_ctn"
				  data-hide=".display-hide"
			></span>
				<span class="btn search_return _none" id="search_return" data-click="">Back</span>
			</div>
		</div>
	</div>

	{{--侧边栏--}}
	<div class="layout-sidebar">

		<div class="_hover7 sidebar-piece sidebar-portrait"><img src="../images/portrait/user{{ $user['id'] or 0 }}.jpg" /></div>

		<div class="_hover7 sidebar-piece S-PiX0" data-info="名字" >
			<span class="option-title _f16 _bold"> {{ $user['name'] or '' }} </span>
		</div>

        <div class="btn _hover7 sidebarPiSp off-page">
            <span class="option-title"><span class="option-title"><em class="closer-icon _none"></em> 关闭页面</span></span>
        </div>

		<div class="_hover7 sidebar-piece {{ $user['PM_isset'] or '' }} _none" data-info="私信" >
			<span class="option-title u_send_pm" > 私信 </span>
		</div>
		@if($user['relation'] != 1)
            @if($user['my_relation'] == 0 || $user['my_relation'] > 60)
            <div class="_hover7 sidebar-piece attention_Show">
            <span class="option-title page_relation" data-operate="{{config('relation.operate.follow.add')}}">
                <span class="_borderS"><em class="adder-icon _bold _colorO"></em> 关注 </span>
            </span>
            </div>
            @else
                @if($user['his_relation'] == 0 || $user['his_relation'] > 60)
                <div class="_hover7 sidebar-piece attentionC_Show">
                    <span class="option-title page_relation" data-operate="{{config('relation.operate.follow.cansel')}}">
                        <span class="_borderS changeText" data-overText="取消关注" data-outText="已关注"> 已关注 </span>
                    </span>
                </div>
                @else
                <div class="_hover7 sidebar-piece attentionC_Show">
                    <span class="option-title page_relation" data-operate="{{config('relation.operate.follow.cansel')}}">
                        <span class="_borderS changeText" data-overText="取消关注" data-outText="互相关注"> 互相关注 </span>
                    </span>
                </div>
                @endif
            @endif
		@endif

        <div class="_hover7 sidebar-piece sidebar-piece-special index_home _none">
            <span class="option-title"> {{--{ $user.index_show }--}} </span></div>


        <div class="btn _hover7 sidebar-piece _none" data-info="{{--显示好友--}}">
            <div class="menu-option shower selector" id="menu_show_friends" data-update="y"
                 data-hide=".menu-area" data-show="#menu_connection_ctn"
                 data-click="#"
            ><span class="option-title"> 好 友 </span></div>
        </div>

        <div class="btn _hover7 BoxRow" data-info="{{--全部分享--}}" >
            <div class="menu-option clicker" id="HIS-ALL"
                 data-show="#his_ctn"
                 data-titler-text="全部"
                 data-clicker="#get-HisAll"
            ><span class="option-title"><em class="iconer mine-icon"></em><span class="texter">全部</span></span></div>
        </div>
        
        <div class="btn _hover7 BoxRow" data-info="{{--时刻--}}">
            <div class="menu-option clicker" id="HIS-Timer"
                 data-show="#timer_his_ctn"
                 data-titler-text="时刻"
                 data-clicker="#get-HisTimer"
            ><span class="option-title"><em class="iconer agenda-icon"></em><span class="texter">时刻</span></span></div>
        </div>

        <div class="btn _hover7 BoxRow" data-info="{{--提问--}}">
            <div class="menu-option clicker" id="HIS-Askbar"
                 data-show="#askbar_his_ctn"
                 data-titler-text="求助"
                 data-clicker="#get-HisAskbar"
            ><span class="option-title"><em class="iconer ask-icon"></em><span class="texter">提问</span></span></div>
        </div>

        <div class="btn _hover7 BoxRow _none" data-info="{{--回答--}}">
            <div class="menu-option clicker" id="HIS-Helpbar"
                 data-show="#helpbar_his_ctn"
                 data-titler-text="帮忙"
                 data-clicker="#get-HisAskbar"
            ><span class="option-title"><em class="iconer answer-icon"></em><span class="texter">回答</span></span></div>
        </div>

        <div class="btn _hover7 BoxRow MarB2" data-info="{{--店铺--}}">
            <div class="menu-option clicker" id="HIS-Store"
                 data-show="#store_his_ctn"
                 data-titler-text="商品"
                 data-clicker="#get-HisStore"
            ><span class="option-title"><em class="iconer goods-icon"></em><span class="texter">商品</span></span></div>
        </div>

    </div>


    <div class="geter" id="get-MySetting"  data-geter="His" data-ctn="#"
         data-update="y" data-permission="HIS" data-type="get" data-operate="init" data-position="0"
    ></div>
    <div class="geter" id="get-MySetting"  data-geter="His" data-ctn="#"
         data-update="y" data-permission="HIS" data-type="get" data-operate="init" data-position="0"
    ></div>


    {{--display--}}
    {{--游客搜索--}}
    <div class="LB-page _mainLeft display-hide" id="u_search_ctn">
        <div class=" item-page">
            <div class="entity_ctn"></div>
            <div class="more geter_search" id="u_search_more" data-mine="{{ Auth::id() }}" data-belong="{{ $user['id'] or '' }}" data-permission="HIS"
                 data-geter="HIS" data-getType="more" data-content="" data-position="" data-ctn="#u_search_ctn"> 更多 </div>
        </div>
    </div>

    {{--好友全部分享--}}
    <div class="geterDisp" id="get-HisAll" data-geter="{{config('display.geter.user.all')}}" data-ctn="#his_ctn"
         data-update="y" data-permission="HIS" data-type="get" data-operate="init" data-position="0" ></div>
    <div class="LB-page _mainLeft display-hide" id="his_ctn" data-info="{{--好友全部分享--}}">
        <div class=" item-page">
            <div class="entity_ctn"></div>
            <div class="more geterDisp" data-update="" data-permission="HIS"
                 data-type="more" data-geter="His" data-operate="more" data-position="" data-ctn="#his_ctn"> 更多 </div>
        </div>
    </div>

    {{--时刻--}}
    <div class="geterDisp" id="get-HisTimer" data-geter="{{config('display.geter.user.timer')}}" data-ctn="#timer_his_ctn"
         data-update="y" data-permission="HIS" data-type="get" data-operate="init" data-position="0" ></div>
    <div class="LB-page _mainLeft display-hide" id="timer_his_ctn" data-info="{{--时刻--}}">
        <div class=" item-page">
            <div class="entity_ctn"></div>
            <div class="more geterDisp" data-update="" data-permission="HIS"
                 data-type="more" data-geter="HisTimediv" data-operate="more" data-position="" data-ctn="#timer_his_ctn"> 更多时刻 </div>
        </div>
    </div>

    {{--求助--}}
    <div class="geterDisp" id="get-HisAskbar" data-geter="{{config('display.geter.user.ask')}}" data-ctn="#askbar_his_ctn"
         data-update="y" data-permission="HIS" data-type="get" data-operate="init" data-position="0" ></div>
    <div class="LB-page _mainLeft display-hide" id="askbar_his_ctn" data-info="{{--求助--}}">
        <div class=" item-page">
            <div class="entity_ctn"></div>
            <div class="more geterDisp" data-update="" data-permission="HIS"
                 data-type="more" data-geter="HisAskbar" data-operate="more" data-position="" data-ctn="#askbar_his_ctn"> 更多提问 </div>
        </div>
    </div>

    <div class="LB-page _mainLeft display-hide" id="helpbar_his_ctn" data-info="{{--帮助--}}">
        <div class=" item-page">
            <div class="entity_ctn"></div>
            <div class="more geter" data-update="" data-permission="HIS"
                 data-type="more" data-geter="HisHelpbar" data-operate="more" data-position="" data-ctn="#helpbar_his_ctn"> 更多回答 </div>
        </div>
    </div>

    {{--店铺 store--}}
    <div class="geterDisp" id="get-HisStore" data-geter="{{config('display.geter.user.goods')}}" data-ctn="#store_his_ctn"
         data-update="y" data-permission="HIS" data-type="get" data-operate="init" data-position="0" ></div>
    <div class="LB-page _mainLeft display-hide" id="store_his_ctn" data-info="{{--店铺--}}">
        <div class=" item-page">
            <div class="entity_ctn"></div>
            <div class="more geterDisp" data-update="" data-permission="HIS"
                 data-type="more" data-geter="HisStore" data-operate="more" data-position="" data-ctn="#store_his_ctn"> 更多商品 </div>
        </div>
    </div>



    <div class="LB-page _mainLeft display-hide" id="blog_his_ctn" data-info="{{--日志--}}">
        <div class="entity_ctn"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisBlog" data-operate="more" data-position="" data-ctn="#blog_his_ctn"> 更多 Blogs </div>
    </div>
    <div class="LB-page _mainLeft display-hide" id="album_his_ctn" data-info="{{--相册--}}">
        <div class="entity_ctn notes_container"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisAlbum" data-operate="more" data-position="" data-ctn="#album_his_ctn"> 更多 Albums </div>
    </div>
    <div class="LB-page _mainLeft display-hide" id="audio_his_ctn" data-info="{{--音频--}}">
        <div class="entity_ctn"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisAudio" data-operate="more" data-position="" data-ctn="#audio_his_ctn"> 更多 Audios </div>
    </div>
    <div class="LB-page _mainLeft display-hide" id="video_his_ctn" data-info="{{--视频--}}">
        <div class="entity_ctn"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisVideo" data-operate="more" data-position="" data-ctn="#video_his_ctn"> 更多 Videos </div>
    </div>
    <div class="LB-page _mainLeft display-hide" id="music_his_ctn" data-info="{{--音乐--}}">
        <div class="entity_ctn"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisMusics" data-operate="more" data-position="" data-ctn="#musics_his_ctn"> 更多 Music </div>
    </div>
    <div class="LB-page _mainLeft display-hide" id="drama_his_ctn" data-info="{{--影视--}}">
        <div class="entity_ctn"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisDrama" data-operate="more" data-position="" data-ctn="#drama_his_ctn"> 更多 Drama </div>
    </div>
    <div class="LB-page _mainLeft display-hide" id="book_his_ctn" data-info="{{--书刊--}}">
        <div class="entity_ctn"></div>
        <div class="more geter" data-update="" data-permission="HIS"
             data-type="more" data-geter="HisBook" data-operate="more" data-position="" data-ctn="#book_his_ctn"> 更多 Book </div>
    </div>

    <div class="LB-page _mainLeft120 display-hide" id="infos_ctn" data-info="">
    </div>



    @include('tools.tool')

@endsection






