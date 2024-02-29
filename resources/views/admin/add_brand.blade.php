@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
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
                        <form role="form" action="{{URL::to('save-brand-product')}}" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_product_name" class="form-control"onkeyup="ChangeToSlug();" id="slug" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="brand_slug" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả thương hiệu</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="brand_product_desc" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ân</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                    
                        <button type="submit" name="add_brand" class="btn btn-info">Thêm thương hiệu</button>
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
    @endsection