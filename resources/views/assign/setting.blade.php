<div class="setting-box">


<div class="set_header _none">我的名片</div>

<div class="card _none">
	
	<div class="card_portrait"><img src="./images/portrait/user{{ $info->id or 0 }}.jpg"></div>
	
	<div class="card_row"><span>{{ $info->name or '' }}</span></div>
	<div class="card_row"><span>{{ $info->realname or '' }}</span></div>
	<div class="card_row"><span>{{ $info->phone or '' }}</span></div>
	<div class="card_row"><span>{{ $info->email or '' }}</span></div>
	<div class="card_row"><span>{{ $info->autograph or '' }}</span></div>
	<div class="card_row">
		<span>{{ $info->company or '' }} / {{ $info->companyDepartment or '' }} / {{ $info->companyPosition or '' }}</span>
	</div>
	<div class="card_row"><span>{{ $info->birth_show or '' }}</span></div>
	<div class="card_row"><span></span></div>
	<div class="card_row"><span></span></div>
	<div class="card_row"><span></span></div>
	
	<div class="card_num_row">
		<span class="card_num"> 时刻 {{ $info->timer_total or '' }}</span>
		<span class="card_num"> 笔记 {{ $info->note_total or '' }}</span>
		<span class="card_num"> 提问 {{ $info->ask_total or '' }}</span>
        <span class="card_num"> 商品 {{ $info->goods_total or '' }}</span>
	</div>

</div>

<div class="set_header _none"></div>

<div class="set-row" id="altContent">
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
	codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"
	WIDTH="650" HEIGHT="450" id="myMovieName">
<PARAM NAME=movie VALUE="avatar.swf">
<PARAM NAME=quality VALUE=high>
<PARAM NAME=bgcolor VALUE=#FFFFFF>
<param name="flashvars" value="imgUrl=/images/portrait/user{{ auth()->id() }}.jpg&uploadUrl=/upfile.php&uploadSrc=false" />
<EMBED src="avatar.swf" quality=high bgcolor=#FFFFFF WIDTH="650" HEIGHT="450" wmode="transparent"
    flashVars="imgUrl=/images/portrait/user{{ auth()->id() }}.jpg&uploadUrl=/upfile.php&uploadSrc=false"
    NAME="myMovieName" ALIGN="" TYPE="application/x-shockwave-flash" allowScriptAccess="always"
	PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
</EMBED>
</OBJECT>
</div>
<div id="avatar_priview"></div>


    <div class="set-row _none"><span class="set-title">轻博号(只能修改一次, 字母+数字, 首字符字母)</span></div>
    <div class="set-row _none"><input type="text" value="{{ $info->pass_name or '' }}" placeholder="轻博号" name="passname" /></div>

<form id="setting-form" action="{{url('setting/set')}}" method="post">
    {{csrf_field()}}

    <div class="set-row"><span class="set-title">轻博ID &nbsp; <span class="_f14 _bold">{{ Auth::id() }}</span></span></div>

    <div class="set-row"><span class="set-title">昵称</span></div>
    <div class="set-row"><input type="text" value="{{ $info->nickname or '' }}" placeholder="请填写昵称" name="nickname" /></div>

    <div class="set-row"><span class="set-title">真实姓名</span></div>
    <div class="set-row"><input type="text" value="{{ $info->realname or '' }}" placeholder="请填写真实姓名" name="realname" /></div>

    <div class="set-row"><span class="set-title">个性签名</span></div>
    <div class="set-row"><input type="text" value="{{ $info->autograph or '' }}" placeholder="请填写个性签名" name="autograph" /></div>

    <div class="set-row"><span class="set-title">手机</span></div>
    <div class="set-row"><input type="text" value="{{ $info->phone or '' }}" placeholder="请填写手机" name="phone" /></div>
	
    <div class="set-row"><span class="set-title">邮箱</span></div>
    <div class="set-row"><input type="text" value="{{ $info->email or '' }}" placeholder="请填写邮箱" name="email" /></div>

    <div class="set-row"><span class="set-title">生日</span></div>
    <div class="set-row"><input type="text" value="{{ date_show($info->birth) }}" placeholder="请选择日期" name="birth" class="date-picker" id="birth-picker" /></div>

    <div class="set-row"><span class="set-title">现居地</span></div>
    <div class="set-row"><input type="text" value="{{ $info->present or '' }}" placeholder="请填写现居地" name="present" /></div>

    <div class="set-row"><span class="set-title">家乡</span></div>
    <div class="set-row"><input type="text" value="{{ $info->hometown or '' }}" placeholder="请填写家乡" name="hometown" /></div>

    <div class="set-row"><span class="set-title">公司</span></div>
    <div class="set-row"><input type="text" value="{{ $info->company or '' }}" placeholder="请填写公司" name="company" /></div>
    <div class="set-row"><input type="text" value="{{ $info->company_department or '' }}" placeholder="请填写部门" name="company_department" /></div>
    <div class="set-row"><input type="text" value="{{ $info->company_position or '' }}" placeholder="请填写职位" name="company_position" /></div>

    <div class="set-row"><span class="set-title">学校</span></div>
    <div class="set-row"><input type="text" value="{{ $info->school or '' }}" placeholder="请填写学校" name="school" /></div>
    <div class="set-row"><input type="text" value="{{ $info->school_department or '' }}" placeholder="请填写院系" name="school_department" /></div>
    <div class="set-row"><input type="text" value="{{ $info->school_major or '' }}" placeholder="请填写专业" name="school_major" /></div>


    <div class="set-row"><span class="set-title">修改密码</span></div>
    <div class="set-row"><input type="password" placeholder="原密码" name="password_pre" /></div>
    <div class="set-row"><input type="password" placeholder="新密码" name="password_new" /></div>
    <div class="set-row"><input type="password" placeholder="确认密码" name="password_confirm" /></div>


    <div class="set-row"><input type="button" value="提交" class="btn _bold submit-btn" id="setting-submit"></div>

