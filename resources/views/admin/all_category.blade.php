@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê Danh Mục Sản Phẩm
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
                  <th>thứ tự</th>
                </label>
              </th>
              <th>Tên danh mục</th>
              <th>Thuộc Danh mục</th>
              <th>slug</th>
              <th>Hiển Thị</th>
              <th>sửa xóa</th>
              {{-- <th>Ngày Thêm</th> --}}
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody id="category_order">
              
            @php
            $i = 0;
        @endphp
                    @foreach ($all_category as $key => $cate_pro)
               @php
               $i++;
           @endphp
                 <tr id="{{$cate_pro->category_id}}">
                  <td></td>
              <td><label class="i-checks m-b-none"><i>{{$i}}</i></label></td>
              <td>{{$cate_pro->category_name}}</td>
              <td>
               @if ($cate_pro->category_parent==0)
                <span style="color: rgb(0, 15, 128)"> danh mục cha</span>

               @else
               @foreach ($category_product as $key => $cate_sub_pro)
                 @if ($cate_sub_pro->category_id==$cate_pro->category_parent)
                   
              
               <span style="color: rgb(128, 117, 0)"> {{$cate_sub_pro->category_name}}</span>  
               @endif
               @endforeach
               @endif
              </td>
              <td>{{ $cate_pro->slug_category_product }}</td>

              <td><span class="text-ellipsis">
                <?php
              if($cate_pro->category_status==0){
                ?> 
                 <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
                
              }else{
              ?>
                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
              }
              ?> 

              
              </span></td>
              {{-- <td><span class="text-ellipsis">09.06.2002</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a> 
                  <a onclick="return confirm('Bạn có Chắc xóa Danh Mục Này Không ?')" href="{{URL::to('/detele-category/'.$cate_pro->category_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a> 
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
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!! $all_category->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
   
    @endsection