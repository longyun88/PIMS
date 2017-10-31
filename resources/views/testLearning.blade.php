<!DOCTYPE html>
<html ng-app="pimsApp" ng-controller="myCtrl">
<head>
	<title> learning  </title>
	<meta charset=utf-8" />
	<meta name="_token" content="{{ csrf_token() }}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	
	
	<script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>  
	
	<script type="text/javascript" src="/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/angular-1.0.1.min.js"></script>
	
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
	
	<script type="text/javascript" src="/js/jquery.dotdotdot.min.js"></script>
	<script type="text/javascript" src="/js/jquery.uploadify.min.js"></script>
	
	<script type="text/javascript" src="/js/layer/layer.js"></script>
	<script type="text/javascript" src="/js/plugin/messenger.min.js"></script>
	
	
	<script type="text/javascript" src="/js/common.js"></script>
	
	<script type="text/javascript" src="/js/test.js"></script>
	<script type="text/javascript" src="/js/test.learning.js"></script>
	
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet/less" type="text/css" href="/css/test.less">
	<script src="http://cdn.bootcss.com/less.js/1.7.0/less.min.js"></script>
	
</head>
<body>
	
<div class="ajaxTest" ><span class="ajaxTestShow" MD-id="s1" MD-type="op"> 测试 </span></div>


		<b>AngularJs模式</b>
		<ul>
			<li>姓：<input type="text" ng-model="xing" /></li>
			<li>名：<input type="text" ng-model="ming" /></li>
			<li>Hello <b> [% xing || '' %] [% ming || '' %] </b></li>
			<li><a href="#" >输出姓名</a></li>
		</ul>
  
  李大伟_大不发音
		
		<b>传统模式</b>
		<ul>
			<li>姓：<input type="text" id="xingInput" /></li>
			<li>名：<input type="text" id="mingInput" /></li>
			<li>Hello <b id="nameView"></b></li>
			<li><a href="#" id="showButton">输出姓名</a></li>
		</ul>
	
<span class="xx">shuchu</span>
<div class="yy"></div>


 @include('UEditor::head')
<!-- 加载编辑器的容器 -->
<script id="container" name="content" type="text/plain" style="width:680px;">
 这里写你的初始化内容
</script>

<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
	ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
    });


	$(document).on("click",".xx",function() {
		var html = ue.getContent();
        $(".yy").html(html);
	});

</script>



<script type="text/javascript">
	
if (localStorage.pagecount)
  {
  localStorage.pagecount=Number(localStorage.pagecount) +1;
  }
else
  {
  localStorage.pagecount=1;
  }
document.write("Visits sss "+localStorage.pagecount+" time(s) this session.");
if (sessionStorage.pagecount)
  {
  sessionStorage.pagecount=Number(sessionStorage.pagecount) +1;
  }
else
  {
  sessionStorage.pagecount=1;
  }
document.write("Visits "+sessionStorage.pagecount+" time(s) this session.");
</script>
	<script>
	</script>
	
</body>
</html>
