@extends('master')

@section('MySpecial')
	<link type="text/css" rel="stylesheet" href="/css/login.css" />
	<script type="text/javascript" src="/js/login.js"></script>
@endsection

@section('title','设置附图')

@section('content')
	<p> 设置附图 </p>
	@include('setFuncPage')
@endsection