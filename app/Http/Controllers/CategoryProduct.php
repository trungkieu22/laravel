<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use App\Models\CategoryProductModel;
if (!isset($_SESSION)) { session_start(); }
use Illuminate\Pagination\Paginator;
use App\Models\CatePost;
use App\Models\product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategoryProduct extends Controller
{
  public function Authlogin(){
    $admin_id = session()->get('admin_id');
    if($admin_id){
        return redirect::to('doashboard');
    }else{

        return redirect::to('admin')->send();
    }
   }
  public function add_category(){
    $this->Authlogin();
    $category = CategoryProductModel::where('category_parent',0)->orderBy('category_id' ,'desc')->get(); //lay tat ca danh muc la danh muc cha het vachar=string =" sap xep theo product id cai nao them minh dua len truoc
 
    
  return view('admin.add_category')->with(compact('category')); // -> lấy category sang trang add_category

  }
  public function all_category()
  {
      $this->Authlogin();
      $category_product = CategoryProductModel::where('category_parent',0)->orderBy('category_id' ,'desc')->get(); //lay tat ca danh muc la danh muc cha het vachar=string =" sap xep theo product id cai nao them minh dua len truoc
     
      $all_category = DB::table('tbl_category_product')->orderBy('category_parent' ,'desc')->orderBy('category_order','ASC')->paginate(10); //lấy ra để phân mỗi trang 5 dòng hoặc cột thứ tự sắp xếp theo danh mục cha
      Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị
      $manager_category_product = view('admin.all_category')->with('all_category', $all_category)->with('category_product', $category_product);
      return view('admin_layout')->with('manager_category_product', $manager_category_product);
  }
 
  public function save_category_product(request $request){
    $this->Authlogin();

    $data = array();
            //  lưu vào xong đến cập nhật
    $data['category_name'] = $request->category_product_name;
    $data['meta_keywords'] = $request->category_product_keywords;
    $data['category_parent'] = $request->category_parent;
    $data['slug_category_product'] = Str::slug($request->category_product_name).'-'.Carbon::now('Asia/Ho_Chi_Minh')->timestamp;
    $data['category_desc'] = $request->category_product_desc;
    $data['category_status'] = $request->category_product_status;
    

DB::table('tbl_category_product')->insert($data);
$request->session()->put('message','Thêm Danh Mục Thành Công');
return Redirect::to('/add-category');
}

public function active_category_product($category_product_id){
  $this->Authlogin();

  DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
  session()->put('message','Ẩn Danh Mục Thành Công');
    return Redirect::to('/all-category');

    // $request->session()->p
}
public function unactive_category_product($category_product_id){
  $this->Authlogin();

 DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
 session()->put('message','Kích Hoạt Danh Mục Thành Công');
 return Redirect::to('/all-category');




}

public function edit_category($category_product_id){
  $this->Authlogin();
  $category = CategoryProductModel::orderBy('category_id' ,'desc')->get(); //lay tat ca danh muc la danh muc cha het vachar=string =" sap xep theo product id cai nao them minh dua len truoc
  
  $edit_category = db::table('tbl_category_product')->where('category_id',$category_product_id)->get();
  $manager_category_product = view('admin.edit_category')->with('edit_category',$edit_category)->with('category',$category); //string và biến
  return view('admin_layout')->with('admin.edit_category',$manager_category_product);

}

public function update_category_product($category_product_id,request $request ){
  $this->Authlogin();

  $data = array();
  //cập nhật xong bắt đầu thử
  $data['category_name'] = $request->category_product_name;
  $data['meta_keywords'] = $request->category_product_keywords;
  $data['category_parent'] = $request->category_parent;
  $data['slug_category_product'] = Str::slug($request->category_product_name).'-'.Carbon::now('Asia/Ho_Chi_Minh')->timestamp;
  $data['category_desc'] = $request->category_product_desc;
  DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
  session()->put('message','Cập Nhật Danh Mục Thành Công');
  return Redirect::to('/all-category');


}

public function detele_category($category_product_id){
  $this->Authlogin();

  DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
  session()->put('message','Xóa Danh Mục Thành Công');
  return Redirect::to('/all-category');
  


}


//end function admin page
public function show_category_home($slug_category_product,Request $request){
  $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

  $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính

  $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();

  $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
  $category_by_slug = CategoryProductModel::where('slug_category_product',$slug_category_product)->get();

  $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->paginate(6);
  foreach($category_by_id as $key => $val){
    //seo 
    $meta_desc = $val->category_desc; 
    $meta_keywords = $val->meta_keywords;
    $meta_title = $val->category_name;
    $url_canonical = $request->url();
    //--seo
    }

  foreach($category_by_slug as $cate){

    

    $category_id = $cate->category_id;

   }
  
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

  $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();


   return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)

   ->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('slider',$slider)->with('category_post',$category_post)
   ->with('meta_desc',$meta_desc)
   ->with('meta_keywords',$meta_keywords)
   ->with('meta_title',$meta_title)
   ->with('url_canonical',$url_canonical);

}


// kéo thả 
public function arrange(Request $request){
  $this->Authlogin();

  $data = $request->all();
  $cate_id = $data["page_id_array"];
  foreach($cate_id as $key => $value){
    echo $value;
    // $category = CategoryProductModel::find($value);
    // $category->category_order = $key ;
    // $category->save();

  }
  echo 'UPDATED';
}
public function product_tabs(Request $request){
  $data =  $request->all();
  $output = '';
  $subcategory = CategoryProductModel::where('category_parent',$data['cate_id'])->get();
  $sub_array = array();
  foreach($subcategory as $key => $sub){
    $sub_array[] = $sub->category_id;
  }
  array_push($sub_array,$data['cate_id']); // lấy ra danh mục cha
  $product  = product::whereIn('category_id',$sub_array )->orderby('product_id','desc')->get(); // lấy ra danh mục con
  $product_count = $product->count();
  if($product_count>0){
    $output .= '
    <div class="tab-content">
    <div class="tab-pane fade active in" id="tshirt" >';

              
   foreach($product as $key => $val){
        
    $output .= '   <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="'.url('public/upload/product/'.$val->product_image).'" alt="'.$val->product_name.'" />
                        <h2>'.number_format($val->product_price,0,',','.').' VNĐ</h2> 
                        <p>'.$val->product_name.'</p>
                        <a href="'.url('/chi-tiet-san-pham/'.$val->product_slug).'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chi tiết sản phẩm</a>
                    </div>
                    
                </div>
            </div>
        </div>';
   }
        $output .= '
          </div>
    </div>
    ';
  }else{
    $output .= '
    <div class="tab-content">
    <div class="tab-pane fade active in" id="tshirt" >

              
      
        <div class="col-sm-12s">
        
        <p style="text-align:center"> Hiện chưa có sản phẩm trong danh mục này </p>           
        </div>
    </div>
    
   
    </div>
    ';

  }

   echo $output;

}
//number_format( không có số không đằng sau thay dấu phẩy bằng dấy chấm

}

