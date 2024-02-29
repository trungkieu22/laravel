<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Cart; 
use Illuminate\Contracts\View\View;
use App\Models\coupon;
use Illuminate\Support\Carbon;
use App\Models\Banner;
use App\Models\CatePost;


if (!isset($_SESSION)) { session_start(); }

class CartController extends Controller
{


  public function show_cart(){
    $cart = count(session()->get('cart'));
    $output = '';
    $output.='
    <span class="badges">'.$cart.'</span>';
   echo $output;
  }
  public function check_coupon(Request $request){
    $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y ');

    $data = $request->all();
    if(session::get('customer_id')){

      $coupon = Coupon::where('coupon_code',$data['coupon'])
      ->where('coupon_status',1)
      ->where('coupon_date_end','>=',$today)
      ->where('coupon_used','LIKE','%'
      .session::get('customer_id'). '%')->first();
      if($coupon){
        return redirect()->back()->with('error','Mã giảm giá đã sử dụng vui lòng nhập mã khác');


      }else{
        $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
        if($coupon_login){
            $count_coupon = $coupon_login->count();
            if($count_coupon>0){
                $coupon_session = Session()->get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon_login->coupon_code,
                            'coupon_condition' => $coupon_login->coupon_condition,
                            'coupon_number' => $coupon_login->coupon_number,
    
                        );
                        Session()->put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon_login->coupon_code,
                            'coupon_condition' => $coupon_login->coupon_condition,
                            'coupon_number' => $coupon_login->coupon_number,
    
                        );
                    Session()->put('coupon',$cou);
                }
                Session()->save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
    
        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng - hoặc đã hết hạn');
        }
      }
       
      
    }else{
    $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
    if($coupon){
        $count_coupon = $coupon->count();
        if($count_coupon>0){
            $coupon_session = Session()->get('coupon');
            if($coupon_session==true){
                $is_avaiable = 0;
                if($is_avaiable==0){
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                    Session()->put('coupon',$cou);
                }
            }else{
                $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                Session()->put('coupon',$cou);
            }
            Session()->save();
            return redirect()->back()->with('message','Thêm mã giảm giá thành công');
        }

    }else{
        return redirect()->back()->with('error','Mã giảm giá không đúng , hoặc đã hết hạn');
    }
}  

}




 public function gio_hang(request $request){
  $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
  $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

  //seo
  $meta_desc = "Giỏ hàng của bạn"; 
  $meta_keywords = "Giỏ hàng của bạn";
  $meta_title = "Giỏ hàng của bạn";
  $url_canonical = $request->url();
//seo
$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
$brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 



return view('pages.cart.cart_ajax')
->with('category',$cate_product)
->with('brand',$brand_product)
->with('meta_desc',$meta_desc)
->with('meta_keywords',$meta_keywords)
->with('meta_title',$meta_title)
->with('url_canonical',$url_canonical)
->with('slider',$slider)
->with('category_post',$category_post);






 }



 public function add_cart_ajax(Request $request){
  // Session()->forget('cart'); 
  $data = $request->all();
  
  $session_id = substr(md5(microtime()),rand(0,26),5);
  $cart = session()->get('cart');
  if($cart==true){
      $is_avaiable = 0;
      foreach($cart as $key => $val){
          if($val['product_id']==$data['cart_product_id']){
              $is_avaiable++;
          }
      }
      if($is_avaiable == 0){
          $cart[] = array(
          'session_id' => $session_id,
          'product_name' => $data['cart_product_name'],
          'product_id' => $data['cart_product_id'],
          'product_image' => $data['cart_product_image'],
          'product_quantity' => $data['cart_product_quantity'],
          'product_qty' => $data['cart_product_qty'],
          'product_price' => $data['cart_product_price'],
          );
          session()->put('cart',$cart);
      }
  }else{
      $cart[] = array(
          'session_id' => $session_id,
          'product_name' => $data['cart_product_name'],
          'product_id' => $data['cart_product_id'],
          'product_image' => $data['cart_product_image'],
          'product_quantity' => $data['cart_product_quantity'],
          'product_qty' => $data['cart_product_qty'],
          'product_price' => $data['cart_product_price'],

      );
      session()->put('cart',$cart);
  }
 
  session()->save();


} 

public function update_cart(Request $request){
  $data = $request->all();
  $cart = session()->get('cart');

  if($cart==true){
   $message = '';
    foreach($data['cart_qty'] as $key => $qty){

    foreach($cart as $session => $val){

      if(isset($cart[$session]['product_quantity']) && $val['session_id']==$key && $qty<=$cart[$session]['product_quantity']){ //nếu như  mà số lượng người mua ít hơn hoặc bằng sản phẩm hiện có thì mặc định giao dịch diễn ra bình thường

        $cart[$session]['product_qty'] = $qty;
        $message.= '<p style="color:blu"> cập nhật số lượng sản phẩm ' .$cart[$session]['product_name']. ' thành công </p>';

      }elseif(isset($cart[$session]['product_quantity']) && $val['session_id']==$key && $qty>$cart[$session]['product_quantity']){  //còn nếu nhứ số lượng người mua mà nhiều hơn số lượng bán => cn thất bạn
              $message.= '<p style="color:red"> cập nhật số lượng sản phẩm ' .$cart[$session]['product_name']. ' thất bại </p>';

      }
    }    
    }
    session()->put('cart', $cart);
    return redirect()->back()->with('message',$message);

  }else{
    return redirect()->back()->with('message','không thành thành công');


  }
}
public function del_product($session_id){
  $cart = session()->get('cart');
    if($cart==true){
      foreach($cart as $key => $val){

        if($val['session_id']==$session_id){
          unset($cart[$key]);
     }

    }
    session()->put('cart',$cart);
    return redirect()->back()->with('message','xóa sản phẩm thành công');
 }else{
  return redirect()->back()->with('message','xóa sản phẩm thất bại');


 }
}


    public function save_cart(Request $request){
      $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính


        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first(); 

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        // // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // // Cart::destroy();
        // $data['id'] = $product_info->product_id;
        // $data['qty'] = $quantity;
        // $data['name'] = $product_info->product_name;
        // $data['price'] = $product_info->product_price;
        // $data['weight'] = $product_info->product_price;
        // $data['options']['image'] = $product_info->product_image;
        // Cart::add($data);
        // Cart::destroy();
       

        return view('/pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
     //Cart::destroy();
       
    }
    public function del_all_product(){
      $cart = session()->get('cart');
      if($cart==true){
        session()->forget('cart');
        session()->forget('coupon');
        return redirect()->back()->with('message','xóa hết tất cả mọi thứ thành công');


      }
    }


    } 
