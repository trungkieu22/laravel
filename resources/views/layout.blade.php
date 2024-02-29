<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{-- seo --}}
   
	<meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}">
    <meta name="author" content="">
    <title>{{$meta_title}}</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="shortcut icon" type="image/png" href="{{asset('/public/frontend/images/iphone.png')}}"/>
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('/public/frontend/js/jquery.min.js')}}" rel="stylesheet">
	<link href="{{asset('/public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('/public/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link href="{{asset('/public/frontend/css/lightslider.min.css')}}" rel="stylesheet">
	<link href="{{asset('/public/frontend/css/prettify.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lg-fullscreen.min.css" integrity="sha512-JlgW3xkdBcsdFiSfFk5Cfj3sTgo3hA63/lPmZ4SXJegICSLcH43BuwDNlC9fqoUy2h3Tma8Eo48xlZ5XMjM+aQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('public/frontend/css/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('public/frontend/css/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('public/frontend/css/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('public/frontend/css/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->
<style>
	.container {
    width: 90%;
}
</style>
<body>
	
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0387798972</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i>Trungkieu2002@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
							<div class="btn style">
								<div class="btn__indicator">
								  <div class="btn__icon-container">
									<i class="btn__icon fa-solid"></i>
								  </div>
								</div>
							  </div>
							
							<style>
							:root{
							  /* COLORS */
							  --color: #9176FF;
							  --dark-color: #2b2b2b;
							  --dark-icon-color: #fff;
							  --light-color: #f7f7f7;
							  --light-icon-color: #FFDE59;
							}
							
							/* ------------ BASE ------------ */
							
							
							/* -------------- BUTTON -------------- */
							
							
							.btn__indicator{
							  background-color: #fff;
						
							
							  position: absolute;
							
							  box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
							
							  transition: transform .3s ease;
							}
							
							.btn__icon-container{
							
							  display: flex;
							  justify-content: center;
							  align-items: center;
							  margin: -3px;

							}
							
							.btn__icon{
							  color: var(--color);
							}
							
							/* -------------- ANIMATION ------------ */
							.btn__icon.animated{
							  animation: spin 0.5s;
							}
							
							@keyframes spin{
							  to {
								transform: rotate(360deg);
							  }
							}
							
							/* -------------- DARKMODE -------------- */
							body.darkmode{
							  background-color: var(--dark-color);
							}
							
							.darkmode .btn{
							  box-shadow: inset 0 8px 60px rgba(0,0,0, .3),
										  inset 8px 0 8px rgba(0,0,0, .3),
										  inset 0 -4px 4px rgba(0,0,0, .3);
							}
							
							.darkmode .btn__indicator{
							  transform: translateX(7em);
							  background-color: var(--dark-color);
							  box-shadow: 0 8px 40px rgba(0,0,0, .3);
							}
							
							.darkmode .btn__icon{
							  color: var(--dark-icon-color);
							}
							.btn.style {
    width: 121px;
    margin: 7px 11px;
    margin-left: -129px;
    background: beige;
    height: 21px;
}
							</style>
							
							
							  <script>
							const body = document.querySelector('body');
							const btn = document.querySelector('.btn');
							const icon = document.querySelector('.btn__icon');
							
							//to save the dark mode use the object "local storage".
							
							//function that stores the value true if the dark mode is activated or false if it's not.
							function store(value){
							  localStorage.setItem('darkmode', value);
							}
							
							//function that indicates if the "darkmode" property exists. It loads the page as we had left it.
							function load(){
							  const darkmode = localStorage.getItem('darkmode');
							
							  //if the dark mode was never activated
							  if(!darkmode){
								store(false);
								icon.classList.add('fa-sun');
							  } else if( darkmode == 'true'){ //if the dark mode is activated
								body.classList.add('darkmode');
								icon.classList.add('fa-moon');
							  } else if(darkmode == 'false'){ //if the dark mode exists but is disabled
								icon.classList.add('fa-sun');
							  }
							}
							
							
							load();
							
							btn.addEventListener('click', () => {
							
							  body.classList.toggle('darkmode');
							  icon.classList.add('animated');
							
							  //save true or false
							  store(body.classList.contains('darkmode'));
							
							  if(body.classList.contains('darkmode')){
								icon.classList.remove('fa-sun');
								icon.classList.add('fa-moon');
							  }else{
								icon.classList.remove('fa-moon');
								icon.classList.add('fa-sun');
							  }
							
							  setTimeout( () => {
								icon.classList.remove('animated');
							  }, 500)
							})
							</script>
							
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
                        @foreach ($icons as $key => $ico)
						<li><a target="_blank" title="{{$ico->name}}" href="{{$ico->link}}">
							<img  alt="{{$ico->name}}" style="margin:6px" height="25px" width="25px" src="{{asset('public/upload/icons/'.$ico->image)}}">
						</a></li>

						@endforeach							
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle" id=""><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href=""><img src="https://www.coolmate.me/images/logo-coolmate-v2.svg" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									@lang('language.language')
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{url('lang/vi')}}">Tiếng Việt</a></li>
									<li><a href="{{url('lang/en')}}">Tiếng anh</a></li>
									<li><a href="{{url('lang/cn')}}">Tiếng trung</a></li>
									<li><a href="{{url('lang/jp')}}">Tiếng Nhật</a></li>
								</ul>
							</div>	
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i>@lang('language.favourite')</a></li>
								<?php 
								$customer_id = session()->get('customer_id');
								if($customer_id!=null){
							   
							   ?>
								<li><a  href="{{URL::to('/checkout')}}"><i class="fa-solid fa-money-bill"></i> @lang('language.pay')</a></li>
								<?php 
								
								}else {
								   ?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa-solid fa-money-bill"></i> @lang('language.pay') </a></li>

								   <?php
								}
								?>
								

							<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> 
									@lang('language.cart')
									<span class="show_cartt"></span>
								</a></li> 



								<?php 
								$customer_id = session()->get('customer_id');
								if($customer_id!=null){ // nếu có đăng nhập thì hiện thị lịch sử mua hàng còn hông thì thôi
							   
							   ?>
							   <li><a href="{{URL::to('/history')}}"><i class="fa-sharp fa-solid fa-truck-fast"></i>@lang('language.menu history')</a> 
							   </li>
								<?php 
								}
								?>
								<?php 
								 $customer_id = session()->get('customer_id');
								 if($customer_id!=null){
								
								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa-solid fa-user"></i> @lang('language.logout')</a>
									<img width="20px" src="{{session()->get('customer_picture')}}"> {{session()->get('customer_name')}}
								</li>
                                 <?php 
								 
								 }else {
									?>
						      <li><a href="{{URL::to('/login-checkout')}}"><i class="fa-solid fa-user"></i> @lang('language.login')</a></li>

									<?php
								 }
								 ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom" id="navbar"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active"><i class="fa-sharp fa-solid fa-shop"></i> @lang('language.home')</a></li>
								<li class="dropdown"><a href="#"><i class="fa-sharp fa-solid fa-bag-shopping"></i> @lang('language.product')<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key => $danhmuc)
                                      @if($danhmuc->category_parent == 0)

                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$danhmuc->slug_category_product)}}">{{$danhmuc->category_name}}</a></li>
										{{-- <a href="{{ route('show.slug', ['slug' => $danhmuc->slug_category_product]) }}">
											{{ $danhmuc->category_name }}
										</a> --}}
										@foreach($category as $key => $cate_sub)
										@if ($cate_sub->category_parent == $danhmuc->category_id)
                                           <ul>
											<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}}</a></li>
											{{-- <li><a href="{{route('show.slug' ,['slug' => $cate_sub->slug_category_product])}}">{{$cate_sub->category_name}}</a></li> --}}

										   </ul>
										@endif

                                        @endforeach

                                       @endif
                                        @endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#"><i class="fa-solid fa-newspaper"></i> @lang('language.blog')<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
                                        @foreach($category_post as $key => $danhmucbaiviet)
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                  
                                </li> 
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> @lang('language.cart') 
									<span class="show_cart"></span></a></li>
								<li><a href="{{url::to('/lien-he')}}"><i class="fa-brands fa-blogger-b"></i> @lang('language.contact')</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{url::to('/tim-kiem')}}" autocomplete="off" method="post" style="width:100%">
							@csrf
						<div class="search_box pull-right">
							<input type="text" style="width:100%;" name="keywords_submit" id="keywords" placeholder="tìm kiếm sản phẩm"/>
							<div id="search_ajax"></div>
							{{-- <input type="submit" style="margin:top;color:#666" name="search_items" class="btn btn-primary btn--xl" value=" tìm kiếm"> --}}
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
{{-- slider	 --}}
@yield('slider')

