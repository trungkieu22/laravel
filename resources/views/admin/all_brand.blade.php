@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt Kê thương hiệu Sản Phẩm
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
              <th>STT</th>
                </label>
              </th>
              <th>Tên thương hiệu</th>
              <th>Brand Slug</th>
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
            @foreach ($all_brand as $key => $cate_pro)
            @php
              $i++;
            @endphp  
            
            <tr>
              <td></td>
              <td>{{$i}}</td>
              <td>{{$cate_pro->brand_name}}</td>
              <td>{{ $cate_pro->brand_slug }}</td>
              <td><span class="text-ellipsis">
                <?php
              if($cate_pro->brand_status==0){
                ?> 
                 <a href="{{URL::to('/active-brand-product/'.$cate_pro->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
                
              }else{
              ?>
                <a href="{{URL::to('/unactive-brand-product/'.$cate_pro->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
              }
              ?> 

              
              </span></td>
              {{-- <td><span class="text-ellipsis">09.06.2002</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-brand/'.$cate_pro->brand_id)}}" class="active" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i></a> 
                  <a onclick="return confirm('Bạn có Chắc xóa Danh Mục Này Không ?')" href="{{URL::to('/detele-brand/'.$cate_pro->brand_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a> 
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
              {!! $all_brand->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
   
    @endsection