@extends('master')

@section('MySpecial')
	<link type="text/css" rel="stylesheet" href="/css/login.css" />
	<script type="text/javascript" src="/js/login.js"></script>
@endsection

@section('title','登陆页')

@section('content')
	<p class="_none"> 这是登陆页 </p>


	<div class="_none" id="login-mark"
		 data-init={{ $login['init'] or '' }}
	></div>


	<div class="log-container login_ctn" data-info="{{--登录--}}">
		<div class="log-entity login_entity">

			<div class="input_row row-top login_account">
				<input type="text" placeholder="Email" id="login_account">
			</div>
			<div class="input_row row-bottom login_password">
				<input type="password" autocomplete="off" placeholder="密码" id="login_password">
			</div>

		</div>
		<div class="input-tip"></div>
		<div class="btn input-submit confirm-btn" id="login_confirm">登 录</div>
		<div class="btn input-submit log-btn show_register" id="login-to-register"> 注册新用户 </div>
		<div class="btn input-submit log-btn direct_guest"> 游客访问 </div>
		<div class="input-tips _none"> 试用账户 ID:100 密码:guest </div>

		<div class="input_logos _bold _none"> 莲花树科技 出品 </div>
	</div>

	<div class="log-container register_ctn _none" data-info="{{--注册--}}">
        <form id="register-form">
		<div class="log-entity register-body" id="register">

            <div class="input_row row-top">
                <input type="text" placeholder="Email" id="register-email" name="pass_email">
                <span class="input_explain"></span>
            </div>
			<div class="input_row row-top _none">
				<input type="text" placeholder="手机号" id="register-phone" name="pass_phone">
				<span class="input_explain"></span>
			</div>
            <div class="input_row _none">
                <input type="text" placeholder="用户名,只支持英文与数字" id="register-name" name="pass_name">
                <span class="input_explain"></span>
            </div>
            <div class="input_row">
                <input type="text" placeholder="昵称" id="register-nickname" name="nickname">
                <span class="input_explain"></span>
            </div>
			<div class="input_row">
				<input type="password" placeholder="密码" id="register-password" name="password">
				<span class="input_explain"></span>
			</div>
			<div class="input_row">
				<input type="password" placeholder="重复密码" id="register-password-confirm" name="password_confirm" data-password="#register-password">
				<span class="input_explain"></span>
			</div>
			<div class="input_row _none">
				<input type="text" placeholder="真实姓名" id="register-realname" name="realname">
				<span class="input_explain"></span>
			</div>
			<div class="input_row row-bottom">
				<span class="sex-selector row_left sex-selected" data-sex="1"> 男 </span>
				<span class="sex-selector row_right" data-sex="2">女</span>
			</div>

            <input type="hidden" placeholder="" id="register-sex" name="gender" value="1">
            {{ csrf_field() }}

		</div>
        </form>
		<div class="input-tip"></div>
		<div class="btn input-submit confirm-btn" id="register-confirm">注 册</div>
		<div class="btn input-submit log-btn show_login" id="login-to-login"> 返回登录 </div>
		<div class="btn input-submit log-btn direct_guest"> 游客访问 </div>

	</div>

	<div class="intro-words _none">
		当我画一个太阳，我希望人们感觉它在以惊人的速度旋转，正在发出骇人的光热巨浪。<br/>
		当我画一片麦田，我希望人们感觉到原子正朝着它们最后的成熟和绽放努力。<br/>
		当我画一棵苹果树，我希望人们能感觉到苹果里面的果汁正把苹果皮撑开，果核中的种子正在为结出果实奋进。<br/>
		当我画一个男人，我就要画出他滔滔的一生。<br/>
		—— 凡高<br>
	</div>



	@include('tools.tool')
@endsection