{{-- slider	 --}}
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					
					@yield('content_category')
					
				</div>
				
				@yield('sidebar')
				
				<div class="col-sm-9 padding-right">
					
					@yield('content')
					
				</div>
			<!-- đối tác-->
			<div class="col-sm-12">
		<section class="blog_section">
            <div class="container">
                <div class="blog_content">
					<h2 class="doitac"> Đối Tác Của Chúng Tôi</h2>

                    <div class="owl-carousel owl-theme">
						@foreach ($icons_doitac as $key => $doitac)

                        <div class="blog_item">
                            <div class="blog_image">
								<a target="_blank" href="{{$doitac->link}}"><img class="img-fluid" src="{{asset('/public/upload/icons/'.$doitac->image)}}" alt="Đối tác của eshopper">
								</a>
                                <span><i class="icon ion-md-create"></i></span>
                            </div>
                            <div class="blog_details">
                                <div class="blog_title">
                                    <h5><a target="_blank" href="{{$doitac->link}}">{{$doitac->name}}</a></h5>
								</div>
                                {{-- <a href="{{$doitac->link}}">Xem chi tiết đối tác<i class="icofont-long-arrow-right"></i></a> --}}
                            </div>
                        </div>                        
						@endforeach
            
                   
                    </div>
                </div>
            </div>
        </section>
				
		
			</div>
			<!-- đối tác-->
			</div>
		</div>
	</section>
	<section>
		<div class="col-sm-12">
					
			
		</div>
	</section>


	
	<footer id="footer"><!--Footer-->
		{{-- <div class="footer-top">
			<div class="container">
				<div class="row">
				
					<div class="col-sm-7">
					</div>
				</div>
			</div>
		</div> --}}
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					@foreach ($contact_footer as $key => $logo)

					<div class="col-sm-2">
						<div class="single-widget">
							<p><img width="91%" src="{{asset('/public/upload/contact/'.$logo->info_image)}}"></p>		
						<p>{{$logo->slogan_logo}}</p>
						</div>
					</div>
					@endforeach
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Dịch vụ chúng tôi</h2>
							<ul class="nav nav-pills nav-stacked">
								@foreach ($post_footer as $key => $post_foot)
								<li><a href="{{url('bai-viet/'.$post_foot->post_slug)}}">{{$post_foot->post_title}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					@foreach ($contact_footer as $key => $contact_foo)
						
						
					<div class="col-sm-3">

						<div class="single-widget">
							<h2>thông tin địa chỉ shop</h2>
							<div class="information_footer">
								{!!$contact_foo->info_contact!!}
							</div>
							
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="single-widget">
							<h2>Fanpage</h2>
							{!!$contact_foo->info_fanpage!!}

						</div>
					</div>
					@endforeach

					{{-- <div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Đăng ký email</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Điền email của bạn" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>cập nhật mới nhất <br />thông tin khuyến mãi</p>
							</form>
						</div>
					</div> --}}
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2023 E-SHOPPER from with love chou bui.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="">Đàm văn châu</a></span></p>
				</div>
			</div>
		</div>
		

		<!-- Messenger Plugin chat Code -->
		<div id="fb-root"></div>

		<!-- Your Plugin chat code -->
		<div id="fb-customer-chat" class="fb-customerchat">
		</div>
	
		<script>
		  var chatbox = document.getElementById('fb-customer-chat');
		  chatbox.setAttribute("page_id", "111741378526916");
		  chatbox.setAttribute("attribution", "biz_inbox");
		</script>
	
		<!-- Your SDK code -->
		<script>
		  window.fbAsyncInit = function() {
			FB.init({
			  xfbml            : true,
			  version          : 'v16.0'
			});
		  };
	
		  (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));
		</script>
	</footer><!--/Footer-->
	

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('/public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('/public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('/public/frontend/js/jquery.sharrre.min.js')}}"></script>
    <script src="{{asset('/public/frontend/js/owl.carousel.js')}}"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>


