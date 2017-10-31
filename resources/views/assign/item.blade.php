@foreach($datas as $data)
<div class="item-container {{ $data['belongTypes'] or '' }} item-{{ $data['userItemId'] or '' }}"
	
	data-item-belong="{{ $data['itemBelong'] or '' }}" 
	data-item-type="{{ $data['itemTYPE'] or '' }}" 
	
	data-searchId="{{ $data['searchId'] or '' }}" 
	
	data-identity-class=".item-{{ $data['userItemId'] or '' }}"
	data-identity="{{ $data['belongId'] or '' }}-{{ $data['itemId'] or '' }}"
	data-db="{{ $data['db'] or '' }}" 
	data-userItemId="{{ $data['userItemId'] or '' }}" 
	data-belong="{{ $data['belongId'] or '' }}" 
	data-item="{{ $data['itemId'] or '' }}" 
	data-mineId="{{ $data['mineId'] or '' }}" 
	data-id="{{ $data['id'] or '' }}" 
	data-sort="{{ $data['sort'] or '' }}" 
	data-type="{{ $data['type'] or '' }}" 
	data-form="{{ $data['form'] or '' }}" 
	data-source="{{ $data['source'] or '' }}"
	data-object="{{ $data['object'] or '' }}" 
	data-entity="{{ $data['entity'] or '' }}" 
	data-location="{{ $data['location'] or '' }}" 
	data-opposite="{{ $data['oppositeId'] or '' }}" 
	
	data-originUserItemId="{{ $data['originUserItemId'] or '' }}" 
	data-originBelong="{{ $data['originBelong'] or '' }}" 
	data-originItem="{{ $data['originItem'] or '' }}" 
	
	data-quoteUserItemId="{{ $data['quoteUserItemId'] or '' }}" 
	data-quoteBelong="{{ $data['quoteBelong'] or '' }}" 
	data-quoteItem="{{ $data['quoteItem'] or '' }}" 

	data-search="{{ $data['searchId'] or '' }}" 
	data-calendar="{{ $data['time_calendar'] or '' }}" 
	data-months="{{ $data['timers']['time_months'] or '' }}" 
	data-days="{{ $data['timers']['time_days'] or '' }}" 
	data-weeks="{{ $data['timers']['time_weeks'] or '' }}" 
	data-year-weeks="{{ $data['timers']['time_year_weeks'] or '' }}" 
	
	data-timeType="{{ $data['timeType'] or '' }}" 
	data-start="{{ $data['timers']['start'] or '' }}" 
	data-ended="{{ $data['timers']['ended'] or '' }}" 
	
	data-focused="{{ isset($data['focused']) or '' }}" 
	data-collected="{{ isset($data['collected']) or '' }}"
	data-forward="{{ isset($data['forward']) or '' }}"
	data-forwardsss="{{ $data['origin']['originAttachingIS'] or '' }}"
