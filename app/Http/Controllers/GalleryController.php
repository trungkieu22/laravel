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
use Illuminate\Contracts\View\View;
use Svg\Tag\Rect;
use Symfony\Component\Console\Output\Output;

class GalleryController extends Controller
{
    public function Authlogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return redirect::to('doashboard');
        }else{
    
            return redirect::to('admin')->send();  //dùng để kiểm tra đã đăng nhập vào acc min hay chưa
        }
       }


       public function add_gallery($product_id){
        $pro_id = $product_id;


        return View('admin.gallery.add_gallery')->with(compact('pro_id'));

       }
       public function insert_gallery($pro_id , Request $request) {
        $get_image = $request->file('file');  // lấy từ file tên là file
        if($get_image){
            foreach($get_image as $key => $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image)); 
                $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('public/upload/gallery', $new_image);
                
                $gallery = new Gallery();
                $gallery->gallery_name = $name_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        
        session()->put('message', 'Thêm Thư Viện ảnh Thành Công');
        return back();
    }

    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
    
        $gallery = Gallery::find($gal_id);
    
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    
    }


       public function select_gallery(Request $request){
        $product_id =  $request->pro_id;
        $gallery  = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '     <form>
           '.csrf_field().'
            <table class="table table-hover">
            <thead>
              <tr>
                <th>Số thứ tự</th>
                <th>Tên hình ảnh</th>
                <th>Hình ảnh</th>
                <th>Quản lý</th>
              </tr>
            </thead>
            <tbody>';
    
        if($gallery_count > 0){
            $i = 0;
            foreach($gallery as $key => $gal){
                $i++;
                $output .= '
            
                <tr>
                    <td>'.$i.'</td>
                    <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                    <td>
                    <img src="'.url('public/upload/gallery/' .$gal->gallery_image).'" class="img-thumbnail" width="100px" heght="100px">
                    <input type="file" class="file_image" style="width:40%" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" name="file" accept="image/*">
                    </td>
                    <td><button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-xn btn-danger delete-gallery">Xóa</button></td>
                </tr>
           ';
           }
        } else {
            $output .= '
            <tr>
                <td colspan="4">Sản phẩm chưa có ảnh</td>
            </tr>';
        }
    
        $output .= '</tbody>
        </table>
        </form>';
    
        return $output;
    }
  public function update_gallery(Request $request){
    $get_image = $request->file('file');  // lấy từ file tên là file
    $gal_id  = $request->gal_id; //
    if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image)); 
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/upload/gallery', $new_image);
            
            $gallery = Gallery::find($gal_id );
            unlink('public/upload/gallery/'.$gallery->gallery_image);
            $gallery->gallery_image = $new_image;
        
            $gallery->save();
        
    }
 
  }

    public function deleted_gallery(Request $request){

        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/upload/gallery/'.$gallery->gallery_image);
        $gallery->delete();


    }
    
    }
