{{--adder 标识--}}
<div class="_mark _adder_mark" id="adder-mark" data-info="{{--adder 标识--}}"
	data-operate="add" data-display="item" 
	data-id=""
	data-sort="0" data-type="0" data-form="0"
	data-working="0" data-importance="0"
	data-time-type="0" data-attaching=""  data-attachment="" data-share=""
></div>


{{--PC端 adder--}}
<div class="LB-page _mainLeft display-hide" id="item-adder">
<div class="adder-container input_ctn" id="input_item_ctn">
	
	<div class="input-menu adderRow_Sort" data-info="{{--类型--}}">
        <div class="btn _hoverG input-option" data-titler="添加 轻博" title="说点什么" id="show_add_words">轻博</div>
		<div class="btn _hoverG input-option" data-titler="添加 笔记" title="笔记可修改" id="show_add_note">笔记</div>
		<div class="btn _hoverG input-option" data-titler="添加 提问" title="请人回答" id="show_add_ask">提问</div>
		<div class="btn _hoverG input-option" data-titler="添加 商品" title="添加商品" id="show_add_goods">商品</div>
		<div class="btn _hoverG input-option" data-titler="发送 私信" title="发送私信" id="show_add_pm">私信</div>
	</div>
	
	<div class="input-main adderRow_Main">
	
		<div class="input_r adderRow adderRow_Share" data-info="{{--分享--}}">
			<div class="radior_box radior-parent _right input_share adderInput-Share" data-style="radior_selected" data-selected="" id="input_share">
				<span class="btn radior_1" data-selected="21" id="input_share_none"> 不分享 </span>
				<span class="btn radior_1" data-selected="41" id="input_share_friend"> 好友可见 </span>
                <span class="btn radior_1" data-selected="51" id="input_share_friend"> 粉丝可见 </span>
				<span class="btn radior_1" data-selected="100" id="input_share_all"> 所有人可见 </span>
			</div>
		</div>


		<div class="input_r adderRow adderRow_Goods _none" data-info="{{--商品选项--}}">
			<div class="radior_box radior-parent _right" data-style="radior_selected" data-selected="" id="">
				<span class="btn radior_1" data-selected="1" id="input_goods_new"> 新品 </span>
				<span class="btn radior_1" data-selected="2" id="input_goods_second"> 二手 </span>
				<span class="btn radior_1" data-selected="3" id="input_goods_service"> 服务 </span>
				<span class="btn radior_1" data-selected="9" id="input_goods_give"> 闲置免费送 </span>
			</div>
		</div>

        <div class="input_r adderRow adderRow_Goods _none" data-info="{{--商品价格--}}">
            <div class="input_r row_input ">
                <input type="text" class="adderInput-Price" id="input_price" placeholder="价格" />
            </div>
        </div>
	
		<div class="input_r adderRow adderRow_Receiver _none" data-info="{{--收件人--}}">
			<div class="select_receiver-selector" title="选择联系人">收件人:</div>
			<div class="adderRow_Receiver_c pm_receiver"></div>
		</div>
		
		<div class="input_r adderRow inputT_time adderRow_Time" data-info="{{--日程选项--}}">
			<div class="radiorOnlyH radiorOnly1 _left" data-select="radiorOnly1Selected" data-selected="0" id="inputF-timing" data-info="">
				<span class="btn " id=""> <span class="iconer yes-icon _none"> </span> 选择时间 </span>
			</div>

			<div class="radior_box radior-parent _right  inputB_time _none" data-style="radior_selected" data-selected="" id="">
				<span class="btn radior_1" data-selected="0" id="input_agenda_once"> 一次性 </span>
				<span class="btn radior_1" data-selected="1" id="input_agenda_cycle"> 周期型 </span>
			</div>
		</div>
		
		<div class="input_r adderRowS input_time input_once adderTime_once adderRow_Once _none" data-info="{{--一次时间--}}">
	
			<div class="input_time_s" style="position: relative;">
				<input type="text" readonly class="show_time_selector adderInput-Only-Start" id="input_start" data-type="0" placeholder="开始时间"  />
				<span class="btn time_empty" value="#input_start" id="start_empty"><span class="close_btn_hover"></span></span>
			</div>
			<div class="input_time_s">
				<input type="text" readonly class="show_time_selector adderInput-Only-Ended" id="input_ended" data-type="0" placeholder="结束时间" />
				<span class="btn time_empty" value="#input_ended" id="ended_empty"><span class="close_btn_hover"></span></span>
			</div>
	
		</div>
		<div class="input_r adderRowS input_time input_cycle adderTime_cycle adderRow_Cycle _none" data-info="{{--周期时间--}}">
			<div class="input_time_s">
				<input type="text" readonly class="show_cycle_selector adderInput-Cycle-Start" id="input_cycle_start" data-type="0" placeholder="周期 开始时间" />
				<span class="btn time_empty" value="#input_cycle_start" id="start_cycle_empty"><span class="close_btn_hover"></span></span>
			</div>
			<div class="input_time_s">
				<input type="text" readonly="readonly" class="show_cycle_selector adderInput-Cycle-Ended" id="input_cycle_ended"
					data-type="0" placeholder="周期 结束时间" />
				<span class="btn time_empty" value="#input_cycle_ended" id="ended_cycle_empty"><span class="close_btn_hover"></span></span>
			</div>
		</div>
		
		<div class="input_r adderRow input-entity adderInput-entity adderRow_InputEntity" data-info="{{--内容--}}">
			<div class="input_r row_input input_theme adder_theme adderInputTheme adderRow_Theme">
				<input type="text" class="_bold adderInput-Theme" id="input_theme" placeholder="标题" />
			</div>
			<div class="input_r row_textarea input_content adder_content">
				<textarea class="textarea-auto adderInput-Content" placeholder="内容" id="input_content"></textarea>
			</div>
			<div class="input_r row_input input_tag adder_tag adderInputTag">
				<input type="text" class="_bold adderInput-Tag" id="input_tag" placeholder="标签，多个标签用 “空格” 隔开…">
			</div>
		</div>
		
		<div class="input_r adderRow inputT_work adderRow_Working" data-info="{{--待办--}}">
			<div class="radiorOnlyH radiorOnly1 _left" data-select="radiorOnly1Selected" data-selected="0" id="inputF-working" data-info="">
				<span class="btn" id=""> <span class="iconer yes-icon _none"> </span> 添加为待办 </span>
			</div>
			<div class="radior_box radior-parent _right input_important adderInput-Importance _none"  id="input_important" data-info="{{--重要性--}}"
                 data-style="radior_selected" data-selected="0">
				<span class="btn radior_1" data-selected="1" id="important_general"> 1一般 </span>
				<span class="btn radior_1" data-selected="2" id=""> 2中等 </span>
				<span class="btn radior_1" data-selected="3" id=""> 3重要 </span>
				<span class="btn radior_1" data-selected="4" id=""> 4紧急 </span>
				<span class="btn radior_1" data-selected="5" id=""> 5重要&紧急 </span>
			</div>
		</div>

	</div>

	<div class="input-attach">
		
		<div class="upImage-buttom-ctn">
			<span class="upImage-btn little_btn start _none"> 上传 </span>
			<span class="upImage-btn little_btn clear _none"> 清空 </span>
			<input id="file_upload" name="file_upload" type="file" multiple="true">
			<div id="queue"></div>
		</div>
		
		<div class="upImage-image-ctn">
			<div class="upImage-page upImage_clone _none"></div>
		</div>
		
	</div>

	<div class="adderRow_Confirm">
		
		<div class="input-attach-header" data-info="{{--确认&取消--}}">
			<span class="input-btn _right input_cansel" id="input_cansel"> 取消 </span>
			<span class="input-btn _left" id="input_confirm"
				data-operate="add" data-id="" data-userItemId="" data-sort="" data-type="0" data-form="0" data-attaching="" data-attachment=""
			> 添加 </span>
		</div>
		
	</div>

</div>
</div>





<div class="receiver-selector">
	
	<div class="receiver-header">
		
		<span class="btn receiverbtn _option receiver_category shower" id="receiver_contact"
			data-hide=".receiver_entity" data-show="#receiver-linkman-ctn">联系人</span>
		
		<span class="btn receiverbtn _option receiver_category shower" id="receiver_group"
			data-hide=".receiver_entity" data-show="#receiver-group-ctn">群 / 组</span>
		
		<span class="btn receiverbtn _option receiver_category shower" id="receiver_project"
			data-hide=".receiver_entity" data-show="#receiver-project-ctn">项目</span>

		<span class="btn hider receiver_hider" data-parent="2">OK</span>
		
	</div>
	
	<div class="receiver-entity" id="receiver-linkman-ctn">contact</div>
	<div class="receiver-entity" id="receiver-group-ctn">group</div>
	<div class="receiver-entity" id="receiver-project-ctn">project</div>
	
</div>


<div class="hidden_tool _none">
	<div class="pm_object">
		<span class="object_name">name</span>
		<span class="object_delete"></span>
	</div>
</div>