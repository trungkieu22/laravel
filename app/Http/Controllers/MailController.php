<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\coupon;
use Illuminate\Support\Facades\DB;
use App\Models\customer;
use FontLib\Table\Type\name;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\CatePost;

class MailController extends Controller
{
    public function resset_new_pass(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = customer::where('customer_email','=', $data['email'])->where('customer_token','=', $data['token'])->get();
        $count = $customer->count();
        if ($count> 0){
            foreach ($customer as $key => $cus){
                $customer_id = $cus->customer_id;

            }
$resset = customer::find($customer_id);
$resset->customer_password = md5($data['password_account']);
$resset->customer_token = $token_random;
$resset->save();
return redirect('login-checkout')->with('message', 'mật khẩu đã cập nhật mới thành công ');

        }else{
            return redirect('quen-mat-khau')->with('error', 'vui lòng nhập lại email vì link đã quá hạn');


        }




    }
    public function update_new_pass(request $request){
        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();
        $meta_desc = "Đổi mật khẩu mới"; 
        $meta_keywords = "Đổi mật khẩu mới";
        $meta_title = "Đổi mật khẩu mới";
        $url_canonical = $request->url();

        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
          return view('pages.mail.new_pass')
          ->with('meta_title',$meta_title)
          ->with('meta_desc',$meta_desc)
          ->with('meta_keywords',$meta_keywords)
          ->with('url_canonical',$url_canonical)
          ->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('category_post',$category_post);   
        
        }
    public function recover_pass(request $request){

        $data = $request->all();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    $title_mail = "Lấy lại mậy khẩu $now";
    $customer = customer::where('customer_email','=', $data['email_account'])->get();
    foreach($customer as  $key => $value){
        $customer_id = $value->customer_id;
    }
    
    if($customer){
        $count_customer = $customer->count();
        if($count_customer==0){
            return redirect()->back()->with('error','email chưa đăng ký để khôi phục mật khẩu' );
        }else{
            $token_random = Str::random();
            $customer = customer::find($customer_id);
            $customer->customer_token = $token_random;
            $customer->save();

            //send mail
            $to_email = $data['email_account'];
            $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token=' .$token_random);
            $data = array("name" => $title_mail, "body" => $link_reset_pass,"email" => $data['email_account']);
        }
    }
  
    
    Mail::send('pages.mail.reset_pass', ['data'=>$data],function($message) use ($title_mail, $data) {
        $message->to($data['email'])->subject($title_mail);   
                $message->from($data['email'], $title_mail);   
    });
    return redirect()->back()->with('message', 'gửi mail thành công vui lòng vào email để đổi mật khẩu');


    }
    public function quen_mat_khau(request $request){
        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();


        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
        $meta_desc = "lấy lại mật khẩu"; 
  $meta_keywords = "lấy lại mật khẩu";
  $meta_title = "lấy lại mật khẩu";
  $url_canonical = $request->url();

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
          return view('pages.mail.quen_mat_khau') 
           ->with('meta_title',$meta_title)
          ->with('meta_desc',$meta_desc)
          ->with('meta_keywords',$meta_keywords)
          ->with('url_canonical',$url_canonical)->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('category_post',$category_post);
    
    }


public function send_coupon_vip($coupon_time, $coupon_condition,$coupon_number,$coupon_code){

    $customer_vip = Customer::where('customer_vip', 1)->get();
    $coupon = coupon::where('coupon_code',$coupon_code)->first();
    $start_day = $coupon->coupon_date_start;
    $end_day = $coupon->coupon_date_end;
    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    $title_mail = "Mã khuyến mãi này $now";
    $data = [];
    
    foreach ($customer_vip as $vip) {
        $data['email'][] = $vip->customer_email;
    }
    $coupon = array(
        'start_day'=>$start_day,
        'end_day'=>$end_day,
        'coupon_time'=>$coupon_time,
        'coupon_condition'=>$coupon_condition,
        'coupon_number'=>$coupon_number,
        'coupon_code' => $coupon_code
    );
    
    Mail::send('pages.mail.send_mail_vip', ['coupon'=>$coupon], function($message) use ($title_mail, $data) {
        $message->to($data['email'])->subject($title_mail);   
        $message->from($data['email'][0], $title_mail);   
    });

    

  
       
    return redirect()->back()->with('message', 'Gửi mã thành công cho khách víp');
}

public function send_coupon($coupon_time, $coupon_condition,$coupon_number,$coupon_code){

    $customer_vip = Customer::where('customer_vip','=', NULL)->get();
    $coupon = coupon::where('coupon_code',$coupon_code)->first();
    $start_day = $coupon->coupon_date_start;
    $end_day = $coupon->coupon_date_end;
    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    $title_mail = "Mã khuyến mãi này $now";
    $data = [];
    
    foreach ($customer_vip as $vip) {
        $data['email'][] = $vip->customer_email;
    }
    $coupon = array(
        'start_day'=>$start_day,
        'end_day'=>$end_day,
        'coupon_time'=>$coupon_time,
        'coupon_condition'=>$coupon_condition,
        'coupon_number'=>$coupon_number,
        'coupon_code' => $coupon_code
    );
    
    Mail::send('pages.mail.send_mail_vip', ['coupon'=>$coupon], function($message) use ($title_mail, $data) {
        $message->to($data['email'])->subject($title_mail);   
        $message->from($data['email'][0], $title_mail);   
    });

    

  
       
    return redirect()->back()->with('message', 'Gửi mã thành công cho khách VIP');
}
public function mail_example(){
    return view('pages.mail.send_mail');
}
}
