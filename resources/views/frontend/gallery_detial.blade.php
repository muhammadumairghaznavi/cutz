@extends('layouts.app')
@section('title_page')
{{$gallery->title}}
@php
$page='galleries';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">{{$gallery->title}}</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('galleries')}}">@lang('site.galleries')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="#">{{$gallery->title}}</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->


  <!-- START => Page gallery -->
  <section class="page-gallery-single py-5">
    <div class="container">
      <div class="row">
               @foreach ($galleries as $item)
        <div class="col-md-4">
          <div class="item-gallery">
            <a href="{{$item->link!=null? $item->link :$item->image_path}}" data-fancybox="{{$gallery->title}}">
              <img src="{{$item->image_path}}" class="img-fluid" alt="{{$gallery->title}}">
              <i class="fas fa-{{$item->link!=null? 'play':'search'}}"></i>
            </a>
          </div>
        </div>
       @endforeach
          {{ $galleries->appends(request()->query())->links() }}

      </div>
    </div>
  </section>
  <!-- //END => Page gallery -->
@endsection