<script>
	$(document).ready(function() {
  // show số lượng khi mua
  show_cart();
		function show_cart() {
			$.ajax({
        url : '{{url('/show-cart')}}',
        method: 'GET',
	        success:function(data){
		 $('.show_cart').html(data);
        }
    });


		}
	});
</script>

<script>
	window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar"); // đưa vài id mình muốn

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>



<style>
	.header-bottom {
    padding-bottom: 12px;
    padding-top: 30px;
    z-index: 9999;
    background: #0f172a;
}
.productinfo.text-center {
    border-style: ridge;
}
</style>



<script>

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    nav:true,
    autoplay:true,   
    smartSpeed: 3000, 
    autoplayTimeout:7000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
</script>

	<script>
		function delete_compare(id){
		if(localStorage.getItem('compare') !== null){
			var data = JSON.parse(localStorage.getItem('compare'));
             var index = data.findIndex(item => item.id ===id); // so sánh nghiêm thì 3 bằng
			 data.splice(index, 1);
			 localStorage.setItem('compare',JSON.stringify(data));
			 document.getElementById('row_compare'+id).remove();
		}

	}


		// đưa ra trang chính so sánh
		viewed_compare();
				function viewed_compare(){
    if(localStorage.getItem('compare') !== null){
        var data = JSON.parse(localStorage.getItem('compare'));
 
        for(i = 0; i < data.length; i++){
			var name = data[i].name;
			var price = data[i].price;
			var image = data[i].image;
			var url = data[i].url;
			var id = data[i].id;
			$("#row_compare").find('tbody').append(`
	                             	<tr id="row_compare`+id+`">
		                                <td>`+name+`</td>
                                        <td>`+price+`</td>
										<td><img width="150px" src="`+image+`"></td>
                                        <td><a href="`+url+`">xem thông tin </a></td>
                                        <td><a class="btn btn-danger" style="cursor:pointer" onclick="delete_compare(`+id+`)">xóa</a></td>
                                      </tr>
		`);
        }
    }
}
		//so sánh sản phẩm
		add_compare();
		function add_compare(product_id){ 
			document.getElementById('title-compare').innerText = 'Chỉ cho phép so sánh tối đa 4 sản phẩm';
// Lấy thông tin sản phẩm từ các trường thông tin tương ứng
var id = product_id;
var name = document.getElementById('wishlist_name'+id).value;
var price = document.getElementById('wishlist_price'+id).value;
var image = document.getElementById('wishlist_image'+id).src;
var url= document.getElementById('wishlist_url'+id).href;

// Tạo một đối tượng mới chứa thông tin sản phẩm
var newItem = {
    'url' : url,
    'name' : name,
    'price' : price,
    'image' : image,
    'id' : id
};

// Kiểm tra xem đã có dữ liệu trong bộ nhớ địa phương chưa
if (localStorage.getItem('compare') == null) {
    localStorage.setItem('compare', '[]');
}

// Lấy dữ liệu cũ và chuyển đổi sang định dạng JSON
var old_data = JSON.parse(localStorage.getItem('compare'));

// Tìm các sản phẩm đã được yêu thích trong mảng dữ liệu cũ
var matches = old_data.filter(function(obj){
    return obj.id == id;
});

// Nếu sản phẩm đã được yêu thích thì thông báo cho người dùng
// Nếu chưa thì thêm mới đối tượng sản phẩm vào mảng dữ liệu cũ
if (matches.length) {
} else {
	if(old_data.length<=3){ //dứi hạn 4 sản phẩm
		old_data.push(newItem);
		$("#row_compare").find('tbody').append(`
		                                 <tr id="row_compare`+id+`">
		                                <td>`+newItem.name+`</td>
                                        <td>`+newItem.price+`</td>
										<td><img width="150px" src="`+newItem.image+`"></td>
                                        <td><a href="`+newItem.url+`">xem thông tin </a></td>
                                        <td><a class="btn btn-danger" style="cursor:pointer" onclick="delete_compare(`+id+`)">Xóa</a></td>
                                      </tr>
		
		
		`);
		// `` dấu này giúp mình có thể di chuyển dễ hơn


	}
}
// Chuyển đổi đối tượng dữ liệu thành chuỗi JSON và lưu vào bộ nhớ địa phương
localStorage.setItem('compare', JSON.stringify(old_data));

			$('#sosanh').modal();

}

	</script>

	<script>
		// sản phẩm xem nhanh
		$('.xemnhanh').click(function(){
			var product_id = $(this).data('id_product');
			var _token = $('input[name="_token"]').val();
			$.ajax({
        url : '{{url('/quickview')}}',
        method: 'POST',
		dataType: "json",
        data:{product_id:product_id,_token:_token},
        success:function(data){
           $('#product_quickview_title').html(data.product_name);     
           $('#product_quickview_id').html(data.product_id);     
           $('#product_quickview_price').html(data.product_price);     
           $('#product_quickview_image').html(data.product_image);     
           $('#product_quickview_gallery').html(data.product_gallery);      
           $('#product_quickview_desc').html(data.product_desc);     
           $('#product_quickview_content').html(data.product_content);      
           $('#product_quickview_value').html(data.product_quickview_value);      
           $('#product_quickview_button').html(data.product_button);      
        }
    });



		});
	</script>

