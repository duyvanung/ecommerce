@if (isset($spdata) and count($spdata)>0)
@foreach ($spdata as $item)
<div class="tit-boxmain">
    <h3><span>{{ $item[0]->name }}</span></h3>
</div>
<div class="ct-boxmain m0" style="display: flex; flex-wrap: wrap;">
    <div class="row">
    @foreach ($item as $sp)
    <div class="col-xs-6 col-sm-4 col-md-3 p5" style="display: flex; flex-direction: column; margin-bottom: 20px">
        <div class="boxsp">
            <div class="imgsp">
                <a href="{{ url('product',[$sp->id]) }}"><img class="imgproduct" src="{{ asset('uploads').'/'.$sp->path }}"></a>
                <div class="img-label">
                    <img src="{{ asset('images/hot.png') }}">
                </div>
            </div>
            <div class="namesp">
                <a href="">{{ $sp->product_name }}</a>
            </div>
            <div class="pricesp">{{ number_format($sp->price) }} Đ</div>
            <div class="button-hd">
                <a href=""><i class="fa fa-shopping-cart add-to-cart" aria-hidden="true" data-id="{{ $sp->id }}" data-name="{{ $sp->product_name }}" data-code="{{ $sp->product_code }}" data-price="{{ $sp->price }}" data-path="{{ $sp->path }}"></i></a>
                <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>
@endforeach
@else
<h2>Không có sản phẩm</h2>
@endif