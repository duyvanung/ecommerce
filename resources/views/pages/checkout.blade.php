@extends('layouts.master')

@section('title','Giỏ hàng')

@section('content')
<div id="checkout-info">
	<div class="col-md-6 col-md-offset-3">
		<h1>Thông tin giao hàng</h1>
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li class="alert-dismissible fade in">{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form action="{{ route('placeAnOrder') }}" method="POST">
			<div class="form-group">
				<label>Họ và tên:</label>
				<input type="text" name="user_name" class="form-control" value="{{ old('user_name') }}" required>
			</div>
			<div class="form-group">
				<label>Số điện thoại:</label>
				<input type="text" name="user_phone" class="form-control" value="{{ old('user_phone') }}" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="user_email" class="form-control" required value="{{ isset(Auth::user()->email) ? Auth::user()->email : '' }}">
			</div>
			<div class="form-group">
				<label>Địa chỉ nhận hàng:</label>
				<input type="text" name="user_address" class="form-control" value="{{ old('user_address') }}" required>
			</div>
			<div class="form-group">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<button type="submit" class="btn btn-primary">Đặt hàng</button>
				<button type="button" class="btn btn-danger cancel-order">Hủy</button>
			</div>
		</form>
	</div>
</div>
@endsection


@section('css')

<style type="text/css">
	#checkout-info{
		padding-bottom: 50px;
	}
	h1{
		margin-top: 30px;
		margin-bottom: 30px;
	}
	h3{
		text-align: right;
	}
	.alert ul li{
		list-style: none;
	}
</style>

@endsection


@section('js')
<script type="text/javascript">
	$(document).on('click','.cancel-order', function(){
		window.location = "{{ route('homepage')}}";
	});

	// $(document).ready(function(){
	// 	var state = "{{ Session::has('checkout_state') ? Session::get('checkout_state'): -1 }}";
	// 	if (state != 0 && state != -1 ){
	// 		alert("Đơn hàng đã được gửi");
	// 		window.location = "{{ route('homepage') }}";
	// 	}
	// });	
</script>
@endsection