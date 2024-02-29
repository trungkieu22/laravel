<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

    
<body style="background: rgb(200, 255, 192)">
    <center><h1 style="font-size:30px; font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;">CÔNG TY TRÁCH NHIỆM HỮU HẠN CHOUBUI</h1></center>
 <center>
    <div class="container" style="color:black"  >
        <p> Chào bạn:<strong>{{$shipping_array['customer_name']}}</strong> đây là mail trả lời tự động <br>
            xin quý khách vui lòng không trả lời mail <br>
            
           chúng tôi đã xác nhận bạn đã đặt hàng ở công ty chúng tôi gồm những thông tin sau:</p>
         <h4><b>THÔNG TIN VỀ ĐƠN HÀNG</b></h4>
         <p>MÃ ĐƠN HÀNG :<strong> {{$code['order_code']}}</strong></p>
         <p>PHI SHIP :<strong> {{$shipping_array['fee_ship']}}</strong></p>
         <p>MÃ KHUYẾN MÃI :<strong> {{$code['coupon_code']}}</strong></p>
         <h4>Sản phẩm đã được chúng tôi xác nhận</h4>
         <p>EMAIL:
             @if($shipping_array['shipping_email']=='')
            KHÔNG CÓ
             @else
             <span>
                <strong> {{$shipping_array['shipping_email']}}</strong>
             </span>
             @endif
         </p>
         <p>HỌ VÀ TÊN NGƯỜI NHẬN:
             @if($shipping_array['shipping_name']=='')
             KHÔNG CÓ
             @else
             <span>
                 <strong>{{$shipping_array['shipping_name']}}</strong>
             </span>
             @endif
         </p>
         <p>ĐỊA CHỈ:
             @if($shipping_array['shipping_address']=='')
             KHÔNG CÓ
             @else
             <span>
                 <strong>{{$shipping_array['shipping_address']}}</strong>
             </span>
             @endif
         </p>
         <p>ĐIỆN THOẠI:
             @if($shipping_array['shipping_phone']=='')
             KHÔNG CÓ
             @else
             <span>
                <strong> {{$shipping_array['shipping_phone']}}</strong>
             </span>
             @endif
         </p>
         <p>ghi chú:
             @if($shipping_array['shipping_notes']=='')
             KHÔNG CÓ
             @else
             <span>
                <strong> {{$shipping_array['shipping_notes']}}</strong>
             </span>
             @endif
         </p>
         <p>HÌNH THỨC THANH TOÁN:
             @if($shipping_array['shipping_method']==0)
             <strong>CHUYỂN KHOẢN </strong>
             @else       
                <strong>TIỀN MẶT</strong>
              @endif
         </p>
 
         <h4> DANH SÁCH SẢN PHẨM BẠN ĐÃ ĐẶT :</h4>
         <table style=" width: 60%;
         border-collapse: collapse;
         margin-top: 20px;">
             <thead>
                 <tr>
                     <th>TÊN SẢN PHẨM</th>
                     <th>GIÁ TIỀN</th>
                     <th>SỐ LƯỢNG </th>
                     <th>THÀNH TIỀN</th>
                 </tr>
             </thead>
             <tbody >
                 @php
                     $sub_total = 0;
                     $total = 0;
                 @endphp
                 @foreach ($cart_array as $cart)
                 @php
                 $sub_total = (float)$cart['product_price']*(int)$cart['product_qty'];
                 $total+=$sub_total;
             @endphp
 
                 <tr>
                     <td><strong><p>{{$cart['product_name']}}</p></strong></td>
                     <td>  <p><strong>{{number_format((float)$cart['product_price'],0,',','.')}} VNĐ</strong></p></td>
                     <td><p><strong>{{$cart['product_qty']}}</strong></p></td>
                     <td><p> <strong>{{number_format($sub_total,0,',','.')}}VNĐ</strong>
                     </p></td>
                 
                 </tr>
                 @endforeach
              
                 <tr>
                     <td><strong>SỐ TIỀN CHƯA ÁP DỤNG DỊCH VỤ :<span>{{number_format($total,0,',','.')}} VNĐ</span></strong></td>
                 </tr>
             </tbody>
         </table>
     </div>
     <p>xem lại lịch sử đặt hàng của bạn tại đây<a target="_blank" href="{{url('/history')}}"> lịch sử đơn hàng của bạn</a></p> 
     {{-- target="_blank " mở cho mình một tab mới --}}
 </center>
<center>    <P><B>Cảm ơn bạn đã đặt hàng chúng tôi chúc bạn có một ngày thật tốt lành</B></P>
</center>
</body>
</html>