@extends('master')

@section('MySpecial')
	<!--本页面的特殊引用 css or js 文件-->
@endsection

@section('title')
	{{ $datas[0]['theme'] or '' }}
@endsection


@section('content')

	<div class="layout-header _mainLeft layout-B">

		<span id="replace_content" style="display:none"></span>
		<input type="hidden" id="session_key" value="">
		<input type="hidden" id="page-Marking" value=""
			   data-type="User"
			   data-log="{{ Session::get('isLog') }}"
               data-belong="{{ $user['belong_id'] or '' }}"
			   data-visitor="{{ Auth::check() ? Auth::id() : 0 }}"
			   data-mine="{{ Auth::check() ? Auth::id() : 0 }}"
			   data-backer=""
		/>

	</div>

	{{--item.sidebar 侧边栏--}}
	<div class="layout-sidebar _sidebar120 _display721">

		<div class="btn _hover7  sidebar-piece sidebar-portrait">
            <img src="/images/portrait/user{{ $user['belong_id'] or 0 }}.jpg"  class="_hover2" />
        </div>
		<div class="btn _hover7 sidebarPiSp whos" data-whos="{{ $user['belong_id'] or 0 }}">
            <span class="option-title"> {{ $user['belong_name'] or '' }} </span>
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

		@if(!empty($user['belong_id']))
        <div class="btn _hover7 sidebarPiSp whos" data-whos="{{ $user['belong_id'] or 0 }}" id="i-guest">
            <span class="option-title"><em class="closer-icon _none"></em>去Ta主页</span>
        </div>
		@endif
        <div class="btn _hover7 sidebarPiSp off-page">
            <span class="option-title"><em class="closer-icon _none"></em> 关闭页面</span>
        </div>

	</div>

	<div class="LB-page _mainLeft LB-pageX" id="theItem">
		<div class=" item-page">
			<div class="entity_ctn">
				@include('assign.itemtv')
			</div>
		</div>
	</div>

	@include('tools.tool')

@endsection



