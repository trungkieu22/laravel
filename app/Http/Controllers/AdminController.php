<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\customer;
use App\Models\Login;
use App\Models\order;
use App\Models\Post;
use App\Models\product;
use Illuminate\Support\Facades\Redirect;
use App\Models\Social;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialcustomer;
use Illuminate\Http\Request;
use App\Models\Statistic;
use Carbon\Carbon;
use App\Models\Visitors;
if (!isset($_SESSION)) { session_start(); }



class AdminController extends Controller
{   public function login_customer_google(){
    config(['services.google.redirect'=> env('GOOGLE_URL')] );
    return  Socialite::driver('google')->redirect();
 }
 public function callback_google_customer(){
    config(['services.google.redirect'=> env('GOOGLE_URL')]);
    $user = Socialite::driver('google')->stateless()->user();    

    $authUser = $this->findOrCreateCustomer($user, 'google');




   if($authUser){
    $account_name = customer::where('customer_id',$authUser->user)->first();
    session::put('customer_id',$account_name->customer_id);
    session::put('customer_picture',$account_name->customer_picture);
    session::put('customer_name',$account_name->customer_name);

   }elseif($customer_new){
    $account_name = customer::where('customer_id',$authUser->user)->first();
    session::put('customer_id',$account_name->customer_id);
    session::put('customer_picture',$account_name->customer_picture);
    session::put('customer_name',$account_name->customer_name);

   }
       return redirect('/trang-chu')->with('message','Đăng nhập tài Khoản google <span style="color:red">' .$account_name->customer_email. '</span> thành công');

   

 }
 public function findOrCreateCustomer($users,$provider){
    $authUser = Social::where('provider_user_id',$users->id)->first();
    if($authUser){
        return $authUser;

    }else{
        $customer_new = new Social([
            'provider_user_id' => $users->id,
            'provider_user_email' => $users->email,
            'provider' =>strtoupper($provider)

        ]);
        $customer = customer::where('customer_email',$users->email)->first();
        if(!$customer){
            $customer = customer::create([
                'customer_name' => $users->name,
                'customer_picture' => $users->avatar,
                'customer_email' => $users->email,
                'customer_password' => '',
                'customer_phone' => ''


            ]);
        }
        $customer_new->customer()->associate($customer);
        $customer_new->save();
        return $customer_new;
    }

 }



   public function Authlogin(){
    $admin_id = session()->get('admin_id');
    if($admin_id){
        return redirect::to('doashboard');
    }else{

        return redirect::to('admin')->send();
    }
   }
    public function index(){
        return view('admin_login');
       }
       public function dashboard(Request $request){
        $this->Authlogin();
        $user_ip_address = $request->ip(); // lấy địa chỉ ip người truy cập


        $early_last_month    = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();


        //last month
        $visitor_of_lastmonth = Visitors::wherebetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
           $visitor_last_month_count = $visitor_of_lastmonth->count();
           //this month
           $visitor_of_thismonth = Visitors::wherebetween('date_visitor',[$early_this_month,$now])->get();
           $visitor_this_month_count = $visitor_of_thismonth->count();
           //of years
           $visitor_of_years = Visitors::wherebetween('date_visitor',[$oneyears,$now])->get();
           $visitor_years_count = $visitor_of_years->count();

        // người hiện tại đang online
        $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();
        $visitors_count = $visitors_current->count();
        if($visitors_count<1){
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();

        }
        $visitors = Visitors::all();
        $visitors_total = $visitors->count();
        // //total visitors
        $portorder = product::all()->count();
        $portt = Post::all()->count();
        $orderr = order::all()->count();
        $customerr = Customer::all()->count();

        $product_views = product::orderBy('product_views','desc')->take(20)->get(); //desc bài nào xem nhiều nhất sẽ lên trang đầu
        $post_views = post::orderBy('post_views','desc')->take(20)->get();


        return view('admin.dashboard')
        ->with(compact('visitors_total','visitor_last_month_count','visitor_this_month_count','visitor_years_count','visitors_count','portorder','portt','orderr','customerr','post_views','product_views')); // thêm ký tự đằng sau cho đỡ trùng

    }
    public function admindashboard(Request $request){
   
$admin_email = $request->admin_email;
$admin_password = md5($request->admin_password);
$result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();

 if($result){
    $request->session()->put('admin_name',$result->admin_name);
    $request->session()->put('admin_id',$result->admin_id);
    return Redirect::to('/dashboard');
       

 }else{
    $request->session()->put('message','Mật Khẩu Hoặc Tài Khoản Không Đúng Nhập Lại');
    return Redirect::to('/admin');
 }
       }

