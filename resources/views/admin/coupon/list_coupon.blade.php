@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Mã giảm giá
      </div>
      <div class="row w3-res-tb">
          <div class="col-sm-5 m-b-xs">          
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
      
        <table class="table table-striped b-t b-light">
          <?php
          $message = session()->get('message');
          if($message){
              echo '<span class="chau">' .$message. '</span>';
              session()->put('message',null);
          }
          ?>
          <thead>
            <tr>
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                 <td>stt</td>             
                   </label>
              </th>

              
              <td>Tên Mã Giá</td>
              <td>Mã Giảm giá</td>
              <td>ngày bắt đầu</td>
              <td>ngày kết thúc</td>
               <td>Số lượng mã</td>
              <td>Điều Kiện</td>
              <td>Số Giảm</td>
              <td>tình trạng</td>
              <td>hết hạn</td>
              <td>Gửi Mã giảm giá</td>
              <td>Quản lý</td>
             
              {{-- <th>Ngày Thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>


            @php
              $i=0
            @endphp
            @foreach ($coupon as $key => $cou)
              @php
                $i++;
              @endphp
            
            <tr>
              <td></td>
                <td><i>{{$i}}</i></td>

              <td>{{$cou->coupon_name}}</td>
             
              <td>{{$cou->coupon_code}}</td>
              <td>{{$cou->coupon_date_start}}</td>
              <td>{{$cou->coupon_date_end}}</td>
              <td>{{$cou->coupon_time}}</td>
              <td><span class="text-ellipsis">
                <?php
              if($cou->coupon_condition==1){
                ?> 
                 Giảm theo%
              <?php
                
              }else{
              ?>
                Giảm theo VNĐ
              <?php
              }
              ?> 
              </span></td>
              <td><span class="text-ellipsis">
                <?php
              if($cou->coupon_condition==1){
                ?> 
                Giảm {{$cou->coupon_number}}%
                <?php
                
              }else{
              ?>
                Giảm {{$cou->coupon_number}} VNĐ
              <?php
              }
              ?> 
              </span></td>
              <td><span class="text-ellipsis">
                <?php
              if($cou->coupon_status==1){
                ?> 
                 <span style="color: green">Đã kích hoạt</span>
              <?php
                
              }else{
              ?>
                <span style="color:red">Đã Khóa</span>
              <?php
              }
              ?> 
              </span></td>
              <td>
                
                  @if($cou->coupon_date_end>=$today)

                  <span style="color: green">còn Hạn</span>
                  @else
                  <span style="color:red">hết hạn</span>

                @endif
              </td>
            <td>
              {{-- <p><a href="{{url('/send-coupon-vip',[
           
                'coupon_time'=> $cou->coupon_time,
                'coupon_condition'=>$cou->coupon_condition,
                'coupon_number'=>$cou->coupon_number,
                'coupon_code'=>$cou->coupon_code
                ])}}" class="btn btn-primary" style="margin: 5px">Gửi mã Giảm giá khách víp</a></p> --}}


              <p><a href="{{url('/send-coupon',[
 
                'coupon_time'=>$cou->coupon_time,
                'coupon_condition'=>$cou->coupon_condition,
                'coupon_number'=>$cou->coupon_number,
                'coupon_code'=>$cou->coupon_code
                ])}}"class="btn btn-primary" style="margin: 5px">Gửi mã Giảm giá khách víp</a></p>
            </td>
            <td>
              <a onclick="return confirm('Bạn có Chắc xóa mã giảm Này Không ?')" 
              href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i>Xóa mã</a> 
          </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <style>
        i.fa.fa-pencil-square-o.text-success.text-active {
    font-size: 26px;
}
i.fa.fa-times.text-danger.text {
    font-size: 26px;
}
        	span.chau {
    color: blueviolet;
    font-size: 17px;
    width: 100%;
    text-align: center;
}
        span.fa-thumb-styling.fa.fa-thumbs-down {
    font-size: 30px;
    color: darkred;
}
span.fa-thumb-styling.fa.fa-thumbs-up {
    font-size: 30px;
    color: rgba(0, 139, 76, 0.552);
}
      </style>
    
    </div>
  </div>
   
    @endsection