@extends('layout')
@section('content_category')


<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">@lang('language.home')</a></li>
              <li class="active">Giỏ Hàng Của Bạn</li>
            </ol>
        </div>            
        @if(session()->has('message'))
        <div class="alert alert-success">
            {!! session()->get('message') !!}
        </div>
    @elseif(session()->has('error'))
         <div class="alert alert-danger">
            {!! session()->get('error') !!}
        </div>
    @endif
        <div class="table-responsive cart_info">
            <form action="{{url('/update-cart/')}}" method="post">
     @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th class="image">Hình Ảnh</th>
                        <th class="description">Tên sản Phẩm</th>
                        <th class="description">Sản Phẩm còn</th>
                        <th class="price">Giá Sản Phẩm</th>
                        <th class="quantity">Số Lượng</th>
                        <th class="total">Thành Tiền</th>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                @if(Session()->get('cart')==true)
                    @php
                     $total = 0;
                 @endphp
                 @foreach (session()->get('cart') as $key => $cart)

                 @php
                 $subtotal = (float)$cart['product_price'] * (int)$cart['product_qty'];
                $total += $subtotal;
                 @endphp
                     
                    <tr>
                        <td class="cart_product">
                            <img src="{{asset('/public/upload/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}">
                        </td>
                        <td class="cart_description">
                            {{-- <h4><a href="">{{$cart['product_name']}}</a></h4> --}}
                            <p>{{$cart['product_name']}}</p>
                        </td>
                        <td class="cart_description">
                            <p>{{ isset($cart['product_quantity']) ? $cart['product_quantity'] : '' }}</p>    {{-- <p>{{$cart['product_name']}}</p> --}}
                        </td>
                     
                        <td class="cart_price">
                            <p>{{number_format((float)$cart['product_price'],0,',',".")}} VNĐ</p>
                        </td>
                           
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" min="1" size="2" >
                              
                            </div>
                        </td>
                  
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($subtotal,0,',',".")}} VNĐ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="btn btn-danger btn-xs cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                   
                    @endforeach
                    <tr>
                        <td>  
                            <input class="btn btn-default btn-sm check_out" type="submit" name="update_qty" value="Cập Nhật Giỏ Hàng" >
                        </td>

                        <td>  
                      <a class="btn btn-default btn-sm check_out" href="{{url('/del-all-product')}}">Xóa Tất cả</a>
                        </td>
                        <td>
                            @if(Session()->get('coupon'))
                              <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                            @endif
                        </td>
                        <td>
                            <?php 
                            $customer_id = session()->get('customer_id');
                            if($customer_id!=null){
                           
                           ?>
                            <a  class="btn btn-default check_out" href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Đặt hàng</a>
                            <?php 
                            
                            }else {
                               ?>
                          <a  class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Đặt hàng</a>

                               <?php
                            }
                            ?>
                           
                           

                            
                        </td>

                      
                        <td>
                            <li>Tổng tiền: <span> <span>{{number_format($total,0,',',".")}} VNĐ</span></li>
                            @if(Session()->get('coupon'))
							<li>
								
									@foreach(Session()->get('coupon') as $key => $cou)
										@if($cou['coupon_condition']==1)
											Mã giảm : {{$cou['coupon_number']}} %
											<p>
												@php 
												$total_coupon = ($total*$cou['coupon_number'])/100;
												echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').' VNĐ</li></p>';
												@endphp
											</p>
											<p><li>Tổng đã giảm :{{number_format($total-$total_coupon,0,',','.')}} VNĐ</li></p>
										@elseif($cou['coupon_condition']==2)
											Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
											<p>
												@php 
												$total_coupon = $total - $cou['coupon_number'];
								
												@endphp
											</p>
											<p><li>Tổng đã giảm :{{number_format($total_coupon,0,',','.')}} VNĐ</li></p>
										@endif
									@endforeach
								


							</li>
							@endif 
                            {{-- <li>Phí Vận Chuyển <span>Free</span></li> --}}
                            {{-- <li>Thành tiền :</span></li> --}}
                        </td>
                        
                    </tr>
                   @else
                  <tr>
                      <td colspan="5"><center>
                       @php
                    echo'làm ơn hãy thêm sản phẩm vào giỏ hàng';
                     @endphp
                   </center></td> 
                
                </tr>
                @endif
                </tbody>
            </form>

            @if(Session()->get('cart'))
            <tr><td>

                    <form method="POST" action="{{url('/check-coupon')}}">
                        @csrf
                            <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
                              <input type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính mã giảm giá">
                           
                          </form>
                      </td>
            </tr>
            @endif
            </table>
        </div>
    </div>
 </section> <!--/#cart_items-->
 <style>
    /* .table-responsive.cart_info {
    width: 147%;
} */
 </style>
@endsection
