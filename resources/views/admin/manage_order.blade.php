@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê đơn hàng
      </div>
      <div class="row w3-res-tb">
   
      
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
              <th>thứ tự</th>
              <th>ID người đặt hàng</th>
              <th>mã đơn hàng</th>
              <th>Ngày tháng đặt hàng</th>
              <th>tình trạng đơn hàng</th>
              <th>Lý do hủy đơn hàng</th>
              <th>xem đơn</th>
              {{-- <th>Ngày Thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
     @php
         $i = 0;
     @endphp
            @foreach ($order as $key => $ord)
            @php
            $i++;
        @endphp
              <tr>
              <td><i>{{$i}}</i></label></td>
              <td>{{$ord->customer_id}}</td>
              <td>{{$ord->order_code}}</td>
              <td>{{$ord->created_at}}</td>
              <td>@if($ord->order_status==1)
                <p class="text text-success">đơn hàng mới</p>
              @elseif ($ord->order_status==2)         
              <p class="text text-warning">đã xử lý đang giao hàng</p>
              @else
              <p class="text text-danger">đơn hàng đã hủy</p>
              @endif          
            </td>
              </span></td>
              <td>
                @if($ord->order_destroy==3)
                {{$ord->order_destroy}}
                @endif
              </td>
              {{-- nếu như = 3 thì sẽ xuất hiện dòng tin hủy --}}
              {{-- <td><span class="text-ellipsis">09.06.2002</span></td> --}}
              <td>
                <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-eye text-success text-active"></i> xem đơn</a> <br>
                  <a onclick="return confirm('Nếu đơn hàng đã hủy thì bạn có muốn xóa đơn hàng này không ?')" href="{{URL::to('/detele-order/'.$ord->order_code)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i>xóa đơn</a> 
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <ul class="pagination pagination-sm m-t-none m-b-none">
        {!! $order->links() !!}
      </ul>
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