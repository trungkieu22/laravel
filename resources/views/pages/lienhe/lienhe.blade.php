@extends('layout')
@section('content_category')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Liên hệ</h2>
    <div class="row">
        @foreach ($contact as $key => $value)
            
        <div class="col-md-12">
            {!! $value->info_contact !!}
            {!! $value->info_fanpage !!}
            <!-- !! để chuyển html về chữ thường-->
        
   
            
        </div>
        <div class="col-md-12">
        <h2>Bản đồ</h2>
        {!! $value->info_map !!}

        </div>
    </div>
    @endforeach


</div><!--features_items-->



@endsection