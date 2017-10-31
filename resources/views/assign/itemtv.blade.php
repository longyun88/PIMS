@inject('hi', 'App\Widgets\ItemWidget')

@if(!empty($datas))
@foreach($datas as $v)
@if(!empty($v))
<div class="item-container item-{{ $v->id or '' }}"

	data-id="{{ $v->id or '' }}"
	data-identity="item-{{ $v->id or '' }}"
	data-belong="{{ $v->belongId or '' }}"
	data-source="{{ $v->sourceId or '' }}"
	data-object="{{ $v->objectId or '' }}"
	data-sort="{{ $v->sort or '' }}"
	data-type="{{ $v->type or '' }}"
	data-form="{{ $v->form or '' }}"
	data-time-type="{{ $v->time_type or '' }}"
	data-start="{{ $v->start_time or '' }}"
	data-end="{{ $v->end_time or '' }}"

	data-origin-id="{{ $v->origin_item_id or '' }}"
	data-origin-belong="{{ $v->origin_belong_id or '' }}"
	data-quote-id="{{ $v->quote_item_id or '' }}"
	data-quote-belong="{{ $v->quote_belong_id or '' }}"

	data-calendar="@if($v->time_type == 1){{ $hi->handleScheduleDays($v->start_time,$v->end_time) }}@endif"
	data-months="{{ $v->timers->time_months or '' }}"
	data-days="@if($v->time_type == 1){{ $hi->handleScheduleDays($v->start_time,$v->end_time) }}@endif"
	data-weeks="@if($v->time_type == 1){{ $hi->handleScheduleWeeks($v->start_time,$v->end_time) }}@endif"
	data-year-weeks="{{ $v->timers->time_year_weeks or '' }}"
