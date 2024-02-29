@extends('admin_layout')
@section('admin_content')
<div class="row">
    <p class="title_thongke">Thống kê doanh số đơn hàng</p>
    <form action="" autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Lọc theo :
             <select class="dashboard-filter form-control" >
                 <option>---->chọn<-----</option>
                 <option value="7ngay">7 ngày qua</option>
                 <option value="thangtruoc">tháng trước</option>
                 <option value="thangnay">Tháng này</option>
                 <option value="365ngayqua">365 ngày qua</option>
             </select>
            </p>
         </div>
        <div class="col-md-2">
            <p >Từ ngày<input type="text" id="datepicker" class="form-control"></p>
            <input type="button"    id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="lọc kết quả">

        </div>
        <p >Đến ngày<input type="text" id="datepicker2" class="form-control"></p>

        </div>
      
    </form>
   
    <div class="col-md-12">
        <div id="chart" style="height: 250px;"></div>

    </div>
    <div class="row">
        <style>
            table.table.table-bordered.table-dark {
    background: black;
}


        </style>
        <p class="title_thongke"> thống kê truy cập</p>
        <table class="table table-bordered table-dark">
            <thead>
                <th scope="col">Đang online</th>
                <th scope="col">Tổng tháng trước</th>
                <th scope="col">Tổng tháng này</th>
                <th scope="col">tổng một năm</th>
                <th scope="col">Tổng truy cập</th>


            </thead>
            <tbody>
                <td>{{$visitors_count}}</td>
                <td>{{$visitor_last_month_count}}</td>
                <td>{{$visitor_this_month_count}}</td>
                <td>{{$visitor_years_count}}</td>
                <td>{{$visitors_total}}</td>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <p class="title_thongke">Thống kê tổng sản phẩm đơn hàng</p>
            <div id="donut" class="morris-donut-inverse"></div>        </div>
    <div class="col-md-4 col-xs-4">
        <h3 class="style">Bài viết xem nhiều</h3>
        <ol class="list_view_style">
            @foreach ($post_views as $key => $post)
            <li>
                <a class="style" target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}}  <span style="color:red"> lượt xem : {{$post->post_views}}</span></a>
            </li>
                
            @endforeach
            
        </ol>
    </div>
    <div class="col-md-4  col-xs-4">
        <h3 class="style">Sản phẩm  xem nhiều</h3>
        <ol class="list_view">
            @foreach ($product_views as $key => $pro)
            <li>
                <a class="style" target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->product_slug)}}">{{$pro->product_name}}  <span style="color:red"> lượt xem : {{$pro->product_views}}</span></a>
            </li>
                
            @endforeach
            
        </ol>
    </div>
</div>
</div>
@endsection
<style>
    p.title_thongke{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
    input#datepicker2 {
    width: 17%;
}
input#btn-dashboard-filter {
    margin-left: 326px;
    margin-top: 10px;

}
ol.list_view {
    margin-right: -16px;
    color: black;
    background: floralwhite;
    margin-left: -5px;
}
ol.list_view_style {
    margin-right: -12px;
    color: black;
    background: floralwhite;
    margin-left: -55px;
}
a.style {
    color: blue;
}
h3.style {
    color: darkslategrey;
    margin-bottom: 16px;
}

</style>

