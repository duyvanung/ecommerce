@extends('layouts.master')

@section('title','Phụ Kiện BiJing')

@section('content')

<div id="home">
	<section id="featured">
		<div class="row">
		<div class="hidden-xs col-sm-4 col-md-3">
			<div class="boxleft">
				@include('layouts.category')
			</div>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-9">
			<div class="slider-wrapper theme-default">
	            <div id="slider" class="nivoSlider">
	            @foreach ($slider as $item)
	                <a href=""><img src="{{ asset('images').'/'.$item->path }}" alt="" /></a>
	            @endforeach
	            </div>
	        </div>
		</div>
		<div class="banner clearfix hidden-xs">
			@foreach($banner as $item)
			<div class="col-xs-12 col-sm-6">
				<img src="{{ asset('images').'/'.$item->path }}" alt="">
			</div>
			@endforeach
		</div>
		</div>
	</section>
	<section id="main">
		<div class="row">
		<div id="left" class="col-xs-12 col-sm-4 col-md-3">
			@include('layouts.home-main-left')
		</div>
		<div id="maincontent" class="col-xs-12 col-sm-8 col-md-9">
			<div class="boxmain spmoi">
				@include('layouts.spmoi')
			</div>
			<div class="boxmain">
			    @include('layouts.home-main-content')
			</div>
		</div>
		</div>
	</section>
</div>

@endsection

@section('js')
<script type="text/javascript">

</script>

@endsection