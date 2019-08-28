@if(isset($spmoi))
<div class="tit-boxmain">
	<h3><span>Sản phẩm mới</span></h3>
</div>
<div class="ct-boxmain">
	<div class="row">
		<div id="spmoi" class="owl-carousel">
        @foreach($spmoi as $sp)
			<div class="item">
            	<div class="boxsp">
            		<div class="imgsp">
            			<a href="{{ url('product',[$sp->id]) }}"><img class="imgproduct" src="{{ asset('uploads').'/'.$sp->path }}"></a>
            			<div class="img-label">
            				<img src="{{ asset('images/hot.png') }}">
            			</div>
            		</div>
            		<div class="namesp">
            			<a href="{{ url('product',[$sp->id]) }}">{{ $sp->product_name }}</a>
            		</div>
            		<div class="pricesp"> {{ number_format($sp->price) }} Đ</div>
            		<div class="button-hd">
                		<a href=""><i class="fa fa-shopping-cart add-to-cart" aria-hidden="true" data-id="{{ $sp->id }}" data-name="{{ $sp->product_name }}" data-code="{{ $sp->product_code }}" data-price="{{ $sp->price }}" data-path="{{ $sp->path }}"></i></a>
                		<a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                	</div>
            	</div>
            </div>
        @endforeach
      	</div>
	</div>
</div>
@endif