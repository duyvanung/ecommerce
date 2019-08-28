@extends('adminlte::page')

@section('content_header')
    <h1>Add new product</h1>
@stop

@section('content')

<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Mã sản phẩm: </label>
                <input type="text" name="pro-code" placeholder="Mã sản phẩm" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tên sản phẩm: </label>
                <input type="text" name="pro-name" placeholder="Tên sản phẩm" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tình trạng: </label>
                <input type="text" name="pro-status" placeholder="Tình trạng sản phẩm" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Khuyến mãi: </label> <br>
                <select id="framework" name="framework[]" multiple class="form-control" id="deal">
                    @foreach ($deal_data as $deal)
                    <option value="{{ $deal->name }}">{{ $deal->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-5">
                    {{--<div class="form-group">
                        <label for="first">Phân loại mức 1</label>
                        <select id="first" class="form-control" role="listbox" name='category'>
                        @foreach($data as $cate)
                            <option value="{{ $cate->name }}">{{ $cate->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="second">Phân loại mức 2</label>
                        <select id="second" class="form-control" role="listbox" disabled="disabled">
                            <option value="0" selected="selected">Select Option</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="third">Phân loại mức 3</label>
                        <select id="third" class="form-control" role="listbox" disabled="disabled">
                            <option value="0" selected="selected">Select Option</option>
                        </select>
                    </div>--}}
            <div class="form-group">
                <label>Phân loại</label>
                <select id="cate"class="form-control select2" multiple="multiple" data-placeholder="Chọn một hoặc nhiều phân loại"
                style="width: 100%;" required>
                    @foreach($cate_data as $cate)
                    <option value="{{ $cate->name }}">{{ $cate->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giá: </label>
                <input type="number" name="pro-price" min="0" class="form-control" placeholder="Chọn giá sản phẩm" required>
            </div>
            <div class="form-group">
                <label>Bảo hành: </label>
                <input type="text" name="pro-warranty" class="form-control" placeholder="Nhập thông tin bảo hành" required>
            </div>
        </div>
<div class="col-md-12">
    <div class="form-group">
        <label>Chọn hình ảnh</label>
        <div class="file-loading">
            <input id="kv-explorer" type="file" name="file" multiple>
        </div>
    </div>
</div>

    </div>
    <div class="form-group">
        <label>Mô tả: </label>
        <textarea class="form-control" rows="10" id="txtdesc" placeholder="Mô tả" name="pro-descript"></textarea>
    </div>
    <div class="form-group">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <button type="button" class="btn btn-info mb-2 add-product">Thêm</button>
        <button type="button" class="btn btn-danger mb-2">Hủy</button>
    </div>
</form>

<div class="row">
  <div class="col-md-12">



  </div>
</div>
@endsection


@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="{{ asset('themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
<style type="text/css">
    
</style>
@endsection


@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
    <script src="{{ asset('js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/locales/fr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('js/modules/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modules/plugins.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">

    var product_images = [];
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

$(document).ready(function () {
        $("#kv-explorer").fileinput({
            'theme': 'fa',
            'uploadUrl': 'image-upload',
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            overwriteInitial: false,
            maxFileSize:2000,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });

    });

$(document).on("click", "button.kv-file-remove" , function(e) {
        var thumbnail = $(this).parents(".file-thumbnail-footer").first();
        var caption = thumbnail.find('div.file-caption-info')[0].innerText;
        console.log(caption);
        e.preventDefault();

        $.ajax({

           type:'POST',

           url:'ajaxRemoveRequest',

           data:{
                '_token' : $('input[name="_token"]').val(),
                'name': caption,
            },

           success:function(data){

              alert(data.success);

           }

        });

    });

$(document).on("click", "button.add-product", function(e){
    var product_code = $.trim($("input[name=pro-code]").val());
    var product_name = $.trim($("input[name=pro-name]").val());
    var product_price = $.trim($("input[name=pro-price]").val());
    // var product_description = $.trim($("textarea[name=pro-descript]").val());
    var product_status = $.trim($("input[name=pro-status]").val());
    var product_warranty = $.trim($("input[name=pro-warranty]").val());
    var product_description = CKEDITOR.instances.txtdesc.getData();
    var product_category = $('#cate').val();
    var lst_img = $(".file-caption-info");
    for (var i=0; i<lst_img.length; i++){
        product_images.push(lst_img[i].innerText);
    }
    console.log(product_images);
    var product_deals = []
    $('input:checkbox').each(function () {
       var sThisVal = (this.checked ? $(this).val() : "");
       if ($.trim(sThisVal) != ""){
            product_deals.push(sThisVal);
       }
    });
    
    if (product_code == ''){
        alert('Chưa nhập mã sản phẩm !!!');
        return false;
    }


    $.ajax({

           type:'POST',

           url:'ajaxSaveRequest',

           data:{
                '_token' : $('input[name="_token"]').val(),
                'product_code': product_code,
                'product_name': product_name,
                'product_price': product_price,
                'product_status': product_status,
                'product_warranty': product_warranty,
                'product_description': product_description,
                'product_category': product_category,
                'product_images': product_images,
                'product_deals': product_deals
            },

           success:function(data){

              alert(data.success);
              window.location = '{{ route("all-products") }}';
           }

        });
    product_images = [];
    window.location = '{{ route("all-products") }}';
});

    $(document).ready(function() {
        $('#cate').select2()
    });

    CKEDITOR.replace( 'txtdesc', {
        filebrowserBrowseUrl: '{{ route("ckfinder_browser") }}',
    } );

    $(document).ready(function(){
        $('#framework').multiselect({
            nonSelectedText: 'Chọn khuyến mãi',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'100%'
        });
    });
</script>
@endsection