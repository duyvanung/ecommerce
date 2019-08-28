@extends('layouts.master')

@section('title','Liên hệ')

@section('content')

<div class="container main-contact">
	<div id="left" class="col-xs-12 col-sm-8 col-md-9">
		<div class="td-page-content">
			<h2>Liên hệ với chúng tôi</h2>
			<p>Hotline:&nbsp;<strong>01649.629.629</strong></p>
			<p>Địa chỉ:&nbsp;Hẻm 211 Nguyễn Xí, phường 26, Bình Thạnh</p>
		</div>
	</div>
	<div id="maincontent" class="col-xs-12 col-sm-4 col-md-3">
		@include('layouts.home-main-left')
	</div>
</div>

@endsection


@section('css')

<style type="text/css">
	.main-contact{
		padding-top: 20px;
	}
</style>

@endsection