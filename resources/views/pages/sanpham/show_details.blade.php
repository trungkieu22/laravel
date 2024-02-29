@extends('layout')
@section('sidebar')
@include('pages.include.sidebar');
  
@endsection
@section('content')
@foreach ($product_details as $key => $value)

<input type="hidden" id="product_viewed_id" value="{{$value->product_id}}">
<input type="hidden" id="product_productname{{$value->product_id}}" value="{{$value->product_name}}">
<input type="hidden" id="product_producturl{{$value->product_id}}" value="{{URL::to('/chi-tiet-san-pham/'.$value->product_slug)}}">
<input type="hidden" id="product_image{{$value->product_id}}" value="{{asset('/public/upload/gallery/'.$value->product_image)}}">
<input type="hidden" id="product_productprice{{$value->product_id}}" value=" {{number_format($value->product_price).' '.'VNĐ'}}">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background: none">
      <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang Chủ</a></li>
      <li class="breadcrumb-item"><a href="{{URL::to('/danh-muc-san-pham/'.$cate_slug)}}">{{$product_cate}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
    </ol>
  </nav>
<div class="product-details"><!--product-details-->
    
    <div class="col-sm-5">
        <ul id="lightSlider">
            @foreach ($gallery as $key => $gal)
                
            
            <li data-thumb="{{asset('/public/upload/gallery/'.$gal->gallery_image)}}" data-src="{{asset('/public/upload/gallery/'.$gal->gallery_image)}}">
     <img width="100%" alt="{{$gal->gallery_name}}" src="{{asset('/public/upload/gallery/'.$gal->gallery_image)}}">

            </li>
        
       @endforeach
          
          </ul>

    </div>
    <div class="col-sm-7">
        <h2>{{$value->product_name}}</h2>

        <div class="product-information"><!--/product-information-->

            <img src="{{asset('public/frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
            <p><b>Mã ID</b> : {{$value->product_id}}</p>
            {{-- <img src="{{asset('public/frontend/images/product-details/rating.png')}}" alt="" /> --}}
            <form action="{{URL::to('/save-cart')}}" method="post">
                @csrf
                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                <input type="hidden" value="1"                        class="cart_product_qty_{{$value->product_id}}">
            <a href="{{URL::to('/chi-tiet-san-pham/'.$value->product_id)}}">
            <p><b>Giá Tiền</b> {{number_format($value->product_price).' '.'VNĐ'}}</p>
        </a>
        <span>
        {{-- <label>Số lượng:</label>  --}}
        {{-- <input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
        <input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" /> --}}
   
            <button href="#" class="btn btn-default check_out add-to-cart" type="button" data-id_product="{{$value->product_id}}" name="add-to-cart" ><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
        </span>
        </form>
            {{-- <style>
                p,b{
             font-size: 25PX;

                }
            </style> --}}
            <p><b>Tình Trạng:</b> Còn Hàng</p>
            <p><b>Hàng Mới:</b> 100%</p>
            <p><b>Thương Hiệu:</b> {{$value->brand_name}}</p>
            <p><b>Danh Mục:</b> {{$value->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
   <fieldset>
    <legend>Tags</legend>
    <p><i class="fa fa-tags"></i>
        <style>
            a.tags_style{
                margin: 3px 2px;
                border: 1px solid ;
                height: auto;
                background: #428bca;
                color: #ffff;
                padding: 0px;

            }
            a.tags_style:hover{
                background: black;
            }
        </style>
    @php
        $tags = $value->product_tags;
        $tags = explode(",", $tags);
    @endphp
    @foreach ($tags as $key => $tag)
    <a href="{{url('/tag/'.$tag)}}" class="tags_style">{{$tag}}</a>
        
    @endforeach
    
    </p>
   </fieldset>

        </div><!--/product-information-->
    </div>
</div><!--/product-details-->


<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li ><a href="#details" data-toggle="tab">Mô Tả Sản Phẩm</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
            <li class="active" ><a href="#reviews" data-toggle="tab">Đánh Giá (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane " id="details" >
       <p>  {!!$value->product_content!!}</p>
          
         

        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <p>  {!!$value->product_desc!!}</p>
           
        
        </div>
        
        <div class="tab-pane fade  active in " id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>10.03.2023</a></li>
                </ul>
<style>
                    .row.style_comment {
    border-radius: 10px;
    border: 1px solid #fff;
    background: #f0f0e9;
    
}
.view-product img {
    border: 1px solid #F7F7F0;
    height: 193px;
    width: 74%;
}
 </style>
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" value="{{$value->product_id}}" class="comment_product_id">
                    <div id="comment_show"></div>             
                <p></p>
            </form>
                <p><b>Viết Đánh Giá Của bạn</b></p>

                <ul class="list-inline" title="Average Rating">
                    @for($count = 1 ;$count<=5; $count++)
                    @php
                        if($count<=$rating){
                            $color = 'color:#FFcc00;';


                        }else {
                            $color = 'color:#ccc;';
                        }
                    @endphp
                    <li title="đánh giá sao" 
                    id="{{$value->product_id}}-{{$count}}"
                    data-index="{{$count}}"
                    data-product_id="{{$value->product_id}}"
                    data-rating="{{$rating}}"
                    class="rating"
                    style="cursor:pointer;{{$color}};font-size:30px;"
                    >&#9733;
                
                
                </li>
                @endfor
                </ul>
                <form action="#">
                    <span>
                        <input type="text" style="width:100%;margin-left:0" placeholder="tên bình luận" class="comment_name"/>
                    </span>
                    <textarea name="comment" class="comment_content" placeholder="nội dung bình luận" ></textarea>
                    <button type="button" class="btn btn-default pull-right send-comment">
                        gửi bình luận
                    </button>
                    <div id="notyfi_comment"></div>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach


<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản Phẩm Liên Quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	

                @foreach ($relate as $key => $product)
                    
             <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <form >
                                    @csrf
                                    <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                    <input type="hidden" id="wishlist_name{{$product->product_id}}" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                    <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                    <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                    
                                    <input type="hidden" id="wishlist_price{{$product->product_id}}"  value="{{$product->product_price}} VNĐ" class="cart_product_price_{{$product->product_id}}">
                                    <input type="hidden" value="1"                        class="cart_product_qty_{{$product->product_id}}">
                                <a id="wishlist_url{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                <img id="wishlist_image{{$product->product_id}}"  src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                <p>{{$product->product_name}}</p>
                            </a>
                                <button type="button"  class="btn btn-default xemnhanh" data-toggle="modal" data-target="#xemnhanh" data-id_product="{{$product->product_id}}" name="add-to-cart"><i class="fa-solid fa-eye"></i>  xem nhanh</button>
                                <button type="button"  class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i> @lang('language.Add Cart')</button>
                            </form>
                            </div>
                          
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li>
                                <i class="fa-solid fa-heart"></i>
                                <button class="button_wishlist" id="{{$product->product_id}}" onclick="wishlist(this.id);"><span>@lang('language.favourite')</span></button>
                            </li>
                            <li class=""><a style="cursor: pointer" onclick="add_compare({{$product->product_id}})"><i class="fa fa-plus-square"></i>@lang('language.compare')</a></li>
                            <div class="container">
                                <!-- Button to Open the Modal -->
                           
                              
                                <!-- The Modal -->
                                <div class="modal" id="sosanh">
                                  <div id="sosanh" class="modal-dialog">
                                    <div class="modal-content">
                                    
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title"><span id="title-compare"></span></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      
                                      <!-- Modal body -->
                                      <div class="modal-body">
        
                                        {{-- <div id="row_compare"></div> --}}
                                        <table class="table" id="row_compare">
                                            <thead>
                                              <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Hình ảnh</th>
                                                <th>Xem sản phẩm</th>
                                                <th>Xóa</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                           
                                              
                                            </tbody>
                                          </table>
                                      </div>                              
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                        </ul>
                    </div>
                  </div>
              
           
                </div>
                @endforeach

              
            </div>
            
            
                </div>
               
            </div>
            
             
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
          </a>			
    </div>
</div><!--/recommended_items-->
</div><!--features_items-->

<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title product_quickview_title" id="exampleModalLabel">
            <span id="product_quickview_title"></span>
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
<div class="row">
    <div class="col-md-4">
        <span id="product_quickview_image"></span>
        <span id="product_quickview_gallery"></span>


    </div>
    <form action="">
        @csrf
        <div id="product_quickview_value"></div>
    <div class="col-md-9">
        <style>
            h5.modal-title.product_quickview_title {
                text-align: center;
                font-size: 25;
                color: #000;

            }
            
            p.quickview{
                font-size: 14px;
                color: brown;

            }
            span#product_quickview_gallery img {
    width: 130%;
}
span#product_quickview_desc img {
    width: 100%;
    height: 100%;
}
span#product_quickview_image img {
    width: 130%;
}
span#product_quickview_content img {
    width: 100%;
}
span#product_quickview_desc ul li {
    width: 100%;
}
span#product_quickview_content p {
    width: 100%;
}
span#product_quickview_content h3 {
    width: 100%;
    
}
span#product_quickview_desc p {
    width: 100%;
}
span#product_quickview_content strong img {
    height: 230px;
    width: 301px;
    width: 104%;
}
span#product_quickview_content h2 {
    width: 100%;
}
@media screen and (max-width:768px) {
  .modal-dialog {
    width: 700px;
  }
  .modal-sm{
    width: 350px;
  }

}
@media screen and (max-width:992px) {
  .modal-lg{
    width: 1200px;

  }
}


        </style>
        <h2 class="quickview"><span id="product_quickview_title"></span></h2>
        <p>Mã ID : <span id="product_quickview_id"></span></p>
        <h2>Giá sản phẩm : <span id="product_quickview_price"></span></h2>
        <label for="">số lượng</label>
        <input type="number" name="qty" min="1" class="cart_product_qty_" value="1">
        <input type="hidden" name="productid_hidden" value="">
        <p class="quickview">Mô tả sản phẩm</p>
        <fieldset class="style">
            <span id="product_quickview_desc"></span>
            <span   id="product_quickview_content"></span>

            <div id="product_quickview_button"></div>
            <div id="beforsend_quickview"></div>
        </fieldset>





    </div>
