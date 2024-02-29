@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục bài viết
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
                        <form role="form" action="{{URL::to('save-category-post')}}" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="cate_post_name" class="form-control"onkeyup="ChangeToSlug();" id="slug" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="cate_post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả danh mục</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="cate_post_desc" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ân</option>
                            </select>
                        </div>
                    
                        <button type="submit" name="add_post_cate" class="btn btn-info">Thêm danh mục bài viết</button>
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