@extends('adminlte::page')

@section('content_header')
    <h1>Products</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary" href="{{ route('add-product') }}">Thêm mới</a>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" id="search-input">
                <div class="input-group-btn">
                    <button class="btn btn-info search-btn" type="button">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="show-products">
        <table>
            <thead>
                <tr>
                    <th width="4%">id</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th class="hidden-sm hidden-xs">Loại</th>
                    <th class="hidden-sm hidden-xs">Ngày tạo</th>
                    <th class="hidden-sm hidden-xs">Ngày sửa</th>
                    <th width="5%">Thao tác</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @if (isset($data))
                @foreach ($data as $product)
                <tr class="sp {{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td><img src="{{ asset('uploads').'/'.$product->path }}" style="width: 50px;"></td>
                    <td>{{ number_format($product->price) }}đ</td>
                    <td class="hidden-sm hidden-xs">{{ $product->name }}</td>
                    <td class="hidden-sm hidden-xs">{{ $product->created_at }}</td>
                    <td class="hidden-sm hidden-xs">{{ $product->updated_at }}</td>
                    <td>
                        <a class="edit-book btn btn-primary" href="{{ route('edit-product', [$product->id]) }}">Sửa</a>
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <a class="btn btn-danger btn-delete" href="{{ route('delete-product', [$product->id]) }}">Xóa</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="editBook" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh sửa sách</h4>
            </div>
            <form id="form-edit" role="form" action="" method="POST">
                
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên sách: </label>
                    <input type="text" name="title" value="" class="form-control" id="title">
                </div>
                <div class="form-group">
                    <label>Tên tác giả: </label>
                    <input type="text" name="author" value="" class="form-control" id="author">
                    
                </div> 
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <button type="button" class="btn btn-success btn-update">Cập nhật</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            </form>
        </div>
    </div>
</div>
<div class="my-pagination">
@if (isset($data))
{!! $data->render() !!}
@endif
</div>
@endsection


@section('css')
<style type="text/css">
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
            background-color: #4CAF50;
            color: white;
        }
        .my-pagination{
            text-align: center;
        }
        .page-item{
            list-style-type: none;
            display: inline;
        }
</style>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        var data = document.getElementsByClassName('pro-descrpt');
        for (var i=0; i<data.lenght; i++){
            var strimTxt = data[i].innerText;
            data[i].innerText = strimTxt.substring(0, 20);
        }
    });
    $(document).on('click', '.btn-delete', function(){
            if (confirm('Bạn có thực sự muốn xóa không?')){
                return true;
            }
            return false;
        });
</script>
@endsection
