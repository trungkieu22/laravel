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
                   @foreach ($edit_category as $key => $edit_value)
                       
                
                  
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" data-validation="length" value="{{$edit_value->category_name}} " data-validation-length="min5" data-validation-error-msg="làm ơn điền ít nhất 5 ký tự" onkeyup="ChangeToSlug();" id="slug" name="category_product_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" id="convert_slug" placeholder="Tên danh mục">
                                </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Mô Tả Danh Mục</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="category_product_desc"   id="exampleInputPassword1" placeholder="Password"> {{$edit_value->category_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Từ khóa Danh Mục</label>
                            <textarea  data-validation="length" data-validation-length="min10" data-validation-error-msg="làm ơn điền ít nhất 10 ký tự"style="resize:none" rows="5" class="form-control" name="category_product_keywords" >{{$edit_value->meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc Danh Mục</label>
                            <select name="category_parent" class="form-control input-sm m-bot15">
                                <option value="0" >---------danh mục cha---------- </option>
                                @foreach ($category as $key =>$val)   {{-- đưa từ category_product qua --}}
                               
                                    @if ($val->category_parent==0)  {{-- lấy ra danh mục cha --}}
                                        
                                <option {{$val->category_id==$edit_value->category_id ? 'selected' : '' }}
                                 value="{{$val->category_id}}">{{$val->category_name}}</option>   {{-- hiển thị category id và tên --}}

                                @endif
                                @foreach ($category as $key =>$val2)   {{-- đưa từ category_product qua --}}
                                
                                @if ($val2->category_parent==$val->category_id)  {{--nếu như danh mục von bằng val2  --}}

                                <option {{$val2->category_id==$edit_value->category_id ? 'selected' : '' }}{{-- nếu điều kiện thì selected  không thôi sẽ rỗng --}}
                                     value="{{$val2->category_id}}">-----{{$val2->category_name}}</option>   


                                @endif
                                
                                 @endforeach
                                @endforeach

                            </select>
                        </div>
                     
                    
                        <button type="submit" name="add_category" class="btn btn-info">Cập nhật danh mục</button>
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