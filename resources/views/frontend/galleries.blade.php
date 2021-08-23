@extends('layouts.app')
@section('title_page')
@lang('site.galleries')
@php
$page='galleries';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.galleries')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('galleries')}}">@lang('site.galleries')</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->

  <!-- START => Page Galleries -->
  <section class="page-galleries py-5">
    <div class="container">
      <div class="row">
          @foreach ($galleries as $item)


        <div class="col-md-6">
          <div class="item-catgy-gallery">
            <a href="{{route('gallery_detial',['id'=>$item->id, 'slug'=>make_slug($item->title)])}}">
              <img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}">
              <strong>{{$item->title}}</strong>
            </a>
          </div>
        </div>
       @endforeach
               {{ $galleries->appends(request()->query())->links() }}
      </div>
    </div>
  </section>
  <!-- //END => Page Galleries -->

@endsection