<script>
	//đưa ra trang chính sản phẩm đã xem
		function viewed(){
    if(localStorage.getItem('viewed') !== null){
        var data = JSON.parse(localStorage.getItem('viewed'));
 
   data.reverse();
		document.getElementById('row_viewed').style.overflow = 'scroll';
		document.getElementById('row_viewed').style.height = '500px';
        
        for(i = 0; i < data.length; i++){
			var name = data[i].name;
			var price = data[i].price;
			var image = data[i].image;
			var url = data[i].url;
            $("#row_viewed").append('<div class="row" style="margin:10px 0 "<div class="col-md-4"><img class="style" src="'+image+'"width:79px;height: 87px;"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#fe980f">'+price+'</p><a class="yeuthich" href="'+url+'">Xem ngay</a></div>'
			);
        }
    }
}
viewed();
	//sản phẩm đã xem
  product_viewed();
	function product_viewed(){
		// Lấy thông tin sản phẩm từ các trường thông tin tương ứng
		var id_product = $('#product_viewed_id').val();

		if(id_product != undefined){
			var id = id_product;
		var name = document.getElementById('product_productname'+id).value;
		var price = document.getElementById('product_productprice'+id).value;
		var image = document.getElementById('product_image'+id).value;
		var url= document.getElementById('product_producturl'+id).value;
		
		// Tạo một đối tượng mới chứa thông tin sản phẩm
		var newItem = {
			'url' : url,
			'name' : name,
			'price' : price,
			'image' : image,
			'id' : id
		};
		
		// Kiểm tra xem đã có dữ liệu trong bộ nhớ địa phương chưa
		if (localStorage.getItem('viewed') == null) {
			localStorage.setItem('viewed', '[]');
		}
		
		// Lấy dữ liệu cũ và chuyển đổi sang định dạng JSON
		var old_data = JSON.parse(localStorage.getItem('viewed'));
		
		// Tìm các sản phẩm đã được yêu thích trong mảng dữ liệu cũ
		var matches = old_data.filter(function(obj){
			return obj.id == id;
		});
		
		// Nếu sản phẩm đã được yêu thích thì thông báo cho người dùng
		// Nếu chưa thì thêm mới đối tượng sản phẩm vào mảng dữ liệu cũ
		if (matches.length) {
		}else{
			old_data.push(newItem);
			$("#row_viewed").append('<div class="row" style="margin:10px 0 "<div class="col-md-4"><img class="style" src="'+newItem.image+'"width:79px;height: 87px;"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#fe980f">'+newItem.price+'</p><a class="yeuthich" href="'+newItem.url+'">đặt hàng</a></div>'
					);
		}
		
		// Chuyển đổi đối tượng dữ liệu thành chuỗi JSON và lưu vào bộ nhớ địa phương
		localStorage.setItem('viewed', JSON.stringify(old_data));
	
					
		
		}
	}
		
		</script>

