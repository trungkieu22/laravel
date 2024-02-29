@extends('layout')
@section('content_category')
<div class="features_items"><!--features_items-->
  
    @foreach($brand_name as $key => $name)

    <h2 class="title text-center">{{$name->brand_name}}</h2>
 
    @endforeach
    
    
    @foreach($brand_by_id as $key => $product)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            
            <div class="single-products">
                    <div class="productinfo noidung text-center ">
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
</div><!--features_items-->

  
  <!-- Modal -->
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
    <div class="col-md-2">
        <span id="product_quickview_image"></span>
        <span id="product_quickview_gallery"></span>


    </div>
    <form action="">
        @csrf
        <div id="product_quickview_value"></div>
    <div class="col-md-10">
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
@endsection