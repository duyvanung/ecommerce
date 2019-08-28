@extends('layouts.master')

@section('title','Giỏ hàng')

@section('content')
<div id="cart-container">
		@if(isset($data) and count($data) > 0 )
        <h1>Giỏ hàng của bạn</h1>
        <div id="cart-content">
            <table>
            <thead>
                <tr>
                	<th class="hidden-sm hidden-xs" width="4%">STT</th>
                	<th class="hidden-sm hidden-xs">Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th class="hidden-sm hidden-xs">Ảnh</th>
					<th width="7%">Số lượng</th>
					<th>Giá</th>
					<th width="5%">Thao tác</th>
               </tr>
            </thead>
            <tbody id="table-body">
            <?php $count = 0; ?>
            @foreach ($data as $item)	
				<tr class="sp sp{{ $item['pro_id'] }}">
					<td class="hidden-sm hidden-xs">{{ ++$count }}</td>
					<td class="hidden-sm hidden-xs">{{ $item['pro_code'] }}</td>
					<td>{{ $item['pro_name'] }}</td>
					<td class="hidden-sm hidden-xs"><img src="{{ asset('uploads').'/'.$item['pro_path'] }}" style="width: 50px;"></td>
					<td>
						<input type="number" name="quantity" min="1" value="{{ $item['pro_qty'] }}" style="text-align: center; width: 100%;" class="qty-value" data-id="{{ $item['pro_id'] }}">
					</td>
					<td class="price-value" data-price="{{ $item['pro_price'] }}">{{ number_format($item['pro_price']) }} đ</td>
					<td>
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="button" class="btn btn-danger btn-delete" data-id="{{ $item['pro_id'] }}">Xóa</button>
					</td>
				</tr>
			@endforeach
            </tbody>
         </table>
         <h3>Tổng tiền: <span class="total-price"></span></h3>
      </div>
		<div style="text-align: right;">
			<button type="button" class="btn btn-primary go-checkout">Thanh toán</button>
			<button type="button" class="btn btn-danger remove-all-cart">Xóa giỏ hàng</button>
		</div>
@else
<div class="empty-cart">
	<img src="{{ asset('images/empty-cart-icon.png') }}" alt="Không có sản phẩm nào trong giỏ hàng của bạn." style="max-width: 220px;">
	<p class="message">Không có sản phẩm nào trong giỏ hàng của bạn.</p>
	<a href="{{ route('homepage') }}" class="btn btn-yellow">Tiếp tục mua sắm</a>
</div>
@endif
</div>
@endsection


@section('css')

<style type="text/css">
	#cart-container{
		padding-bottom: 50px;
		min-height: 350px;
	}
	.empty-cart{
		padding-top: 50px;
		text-align: center;
	}
	.empty-cart img{
		padding-top: 20px;
		padding-bottom: 20px;
	}

	.btn-yellow{
		background-color: yellow;
		padding: 10px 30px;
		font-weight: bold;
		color: #4a4a4a;
	}
	h1{
		margin-top: 30px;
		margin-bottom: 30px;
	}
	h3{
		text-align: right;
	}
	#cart-content{
		margin-bottom: 50px;
	}
	#show-products .row{
            padding-left: 20px;
            padding-right: 20px;
        }
        table{
            margin-top: 10px;
            font-family: "Comic Sans MS", arial, san-serif;
            border-collapse: collapse;
            width: 100%;
        }
        th, td{
            text-align: left;
            border: 1px solid #dddddd;
            padding: 5px;
        }
        .pro-descrpt{
            max-height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        th{
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #347091;
            color: white;
        }
        .my-pagination{
            text-align: center;
            font-size: 20px;
            color: red;
        }
        .page-item{
            list-style-type: none;
            display: inline;
        }
}
</style>

@endsection


@section('js')
<script type="text/javascript">
	function calcTotalPrice(){
		var total = 0;
		$('.sp').each(function(){
			total += Number($(this).children('.price-value').data('price')) * Number($(this).find('input[name=quantity]').val());
		});
		return total;
	}
	$(document).ready(function(){
		var total = calcTotalPrice().toLocaleString('it-IT', {style : 'currency', currency : 'VND'});;
		$('.total-price').text(total);
	});

	$(document).on('click', '.btn-delete', function(){
		if (confirm("Bạn thực sự muốn xóa?") == true){
			var id = $(this).data('id');
			$.ajax({

				type:'POST',

				url:'{{ route("ajaxRemoveFromCart") }}',

				data:{
					'_token' : $('input[name="_token"]').val(),
					'pro_id': id,
				},
				success:function(data){
					// alert(data);
					$('.sp'+ id).remove();
					var total = calcTotalPrice().toLocaleString('it-IT', {style : 'currency', currency : 'VND'});;
					$('.total-price').text(total);
					if ($('.sp').length < 1){
						location.reload();
					}
				}

			});
			return true;
		}
		return false;
	});
	$(document).on('change', '.qty-value', function(){
		//alert('changed');
		var id = $(this).data('id');
		$.ajax({

			type:'POST',

			url:'{{ route("ajaxChangeQtyCart") }}',

			data:{
				'_token' : $('input[name="_token"]').val(),
				'pro_id': id,
				'pro_qty': parseInt($(this).val()),
			},
			success:function(data){
				//alert(data);
				var total = calcTotalPrice().toLocaleString('it-IT', {style : 'currency', currency : 'VND'});;
				$('.total-price').text(total);
			}

		});
	});

	$(document).on('click', '.remove-all-cart', function(){
		$.ajax({

			type:'POST',

			url:'{{ route("ajaxRemoveAllCart") }}',

			data:{
				'_token' : $('input[name="_token"]').val(),
			},
			success:function(data){
				//alert(data);
				window.location = '{{ route("homepage") }}';
			}

		});
	});


	$(document).on('click', '.go-checkout', function(){
		$.ajax({

			type:'POST',

			url:'{{ route("checkout") }}',

			data:{
				'_token' : $('input[name="_token"]').val(),
				'total_price': calcTotalPrice(),
			},
			success:function(data){
				if (data.state == 0){ // chua login
					if (confirm('Bạn cần phải đăng nhập')){
						window.location.href = data.url;
					}
				}
				else{
					window.location.href = "{{ route('checkout') }}";
				}
			}

		});
	});

</script>
@endsection