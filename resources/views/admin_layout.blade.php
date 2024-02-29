<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Trang Đăng Nhập Dành Cho ADMIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<meta name="csrf_token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>

{{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{url('/trang-chu')}}" class="logo">
        SHOP 
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    {{-- <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success">8</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class="">You have 8 pending tasks</p>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>25% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Product Delivery</h5>
                                <p>45% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Payment collection</h5>
                                <p>87% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>33% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>

                <li class="external">
                    <a href="#">See All Tasks</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-important">4</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">You have 4 Mails</p>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hello, this is an example msg.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/1.png"></span>
                                <span class="subject">
                                <span class="from">Jane Doe</span>
                                <span class="time">2 min ago</span>
                                </span>
                                <span class="message">
                                    Nice admin template
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                <span class="subject">
                                <span class="from">Tasi sam</span>
                                <span class="time">2 days ago</span>
                                </span>
                                <span class="message">
                                    This is an example msg.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/2.png"></span>
                                <span class="subject">
                                <span class="from">Mr. Perfect</span>
                                <span class="time">2 hour ago</span>
                                </span>
                                <span class="message">
                                    Hi there, its a test
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">See all messages</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 overloaded.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul> --}}
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/2.png')}}">
                <span class="username">
    <?php
    $name = session()->get('admin_name');
    if($name){
        echo $name;
       
    }
    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng Xuất </a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{url::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>
                <li>
                    <a class="" href="">
                        <i class="fa fa-book"></i>
                        <span>Thông Tin Liên Hệ</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url::to('/information')}}">Cập Nhật Thông tin liên hệ</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-slider')}}">Liệt kê Slider</a></li>
						<li><a href="{{URL::to('/add-slider')}}">Thêm Slider</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục Bài Viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-post')}}">Thêm Danh mục Bài viết</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài Viết</a></li>
            
                    </ul>
                </li>
        
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/all-category')}}">Liệt kê danh mục sản phẩm</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương Hiệu Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand')}}">Thêm thương sản phẩm</a></li>
						<li><a href="{{URL::to('/all-brand')}}">Liệt kê thương hiệu sản phẩm</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Quản Lý Vận chuyển</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span> Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản Lý Đơn Hàng</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã Giảm Giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm Mã Giảm Giá</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Liệt Kê Mã Giảm giá</a></li>
            
                    </ul>
                </li>
            
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình Luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài Viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Thêm Bài Viết</a></li>
						<li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
            
                    </ul>
                </li>
              
            </ul>   
		         </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		 @yield('admin_content')

   </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>


<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>





<!--list đối tác-->
<script>
    // thêm nút đối tác
    function delete_doitac(id){
        $.ajax({
      url : '{{url('/delete-doitac')}}',
      method : "GET",
    data: {id : id},
      success :function(data){
        
        list_doitac();

    }

    }); 
    }
    list_doitac();
    function list_doitac() {
        $.ajax({
      url : '{{url('/list-doitac')}}',
      method : "GET",
    
      success :function(data){
        $('#list_doitac').html(data);

    }


    });   
    
    }
    $('.add-doitac').click(function(){
         var name  = $('#name_doitac').val();
         var link  = $('#link_doitac').val();
         var image  = $('#image_doitac')[0].files[0];
         var form_data = new FormData();

         form_data.append('file', image);
         form_data.append('name', name);
         form_data.append('link', link);


        $.ajax({
      url : '{{url('/add-doitac')}}',
      method : 'post',
      headers : {
            'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
        },
      contentType:false,
      cache:false,
      processData:false,
     
      data : form_data,
      success :function(data){
          alert('thêm đối tác thành công');
          list_doitac();

    }

    });  

    })
</script>
<!-- end list đối tác-->




















<script>
    //thêm nút mạng xã hộ
    list_nut();
    function delete_icons(id){
        $.ajax({
      url : '{{url('/delete-icons')}}',
      method : "GET",
    data: {id : id},
      success :function(data){
        
        list_nut();
        list_doitac();
    }

    }); 
    }
    function list_nut() {
        $.ajax({
      url : '{{url('/list-nut')}}',
      method : "GET",
    
      success :function(data){
        $('#list_nut').html(data);

    }


    });   
    
    }
    $('.add-nut').click(function(){
         var name  = $('#name').val();
         var link  = $('#link').val();
         var image  = $('#image_nut')[0].files[0];
         var form_data = new FormData();

         form_data.append('file', image);
         form_data.append('name', name);
         form_data.append('link', link);


        $.ajax({
      url : '{{url('/add-nut')}}',
      method : 'post',
      headers : {
            'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
        },
      contentType:false,
      cache:false,
      processData:false,
     
      data : form_data,
      success :function(data){
          alert('thêm nút thành công');
          list_nut();

    }

    });  

    })
