@foreach($datas as $data)
<div class="communication_ctn {{ $data['whos'] or '' }}"
	
	data-id="{{ $data['id'] or '' }}" 
	data-userCommu="{{ $data['userCommunicationId'] or '' }}" 
	data-sort="{{ $data['sort'] or '' }}" 
	data-type="{{ $data['type'] or '' }}" 
	data-entity="{{ $data['entityId'] or '' }}"
	data-source="{{ $data['sourceId'] or '' }}"
	data-object="{{ $data['objectId'] or '' }}"
	data-point="{{ $data['pointId'] or '' }}"
	data-location="{{ $data['locationId'] or '' }}"
>
	
	<div class="communication_portrait {{ $data['float'] or '' }}"><img src="./images/db{{ $data['source'] or '' }}/portrait.jpg"></div>
		
	<div class="communication_entity {{ $data['float'] or '' }}">
		
		<div class="communication_row communication_info">
			<div class="{{ $data['float'] or '' }}">
				<span class="_left _bold little_btn communication_source whos" data-whos="{{ $data['source'] or '' }}">{{ $data['posterName'] or '' }}</span>
				<span class="_left">{{ $data['header'] or '' }}</span>
				<span class="_left _grey {{ $data['object_isset'] or '' }}" > 回复 </span>
				<span class="_left little_btn whos {{ $data['object_isset'] or '' }}" data-whos="{{ $data['object'] or '' }}">{{ $data['objectName'] or '' }}</span>
				<span class="_left _grey little_btn timer" value="{{ $data['time'] or '' }}">{{ $data['time_show'] or '' }}</span>
			</div>
				<span class="little_btn _c888 reply_who {{ $data['float'] or '' }} {{ $data['reply_isset'] or '' }} {{ $data['content_notset'] or '' }}" value="hide" 
					data-point="{{ $data['id'] or '' }}" data-source="{{ $data['source'] or '' }}" data-name="{{ $data['posterName'] or '' }}" 
				> 回复 </span>
		</div>
		
		<div class="communication_row communication_content {{ $data['content_isset'] or '' }}">
			{{ $data['content'] or '' }}
			<span class="little_btn _c888 _right reply_who {{ $data['reply_isset'] or '' }}" value="hide" 
				data-point="{{ $data['id'] or '' }}" data-source="{{ $data['source'] or '' }}" data-name="{{ $data['posterName'] or '' }}" 
			> 回复 </span>
		</div>
		
	</div>
		
</div>
@endforeach


