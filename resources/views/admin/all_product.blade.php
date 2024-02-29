@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê  Sản Phẩm
      </div>
      <?php
      $message = session()->get('message');
      if($message){
          echo '<span class="chau">' .$message. '</span>';
          session()->put('message',null);
      }
      ?>
      <div class="table-responsive">
  <table  class="table table-striped b-t b-light" id="table_id">
                  
        
          <thead>
            <tr>
              <th style="width:20px;">
                <label class="i-checks m-b-none">
               <td>STT</td>
                </label>
              </th>
              <th>Tên sản phẩm</th>
              <th>thư viện ảnh</th>
              <th>số lượng</th>
              <th>giá bán</th>
              <th>giá gốc</th>
              <th>Slug</th>
              <th>hình sản phẩm</th>
              <th>danh mục</th>
              <th>thương hiệu</th>
              <th>Hiển Thị</th>
              <th>Sửa | xóa</th>
              {{-- <th>Ngày Thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
            
          </thead>
          <tbody>
            @php
              $i  = 0;
            @endphp
            @foreach ($all_product as $key => $pro)

            @php
              $i++;
            @endphp
              
            
            <tr>
              <td></td>
              <td>{{$i}}</td>
              <td>{{$pro->product_name}}</td>
              <td><a href="{{url('add-gallery/'.$pro->product_id)}}">Thêm Thư Viện ảnh</a></td>
              <td>{{$pro->product_quantity}}</td>
              <td>{{number_format((float)$pro->product_price).' '.'VNĐ'}}</td>
              <td>{{number_format((float)$pro->product_cost).' '.'VNĐ'}}</td>
              <td>{{ $pro->product_slug }}</td>
              <td><img src="public/upload/product/{{$pro->product_image}}" heght="100" width="100"></td>
              <td>{{$pro->category_name}}</td>
              <td>{{$pro->Brand_id}}</td>
    
              <td><span class="text-ellipsis">
                <?php
              if($pro->product_status==0){
                ?> 
                 <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
                
              }else{
              ?>
                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
              }
              ?> 

              
              </span></td>
              {{-- <td><span class="text-ellipsis">09.06.2002</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a> 
                  <a onclick="return confirm('Bạn có Chắc xóa Sản Phẩm Này Không ?')" href="{{URL::to('/detele-product/'.$pro->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a> 
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