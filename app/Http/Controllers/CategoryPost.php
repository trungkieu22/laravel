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
class CategoryPost extends Controller
{
    public function Authlogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return redirect::to('doashboard');
        }else{
    
            return redirect::to('admin')->send();  //dùng để kiểm tra đã đăng nhập vào acc min hay chưa
        }
       }
       public function add_category(){
        $this->Authlogin();
     
        
      return view('admin.category_post.add_post');
    
      }
      public function save_category_post(request $request){
        $this->Authlogin();
       
        $data = $request->all(); //lấy tất cả data dữ liệu

        $category_post = new CatePost(); // khi lưu sẽ tạo mới
        $category_post->cate_post_name = $data['cate_post_name']; //$data['cate_post_name lấy từ name = bên add_post // category_post->cate_post_name lấy từ thằng model
        $category_post->cate_post_slug = $data['cate_post_slug']; //$data['cate_post_name lấy từ name = bên add_post //gọi đúng tên từ model và name của fileadd_post
        $category_post->cate_post_status = $data['cate_post_status']; //$data['cate_post_name lấy từ name = bên add_post
        $category_post->cate_post_desc = $data['cate_post_desc']; //$data['cate_post_name lấy từ name = bên add_post
         $category_post->save(); // đưa dữ liệu vào cơ sở dữ liệu php my sql
    
    $request->session()->put('message','Thêm Danh Mục Bài Viết Thành Công');
    return redirect()->back();  //trả về trang trước đó khi thêm
    }
    public function all_category_post()
    {
        $this->Authlogin();
        Paginator::useBootstrap();//phân trang bootstrap đầy đủ theo số từ 1 - > bao nhiêu trang tuy số lượng hiện thị

        $category_post = CatePost::orderby('cate_post_id','desc')->paginate(5);//lấy cate_post_id trong csdl  //cái này thêm sau nó sẽ lên trước // phân ra 5 trang 



        return view('admin.category_post.list_post')->with(compact('category_post')); //lấy cái category post đưa sang list_post
    }
    public function edit_category_post($category_post_id){
        $this->Authlogin();
        $category_post = CatePost::find($category_post_id); // tìm bài viết dựa trên id
  
        return view('admin.category_post.edit_post')->with(compact('category_post')) ;      
      }


      public function update_category_post(request $request,$cate_id){
        
        $data = $request->all(); //lấy tất cả data dữ liệu
        $category_post = CatePost::find($cate_id); // tìm bài viết dựa trên id

        $category_post->cate_post_name = $data['cate_post_name']; //$data['cate_post_name lấy từ name = bên add_post // category_post->cate_post_name lấy từ thằng model
        $category_post->cate_post_slug = $data['cate_post_slug']; //$data['cate_post_name lấy từ name = bên add_post //gọi đúng tên từ model và name của fileadd_post
        $category_post->cate_post_status = $data['cate_post_status']; //$data['cate_post_name lấy từ name = bên add_post
        $category_post->cate_post_desc = $data['cate_post_desc']; //$data['cate_post_name lấy từ name = bên add_post
         $category_post->save(); // đưa dữ liệu vào cơ sở dữ liệu php my sql
    
    session()->put('message','Cập nhật Danh Mục Bài Viết Thành Công');
    
    return redirect::to('all-category-post');  //dùng để kiểm tra đã đăng nhập vào acc min hay chưa


      }
      public function detele_category_post($cate_id){
      
        $category_post = CatePost::find($cate_id);
        $category_post->delete();
        session()->put('message','Xóa Danh Mục Bài Viết Thành Công');
        return Redirect()->back(); //quay lại trang trước đó
        
      
      
      }

    public function danh_muc_bai_viet($cate_post_slug){

    }
}
