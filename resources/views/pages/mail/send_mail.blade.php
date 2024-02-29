<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Gửi mail</title>
     <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
    }

    h1, h4 {
        text-align: center;
    }

    .container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        margin: auto;
        max-width: 600px;
    }

    .code {
        font-size: 2rem;
        text-align: center;
        margin-bottom: 15px;
    }

    .promo {
        font-weight: bold;
        color: #007bff;
    }

    .expire {
        font-size: 0.8rem;
        text-align: center;
    }
    body {
  background: pink;
}

.container {
  margin: 0 auto;
  width: 80%;
  text-align: center;
}

.note {
  color: blue;
  font-size: 1.5em;
}

.code {
  color: red;
  font-size: 1.5em;
}

.promo {
  font-weight: bold;
}

.expire {
  font-size: 1.2em;
  color: purple;
}
</style>

<div class="container">
    <!-- Nội dung email -->
</div>

<!-- Khai báo script bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
    integrity="sha384-MiCARWlv4U6y/qey+v9PihDvMi8RmBEx/DUsxOeVe3qvd5c8G5fCQ2P95N9QvBgl"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-cZSSxgCxhJpL5j3+5n5Qfp2335oxGhPbTPe3q/CO7QwKjOoV7EoBaPmfRcGSjCDz"
    crossorigin="anonymous"></script>

</head>
<body style="background: pink">
    <div class="container">
        <h3 class="note">Thông báo của shopchoubui về việc bạn được tặng voucher
         <b><i>   @if ($coupon['coupon_condition']==1)
            giảm {{$coupon['coupon_number']}} %
            @else
            giảm {{number_format($coupon['coupon_number'],0,',','.')}} VNĐ
            @endif
            cho tổng đơn hàng đặt mua với đơn hàng 2 tr trở lên</i></b>
        </h3>

        <h3 class="code"> mã code : <span class="promo">  {{$coupon['coupon_code']}}</span></h3>
        <h3 >với tổng số lượng mã giảm giá là : {{$coupon['coupon_time']}} mã xin quý khách nhanh tay sử dụng nó</h3> 
        <h3 class="expire"> Ngày bắt đầu : {{$coupon['start_day']}}  Ngày hết hạn sử dụng là ngày {{$coupon['end_day']}} </h3>
        <h3>cảm ơn quý khách đã tin dùng dịch vụ của chúng tôi chúc quý khách có một ngày thật là vui vẻ</h3>
    </div>
</body>
</html>