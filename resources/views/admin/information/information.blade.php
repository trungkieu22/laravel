@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thông tin liên hệ
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
                        @foreach ($contact as $key => $cont)
                            
                        <form role="form" action="{{URL::to('/capnhat/'.$cont->info_id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                      
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Thông tin liên hệ</label>
                            <textarea style="resize:none" rows="5"  class="form-control" name="info_contact" placeholder="mô tả danh mục">{{$cont->info_contact}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Map</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="info_map" placeholder="mô tả danh mục" >{{$cont->info_map}}</textarea>
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Fanpage</label>
                            <textarea style="resize:none" rows="5" class="form-control" name="info_fanpage" placeholder="">{{$cont->info_fanpage}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Logo hình ảnh</label>
                            <input type="file" name="info_image" class="form-control" id="exampleInputEmail1">
                            <img width="20%" src="{{url('/public/upload/contact/'.$cont->info_image)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Logo slogan</label>
                            <input type="text" name="slogan_logo" value="{{$cont->slogan_logo}}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <button type="submit" name="add_info" class="btn btn-info">Thêm thông tin</button>
                    </form>
                    @endforeach

                    </div>

                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thông tin mạng xã hội
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
                            
                        <form role="form" id="form-nut" enctype="multipart/form-data">
                            @csrf
                      
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tên nut</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Link </label>
                            <input type="text" name="link" id="link" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="info_image" class="form-control" id="image_nut">
                        </div>
                        <button type="submit" name="add_info" class="btn btn-info add-nut">Thêm nut</button>
                    </form>

                    </div>
                    <div class="position-center">
                        <div class="" id="list_nut"></div>
                    </div>

                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thông tin đối tác
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
                            
                        <form role="form" id="form-nut" enctype="multipart/form-data">
                            @csrf
                      
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Tên đối tác </label>
                            <input type="text" name="name" id="name_doitac" class="form-control">
                        </div>
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Link đối tác</label>
                            <input type="text" name="link" id="link_doitac" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh đối tác</label>
                            <input type="file" name="info_image" class="form-control" id="image_doitac">
                        </div>
                        <button type="submit" name="add_info" class="btn btn-info add-doitac">Thêm đối tác</button>
                    </form>

                    </div>
                    <div class="position-center">
                        <div class="" id="list_doitac"></div>
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
            CKEDITOR.replace('info_contact');
    </script>
    @endsection