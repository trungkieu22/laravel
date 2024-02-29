@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập Nhật sản phẩm
                </header>
                <div class="panel-body">
                    <?php
                    $message = session()->get('message');
                    if($message){
                        echo '<span class="chau">' .$message. '</span>';
                        session()->put('message',null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                            
                        
                        <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input value="{{$pro->product_name}}" type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug">  
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">số lượng</label>
                            <input type="text"   name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$pro->product_quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$pro->product_slug}}" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height=100 width="100">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control price_format" id="exampleInputEmail1" value="{{$pro->product_price}}">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Giá Gốc</label>
                            <input type="text" name="product_cost" class="form-control price_format" id="exampleInputEmail1" value="{{$pro->product_cost}}">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả sản phẩm</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_desc"   id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Nội Dung sản phẩm</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_content"   id="exampleInputPassword1" >{{$pro->product_content}}</textarea>
                        </div>
                      
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tags sản phẩm</label>
                            <input type="text" data-role="tagsinput" value="{{$pro->product_tags}}" name="product_tags" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục sản Phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $key => $cate)
                                  
                                @if ($cate->category_id == $pro->category_id)
                                   
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                  @else
                                  <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
    
                                @endif
                                @endforeach
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">thương hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $key => $brand)  
                               @if ($cate->category_id == $pro->category_id)
                                   
                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                              @else
                              <option  value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>

                            @endif
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ân</option>
                            </select>
                        </div>
                    
                        <button type="submit" name="add_product" class="btn btn-info"> Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
    <style>
        	span.chau {
    color: blueviolet;
    font-size: 17px;
    width: 100%;
    text-align: center;
}
    </style>
         <script>
            CKEDITOR.replace( 'product_desc' );
            CKEDITOR.replace( 'product_content' );
    </script>
    <script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}">
    @endsection