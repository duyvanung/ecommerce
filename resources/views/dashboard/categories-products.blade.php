@extends('adminlte::page')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')
    <div id="show-categories">
        <table>
            <thead>
                <tr>
                    <th width="4%">id</th>
                    <th>Tên</th>
                    <th>Cha</th>
                    <th class="hidden-sm hidden-xs">Ngày tạo</th>
                    <th class="hidden-sm hidden-xs">Ngày sửa</th>
                    <th width="5%">Thao tác</th>
                </tr>
            </thead>
            <tbody id="table-body">
            @foreach($data as $cate)    
                <tr class="category {{ $cate->id }}">
                    <td>{{ $cate->id }}</td>
                    <td>{{ $cate->name }}</td>
                    <td>{{ $cate->parent_id }}</td>
                    <td class="hidden-sm hidden-xs">{{ $cate->created_at }}</td>
                    <td class="hidden-sm hidden-xs">{{ $cate->updated_at }}</td>
                    <td>
                        <form action="{{ route('delete-category', [$cate->id]) }}" method="get">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <a href="{{ route('edit-category', [$cate->id]) }}" class="btn btn-primary">Sửa</a>
                            <button type="submit" class="btn btn-danger delete-cate">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {!! $data->links() !!}
    </div>
@endsection


@section('css')
<style type="text/css">
    #show-categories .row{
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
            font-size: 20px;
            color: red;
        }
        .page-item{
            list-style-type: none;
            display: inline;
        }
</style>
@endsection
