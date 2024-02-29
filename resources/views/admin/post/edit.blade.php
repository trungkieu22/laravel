@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bài viết 
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
                        <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" value="{{$post->post_title}}" class="form-control"onkeyup="ChangeToSlug();" id="slug" placeholder="Enter email">
                        </div>
                      
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" value="{{$post->post_slug}}" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tóm Tắt Bài Viết</label>
                            <textarea style="resize:none" rows="8" class="form-control" name="post_desc" placeholder="mô tả danh mục"  >{{$post->post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize:none" rows="8" class="form-control" name="post_content" placeholder="mô tả danh mục"  >{{$post->post_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">meta từ khóa</label>
                            <textarea style="resize:none" rows="3" class="form-control" name="post_meta_keywords" placeholder="mô tả danh mục" >{{$post->post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">meta nội dung</label>
                            <textarea style="resize:none" rows="3" class="form-control" name="post_meta_desc" placeholder="mô tả danh mục" >{{$post->post_meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Bài Viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('public/upload/post/'.$post->post_image)}}" height=100 width="100">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh Mục Bài Viết</label>
                           
                            <select name="cate_post_id" class="form-control input-sm m-bot15">

                    @foreach ($cate_post as $key => $cate)
                        
                 
                                <option {{ $cate->cate_post_id == $post->cate_post_id ? 'selected' : '' }}
                                 value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
               @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                            @if ($post->post_status==0)
                                
                          
                                <option selected value="0">hiện thị</option>
                                <option value="1">ẩn</option>
                            @else    
                                <option value="0">hiển thị</option>
                                <option selected value="1">ẩn</option>
                                @endif
                            </select>
                        </div>
                    
                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật bài viết</button>
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