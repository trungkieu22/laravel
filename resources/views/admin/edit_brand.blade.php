@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Liệt Kê Danh Mục Sản Phẩm
                </header>
                <?php
                $message = session()->get('message');
                if($message){
                    echo '<span class="chau">' .$message. '</span>';
                    session()->put('message',null);
                }
                ?>
                <div class="panel-body">
                   @foreach ($edit_brand as $key => $edit_value)
                       
                
                  
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_product_name" value="{{$edit_value->brand_name}}" class="form-control"onkeyup="ChangeToSlug();" id="slug" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="brand_slug" class="form-control" value="{{$edit_value->brand_slug}}" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả Danh Mục</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="brand_product_desc"   id="exampleInputPassword1" placeholder="Password">{{$edit_value->brand_desc}}</textarea>
                        </div>
                     
                    
                        <button type="submit" name="add_brand" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    </div>
                  @endforeach
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
    
    @endsection