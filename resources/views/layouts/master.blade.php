<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('title')</title>
	<!-- BOOTSTRAP CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">



	<!-- AWESOME ICON FONT -->
	<link href="{{ asset('lib/awesome/css/font-awesome.min.css') }}" rel="stylesheet">

	<!-- IMPORT FONT GOOGLE LINK -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,700,300&amp;subset=vietnamese,latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- SLIDE CSS -->
    <link rel="stylesheet" href="{{ asset('lib/slider/default.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('lib/slider/nivo-slider.css') }}" type="text/css" media="screen" />
    <!-- Owl Carousel Assets -->
    <link href="{{ asset('lib/owlcarousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/owl.theme.css') }}" rel="stylesheet">
    <style type="text/css">
		body {
			width: 100%;
			margin: 0%;
		}
		.container {

		}
		.user{
			float: right;
		}

    	.user .navbar-nav>li>a{
    		padding: 0 5px;
    	}
		div.tit-boxspl a{
			overflow: hidden;
		}
		.thumb-boxspl{
			max-width: 95%;
		}
		#back-to-top {
		    position: fixed;
		    bottom: 95px;
		    right: 40px;
		    z-index: 9999;
		    width: 40px;
		    height: 40px;
		    text-align: center;
		    line-height: 32px;
		    background: #347091;
		    color: #fff;
		    cursor: pointer;
		    border: 0;
		    border-radius: 2px;
		    text-decoration: none;
		    transition: opacity 0.2s ease-out;
		    opacity: 0;
		    font-size: 28px;
		}
		#back-to-top:hover {
		    background: #32CD32;
		}
		#back-to-top.show {
		    opacity: 1;
		}
    </style>
    @yield('css')
</head>
<body>
	@include('layouts.header')
	<div class="container">
		@yield('content')
		<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
	</div>
	<div id="footer-container">
		@include('layouts.footer')
	</div>
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				xfbml            : true,
				version          : 'v5.0'
			});
		};

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Your customer chat code -->
	<div class="fb-customerchat"
		attribution=setup_tool
		page_id="106349454150590">
	</div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=340845793460737&autoLogAppEvents=1"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		// $(".discart").hover(function(){
		// 	$(".top-cart-content").css("display","block");
		// }, function(){
		// 	$(".top-cart-content").css("display","none");
		// });
	</script>
	<script src="{{ asset('lib/slider/jquery.nivo.slider.pack.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$(window).load(function() {
		    $('#slider').nivoSlider();
		});
	</script>

	<!-- Owl Carousel Assets -->
	<script src="{{ asset('lib/owlcarousel/owl.carousel.js') }}"></script>
	<script>
    $(document).ready(function() {
      	$("#slider-tintuc").owlCarousel({
      		autoPlay: 3000,
	      	navigation : true,
	      	slideSpeed : 300,
	      	paginationSpeed : 400,
	      	singleItem : true
      	});
      	$("#spmoi").owlCarousel({
      		autoPlay: 3000,
      		//items : 4,
	       //  itemsDesktop : [1199,3],
	       //  itemsDesktopSmall : [979,3],
	       //  itemsMobile : [768,2]
	       	itemsCustom : [
		        [0, 2],
		        [600, 3],
		        [1200, 4],
		    ],
      	});
	});
    </script>

    <script type="text/javascript">
    	// hidden-show children menu
		$(document).ready(function () {
		    //use event delegation since classes are changed dynamically
		    $('.ulspmobi').on('click', '.iconlist', function () {
		        //remove the show class and assign hidden
		        $(this).toggleClass('iconlist1 iconlist');
		        //the subfield is a child of the parent not the next sibling
		        $(this).siblings('ul.mnboxl_1').show('slow');
		    });
		    $('.ulspmobi').on('click', '.iconlist1', function () {
		        $(this).toggleClass('iconlist1 iconlist');
		        $(this).siblings('ul.mnboxl_1').hide('slow');
		    });

		    if ($('#input-search').is(':empty')){
		    	$('#input-search').css('border: 0px;');
		    }
		});

		$.ajaxSetup({

	        headers: {

	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	        }

	    });
		$(document).on('click', '.add-to-cart', function(e){
			e.preventDefault();
			//alert($(this).attr("data-id"));
			$.ajax({

				type:'POST',

				url:'{{ route("ajaxAddToCart") }}',

				data:{
					'pro_id': $(this).attr("data-id"),
					'pro_code': $(this).data('code'),
					'pro_name': $(this).data('name'),
					'pro_price': $(this).data('price'),
					'pro_path' : $(this).data('path'),
				},
				success:function(data){
					$('.count_products_cart').first().text( data.count+' sản phẩm');
				}
			});
		});

		$(document).on('keyup', '#input-search', function(){

			$.ajax({

	           type:'POST',

	           url:'{{ route("live-search") }}',

	           data:{
	                '_token' : $('input[name="_token"]').val(),
	                'keyword': $.trim($('#input-search').val().toLowerCase()),
	            },
	           success:function(data){
	              console.log(data);
	              $('#search-content').html(data);
	           }

	        });
		});

		$(document).mouseup(function(e)
		{
		    var container = $("#search-content a");

		    // if the target of the click isn't the container nor a descendant of the container
		    if (!container.is(e.target) && container.has(e.target).length === 0)
		    {
		        container.hide();
		    }
		});


		function vi_to_en(alias) {
		    var str = alias;
		    str = str.toLowerCase();
		    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
		    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
		    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
		    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
		    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
		    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
		    str = str.replace(/đ/g,"d");
		    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`| |{|}|\||\\/g,"-");
		    str = str.replace(/ + /g," ");
		    str = str.trim();
		    return str;
		}

		$(document).ready(function(){
			if ($('#back-to-top').length) {
		    var scrollTrigger = 100, // px
		        backToTop = function () {
		            var scrollTop = $(window).scrollTop();
		            if (scrollTop > scrollTrigger) {
		                $('#back-to-top').addClass('show');
		            } else {
		                $('#back-to-top').removeClass('show');
		            }
		        };
		    backToTop();
		    $(window).on('scroll', function () {
		        backToTop();
		    });
		    $('#back-to-top').on('click', function (e) {
		        e.preventDefault();
		        $('html,body').animate({
		            scrollTop: 0
		        }, 700);
		    });
		}
		});

		$(document).on('submit','#search-form', function(){
			if ($.trim($('#input-search').val()) == ""){
				return false;
			}
		});

		$(document).ready(function() {
			$("#search-content").css({
				'max-width': ($("#input-search").outerWidth() + 'px')
			});
		});
    </script>
    @yield('js')
</body>
</html>
