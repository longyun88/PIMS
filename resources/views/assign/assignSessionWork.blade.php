<div class="session_work_ctn working-page session-working" id="" 
	data-session="{{ $data['session'] or '' }}" 
	data-operate="{{ $data['operate'] or '' }}" 
	data-sort="{{ $data['sort'] or '' }}" 
	data-type="{{ $data['type'] or '' }}"
	data-belong="{{ $data['belong'] or '' }}" 
	data-item="{{ $data['item'] or '' }}" 
	data-userItemId="{{ $data['userItemId'] or '' }}" 
	
	data-position="bottom"
>
	<span class="working-adder" data-object="0" data-reply=""></span>
	
	<div class="session_work_box session_work_header">
			
			<div class="session_work_portrait"><img src="./images/db{{ $data['belong'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}"></div>
			<div class="session_work_info">
				<div class="session_row session_work_name">
					<span class="btn-hover item _f16 _bold _red1 {{ $data['item_isset'] or '' }}" data-belong="{{ $data['belong'] or '' }}" data-item="{{ $data['item'] or '' }}">
						{{ $data['name'] or '' }}.{{ $data['item'] or '' }}
					</span>
					<span class="btn-hover item _f16 _bold {{ $data['chat_isset'] or '' }}" data-belong="{{ $data['belong'] or '' }}">{{ $data['name'] or '' }}</span>
					<span class="btn-hover relation _f16 _bold {{ $data['chat_isset'] or '' }}" data-belong="{{ $data['belong'] or '' }}">{{ $data['relation'] or '' }}</span>
					<span class="_f14"> {{ $data['session_sort_name'] or '' }} </span>
					<span class="btn-hover _f14 _cbbb session_content_show {{ $data['content_isset'] or '' }}" data-status="hide"> 展开内容 </span>
				</div>
				<div class="session_row session_theme _f14 _bold {{ $data['theme_isset'] or '' }}">{!! $data['theme'] or '' !!}</div>
				<div class="session_row session_content _f12 {{ $data['content_isset'] or '' }}">{!! $data['content'] or '' !!}</div>
				<!--时间-->
				<div class="session_row session_time {{ $data['time_isset'] or '' }}" data-info="">
			
					<span class="item_btn timer  {{ $data['timers']['start_isset'] or '' }}" data-unix="{{ $data['timers']['start'] or '' }}" data-type="{{ $data['timers']['start_type'] or '' }}">
							{{ $data['timers']['start_show'] or '' }}
					</span>
					<span class="item_btn _f12 {{ $data['timers']['ended_isset'] or '' }} "> 至 </span>
					<span class="item_btn timer {{ $data['timers']['ended_isset'] or '' }}" data-unix="{{ $data['timers']['ended'] or '' }}" data-type="{{ $data['timers']['ended_type'] or '' }}"> 
							{{ $data['timers']['ended_show'] or '' }}
					</span>
					<span class="item_btn timer {{ $data['timers']['remind_isset'] or '' }}" data-unix="{{ $data['timers']['remind'] or '' }}" data-type="{{ $data['timers']['remind_type'] or '' }}">
							{{ $data['timers']['remind_show'] or '' }}
					</span>
		
				</div>
			</div>
			<div class="btn-hover _f16 _bold session_tool session_work_hide _none"><span class=""> X </span></div>
			
	</div>
	
	<div class="session-work working-communication"></div>
	<div class="session-work working-content _none"><div class="session-content">{{ $data['content'] or '' }}</div></div>
	
	<div class="session_work_box session_work_footer">
		<div class="session_work_input"><textarea class="working-input" placeholder=""></textarea></div>
		<div class="btn-hover _c888 session_tool session-confirm session-adder" title="按Enter键发送，按Ctrl+Enter键换行"> 发送 </div>
		<div class="btn-hover _c888 session_tool session-reset working-reset"> 清空 </div>
	</div>
	
</div>