<script>
	
	$(document).ready(function() {

		$('#sort').on('change', function(){
			var url = $(this).val();
			if(url){
				window.location = url;
			}
			return false;
		});
	});
</script>




<script>
	//sản phẩm yêu thích
	function view(){
    if(localStorage.getItem('data') !== null){
        var data = JSON.parse(localStorage.getItem('data'));
		document.getElementById('row_wishlist').style.overflow = 'scroll';
		document.getElementById('row_wishlist').style.height = '600px';
        
        for(i = 0; i < data.length; i++){
			var name = data[i].name;
			var price = data[i].price;
			var image = data[i].image;
			var url = data[i].url;
            $("#row_wishlist").append('<div class="row" style="margin:10px 0 "<div class="col-md-4"><img class="style" src="'+image+'"width:79px;height: 87px;"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#fe980f">'+price+'</p><a class="yeuthich" href="'+url+'">đặt hàng</a></div>'
			);
        }
    }
}
view(); 
function wishlist(clicked_id){
// Lấy thông tin sản phẩm từ các trường thông tin tương ứng
var id = clicked_id;
var name = document.getElementById('wishlist_name'+id).value;
var price = document.getElementById('wishlist_price'+id).value;
var image = document.getElementById('wishlist_image'+id).src;
var url= document.getElementById('wishlist_url'+id).href;

// Tạo một đối tượng mới chứa thông tin sản phẩm
var newItem = {
    'url' : url,
    'name' : name,
    'price' : price,
    'image' : image,
    'id' : id
};

// Kiểm tra xem đã có dữ liệu trong bộ nhớ địa phương chưa
if (localStorage.getItem('data') == null) {
    localStorage.setItem('data', '[]');
}

// Lấy dữ liệu cũ và chuyển đổi sang định dạng JSON
var old_data = JSON.parse(localStorage.getItem('data'));

// Tìm các sản phẩm đã được yêu thích trong mảng dữ liệu cũ
var matches = old_data.filter(function(obj){
    return obj.id == id;
});

// Nếu sản phẩm đã được yêu thích thì thông báo cho người dùng
// Nếu chưa thì thêm mới đối tượng sản phẩm vào mảng dữ liệu cũ
if (matches.length) {
    alert('Sản phẩm của bạn đã được yêu thích nên không thể thêm');
} else {
    old_data.push(newItem);
}

// Chuyển đổi đối tượng dữ liệu thành chuỗi JSON và lưu vào bộ nhớ địa phương
localStorage.setItem('data', JSON.stringify(old_data));
$("#row_wishlist").append('<div class="row" style="margin:10px 0 "<div class="col-md-4"><img class="style" src="'+newItem.image+'"width:79px;height: 87px;"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#fe980f">'+newItem.price+'</p><a class="yeuthich" href="'+newItem.url+'">đặt hàng</a></div>'
			);
			

}

