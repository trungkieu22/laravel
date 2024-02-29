<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\session; 


// ngôn ngữ thay đổi
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale,['en','vi','cn','jp'])){
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
    
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// frontend
use App\Http\Controllers\HomeController; 
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::get('/load-model','App\Http\Controllers\HomeController@load_model');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');
Route::post('/autocomplete-ajax','App\Http\Controllers\HomeController@autocomplete_ajax');



//danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{slug_category_product}','App\Http\Controllers\CategoryProduct@show_category_home');
// thương hiệu sản phẩm
Route::get('/thuong-hieu-san-pham/{brand_slug}','App\Http\Controllers\BrandProduct@show_brand_home');
//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_slug}','App\Http\Controllers\ProductController@details_product');
Route::get('/tag/{product_tag}','App\Http\Controllers\ProductController@tag');



//slug rút gọn likv



//comment
Route::post('/load-comment','App\Http\Controllers\ProductController@load_comment');
Route::get('/comment','App\Http\Controllers\ProductController@list_comment');
//send comments
Route::post('/send-comment','App\Http\Controllers\ProductController@send_comment');
Route::post('/duyet-comment','App\Http\Controllers\ProductController@duyet_comment');
Route::post('/traloi-comment','App\Http\Controllers\ProductController@traloi_comment');
Route::get('/detele-comment/{comment_id}','App\Http\Controllers\ProductController@detele_comment');

//đnánh giá sao sản phẩm
Route::post('/insert-rating','App\Http\Controllers\ProductController@insert_rating');

//sản phẩm xem nhanh
Route::post('/quickview','App\Http\Controllers\ProductController@quickview');




//danh mục bài viết hiện thị trang chủ
Route::get('/danh-muc-bai-viet/{post_slug}','App\Http\Controllers\PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}','App\Http\Controllers\PostController@bai_viet');




// liên hệ
Route::get('/lien-he','App\Http\Controllers\LienheController@lien_he');


//tạo nút mạng xá hội
Route::get('/list-nut','App\Http\Controllers\LienheController@list_nut');
Route::get('/list-doitac','App\Http\Controllers\LienheController@list_doitac');

Route::get('/delete-icons','App\Http\Controllers\LienheController@delete_icons');

Route::get('/delete-doitac','App\Http\Controllers\LienheController@delete_doitac');

Route::post('/add-nut','App\Http\Controllers\LienheController@add_nut');
Route::post('/add-doitac','App\Http\Controllers\LienheController@add_doitac');

//liên hệ admin
Route::get('/information','App\Http\Controllers\LienheController@information');
// Route::get('/all-information','App\Http\Controllers\LienheController@all_information');

Route::post('/save-info','App\Http\Controllers\LienheController@save_info');
Route::post('/capnhat/{info_id}','App\Http\Controllers\LienheController@capnhat');

// use App\Http\Controllers\AdminController;
// Route::get('/', [AdminController::class, 'index']);
// Route::get('/', [AdminController::class, 'admindashboard']);
// use App\Http\Controllers\AdminController;
// Route::post('/admindashboard', [session::class, 'admindashboard']);
// Route::post('/admindashboard','App\Http\Controllers\AdminController@admindashboard');
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@logout');
Route::post('/admindashboard','App\Http\Controllers\AdminController@admindashboard');
Route::post('/filter-by-date','App\Http\Controllers\AdminController@filter_by_date');
Route::post('/dashboard-filter','App\Http\Controllers\AdminController@dashboard_filter');
Route::post('/days-order','App\Http\Controllers\AdminController@days_order');

// category product
// use App\Http\Controllers\CategoryProduct;
// Route::get('/detele-category/{category_product_id}', [CategoryProduct::class, 'detele_category']);



Route::get('/add-category','App\Http\Controllers\CategoryProduct@add_category');
Route::get('/edit-category/{category_product_id}','App\Http\Controllers\CategoryProduct@edit_category');
Route::get('/detele-category/{category_product_id}','App\Http\Controllers\CategoryProduct@detele_category');

Route::get('/all-category','App\Http\Controllers\CategoryProduct@all_category');

// kéo thả các kiểu
Route::get('/all-category','App\Http\Controllers\CategoryProduct@all_category');
Route::get('/arrange','App\Http\Controllers\CategoryProduct@arrange');

Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');
Route::post('/product-tabs','App\Http\Controllers\CategoryProduct@product_tabs');

// brand product
Route::get('/add-brand','App\Http\Controllers\BrandProduct@add_brand');
Route::get('/edit-brand/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand');
Route::get('/detele-brand/{brand_product_id}','App\Http\Controllers\BrandProduct@detele_brand');

Route::get('/all-brand','App\Http\Controllers\BrandProduct@all_brand');

Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');

// product nhớ

Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/detele-product/{product_id}','App\Http\Controllers\ProductController@detele_product');

Route::get('/all-product','App\Http\Controllers\ProductController@all_product');

Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product_product');

Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product_product');

//check_coupon
Route::post('/check-coupon','App\Http\Controllers\CartController@check_coupon');

//show-cart
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');


//coupon trong admin
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::get('/unset-coupon','App\Http\Controllers\CouponController@unset_coupon');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');




//cart 

Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/gio-hang','App\Http\Controllers\CartController@gio_hang');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@del_product');
Route::get('/del-all-product','App\Http\Controllers\CartController@del_all_product');

