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
use App\Models\Brand;

class SlugController extends Controller
{
    public function show(Request $request ,$slug){
        $category_post = CatePost::orderby('cate_post_id', 'asc')->get(); // asc cái nào thêm sau thì xuống dưới

        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
$category = CategoryProductModel::where('slug_category_product',$slug)->first();
$brand = Brand::where('brand_slug',$slug)->first();
if($category){
    $category_by_id = product::with('category')->where('category_id',$category->category_id)->orderby('product_id','desc')->paginate();
    $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug)->limit(1)->get();
        //seo 
        $meta_desc = $category->category_desc; 
        $meta_title = $category->category_name;
        $meta_keywords = $category->meta_keywords;
        $meta_title = $category->category_name;
        $url_canonical = $request->url();
        //--seo

    

            $category_id = $category->category_id;
        
          
            if(isset($_GET['sort_by'])){
              $sort_by = $_GET['sort_by'];
              if($sort_by == 'giam_dan'){
                
          $category_by_id = product::with('category')->where('category_id',$category_id)->orderby('product_price','desc')->paginate(6)->appends(Request()->query());
              }elseif($sort_by == 'tang_dan'){
                $category_by_id = product::with('category')->where('category_id',$category_id)->orderby('product_price','asc')->paginate(6)->appends(Request()->query());
          
          
              }elseif($sort_by == 'kytu_za'){
                $category_by_id = product::with('category')->where('category_id',$category_id)->orderby('product_name','desc')->paginate(6)->appends(Request()->query());
          
          
              }elseif($sort_by == 'kytu_az'){
                $category_by_id = product::with('category')->where('category_id',$category_id)->orderby('product_name','asc')->paginate(6)->appends(Request()->query());
          
          
              }else{
                $category_by_id = product::with('category')->where('category_id',$category_id)->orderby('product_price','desc')->paginate(6)->appends(Request()->query());
          
          
              }
            }
            
   return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)

   ->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('slider',$slider)->with('category_post',$category_post)
   ->with('meta_desc',$meta_desc)
   ->with('meta_keywords',$meta_keywords)
   ->with('meta_title',$meta_title)
   ->with('url_canonical',$url_canonical);

}elseif($brand){
    $brand_by_id = Db::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=' ,'tbl_brand.brand_id')
    ->where('tbl_brand.brand_slug',$slug)->paginate(6);
      //seo 
      $meta_desc = $brand->brand_desc; 
      $meta_title = $brand->brand_name;
      $meta_keywords = $brand->brand_slug;
      $meta_title = $brand->brand_name;
      $url_canonical = $request->url();
      //--seo
      


    $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug',$brand->slug)->limit(1)->get();

     return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)
     ->with('brand_name',$brand_name)->with('slider',$slider)->with('category_post',$category_post)
     ->with('meta_title',$meta_title)
     ->with('meta_desc',$meta_desc)
     ->with('meta_keywords',$meta_keywords)
     ->with('url_canonical',$url_canonical);


}
    }
}