</script>

<script>
	$(document).ready(function() {
		$(document).ready(function() {
			var cate_id = $('.tabs_pro').data('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
        url : '{{url('/product-tabs')}}',
        method: 'POST',
        data:{cate_id:cate_id,_token:_token},
        success:function(data){
           $('#tabs_product').html(data);     
        }
    });

		});		 
		$('.tabs_pro').click(function() {
			var cate_id = $(this).data('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
        url : '{{url('/product-tabs')}}',
        method: 'POST',
        data:{cate_id:cate_id,_token:_token},
        success:function(data){
           $('#tabs_product').html(data);     
        }
    });

		});

	});
</script>


<script>


  function remove(product_id){
	for ( var count = 1 ; count <=5 ; count++ ){
		$('#'+product_id+'-'+count).css('color','#ccc');

	}
	
  }
  //hover chuột đánh giá
  $(document).on('mouseenter','.rating',function(){

	var index = $(this).data("index");
	var product_id = $(this).data('product_id');
	remove(product_id);
	for(var count = 1 ;count <= index ; count++ ){

		$('#'+product_id+'-'+count).css('color','#FFcc00');

	}
  });
  // nhả chuột đánh giá
  $(document).on('mouseleave','.rating',function(){

var index = $(this).data("index");
var product_id = $(this).data('product_id');
var rating = $(this).data("rating");
remove(product_id);
for(var count = 1 ;count <= rating ; count++ ){

	$('#'+product_id+'-'+count).css('color','#FFcc00');

}
});
// clikc đánh giá sao 
$(document).on('click','.rating',function(){
	var index = $(this).data('index');
var product_id = $(this).data('product_id');
var _token = $('input[name="_token"]').val();
$.ajax({
        url : '{{url('/insert-rating')}}',
        method: 'POST',
        data:{index:index,product_id:product_id,_token:_token},
        success:function(data){
		if(data == 'done'){
			alert("bạn đã đánh giá "+index+" trên 5 sao");
		}else{
			alert("lỗi đánh giá")
		}    
        }
    });

});