</form>

</div>        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary redirect-cart">Đi tới sản phẩm</button>
        </div>
      </div>
    </div>
  </div>
{{-- <script>
 $(function() {
  var zoom = function(elm) {
    elm
      .on('mouseover', function() {
        $(this).children('.img').css({'transform': 'scale(2)'});
      })
      .on('mouseout', function() {
        $(this).children('.img').css({'transform': 'scale(1)'});
      })
      .on('mousemove', function(e) {
        $(this).children('.img').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
      })
  }

  $('.item').each(function() {
    $(this)
      .append('<div class="img"></div>')
      .children('.img').css({'background-image': 'url('+ $(this).data('image') +')'});
    zoom($(this));
  })
})
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="{{asset('/public/frontend/css/lightslider.min.css')}}" rel="stylesheet">
<link href="{{asset('/public/frontend/css/prettify.css')}}" rel="stylesheet">
<script src="{{asset('/public/frontend/js/prettify.js')}}"></script>
<script src="{{asset('/public/frontend/js/lightslider.js')}}"></script>
<script src="{{asset('/public/frontend/js/jquery.sharrre.min.js')}}"></script>
<script type="text/javascript">
 $('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    loop:true,
    slideMargin: 0,
    thumbItem:3
});
  </script>
  <style>
    .lSSlideOuter .lSPager.lSGallery img {
  display: block;
  height: auto;
  max-width: 100%;
  height: 90px;
}
  </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection