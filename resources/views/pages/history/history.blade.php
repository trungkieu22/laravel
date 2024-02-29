@extends('layout')
@section('content_category')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê đơn hàng
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
              <th>mã đơn hàng</th>
              {{-- <th>Tên người đặt hàng</th> --}}
              <th>Ngày tháng đặt hàng</th>
              <th>ID người đặt hàng</th>
              <th>tình trạng đơn hàng</th>
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
              <td>{{$ord->order_code}}</td>
              <td>{{$ord->created_at}}</td>
              <td>{{$ord->customer_id}}</td>
              <td>@if($ord->order_status==1)
                <p class="text text-success">đơn hàng mới</p>
              @elseif ($ord->order_status==2)         
              <p class="text text-primary">đã xử lý đang giao hàng</p>
              @else
              <p class="text text-danger">đơn hàng đã hủy</p>
              @endif          
            </td>
              </span></td>
              {{-- <td><span class="text-ellipsis">09.06.2002</span></td> --}}
              <td>
                <!-- Trigger the modal with a button -->
                        {{-- nếu như khác 3 sẽ không xuất hiện níu này nưua --}}
                @if($ord->order_status!=3 && $ord->order_status!=2) 
<p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon">Hủy đơn hàng</button>
</p>
@endif
<!-- Modal -->
<div id="huydon" class="modal fade" role="dialog">
  <div class="modal-dialog">
<form>
  @csrf
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lý do hủy đơn hàng</h4>
      </div>
      <div class="modal-body">
        <p ><textarea rows="5" class="lydohuydon" placeholder="lý do hủy đơn hàng.....(bắt buộc)" required></textarea></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="{{$ord->order_code}}" onclick="huydonhang(this.id)" class="btn btn-success" >Gửi lý do</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </form>
  </div>
</div>
               <p><a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-eye text-success text-active"></i> xem đơn</a></p> <br>
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