</script>
<script type="text/javascript">
	$('#keywords').keyup(function() {
  var query = $(this).val();
  if (query != '') {
	var _token = $('input[name="_token"]').val();
	$.ajax({
        url : '{{url('/autocomplete-ajax')}}',
        method: 'POST',
        data:{query:query,_token:_token},
        success:function(data){
			$('#search_ajax').fadeIn();     
           $('#search_ajax').html(data);     
        }
    });

  }else{
	$('#search_ajax').fadeOut();     
  }
	});
	$(document).on('click','.li_search_ajax',function(){
    	$('#keywords').val($(this).text());  
		$('#search_ajax').fadeOut();     
	});
</script>



	<script type="text/javascript">
	 show_cart();
		function show_cart() {
			$.ajax({
        url : '{{url('/show-cart')}}',
        method: 'GET',
	        success:function(data){
		 $('.show_cart').html(data);
        }
    });


		}

	$(document).ready(function(){

    $('.add-to-cart').click(function(){
var id = $(this).data('id_product');
var cart_product_id = $('.cart_product_id_' + id).val();
var cart_product_name = $('.cart_product_name_' + id).val();
var cart_product_image = $('.cart_product_image_' + id).val();
var cart_product_quantity = $('.cart_product_quantity_' + id).val();
var cart_product_price = $('.cart_product_price_' + id).val();
var cart_product_qty = $('.cart_product_qty_' + id).val();
var _token = $('input[name="_token"]').val();
if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
	alert('làm ơn đặt nhỏ hơn' + cart_product_quantity);

}else{


 $.ajax({
    url:'{{url('/add-cart-ajax')}}',
	method:'post',
	data:{cart_product_id:cart_product_id,
		cart_product_name:cart_product_name,
		cart_product_image:cart_product_image,
		cart_product_quantity:cart_product_quantity,
		cart_product_price:cart_product_price,
		cart_product_qty:cart_product_qty,
		_token:_token},
    success: function(data){
		swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });
								show_cart();
	}
    });
}

  });
});