//delivery
Route::get('/delivery','App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery','App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/insert-delivery','App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/select-feeship','App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/update-delivery','App\Http\Controllers\DeliveryController@update_delivery');
//send mail
Route::get('/send-mail','App\Http\Controllers\MailController@send_mail');
Route::get('/send-coupon-vip/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','App\Http\Controllers\MailController@send_coupon_vip');
Route::get('/send-coupon/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','App\Http\Controllers\MailController@send_coupon');
Route::get('/mail-example','App\Http\Controllers\MailController@mail_example');
Route::get('/quen-mat-khau','App\Http\Controllers\MailController@quen_mat_khau');
Route::get('/update-new-pass','App\Http\Controllers\MailController@update_new_pass');
Route::post('/resset-new-pass','App\Http\Controllers\MailController@resset_new_pass');
Route::post('/recover-pass','App\Http\Controllers\MailController@recover_pass');

//login google
Route::get('/login-customer-google','App\Http\Controllers\AdminController@login_customer_google');
Route::get('/customer/google/callback','App\Http\Controllers\AdminController@callback_google_customer');

//login facebook
Route::get('/login-customer-facebook','App\Http\Controllers\AdminController@login_customer_facebook');
Route::get('/customer/facebook/callback','App\Http\Controllers\AdminController@callback_facebook_customer');




//order 
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');

Route::get('/history','App\Http\Controllers\OrderController@history');
Route::get('/view-history-order/{order_code}','App\Http\Controllers\OrderController@view_history_order');

Route::post('/update-order-qty','App\Http\Controllers\OrderController@update_order_qty');
//hủy đon hàng
Route::post('/huy-don-hang','App\Http\Controllers\OrderController@huy_don_hang');



Route::post('/update-qty','App\Http\Controllers\OrderController@update_qty');
Route::get('/print-order/(checkout_code)','App\Http\Controllers\OrderController@print_order');
Route::get('/view-order/{order_code}','App\Http\Controllers\OrderController@view_order');
Route::get('/detele-order/{order_code}','App\Http\Controllers\OrderController@detele_order');

   
//checkout
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/del-fee','App\Http\Controllers\CheckoutController@del_fee');
Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::post('/select-delivery-home','App\Http\Controllers\CheckoutController@select_delivery_home');
Route::post('/calculate-fee','App\Http\Controllers\CheckoutController@calculate_fee');
Route::post('/confirm-order','App\Http\Controllers\CheckoutController@confirm_order');
Route::post('/login','App\Http\Controllers\CheckoutController@login');

//cong thanh toán
Route::post('/vnpay-payment','App\Http\Controllers\PaymentController@vnpay_payment');
Route::post('/momo-payment','App\Http\Controllers\PaymentController@momo_payment');

//banner
Route::get('/manage-slider','App\Http\Controllers\BannerController@manage_slider');
Route::get('/add-slider','App\Http\Controllers\BannerController@add_slider');
Route::post('/insert-slider','App\Http\Controllers\BannerController@insert_slider');
Route::get('/active-slide/{slider_id}','App\Http\Controllers\BannerController@active_slide');
Route::get('/unactive-slide/{slider_id}','App\Http\Controllers\BannerController@unactive_slide');
Route::get('/detele-slider/{slider_id}','App\Http\Controllers\BannerController@detele_slider');

// danh  mục bài viết
Route::get('/add-category-post','App\Http\Controllers\CategoryPost@add_category');
Route::get('/edit-category-post/{category_post_id}','App\Http\Controllers\CategoryPost@edit_category_post');
Route::get('/all-category-post','App\Http\Controllers\CategoryPost@all_category_post');
Route::get('/detele-category-post/{cate_id}','App\Http\Controllers\CategoryPost@detele_category_post');
Route::get('/danh-muc-bai-viet/{cate_post_slug}','App\Http\Controllers\CategoryPost@danh_muc_bai_viet');
Route::post('/save-category-post','App\Http\Controllers\CategoryPost@save_category_post');
Route::post('/update-category-post/{cate_id}','App\Http\Controllers\CategoryPost@update_category_post');

// thêm bài viết
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::get('/all-post','App\Http\Controllers\PostController@all_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');


//gallery them
Route::get('/add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('/select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
//ok ngon rồi nên chú ý về model
Route::post('/update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('/deleted-gallery','App\Http\Controllers\GalleryController@deleted_gallery');
Route::post('/update-gallery','App\Http\Controllers\GalleryController@update_gallery');









