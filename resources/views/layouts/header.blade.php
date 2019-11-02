
<style type="text/css">
	.navbar-right{
		margin-right: 0px;
	}
	#search {
		display: relative;
	}
	#search-content{
		/*max-width: 300px;*/
		display: block;
		position: absolute;
		background-color: white;
		min-width: 200px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  		z-index: 10;
  		border: 1px solid #f1f1f1;
  		border-top: 0px;
	}
	#search-content a{
		padding: 5px;
		color: black;
		text-decoration: none;
		display: block;
		clear: both;
		height: 80px;
	}

	#search-content .item-thumbnail{
		display: inline-block;
		width: 25%;
		float: left;
	}
	#search-content .item-info{
		margin-top: 10px;
		display: inline-block;
		width: 74%;
	}

	.item-info .item-price{
		color: red;
	}

	.item-thumbnail img{
		max-width: 90%;
		max-height: 90%;
	}

	#search-content a:hover {background-color: #ddd;}
</style>
<header id="header">
	<div class="topbar">
		<div class="container">
			<div class="col-xs-12 col-sm-6 p0 hotline-top">
				<img src="{{ asset('images/phone-24.png') }}" alt="hotline" />
				<p>Điện thoại: <a href="tel:01649.629.629">036.666.3616</a></p>
			</div>
		</div>
	</div>
	<div class="header">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-4">
				<div id="logo">
					<a href="{{ route('homepage') }}"><img src="{{ asset('images/logo-1.png') }}" alt=""></a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-5 search-container">
				<div id="search">
					<form action="{{ route('search') }}" method="post" id="search-form">
						<div class="input-group">
							<input id="input-search" class="form-control" type="text" name="txt_search" placeholder="Tìm phụ kiện" autocomplete="off">
							<span class="input-group-btn">
								<button type="submit" class="btn">Tìm kiếm</i></button>
							</span >
						</div>
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					</form>
					<div id="search-content">
	
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="row nav-header">
					<div class="col-xs-8 col-sm-8 col-md-12">
						<div class="cart">
							<div class="discart">
								<a href="{{ route('shoppingCart') }}"><span class="mycart">Giỏ hàng:</span></a>
								@if (Session::has('products'))
								<span class="count_products_cart">{{count(Session::get('products'))}} sản phẩm</span>
								@else
								<span class="count_products_cart">0 sản phẩm</span>
								@endif
							</div>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-12">
						<div class="user">
						@guest
						<ul class="nav navbar-nav navbar-right">
					      <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
					      <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					    </ul>
						@endguest
						@auth
						<div class="user-login">
							<div class="dropdown">
								<a data-toggle="dropdown" href="">{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}<span class="caret"></span></a>
								<ul class="dropdown-menu" style="min-width: fit-content; margin-left: -30px" role="menu" aria-labelledby="dropdownMenu1">
									<li role="presentation"><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
									<li role="presentation" class="divider"></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('show-profile') }}">Thông tin</a></li>
								</ul>
							</div>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
							</form>
						</div>
						@endauth
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<nav id="mainmenu" class="hidden-xs hidden-sm ">
		<div class="container">
			<ul class="x1">
				<li><a href="{{ url('/') }}">Trang chủ</a></li>
				<li>
					<a>Sản phẩm</a>
					<i class="fa fa-caret-down" aria-hidden="true"></i>
					<ul class="drop2">
						@foreach($categories as $cate)
							@if ($cate->level > 1)
								@continue
							@endif
							<?php $hasChild = 0 ?>
							@foreach($categories as $item)
								@if($item->parent_id == $cate->id)
									<?php $hasChild = 1 ?>
									@break
								@endif
							@endforeach
							@if ($hasChild == 0)
								<li><a href="{{ $cate->url }}">{{ $cate->name }}</a></li>
							@else
								<li>
									<a href="{{ $cate->url }}">{{ $cate->name }}</a>
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									<ul class="drop3">
									@foreach ($categories as $subcate)
										@if ($subcate->parent_id == $cate->id)
										<li><a href="{{ $subcate->url }}">{{ $subcate->name }}</a></li>
										@endif
									@endforeach
									</ul>
								</li>
							@endif
						@endforeach
						{{--<li><a href="{{ url('dien-thoai') }}">Điện thoại</a></li>
						<li><a href="{{ url('tablet') }}">Tablet</a></li>
						<li>
							<a href="{{ url('phu-kien') }}">Phụ kiện</a>
							<i class="fa fa-angle-right" aria-hidden="true"></i>
							<ul class="drop3">
								<li><a href="{{ url('pin-du-phong') }}">Pin dự phòng</a></li>
								<li><a href="{{ url('op-lung') }}">Ốp lưng</a></li>
								<li><a href="{{ url('cap-sac') }}">Cáp sạc</a></li>
							</ul>
						</li>
						<li><a href="{{ url('dong-ho') }}">Đồng hồ</a></li>
						<li><a href="{{ url('am-thanh') }}">Âm thanh</a></li>
						<li><a href="{{ url('laptop') }}">Laptop</a></li>
						<li><a href="{{ url('sim-so') }}">Sim số</a></li>--}}
					</ul>
				</li>
				<li><a href="">Giới thiệu</a></li>
				<li><a href="">Tin tức</a></li>
				<li><a href="">Tư vấn</a></li>
				<li><a href="{{ url('contact') }}">Liên hệ</a></li>
				<li><a href="tel:01649.629.629">HOTLINE: 036.666.3616 (từ 8h-22h cả T7,CN)</a></li>
			</ul>
		</div>
	</nav>
</header>