@extends('adminlte::page')

@section('content_header')
    <h1>Edit category</h1>
@stop

@section('content')
<form action="{{ route('update-category', [$cate_data->id]) }}" method="post">
    <div class="form-group">
        <label>Tên phân loại: </label>
        <input type="text" name="category" value="{{ $cate_data->name }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="sel1">Chọn phân loại cha</label>
        <select class="form-control" name="parent">
        @if (isset($selected_cate))
            <option></option>    
            @foreach($all_cates as $cate)
                @if ($cate->name == $cate_data->name)
                    @continue
                @endif
                @if ($cate->name == $selected_cate->name)
                    <option selected>{{ $cate->name }}</option>
                @else
                    <option>{{ $cate->name }}</option>
                @endif
            @endforeach
        @else
            <option selected></option>
            @foreach($all_cates as $cate)
                @if ($cate->name == $cate_data->name)
                    @continue
                @endif
                <option>{{ $cate->name }}</option>
            @endforeach
        @endif
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info mb-2">Cập nhật</button>
        <button type="button" class="btn btn-danger mb-2">Hủy</button>
    </div>
    {{ csrf_field() }}
</form>
@endsection


@section('css')
<style type="text/css">
    
</style>
@endsection
