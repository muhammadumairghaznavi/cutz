@extends('layouts.app')
@section('title_page')
@lang('site.useful_information')
@php
$page=$page;
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.'.$page)</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('blogs')}}">@lang('site.'.$page)</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->


<!-- START => Page Blogs -->
<section class="page-blogs pt-5 pb-5">
    <div class="container">

        <div class="blogs-items">
          @foreach ($blogs as $item)
          <div class="item-blog">
              <div class="row">
                <div class="col-md-3">
                  <a href="{{route('blogs.details',['id'=>$item->id , 'slug'=>make_slug($item->title)])}}" class="img-blog">
                      <img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}">
                  </a>
                </div>
              <div class="col-md-9">
                <div class="info-blog p-3">
                    <a href="{{route('blogs.details',['id'=>$item->id , 'slug'=>make_slug($item->title)])}}" class="h4 d-block">{{$item->title}}</a>
                    <span class="date h6 d-block"> {{date_format(date_create($item->date), 'Y M d') }} </span>
                    <p class="lead__txt">
                    {{substr($item->short_description,0,493)}}...
                    </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach

          {{ $blogs->appends(request()->query())->links() }}
        </div>

    </div>
</section>
<!-- //END => Page Blogs -->

@endsection
