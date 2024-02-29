<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Cart; 
use Illuminate\Contracts\View\View;
use App\Models\coupon;
use Illuminate\Support\Carbon;
use App\Models\Contact;
use App\Models\Banner;
use App\Models\CatePost;
use App\Models\icons;
if (!isset($_SESSION)) { session_start(); }

class LienheController extends Controller
{
    public function lien_he(Request $request){
      $category_post = CatePost::orderby('cate_post_id', 'desc')->get();

      $slider = Banner::orderby('slider_id','desc')->where('slider_status','0')->take(10)->get();// đưa slider ra trang chính
      $contact = Contact::where('info_id',5)->get();

        $cate_product = Db::table('tbl_category_product')->where('category_status','0')->orderBy('category_id', 'desc')->get();
      $brand_product = Db::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id', 'desc')->get();
      $meta_desc = "liên hệ với chúng tôi"; //mô tả trên gg từ khóa gg
      $meta_keywords = "liên hệ với chúng tôi"; 
      $meta_title = "liên hệ với chúng tôi";
      $url_canonical = $request->url();
        return view('pages.lienhe.lienhe')
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('category_post',$category_post)->with('contact',$contact);
    }
   
    public function save_info(Request $request){
        $data   = $request->all();
        $contact  =  new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_fanpage = $data['info_fanpage'];
    
        $get_image = $request->file('info_image');

        $path = 'public/upload/contact/';


        if ($get_image) {
          $get_name_image = $get_image->getClientOriginalName();
          $name_image = current(explode('.',$get_name_image)); 
  $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
  $get_image->move( $path,$new_image);
  $contact->info_image = $new_image;
       
        }
        $contact->save();
        return redirect()->back()->with('message','cập nhật thông tin thành công');

    }
    public function information(){
      $contact = Contact::where('info_id',5)->get();
      return view('admin.information.information')->with(compact('contact'));
    }




    public function capnhat(Request $request,$info_id){
      $data   = $request->all();
      $contact  = Contact::find($info_id);
      $contact->info_contact = $data['info_contact'];
      $contact->slogan_logo = $data['slogan_logo'];
      $contact->info_map = $data['info_map'];
      $contact->info_fanpage = $data['info_fanpage'];
  
      $get_image = $request->file('info_image');

      $path = 'public/upload/contact/';


      if ($get_image) {
        unlink($path.$contact->info_image);
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image)); 
$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
$get_image->move( $path,$new_image);
$contact->info_image = $new_image;
     
      }
      $contact->save();
      return redirect()->back()->with('message','cập nhật thông tin thành công');


   

    }
    public function list_nut(){
      $icons = icons::where('category','icons')->orderBy('id_icons','desc')->get(); // get là lấy ra tất cả
       $output = '';
       $output .= '
       <table class="table">
       <thead>
         <tr>
           <th>Tên nút</th>
           <th>Hình ảnh</th>
           <th>Linh</th>
           <th>quản lý</th>
         </tr>
       </thead>
       <tbody>';
       foreach ($icons as $key => $ico){
        $output .= '   <tr>
           <td>'.$ico->name.'</td>
           <td><img src="'.url('public/upload/icons/'.$ico->image).'" height="32px" width="32px"></td>
           <td>'.$ico->link.'</td>
           <td><button id="'.$ico->id_icons.'" class="btn btn-danger" onclick="delete_icons(this.id)">Xóa</button></td>
         </tr>';
        }
         $output .= ' </tbody>
     </table>
       
       
       ';  
       echo $output;      
    }
    public function list_doitac(){
      $icons = icons::where('category','doitac')->orderBy('id_icons','desc')->get(); // get là lấy ra tất cả
       $output = '';
       $output .= '
       <table class="table">
       <thead>
         <tr>
           <th>Tên đối tác</th>
           <th>Hình ảnh đối tác</th>
           <th>Link đối tác</th>
           <th> Quản lý</th>
         </tr>
       </thead>
       <tbody>';
       foreach ($icons as $key => $ico){
        $output .= '   <tr>
           <td>'.$ico->name.'</td>
           <td><img src="'.url('public/upload/icons/'.$ico->image).'" height="100px" width="150px"></td>
           <td>'.$ico->link.'</td>
           <td><button id="'.$ico->id_icons.'" class="btn btn-warning" onclick="delete_doitac(this.id)">Xóa đối tác</button></td>
         </tr>';
        }
         $output .= ' </tbody>
     </table>
       
       
       ';  
       echo $output;      
    }
    public function delete_icons(request $request){
      $id  = $_GET['id'];
      $icons = icons::find($id);
      $icons->delete();
      //xóa bằng phương thức get


    }
    public function delete_doitac(request $request){
      $id  = $_GET['id'];
      $icons = icons::find($id);
      $icons->delete();
      //xóa bằng phương thức get


    }
    public function add_nut(request $request){
      $data = $request->all();
      $icons = new icons();
      $name = $data['name'];
      $link = $data['link'];
      $get_image = $request->file('file');

      $path = 'public/upload/icons/';

 
      if ($get_image) {

        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image)); 
$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
$get_image->move( $path,$new_image);
$icons->image = $new_image;     
}     

$icons->name = $name;     
$icons->link = $link; 
$icons->category = 'icons';  
$icons->save();

    }
    public function add_doitac(request $request){
      $data = $request->all();
      $icons = new icons();
      $name = $data['name'];
      $link = $data['link'];
      $get_image = $request->file('file');

      $path = 'public/upload/icons/';

 
      if ($get_image) {

        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image)); 
$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
$get_image->move( $path,$new_image);
$icons->image = $new_image;     
}     

$icons->name = $name;     
$icons->link = $link;  
$icons->category = 'doitac';  
$icons->save();

    }
 
}
