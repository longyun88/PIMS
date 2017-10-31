@foreach($datas as $data)	
<div class="comment-option _commentPiece _commentCtn" 
	data-id="{{ $data['id'] or '' }}" 
	data-userCommu="{{ $data['userCommunicationId'] or '' }}" 
	data-sort="{{ $data['sort'] or '' }}" 
	data-type="{{ $data['type'] or '' }}" 
	data-item="{{ $data['itemId'] or '' }}"
	data-source="{{ $data['sourceId'] or '' }}"
	data-object="{{ $data['objectId'] or '' }}"
	data-point="{{ $data['pointId'] or '' }}"
	data-dialog="{{ $data['dialog'] or '' }}"
	data-location="{{ $data['locationId'] or '' }}"
	data-share="{{ $data['isShared'] or '' }}"
>

	<div class="comment-portrait _display721"><img src="/images/db{{ $data['source'] or '' }}/portrait.jpg" /></div>

	<div class="comment-entity" value="{{ $data['Comment_posterId'] or '' }}">

		<div class="_commentR">
			<span class="link-btn _hover1 _bold  _left whos" data-whos="{{ $data['source'] or '' }}">{{ $data['posterName'] or '' }}</span>
			<span class="_grey1 _left {{ $data['object_isset'] or '' }}"> 回复 </span>
			<span class="link-btn _hover1 _bold _left whos {{ $data['object_isset'] or '' }}" data-whos="{{ $data['object'] or '' }}">{{ $data['objectName'] or '' }}</span>
			<span class="_itext1 _f14x _bold _left">{{ $data['header'] or '' }}</span>
			<span class="_itext1 _bold _left">{{ $data['tips'] or '' }}</span>
			<span class="_itext3 _f12 _grey1 _right timer _display721" value="{{ $data['time'] or '' }}">{{ $data['time_show'] or '' }}</span>
			<span class="_itemBtn _grey _left show_reply {{ $data['reply_isset'] or '' }} {{ $data['content_noset'] or '' }}" value="hide"> 回复 </span>
		</div>

		<div class="_commentR content {{ $data['content_isset'] or '' }}">
			{{ $data['content'] or '' }} <span class="_itemBtn show_reply {{ $data['reply_isset'] or '' }} _none" value="hide"> 回复 </span>
		</div>
		
		<div class="_commentR comment-reply comment_reply" value="hide" data-entity="{{ $data['entity'] or '' }}" data-object="0" >
			<div class="_commentR item-input">
				<textarea class="textarea-auto reply_text" placeholder="回复"></textarea>
			</div>
			<div class="_itemR _itemToolR">
				<div class="radior_box _left reply_share" data-selected="0">
					<span class="radior" data-parent="1" data-style="radior_selected" data-selected="0"> 悄悄话 </span>
					<span class="radior" data-parent="1" data-style="radior_selected" data-selected="41"> 好友可见 </span>
					<span class="radior default_click" data-parent="1" data-style="radior_selected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_reply_cansel"> 取消 </span>
				<span class="_itemBtn _right btn_reply" data-source="{{ $data['source'] or '' }}" > 回复 </span>
			</div>
		</div>
		
	</div>

</div>
@endforeach