>

	<input type="hidden" class="item-Marking" />

	<input type="hidden" class="itemOrigin-Marking"
		data-id="{{ $v->origin->id or '' }}"
		data-belong="{{ $v->origin->belongId or '' }}"
	/>

	{{--头像--}}
	<div class="itemPortrait itemPortrait-row link-btn whos _none" data-whos="{{ $v->sourceId or '' }}"
		 title="看Ta的主页">
		<img src="/images/portrait/user{{ $v->sourceId or 0 }}.jpg" />
		<div class="btn-hover item-source-portrait _none">
			<img src="/images/portrait/user{{ $v->sourceId or 0 }}.jpg" />
		</div>
	</div>

	<div class="itemBody">

		{{--主人--}}
		<div class="_itemR _itemR2 item-belong _l28">
            <span class="btn itemPortrait">
                <img src="/images/portrait/user{{ $v->belongId or 0 }}.jpg" />
                <div class="btn-hover item-source-portrait _none">
                    <img src="/images/portrait/user{{ $v->sourceId or 0 }}.jpg" />
                </div>
            </span>
			<span class="link-btn _f12 _red1 _hover7 _left itemers " data-itemer="{{ $v->id or '' }}"> <b>{{ $v->belongUser->nickname or '' }}</b></span>
			<span class="_f12 _hover3 _left">
				<span class="{{ config('item.itemBlade.sortColor.'.$v->sort) or '' }} itemer" data-itemer="{{ $v->id or '' }}">
					<b>{{ config('item.itemBlade.sortName.'.$v->sort) }}</b></span>
				<span class="{{ config('item.itemBlade.importanceColor.'.$v->importance) or '' }}">
					<b> {{ config('item.itemBlade.importanceName.'.$v->importance) or '' }} </b></span>
			</span>
			<span class="_f12 _greya _hover3 _left itemer"
				  data-itemer="{{ $v->id or '' }}" data-timer="{{ $v->time or '' }}"> {{ time_show($v->time) }}</span>
			@if($v->price >0)
			<span class="_red _left "> <b> ￥{{ $v->price or '' }} </b></span>
			@endif

			<span class="_pointer _hover7 _itemFloatBtn itemDown"><em class="iconer down-icon"></em></span>
		</div>
		{{--信息--}}
		<div class="_itemR _itemR2 _none">
			<span class="_greya _left" data-timer="{{ $v->time or '' }}"> {{ time_show($v->time) }}</span>
			<span class="_greya _left _none" data-unix="{{ $v->modified or '' }}"> 修改 {{ time_show($v->modified) }}</span>
			<span class="_greya _left _none" data-unix="{{ $v->cpd or '' }}"> 已完成 {{ time_show($v->cpd) }}</span>
		</div>

		<div class="_itemR _bold item-none _none" data-info=""> <b> 此条信息已被作者删除 或 设置为隐私内容！</b> </div>

		{{--消息 头--}}
		@if($v->sort == 1)
		<div class="_itemR " data-info="header">
			<span class="_bold _left _hover1 whos" data-whos="{{ $v->source or '' }}">{{ $v->sourceUser->nickname or '' }}</span>
			<span class="_left">{{ $v->contents or '' }}</span>
			<span class="_bold _left _hover1 whos" data-whos="{{ $v->object or '' }}">{{ $v->object_name or '' }}</span>
			<span class="_left">{{ $v->contentTwo or '' }}</span>
		</div>
		@endif


		@if($v->sort == 19)
		{{--发件人--}}
		<div class="_itemR" data-info="sender_row">
			<span class="_left">  发件人：</span>
			<span class="_bold _blue1 _hover1 _left whos" data-whos="{{ $v->sourceId or '' }}">{{ $v->sourceUser->nickname or '' }}</span>
			<span class="_right show_unread {{ $v->unread_btn_isset or '' }}" data-status="hide"> 查看</span>
		</div>
		{{--收件人--}}
		<div class="_itemR" data-receivers="{{ $v->receiverIds or '' }}" data-info="receiver_row">
			<span class="_left">  收件人：</span>
			@if(!empty($v->receivers))
			@foreach($v->receivers as $receiver)
			<span class="btn _bold _hover7 _left _blue1" data-receiverId="{{ $receiver->id or '' }}"> {{$receiver->name or ''}} </span>
			@endforeach
			@endif
		</div>
		@endif

		{{--转发--}}
		@if(!empty($v->quote))
		<div class="_itemR _content" data-info="{{--转发--}}">
			<b>{!! $v->quoteContent or '' !!}</b>
		</div>
		@endif

		<div class="_itemR item-origin origin-{{ $v->origin->id or '' }} _none"
			data-userItemId="{{ $v->originUserItemId or '' }}"
			data-belong="{{ $v->origin->belongId or '' }}"
		>
		</div>


		{{--引用 Quote.belong--}}
		@if(!empty($v->quoteUserItemId))
		<div class="_itemR _itemRO _MarT8">
			<span class="_red1 _hover1 itemer" data-itemer="{{ $v->originUserItemId or '' }}"><b>{{ $v->origin->belongName or '' }}.{{ $v->originUserItemId or '' }}</b></span>
		</div>
		@endif


		{{--时间--}}
		@if($v->time_type > 0)
		<div class="_itemR item-time" data-info="时间">
			@if($v->start_type > 0 )
			<span class="timer _hover1s _bold _left" data-unix="{{ $v->start_time or '' }}" data-type="{{ $v->start_type or '' }}">
					{{ time_show($v->start_time) }}
			</span>
			@endif
			@if($v->ended_type > 0 )
			<span class="_f12 _bold  _left"> 至</span>
			<span class="timer _hover1s _bold _left" data-unix="{{ $v->end_time or '' }}" data-type="{{ $v->ended_type or '' }}">
					{{ time_show($v->end_time) }}
			</span>
			@endif
			@if($v->remind_type > 0 )
			<span class="timer _hover1s _bold _left" data-unix="{{ $v->remind_time or '' }}" data-type="{{ $v->remind_type or '' }}">
					{{ time_show($v->remind_time) }}
			</span>
			@endif
		</div>
		@endif

		{{--引用时间 Quote.time--}}
		@if(!empty($v->origin))
		<div class="_itemR _itemRO item-time">
			@if($v->origin->start_type > 0)
			<span class="item-timer timer _left"
				data-unix="{{ $v->origin->start or '' }}" data-type="{{ $v->origin->start_type or '' }}">
					<b> {{ time_show($v->origin->start) or '' }} </b>
			</span>
			@endif
			@if($v->origin->ended_type > 0)
			<span class="_f12 c_greya _left"> <b> 至 </b></span>
			<span class="item-timer timer _left"
				data-unix="{{ $v->origin->ended or '' }}" data-type="{{ $v->origin->ended_type or '' }}">
					<b> {{ time_show($v->origin->ended) or '' }} </b>
			</span>
			@endif
			@if($v->origin->remind_type > 0)
			<span class="item-timer _bold timer _left {{ $v->origin->timers->remind_ispast or '' }}"
				data-unix="{{ $v->origin->remind or '' }}" data-type="{{ $v->origin->remind_type or '' }}">
					<b> {{ time_show($v->origin->remind) or '' }} </b>
			</span>
			@endif
		</div>
		@endif


		{{--内容--}}
		<div class="_itemR _content"><b>@if(!empty($v->theme)){{ $v->theme or '' }}@else无主题@endif</b></div>
		@if(!empty($v->content))
		<div class="_itemR _itemContent item-content _content _f13">{!! replace_content($v->content) !!}</div>
		@endif
		<div class="_itemR _itemContent item_content_more _none">
			<span class="_itemBtn _left content_more"> 全文</span>
			<input type="text" class="item_focus _none" readonly="readonly" value="" />
		</div>
		{{--引用内容 Quote.Content--}}
		@if(!empty($v->origin->theme))
		<div class="_itemR _itemRO content _bold"> {{ $v->origin->theme or '' }} </div>
		@endif
		@if(!empty($v->origin->content))
		<div class="_itemR _itemRO content"> {{ $v->origin->content or '' }} </div>
		@endif
		{{--附图--}}
		@if(!empty($v->attaching))
		<div class="_itemR attaching-Box {{ $v->attachingStyle or '' }}">
			<div class="item-attaching item-attaching{{ $v->attaching_styleNum or '' }}">
				@foreach($hi->handleAttaching($v->attaching) as $a)
				<span class="_attachingPiece attachingShowImage{{ $a['click'] or '' }}"
					  data-imgType ="{{ $a['type'] or '' }}" data-originUrl="{{ $a['origin'] or '' }}">
					<img src="{{ $a['url'] or '' }}" />
				</span>
				@endforeach
			</div>
		</div>
		@endif
		{{--附图 大图--}}
		<div class="_itemR _itemRO attaching-Display _none" data-info="{{--附图 大图--}}">

			<div class="_itemR attaching-tool-box">
				<span class="_itemBtn _hover3 _right showImageOrigin" data-itemer=""> 查看原图</span>
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
						@if(!empty($v->attaching))
						@foreach($hi->handleAttaching($v->attaching) as $a)
						<span class="attaching-choose-option attachingOption attachingShowImage{{ $a['click'] or '' }}"
								  data-imgType ="{{ $a['type'] or '' }}"
								  data-originUrl="{{ $a['origin'] or '' }}">
							<img src="{{ $a['url'] or '' }}" />
						</span>
						@endforeach
						@endif
					</div>
				</div>
				<div class="image-choose-buttom choose-right choose_right selector-right-g _none"> <em class="iconer right-icon"></em> </div>
			</div>

		</div>


		<div class="_itemR {{ $v->origin->attachmentIS or '' }} _none"></div>

		{{--引用不存在 Quote.Isset.NO--}}
		@if(!empty($v->origin))
		<div class="_itemR _itemRO _bold _none_info"> 此条信息已被作者删除 或 设置为隐私内容！ </div>

		{{--引用工具 Quote.tools--}}
		<div class="_itemR _itemRO _itemToolR " data-quoteSource="{{ $v->origin->source or '' }}" data-quoteId="{{ $v->origin->id or '' }}">
			<div class="_left">
				<span class="item-timer timer _left _f14 _greya" data-timer="{{ $v->origin->time or '' }}">{{ $v->origin->time_show or '' }}</span>
			</div>
			<div class="_right">
				<span class="_itemBtn _right itemer" data-itemer="{{ $v->quote_item_id or '' }}">
					<em class="iconer comment-icon"></em> {{ $v->origin->comment or '' }}</span>

				<span class="_itemBtn _right itemer" data-itemer="{{ $v->quote_item_id or '' }}">
					<em class="iconer forward-icon"></em> {{ $v->origin->forward or '' }}</span>

				<span class="_itemBtn _right showConfirmor operating" data-type="quote_collect" data-tip="确认收藏？" title="收藏">
					<em class="iconer collect-icon"></em>{{ $v->origin->collect or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating" data-type="quote_collect_cansel" data-tip="取消收藏？" title="取消收藏">
					<em class="iconer collect-icon _red1"></em>{{ $v->origin->collect or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating" data-type="quote_focus" data-tip="+ 日程？" title="添加到我的日程">
					+日程 {{ $v->origin->focus or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating" data-type="quote_focus_cansel" data-tip="取消关注？">
					移除日程 {{ $v->origin->focus or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating" data-type="quote_workIt" data-tip="添加到我的待办事?" title="添加到我的待办事">
					<em class="iconer work-icon"></em> {{ $v->origin->worked or '' }}
				</span>
				<span class="_itemBtn _right showConfirmor operating" data-type="quote_workIt_cansel" data-tip="移除待办？" title="移除待办">
					<b><em class="iconer work-icon _red"></em></b> {{ $v->origin->worked or '' }}
				</span>
			</div>
		</div>
		@endif

		{{--标签--}}
		@if((Auth::check()) && Auth::user()->id == $v->belongId)
		<div class="_itemR _MarT8" data-info="{{--标签--}}">
			@if(!empty($v->tag))
				@foreach($hi->handleTag($v->tag) as $tag)
					{{ $tag or '' }}
				@endforeach
					<span class="_itemBtn _left modify_tag" data-type="">修改标签</span>
			@else
				<span class="_itemBtn _left modify_tag" data-type="">添加标签</span>
			@endif
		</div>
		@endif
		<div class="_itemR item-module module_tag _none" data-info="修改标签">
			<div class="_itemR item-input ">
				<input class="tag_text" type="text" placeholder="添加标签">
			</div>
			<div class="_itemR _irow4">
				<span class="_itemBtn _right modify_tag_cansel"  data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right modify_tag_confirm"  data-type="note" data-tip="添加？"> 确认</span>
			</div>
		</div>

		{{-- tool 工具 --}}
		<div class="_itemFlowBox itemFlowTool {{ $v->toolsIS or '' }}  _none" data-info="{{--tools--}}">

			@if(Auth::check() && Auth::user()->id != $v->belongId )
			<div class="_left  _none">
				<span class=" _f14 _greya" data-timer="{{ $v->time or '' }}">{{ $v->time_show or '' }}</span>
				<span class="" data-tip="">{{ $v->tools_tip or '' }}</span>
			</div>
			@endif

			<div class="_left _display721s _none">
				<span class="_f14 _greya _left" data-timer="{{ $v->time or '' }}">{{ $v->time_show or '' }}</span>
			</div>


			@if(!empty($v->user_item) && $v->user_item->collect_is == 1)
			<li class="" data-tip="移除收藏">
				<span class="operating btn_show" data-type="collect_cansel" data-show=".module_collectC" data-tip="确认移除？">
					<em class="iconer iconfont icon-favorfill _red1" data-mine="collect-icon"></em> 移除收藏 {{ !empty($v->collect_num) ? $v->collect_num : '' }}</span>
			</li>
			@else
			@if(Auth::check() && Auth::user()->id == $v->belongId )
			@else
			<li class="" data-tip="收藏">
				<span class="operating btn_show" data-type="collect" data-show=".module_collect">
					<em class="iconer iconfont icon-favor" data-mine="collect-icon"></em> 收藏 {{ !empty($v->collect_num) ? $v->collect_num : '' }}</span>
			</li>
			@endif
			@endif

			@if(!empty($v->user_item) && $v->user_item->work_is == 1)
			<li class="" data-tip="移除待办">
				<span class="operating btn_show" data-type="workIt_cansel" data-show=".module_workItC" data-tip="确认移除？">
					<em class="iconer iconfont icon-activityfill _red1"></em> 移出待办</span>
			</li>
			@else
			<li class="" data-tip="添加待办">
				<span class="operating btn_show" data-type="workIt" data-show=".module_workIt">
					<em class="iconer iconfont icon-activity"></em> 添加到我的待办事</span>
			</li>
			@endif

			@if($v->time_type > 0)
			@if(!empty($v->user_item) && $v->user_item->agenda_is == 1)
			<li class="" data-tip="取消关注">
				<span class="operating btn_show" data-type="focus_cansel" data-show=".module_focusC" data-tip="确认移除？">
					<em class="iconer iconfont icon-timefill _red1" data-mine="agenda-icon"></em> 移出日程 {{ !empty($v->agenda_num) ? $v->agenda_num : '' }}</span>
			</li>
			@else
			<li class="" data-tip="关注">
				<span class="operating btn_show" data-type="focus" data-show=".module_focus">
					<em class="iconer iconfont icon-time" data-mine="agenda-icon"></em> 添加到我的日程 {{ !empty($v->agenda_num) ? $v->agenda_num : '' }}</span>
			</li>
			@endif
			@endif

			@if(Auth::check())
			<li class="_none" data-tip="打赏">
				<span class="operating btn_show" data-type="show_reward" data-show=".module_reward">
					赏{{ !empty($v->tips) ? $v->tips : '' }}</span>
			</li>
			<li class="_none" data-tip="记笔记">
				<span class="operating btn_show" data-type="show_write" data-show=".module_write"><em class="iconer modify-icon"></em> 记笔记</span>
			</li>

			@if(Auth::id() == $v->belongId)
			<li class="show_modify"><span><em class="iconer iconfont icon-edit"></em> 修改</span></li>
			<li class="item-delete"><span><em class="iconer iconfont icon-delete"></em> 删除</span></li>
			<li class="">
				<span class="operating btn_show" data-type="share" data-status="{{ $v->isShared or '' }}" data-show=".module_share">
					<em class="iconer iconfont icon-share"></em> {{config("item.itemBlade.isShared_show.".$v->isShared)}}
				</span>
			</li>
			@endif
			@endif

		</div>

		{{-- tool 工具 --}}
		<div class="_itemR _itemToolR _itemBottomTool" data-info="{{--tools--}}">
			<li class="">
				<span class="_itemBtn operating btn_show" data-type="show_comment" data-show=".module_comment" title="回复">
					<em class="iconer iconfont icon-comment" data-mine="comment-icon"></em> {{ empty($v->comment_num) ? '' : $v->comment_num }}
				</span>
			</li>
			<li class="">
				<span class="_itemBtn operating btn_show" data-type="show_forward" data-show=".module_forward" title="转发">
					<em class="iconer iconfont icon-forward" data-mine="forward-icon"></em> {{ empty($v->forward_num) ? '' : $v->forward_num }}
               </span>
			</li>
			@if(!empty($v->user_item) && $v->user_item->favor_is == 1)
			<li class="itemFover" data-type="{{config('item.operate.favor.cansel')}}" title="取消赞">
				<span class="_itemBtn operating"><em class="iconer iconfont icon-appreciate _red" data-mine="favor-icon"></em> {{ !empty($v->favor_num) ? $v->favor_num : '' }}</span>
			</li>
			@else
			<li class="itemFover" data-type="{{config('item.operate.favor.add')}}" title="赞">
				<span class="_itemBtn operating"> <em class="iconer iconfont icon-appreciate" data-mine="favor-icon"></em> {{ !empty($v->favor_num) ? $v->favor_num : '' }}</span>
			</li>
			@endif
			<li class="_borderNone" data-tip="打分">
				<span class="_itemBtn operating btn_show" data-type="show_score" data-show=".module_score" data-tip="打分">
					{{ empty($v->score_num) ? 0 : ($v->score_total*2)/$v->score_num }}分/{{ !empty($v->score_num) ? $v->score_num : 0 }}人</span>
			</li>
		</div>



		@if($v->sort == 1)
		<div class="_itemR" data-info="{{--news 好友请求处理--}}">
			<span class="_green1 _right item_status {{ $v->status_isset or '' }}">{{ $v->status or '' }}</span>

			<div class="item-handle news_request btn_delete_friend _none">
				<span class="_itemBtn operating showConfirmor" data-type="delete_friend" data-tip="拒绝请求？"> 解除关系</span>
			</div>
			<div class="item-handle news_request btn_refuse_friend">
				<span class="_itemBtn operating showConfirmor" data-type="refuse_friend" data-tip="拒绝请求？"> 拒绝</span>
			</div>
			<div class="item-handle news_request btn_add_friend">
				<span class="_itemBtn operating showConfirmor" data-type="add_friend" data-tip="添加好友？"> +好友</span>
			</div>
		</div>
		@endif



		{{-- module 打分 --}}
		<div class="_itemR item-module module_score module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_score score_text" placeholder="说点什么，"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left score_score" data-style="_radiorSelected" data-selected="0"
                     data-status="{{empty($v->user_item) ? 0 : $v->user_item->score_num}}">
					<span class="radior_1" data-selected="1"> {{config('item.itemBlade.scoreSort.1')}}</span>
					<span class="radior_1" data-selected="2"> {{config('item.itemBlade.scoreSort.2')}}</span>
					<span class="radior_1" data-selected="3"> {{config('item.itemBlade.scoreSort.3')}}</span>
					<span class="radior_1" data-selected="4"> {{config('item.itemBlade.scoreSort.4')}}</span>
					<span class="radior_1" data-selected="5"> {{config('item.itemBlade.scoreSort.5')}}</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right btn_score_confirm" data-sort="" data-type=""> 打分</span>
			</div>
		</div>
		<div class="_itemR item-module module_score _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox radior-parent _left" data-style="_radiorSelected">
					<span class="radior_0 comment_get @if(Auth::check()) defaultClicker @endif" data-getSort="special" data-sort="49" data-geter-sort="friend">好友打分</span>
					{{--<span class="radior_0 comment_get" data-getSort="special" data-sort="49" data-geter-sort="all">全部打分</span>--}}
				</div>
			</div>
		</div>



		{{-- module 回复 --}}
		<div class="_itemR item-module module_comment module-tools _none" data-info="{{-- module comment 回复 --}}">
			{{--<div class="_itemR comment_object"></div>--}}
			<div class="_itemR item-input">
				<textarea class="comment_text textarea-auto text_focus" placeholder="评论"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4 comment_tool">
				<div class="_radiorBox radior-parent _left comment_share" data-style="_radiorSelected" data-selected="100">
					<span class="radior_1" data-selected="11">悄悄评论</span>
					<span class="radior_1" data-selected="21">作者可见</span>
					<span class="radior_1" data-selected="41">好友可见</span>
					<span class="radior_1 _radiorSelected" data-selected="100">公开</span>
				</div>
				<div><span class="comment_get comment_get_special _hidden" data-sort="{{ $v->comment_special or '' }}"></span></div>
				<span class="_itemBtn _right btn_module_cansel" data-tip="">取消</span>
				<span class="_itemBtn _right btn_comment" data-type="">发送</span>
			</div>
		</div>
		<div class="_itemR item-module module_comment _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox radior-parent _left" data-style="_radiorSelected">
					<span class="radior_0 comment_get" data-getSort="all" data-sort="0" data-geter-sort="mine">与我相关</span>
					<span class="radior_0 comment_get @if(Auth::check()) defaultClicker @endif" data-getSort="all" data-sort="0" data-geter-sort="friend">好友评论</span>
					{{--<span class="radior_0 comment_get defaultClicker" data-getSort="all" data-sort="0" data-geter-sort="all">全部评论</span>--}}
				</div>
			</div>
		</div>



		{{-- module 收藏 --}}
		<div class="_itemR item-module module_collect module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus collect_text" placeholder="收藏"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left collect_share" data-style="_radiorSelected" data-selected="21">
					<span class="radior_1 _radiorSelected" data-selected="21">悄悄收藏</span>
					<span class="radior_1" data-selected="29">通知作者</span>
					<span class="radior_1" data-selected="41">好友可见</span>
					<span class="radior_1" data-selected="61">粉丝可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-tip="">取消</span>
				<span class="_itemBtn _right btn_collect_confirm" data-operate="{{config('item.operate.collect.add')}}">收藏</span>
			</div>
		</div>
		{{-- module 取消收藏 --}}
		<div class="_itemR item-module module_collectC module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus collectC_text" placeholder="移除收藏"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left collectC_share" data-style="_radiorSelected" data-selected="11">
					<span class="radior _radiorSelected" data-selected="11">悄悄移除</span>
					<span class="radior_1" data-selected="21">作者可见</span>
					<span class="radior_1" data-selected="41">好友可见</span>
					<span class="radior_1" data-selected="61">粉丝可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-tip="">取消</span>
				<span class="_itemBtn _right btn_collectC_confirm" data-operate="{{config('item.operate.collect.cansel')}}">移除收藏</span>
			</div>
		</div>
        <div class="_itemR item-module module_collect module_collectC _none">
            <div class="_itemR _irow4">
                <div class="_radiorBox radior-parent _left" data-style="_radiorSelected">
                    <span class="radior_0 comment_get @if(Auth::check()) defaultClicker @endif" data-getSort="special" data-sort="20" data-geter-sort="friend">好友收藏</span>
                    {{--<span class="radior_0 comment_get" data-getSort="special" data-sort="20" data-geter-sort="all">全部收藏</span>--}}
                </div>
            </div>
        </div>



		{{-- module 待办 --}}
		<div class="_itemR item-module module_workIt module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus workIt_text" placeholder="+待办，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left workIt_share" data-style="_radiorSelected" data-selected="11">
					<span class="radior_1 _radiorSelected" data-selected="11">悄悄添加</span>
					<span class="radior_1" data-selected="21">作者可见</span>
					<span class="radior_1" data-selected="41">密友可见</span>
					<span class="radior_1" data-selected="61">粉丝可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-tip="">取消</span>
				<span class="_itemBtn _right btn_workIt_confirm" data-operate="{{config('item.operate.work.add')}}">确认</span>
			</div>
		</div>
		{{-- module 移除待办 --}}
		<div class="_itemR item-module module_workItC module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus workItC_text" placeholder="移除待办，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left workItC_share" data-style="_radiorSelected" data-selected="11">
					<span class="radior_1 _radiorSelected" data-selected="11">悄悄移除</span>
					<span class="radior_1" data-selected="21">作者可见</span>
					<span class="radior_1" data-selected="41">密友可见</span>
					<span class="radior_1" data-selected="61">粉丝可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-tip="">取消</span>
				<span class="_itemBtn _right btn_workItC_confirm" data-operate="{{config('item.operate.work.cansel')}}">确认</span>
			</div>
		</div>
		<div class="_itemR item-module module_workIt module_workItC _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox radior-parent _left" data-style="_radiorSelected">
					<span class="radior_0 comment_get @if(Auth::check()) defaultClicker @endif" data-getSort="special" data-sort="21" data-geter-sort="friend">好友</span>
					{{--<span class="radior_0 comment_get" data-getSort="special" data-sort="21" data-geter-sort="all">全部</span>--}}
				</div>
			</div>
		</div>



		{{-- module 关注 --}}
		<div class="_itemR item-module module_focus module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus focus_text" placeholder="关注，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left focus_share" data-style="_radiorSelected" data-selected="100">
                    <span class="radior_1 _radiorSelected" data-selected="11">悄悄关注</span>
					<span class="radior_1" data-selected="21">作者可见</span>
					<span class="radior_1" data-selected="41">好友可见</span>
                    <span class="radior_1" data-selected="61">粉丝可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-tip="">取消</span>
				<span class="_itemBtn _right btn_focus_confirm" data-operate="{{config('item.operate.agenda.add')}}">关注</span>
			</div>
		</div>
		{{-- module 取消关注 --}}
		<div class="_itemR item-module module_focusC  module-tools _none">
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus focusC_text" placeholder="取消关注，说点什么"></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4">
				<div class="_radiorBox radior-parent _left focusC_share" data-style="_radiorSelected" data-selected="100">
					<span class="radior_1 _radiorSelected" data-selected="11">悄悄移除</span>
					<span class="radior_1" data-selected="21">作者可见</span>
					<span class="radior_1" data-selected="41">好友可见</span>
					<span class="radior_1" data-selected="61">粉丝可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right btn_focusC_confirm" data-operate="{{config('item.operate.agenda.cansel')}}">移除日程</span>
			</div>
		</div>
		<div class="_itemR item-module module_focus module_focusC _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox radior-parent _left" data-style="_radiorSelected">
					<span class="radior_0 comment_get @if(Auth::check()) defaultClicker @endif" data-getSort="special" data-sort="22" data-geter-sort="friend">好友关注</span>
					{{--<span class="radior_0 comment_get" data-getSort="special" data-sort="22" data-geter-sort="all">所有关注</span>--}}
				</div>
			</div>
		</div>



		{{-- module forward 转发 --}}
		<div class="_itemR item-module module-tools module_forward _none">
			<div class="_itemR forward_header _none">  </div>
			<div class="_itemR item-input">
				<textarea class="textarea-auto text_focus forward_text" placeholder=""></textarea>
			</div>
			<div class="_itemR _itemToolR _irow4 forward_tools">
				<div class="_radiorBox radior-parent _left forward-Share" data-style="_radiorSelected" data-selected="100">
					<span class="radior_1 _none" data-selected="21">自己可见</span>
					<span class="radior_1" data-selected="41">好友可见</span>
					<span class="radior_1 _radiorSelected" data-selected="100">所有人可见</span>
					{{--<span class="radior_1 FPM" data-selected="2" id=""> 转发给朋友</span> --}}
				</div>
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right btn_forward">转发</span>
			</div>
		</div>

		{{-- module write 记笔记 --}}
		<div class="_itemR item-module module-tools module_write _none">
			<div class="_itemR module_write_input">
				<input class="text_focus note_theme" type="text" placeholder="主题">
				<textarea class="textarea-auto note_content" placeholder="内容"></textarea>
				<input class="note_tag" type="text" placeholder="标签">
			</div>
			<div class="_itemR _itemToolR _irow4">
				<span class="_itemBtn _right btn_module_cansel"  data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right btn_write_confirm"  data-type="note" data-tip="添加？">添加笔记</span>
			</div>
		</div>


		{{-- module share 分享 --}}
		<div class="_itemR item-module module-tools module_share _none">
			<div class="_itemR _itemToolR _irow4 share_tools">
				<div class="_radiorBox radior-parent _left share_share" data-style="_radiorSelected" data-selected="0" data-status="{{ $v->share_status or '' }}">
					<span class="radior_1" data-selected="21">不分享</span>
					<span class="radior_1" data-selected="41">密友可见</span>
                    <span class="radior_1" data-selected="61">粉丝可见</span>
					<span class="radior_1" data-selected="100">所有人可见</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right btn_share">确定</span>
			</div>
		</div>



		{{-- module reward 打赏 --}}
		<div class="_itemR item-module module_reward module-tools _none">
			<div class="_itemR item-input">
				<input class="tip_text" type="text" placeholder="打赏语">
			</div>
			<div class="_itemR _itemToolR _irow4 tip_tools">
				<div class="item_tip_text _left"><input class="item-input text_focus tip_num" type="text" placeholder="赏金" value=""></div>
				<div class="_radiorBox radior-parent _left tip_share" data-style="_radiorSelected" data-selected="100">
					<span class="radior_1" data-selected="11">悄悄打赏</span>
					<span class="radior_1" data-selected="21">通知作者</span>
					<span class="radior_1" data-selected="41">好友可见</span>
					<span class="radior_1 _radiorSelected" data-selected="100">公开</span>
				</div>
				<span class="_itemBtn _right btn_module_cansel" data-type="" data-tip="">取消</span>
				<span class="_itemBtn _right btn_tip showConfirmor" data-type="reward" data-tip="确认打赏？">确定</span>
			</div>
		</div>
		<div class="_itemR item-module module_reward _none">
			<div class="_itemR _irow4">
				<div class="_radiorBox radior-parent _left" data-style="_radiorSelected">
					<span class="radior_0 comment_get @if(Auth::check()) defaultClicker @endif" data-getSort="special" data-sort="88" data-geter-sort="friend">好友打赏</span>
					{{--<span class="radior_0 comment_get" data-getSort="special" data-sort="88" data-geter-sort="all">全部打赏</span>--}}
				</div>
			</div>
		</div>

		<div class="_itemR item-module module-display module_display _none"></div>

	</div>

</div>
@else
	<div class="item-container">这天信息不见了，飞走了。</div>
@endif
@endforeach
@else
	空空如也！
@endif

