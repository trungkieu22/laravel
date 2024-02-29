<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\order;
use App\Models\wards;
use App\Http\Requests;
use App\Models\coupon;
use App\Models\feeship;
use App\Models\customer;
use App\Models\province;
use App\Models\shipping;
use App\Models\orderdetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Cart; 
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;
use Illuminate\Validation\Validator;
use App\Models\Banner;
use App\Models\CatePost;



class CheckoutController extends Controller
{
    public function confirm_order(Request $request){
        $data = $request->all();
        if($data['order_coupon']!= 'no'){
            $coupon = coupon::where('coupon_code',$data['order_coupon'])->first();
            $coupon->coupon_used =$coupon->coupon_used.','.session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1 ;
            $coupon_mail = $coupon->coupon_code;
            $coupon->save();    
        }else{
            $coupon_mail = 'Không có sử dụng';

        }

        
//vận chuyển
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

 //get order
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order->created_at = $today;
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
         $order->order_date = $order_date;
        $order->save();

        if(session()->get('cart')){
           foreach(session()->get('cart') as $key => $cart){
               $order_details = new orderdetails;
               $order_details->order_code = $checkout_code;
               $order_details->product_id = $cart['product_id'];
               $order_details->product_name = $cart['product_name'];
               $order_details->product_price = $cart['product_price'];
               $order_details->product_sales_quantity = $cart['product_qty'];
               $order_details->product_coupon =  $data['order_coupon'];
               $order_details->product_feeship = $data['order_fee'];
               $order_details->created_at = Carbon::now('Asia/Ho_Chi_Minh');
               $order_details->save();
           }
        }
       
    //send email
    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');//lấy ngày giờ hiện tại để gửi
    $title_mail = "Thông báo đặt hàng thành công $now";
    $customer = customer::find(session()->get('customer_id'));
    $data['email'][] = $customer->customer_email;
    // lấy giỏ hàng
    if(session()->get('cart')==true){
        foreach(session()->get('cart')as $key => $cart_mail){
            $cart_array[] = array(
            'product_name' => $cart_mail['product_name'],
            'product_price' => $cart_mail['product_price'],
            'product_qty'   =>$cart_mail['product_qty']
            );
        }
    }
    //nếu không chọn giá tiền ship thì auto 30k
    if(session()->get('fee')==true){
        $fee = session::get('fee');

    }else{
        $fee = '30000 VNĐ';
    }
        //lấy người dùng
    $shipping_array = array(
        'fee' => $fee,
     'customer_name' => $customer->customer_name,
    'shipping_name' => $data['shipping_name'],
    'shipping_email' => $data['shipping_email'],
    'shipping_phone' => $data['shipping_phone'],
    'shipping_address' => $data['shipping_address'],
    'shipping_notes' => $data['shipping_notes'],
    'shipping_method' => $data['shipping_method']
    );
 //lấy mã giảm giá với coupon_code
    $ordercode_mail = array(
     'coupon_code' => $coupon_mail,
     'order_code' =>  $checkout_code

    );
    Mail::send('pages.mail.mail_order',['cart_array'=>$cart_array , 'shipping_array'=>$shipping_array , 'code'=>$ordercode_mail] 
    , function($message) use ($title_mail, $data) {
        $message->to($data['email'])->subject($title_mail);   
        $message->from($data['email'][0], $title_mail);   
    });
    
    Session()->forget('coupon');
    Session()->forget('fee');
    Session()->forget('cart');

    }

    public function login_checkout(Request $request){
      
        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();
        $meta_desc = "Đăng nhập"; 
  $meta_keywords = "Đăng nhập ngay";
  $meta_title = "Đăng Nhập nhanh tay bất ngờ trao tay";
  $url_canonical = $request->url();

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('category_post',$category_post)
          ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('url_canonical',$url_canonical);
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
		if($data['action']){
			$output = '';
			if($data['action'] == "city"){
				
				$select_province = province::where('matp',$data['ma_id'])->orderBy('maqh','asc')->get();
				$output.='<option>--Chọn Quận Huyện---</option>';
				foreach($select_province as $key => $province){
				$output.= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
				}
			}else{
				$select_wards = wards::where('maqh',$data['ma_id'])->orderBy('maqh','asc')->get();
				$output.='<option>--chon Phường Xã---</option>';
				foreach($select_wards as $key => $ward){
				$output.= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
				}

			}
            echo $output;
		}
        
    

    }

    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{  
                    Session::put('fee',30000);
                    Session::save();
                }
            }
           
        }
    }
    public function del_fee(){
        Session()->forget('fee');
        return redirect()->back();
    }



    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $get_image = $request->file('customer_picture');
        $path = 'public/upload/product/';

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image)); 
    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    $get_image->move( $path,$new_image);
    $data['customer_picture'] = $new_image;
         
          }

         
        $insert_id = DB::table('tbl_customr')->insertGetId($data);

        session()->put('customer_id', $insert_id);
        session()->put('customer_name', $data['customer_name']);
        session()->put('customer_picture', $data['customer_picture']);
        return redirect('/checkout');

    }
    public function checkout(Request $request){
        
        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();
         //seo
  $meta_desc = "Giỏ hàng của bạn"; 
  $meta_keywords = "Giỏ hàng của bạn";
  $meta_title = "Thanh toán nhanh tay bất ngờ trao tay";
  $url_canonical = $request->url();
//seo

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
        $city = city::orderBy('matp','asc')->get();
        return  view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('city',$city)->with('slider',$slider)->with('category_post',$category_post)
        ->with('meta_title',$meta_title)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('url_canonical',$url_canonical);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
         
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        session()->put('shipping_id', $shipping_id);
        return redirect('/payment');


    }
    public function payment(){

    }
    public function logout_checkout(){
      session()->forget('customer_id');        
      session()->forget('coupon');        
        return redirect('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->all();
        $password = $request->all();
  $email = $request->email_account;
  $password = md5($request->password_account);
  $result = DB::table('tbl_customr')->where('customer_email',$email)->where('customer_password',$password)->first();
  if(session::get('coupon')==true){
    session::forget('coupon');
  }
  if($result){
    $request->session()->put('customer_name',$result->customer_name);
    $request->session()->put('customer_id',$result->customer_id);
    return redirect::to('/checkout');
  }else{
    return redirect::to('/login-checkout')->with('error','Mật Khẩu Hoặc Tài Khoản Không Đúng');

  }
  session()->save();

     }
  
}