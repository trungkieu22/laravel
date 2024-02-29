@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản Phẩm
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
                        <form role="form" action="{{URL::to('save-category-product')}}" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="làm ơn điền ít nhất 5 ký tự" onkeyup="ChangeToSlug();" id="slug" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug_category_product" class="form-control" id="convert_slug" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả Danh Mục</label>
                            <textarea  data-validation="length" data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự"style="resize:none" rows="5" class="form-control" name="category_product_desc" placeholder="mô tả danh mục"  id="exampleInputPassword1" placeholder="Password"></textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Từ khóa Danh Mục</label>
                            <textarea  data-validation="length" data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự"style="resize:none" rows="5" class="form-control" name="category_product_keywords" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc Danh Mục</label>
                            <select name="category_parent" class="form-control input-sm m-bot15">
                                <option value="0" >---danh mục cha--- </option>
                                @foreach ($category as $key =>$val )   {{-- đưa từ category_product qua --}}
                               
                                    
                                <option value="{{$val->category_id}}">{{$val->category_name}}</option>            {{-- hiển thị category id và name --}}


                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ân </option>
                            </select>
                        </div>
                    
                        <button type="submit" name="add_category" class="btn btn-info">Thêm danh mục</button>
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