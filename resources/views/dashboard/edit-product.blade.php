@extends('adminlte::page')

@section('content_header')
    <h1>Edit product</h1>
@stop

@section('content')
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Mã sản phẩm: </label>
                <input type="hidden" name="pro-id" value="{{ $product[0]->id }}">
                <input type="text" name="pro-code" placeholder="Mã sản phẩm" class="form-control" value="{{ $product[0]->product_code }}">
            </div>
            <div class="form-group">
                <label>Tên sản phẩm: </label>
                <input type="text" name="pro-name" placeholder="Tên sản phẩm" class="form-control" value="{{ $product[0]->product_name }}">
            </div>
            <div class="form-group">
                <label>Tình trạng: </label>
                <input type="text" name="pro-status" placeholder="Tình trạng sản phẩm" class="form-control" value="{{ $product[0]->status }}">
            </div>
            <div class="form-group">
                <label>Khuyến mãi: </label> <br>
                <select id="framework" name="framework[]" multiple class="form-control" id="deal">
                    @foreach ($selectedDeal_name as $name)
                    <option value="{{ $name }}" selected>{{ $name }}</option>
                    @endforeach
                    @foreach ($deals as $deal)
                    @if (in_array($deal->name, $selectedDeal_name))
                        @continue
                    @endif
                    <option value="{{ $deal->name }}">{{ $deal->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
                    {{--<div class="form-group">
                        <label for="first">Phân loại mức 1</label>
                        <select id="first" class="form-control" role="listbox" name='category'>
                            <option value="{{ $selectedCate->name }}" selected>{{ $selectedCate->name }}</option>
                            
                        @foreach($cates as $cate)
                        @if($cate->name == $selectedCate->name)
                            @continue
                        @endif
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
                <select id="cate"class="form-control select2" multiple="multiple" style="width: 100%;">
                @foreach ($selectedCate_name as $sCate)
                    <option value="{{ $sCate }}" selected>{{ $sCate }}</option>
                @endforeach
                @foreach($cates as $cate)
                @if(in_array($cate->name, $selectedCate_name))
                    @continue
                @endif
                    <option value="{{ $cate->name }}">{{ $cate->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Giá: </label>
                <input type="number" name="pro-price" min="0" class="form-control" value="{{ $product[0]->price }}">
            </div>
            <div class="form-group">
                <label>Bảo hành: </label>
                <input type="text" name="pro-warranty" class="form-control" placeholder="Nhập thông tin bảo hành" value="{{ $product[0]->warranty }}">
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
        <textarea class="form-control" rows="5" id="txtdesc" placeholder="Mô tả" name="pro-descript" autocomplete="off">{!! $product[0]->description !!}</textarea>
    </div>
    <div class="form-group">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <button type="submit" class="btn btn-info mb-2 update-product">Cập nhật</button>
        <button type="button" class="btn btn-danger mb-2 cancel">Hủy</button>
    </div>
</form>
@endsection


@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="{{ asset('themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
<style type="text/css">
    .multiselect-container{
        max-width: 100%;
        overflow-x: hidden;
    }
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">

var product_images = [];
var initPreview = [];
var initPreviewConfig = [];
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

$(document).ready(function () {
        var uploads_path = "{{ asset('uploads') }}";
        var jsproduct = @json($product);
        //console.log(jsproduct)
        for (var i=0; i<jsproduct.length; i++){
            console.log(jsproduct[i]);
            var imgPath = uploads_path +'/'+ jsproduct[i].path;
            initPreview.push(imgPath);
            var imgConfig = {caption: jsproduct[i].path};
            initPreviewConfig.push(imgConfig);
        }
        $("#kv-explorer").fileinput({
            'theme': 'fa',
            'uploadUrl': '{{route("image.upload.post")}}',
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            maxFileSize:2000,
            maxFilesNum: 10,
            overwriteInitial: false,
            initialPreviewShowDelete: true,
            initialPreviewAsData: true,
            initialPreview: initPreview,
            initialPreviewConfig: initPreviewConfig,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });

    });
/*
"http://lorempixel.com/1920/1080/transport/1",
                "http://lorempixel.com/1920/1080/transport/2",
*/

$(document).on("click", "button.kv-file-remove" , function(e) {
        var thumbnail = $(this).parents(".file-thumbnail-footer").first();
        var caption = thumbnail.find('div.file-caption-info')[0].innerText;
        //console.log(caption);
        e.preventDefault();

        $.ajax({

           type:'POST',

           url:'{{ route("ajaxRemove") }}',

           data:{
                '_token' : $('input[name="_token"]').val(),
                'name': caption,
            },
           success:function(data){
              alert(data.success);
           }

        });
        $(this).parents('.file-preview-frame').remove();
    });

$(document).on("click", "button.update-product", function(e){
    var product_id = $("input[name=pro-id]").val();
    var product_code = $.trim($("input[name=pro-code]").val());
    var product_name = $.trim($("input[name=pro-name]").val());
    var product_price = $("input[name=pro-price]").val();
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
    $.ajax({

           type:'POST',

           url:'{{ route("ajaxUpdate") }}',

           data:{
                '_token' : $('input[name="_token"]').val(),
                'product_id': product_id,
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
              product_images = []
              location.reload();
           }

        });
});

    $(document).on('click', 'button.cancel', function(){
        location.reload();
    });

    $(document).ready(function() {
        $('#cate').select2();
        
        CKEDITOR.replace( 'txtdesc', {
            filebrowserBrowseUrl: '{{ route("ckfinder_browser") }}',
        } );
    });
   $(document).ready(function(){
        

    });

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