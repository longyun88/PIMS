@foreach($datas as $v)
<div class="comment-option _commentPiece _commentCtn comment-container"
	data-id="{{ $v->id or '' }}" 
	data-sort="{{ $v->sort or '' }}" 
	data-type="{{ $v->type or '' }}" 
	data-item="{{ $v->item_id or '' }}"
	data-source="{{ $v->source_id or '' }}"
	data-object="{{ $v->object_id or '' }}"
	data-point="{{ $v->point_id or '' }}"
	data-dialog="{{ $v->dialog or '' }}"
	data-share="{{ $v->isShared or '' }}"
>

	<div class="comment-portrait _display721"><img src="/images/portrait/user{{ $v->source_id or '' }}.jpg" /></div>

	<div class="comment-entity" value="{{ $v->Comment_posterId or '' }}">

		<div class="_commentR">
			<span class="_hover1 _bold _left whos" data-whos="{{ $v->source_id or '' }}">{{ $v->source->nickname or '' }}</span>
            @if(isset($v->object_id) && $v->object_id != 0)
            <span class="_grey1 _left"> 回复 </span>
			<span class="_hover1 _bold _left whos" data-whos="{{ $v->object_id or '' }}">{{ $v->object->nickname or '' }}</span>
            @endif
			<span class="_itext1 _bold _left">{{ config('communication.name.'.$v->sort.'.'.$v->type) }}</span>
			<span class="_itext1 _bold _left">{{ $v->tips or '' }}</span>
			<span class="_itext3 _f12 _grey1 _right timer" value="{{ $v->time or '' }}">{{ $v->time or '' }}</span>
            @if(Auth::check() && Auth::id() != $v->source_id)
			<span class="_itemBtn _grey _left show_reply {{ $v->content_noset or '' }}" value="hide"> 回复 </span>
            @endif
		</div>

        @if(!empty($v->content))
		<div class="_commentR content">
			{{ $v->content or '' }} <span class="_itemBtn show_reply _none" value="hide"> 回复 </span>
		</div>
        @endif
		
		<div class="_commentR comment-reply comment_reply" value="hide" data-object="0" >
			<div class="_commentR item-input">
				<textarea class="textarea-auto reply_text" placeholder="回复"></textarea>
			</div>
			<div class="_itemR _itemToolR">
				<div class="radior_box _left reply_share radior-parent" data-style="radior_selected" data-selected="41">
					<span class="radior_1" data-selected="21"> 自己可见 </span>
                    <span class="radior_1 radior_selected" data-selected="41"> 好友可见 </span>
                    <span class="radior_1" data-selected="81"> 粉丝可见 </span>
					<span class="radior_1" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_reply_cansel"> 取消 </span>
				<span class="_itemBtn _right btn_reply" data-source="{{ $v->source or '' }}" > 回复 </span>
			</div>
		</div>
		
	</div>

</div>
@endforeach
