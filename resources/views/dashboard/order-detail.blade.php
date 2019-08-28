@extends('adminlte::page')

@section('content_header')
    <h1>Chi tiết đơn hàng</h1>
@stop

@section('content')
<div id="show-order-detail">
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Đơn hàng</h3>
            </div>
            <div class="panel-body">
                @if(isset($data) and count($data) > 0 )
                <div id="cart-content">
                    <table>
                    <thead>
                        <tr>
                            <th width="4%">STT</th>
                            <th class="hidden-sm hidden-xs">Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th width="10%" class="hidden-sm hidden-xs">Ảnh</th>
                            <th class="text-center">Số lượng</th>
                            <th>Giá</th>
                       </tr>
                    </thead>
                    <tbody id="table-body">
                    @foreach ($data as $item)   
                        <tr class="sp">
                            <td>{{ ++$item->detail_line_num }}</td>
                            <td class="hidden-sm hidden-xs">{{ $item->product_code }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td class="hidden-sm hidden-xs"><img src="{{ asset('uploads').'/'.$item->product_image }}" style="width: 80%"></td>
                            <td class="text-center">
                                {{ $item->product_qty }}
                            </td>
                            <td class="price-value" data-price="{{ $item->product_price }}">{{ number_format($item->product_price) }} đ</td>
                        </tr>
                    @endforeach
                    </tbody>
                 </table>
                 <h3>Tổng tiền: <span class="total-price">{{ number_format($data[0]->total_price) }} đ</span></h3>
              </div>
               
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin khách hàng</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Họ và tên:</label>
                    <input type="text" name="user_name" class="form-control" readonly value="{{ $data[0]->user_name }}">
                </div>
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input type="text" name="user_phone" class="form-control" readonly value="{{ $data[0]->user_phone }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="user_email" class="form-control" readonly value="{{ $data[0]->user_email }}">
                </div>
                <div class="form-group">
                    <label>Địa chỉ nhận hàng:</label>
                    <input type="text" name="user_address" class="form-control" readonly value="{{ $data[0]->user_address }}">
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tình trạng</h3>
            </div>
            <div class="panel-body">
                <div class="input-group">
                    <select class="form-control" id="order-status">
                        <option selected>{{ $data[0]->status }}</option>
                        @foreach ($list_status as $stt)
                        @if ($stt == $data[0]->status)
                        @continue
                        @endif
                        <option>{{ $stt }}</option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="btn btn-primary save-order-status" data-id="{{ $data[0]->id }}">Lưu</button>
                    </span>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-danger delete-order" data-id="{{ $data[0]->id }}">Xóa đơn hàng</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<style type="text/css">
    section.content{
        padding: 0px;
        padding-top: 10px;
    }
    input {
        background: white !important;
    }
    .total-price{
        color: red;
    }
</style>
@endsection

@section('js')
<script type="text/javascript">
    $('.table > tbody > tr').click(function() {
        //window.location = "{{ route('all-products') }}";
        console.log($(this).data('id'));
    });

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $(document).on('click', '.save-order-status', function(){
        $.ajax({

            type:'POST',

            url:'{{ route("save-order-status") }}',

            data:{
                '_token' : $('input[name="_token"]').val(),
                'order_id': $(this).data('id'),
                'status': $('#order-status').val()
            },
            success:function(data){
                alert(data);
            }

        });
    });

    $(document).on('click', '.delete-order', function(){
        if (confirm("Bạn có thực sự muốn xóa đơn hàng này???")){
            $.ajax({

                type:'POST',

                url:'{{ route("delete-order") }}',

                data:{
                    '_token' : $('input[name="_token"]').val(),
                    'order_id': $(this).data('id'),
                },
                success:function(data){
                    window.location = "{{ route('all-orders') }}";
                }

            });
            return true;
        }
        return false;
    });
</script>
@endsection
