@foreach($datas as $data)	
<div class="_pointer _hover7 _piece list-option people-option-ctrl shower selector cilckerbacks" id="linkman-chat-{{ $data['id'] or '' }}"
	data-session_type="chat" 
	data-id="{{ $data['id'] or '' }}" 
	data-ctrl="chat-{{ $data['id'] or '' }}"
	data-belong="{{ $data['id'] or '' }}" 
	data-item="0" 
	data-userItemId="0" 
	data-sort="{{ $data['sort'] or '' }}" 
	data-relation="{{ $data['relationship'] or '' }}" 
	data-name="{{ $data['name'] or '' }}" 
	data-autograph="{{ $data['autograph'] or '' }}" 
	data-update="y"
	data-type="get"
	data-geter="His" 
	data-operate="init" 
	data-position="0" 
	data-ctn="#user_card_ctnss"
	data-show="#user_card_ctnss #header-backers" 
	data-hide=".item-display-ctn .menu_tool" 
	data-selector=".people-option-ctrl" 
	data-selected="list-selected" 
	data-cilckerback="#session_linkman" 
>	


	<div class="piece-portrait people_portrait whos" data-whos="{{ $data['id'] or '' }}" title="{{ $data['name'] or '' }}">
		<img src="/images/db{{ $data['id'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}">
	</div>

	<div class="piece-entity">
		
		<div class="piece-row piece-all sidebar_top">
			<span class="_f14 _bold whoss" data-whos="{{ $data['id'] or '' }}">{{ $data['name'] or '' }}</span>
		</div>
		
	</div>


		
	<div class="piece-tools">
		<span class="piece-tools message_to_u _none" data-id="{{ $data['id'] or '' }}" data-name="{{ $data['name'] or '' }}" title="发私信" > 私信 </span>
		<span class="piece-tools view_infos shower _none" data-id="{{ $data['id'] or '' }}" data-update="y" title="查看Ta的信息"
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


