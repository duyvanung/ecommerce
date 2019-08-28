@extends('adminlte::page')

@section('content_header')
    <h1>Banner</h1>
@stop

@section('content')
<div id="show-slider">
    <div class="form-group">
        <label>Chọn hình ảnh</label>
        <div class="file-loading">
        	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input id="kv-explorer" type="file" name="file" multiple>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
<style type="text/css">
    
</style>
@endsection

@section('js')
<script src="{{ asset('js/plugins/piexif.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/locales/fr.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/locales/es.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

	var initPreview = [];
	var initPreviewConfig = [];
	$(document).ready(function () {
        var uploads_path = "{{ asset('images') }}";
        var jsproduct = @json($banner);
        console.log(jsproduct)
        for (var i=0; i<jsproduct.length; i++){
            var imgPath = uploads_path +'/'+ jsproduct[i].path;
            initPreview.push(imgPath);
            var imgConfig = {caption: jsproduct[i].path};
            initPreviewConfig.push(imgConfig);
        }
        $("#kv-explorer").fileinput({
            'theme': 'fa',
            'uploadUrl': '{{route("widget.upload.post")}}',
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                    'widget_type': 'banner'
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif'],
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

    $(document).on("click", "button.kv-file-remove" , function(e) {
        var thumbnail = $(this).parents(".file-thumbnail-footer").first();
        var caption = thumbnail.find('div.file-caption-info')[0].innerText;
        //console.log(caption);
        e.preventDefault();

        $.ajax({

           type:'POST',

           url:'{{ route("ajax-remove-widget") }}',

           data:{
                '_token' : $('input[name="_token"]').val(),
           		'name': caption,
                'widget_type': 'banner',
            },
           success:function(data){
              alert(data.success);
           }

        });
        $(this).parents('.file-preview-frame').remove();
    });
</script>
@endsection