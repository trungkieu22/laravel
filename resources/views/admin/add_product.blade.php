@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <?php
                    $message = session()->get('message');
                    if($message){
                        echo '<span class="chau">' .$message. '</span>';
                        session()->put('message',null);
                    }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('save-product')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" name="product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" >  
                        </div>
                        
                            <div class="form-group">
                            <label for="exampleInputEmail1">số lượng</label>
                            <input type="text"  data-validation="number" data-validation-error-msg="làm ơn điền số lượng vào"  name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter email" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục" >
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file"  name="product_image" class="form-control" id="exampleInputEmail1" >
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" name="product_price" class="form-control price_format" >
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Giá Gốc</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự" name="product_cost"  class="form-control price_format">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả sản phẩm</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_desc" placeholder="mô tả sản phẩm"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Nội Dung sản phẩm</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="product_content" placeholder="Nội Dung Sản Phẩm"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                       
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tags sản phẩm</label>
                            <input type="text" data-role="tagsinput" name="product_tags" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục sản Phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                <option value="">------Chọn danh mục-----</option>
                                @foreach ($cate_product as $key => $cate)
                                @if ($cate->category_parent==0)
                                    
                            
                                <option style="font-size: 15px" value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                               @foreach ($cate_product as $key => $cate_sub)
                               @if ($cate_sub->category_parent!=0 && $cate_sub->category_parent==$cate->category_id)
                               <option style="color: blue" value="{{$cate_sub->category_id}}">{{$cate_sub->category_name}}</option>

                               @endif
                                   
                               @endforeach

                                @endif
                                @endforeach
                                 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">thương hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                <option value="">---Chọn thương hiệus----</option>
                                @foreach ($brand_product as $key => $brand) 
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                    
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
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