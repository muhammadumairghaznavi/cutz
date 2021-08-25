@extends('layouts.app')
@section('title_page')
 
@lang('site.'.$type)
@php
$page='';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.'.$type)</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="">@lang('site.'.$type)</a></li>
    </ul>
</div>

<!-- START => Certifications -->
  <section class="page-certifications py-5">
    <div class="container">

      <div class="items">
        @foreach ($pages as $item)

        <div class="item-certifications">
          <div class="row">
            <!--<div class="col-md-4">
            @if($item->link)
                <a data-fancybox class="a_vid" href="{{$item->link}}">
                 <img src="{{$item->image_path}}" class="img-fluid" alt="image">
                <i class="fas fa-play"></i>
              </a>
              @else
              <div class="img">
                <img src="{{$item->image_path}}" class="img-fluid" alt="image">
              </div>
              @endif
            </div>-->
            <div class="col-md-12">
              <div class="text-center">
                <h1>{{$item->title}}</h1>
                <p class="lead">
                    {!!$item->description!!}

                </p>
                @if ($item->file)

                <div class="item-exam mt-4">
                  <div class="item-of-exam m-0">
                    <a href="{{$item->file_path}}">
                      <i class="far fa-file-pdf fa-2x"></i>
                      <strong> <img src="{{$item->file_path}}" alt=""> {{$item->title}}</strong>
                      <i class="fas fa-cloud-download-alt fa-lg"></i>
                    </a>
                  </div>
                </div>

                @endif

              </div>
            </div>
          </div>
        </div>
        @endforeach




      </div>

    </div>
  </section>
  <!-- //END => Certifications -->





@endsection