>

	<span class="item-Marking" 
	></span>
	
	<span class="itemOrigin-Marking"
		data-userItemId="{{ $data['origin']['userItemId'] or '' }}"
		data-belong="{{ $data['origin']['belongId'] or '' }}"
		data-id="{{ $data['origin']['id'] or '' }}"
		data-sort="{{ $data['origin']['sort'] or '' }}"
		data-focused="{{ $data['origin']['focused'] or '' }}" 
		data-collected="{{ $data['origin']['collected'] or '' }}"
	></span>
	
	<div class="itemPortrait itemPortrait-row link-btn  whos _display721" data-whos="{{ $data['source'] or '' }}" title="看Ta的主页" data-info="<!--头像-->">
		<img src="/images/db{{ $data['source'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}" />
		<div class="btn-hover item-source-portrait {{ $data['sourcePortrait_IS'] or '' }}">
			<img src="/images/db{{ $data['source'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}" />
		</div>
	</div>
	
	<div class="itemBody">
		
		<div class="btn-hover itemPortrait  whos _display720" data-whos="{{ $data['belong'] or '' }}" title="看主页" data-info="<!--头像-->">
			<img src="/images/db{{ $data['belong'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}" />
			<div class="btn-hover item-source-portrait {{ $data['sourcePortrait_IS'] or '' }}">
				<img src="/images/db{{ $data['source'] or '' }}/portrait.jpg?{{ $data['random'] or '' }}" />
			</div>
		</div>
		
		<!--主人-->
		<div class="_itemR _itemR2 item-belong _l28">
			<span class="link-btn _hover1 _red1 _left itemers" data-itemer="{{ $data['id'] or '' }}"> <b>{{ $data['belongName'] or '' }}</b> </span>
			<span class="_f12 _hover3 _left">
				<span class="{{ isset($data['sort_color']) or '' }} itemer" data-itemer="{{ $data['id'] or '' }}"><b>{{ $data['sortName'] or '' }}</b></span>
				<span class="{{ isset($data['importanceColor']) or '' }}"><b> {{ $data['importance_show'] or '' }} </b></span>
			</span>
			<span class="_f12 _greya _hover3 _left itemer" data-itemer="{{ $data['id'] or '' }}" data-timer="{{ $data['time'] or '' }}"> {{ $data['time_show'] or '' }} </span>
			<span class="_red _left  {{ isset($data['price_IS']) ? $data['price_IS'] : '' }}"> <b> ￥{{ isset($data['price']) ? $data['price'] : '' }} </b> </span>
			<span class="_greya _right item_toggle _none {{ isset($data['contentIS']) or '' }}" data-status="hides"> 收起全文 </span>
			
			<span class="_pointer _hover7 _itemFloatBtn itemDown"><em class="iconer down-icon"></em></span>
		</div>
		<!--信息-->
		<div class="_itemR {{ $data['infosIS'] or '' }} {{ $data['isset'] or '' }}">
		</div>
		<div class="_itemR _itemR2 _none">
			<span class="_f14 _greya _left" data-timer="{{ $data['time'] or '' }}"> {{ $data['time_show'] or '' }} </span>
			<span class="_greya _left {{ $data['modifiedIS'] or '' }} _none" data-unix="{{ $data['modified'] or '' }}"> 修改 {{ $data['modified_show'] or '' }} </span>
			<span class="_greya _left {{ $data['cpd_timeIS'] or '' }} _none" data-unix="{{ $data['cpd'] or '' }}"> 已完成 {{ $data['cpd_show'] or '' }} </span>
		</div>

		<div class="_itemR _bold item-none {{ $data['isset_none'] or '' }}" data-info="<!--不存在-->"> <b> 此条信息已被作者删除 或 设置为隐私内容！</b> </div>
		
		<!--消息 头-->
		<div class="_itemR {{ $data['newsIS'] or '' }}" data-info="<!--消息 头-->">
			<span class="_f16 _bold _hover1 whos _left {{ $data['source_isset'] or '' }}" data-whos="{{ $data['source'] or '' }}">{{ $data['source_name'] or '' }}</span>
			<span class="_left">{{ $data['content'] or '' }}</span>
			<span class="_f16 _bold _hover1 whos _left {{ $data['object_isset'] or '' }}" data-whos="{{ $data['object'] or '' }}">{{ $data['object_name'] or '' }}</span>
			<span class="_left">{{ $data['contentTwo'] or '' }}</span>
		</div>


		<!--发件人--> 
		<div class="_itemR {{ $data['senderIS'] or '' }} {{ $data['isset'] or '' }}" data-info="<!--发件人-->">
			<span class="_left">  发件人： </span>
			<span class="_bold _blue1 _hover1 _left whos" data-whos="{{ $data['source'] or '' }}">{{ $data['source_name'] or '' }}</span>
			<span class="_right show_unread {{ $data['unread_btn_isset'] or '' }}" data-status="hide"> 查看 </span>
		</div>
		<!--收件人-->
		<div class="_itemR {{ $data['receiverIS'] or '' }}" data-receivers="{{ $data['receiverIds'] or '' }}" data-info="<!--收件人-->">
			<span class="_left">  收件人： </span>
			
				@forelse($data['receivers'] as $receiver)
				<span class="btn _bold _hover7 _left _blue1" data-receiverId="{{ $receiver['id'] or '' }}"> {!! $receiver['name'] or '' !!} </span>
				@empty
				@endforelse
				
		</div>	


		<!--转发--> 
		<div class="_itemR content {{ $data['quoteIS'] or '' }} " data-info="<!--转发-->">
			<b>{!! $data['quoteContent'] or '' !!}</b>
		</div>
		
		<div class="_itemR item-origin origin-{{ $data['origin']['userItemId'] or '' }}  {{ $data['originIS'] or '' }} _none" data-info="<!--引用 Quote-->"
			data-userItemId="{{ $data['origin']['userItemId'] or '' }}"
			data-belong="{{ $data['origin']['belongId'] or '' }}"
			data-id="{{ $data['origin']['id'] or '' }}"
			data-sort="{{ $data['origin']['sort'] or '' }}"
			data-focused="{{ $data['origin']['focused'] or '' }}" 
			data-collected="{{ $data['origin']['collected'] or '' }}"
		>
			
			
		</div>
		
		
		<!--引用 Quote.belong-->
		<div class="_itemR _itemRO _MarT8 {{ $data['originIS'] or '' }}">
			<span class="_red1 _hover1 itemer" data-itemer="{{ $data['origin']['id'] or '' }}"><b>{{ $data['origin']['belongName'] or '' }}.{{ $data['origin']['id'] or '' }}</b></span>
		</div>
		
		
		<!--时间-->
		<div class="_itemR item-time {{ $data['timeIS'] or '' }}" data-info="<!--时间-->">
	
			<span class="timer _hover1s _f18 _bold _left {{ $data['timers']['start_isset'] or '' }}" data-unix="{{ $data['timers']['start'] or '' }}" data-type="{{ $data['timers']['start_type'] or '' }}">
					{{ $data['timers']['start_show'] or '' }}
			</span>
			<span class="_f12 _bold  _left {{ $data['timers']['ended_isset'] or '' }} "> 至 </span>
			<span class="timer _hover1s _f18 _bold _left {{ $data['timers']['ended_isset'] or '' }}" data-unix="{{ $data['timers']['ended'] or '' }}" data-type="{{ $data['timers']['ended_type'] or '' }}"> 
					{{ $data['timers']['ended_show'] or '' }}
			</span>
			<span class="timer _hover1s _f18 _bold _left {{ $data['timers']['remind_isset'] or '' }} {{ $data['timers']['remind_ispast'] or '' }}" 
				data-unix="{{ $data['timers']['remind'] or '' }}" data-type="{{ $data['timers']['remind_type'] or '' }}">
					{{ $data['timers']['remind_show'] or '' }}
			</span>

		</div>
		<!--引用时间 Quote.time-->
		<div class="_itemR _itemRO item-time {{ $data['origin']['timeIS'] or '' }} {{ $data['originIS'] or '' }}">
			<span class="item-timer timer _left {{ $data['origin']['timers']['start_isset'] or '' }}" 
				data-unix="{{ $data['origin']['timers']['start'] or '' }}" data-type="{{ $data['origin']['timers']['start_type'] or '' }}">
					<b> {{ $data['origin']['timers']['start_show'] or '' }} </b>
			</span>
			<span class="_f12 c_greya _left {{ $data['origin']['timers']['ended_isset'] or '' }}"> <b> 至 </b> </span>
			<span class="item-timer timer _left {{ $data['origin']['timers']['ended_isset'] or '' }}" 
				data-unix="{{ $data['origin']['timers']['ended'] or '' }}" data-type="{{ $data['origin']['timers']['ended_type'] or '' }}"> 
					<b> {{ $data['origin']['timers']['ended_show'] or '' }} </b>
			</span>
			<span class="item-timer _bold timer _left {{ $data['origin']['timers']['remind_isset'] or '' }} {{ $data['origin']['timers']['remind_ispast'] or '' }}" 
				data-unix="{{ $data['origin']['timers']['remind'] or '' }}" data-type="{{ $data['timers']['remind_type'] or '' }}">
					<b> {{ $data['origin']['timers']['remind_show'] or '' }} </b>
			</span>
		</div>
		
		
		<!--内容-->	
		<div class="_itemR _f18 content {{ $data['themeIS'] or '' }} {{ $data['isset'] or '' }}"><b> {!! $data['theme'] or '' !!} </b></div>
		<div class="_itemR _itemContent item-content content {{ $data['contentIS'] or '' }} {{ $data['isset'] or '' }}"> <p> {!! $data['content'] or '' !!} </p>
			</div>
		<div class="_itemR _itemContent item_content_more _none {{ $data['contentIS'] or '' }} {{ $data['isset'] or '' }}">
			<span class="_itemBtn _left content_more"> 全文 </span>
			<input type="text" class="item_focus _none" readonly="readonly" value="" />
		</div>
		<!--引用内容 Quote.Content-->
		<div class="_itemR _itemRO content {{ $data['originIS'] or '' }}  _f16 _bold  {{ $data['origin']['themeIS'] or '' }}"> {{ $data['origin']['theme'] or '' }} </div>
		<div class="_itemR _itemRO content {{ $data['originIS'] or '' }} {{ $data['origin']['contentIS'] or '' }}"> {!! $data['origin']['content'] or '' !!} </div>
		
		<!--附图-->
		<div class="_itemR attaching-Box {{ $data['attachingStyle'] or '' }} {{ $data['attachingIS'] or '' }} ">
			<div class="item-attaching item-attaching{{ $data['attaching_styleNum'] or '' }}">
				@forelse($data['attachingShower'] as $attachingS)
				<span class="_attachingPiece attachingShowImage{{ $data['attachingShowerClick'] or '' }}" 
					data-imgType ="{{ $attachingS['type'] or '' }}"
					data-originUrl="{{ $attachingS['imgUrl'] or '' }}">
					<img src="{{ $attachingS['imgSrc'] or '' }}" />
				</span>
				@empty
				@endforelse
			</div>
		</div>
		<!--附图 大图-->
		<div class="_itemR _itemRO attaching-Display _none" data-info="<!--附图 大图-->">
			
			<div class="_itemR attaching-tool-box">
				<span class="_itemBtn _hover3 _right showImageOrigin" data-itemer=""> 查看原图 </span>
			</div>
			
			<div class="_itemR attaching-display-box item_media_box">
				<div class="_pointer image-turn-buttom turn-left turnPrev"> <div class="_block left-cursor"></div> </div>
				<div class="attaching-media-box image_hide"><img src="" /></div>
				<div class="_pointer image-turn-buttom turn-right turnNext"> <div class="_block right-cursor"></div> </div>
			</div>
			
			<div class="_itemR attaching-choose-box pic_choose_box">
				<div class="image-choose-buttom choose-left choose_left selector-left-g _none"> <em class="iconer left-icon"></em> </div>
				<div class="attaching-choose-ctn">
					<div class="attaching-choose-ctn-s">
						@forelse($data['attachingShower'] as $attachingS)
						<span class="attaching-choose-option attachingOption attachingShowImage{{ $data['attachingShowerClick'] or '' }}" 
							data-imgType ="{{ $attachingS['type'] or '' }}"
							data-originurl="{{ $attachingS['imgUrl'] or '' }}">
							<img src="{{ $attachingS['imgSrc'] or '' }}" />
						</span>
						@empty
						@endforelse
					</div>
				</div>
				<div class="image-choose-buttom choose-right choose_right selector-right-g _none"> <em class="iconer right-icon"></em> </div>
			</div>
			
		</div>
		
		
		<div class="_itemR {{ $data['origin']['attachmentIS'] or '' }} _none"></div>
		
		<!--引用不存在 Quote.Isset.NO-->
		<div class="_itemR _itemRO _bold _none_info {{ $data['origin']['isset_none'] or '' }}  {{ $data['originIS'] or '' }}"> 此条信息已被作者删除 或 设置为隐私内容！  </div>
		
		<!--引用工具 Quote.tools-->
		<div class="_itemR _itemRO _itemToolR {{ $data['origin']['toolsIS'] or '' }} {{ $data['originIS'] or '' }}" 
			data-quoteSource="{{ $data['origin']['source'] or '' }}" data-quoteId="{{ $data['origin']['id'] or '' }}"
		>
			<div class="_left">
				<span class="item-timer timer _left _f14 _greya" data-timer="{{ $data['origin']['time'] or '' }}">{{ $data['origin']['time_show'] or '' }}</span>
			</div>
			<div class="_right">
				<span class="_itemBtn _right itemer" data-itemer="{{ $data['quoteUserItemId'] or '' }}"> 
					<em class="iconer comment-icon"></em> {{ $data['origin']['comment'] or '' }} </span>
						
				<span class="_itemBtn _right itemer {{ $data['origin']['forwardIS'] or '' }}" data-itemer="{{ $data['quoteUserItemId'] or '' }}"> 
					<em class="iconer forward-icon"></em> {{ $data['origin']['forward'] or '' }} </span>
						
				<span class="_itemBtn _right showConfirmor operating {{ $data['origin']['collectIS'] or '' }}" data-type="quote_collect" data-tip="确认收藏？" title="收藏">
					<em class="iconer collect-icon"></em>{{ $data['origin']['collect'] or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating {{ $data['origin']['collectCIS'] or '' }}" data-type="quote_collect_cansel" data-tip="取消收藏？" title="删除收藏"> 
					<em class="iconer collect-icon _red1"></em>{{ $data['origin']['collect'] or '' }} 
				</span>
				<span class="_itemBtn _right showConfirmor operating {{ $data['origin']['timeIS'] or '' }} {{ $data['origin']['focusIS'] or '' }}" data-type="quote_focus" data-tip="+ 日程？" title="添加到我的日程"> 
					+日程 {{ $data['origin']['focus'] or '' }} 
				</span>
				<span class="_itemBtn _right showConfirmor operating {{ $data['origin']['timeIS'] or '' }} {{ $data['origin']['focusCIS'] or '' }}" data-type="quote_focus_cansel" data-tip="取消关注？"> 
					移除日程 {{ $data['origin']['focus'] or '' }} 
				</span>
				<span class="_itemBtn _right showConfirmor operating {{ $data['origin']['workItIS'] or '' }}" data-type="quote_workIt" data-tip="添加到我的待办事?" title="添加到我的待办事">
					<em class="iconer work-icon"></em> {{ $data['origin']['worked'] or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating {{ $data['origin']['workItCIS'] or '' }}" data-type="quote_workIt_cansel" data-tip="移除待办？" title="移除待办"> 
					<b><em class="iconer work-icon _red"></em></b> {{ $data['origin']['worked'] or '' }} 
				</span>
			</div>
		</div>
		
		
		<!--标签-->
		<div class="_itemR _MarT8 {{ $data['mineIS'] or '' }} {{ $data['isset'] or '' }}" data-info="<!--标签-->">
				@forelse($data['tag'] as $tag)
				<span class="btn _hover7 _left tag tag_search" data-tag="{{ $tag or '' }}"> {{ $tag or '' }} </span>
				@empty
				@endforelse
			<span class="_itemBtn _left modify_tag" data-type="{{ $data['tag_tool_type'] or '' }}">{{ $data['tag_tool_show'] or '' }}</span>
		</div>
		<div class="_itemR item-module module_tag _none" data-info="<!-- 修改标签 -->">
			<div class="_itemR item-input ">
				<input class="tag_text" type="text" placeholder="添加标签">
			</div>
			<div class="_itemR _irow4">
				<span class="_itemBtn _right modify_tag_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right modify_tag_confirm"  data-type="note" data-tip="添加？"> 确认 </span>
			</div>
		</div>
		
		<!-- tool 工具 -->
		<div class="_itemFlowBox itemFlowTool {{ $data['toolsIS'] or '' }}  {{ $data['isset'] or '' }}  _none" data-info="<!--tools-->">	

			<div class="_left {{ $data['other_timeIS'] or '' }} _none">
				<span class=" _f14 _greya" data-timer="{{ $data['time'] or '' }}">{{ $data['time_show'] or '' }}</span>
				<span class="" data-tip="">{{ $data['tools_tip'] or '' }}</span>
			</div>
			<div class="_left _display721s _none">
				<span class="_f14 _greya _left" data-timer="{{ $data['time'] or '' }}">{{ $data['time_show'] or '' }}</span>
			</div>
			
			

			<li class=" {{ $data['mineIS'] or '' }} {{ $data['share_IS'] or '' }}" data-tip="<!--分享-->">
				<span class="operating btn_show" data-type="share" data-status="{{ $data['share_status'] or '' }}" data-show=".module_share">{{ $data['share_show'] or '' }} </span>		
			</li>
			
			
			
			<li class=" {{ $data['othersIS'] or '' }} {{ $data['collectIS'] or '' }}" data-tip="<!--收藏-->">	
				<span class="operating btn_show" data-type="collect" data-show=".module_collect"> <em class="iconer collect-icon"></em> 收藏 {{ $data['collect'] or '' }} </span>	
			</li>		
			<li class=" {{ $data['othersIS'] or '' }} {{ $data['collectCIS'] or '' }}" data-tip="<!--取消收藏-->">
				<span class="operating btn_show" data-type="collect_cansel" data-show=".module_collectC" data-tip="不再收藏？"> <em class="iconer collect-icon _red1"></em> 删除收藏 {{ $data['collect'] or '' }} </span>	
			</li>
			
			<li class="{{ $data['workItIS'] or '' }}" data-tip="<!--添加待办-->">	
				<span class="operating btn_show" data-type="workIt" data-show=".module_workIt"> <em class="iconer work-icon"></em> 添加到我的待办事列表 </span>	
			</li>
			<li class="{{ $data['workItCIS'] or '' }}" data-tip="<!--移除待办-->">
				<span class="operating btn_show" data-type="workIt_cansel" data-show=".module_workItC" data-tip="确认移除？"> <em class="iconer work-icon _red1"></em> 移出待办 </span>	
			</li>
			
			<li class="{{ $data['othersIS'] or '' }} {{ $data['focusIS'] or '' }}" data-tip="<!--关注-->">	
				<span class="operating btn_show" data-type="focus" data-show=".module_focus"> <em class="iconer agenda-icon"></em> 添加到我的日程 {{ $data['focus'] or '' }} </span>	
			</li>
			<li class="{{ $data['othersIS'] or '' }} {{ $data['focusCIS'] or '' }}" data-tip="<!--取消关注-->">
				<span class="operating btn_show" data-type="focus_cansel" data-show=".module_focusC" data-tip="确认移除？"> <em class="iconer agenda-icon _red1"></em> 移出日程 {{ $data['focus'] or '' }} </span>	
			</li>
			
			<li class=" {{ $data['tip_isset'] or '' }} _none" data-tip="<!--打赏-->">
				<span class="operating btn_show" data-type="show_reward" data-show=".module_reward"> 赏{{ $data['tips'] or '' }} </span>
			</li>
			<li class=" {{ $data['write_IS'] or '' }} _none" data-tip="<!--记笔记-->">
				<span class="operating btn_show" data-type="show_write" data-show=".module_write"> <em class="iconer modify-icon"></em> 记笔记 </span>
			</li>
			
			<li class=" {{ $data['mineIS'] or '' }} {{ $data['modify_IS'] or '' }} " data-tip="<!--修改-->">
				<span class="show_modify"> <em class="iconer modify-icon"></em> 修改 </span>
			</li>
			<li class="{{ $data['mineIS'] or '' }} {{ $data['delete_IS'] or '' }}" data-tip="<!--删除-->">
				<span class="operating showConfirmor" data-type="delete" data-tip="确认删除？"> <em class="iconer delete-icon"></em> 删除 </span>
			</li>

		</div>
		
		<!-- tool 工具 -->
		<div class="_itemR _itemToolR _itemBottomTool {{ $data['toolsIS'] or '' }}  {{ $data['isset'] or '' }}" data-info="<!--tools-->">	
			<li class="" data-tip="<!--回复 btn_show-->">
				<span class="_itemBtn operating btn_show" data-type="show_comment" data-sort="{{ $data['comment_sort'] or '' }}" data-show=".module_comment" title="回复"> 
					<em class="iconer comment-icon"></em> {{ $data['commentShow'] or '' }}
				</span>
			</li>
			<li class="{{ $data['forwardIS'] or '' }}" data-tip="<!--转发 btn_show-->">
				<span class="_itemBtn operating btn_show" data-type="show_forward" data-show=".module_forward" title="转发">
					<em class="iconer forward-icon"></em> {{ $data['forwardShow'] or '' }} </span>
			</li>
			<li class="itemFover {{ $data['favorIS'] or '' }}" data-type="favorIt" title="赞">
				<span class="_itemBtn operating "> <em class="iconer favor-icon"></em> {{ $data['favorShow'] or '' }} </span>
			</li>
			<li class="itemFover {{ $data['favorCIS'] or '' }}" data-type="favorCansel" title="取消赞">
				<span class="_itemBtn operating"> <em class="_red iconer favor-icon"></em> {{ $data['favorShow'] or '' }} </span>
			</li>
			<li class="_borderNone" data-tip="<!--转发 btn_show-->">
				<span class="_itemBtn operating btn_show" data-type="show_score" data-show=".module_score" data-tip="打分"> <b>{{ $data['scoreAVG'] or '' }}分/{{ $data['scoreNum'] or '' }}人 </b> </span>
			</li>
		</div>
		
		<div class="_itemR {{ $data['newsIS'] or '' }} " data-info="<!--news 好友请求处理-->">
			<span class="_green1 _right item_status {{ $data['status_isset'] or '' }}">{{ $data['status'] or '' }}</span>
					
			<div class="item-handle news_request btn_delete_friend {{ $data['deleteFriend_IS'] or '' }} _none">
				<span class="_itemBtn operating showConfirmor" data-type="delete_friend" data-tip="拒绝请求？"> 解除关系 </span>
			</div>
			<div class="item-handle news_request btn_refuse_friend {{ $data['refuseFriend_IS'] or '' }}">
				<span class="_itemBtn operating showConfirmor" data-type="refuse_friend" data-tip="拒绝请求？"> 拒绝 </span>
			</div>
			<div class="item-handle news_request btn_add_friend {{ $data['addFriend_IS'] or '' }}">
				<span class="_itemBtn operating showConfirmor" data-type="add_friend" data-tip="添加好友？"> +好友 </span>
			</div>
		</div>	






		<!-- module 打分 -->
		<div class="_itemR item-module module_score module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_score score_text" placeholder="说点什么，"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left score_score" data-selected="5">
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="1"> 1很差 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="2"> 2较差 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="3"> 3还行 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="4"> 4推荐 </span>
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="5"> 5力荐 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_score_confirm" data-sort="" data-type=""> 打分 </span>
			</div>
		</div>
		<div class="_itemR item-module module_score _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="49" data-getOperate="friend" data-selected="41"> 好友打分 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="49" data-getOperate="all" data-selected="100" data-default="default"> 全部打分 </span>
				</div>
			</div>
		</div>

		<!-- module 回复 -->
		<div class="_itemR item-module module_comment module-tools _none" data-info="<!-- module comment 回复 -->">
			<!--<div class="_itemR comment_object"></div>-->
			<div class="_itemR item-input">
				<textarea class="comment_text textarea-auto text_focus" placeholder="评论"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4 comment_tool">
				<div class="_radiorBox _left comment_share" data-selected="100">
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄评论 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 作者可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="100""> 公开 </span>
				</div>
				<div><span class="comment_get comment_get_special _hidden" data-sort="{{ $data['comment_special'] or '' }}"> </span></div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_comment" data-sort="" data-type=""> 发送 </span>
			</div>
		</div>
		<div class="_itemR item-module module_comment _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="all" data-sort="0" data-getOperate="mine" data-selected="0"> 与我相关 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="all" data-sort="0" data-getOperate="friend" data-selected="41"> 好友评论 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="all" data-sort="0" data-getOperate="all" data-selected="100" data-default="default"> 全部 </span>
				</div>
			</div>
		</div>

		<!-- module 收藏 -->
		<div class="_itemR item-module module_collect module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus collect_text" placeholder="收藏"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left collect_share" data-selected="100">
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄收藏 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_collect_confirm" data-sort="" data-type=""> 收藏 </span>
			</div>
		</div>
		<div class="_itemR item-module module_collect _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="20" data-getOperate="friend" data-selected="41"> 好友收藏 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="20" data-getOperate="all" data-selected="100" data-default="default"> 全部收藏 </span>
				</div>
			</div>
		</div>

		<!-- module 收藏关注 -->
		<div class="_itemR item-module module_collectC module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus collectC_text" placeholder="取消收藏"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left collectC_share" data-selected="11">
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄取消 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_collectC_confirm" data-sort="" data-type=""> 取消收藏 </span>
			</div>
		</div>
		<div class="_itemR item-module module_collectC _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="20" data-getOperate="friend" data-selected="41"> 好友收藏 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="20" data-getOperate="all" data-selected="100" data-default="default"> 全部收藏 </span>
				</div>
			</div>
		</div>

		<!-- module 待办 -->
		<div class="_itemR item-module module_workIt module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus workIt_text" placeholder="+待办，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left workIt_share" data-selected="11">
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄添加 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_workIt_confirm" data-sort="" data-type=""> 确认 </span>
			</div>
		</div>
		<div class="_itemR item-module module_workIt _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="21" data-getOperate="friend" data-selected="41"> 好友 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="21" data-getOperate="all" data-selected="100" data-default="default"> 全部 </span>
				</div>
			</div>
		</div>

		<!-- module 移除待办 -->
		<div class="_itemR item-module module_workItC module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus workItC_text" placeholder="移除待办，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left workItC_share" data-selected="11">
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄移除 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_workItC_confirm" data-sort="" data-type=""> 确认 </span>
			</div>
		</div>
		<div class="_itemR item-module module_workItC _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="21" data-getOperate="friend" data-selected="41"> 好友 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="21" data-getOperate="all" data-selected="100" data-default="default"> 全部 </span>
				</div>
			</div>
		</div>

		<!-- module 关注 -->
		<div class="_itemR item-module module_focus module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus focus_text" placeholder="关注，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left focus_share" data-selected="100">
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄关注 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_focus_confirm" data-sort="" data-type=""> 关注 </span>
			</div>
		</div>
		<div class="_itemR item-module module_focus _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="22" data-getOperate="friend" data-selected="41"> 好友关注 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="22" data-getOperate="all" data-selected="100" data-default="default"> 所有关注 </span>
				</div>
			</div>
		</div>

		<!-- module 取消关注 -->
		<div class="_itemR item-module module_focusC  module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus focusC_text" placeholder="取消关注，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox _left focusC_share" data-selected="100">
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄取消 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_focusC_confirm" data-sort="" data-type=""> 移除日程 </span>
			</div>
		</div>
		<div class="_itemR item-module module_focusC _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="22" data-getOperate="friend" data-selected="41"> 好友关注 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="22" data-getOperate="all" data-selected="100" data-default="default"> 所有关注 </span>
				</div>
			</div>
		</div>

		<!-- module forward 转发 -->
		<div class="_itemR item-module module-tools module_forward _none">
			<div class="_itemR forward_header _none">  </div>
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus forward_text" placeholder=""></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4 forward_tools">
				<div class="_radiorBox _left forward-Share" data-selected="100">
					<span class="radior _none" data-parent="1" data-style="_radiorSelected" data-selected="11"> 自己可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
					<!--<span class="radior FPM" data-parent="1" data-style="_radiorSelected" data-selected="2" id=""> 转发给朋友 </span> -->
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_forward" > 转发 </span>
			</div>
		</div>

		<!-- module write 记笔记 -->
		<div class="_itemR item-module module-tools module_write _none">
			<div class="_itemR module_write_input">
				<input class="text_focus note_theme" type="text" placeholder="主题">
				<textarea class="textarea-auto note_content" placeholder="内容"></textarea>
				<input class="note_tag" type="text" placeholder="标签">
			</div>
			<div class="_itemR _itemToolR _irow4">
				<span class="_itemBtn _right  btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_write_confirm"  data-type="note" data-tip="添加？"> 添加笔记 </span>
			</div>
		</div>


		<!-- module share 分享 -->
		<div class="_itemR item-module module-tools module_share _none">
			<div class="_itemR _itemToolR _irow4 share_tools">
				<div class="_radiorBox _left share_share" data-selected="0" data-status="{{ $data['share_status'] or '' }}">
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="0"> 不分享 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_share" > 确定 </span>
			</div>
		</div>

		<!-- module reward 打赏 -->
		<div class="_itemR item-module module_reward module-tools _none">
			<div class="_itemR item-input">
				<input class="tip_text" type="text" placeholder="打赏语">
			</div>
			<div class="_itemR _itemToolR _irow4 tip_tools">
				<div class="item_tip_text _left"><input class="item-input text_focus tip_num" type="text" placeholder="赏金" value=""></div>
				<div class="_radiorBox _left tip_share" data-selected="100">
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="11"> 悄悄打赏 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="21"> 通知作者 </span>
					<span class="radior" data-parent="1" data-style="_radiorSelected" data-selected="41"> 好友可见 </span>
					<span class="radior _radiorSelected" data-parent="1" data-style="_radiorSelected" data-selected="100"> 公开 </span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip=""> 取消 </span>
				<span class="_itemBtn _right btn_tip showConfirmor"  data-type="reward" data-tip="确认打赏？"> 确定 </span>
			</div>
		</div>
		<div class="_itemR item-module module_reward _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox _left" data-selected="0">
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="88" data-getOperate="friend" data-selected="41"> 好友打赏 </span>
					<span class="radior defaultClicker comment_get" data-parent="1" data-style="_radiorSelected" data-getSort="special" data-sort="88" data-getOperate="all" data-selected="100" data-default="default"> 全部打赏 </span>
				</div>
			</div>
		</div>

		<div class="_itemR item-module module-display module_display _none"></div>

	</div>

</div>
@endforeach


