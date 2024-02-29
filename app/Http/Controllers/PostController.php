<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Models\Comment;
use App\Models\coupon;
use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CatePost;
use FontLib\Table\Type\post as TypePost;
if (!isset($_SESSION)) { session_start(); }

class PostController extends Controller
{ 
    public function Authlogin(){
    $admin_id = session()->get('admin_id');
    if($admin_id){
        return redirect::to('doashboard');
    }else{

        return redirect::to('admin')->send();
    }
   }
   
   public function add_post(){
    $this->Authlogin();
     $cate_post =  CatePost::orderby('cate_post_id', 'desc')->get();

      return view('admin.post.add')->with(compact('cate_post'))  ;
  
      }
      public function save_post(request $request){
        $this->Authlogin();
        $data = $request->all();

        $post = new Post();
        $post->post_title = $data['post_title'] ; // lấy post_title từ model = post_title trường name trong add.blade gửi qua
        $post->post_slug = $data['post_slug'] ; 
        $post->post_desc = $data['post_desc'] ; 
        $post->post_content = $data['post_content'] ; 
        $post->post_meta_desc = $data['post_meta_desc'] ; 
        $post->post_meta_keywords = $data['post_meta_keywords'] ; 
        $post->cate_post_id = $data['cate_post_id'] ; 
        $post->post_status = $data['post_status'] ; 

        $get_image = $request->file('post_image');
   
        if ($get_image) {
          $get_name_image = $get_image->getClientOriginalName(); // lấy tên của hình ảnh đó
          $name_image = current(explode('.',$get_name_image));  // lấy tên đầu
  $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); // randum thêm soosddeer  kkhoong trùng ảnh //
  
  $get_image->move('public/upload/post',$new_image); // đường dẫn chứa ảnh thêm

    $post->post_image = $new_image;

  $post->save();

          $request->session()->put('message','Thêm Bài Viết Thành Công Thành Công');
          return Redirect()->back(); //trả về trang trức đó
        }else{
            
          $request->session()->put('message','Làm ơn hãy thêm ảnh vào bài viết'); //nếu không có ảnh sẽ =>message
          return Redirect()->back(); //trả về trang trức đó

        }
   
    }
      public function all_post(){
        $this->Authlogin();
        Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị
        $all_post = Post::with('cate_post')->orderby('post_id')->paginate(5); //lấy ra trong model cate_post


        return view('admin.post.list')->with(compact('all_post'));
        
    
    
    
      }
      public function edit_post($post_id){
        $cate_post = CatePost::orderby('cate_post_id')->get();
        $post = post::find($post_id);
        return view('admin.post.edit')->with(compact('post','cate_post'));
      }
      
      public function delete_post($post_id){

        $this->Authlogin();
       $post = Post::find($post_id);
       $post_image = $post->post_image; 
       $path = 'public/upload/post/' . $post_image;
       if($post_image){
       unlink($path);
    }

       $post->delete();

        session()->put('message','Xóa Bài viết Thành Công');
          return Redirect()->back(); //trả về trang trức đó
        
      
      
      }
      public function update_post($post_id,request $request){
        $this->Authlogin();
        $data = $request->all();

        $post = Post::find($post_id);

        $post->post_title = $data['post_title'] ; // lấy post_title từ model = post_title trường name trong add.blade gửi qua
        $post->post_slug = $data['post_slug'] ; 
        $post->post_desc = $data['post_desc'] ; 
        $post->post_content = $data['post_content'] ; 
        $post->post_meta_desc = $data['post_meta_desc'] ; 
        $post->post_meta_keywords = $data['post_meta_keywords'] ; 
        $post->cate_post_id = $data['cate_post_id'] ; 
        $post->post_status = $data['post_status'] ; 

        $get_image = $request->file('post_image');
   
        if ($get_image) {
            // xóa ảnh cũ
      $post_image_old= $post->post_image;
      $path = 'public/upload/post/'.$post_image_old;
      unlink($path);




// cập nhật ảnh mới
          $get_name_image = $get_image->getClientOriginalName(); // lấy tên của hình ảnh đó
          $name_image = current(explode('.',$get_name_image));  // lấy tên đầu
          $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); // randum thêm soosddeer  kkhoong trùng ảnh //
          $get_image->move('public/upload/post',$new_image); // đường dẫn chứa ảnh thêm

    $post->post_image = $new_image;

        }
        $post->save();

        $request->session()->put('message','Cập nhật Bài Viết Thành Công ');
        return Redirect()->back(); //trả về trang trức đó
   

      }




    // hiển thị ra bên trang chủ
    public function danh_muc_bai_viet($post_slug,request $request){
      $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

      $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính


      $keywords = $request->keywords_submit;
      $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
      $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
      $all_product = Db::table('tbl_product')->where('product_status','0')->orderBy('product_id', 'desc')->paginate(9); //đưa 
      $search_product = Db::table('tbl_product')->where('product_name','like','%'.$keywords. '%')->get();
      $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();
foreach($catepost as $key => $cate){
 //seo
 $meta_title = $cate->cate_post_name;
  $meta_desc = $cate->cate_post_desc;
  $meta_keywords = $cate->cate_post_slug;
  $cate_id = $cate->cate_post_id;
  $url_canonical = $request->url();


}

     $post = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_id)->paginate(5);


      return view('pages.baiviet.danhmucbaiviet')->with('category',$cate_product)
      ->with('brand',$brand_product)
      ->with('all_product',$all_product)
      ->with('search_product',$search_product)
      ->with('slider',$slider)
      ->with('post',$post)
      ->with('category_post',$category_post)
      ->with('meta_title',$meta_title)
      ->with('meta_desc',$meta_desc)
      ->with('meta_keywords',$meta_keywords)
      ->with('url_canonical',$url_canonical);
  
    }

    public function bai_viet($post_slug,request $request){
      $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

      $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính


      $keywords = $request->keywords_submit;
      $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
      $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
      $all_product = Db::table('tbl_product')->where('product_status','0')->orderBy('product_id', 'desc')->paginate(9); //đưa 
      $search_product = Db::table('tbl_product')->where('product_name','like','%'.$keywords. '%')->get();
      $post = Post::with('cate_post')->where('post_status', 0)->where('post_slug', $post_slug)->take(1)->get();
      foreach($post as $key => $p){
 //seo
  $meta_desc = $p->post_mata_desc;
  $meta_keywords = $p->post_meta_keywords;
  $meta_title = $p->post_title;
  $cate_id = $p->cate_post_id;
  $url_canonical = $request->url();
   $cate_post_id = $p->cate_post_id;
   $post_id = $p->post_id;



}

// cập nhật views
$postt = Post::where('post_id', $post_id)->first();
$postt->post_views = $postt->post_views + 1 ;
$postt->save();
$related = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id',$cate_post_id)->wherenotin('post_slug',[$post_slug])->take(5)->get();
// related //lấy ra tát cả bài viết điiều kiện bài post đó đang ở trạng thái hiện thị = 0 //lấy                             //lấy ra bài viết liên quan nhưng trừ cái bài mình đang xem
      return view('pages.baiviet.baiviet')->with('category',$cate_product)
      ->with('brand',$brand_product)
      ->with('all_product',$all_product)
      ->with('search_product',$search_product)->with('slider',$slider)->with('post',$post)->with('category_post',$category_post)
      ->with('meta_keywords',$meta_keywords)
      ->with('meta_desc',$meta_desc)
      ->with('meta_title',$meta_title)
      ->with('url_canonical',$url_canonical)
      ->with('related',$related)
      ;

    }



    
}
