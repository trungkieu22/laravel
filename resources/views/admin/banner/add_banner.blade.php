@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm banner
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
                        <form role="form" action="{{URL::to('insert-slider')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên slider</label>
                            <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả slider</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="slider_desc" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị slider</label>
                            <select name="slider_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">ẩn</option>
                            </select>
                        </div>
                    
                        <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
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