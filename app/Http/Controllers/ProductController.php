<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Models\Comment;
use App\Models\coupon;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use Illuminate\Pagination\Paginator;
use App\Models\CatePost;
use App\Models\Gallery;
use Symfony\Component\Mime\Part\File;
use App\Models\product;
use App\Models\Rating;

if (!isset($_SESSION)) { session_start(); }


class ProductController extends Controller
{
  public function Authlogin(){
    $admin_id = session()->get('admin_id');
    if($admin_id){
        return redirect::to('doashboard');
    }else{

        return redirect::to('admin')->send();
    }
   }
   public function traloi_comment(request $request){
    $data = $request->all();
    $comment = new Comment();
    $comment->comment =$data['comment'];
    $comment->comment_product_id =$data['comment_product_id'];
    $comment->comment_parent_comment =$data['comment_id'];
    $comment->comment_status = 0;
    $comment->comment_name = 'Admin';
    $comment->save();




   }
   public function duyet_comment(request $request){
    $data = $request->all();
    $comment = Comment::find($data['comment_id']);
    $comment->comment_status = $data['comment_status'];
    $comment->save();
   }
   public function list_comment(){
    $comment = comment::with('product')->where('comment_parent_comment','=',0)->orderby('comment_id', 'desc')->get(); // lấy ra comment status desc lớn lấy lên trước
    $comment_rep = comment::with('product')->where('comment_parent_comment','>',0)->get(); // lấy ra comment status desc lớn lấy lên trước
    return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));

   }
  public function send_comment(request $request){
    $product_id = $request->product_id;
    $comment_name = $request->comment_name;
    $comment_content = $request->comment_content;

    $comment = new Comment();
    $comment->comment = $comment_content;

    $comment->comment_name = $comment_name;
    $comment->comment_product_id = $product_id;
    $comment->comment_status = 1;
    $comment->comment_parent_comment = 0;

    $comment->save();

  }


    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = comment::where('comment_product_id', $product_id)->where('comment_parent_comment','=',0)->where('comment_status', 0)->get();
        $comment_rep = comment::with('product')->where('comment_parent_comment','>',0)->get(); // lấy ra comment status desc lớn lấy lên trước
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '
            <div class="row style_comment">
                <div class="col-md-2">
                    <img width="100%" src="'.url('public/frontend/images/d4c0c142f91f012c9a8a9c9aeef3bac28036f15b.webp').'" class="img img-responsive img-thumbnail">
                </div>
                <div class="col-md-10">
                    <p style="color: green">@'.$comm->comment_name.'</p>
                    <p style="color: black">'.$comm->comment_date.'</p>
                    <p>'.$comm->comment.'</p>
                </div>
            </div>
            <p></p>';
            foreach ($comment_rep as $key => $rep_comment) {
              if($rep_comment->comment_parent_comment==$comm->comment_id){
                $output .= '
                <div class="row style_com"  >
                    <div class="col-md-2 style_comment">
                        <img width="100%" style="margin-left:11px;margin-bottom:-42px;" src="'.url('public/frontend/giamdoc.png').'" class="img img-responsive img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <p style="color: green">@Admin</p>
                        <p style="color: black">'.$rep_comment->comment.'</p>
                        <p></p>
                    </div>
                </div>
                <p></p>';
              }
            
              }
        }
        echo $output;
    }

    public function add_product(){
      $this->Authlogin();
       $cate_product = Db::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
       $brand_product = Db::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product)  ;
    
        }
        public function all_product(){
          $this->Authlogin();
          Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị
          $all_product = db::table('tbl_product')
          ->join('tbl_category_product','tbl_category_product.category_id' , '=' , 'tbl_product.category_id')
          ->join('tbl_brand','tbl_brand.brand_id' , '=' , 'tbl_product.brand_id')
          ->orderby('tbl_product.product_id','desc')->get();
          $manager_product = view('admin.all_product')->with('all_product',$all_product);
          return view('admin_layout')->with('admin.all_product',$manager_product);
             
      
        }
      
        public function save_product(request $request ){
          $this->Authlogin();

          $data = array();
       
$product_price = filter_var($request->product_price,FILTER_SANITIZE_NUMBER_INT);
$product_cost = filter_var($request->product_cost,FILTER_SANITIZE_NUMBER_INT);

          $data['product_name'] = $request->product_name;
          $data['product_tags'] = $request->product_tags;
          $data['product_slug'] = $request->product_slug;
          $data['product_quantity'] = $request->product_quantity;
          $data['product_price'] = $product_price;
          $data['product_cost'] = $product_cost;
          $data['product_desc'] = $request->product_desc;
          $data['product_content'] = $request->product_content;
          $data['category_id'] = $request->product_cate;
          $data['Brand_id'] = $request->product_brand;
          $data['product_status'] = $request->product_status;

          $get_image = $request->file('product_image');

          $path = 'public/upload/product/';
          $path_gallery = 'public/upload/gallery/';

     
          if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image)); 
    $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    $get_image->move( $path,$new_image);
    copy($path.$new_image, $path_gallery.$new_image); // copy sang mookt trang mới
    $data['product_image'] = $new_image;
         
          }
         $pro_id =  DB::table('tbl_product')->insertGetId($data); // lấy sản phẩm cuối cùng rồi thêm sản phẩm đó vào
          $gallely = new Gallery();
          $gallely->gallery_image = $new_image;
          $gallely->gallery_name = $new_image;
          $gallely->product_id = $pro_id;
          $gallely->save();

          $request->session()->put('message','Thêm Sản Phẩm Thành Công');
          return Redirect::to('/add-product');
    
      }
      
      public function active_product_product($product_id){
        $this->Authlogin();

        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        session()->put('message','Ẩn Sản Phẩm Thành Công');
          return Redirect::to('/all-product');
      
          // $request->session()->p
      }
      public function unactive_product_product($product_id){
        $this->Authlogin();

       DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
       session()->put('message','Kích Hoạt Sản Phẩm Thành Công');
       return Redirect::to('/all-product');
      
      
      
      
      }
      
      public function edit_product($product_id){
        $this->Authlogin();

        $cate_product = Db::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        $edit_product = db::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
      
      }
      
      public function update_product_product($product_id,request $request ){
        $this->Authlogin();

        $data = array();
        $product_price = filter_var($request->product_price,FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($request->product_cost,FILTER_SANITIZE_NUMBER_INT);

        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $product_price;
        $data['product_cost'] = $product_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['Brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

         $get_image = $request->file('product_image');
         if ($get_image) {
          $get_name_image = $get_image->getClientOriginalName();
          $name_image = current(explode('.',$get_name_image)); 
         $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
         $get_image->move('public/upload/product',$new_image);
         $data['product_image'] = $new_image;
          DB::table('tbl_product')->where('product_id',$product_id)->update($data);
          $request->session()->put('message','Cập Nhật Sản Phẩm Thành Công');
          return Redirect::to('/all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        $request->session()->put('message','Cập nhật sản phẩm Thành Công');
    return Redirect::to('/all-product');

      
      
      }
      
      public function detele_product($product_id){

        $this->Authlogin();

        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        session()->put('message','Xóa Sản Phẩm Thành Công');
        return Redirect::to('/all-product');
        
      
      
      }

      //end admin pages

      public function details_product(Request $request, $product_slug){
        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();
        //gra

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get(); 

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id' , '=' , 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id' , '=' , 'tbl_product.brand_id')
        ->where('tbl_product.product_slug', $product_slug)
        ->get();
       
$category_id = null; // declare and initialize the variable

foreach($details_product as $key => $value){
  $category_id = $value->category_id;
  $product_id = $value->product_id;
  $product_cate = $value->category_name;
  $cate_slug = $value->slug_category_product;

  $meta_desc = $value->product_slug; 
  $meta_keywords = $value->product_tags;
  $url_canonical = $request->url();
  //--seo
  $meta_title = $value->product_name;
}
//gallery
$gallery = Gallery::where('product_id', $product_id)->get();
$rating =  Rating::where('product_id', $product_id)->avg('rating');
$rating = round($rating);

//cập nhật sản phẩm lượt xem
$product =  product::where('product_id', $product_id)->first();
$product->product_views  = intval($product->product_views) + 1 ;
$product->save();


$related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id' , '=' , 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id' , '=' , 'tbl_product.brand_id')
        ->where('tbl_category_product.category_id', $category_id)
        ->whereNotIn('tbl_product.product_slug',[$product_slug])
        ->orderBy(DB::raw('RAND()'))
        ->paginate(20);
          return view('/pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)
          ->with('relate',$related_product)->with('slider',$slider)
          ->with('category_post',$category_post)->with('gallery',$gallery)
          ->with('product_cate',$product_cate)->with('cate_slug',$cate_slug)
          ->with('meta_title',$meta_title)
          ->with('meta_desc',$meta_desc)
          ->with('meta_keywords',$meta_keywords)
          ->with('url_canonical',$url_canonical)
          ->with('rating',$rating);
      }

      public function tag(request $request,$product_tag){
        
        $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
        $category_post = CatePost::orderby('cate_post_id', 'desc')->get();
        //gra

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
        $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get(); 
        $tag = str_replace("-"," ",$product_tag);

        $pro_tag = product::where('product_status',0)->where('product_name','LIKE','%'.$tag.'%')->orwhere('product_tags','LIKE','%'.$tag.'%')->orwhere('product_slug','LIKE','%'.$tag.'%')->get();
   
        $meta_desc = "tags tìm kiếm :" .$product_tag; 
  $meta_keywords = "tags tìm kiếm :" .$product_tag;
  $meta_title = "tags tìm kiếm :" .$product_tag;
  $url_canonical = $request->url();

          return view('/pages.sanpham.tag')
          ->with('category',$cate_product)
          ->with('brand',$brand_product)
          ->with('slider',$slider)->with('category_post',$category_post)
          ->with('product_tag',$product_tag)
          ->with('pro_tag',$pro_tag)
          ->with('meta_title',$meta_title)
          ->with('meta_desc',$meta_desc)
          ->with('meta_keywords',$meta_keywords)
          ->with('url_canonical',$url_canonical);
      }

      public function insert_rating(request $request){
        $data = $request->all();
        $rating = new rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';

      }
      public function detele_comment($comment_id){
        $this->Authlogin();
        DB::table('tbl_comment')->where('comment_id',$comment_id)->delete();
        session()->put('message','Xóa bình luận Thành Công');
        return Redirect::to('/comment');

      }
      public function quickview(request $request){
        $product_id = $request->product_id;
        $product    = product::find($product_id);
        $gallery =  Gallery::where('product_id',$product_id)->get();
        $output['product_gallery'] = '';
        foreach ($gallery as $key => $gal){
          $output['product_gallery'].='<p><img  src="public/upload/gallery/'.$gal->gallery_image.'"></p>';

        }
        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').' '.'VNĐ';
        $output['product_image'] ='<p><img  src="public/upload/product/'.$product->product_image.'"></p>' ;

        $output['product_button'] =' <input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" data-id_product="'.$product->product_id.'" name="add-to-cart">
        ';


        $output['product_quickview_value'] ='
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'}}">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="1"                        class="cart_product_qty_'.$product->product_id.'">
        ';
        echo json_encode($output);

      }
}