</script>

<script type="text/javascript">
    $('.comment_duyet_btn').click(function(){

        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        if(comment_status==0){
            var alert = ('Thay đổi thành duyệt thành công');
        }else{
            var alert = ('Thay đổi không duyệt thành công');

        }

        $.ajax({
      url : '{{url('/duyet-comment')}}',
      method : 'post',
      data : {comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
      headers : {
            'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
        },
      success :function(data){
        $('#notify_comment').html('<span style="color:red" class="text text-alert">'+alert+'</span>')

    }

    });
      
    });

    $('.btn-rep-comment').click(function(){
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();
        var comment_product_id = $(this).data('product_id');
        // alert(comment_id);

        //      alert(comment);
        //      alert(comment_product_id);
             

        $.ajax({
      url : '{{url('/traloi-comment')}}',
      method : 'post',
      data : {comment_id:comment_id,comment:comment,comment_product_id:comment_product_id},
      headers : {
            'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
        },
      success :function(data){
         $('.reply_comment_'+comment_id).val('');
        $('#notify_comment').html('<span style="color:green" class="text text-alert">Trả lời bình luận thành công</span>')

    }

    });
      
    });
</script>


<script>
    $('.price_format').simpleMoneyFormat();

</script>
<script>
    $(document).ready(function() {
        var colorDanger = "#FF1744";
Morris.Donut({
  element: 'donut',
  resize: true,
  colors: [
    '#eb4f34',
    '#8ceb34',
    '#34a2eb',
    '#d334eb',
  ],
  //labelColor:"#cccccc", // text color
  //backgroundColor: '#333333', // border color
  data: [
    {label:"Sản Phẩm", value: {{$portorder}} }, 
    {label:"Bài viết", value:{{ $portt}} },
    {label:"Đơn hàng", value:{{$orderr}} },
    {label:"Khách hàng", value:{{$customerr}} },
  ]
});



    });

</script>


<script type="text/javascript">
$(document).ready(function() {
    chart60dayorder();
  var chart = new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'chart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
   
    lineColors:['#819C79','#fc8710','#FF6541','#A4ADD3','#766B56'],
    parseTime:false,
    hideHover:'auto',

    // The name of the data record attribute that contains x-values.
    xkey: 'period',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['order', 'sales','profit','quantity'],
    behaveLikeLine:true,
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
  });
   function chart60dayorder(){
    var _token = $('input[name="_token"]').val();


        $.ajax({
      url : '{{url('/days-order')}}',
      method : 'post',
      dataType : 'json',
      data : {_token:_token},
      success :function(data){
        chart.setData(data);

    }

    });
    
   }
        $('#btn-dashboard-filter').click(function() {    
            
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
  
        $.ajax({
      url : '{{url('/filter-by-date')}}',
      method : 'post',
      dataType : 'json',
      data : {from_date:from_date,to_date:to_date,_token:_token},
      success :function(data){
        chart.setData(data);

    }

    });

        });
        $('.dashboard-filter').change(function(){

            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            // alert(dashboard_value);
            $.ajax({
      url : '{{url('/dashboard-filter')}}',
      method : 'post',
      dataType : 'json',
      data : {dashboard_value:dashboard_value,_token:_token},

      success :function(data){

        chart.setData(data);

    }

    });


        });
    });
</script>

<script>
    $(document).ready(function() {
  $('#category_order').sortable({
    placeholder:'ui-state-highlight',
    update :function(event, ui) {
        var page_id_array =new array();
        var _token = $('input[name="_token"]').val();
        $('#category_order tr').each(function() {
            page_id_array.push($(this).attr('id'));

        });
        $.ajax({
      url : '{{url('/arrange')}}',
      method : 'post',
      data : {page_id_array:page_id_array,_token:_token},
      success :function(data){
 alert(data);
    }

    });


    }
  });

    });
</script>


