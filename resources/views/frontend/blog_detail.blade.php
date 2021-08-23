@extends('layouts.app')
@section('title_page')
{{$blog->title}}
@php
$page='blogs';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.useful_information')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('blogs')}}">@lang('site.useful_information')</a></li>
         <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a  >{{$blog->title}}</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->

  <!-- START => Page Blogs Single -->
  <section class="page-blog-single pt-5 pb-5">
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-sm-12 order-1">
          <div class="blogs-Details">

            <div class="title-blog">
              <strong class="h3 d-block">{{$blog->title}}</strong>
              <span class="date h6 d-block"> {{date_format(date_create($blog->date), 'Y M d') }} </span>
              <hr>
            </div>

            <div class="img-blog-single">
              <img src="{{$blog->image_path}}" class="img-fluid" alt="{{$blog->title}}">
            </div>

            <div class="blog-txt px-2 py-4">
              <p class="lead__txt">
                {!!$blog->description!!}
                </p>

            </div>

          </div>

        </div>
        <div class="col-md-4 col-sm-12 order-lg-2 order-md-2 order-3">
          <div class="sidebar-latest-blog">
            <strong class="title-latest-blog">@lang('site.read more')</strong>
            <div class="items">
                @foreach ($blogs as $item)


              <div class="item-latest-blog">
                <a href="{{route('blogs.details',['id'=>$item->id , 'slug'=>make_slug($item->title)])}}" class="">
                  <div class="img"><img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}"></div>
                  <div class="txt">
                    <span class="title h5 d-block">{{$item->title}}</span>
                    <span class="date h6 d-block"> {{date_format(date_create($blog->date), 'Y M d') }} </span>
                  </div>
                </a>
              </div>
@endforeach
            </div>
          </div>
        </div>


      </div>

    </div>
  </section>
  <!-- //END => Page Blogs Single -->

@endsection
