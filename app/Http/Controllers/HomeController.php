<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Models\Banner;
use App\Models\CategoryProductModel;
use App\Models\CatePost;
use App\Models\order;
use App\Models\product;
use Illuminate\Pagination\Paginator;
use App\Models\icons;
use App\Models\Post;
use App\Models\customer;

if (!isset($_SESSION)) { session_start(); }

class HomeController extends Controller
{

  
   public function index(request $request){
      Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị
    // get mạng xã hội
$icons = icons::where('category','icons')->orderby('id_icons','desc')->get();


      // danh mục bài viết
     $category_post = CatePost::orderby('cate_post_id', 'asc')->get(); // asc cái nào thêm sau thì xuống dưới

      $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
      $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
      $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
      $all_product = Db::table('tbl_product')->where('product_status','0')->orderBy('product_id', 'desc')->paginate(12); //đưa 
      $cate_pro_tabs = CategoryProductModel::where('category_parent',0)->orderBy('category_id', 'desc')->get();

 //seo 
 $meta_desc = "Gì cũng có mua hết ở eshopper, là một người tiêu dùng thông minh xin hãy lựa chọn chúng tôi"; //mô tả trên gg từ khóa gg
 $meta_keywords = "đồ dùng thiết yếu,điện thoại, phụ kiện ,nội trợ,ăn uống,"; 
 $meta_title = "COOLMATE";
 $url_canonical = $request->url();
 //--seo


    return view('pages.home')
    ->with('category',$cate_product)
    ->with('brand',$brand_product)
    ->with('all_product',$all_product)
    ->with('slider',$slider)
    ->with('category_post',$category_post)
    ->with('meta_desc',$meta_desc)
    ->with('meta_keywords',$meta_keywords)
    ->with('meta_title',$meta_title)
    ->with('url_canonical',$url_canonical)
    ->with('icons',$icons)
    ->with('cate_pro_tabs',$cate_pro_tabs); // đưa tất cả ra trang chính 
   }
   public function search(request $request){

      $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

      $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
    

      $keywords = $request->keywords_submit;
      $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
      $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
      $all_product = Db::table('tbl_product')->where('product_status','0')->orderBy('product_id', 'desc')->paginate(12); //đưa 
      $search_product = Db::table('tbl_product')->where('product_name','like','%'.$keywords. '%')->get();
      $cate_pro_tabs = CategoryProductModel::where('category_parent','<>',0)->orderBy('category_order', 'asc')->get();

      $meta_desc = "kết quả tìm kiếm " .$keywords; //mô tả trên gg từ khóa gg
      $meta_keywords = "kết quả tìm kiếm " .$keywords; 
      $meta_title = "kết quả tìm kiếm " .$keywords;
      $url_canonical = $request->url();


      return view('pages.sanpham.search')
      ->with('meta_desc',$meta_desc)
      ->with('meta_keywords',$meta_keywords)
      ->with('meta_title',$meta_title)
      ->with('url_canonical',$url_canonical)->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('search_product',$search_product)->with('slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs);

   }
   public function autocomplete_ajax(Request $request){
      $data = $request->all();
      if($data['query']){
         $product = product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
         $output = ' <ul class="dropdown-menu" style="display:block;">';
         foreach($product as $key => $val){
            $output.= '<li class="li_search_ajax" ><a href="#">'.$val->product_name.'</a></li>  ';
       
         }
         $output.= '
         </ul>';
   echo $output;
      }
   }
   
}
