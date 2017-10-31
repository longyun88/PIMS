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




<div class="LB-page _mainLeft120 LB-pageX" id="theItem">
	<div class=" item-page">
		<div class="entity_ctn">
			@include('assign.commenttv')
		</div>
	</div>
</div>
@endsection



