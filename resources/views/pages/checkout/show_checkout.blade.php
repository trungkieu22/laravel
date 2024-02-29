@extends('layout')
@section('content_category')


<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="register-req">
            <p>Làm ơn hãy đăng nhập hoặc đăng ký để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->
       

        <div class="shopper-informations">
            
            <div class="row">
            
                <div class="col-sm-10 clearfix">
                    
                    <div class="bill-to">
                        
                        <p>Điền thông tin gửi hàng</p>
                        <div class="form-one">
                          
                            <form method="post" >
                                @csrf
                                <input type="text" name="shipping_email" class="shipping_email" data-validation="email*" data-validation-error-msg="làm ơn điền đúng email"  placeholder="Email*">
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên*">
                                <input type="text" name="shipping_address" class="shipping_address" placeholder="địa chỉ*">
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="điện thoại*">
                                <textarea  name="shipping_notes" class="shipping_notes"  placeholder="ghi chú đơn hàng của bạn*" rows="5"></textarea>
                              
                                @if(Session::get('fee'))
                                <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                            @else 
                                <input type="hidden" name="order_fee" class="order_fee" value="30000">
                            @endif

                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                @endforeach
                            @else 
                                <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                            @endif
                            


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình thức Thanh toán</label>
                                      <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="0">chuyển khoản</option>
                                            <option value="1">tiền mặt</option>
                                           
                                    </select>
                                </div>
                                
                                <input class="btn btn-primary btn-sm send_order" type="button" name="send_order" value="Xác Nhận Đơn Hàng" >
                              
                            </form>
                           <div class="col-md-12 style">
                            <form class="style" >
                                @csrf 
                            <div class="form-group ">
                                <label for="exampleInputPassword1">Chọn thành phố</label>
                                  <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                
                                        <option value="">--Chọn tỉnh thành phố--</option>
                                    @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                    @endforeach
                                        
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn quận huyện</label>
                                  <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận huyện--</option>
                                       
                                </select>
                            </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Chọn xã phường</label>
                                  <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn xã phường--</option>   
                                </select>
                            </div>
                             
                           
                            <input class="btn btn-primary btn-sm calculate_delivery" type="button" name="calculate_oder" value="tính phí đơn hàng" required>
                            </form>
                           </div>
                           
                           
                             {{-- {{session()->get('fee')}} --}}
                        </div>
                      
                        </div>
                        
                   
                    </div>
                    
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

                        <form action="{{url('/update-cart')}}" method="POST">
                            @csrf
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <th class="image">Hình ảnh</th>
                                    <th class="description">Tên sản phẩm</th>
                                    <th class="description">Sản Phẩm còn</th>
                                    <th class="price">Giá sản phẩm</th>
                                    <th class="quantity">Số lượng</th>
                                    <th class="total">Thành tiền</th>
                                    <th></th>
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
                                        
                                        
                                            <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
                                        
                                            
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{number_format($subtotal,0,',','.')}}VNĐ
                                            
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="btn btn-danger btn-xs cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                
                                @endforeach
                                <tr>
                                    <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
                                    <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>

                                  <td>
                                        @if(Session::get('coupon'))
                                          <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                                        @endif
                                    </td>

                                    
                                    <td colspan="2">
                                    <li>Tổng tiền :<span>{{number_format($total,0,',','.')}} VNĐ</span></li>
                                    @if(Session::get('coupon'))
                                    <li>
                                        
                                        @foreach(Session::get('coupon') as $key => $cou)
                                        @if($cou['coupon_condition']==1)
                                            Mã giảm : {{$cou['coupon_number']}} %
                                            <p>
												@php 
												$total_coupon = ($total*$cou['coupon_number'])/100;
												echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').' VNĐ</li></p>';
												@endphp
											</p>
                                            <p>
                                            @php 
                                                $total_after_coupon = $total-$total_coupon;
                                            @endphp
                                            </p>
                                        @elseif($cou['coupon_condition']==2)
                                            Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} VNĐ
                                            <p>
                                                @php 
                                                $total_coupon = $total - $cou['coupon_number'];
                                            
                                                @endphp
                                            </p>
                                            @php 
                                                $total_after_coupon = $total_coupon;
                                            @endphp
                                        @endif
                                    @endforeach

                                    </li>
                                    @endif

                                    @if(Session::get('fee'))
                                    <li>	
                                        <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>

                                        Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}} VNĐ</span></li> 
                                        <?php $total_after_fee = $total + Session::get('fee'); ?>
                                    @endif 
                                    <li>Tổng còn:
                                    @php 
                                        if(Session::get('fee') && !Session::get('coupon')){
                                            $total_after = $total_after_fee; 
                                            echo number_format($total_after,0,',','.').' VNĐ';
                                        }elseif(!Session::get('fee') && Session::get('coupon')){
                                            $total_after = $total_after_coupon;
                                            echo number_format($total_after,0,',','.').' VNĐ';
                                        }elseif(Session::get('fee') && Session::get('coupon')){
                                            $total_after = $total_after_coupon;
                                            $total_after = $total_after + Session::get('fee');
                                            echo number_format($total_after,0,',','.').' VNĐ';
                                        }elseif(!Session::get('fee') && !Session::get('coupon')){
                                            $total_after = $total;
                                            echo number_format($total_after,0,',','.').' VNĐ';
                                        }

                                    @endphp
                                    </li>
                                    
                                </td>
                                </tr>
                                @else 
                                <tr>
                                    <td colspan="5"><center>
                                    @php 
                                    echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                                    @endphp
                                    </center></td>
                                </tr>
                                @endif
                            </tbody>
                        </form>
                            @if(Session::get('cart'))
                            <tr><td>

                                    <form method="POST" action="{{url('/check-coupon')}}">
                                        @csrf
                                            <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
                                              <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                                          
                                          </form>
                                      </td>
                                      

                                        </form>
                                       
                                        <td>
                                            <form action="{{url('/momo-payment')}}" method="POST">
                                             @csrf
                                             <input type="hidden" name="total_momo" value="{{$total_after}}" />
                                             <button type="submit" class="btn btn-default check_out" name="payUrl"  id="payUrl">     
                                                <img width="30px" height="30px" src="{{asset('/public/frontend/momo.png')}}">
                                                Thanh toán MOMO</button>
                                            </form>
                                               
                                     </td>  
                                     <td>
                                        <form action="{{url('/vnpay-payment')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="total_vnpay" value="{{$total_after}}" />
                                            <button type="submit" class="btn btn-default check_out" name="redirect" id="redirect">     
                                               <img width="30px" height="30px"  src="{{asset('/public/frontend/vn.png')}}">
                                               Thanh toán VNPAY</button></td>   
                                            </form>
                                    
                                                                  
                            </tr>
                            @endif

                        </table>

                    </div>

                </div>
				
            </div>
        </div>

    </div>
</section> <!--/#cart_items-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
$.validate({
    modules : 'security',
    onModulesLoaded : function() {
        var optionalConfig = {
            fontSize: '12pt',
            padding: '4px',
            bad : 'Very bad',
            weak : 'Weak',
            good : 'Good',
            strong : 'Strong'
        };

        $('input[name="customer_password"]').displayPasswordStrength(optionalConfig);
    }
});
</script>

@endsection