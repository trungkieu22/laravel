@extends('layout')
@section('content_category')
<div class="features_items"><!--features_items-->

    <h2 class="title text-center">{{$meta_title}}</h2>

    <div class="product-image-wrapper" style="border: none">
        @foreach($post as $key => $p)
        {!! $p->post_content    !!}
   
 <div class="clearfix"></div>
        @endforeach
</div><!--features_items-->
<h2 class="title text-center">Bài viết liên quan</h2>
<ul class="post-relate">
    @foreach ($related as $key => $post_relate)
        
    <img style="float:left;width:194px;height:118px;
        float: left;
        width: 131px;
        height: 84px;
        margin-left: 2px;
        margin-top: 66px;" src="{{asset('public/upload/post/'.$post_relate->post_image)}}" alt="{{$post_relate->post_slug}}" />
    <li><a style="   margin: 31px; " href="{{url('bai-viet/'.$post_relate->post_slug)}}">{{$post_relate->post_title}}</a></li>

    @endforeach
</ul>


<style>
    ul.post-relate li {
    list-style-type: unset;
    padding: 64px;
    font-size: 17px;
}
ul.post-relate li a {
 color: black;
}
ul.post-relate li a:hover {
 color: blue ;
 margin: 24px
}
.product-image-wrapper {
    border: 1px solid #F7F7F5;
    overflow: hidden;
    margin-bottom: 33px;
}
</style>

@endsection