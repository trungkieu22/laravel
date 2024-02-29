<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function manage_slider(){
        $all_slide = Banner::orderby('slider_id','desc')->paginate(5);
        return view('admin.banner.banner')->with(compact('all_slide'));
    }
    public function add_slider(){
        return view('admin.banner.add_banner');
    }
    public function insert_slider(Request $request){
        $data = $request->all();
        $this->Authlogin();
        $get_image = $request->file('slider_image');
   
        if ($get_image) {
          $get_name_image = $get_image->getClientOriginalName();
          $name_image = current(explode('.',$get_name_image)); 
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

         $get_image->move('public/upload/slider',$new_image);


$slider = new Banner();
 $slider->slider_name = $data['slider_name'];
 $slider->slider_image=  $new_image;
 $slider->slider_status= $data['slider_status'];
 $slider->slider_desc= $data['slider_desc'];
 $slider->save();
          $request->session()->put('message','Thêm Sản slider Thành Công');
          return Redirect::to('/add-slider');
        }else{           
    $request->session()->put('message','làm ơn thêm hình ảnh đi nha');
    return Redirect::to('/add-slider');
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
       public function active_slide($slider_id){
        $this->Authlogin();

        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        session()->put('message','Ẩn banner Thành Công');
          return Redirect::to('/manage-slider');
      
          // $request->session()->p
      }
      public function unactive_slide($slider_id){
        $this->Authlogin();

       DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
       session()->put('message','Kích Hoạt banner Thành Công');
       return Redirect::to('/manage-slider');
      
      
      
      
      }
      public function detele_slider($slider_id){
        $this->Authlogin();

        DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
        session()->put('message','Xóa Banner Thành Công');
        return Redirect::to('/manage-slider');
      }
        
 
}