</script>




	<script type="text/javascript">
	// sản phẩm xem nhanh khi bấm vào
    $(document).on('click','.add-to-cart-quickview',function(){
var id = $(this).data('id_product');
var cart_product_id = $('.cart_product_id_' + id).val();
var cart_product_name = $('.cart_product_name_' + id).val();
var cart_product_image = $('.cart_product_image_' + id).val();
var cart_product_quantity = $('.cart_product_quantity_' + id).val();
var cart_product_price = $('.cart_product_price_' + id).val();
var cart_product_qty = $('.cart_product_qty_' + id).val();
var _token = $('input[name="_token"]').val();
if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
	alert('làm ơn đặt nhỏ hơn' + cart_product_quantity);

}else{


 $.ajax({
    url:'{{url('/add-cart-ajax')}}',
	method:'post',
	data:{cart_product_id:cart_product_id,
		cart_product_name:cart_product_name,
		cart_product_image:cart_product_image,
		cart_product_quantity:cart_product_quantity,
		cart_product_price:cart_product_price,
		cart_product_qty:cart_product_qty,
		_token:_token},
		beforeSent: function(){
			$('#beforsend_quickview').html("<p class='text text-primary'>Đã thêm sản phẩm thành công</p>");

		},
    success: function(data){
		$('#beforsend_quickview').html("<p class='text text-primary'>Đã thêm sản phẩm thành công</p>");
	}
    });
}
  });
</script>
<script>
	// đi về trang giỏ hàng
	$(document).on('click','.redirect-cart',function(){
		window.location.href = "{{url('/gio-hang')}}" ;
	});
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
		
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
        url : '{{url('/select-delivery-home')}}',
        method: 'POST',
        data:{action:action,ma_id:ma_id,_token:_token},
        success:function(data){
           $('#'+result).html(data);     
        }
    });
});
});

</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.calculate_delivery').click(function(){
			var matp = $('.city').val();
			var maqh = $('.province').val();
			var xaid = $('.wards').val();
			var _token = $('input[name="_token"]').val();
			if(matp == '' && maqh =='' && xaid ==''){
				alert('Làm ơn chọn để tính phí vận chuyển');
			}else{
				$.ajax({
				url : '{{url('/calculate-fee')}}',
				method: 'POST',
				data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
				success:function(){
				   location.reload(); 
				}
				});
			} 
	});
});
</script>
 <script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",
                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,
								shipping_name:shipping_name,
								shipping_address:shipping_address,
								shipping_phone:shipping_phone,
								shipping_notes:shipping_notes,
								_token:_token,
								order_fee:order_fee,
								order_coupon:order_coupon,
								shipping_method:shipping_method},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
							   window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);
                            }
                        });
                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }

					
                });
            });
			
        });
	
    

    </script>
	<script type="text/javascript">
	$(document).ready(function(){

	load_comment();

	function load_comment(){
		var product_id = $('.comment_product_id').val();
	    var _token = $('input[name="_token"]').val();
	$.ajax({
        url : "{{url('/load-comment')}}",
        method: 'POST',
        data:{product_id:product_id,_token:_token},
        success:function(data){
           $('#comment_show').html(data);     
        }
    });
    
}
$('.send-comment').click(function(){
		var product_id = $('.comment_product_id').val();
		var comment_name = $('.comment_name').val();
		var comment_content = $('.comment_content').val();
		var _token = $('input[name="_token"]').val();

		$.ajax({
        url : "{{url('/send-comment')}}",
        method: 'POST',
        data:{product_id:product_id,comment_content:comment_content,comment_name:comment_name,_token:_token},
        success:function(data){
	  $('#notyfi_comment').html('<p style="color:green" class="text text-success"> thêm bình luận thành công , bình luận đang chờ duyệt</p>')
	  load_comment();
	  $('#notyfi_comment').fadeOut(9000); 
	  $('.comment_name').val('');
	  $('.comment_content').val('');

		}
    });


	   });

	});
	
</script>


<script>
	function huydonhang(id){
		var order_code = id;
		var lydo = $('.lydohuydon').val();
		var _token = $('input[name="_token"]').val();
		$.ajax({
			url : '{{url('/huy-don-hang')}}',
        method: 'POST',
        data:{order_code:order_code,_token:_token,lydo:lydo},
        success:function(data){
   alert('hủy đơn hàng thành công')
   location.reload(); // load lại trang sau khi bấm hy=ủy
		}
    });

	}
</script>

<script>
	load_model();
	function load_model() {
		$.ajax({
			url : '{{url('/load-model')}}',
        method: 'get',
        success:function(data){
			$('#all_product').html(data);     
		}
    });

	}
</script>

	
	

</body>
</html>