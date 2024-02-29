@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Danh Mục Bài viết
      </div>
    
      <div class="table-responsive">
      
        <table id="example" class="table table-striped b-t b-light">
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
              <th>STT</th>
                </label>
              </th>
              <th>Tên danh mục</th>
              <th>mô tả danh mục</th>
              <th>Slug</th>
              <th>Hiển Thị</th>
              <th>Sửa xóa</th>
              {{-- <th>Ngày Thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 0;
            @endphp
            @foreach ($category_post as $key => $cate_post)
            @php
              $i++;
            @endphp  
            
            <tr>
              <td></td>
              <td>{{$i}}</td>
              <td>{{$cate_post->cate_post_name}}</td>
              <td>{{$cate_post->cate_post_desc}}</td>
              <td>{{$cate_post->cate_post_slug}}</td>
              <td>
                @if ($cate_post->cate_post_status ==0)
                 hiển thị
                    @else
                 ẩn   
                @endif
              </td>
              <td>
                <a href="{{URL::to('/edit-category-post/'.$cate_post->cate_post_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a> 
                  <a onclick="return confirm('Bạn có Chắc xóa Danh Mục Này Không ?')" href="{{URL::to('/detele-category-post/'.$cate_post->cate_post_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a> 
                  {{-- confirm xác nhận một việc nào đó --}}
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
        {{-- <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $category_post->links() !!}
            </ul>
          </div>
        </div> --}}
      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script>
   $(document).ready(function () {
      $('#example').DataTable();
      console.log('#example');
  });
     </script>
   
    @endsection