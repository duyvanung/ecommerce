@extends('adminlte::page')

@section('content_header')
    <h1>Đơn hàng</h1>
@stop

@section('content')
@if (isset($orders))
<div id="show-orders">
    <div class="row" style="padding: 0;">
        <div class="col-md-5">
            <form action="" method="POST" id="form-orders-status">
            <div class="input-group">
                <select class="form-control" id="order-status" name="select-status">
                    <option selected></option>
                    @foreach ($list_status as $stt)
                    <option>{{ $stt }}</option>
                    @endforeach
                </select>
                <div class="input-group-btn">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-info search-status" type="button">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Ngày đặt hàng</th>
                <th>Người mua</th>
                <th>Địa chỉ</th>
                <th>Tổng</th>
                <th>Tình trạng</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order) 
            <tr data-id="{{ $order->id }}" data-href="{{ route('order-detail', [$order->id]) }}">
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->user_name }}</td>
                <td>{{ $order->user_address }}</td>
                <td>{{ number_format($order->total_price) }} đ</td>
                <td>{{ $order->status }}</td>
                <td class="remove-area">
                    <button type="button" class="btn btn-danger delete-order" data-id="{{ $order->id }}">Xóa</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="my-pagination">
{!! $orders->render() !!}
</div>
@endif
@endsection


@section('css')
<style type="text/css">
    #show-orders .row{
            padding-left: 10px;
            padding-right: 10px;
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
            background-color: #189eff;
            color: white;
        }
        .my-pagination{
            text-align: center;
            font-size: 14px;
        }
        .page-item{
            list-style-type: none;
            display: inline;
        }

        .table > tbody > tr:hover{
            cursor: pointer;
            background-color: red;
        }
</style>
@endsection

@section('js')
<script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $(document).ready(function(){
        $('#order-status').children().each(function(){
            var selected = "{{ isset($selected_status) ? $selected_status : '' }}";
            if ($(this).text() == selected){
                $(this).attr('selected','selected');
            }
        });
    });

    $(document).on('click', '.delete-order', function(event){
        if (confirm("Bạn có thực sự muốn xóa đơn hàng này???")){
            $.ajax({

                type:'POST',

                url:'{{ route("delete-order") }}',

                data:{
                    '_token' : $('input[name="_token"]').val(),
                    'order_id': $(this).data('id'),
                },
                success:function(data){
                    location.reload();
                }

            });
        }
        return false;
    });
    $('.table > tbody > tr >td:not(.remove-area)').click(function() {
        window.location = $(this).parent().data('href');
        console.log($(this).data('id'));
    });

    $(document).on('click', '.search-status', function(){
        var selectedStatus = $('#order-status').val();
        if (selectedStatus == ""){
            window.location = "{{ route('all-orders') }}";
        }
        else if (selectedStatus == "Chưa giao hàng"){
            window.location = "{{ route('orders-by-status', ['chua-giao-hang']) }}";
        } 
        else if (selectedStatus == "Đang giao hàng"){
            window.location = "{{ route('orders-by-status', ['dang-giao-hang']) }}";
        } 
        else if (selectedStatus == "Đã giao hàng"){
            window.location = "{{ route('orders-by-status', ['da-giao-hang']) }}";
        } 
        return true;
    });
</script>
@endsection
