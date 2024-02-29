@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê bài viết
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
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
               <td>STT</td>
                </label>
              </th>
              <th>Tên Bài Viết</th>
              <th>hình ảnh bài viết</th>
              <th>Slug</th>
              <th>mô tả bài viết</th>
              <th>từ khóa bài viết</th>
              <th>danh mục bài viết</th>
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
            @foreach ($all_post as $key => $post) 
 {{-- lấy từ $all_post từ postcontroller --}}
            @php
              $i++;
            @endphp
              
            
            <tr>
              <td></td>
              <td>{{$i}}</td>
              <td>{{$post->post_title}}</td>
              <td><img src="public/upload/post/{{$post->post_image}}" heght="100" width="100"></td>
              <td>{{$post->post_slug}}</td>
              {{-- !! để định dạng html  --}}
              <td>{!! $post->post_desc!!}</td> 
              <td>{{$post->post_meta_keywords}}</td>
              <td>{{$post->cate_post->cate_post_name}}</td>
              <td>
                @if ($post->post_status==0)
                    hiện thị
                    @else
                    ẩn
                @endif
              </td>
              {{-- <td><span class="text-ellipsis">09.06.2002</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a> 
                  <a onclick="return confirm('Bạn có Chắc xóa bài viết Này Không ?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a> 
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
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            {!! $all_post->links() !!}

          </div>
        </div>
      </footer>
    </div>
  </div>
   
    @endsection