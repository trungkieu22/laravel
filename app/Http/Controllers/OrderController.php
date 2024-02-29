<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\feeship;
use App\Models\order;
use App\Models\shipping;
use App\Models\orderdetails;
use App\Models\customer;
use App\Models\coupon;
use TblOrderDetails;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use App\Models\product;
use Illuminate\Support\Facades\Redirect;
use App\Models\Statistic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\CatePost;
use App\Models\Banner;
use App\Models\CategoryProductModel;





if (!isset($_SESSION)) { session_start(); }



class OrderController extends Controller
{ 
	public function update_qty(Request $request){




		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
	public function update_order_qty(Request $request){
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();


   //send email
   $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');//lấy ngày giờ hiện tại để gửi
   $title_mail = "Đơn hàng của bạn đã được xác nhận $now";
   $customer = customer::where('customer_id',$order->customer_id)->first();
   $data['email'][] = $customer->customer_email;
   // lấy giỏ hàng
	   foreach($data['order_product_id'] as $key => $product) {
		$product_mail = product::find($product);
		foreach($data['quantity'] as $key2 =>$qty){
		   if($key==$key2){
			$cart_array[] = array(
		   'product_name' => $product_mail['product_name'],
		   'product_price' => $product_mail['product_price'],
		   'product_qty'   =>$qty
		   );
		}
		}
	   }
  
$details = orderdetails::where('order_code',$order->order_code)->first();
$fee_ship = $details->product_feeship;
$coupon_mail = $details->product_coupon;
$shipping = shipping::where('shipping_id',$order->shipping_id)->first();
	   //lấy người dùng
   $shipping_array = array(
	   'fee_ship' => $fee_ship,
	'customer_name' => $customer->customer_name,
   'shipping_name' => $shipping->shipping_name,
   'shipping_email' => $shipping->shipping_email,
   'shipping_phone' => $shipping->shipping_phone,
   'shipping_address' => $shipping->shipping_address,
   'shipping_notes' => $shipping->shipping_notes,
   'shipping_method' => $shipping->shipping_method,
   );
//lấy mã giảm giá với coupon_code
   $ordercode_mail = array(
	'coupon_code' => $coupon_mail,
	'order_code' =>  $details->order_code,

   );
   Mail::send('admin.xacnhan.comfim_order',['cart_array'=>$cart_array , 'shipping_array'=>$shipping_array , 'code'=>$ordercode_mail] 
   , function($message) use ($title_mail, $data) {
	   $message->to($data['email'])->subject($title_mail);   
	   $message->from($data['email'][0], $title_mail);   
   });
		//update order
	
  //thêm
		$order_date = $order->order_date;
		$statistic = Statistic::where('order_date', $order_date)->get();
		
		if ($statistic){
			$statistic_count =$statistic->count();

		}else{
			$statistic_count = 0;
		}
		if($order->order_status==2){
 // thêm
			$total_order = 0;
			$sales = 0 ;
			$profit = 0;
			$quantity = 0;
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
      // thêm 2 dòng
				$product_price = $product->product_price;
				$product_cost = $product->product_cost;
				$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity - $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold + $qty;
								$product->save();

								// cập nhật doanh thu
								$quantity+=$qty; //cộng số lượng 
								$total_order+=1; //mỗi lần chạy cộng lên một lần
								$sales+=$product_price*$qty; //doanh số bằng số lượng nhân với giá
								$profit = $sales - ($product_cost*$qty);      //  doanh số thì giá gôc nhân với só lượng
						}
				}
			}
		   //cập nhật doanh số
		   if($statistic_count>0) {
			$statistic_update = Statistic::where('order_date',$order_date)->first();
			$statistic_update->sales = $statistic_update->sales + $sales;
			$statistic_update->profit = $statistic_update->profit + $profit;
			$statistic_update->quantity = $statistic_update->quantity + $quantity;
			$statistic_update->total_order = $statistic_update->total_order + $total_order;
			$statistic_update->save();

		   }else{
			$statistic_new = new Statistic();
			$statistic_new->order_date = $order_date;
			$statistic_new->total_order = $total_order;
			$statistic_new->sales = $sales;
			$statistic_new->profit = $profit;
			$statistic_new->quantity = $quantity;
			$statistic_new->save();
		   }

		}


	}
    // public function print_order($checkout_code,$data){
	// 	$pdf = \PDF::loadView('pdf.order', [
	// 		'order' => $order,
	// 		'customer' => $customer,
	// 	]);

	// 	return $pdf->stream();
	// }
	public function print_order_convert($checkout_code){

		return $checkout_code;

		// $order_details = OrderDetails::where('order_code',$checkout_code)->get();
		// $order = Order::where('order_code',$checkout_code)->get();
		// foreach($order as $key => $ord){
		// 	$customer_id = $ord->customer_id;
		// 	$shipping_id = $ord->shipping_id;
		// }
		// $customer = Customer::where('customer_id',$customer_id)->first();
		// $shipping = Shipping::where('shipping_id',$shipping_id)->first();

		// $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

		// foreach($order_details_product as $key => $order_d){

		// 	$product_coupon = $order_d->product_coupon;
		// }
		// if($product_coupon != 'no'){
		// 	$coupon = Coupon::where('coupon_code',$product_coupon)->first();

		// 	$coupon_condition = $coupon->coupon_condition;
		// 	$coupon_number = $coupon->coupon_number;

		// 	if($coupon_condition==1){
		// 		$coupon_echo = $coupon_number.'%';
		// 	}elseif($coupon_condition==2){
		// 		$coupon_echo = number_format($coupon_number,0,',','.').'đ';
		// 	}
		// }else{
		// 	$coupon_condition = 2;
		// 	$coupon_number = 0;

		// 	$coupon_echo = '0';
		
		// }

		// $output = '';

		// $output.='<style>body{
		// 	font-family: DejaVu Sans;
		// }
		// .table-styling{
		// 	border:1px solid #000;
		// }
		// .table-styling tbody tr td{
		// 	border:1px solid #000;
		// }
		// </style>
		// <h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		// <h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		// <p>Người đặt hàng</p>
		// <table class="table-styling">
		// 		<thead>
		// 			<tr>
		// 				<th>Tên khách đặt</th>
		// 				<th>Số điện thoại</th>
		// 				<th>Email</th>
		// 			</tr>
		// 		</thead>
		// 		<tbody>';
				
		// $output.='		
		// 			<tr>
		// 				<td>'.$customer->customer_name.'</td>
		// 				<td>'.$customer->customer_phone.'</td>
		// 				<td>'.$customer->customer_email.'</td>
						
		// 			</tr>';
				

		// $output.='				
		// 		</tbody>
			
		// </table>

		// <p>Ship hàng tới</p>
		// 	<table class="table-styling">
		// 		<thead>
		// 			<tr>
		// 				<th>Tên người nhận</th>
		// 				<th>Địa chỉ</th>
		// 				<th>Sdt</th>
		// 				<th>Email</th>
		// 				<th>Ghi chú</th>
		// 			</tr>
		// 		</thead>
		// 		<tbody>';
				
		// $output.='		
		// 			<tr>
		// 				<td>'.$shipping->shipping_name.'</td>
		// 				<td>'.$shipping->shipping_address.'</td>
		// 				<td>'.$shipping->shipping_phone.'</td>
		// 				<td>'.$shipping->shipping_email.'</td>
		// 				<td>'.$shipping->shipping_notes.'</td>
						
		// 			</tr>';
				

		// $output.='				
		// 		</tbody>
			
		// </table>

		// <p>Đơn hàng đặt</p>
		// 	<table class="table-styling">
		// 		<thead>
		// 			<tr>
		// 				<th>Tên sản phẩm</th>
		// 				<th>Mã giảm giá</th>
		// 				<th>Phí ship</th>
		// 				<th>Số lượng</th>
		// 				<th>Giá sản phẩm</th>
		// 				<th>Thành tiền</th>
		// 			</tr>
		// 		</thead>
		// 		<tbody>';
			
		// 		$total = 0;

		// 		foreach($order_details_product as $key => $product){

		// 			$subtotal = $product->product_price*$product->product_sales_quantity;
		// 			$total+=$subtotal;

		// 			if($product->product_coupon!='no'){
		// 				$product_coupon = $product->product_coupon;
		// 			}else{
		// 				$product_coupon = 'không mã';
		// 			}		

		// $output.='		
		// 			<tr>
		// 				<td>'.$product->product_name.'</td>
		// 				<td>'.$product_coupon.'</td>
		// 				<td>'.number_format($product->product_feeship,0,',','.').'đ'.'</td>
		// 				<td>'.$product->product_sales_quantity.'</td>
		// 				<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
		// 				<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
		// 			</tr>';
		// 		}

		// 		if($coupon_condition==1){
		// 			$total_after_coupon = ($total*$coupon_number)/100;
	    //             $total_coupon = $total - $total_after_coupon;
		// 		}else{
        //           	$total_coupon = $total - $coupon_number;
		// 		}

		// $output.= '<tr>
		// 		<td colspan="2">
		// 			<p>Tổng giảm: '.$coupon_echo.'</p>
		// 			<p>Phí ship: '.number_format($product->product_feeship,0,',','.').'đ'.'</p>
		// 			<p>Thanh toán : '.number_format($total_coupon + $product->product_feeship,0,',','.').'đ'.'</p>
		// 		</td>
		// </tr>';
		// $output.='				
		// 		</tbody>
			
		// </table>

		// <p>Ký tên</p>
		// 	<table>
		// 		<thead>
		// 			<tr>
		// 				<th width="200px">Người lập phiếu</th>
		// 				<th width="800px">Người nhận</th>
						
		// 			</tr>
		// 		</thead>
		// 		<tbody>';
						
		// $output.='				
		// 		</tbody>
			
		// </table>

		// ';


		// return $output;

	}
  public function view_order($order_code){
    $order_details = orderdetails::with('product')->where('order_code', $order_code)->get();
    $order = order::where('order_code', $order_code)->get();
    foreach($order as $key => $ord){
        $customer_id = $ord->customer_id;
        $shipping_id = $ord->shipping_id;
        $order_status = $ord->order_status;
    }
 
    $customer = customer::where('customer_id', $customer_id)->first();
    $shipping = shipping::where('shipping_id', $shipping_id)->first();


$order_details_product = orderdetails::with('product')->where('order_code', $order_code)->get();

foreach($order_details_product as $key => $order_d){

    $product_coupon = $order_d->product_coupon;
}
if($product_coupon != 'no'){
    $coupon = Coupon::where('coupon_code',$product_coupon)->first();
    $coupon_condition = $coupon->coupon_condition;
    $coupon_number = $coupon->coupon_number;
}else{
    $coupon_condition = 2;
    $coupon_number = 0;
}

return view('admin.view_order')->with(compact('order_details','customer','shipping','coupon_condition','coupon_number','order','order_status'));



  } 
  public function detele_order($order_code){
	$this->Authlogin();

	DB::table('tbl_order')->where('order_code',$order_code)->delete();
	session()->put('message','Xóa đơn hàng Thành Công');
	return Redirect::to('/manage-order');
  }


    public function manage_order(){
		$this->Authlogin();
		Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị

        $order = order::orderby('order_id','desc')->paginate(5);
        return View('admin.manage_order')->with(compact('order'));
    }
	public function Authlogin(){
		$admin_id = session()->get('admin_id');
		if($admin_id){
			return redirect::to('doashboard');
		}else{
	
			return redirect::to('admin')->send();
		}
	   }
	   public function history(request $request){
		if(!session()->get('customer_id')){   // nếu người dùng có đăng nhập thì để nguyên còn không tồn tại thì về trang đăng nhập
				return redirect('login-checkout')->with('error', 'vui lòng đăng nhập để xem lịch sử mua hàng');

		}else{
			$order = order::where('customer_id',session()->get('customer_id'))->orderby('order_id','desc')->paginate(5);
			Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị


			// danh mục bài viết
		   $category_post = CatePost::orderby('cate_post_id', 'desc')->get();
	  
		   $meta_desc = "Lịch sử mua hàng của bạn"; //mô tả trên gg từ khóa gg
		   $meta_keywords = "Lịch sử mua hàng của bạn"; 
		   $meta_title = "Lịch sử mua hàng của bạn";
		   $url_canonical = $request->url();

			$slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
			$cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
			$brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
			$all_product = Db::table('tbl_product')->where('product_status','0')->orderBy('product_id', 'desc')->paginate(12); //đưa 
			$cate_pro_tabs = CategoryProductModel::where('category_parent','<>',0)->orderBy('category_order', 'asc')->get();

	  
	  
		  return view('pages.history.history')
		  ->with('category',$cate_product)
		  ->with('meta_title',$meta_title)
          ->with('meta_desc',$meta_desc)
          ->with('meta_keywords',$meta_keywords)
          ->with('url_canonical',$url_canonical)
		  ->with('brand',$brand_product)->with('all_product',$all_product)->with('slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs)->with('order',$order); // đưa tất cả ra trang chính 
			
		}
	   }
	   public function view_history_order (Request $request, $order_code){
		if(!session()->get('customer_id')){   // nếu người dùng có đăng nhập thì để nguyên còn không tồn tại thì về trang đăng nhập
	    return redirect('login-checkout')->with('error', 'vui lòng đăng nhập để xem lịch sử mua hàng');

		}else{
			Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị


			// danh mục bài viết
		   $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

		   $meta_desc = "Đơn hàng mua hàng của bạn"; //mô tả trên gg từ khóa gg
		   $meta_keywords = "Đơn hàng mua hàng của bạn"; 
		   $meta_title = "Đơn hàng mua hàng của bạn";
		   $url_canonical = $request->url();
	  
			$slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
			$cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
			$brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
			$all_product = Db::table('tbl_product')->where('product_status','0')->orderBy('product_id', 'desc')->paginate(12); //đưa 
	  
	    // xem lịch sử đơn hàng
		$order_details = orderdetails::with('product')->where('order_code', $order_code)->get();
		$order = order::where('order_code', $order_code)->first();

			$customer_id = $order->customer_id;
			$shipping_id = $order->shipping_id;
			$order_status = $order->order_status;
		
	 
		$customer = customer::where('customer_id', $customer_id)->first();
		$shipping = shipping::where('shipping_id', $shipping_id)->first();
	
	$order_details_product = orderdetails::with('product')->where('order_code', $order_code)->get();
	
	foreach($order_details_product as $key => $order_d){
	
		$product_coupon = $order_d->product_coupon;
	}
	if($product_coupon != 'no'){
		$coupon = Coupon::where('coupon_code',$product_coupon)->first();
		$coupon_condition = $coupon->coupon_condition;
		$coupon_number = $coupon->coupon_number;
	}else{
		$coupon_condition = 2;
		$coupon_number = 0;
	}
	  
		  return view('pages.history.view_history')
		  ->with('category',$cate_product)
		  ->with('brand',$brand_product)
		  ->with('all_product',$all_product)
		  ->with('slider',$slider)
		  ->with('category_post',$category_post)
		  ->with('order_details',$order_details) // đưa tất cả ra trang chính 
		  ->with('customer',$customer) // đưa tất cả ra trang chính 
		  ->with('shipping',$shipping) // đưa tất cả ra trang chính 
		  ->with('coupon_condition',$coupon_condition) // đưa tất cả ra trang chính 
		  ->with('coupon_number',$coupon_number) // đưa tất cả ra trang chính 
		  ->with('order',$order) // đưa tất cả ra trang chính 
		  ->with('order_status',$order_status)
		  ->with('order_code',$order_code)
		  ->with('meta_title',$meta_title)
          ->with('meta_desc',$meta_desc)
          ->with('meta_keywords',$meta_keywords)
          ->with('url_canonical',$url_canonical)
		  ; // đưa tất cả ra trang chính 
			
		}
	   }
	   public function huy_don_hang(request $request){
		$data = $request->all();
		$order = order::where('order_code',$data['order_code'])->first();
		$order->order_destroy = $data['lydo'];
		$order->order_status = 3;
		$order->save();

	   }
}
