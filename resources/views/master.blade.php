<!DOCTYPE html>
<html ng-app="pimsApp" ng-controller="myCtrl">
<head>
	<title>@yield('title')</title>
	<meta charset=utf-8" />
	<meta name="_token" content="{{ csrf_token() }}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />


    {{--<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">--}}
    {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
	<link rel="stylesheet" href="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/datatables/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-modal/0.8.2/jquery.modal.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-datetimepicker/2.5.4/jquery.datetimepicker.css">

    <link rel="stylesheet" href="/css/common.css" />
    <link rel="stylesheet" href="/css/common.page.css" />
    <link rel="stylesheet" href="/css/item.css" />
    <link rel="stylesheet" href="/css/tool.css" />
    <link rel="stylesheet" href="/css/iconfont.css" />


    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" href="/css/uploadify.css">
	
	{{--<link rel="stylesheet/less" href="/css/style.less">--}}
	{{--<script src="http://cdn.bootcss.com/less.js/1.7.0/less.min.js"></script>--}}
	<script src="https://cdn.bootcss.com/angular.js/1.6.5/angular.min.js"></script>
	<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--<script src="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>--}}
    <script src="https://cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.full.min.js"></script>
    <script src="https://cdn.bootcss.com/datatables/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-modal/0.8.2/jquery.modal.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.js"></script>


	<script src="https://cdn.bootcss.com/jQuery.dotdotdot/1.8.3/jquery.dotdotdot.min.js"></script>
	<script src="https://cdn.bootcss.com/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

	<script src="/js/plugins/jquery.mCustomScrollbar.min.js"></script>
	<script src="/js/plugins/jquery.uploadify.min.js"></script>


    <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script src="https://cdn.bootcss.com/jquery-migrate/3.0.0/jquery-migrate.min.js"></script>
    <script src="https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js"></script>

	
	<script src="/js/common.js"></script>
	<script src="/js/Home/item.js"></script>
	<script src="/js/Home/display.js"></script>
    <script src="/js/Tools/time.js"></script>
    <script src="/js/Tools/adder.js"></script>
	
	@yield('MySpecial')
	
</head>
<body style="height:100%;">
	@yield('content')
</body>
</html>
