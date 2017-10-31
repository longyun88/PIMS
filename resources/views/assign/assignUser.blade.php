@foreach($datas as $data)
<div class="item-container {{ $data['user_type'] or '' }}" data-class="item_container {{ $data['user_type'] or '' }}" 
	data-id="{{ $data['id'] or '' }}" 
	data-db="{{ $data['db'] or '' }}" 
	data-sort="{{ $data['sort'] or '' }}" 
>

		<div class="item-portrait"><img src="./images/db{{ $data['id'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}" /></div>

	<div class="item-entity">


		<!--主人-->
		<div class="item-row item_belong">
			<span class="link-btn _left _f16 _bold whos" data-whos="{{ $data['id'] or '' }}"> {{ $data['name'] or '' }} </span>
			<span class="item-btn _left _f16 _bold" data-whos="{{ $data['id'] or '' }}"> ID : {{ $data['id'] or '' }} </span>
			<span class="item-btn relation"> {{ $data['relation'] or '' }} </span>
			
			<div class="item-handle _right {{ $data['attention_isset'] or '' }}">
				<span class="item-btn user_attention" data-operate="addAttention"> 关注 </span>
			</div>
			<div class="item-handle _right {{ $data['attentionC_isset'] or '' }}">
				<span class="item-btn user_attention changeText" data-operate="attention_C" data-overText="取消关注" data-outText="已关注" > 已关注 </span>
			</div>
			<div class="item-handle _right _none">
				<span class="item-btn _right boxes_shower" data-parent="3" data-shower=".relation_shower"> {{ $data['operationText'] or '' }} </span>
			</div>
		</div>
		
		<div class="item-row autograph {{ $data['autograph_isset'] or '' }}"> 签名：{{ $data['autograph'] or '' }}</div>
		
		
		<!--person-->	
		<div  class="item-row1 _none {{ $data['person_isset'] or '' }}">
			<div class="item-row {{ $data['infos.birth_isset'] or '' }}">{{ $data['infos.birth_show'] or '' }}</div>
			<div class="item-row {{ $data['infos.hometown_isset'] or '' }}">家乡：{{ $data['infos.hometown_show'] or '' }}</div>
			<div class="item-row {{ $data['infos.present_isset'] or '' }}">现居地：{{ $data['infos.present_show'] or '' }}</div>
			<div class="item-row {{ $data['infos.school_isset'] or '' }}">
				学校：{{ $data['infos.school_show'] or '' }}
			</div>
			<div class="item-row {{ $data['infos.company_isset'] or '' }}">
				公司：{{ $data['infos.company'] or '' }} - {{ $data['infos.companyDepartment'] or '' }} - {{ $data['infos.companyPosition'] or '' }}
			</div>
			<div class="item-row {{ $data['infos.phone_isset'] or '' }}">phone：{{ $data['infos.phone'] or '' }}</div>
			<div class="item-row {{ $data['infos.email_isset'] or '' }}">email：{{ $data['infos.email'] or '' }}</div>
		</div>
		
		<!--channel-->
		<div  class="item-row2 _none {{ $data['channel_isset'] or '' }}">
		</div>
		
		<div class="item-row _none"></div>
		
		<div class="item-row">
			<span class="item_num"> 日程：<span class="_f14 _bold _green"> {{ $data['item.timerNum'] or '' }} </span></span>
		</div>
		<div class="item-row">
			<span class="item_num"> 笔记：<span class="_f14 _bold _green"> {{ $data['item.noteNum'] or '' }} </span></span>
		</div>
		<div class="item-row">
			<span class="item_num"> 求助：<span class="_f14 _bold _green"> {{ $data['item.helpNum'] or '' }} </span></span>
		</div>
		<div class="item-row _none">
			<span class="item_num"> 微博：<span class="_f14 _bold _green"> {{ $data['item.wordsNum'] or '' }} </span></span>
		</div>
		<div class="item-row">
			<span class="item_num"> 商品：<span class="_f14 _bold _green"> {{ $data['item.goodsNum'] or '' }} </span></span>
		</div>
		
		<div class="item-row _none"></div>
		
		
		
		<!--引用 Quote-->		
		<div class="item-row item_quote {{ $data['quote_isset'] or '' }} _none" data-info="">
			
			<div class="item-row item_source {{ $data['quote.belong_isset'] or '' }}">
				<span class="btn _blue_a item" data-belong="{{ $data['quote.source'] or '' }}" data-entity="{{ $data['quote.id'] or '' }}">
					{{ $data['quote.source_name'] or '' }}.{{ $data['quote.id'] or '' }}
				</span>
			</div>
			
			<div class="item-row item_time {{ $data['quote.time_isset'] or '' }}">
	
				<span class="timer timer_start {{ $data['quote.start_isset'] or '' }}" data-unix="{{ $data['quote.start_unix'] or '' }}" data-type="{{ $data['quote.start_type'] or '' }}">
					{{ $data['quote.start_show'] or '' }}
				</span>
				<span class="{{ $data['ended_isset'] or '' }} c_grey">至</span>
				<span class="timer timer_ended {{ $data['quote.ended_isset'] or '' }}" data-unix="{{ $data['quote.ended_unix'] or '' }}" data-type="{{ $data['quote.ended_type'] or '' }}"> 
					{{ $data['ended_show'] or '' }}
				</span>

				<span class="timer remind_timer {{ $data['quote.remind_isset'] or '' }} {{ $data['quote.remind_ispast'] or '' }}" data-unix="{{ $data['quote.remind_unix'] or '' }}" data-type="{{ $data['quote.remind_type'] or '' }}">
					{{ $data['remind_show'] or '' }}
				</span>

			</div>

			<div class="item-row content item_theme {{ $data['quote.theme_isset'] or '' }}"> {{ $data['quote.theme'] or '' }} </div>
			<div class="item-row content quote_content {{ $data['quote.content_isset'] or '' }}"> {{ $data['quote.content'] or '' }} </div>

			<div class="item-row item_attaching {{ $data['quote.attaching_isset'] or '' }} _none"></div>
			<div class="item-row item_attachment {{ $data['quote.attachment_isset'] or '' }} _none"></div>
			
			<div class="item-row quote_tools {{ $data['quote.tools_isset'] or '' }}" 
				data-quoteSource="{{ $data['quote.source'] or '' }}" data-quoteId="{{ $data['quote.id'] or '' }}"
			>
				<div class="_left">
					<span class="tool_btn timer {{ $data['quote_timer_isset'] or '' }}" data-timer="{{ $data['quote.time'] or '' }}">{{ $data['quote.time_show'] or '' }}</span>
					<!--<span class="tool_btn details">详细</span>-->
				</div>
				<div class="_right">
					<span class="little_btn btn_">评论</span>
					<span class="little_btn btn_quote">转发{{ $data['quote.fwd'] or '' }}</span>
					<span class="little_btn btn_quote_collect {{ $data['quote.mine_isset'] or '' }}">收藏{{ $data['quote.fav'] or '' }}</span>
					<span class="little_btn btn_quote_focus {{ $data['quote.mine_isset'] or '' }} {{ $data['quote.time_isset'] or '' }}">关注{{ $data['quote.attn'] or '' }}</span>
				</div>
			</div>
			
		</div>
		
		<div class="item-row item-module module-tools relation_shower _none" data-info="<!--  -->">
			<div class="item-row item-input">
				<textarea class="request_ps textarea-auto text_focus" placeholder="附言"></textarea>
			</div>
			<div class="item-row _irow4 comment_tool">
				<span class="item-btn ReConfirm_cansel"> 取消 </span>
				<span class="item-btn handle_relation {{ $data['Rerequest'] or '' }}" data-id="{{ $data['id'] or '' }}" data-type="request_friend"> +好友&关注Ta </span>
				<span class="item-btn handle_relation {{ $data['Rerequest'] or '' }}" data-id="{{ $data['id'] or '' }}" data-type="attention_it"> 关注Ta </span>
				<span class="item-btn handle_relation {{ $data['ReDelete'] or '' }}" data-id="{{ $data['id'] or '' }}" data-type="delete_friend"> 解除关系 </span>
				<span class="item-btn handle_relation {{ $data['ReCansel'] or '' }}" data-id="{{ $data['id'] or '' }}" data-type="attention_cansel"> 取消关注 </span>
			</div>
		</div>
		
		
		<div class="item-row module-tools item-input relation_showers _none" data-info="">
			<input type="text" value="" placeholder="附言" class="request_friend_ps" />
		</div>
		
		<div class="item-row relation_showers _none">
			<div class="item-handle">
				<span class="item-btn ReConfirm_cansel"> 取消 </span>
			</div>
			<div class="item-handle {{ $data['Rerequest'] or '' }}">
				<span class="item-btn handle_relation" data-id="{{ $data['id'] or '' }}" data-type="request_friend"> 关注&请求好友 </span>
			</div>
			<div class="item-handle {{ $data['ReAttention'] or '' }}">
				<span class="item-btn handle_relation" data-id="{{ $data['id'] or '' }}" data-type="attention_it"> 关注Ta </span>
			</div>
			<div class="item-handle {{ $data['ReDelete'] or '' }}">
				<span class="item-btn handle_relation" data-id="{{ $data['id'] or '' }}" data-type="delete_friend"> 解除关系 </span>
			</div>
			<div class="item-handle {{ $data['ReCansel'] or '' }}">
				<span class="item-btn handle_relation" data-id="{{ $data['id'] or '' }}" data-type="attention_cansel"> 取消关注 </span>
			</div>
		</div>
		

	</div>

</div>
@endforeach
