<div class="boxleft visible-xs">
	<div class="titboxl dmspmobi">
		<i class="fa fa-bars fa-x2 fa-lg" aria-hidden="true"></i>
		<span>Danh mục sản phẩm</span>
	</div>
	<div class="ctboxleft">
		<ul class="ulspmobi">
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
						<span class="iconlist">icon</span>
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
		</ul>
	</div>
</div>
<div class="boxleft hidden-xs">
	<div class="titboxl">
		<i class="fa fa-share fa-x2 fa-lg" aria-hidden="true"></i>
		<span>Sản phẩm hot</span>
	</div>
	<div class="ctboxleft">
	@foreach ($sphot as $sp)
		<div class="boxspl">
			<div class="col-xs-4 p0">
				<a href="{{ url('product',[$sp->product_id]) }}"><img src="{{ asset('uploads').'/'.$sp->product_image }}" alt="" class="thumb-boxspl"></a>
			</div>
			<div class="col-xs-8 p5">
				<div class="tit-boxspl">
					<a href="{{ url('product',[$sp->product_id]) }}">{{ str_limit($sp->product_name, $limit = 30, $end = '...') }}</a>
				</div>
				<div class="price-boxspl">{{ number_format($sp->product_price) }} Đ</div>
			</div>
		</div>
	@endforeach
	</div>
</div>
<div class="boxleft hidden-xs">
	<div class="titboxl">
		<i class="fa fa-random fa-x2 fa-lg" aria-hidden="true"></i>
		<span>Sản phẩm bán chạy</span>
	</div>
	<div class="ctboxleft">
	@foreach ($spbanchay as $sp)
		<div class="boxspl">
			<div class="col-xs-4 p0">
				<a href="{{ url('product',[$sp->product_id]) }}"><img src="{{ asset('uploads').'/'.$sp->product_image }}" alt="" class="thumb-boxspl"></a>
			</div>
			<div class="col-xs-8 p5">
				<div class="tit-boxspl">
					<a href="{{ url('product',[$sp->product_id]) }}">{{ str_limit($sp->product_name, $limit = 30, $end = '...') }}</a>
				</div>
				<div class="price-boxspl">{{ number_format($sp->product_price) }} Đ</div>
			</div>
		</div>
	@endforeach
	</div>
</div>
{{--<div class="boxleft hidden-xs">
	<div class="titboxl">
		<i class="fa fa-rss-square fa-x2 fa-lg" aria-hidden="true"></i>
		<span>Tin tức</span>
	</div>
	<div class="ctboxleft">
		<div id="slider-tintuc" class="owl-carousel">
            <div class="item tintucl">
            	<a href=""><img src="images/img-tin.jpg"></a>
            	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
            	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
            </div>
            <div class="item tintucl">
            	<a href=""><img src="images/img-tin.jpg"></a>
            	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
            	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
            </div>
            <div class="item tintucl">
            	<a href=""><img src="images/img-tin.jpg"></a>
            	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
            	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
            </div>
            <div class="item tintucl">
            	<a href=""><img src="images/img-tin.jpg"></a>
            	<h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
            	<p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
            </div>
        </div>
	</div>
</div>--}}
@if (isset($vbanner))
<div class="boxleft hidden-xs">
	<div class="ctboxleft qc">
		<a href=""><img src="{{ asset('images').'/'.$vbanner->path }}"></a>
	</div>
</div>
@endif