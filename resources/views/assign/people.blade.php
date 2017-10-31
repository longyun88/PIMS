@foreach($datas as $v)
<div class="btn _hover7 _piece connect-option selector" id="connect-{{ $v->object_id or '' }}"
	data-session_type="chat" 
	data-id="{{ $v->object_id or '' }}"
	data-sort="{{ $v->sort or '' }}" 
	data-relation="{{ $v->relationship or '' }}" 
	data-name="{{ $v->object->nickname or '' }}"
	data-autograph="{{ $v->object->autograph or '' }}"
	data-update="y"
	data-type="get"
	data-geter="His" 
	data-operate="init" 
	data-position="0"
	data-selector=".people-ctrl" 
	data-selected="selected_6"
	data-cilckerback="#session_linkman"
>	


	<div class="piece-portrait connect-portrait whos" data-whos="{{ $v->object_id or '' }}" title="{{ $v->object->nickname or '' }}">
		<img src="/images/portrait/user{{ $v->object_id or 0 }}.jpg">
	</div>

	<div class="piece-entity">
		
		<div class="piece-row piece-all sidebar_top">
			<span class="_bold whoss" data-whos="{{ $v->object_id or '' }}">{{ $v->object->nickname or '' }}</span>
		</div>
		
	</div>


		
	<div class="piece-tools">
		<span class="piece-tools message_to_u _none" title="发私信"> 私信 </span>
		<span class="piece-tools view_infos shower _none" data-update="y" title="查看Ta的信息"
			data-type="get"
			data-geter="His" 
			data-operate="init" 
			data-position="0" 
			data-ctn="#user_card_ctn"
			data-show="#user_card_ctn" 
			data-hide=".display_ctn" 
			data-tool="" 
			data-tool_hide=".menu_tool" 
			data-selected="" 
			data-selector="menu-selected" 
		> 名 </span>
		<!--<span class="set_permissions">权</span>-->
	</div>

</div>
@endforeach


