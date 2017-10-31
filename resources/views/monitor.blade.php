@extends('master')

@section('MySpecial')
@endsection

@section('title','MyMonitor')

@section('content')
	<p class="_none"> 这是xx </p>
	<p class="_nones"> {!! $data['assignHTML'] or '' !!} </p>
@endsection