@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục bài viết
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
                        <form role="form" action="{{URL::to('/update-category-post/'.$category_post->cate_post_id)}}" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$category_post->cate_post_name}}" name="cate_post_name" class="form-control"onkeyup="ChangeToSlug();" id="slug" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="cate_post_slug"  value="{{$category_post->cate_post_slug}}" class="form-control" id="convert_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả danh mục</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="cate_post_desc" placeholder="mô tả danh mục" placeholder="Password">{{$category_post->cate_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
               @if ($category_post->cate_post_status == 0)

                                <option selected value="0">Hiển thị</option>           {{-- hiện thị  được chọn selected --}}
                                <option value="1">Ân</option>
                @else
                <option value="0">Hiển thị</option>           {{-- hiện thị  được chọn selected --}}
                <option selected  value="1">Ân</option>


                @endif
                            </select>
                        </div>
                    
                        <button type="submit" name="update_post_cate" class="btn btn-info">Cập nhật danh mục bài viết</button>
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