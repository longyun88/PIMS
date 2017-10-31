@extends('master')

@section('MySpecial')
	<!--本页面的特殊引用 css or js 文件-->
@endsection

@section('title')
	{{ $data['belongName'] or '' }}.{{ $data['itemId'] or '' }}
@endsection


@section('content')

<div class="layout-header _mainLeft120 layout-B">

	<span id="replace_content" style="display:none"></span>
	<input type="hidden" id="session_key" value="">
	<input type="hidden" id="page-Marking" value="" data-type="User"
		   data-log="{{ Session::get('isLog') }}"
		   data-visitor="{{ Session::get('mine') }}"
		   data-belong="{{ $data['belongId'] or '' }}"
		   data-sort="{{ $data['sort'] or '' }}"
		   data-mine="{{ Session::get('mine') }}"
		   data-backer="" />

</div>


<!--item.float-->
<div class="layout-float _none">

	<div class="btn-hover float-piece float-piece-portrait"> <img src="../../images/db{{ $data['belongId'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}"  class="_hover2" /> </div>

	<div class="btn-hover float-piece">
		<span class="option-text _f16 _bold"> {{ $data['belongName'] or '' }} </span>
	</div>

	<div class="btn-hover float-piece <!--{$relation.pm_isset}--> _none">
		<span class="option-text u_send_pm" data-id="{{ $data['belongId'] or '' }}"> 私信 </span>
	</div>

	<div class="_hover7 sidebar-piece attention_Show {{ $data['attention_isset'] or '' }}" data-info="关注" >
		<span class="option-title page_attention" data-operate="addAttention">
			<span class="_borderS"> <em class="adder-icon _bold _colorO"></em> {{ $data['RelationText'] or '关注' }} </span>
		</span>
	</div>
	<div class="_hover7 sidebar-piece attentionC_Show {{ $data['attentionC_isset'] or '' }}" data-info="取消关注" >
		<span class="option-title page_attention" data-operate="attention_C">
			<span class="_borderS changeText" data-overText="取消关注" data-outText="已关注"> {{ $data['RelationText'] or '已关注' }} </span> </span>
	</div>

	<div class="btn-hover float-piece float-piece-special _none">
		<span class="option-text handle_connection" data-id="{{ $data['belongId'] or '' }}" data-operate="<!--{$relation.operation}-->"><!--{$relation.title}--></span>
	</div>


</div>


<!--item.sidebar 侧边栏-->
<div class="layout-sidebar _sidebar120 _display721">

	<div class="btn _hover7  sidebar-piece S-Pi-P"> <img src="/images/db{{ $data['belongId'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}"  class="_hover2" /> </div>
	<div class="btn _hover7 BoxRow whos" data-whos="{{ $data['belongId'] or '' }}"><span class="option-title"> {{ $data['belongName'] or '' }} </span></div>

	<div class="_hover7 BoxRow sidebarPiSp attention_Show {{ $data['attention_isset'] or '' }}" title="关注" >
		<span class="option-title page_attention" data-operate="addAttention">
			<span class="_borderS"> <em class="adder-icon"></em> {{ $data['RelationText'] or '关注' }} </span>
		</span>
	</div>

	<div class="_hover7 BoxRow sidebarPiSp attentionC_Show {{ $data['attentionC_isset'] or '' }}" title="取消关注" >
		<span class="option-title page_attention" data-operate="attention_C">
			<span class="_borderS changeText" data-overText="取消关注" data-outText="已关注"> {{ $data['RelationText'] or '已关注' }} </span> </span>
	</div>

	<div class="btn _hover7 BoxRow" title="" data-info="">
		<div class="_option sidebar-option  whos" data-whos="{{ $data['belongId'] or '' }}" id="i-guest" >
			<span class="option-title"> <em class="iconer mine-icon"></em> <span class="texter"> 主页 </span> </span></div>
	</div>

	<div class="btn _hover7 BoxRow off-page">
		<span class="option-title"> <em class="iconer closer-icon"></em> <span class="texter"> 关闭页面 </span> </span>
	</div>

</div>



<div class="LB-page _mainLeft120 LB-pageX" id="theItem">
	<div class=" item-page">
		<div class="entity_ctn">
			@include('assign.itemtv')
		</div>
	</div>
</div>
@endsection



