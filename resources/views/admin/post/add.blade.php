@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm bài viết 
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
                        <form role="form" action="{{URL::to('save-post')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" class="form-control"onkeyup="ChangeToSlug();" id="slug" placeholder="Enter email">
                        </div>
                      
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tóm Tắt Bài Viết</label>
                            <textarea style="resize:none" data-validation="length" data-validation-length="min20" data-validation-error-msg="làm ơn điền ít nhất 20 ký tự" rows="8" class="form-control" name="post_desc" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize:none" rows="8" class="form-control" name="post_content" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">meta từ khóa</label>
                            <textarea style="resize:none" rows="3" class="form-control" name="post_meta_keywords" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">meta nội dung</label>
                            <textarea style="resize:none"data-validation="length" data-validation-length="min20" data-validation-error-msg="làm ơn điền ít nhất 20 ký tự" rows="3" class="form-control" name="post_meta_desc" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Bài Viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Bài Viết</label>
                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                    @foreach ($cate_post as $key => $cate)
                        
                 
                                <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
               @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">ẩn</option>
                            </select>
                        </div>
                    
                        <button type="submit" name="add_brand" class="btn btn-info">Thêm bài viết</button>
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
            CKEDITOR.replace( 'post_desc' );
            CKEDITOR.replace( 'post_content' );
    </script>
    @endsection