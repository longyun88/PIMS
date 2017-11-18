@extends('layout.layout')

@section('title','我的PIMS后台')
@section('header','我的PIMS后台')
@section('description','我的PIMS后台')
@section('breadcrumb')
    <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i>首页</a></li>
    <li><a href="#"><i class="fa "></i>Here</a></li>
@endsection

@section('content')
admin.index
@endsection


@section('js')
    <script>
        $(function() {
        });
    </script>
@endsection