</form>


<div class="set_header"></div>
<div class="set-row set_header _none">设置权限</div>
	
<div class="set-row set_timer _none" data-share="{{ $info->timer or '' }}" data-info="{{--时刻--}}">
	<div class="set-title"> 时刻 </div>
	<div class="set_entity"></div>
	<span class="set_tool box_shower set_edit" data-parent=".set_timer" data-shower=".set_hide"> 编辑 </span>
	<div class="set_state">{{ $info->timerState or '' }}</div>
			
	<div class="set_hide">
		<span class="set_selector radio_selecter" data-parent=".set_timer" data-share="0"> 自己可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_timer" data-share="1"> 好友可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_timer" data-share="2"> 所有人可见 </span>
		<span class="set_tool set_confirmC set_confirm" data-parent=".set_timer" data-type="timer"> 确认修改 </span>
	</div>
</div>
	
<div class="set-row set_note _none" data-share="{{ $info->note or '' }}" data-info="{{--笔记--}}">
	<div class="set-title"> 笔记 </div>
	<div class="set_entity"></div>
	<span class="set_tool box_shower set_edit" data-parent=".set_note" data-shower=".set_hide"> 编辑 </span>
	<div class="set_state">{{ $info->noteState or '' }}</div>
			
	<div class="set_hide">
		<span class="set_selector radio_selecter" data-parent=".set_note" data-share="0"> 自己可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_note" data-share="1"> 好友可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_note" data-share="2"> 所有人可见 </span>
		<span class="set_tool set_confirmC set_confirm" data-parent=".set_note" data-type="note"> 确认修改 </span>
	</div>
</div>
	
<div class="set-row set_ask _none" data-share="{{ $info->ask or '' }}" data-info="{{--求助--}}">
	<div class="set-title"> 提问 </div>
	<div class="set_entity"></div>
	<span class="set_tool box_shower set_edit" data-parent=".set_ask" data-shower=".set_hide"> 编辑 </span>
	<div class="set_state">{{ $info->askState or '' }}</div>
			
	<div class="set_hide">
		<span class="set_selector radio_selecter" data-parent=".set_ask" data-share="0"> 自己可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_ask" data-share="1"> 好友可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_ask" data-share="2"> 所有人可见 </span>
		<span class="set_tool set_confirmC set_confirm" data-parent=".set_ask" data-type="ask"> 确认修改 </span>
	</div>
</div>
	
<div class="set-row set_answer _none" data-share="{{ $info->answer or '' }}" data-info="{{--帮助--}}">
	<div class="set-title"> 帮助 </div>
	<div class="set_entity"></div>
	<span class="set_tool box_shower set_edit" data-parent=".set_answer" data-shower=".set_hide"> 编辑 </span>
	<div class="set_state">{{ $info->askState or '' }}</div>
			
	<div class="set_hide">
		<span class="set_selector radio_selecter" data-parent=".set_answer" data-share="0"> 自己可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_answer" data-share="1"> 好友可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_answer" data-share="2"> 所有人可见 </span>
		<span class="set_tool set_confirmC set_confirm" data-parent=".set_answer" data-type="answer"> 确认修改 </span>
	</div>
</div>
		
<div class="set-row set_collection _none" data-share="{{ $info->collection or '' }}" data-info="{{--收藏--}}">
	<div class="set-title"> 收藏 </div>
	<div class="set_entity"></div>
	<span class="set_tool box_shower set_edit" data-parent=".set_collection" data-shower=".set_hide"> 编辑 </span>
	<div class="set_state">{{ $info->collectionState or '' }}</div>
			
	<div class="set_hide">
		<span class="set_selector radio_selecter" data-parent=".set_collection" data-share="0"> 自己可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_collection" data-share="1"> 好友可见 </span>
		<span class="set_selector radio_selecter" data-parent=".set_collection" data-share="2"> 所有人可见 </span>
		<span class="set_tool set_confirmC set_confirm" data-parent=".set_collection" data-type="collection"> 确认修改 </span>
	</div>
</div>


<div class="set_header"></div>


</div>

<script>
    $("#birth-picker").datetimepicker({
        format: 'Y-m-d',
        timepicker:false,
        lang:'ch'
    });
</script>