<script type="text/javascript" >
 $(document).ready(function(){
   load_gallery();
    function load_gallery(){
        var pro_id = $('.pro_id').val();
        var _token = $('input[name="_token"]').val();
    $.ajax({
      url : '{{url('/select-gallery')}}',
      method : 'post',
      data : {pro_id:pro_id,_token:_token},
      success :function(data){
        $('#gallery_load').html(data);
      }

    });


    }
    $('#file').change(function(){
    var error = '';
    var files = $('#file')[0].files;

    if(files.length > 5){
        error += '<p>Bạn chỉ được chọn tối đa 5 tấm ảnh.</p>';
    } else if(files.length === 0){
        error += '<p>Bạn không được bỏ trống ảnh.</p>';
    } else if(files[0].size > 2000000 ){
        error += '<p>File ảnh không được lớn hơn 2MB.</p>';
    }
  
    if(error === ''){
        // Do something if there are no errors
    } else {
        $('#file').val('');
        $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
        return false;
    }
});
 

$(document).on('blur','.edit_gal_name', function(){
    var gal_id = $(this).data('gal_id');
    var gal_text = $(this).text();
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url : '{{url('/update-gallery-name')}}',
        method : 'post',
        data : {gal_id:gal_id,_token:_token,gal_text:gal_text},
        success:function(data){
            load_gallery();
            $('#error_gallery').html('<span style="color:green">sửa tên ảnh thành công</span>' );
        },
    });
});
$(document).on('click','.delete-gallery', function(){
    var gal_id = $(this).data('gal_id');
    var _token = $('input[name="_token"]').val();
 if(confirm('Bạn có muốn xóa hình ảnh này không?')){
    $.ajax({
        url : '{{url('/deleted-gallery')}}',
        method : 'post',
        data : {gal_id:gal_id,_token:_token},
        success:function(data){
            load_gallery();
            $('#error_gallery').html('<span style="color:green">xóa hình ảnh thành công</span>' );
        }
    });
}
});
$(document).on('change','.file_image', function(){
    var gal_id = $(this).data('gal_id');
    var image = document.getElementById('file-'+gal_id).files[0];
 var form_data = new FormData();
 form_data.append('file',document.getElementById('file-'+gal_id).files[0]);  
 form_data.append('gal_id',gal_id);
    $.ajax({
        url : '{{url('/update-gallery')}}',
        method : 'post',
        headers : {
            'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
        },
        data : form_data,
        contentType : false,
        cache : false,
        processData : false,
        success:function(data){

            load_gallery();
            $('#error_gallery').html('<span style="color:green">cập nhật hình ảnh thành công</span>' );
        }
    });

});


 });

</script>


<script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;  
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        } 
</script>
<script type="text/javascript">
    $(document).ready(function(){ 




        
        fetch_delivery();
        
  function fetch_delivery(){
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url : '{{url('/select-feeship')}}',
        method: 'POST',
        data:{_token:_token},
         
        success:function(data){
         $('#load_delivery').html(data);
        }
    });


  }

  $(document).on('blur','.fee_feeship_edit',function(){

    var feeship_id = $(this).data('feeship_id');         
          var fee_value = $(this).text();
           var _token = $('input[name="_token"]').val();

           $.ajax({
        url : '{{url('/update-delivery')}}',
        method: 'POST',
        data:{fee_value:fee_value,_token:_token,feeship_id:feeship_id,},
        success:function(data){
            fetch_delivery();       
         }
    });

  });



    $('.add_delivery').click(function(){

          var city = $('.city').val();         
          var province = $('.province').val();         
          var wards = $('.wards').val();         
          var fee_ship = $('.fee_ship').val();
           var _token = $('input[name="_token"]').val();

    
  
    $.ajax({
        url : '{{url('/insert-delivery')}}',
        method: 'POST',
        data:{city:city,province:province,_token:_token,wards:wards,fee_ship:fee_ship,},
        success:function(data){
            fetch_delivery();        }
    });
          
        });




        $('.choose').on('change',function(){
    var action = $(this).attr('id');
    var ma_id = $(this).val();
    var _token = $('input[name="_token"]').val();
    var result = '';
  
    

    if(action=='city'){
        result = 'province';
    }else{
        result = 'wards';
    }
    $.ajax({
        url : '{{url('/select-delivery')}}',
        method: 'POST',
        data:{action:action,ma_id:ma_id,_token:_token},
        success:function(data){
           $('#'+result).html(data);     
        }
    });
});
    })

</script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js"')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
<script type="text/javascript">
    $(function () {
      $("#start_coupon").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "dd/mm/yy",
        dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
        duration: "slow",
       });   
       $("#end_coupon").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "dd/mm/yy",
        dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
        duration: "slow",
       }); 
    });
    </script>   
<script type="text/javascript">
    $(function () {
      $("#datepicker").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
        duration: "slow",
       });   
       $("#datepicker2").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
        duration: "slow",
       }); 
    });
    </script>   

  <script type="text/javascript">
    $.validate({      
    });
</script>
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url : '{{url('/update-qty')}}',

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                    alert('Cập nhật số lượng thành công');
                 
                   location.reload();
                    
              
                    

                }
        });

    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
      

        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
                            }
                });
            
        }

    });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script>
 $(document)
  .ready(function () {
    $('#table_id')
      .DataTable();
  });
    </script>

</body>
</html>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://canvas.com/assets/script/jquery.canvasjs.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</body>
</html>
