@extends('master')

@section('title','learningTest')

@section('MySpecial')
	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet/less" type="text/css" href="/css/test.less">
	<script src="http://cdn.bootcss.com/less.js/1.7.0/less.min.js"></script>
@endsection

@section('content')
<div class="ajaxTest" ><span class="ajaxTestShow"> 测试 </span></div>


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
	
	

	<script>
			var xing = document.getElementById("xingInput");
			var ming = document.getElementById("mingInput");
			
			var showButton =document.getElementById("showButton");
			showButton.onclick=function(){
				var name = xing.value+" "+ming.value;
				var nameView = document.getElementById("nameView");
				nameView.innerHTML = name;
				return false;
			}
			var myApp = angular.module('pimsApp', [], function($interpolateProvider) {
				$interpolateProvider.startSymbol('[%');
				$interpolateProvider.endSymbol('%]');
			});
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
	
@endsection


