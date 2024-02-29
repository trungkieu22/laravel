<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use App\Models\Brand;
use Illuminate\Pagination\Paginator;
use App\Models\CatePost;
  
if (!isset($_SESSION)) { session_start(); }

class BrandProduct extends Controller
{
  public function Authlogin(){
    $admin_id = session()->get('admin_id');
    if($admin_id){
        return redirect::to('doashboard');
    }else{

        return redirect::to('admin')->send();
    }
   }
  
    public function add_brand(){
      $this->Authlogin();
    
        return view('admin.add_brand');
      
        }
        public function all_brand(){
          $this->Authlogin();

      
          // $all_brand = db::table('tbl_brand')->get();

          // $manager_brand_product = view('admin.all_brand')->with('all_brand',$all_brand);

          // return view('admin_layout')->with('admin.all_brand',$manager_brand_product);


          $all_brand = Brand::orderBy('brand_id','DESC')->paginate(5);
          Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị
          $manager_brand_product  = view('admin.all_brand')->with('all_brand',$all_brand);
          return view('admin_layout')->with('admin.all_brand', $manager_brand_product);
      
      
      
        }
      
        public function save_brand_product(request $request ){
          $this->Authlogin();

          $data = array();
          $data['brand_name'] = $request->brand_product_name;
          $data['brand_slug'] = $request->brand_slug;
          $data['brand_desc'] = $request->brand_product_desc;
          $data['brand_status'] = $request->brand_product_status;
      
      DB::table('tbl_brand')->insert($data);
      $request->session()->put('message','Thêm Thương Hiệu Thành Công');
      return Redirect::to('/add-brand');
      }
      
      public function active_brand_product($brand_product_id){
        $this->Authlogin();

        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        session()->put('message','Ẩn Thương Hiệu Thành Công');
          return Redirect::to('/all-brand');
      
          // $request->session()->p
      }
      public function unactive_brand_product($brand_product_id){
        $this->Authlogin();

       DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
       session()->put('message','Kích Hoạt Thương Hiệu Thành Công');
       return Redirect::to('/all-brand');
      
      
      
      
      }
      
      public function edit_brand($brand_product_id){
        $this->Authlogin();

        $edit_brand = db::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand')->with('edit_brand',$edit_brand);
        return view('admin_layout')->with('admin.edit_brand',$manager_brand_product);
      
      }
      
      public function update_brand_product($brand_product_id,request $request ){
        $this->Authlogin();

        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_slug'] = $request->brand_slug;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        session()->put('message','Cập Nhật Thương Hiệu Thành Công');
        return Redirect::to('/all-brand');
      
      
      }
      
      public function detele_brand($brand_product_id){
        $this->Authlogin();

        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        session()->put('message','Xóa Thương Hiệu Thành Công');
        return Redirect::to('/all-brand');
        
      
      
      }

//end function admin pages



      public function show_brand_home(Request $request, $brand_slug){
        
        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính

        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
        $brand_by_id = Db::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=' ,'tbl_brand.brand_id')
        ->where('tbl_brand.brand_slug',$brand_slug)->paginate(8);
        foreach($brand_by_id as $key => $val){
          //seo 
          $meta_desc = $val->brand_desc; 
          $meta_keywords = $val->brand_slug;
          $meta_title = $val->brand_name;
          $url_canonical = $request->url();
          //--seo
          }


        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug',$brand_slug)->limit(1)->get();

         return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)
         ->with('brand_name',$brand_name)->with('slider',$slider)->with('category_post',$category_post)
         ->with('meta_title',$meta_title)
         ->with('meta_desc',$meta_desc)
         ->with('meta_keywords',$meta_keywords)
         ->with('url_canonical',$url_canonical);
      
      }
      
      
      
}
