<div class="titboxl">
	<i class="fa fa-bars fa-x2 fa-lg" aria-hidden="true"></i>
	<span>Danh mục sản phẩm</span>
</div>
<div class="ctboxleft">
	<ul class="mnboxl">
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
					<ul class="mnboxl_1">
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
			<ul class="mnboxl_1">
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
</div>