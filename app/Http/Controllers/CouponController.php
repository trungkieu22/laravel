<?php

namespace App\Http\Controllers;
use App\Models\coupon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');

    }
    public function unset_coupon(){
		$coupon = Session()->get('coupon');
        if($coupon==true){
          
            Session()->forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}

    public function delete_coupon($coupon_id){
        $coupon = coupon::find($coupon_id);
        $coupon->delete();
        session()->put('message','Xóa Mã Giảm Thành Công');
        return Redirect::to('list-coupon');

    }

    public function insert_coupon_code(request $request){
        $data = $request->all();
       $coupon = new Coupon;  
       $coupon->coupon_name = $data['coupon_name'];        
       $coupon->coupon_date_start = $data['coupon_date_start'];         
       $coupon->coupon_date_end = $data['coupon_date_end'];         
       $coupon->coupon_number = $data['coupon_number'];        
       $coupon->coupon_code = $data['coupon_code'];        
       $coupon->coupon_time = $data['coupon_time'];        
       $coupon->coupon_condition = $data['coupon_condition']; 
       $coupon->save();
       
       session()->put('message','Thêm Mã Giảm Thành Công');
       return Redirect::to('insert-coupon');
      
     
    }
    public function list_coupon(request $request){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y ');
        $coupon = DB::table('tbl_coupon')->orderBy('coupon_id', 'desc')->paginate(5);
                return view('admin.coupon.list_coupon')->with(compact('coupon','today'));
                




    }
  

}
