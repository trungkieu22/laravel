@extends('layout')
@section('content_category')
<div class="features_items"><!--features_items-->

    <h2 class="title text-center">{{$meta_title}}</h2>

    <div class="product-image-wrapper" style="border: none">
        @foreach($post as $key => $p)
        <div class="single-products" style="margin:10px 0;padding:2px">
                <div class="text-center ">
    
                    <img style="float:left;width:307px;height: 169px;" src="{{asset('public/upload/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" />

                    <h4 style="padding:5px;font-size:21px">{{$p->post_title}}</h4>          
         <p>{!!$p->post_desc!!}</p>
                </div>
                <div class="text-right">
                    <a href="{{url('bai-viet/'.$p->post_slug)}}" class="btn btn-default btn-sm">xem bài viết </a>
                </div>
              
        </div>
      </div>
   
 <div class="clearfix"></div>
        @endforeach
</div><!--features_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!! $post->links() !!}
  </ul>




@endsection