       public function logout(){
        $this->Authlogin();
        session()->put('admin_name',null);
        session()->put('admin_id',null);
        return Redirect::to('/admin');  
         }

         public function login_customer_facebook(){
            config(['services.facebook.redirect'=> env('FACEBOOK_CLIENT_REDIRECT')] );
            return  Socialite::driver('facebook')->redirect();
         }
         public function callback_facebook_customer(){
            config(['services.facebook.redirect'=> env('FACEBOOK_CLIENT_REDIRECT')]);
            $provider = Socialite::driver('facebook')->user();
            

            $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        
        

           if($account!=NULL){
            $account_name = customer::where('customer_id',$account->user)->first();
            session::put('customer_id',$account_name->customer_id);
            session::put('customer_picture',$account_name->customer_picture);
            session::put('customer_name',$account_name->customer_name);
            return redirect('/trang-chu')->with('message','Đăng nhập tài Khoản facebook <span style="color:green">' .$account_name->customer_email. '</span> thành công');

           }
           elseif($account==null){
            $customer_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider_user_email' => $provider->getEmail(),
                'provider' =>'facebook'
                


            ]);
            $customer = customer::where('customer_email',$provider->getEmail())->first();

            if(!$customer){
                $customer = customer::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_picture' => $provider->getAvatar(),
                    'customer_password' => '',
                    'customer_phone' => ''


                ]);

            }
            $customer_login->customer()->associate($customer);
            $customer_login->save();

            $account_new = customer::where('customer_id',$customer_login->user)->first();
            session()->put('customer_id',$account_new->customer_id);
            
            session()->put('customer_name',$account_new->customer_name);

            return redirect('/trang-chu')->with('message','Đăng nhập tài khoản facebook <span style="color:green">' .$account_new->customer_email. '</span> thành công');
           }


         }
        public function filter_by_date(request $request){
            $data = $request->all();
            $from_date = $data['from_date'];
            $to_date = $data['to_date'];
            $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','asc')->get();
            $chart_data = array();
                    
            foreach ($get as $key => $val){
                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
        
            }    
                    
            echo $data = json_encode($chart_data);
        }
        public function dashboard_filter(Request $request){
            $data = $request->all();
             $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
             $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
             $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

             $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
             $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
   
         $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
         if($data['dashboard_value']=='7ngay'){
            $get = Statistic::wherebetween('order_date',[$sub7ngay,$now])->orderBy('order_date','asc')->get();
         }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::wherebetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','asc')->get();

         }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::wherebetween('order_date',[$dauthangnay,$now])->orderBy('order_date','asc')->get();



        }else{
            $get = Statistic::wherebetween('order_date',[$sub365ngay,$now])->orderBy('order_date','asc')->get();

        }
        $chart_data = array();

foreach($get as $key => $val){

$chart_data[] = array(
    'period' => $val->order_date,
    'order' => $val->total_order,
    'sales' => $val->sales,
    'profit' => $val->profit,
    'quantity' => $val->quantity
);
}
echo $data = json_encode($chart_data);

        }

        public function days_order(request $request){
            $data = $request->all();

            $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(60)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $get = Statistic::wherebetween('order_date',[$sub60days,$now])->orderBy('order_date','asc')->get();

            $chart_data = array();

            foreach($get as $key => $val){
            
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
            }
            echo $data = json_encode($chart_data);

        }
      

}

