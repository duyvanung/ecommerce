@extends('adminlte::page')

@section('content_header')
    <h1>Add new category</h1>
@stop

@section('content')
<form action="{{ route('save-category') }}" method="post">
    <div class="form-group">
        <label>Tên phân loại: </label>
        <input type="text" name="category" placeholder="Tên phân loại" class="form-control">
    </div>
    <div class="form-group">
        <label for="sel1">Chọn phân loại cha</label>
        <select class="selectpicker form-control" name="parent">
            <option></option>
            @foreach ($cates_level_1 as $cate)
                <option>{{ $cate->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info mb-2">Thêm</button>
        <button type="button" class="btn btn-danger mb-2">Hủy</button>
    </div>
    {{ csrf_field() }}
</form>
@endsection


@section('css')
<style type="text/css">
    
</style>
@endsection
