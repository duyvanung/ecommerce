@extends('adminlte::page')

@section('content_header')
    <h1>Edit deal</h1>
@stop

@section('content')
<form action="{{ route('update-deal', [$deal_data->id]) }}" method="post">
    <div class="form-group">
        <label>Tên phân loại: </label>
        <input type="text" name="deal" value="{{ $deal_data->name }}" class="form-control">
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
