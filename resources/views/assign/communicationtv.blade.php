@foreach($datas as $v)
<div class="communication_ctn {{ $v->whos or '' }}"
	
	data-id="{{ $v->id or '' }}"
	data-sort="{{ $v->sort or '' }}" 
	data-type="{{ $v->type or '' }}"
	data-source="{{ $v->source_id or '' }}"
	data-object="{{ $v->object_id or '' }}"
	data-point="{{ $v->point_id or '' }}"
>
	
	<div class="communication_portrait {{ $v->float or '' }}"><img src="./images/db{{ $v->source_id or '' }}/portrait.jpg"></div>
		
	<div class="communication_entity {{ $v->float or '' }}">
		
		<div class="communication_row communication_info">
			<div class="{{ $v->float or '' }}">
				<span class="_left _bold little_btn communication_source whos" data-whos="{{ $v->source_id or '' }}">{{ $v->source->name or '' }}</span>
				<span class="_left">{{ $v->header or '' }}</span>
                @if($v->object_id != 0)
				<span class="_left _grey {{ $v->object_isset or '' }}" > 回复 </span>
				<span class="_left little_btn whos" data-whos="{{ $v->object_id or '' }}">{{ $v->object->name or '' }}</span>
                @endif
				<span class="_left _grey timer" value="{{ $v->created_at or '' }}">{{ $v->time_show or '' }}</span>
			</div>
				<span class="little_btn _c888 reply_who {{ $v->float or '' }} {{ $v->content_notset or '' }}" value="hide"
					data-point="{{ $v->id or '' }}" data-source="{{ $v->source_id or '' }}" data-name="{{ $v->source->name or '' }}"
				> 回复 </span>
		</div>

        @if(!empty($v->content))
		<div class="communication_row communication_content"
             data-point="{{ $v->id or '' }}" data-source="{{ $v->source_id or '' }}" data-name="{{ $v->source->name or '' }}">
			{{ $v->content or '' }}
		</div>
        @endif
		
	</div>
		
</div>
@endforeach


