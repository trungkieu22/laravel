@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê bình luận
      </div>
      <div id="notify_comment"></div>
      <?php
      $message = session()->get('message');
      if($message){
          echo '<span class="chau">' .$message. '</span>';
          session()->put('message',null);
      }
      ?>
      <div class="table-responsive">
<table id="table_id" class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <label class="i-checks m-b-none">
               <td>STT</td>
                </label>
              </th>
              <th>Duyệt bình luận</th>
              <th>Tên người gửi</th>
              <th>bình luận</th>
              <th>ngày gửi</th>
              <th>sản phẩm</th>
              <th>quản lý</th>
            
              {{-- <th>Ngày Thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
            
          </thead>
          <tbody>
            @php
              $i  = 0;
            @endphp
            @foreach ($comment as $key => $comm)

            @php
              $i++;
            @endphp
              
            
            <tr>
              <td></td>
              <td>{{$i}}</td>
           <td>
            @if ($comm->comment_status==1)
            <input type="button" data-comment_id="{{$comm->comment_id}}" data-comment_status="0" id="{{$comm->comment_product_id}}" class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt" >
            @else
            <input type="button" data-comment_id="{{$comm->comment_id}}" data-comment_status="1" id="{{$comm->comment_product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt" >

            @endif
           </td>
              <td>{{$comm->comment_name}}</td>

              <td>{{ $comm->comment}}<br>
                <style>
                  ul.list_comment li {
    color: blue;
    list-style-type: decimal;
    margin: 12px 35px;
}
                </style>
          <ul class="list_comment">
            Trả lời : 
            @foreach ($comment_rep as $key => $comm_reply) 
            @if ($comm_reply->comment_parent_comment==$comm->comment_id)
            <li > {{$comm_reply->comment}}</li>

            @endif

            @endforeach
          </ul>

           @if ($comm->comment_status == 0)
           <textarea name="" id="" class="form-control reply_comment_{{$comm->comment_id}}" cols="30" rows="3"></textarea>
           <button class="btn btn-primary btn-xs btn-rep-comment" data-comment_id="{{$comm->comment_id}}" data-product_id="{{$comm->comment_product_id}}">Trả lời bình luận</button>
           </td>
               
           @endif
              <td>{{$comm->comment_date}}</td>
              @if ($comm->product)
              <td><a href="{{URL::to('/chi-tiet-san-pham/'.$comm->product->product_slug)}}" target="_blank">{{$comm->product->product_name}}</a></td>
              {{-- khi kích vào tjao một tap mới target="_blank" --}}
          @endif    
              <td>
                <a href="" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a> 
                  <a onclick="return confirm('Bạn có Chắc xóa bình luận Này Không ?')" href="{{URL::to('/detele-comment/'.$comm->comment_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a> 
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
      <footer class="panel-footer">
        {{-- <div class="col-sm-7 text-right text-center-xs">                
          {!! $all_product->links() !!}

        </div> --}}

      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>



   
    @endsection