@extends('layouts.master')
@section('title', count($data)>0 ? $data[0]->product_name : 'Sản phẩm không tồn tại')
@section('content')
@if(isset($data) and count($data)>0)
   <section class="panel">
      <div class="panel-body">
         <div class="col-sm-5 col-md-5">
            <div class="pro-img clearfix" style="max-width: 475px;">
               <ul id="lightSlider">
               @foreach($data as $sp)
                  <li data-thumb="{{ asset('uploads').'/'.$sp->path }}">
                     <img src="{{ asset('uploads').'/'.$sp->path }}" />
                  </li>
               @endforeach
               </ul>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            <h4 class="pro-d-title">
               {{ $data[0]->product_name }}
            </h4>
            <div class="product_meta">
               <span class="posted_in"> 
                  <strong>Loại:</strong> 
                @foreach($cates_data as $dt)
                  <a rel="tag" href="{{ url($dt['en_name']) }}" style="text-transform: lowercase;">{{ $dt['name'] }}</a>
                @endforeach
               </span>
               <span class=""><strong>Tình trạng: </strong>{{ $data[0]->status }}</span>
               <span class=""><strong>Bảo hành: </strong>{{ $data[0]->warranty }}</span>
            </div>
            @if (isset($deals_data) and count($deals_data) > 0)
            <aside class="promotion_wrapper" style="display:block">
               <b id="promotion_header"><i class="fa fa-gift" aria-hidden="true"></i> Khuyến mãi</b>
               <div class="khuyenmai-info">
                  <div class="kmChung">
                  @foreach($deals_data as $deal)
                     <div class="pack-detail">
                        <ul class="el-promotion-pack" style="margin-bottom: 0px">
                           <li>{{ $deal->name }}</li>
                        </ul>
                     </div>
                  @endforeach
                  </div>
               </div>
            </aside>
            @endif
            <div class="m-bot15"> 
               <strong>Giá : </strong>
               <span class="pro-price"> {{ number_format($data[0]->price) }} đ</span>
            </div>
            <div>
               <button class="btn btn-round btn-danger add-to-cart" type="button" data-id="{{ $data[0]->id }}" data-name="{{ $data[0]->product_name }}" data-code="{{ $data[0]->product_code }}" data-price="{{ $data[0]->price }}" data-path="{{ $data[0]->path }}"><i class="fa fa-shopping-cart"></i> Chọn mua</button>
            </div>
         </div>
      </div>
   </section>
   <div class="row">
      <div class="col-md-9">
         <section class="product_description_area">
            <h2 style="margin: 0px;">Thông tin sản phẩm</h2>
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#home">Mô tả</a></li>
               <li><a data-toggle="tab" href="#menu1">Đánh giá</a></li>
            </ul>
            <div class="tab-content">
               <div id="home" class="tab-pane fade in active">
                  <div id="post-content">
                    @include('layouts.sample-post')
                  </div>
               </div>
               <div id="menu1" class="tab-pane fade">
                      {{--<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                    <p class="text-secondary text-center">15 Minutes Ago</p>
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <p>
                                        <a class="text-left" href="https://maniruzzaman-akash.blogspot.com/p/contact.html" style="color: #007bff"><strong>Maniruzzaman Akash</strong></a>
                                        <span style="float: right;">
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                        </span>

                                   </p>
                                   <div class="clearfix"></div>
                                    <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                    <p class="text-right">
                                        <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                        <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                   </p>
                                </div>
                            </div>
                            <div class="card card-inner">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                            <p class="text-secondary text-center">15 Minutes Ago</p>
                                        </div>
                                        <div class="col-xs-10 col-sm-10 col-md-10">
                                            <p><a href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman Akash</strong></a></p>
                                            <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                            <p>
                                                <a class="float-right btn btn-outline-primary ml-2">  <i class="fa fa-reply"></i> Reply</a>
                                                <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                           </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <div class="fb-comments" data-href="{{ route('product-detail', [$data[0]->id]) }}" data-width="auto" data-numposts="5"></div>
               </div>
            </div>
         </section>
         <div class="boxmain spmoi">
            @include('layouts.spmoi')
         </div>
      </div>
      <div class="col-md-3 hidden-sm hidden-xs" style="position: -webkit-sticky;
  position: sticky; top: 10px;">
         {{--<div class="boxleft hidden-xs">
            <div class="titboxl">
               <i class="fa fa-rss-square fa-x2 fa-lg" aria-hidden="true"></i>
               <span>Tin tức</span>
            </div>
            <div class="ctboxleft">
               <div id="slider-tintuc" class="owl-carousel">
                  <div class="item tintucl">
                     <a href=""><img src="{{ asset('images/img-tin.jpg') }}"></a>
                     <h3><a href="">5 loa di động đáng chú ý có giá dưới 1 triệu đồng</a></h3>
                     <p>Không ai muốn nghe nhạc qua chiếc loa nhỏ và rè của smartphone, đó là lý do ngày càng nhiều người bỏ tiền mua loa di động. Loa di...</p>
                  </div>
               </div>
            </div>
         </div>--}}
         @if (isset($vbanner))
          <div class="boxleft hidden-xs">
            <div class="ctboxleft qc">
              <a href=""><img src="{{ asset('images').'/'.$vbanner->path }}"></a>
            </div>
          </div>
          @endif
      </div>
   </div>
   <div class="row">
      <div class="col-md-9">
         
      </div>
   </div>

@else
<h2 class="not-exist">Sản phẩm không tồn tại</h2>
@endif
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css">
<style type="text/css">
   .pro-img {
   width:90%;
   }
   .pro-img > ul {
   list-style: none outside none;
   padding-left: 0;
   margin-bottom:0;
   }
   .pro-img > ul > li {
   display: block;
   float: left;
   margin-right: 6px;
   cursor:pointer;
   }
   img {
   display: block;
   height: auto;
   max-width: 100%;
   }
   /*panel*/
   .panel {
   border: none;
   box-shadow: none;
   margin: 0px;
   }
   .panel-heading {
   border-color:#eff2f7 ;
   font-size: 16px;
   font-weight: 300;
   }
   .panel-title {
      color: #2A3542;
      font-size: 14px;
      font-weight: 400;
      margin-bottom: 0;
      margin-top: 0;
      font-family: 'Open Sans', sans-serif;
   }
   .pro-d-title {
      font-size: 26px;
      margin-top: 10px;
   }
   .product_meta {
      border-top: 1px solid #eee;
      border-bottom: 1px solid #eee;
   }
   .product_meta span {
      display: block;
      margin-bottom: 10px;
      margin-top: 10px;
   }
   .product_meta a, .pro-price{
      color:#e11b1e;
   }
   .pro-price, .amount-old {
      font-size: 20px;
      padding: 0 10px;
   }
   .amount-old {
      text-decoration: line-through;
   }
   .quantity {
      width: 120px;
   }
   .pro-d-head {
      font-size: 18px;
      font-weight: 300;
   }
   ul {
      padding-left: 0;
      margin-bottom:0;
   }
   li {
      margin-right: 6px;
      cursor: pointer;
   }

   img {
   display: block;
   height: auto;
   max-width: 100%;
   }
   .tit-boxmain {
        height: auto;
   }
   .m-bot15{
      padding: 5px 0px 5px;
   }
   .product_description_area {
      padding-bottom: 25px;
   }

   .promotion_wrapper {
       border: #e11b1e solid 1px;
       border-radius: 4px;
       padding: 10px 0 0;
       position: relative;
       overflow: visible;
       margin: 20px 0;
       float: left;
       width: 100%;
   }

   .promotion_wrapper b {
       background: #e11b1e;
       border-radius: 13px;
       color: #fff;
       font-size: 14px;
       font-weight: 400;
       position: absolute;
       top: -13px;
       left: 10px;
       vertical-align: middle;
       line-height: 26px;
       clear: both;
       padding: 0 15px;
       text-transform: uppercase;
   }
   .khuyenmai-info {
       padding: 10px 10px 0;
   }
   .pack-detail {
       margin-bottom: 5px;
       position: relative;
   }
   .el-promotion-pack {
       padding: 0 15px;
   }

   .el-promotion-pack > li {
       list-style-type: disc;
       color: #e11b1e;
   }

   .kmChung a {
       color: #d70018;
       text-decoration: none;
   }

   .kmChung h4 {
       font-size: 13px;
       font-weight: 700;
   }
   .not-exist{
      padding: 50px;
   }
   .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .text-warning{
        color: #ffc107!important;
    }
    .card-inner{
        margin-left: 4rem;
    }

    .showmore-button {
      cursor: pointer; 
      background-color: #069; 
      color: white; 
      text-transform: uppercase; 
      text-align: center; 
      padding: 7px 5px 5px 5px; 
      margin-top: 5px;
    }
    #post-content{
      padding: 5px;
    }
    .spmoi{
      padding-right: 5px;
      padding-left: 5px;
    }

</style>
@endsection
@section('js')
<script src="https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js"></script>

<script src="{{ asset('js/jquery.show-more.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function() {
       $('#lightSlider').lightSlider({
           gallery: true,
           item: 1,
           loop:true,
           slideMargin: 0,
           thumbItem: 6,
           auto: true,
           pause: 3000
       });
   });

    $('#post-content').showMore({
      buttontxtmore: "show more",
      buttontxtless: "show less",
      minheight: 500,
      animationspeed: 250
    });


</script>
@endsection