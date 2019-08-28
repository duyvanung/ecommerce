@extends('layouts.master')

@section('title','Thông tin của bạn')

@section('content')

<div class="row">
    <div class="col-sm-10">
        <h1>{{ Auth::user()->name }}</h1></div>
    <div class="col-sm-2">
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <!--left col-->

        <div class="text-center">
            <img src="{{ isset(Auth::user()->avatar)? asset('uploads/users').'/'.Auth::user()->avatar : 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' }}" class="avatar img-circle img-thumbnail" alt="avatar">
            <h6>Upload a different photo...</h6>
            <input type="file" id="avatar" name="avatar" class="text-center center-block file-upload">
        </div>
        </hr>
        <br>

        <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
        </ul>

        <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
                <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
        </div>

    </div>
    <!--/col-3-->
    <div class="col-sm-9">
    	<div class="alert alert-danger" style="display:none"></div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Thông tin</a></li>
            <li><a data-toggle="tab" href="#messages">Lịch sử mua hàng</a></li>
            <li><a data-toggle="tab" href="#settings">Mật khẩu</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                <form class="form" method="post" id="profile-form" enctype="multipart/form-data">
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="first_name">
                                <h4>Họ tên</h4></label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" id ="name" name="name" placeholder="Họ tên" title="enter your first name if any.">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="phone">
                                <h4>Số điện thoại</h4></label>
                            <input type="text" class="form-control" id ="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="nhập số điện thoại" title="enter your phone number if any.">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="mobile">
                                <h4>Giới tính</h4></label>
                            <select class="form-control" id="sex" name="sex">
							    <option>Nam</option>
							    <option>Nữ</option>
							    <option>Khác</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="email">
                                <h4>Email</h4></label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="you@email.com" readonly>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="email">
                                <h4>Địa chỉ</h4></label>
                            <input type="text" class="form-control" id="address" value="{{ Auth::user()->address }}" placeholder="somewhere" title="enter a location" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success pf-update" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                            <button class="btn btn-lg reset" type="reset"><i class="glyphicon glyphicon-repeat"></i> Đặt lại</button>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
                    </div>
                </form>

                <hr>

            </div>
            <!--/tab-pane-->
            <div class="tab-pane" id="messages">
            <div id="show-orders">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Ngày đặt hàng</th>
                            <th>Người mua</th>
                            <th>Địa chỉ</th>
                            <th>Tổng</th>
                            <th>Tình trạng</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order) 
                        <tr>
                            <td><a href="" class="order-id" data-id="{{ $order->id }}">{{ $order->id }}</a></td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->user_address }}</td>
                            <td>{{ number_format($order->total_price) }} đ</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
            <div id="order-detail" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Đơn hàng</h4>
                        </div>
                        <div class="modal-body" id="order-content">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            <div class="my-pagination">

            </div>
            </div>
            <!--/tab-pane-->
            <div class="tab-pane" id="settings">
                <hr>
                <form class="form" action="" method="post">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="password">
                                <h4>Mật khẩu</h4></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-6">
                            <label for="password2">
                                <h4>Xác nhận mật khẩu</h4></label>
                            <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success pw-update" type="button"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                            <button class="btn btn-lg reset" type="reset"><i class="glyphicon glyphicon-repeat"></i> Đặt lại</button>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </div>
                    </div>
                </form>
                
			</div>
        </div>
        <!--/tab-pane-->
    </div>
    <!--/tab-content-->

</div>
<!--/col-9-->
</div>
<!--/row-->

@endsection

@section('css')

<style type="text/css">
	img.img-thumbnail{
        max-width: 60%;
    }
</style>

@endsection


@section('js')
<script type="text/javascript">
	var sex_value = "{{isset(Auth::user()->sex)? Auth::user()->sex : 'Nam'}}";
    $('#sex').val(sex_value);
$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
});

$(document).on('click', '.reset', function(){
	location.reload();
});

$(document).on('click', '.pw-update', function(){

	$.ajax({

		type:'POST',

		url:'{{ route("update-profile") }}',

		data:{
			'_token' : $('input[name="_token"]').val(),
			'isPw': 1,
			'password' : $('#password').val(),
			'password_confirmation': $('#password2').val()
		},
		success:function(data){
			jQuery.each(data.errors, function(key, value){
      			jQuery('.alert-danger').show();
      			jQuery('.alert-danger').append('<p>'+value+'</p>');
      		});
      		if (data.status == 1){
      			alert('Thành công');
      			location.reload();
      		}
		}

	});

});

$(document).on('submit', '#profile-form', function(e){
	e.preventDefault();
	var form_data = new FormData($(this)[0]);
	form_data.append('file', document.getElementById('avatar').files[0]);
	form_data.append('_token', $('input[name="_token"]').val());
	form_data.append('name', $('#name').val());
	form_data.append('phone', $('#phone').val());
	form_data.append('sex', $('#sex').val());
	form_data.append('address', $('#address').val());
	form_data.append('isPw', 0);
	console.log(form_data);
	$.ajax({

		type:'POST',

		url:'{{ route("update-profile") }}',

		data: form_data,
		dataType: 'json',
		contentType: false, 
		processData: false,
		success:function(data){
			jQuery.each(data.errors, function(key, value){
      			jQuery('.alert-danger').show();
      			jQuery('.alert-danger').append('<p>'+value+'</p>');
      		});
      		if (data.status == 1){
      			alert('Thành công');
      			location.reload();
      		}
		}

	});

});
function format_price(price){
    return price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
}
$(document).on('click', 'a.order-id', function(e){
    e.preventDefault();
    var order_id = $(this).data("id");
    $.ajax({

        type:'POST',

        url:'{{ route("order-history") }}',
        data:{
            '_token' : $('input[name="_token"]').val(),
            'order_id': order_id
        },
        async: false,
        success:function(data){
            var data_order = data.order_data;
            var uploads_path = "{{ asset('uploads') }}";
            var order_html = '<div id="cart-content">'+
                                '<table>'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th width="4%">STT</th>'+
                                            '<th class="hidden-sm hidden-xs">Mã sản phẩm</th>'+
                                            '<th>Tên sản phẩm</th>'+
                                            '<th width="10%" class="hidden-sm hidden-xs">Ảnh</th>'+
                                            '<th class="text-center">Số lượng</th>'+
                                            '<th>Giá</th>'+
                                       '</tr>'+
                                    '</thead>'+
                                    '<tbody id="table-body">';
            for(var i=0; i<data_order.length; i++){
                order_html += '<tr class="sp">'+
                                    '<td>'+(i+1)+'</td>'+
                                    '<td class="hidden-sm hidden-xs">'+data_order[i].product_code+'</td>'+
                                    '<td>'+data_order[i].product_name+'</td>'+
                                    '<td class="hidden-sm hidden-xs"><img src="'+uploads_path+'/'+data_order[i].product_image +'" style="width: 80%"></td>'+
                                    '<td class="text-center">'+
                                        data_order[i].product_qty +
                                    '</td>'+
                                    '<td class="price-value">'+format_price(data_order[i].total_price)+'</td>'+
                                '</tr>';
            }

            order_html += '</tbody>'+
                             '</table>'+
                             '<h3>Tổng tiền: <span class="total-price">'+format_price(data_order[0].total_price)+ '</span></h3>'+
                        '</div>';
            $("#order-content").html(order_html);
            $('#order-detail').modal('show');
        }

    });
});


</script>
@endsection