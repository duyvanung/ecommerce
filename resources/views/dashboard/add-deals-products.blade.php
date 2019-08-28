@extends('adminlte::page')

@section('content_header')
    <h1>Add new deal</h1>
@stop

@section('content')
<form action="{{ route('save-deal') }}" method="post">
    <div class="form-group">
        <label>Tên khuyến mãi: </label>
        <input type="text" name="deal" placeholder="Tên khuyến mãi" class="form-control">
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
