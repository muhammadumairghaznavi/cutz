@extends('layouts.app')
@section('title_page')
@lang('site.abouts')
@php
$page='abouts';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.abouts')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('about')}}">@lang('site.abouts')</a></li>
    </ul>
</div>


<!-- //END => Breadcrumb -->
<!-- START => Page About Us -->
<section class="sec-about pt-5 pb-5">
    <div class="container">
        <div class="block-vision block-mission pt-3">
            @foreach ($abouts as $key=>$item)
            <div class="row   {{$key%2==0?' align-items-center py-3 ':'align-items-center py-3 flex-row-reverse'}}">
                <div class="col-md-6  wow   {{$key%2==0?' fadeInLeft ':'fadeInRight'}} ">
                    <div class="img-block">
                        <img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}">
                        @if($item->link)
                        <a href="{{$item->link}}" class="btn-play-vid" data-fancybox>
                            <i class="fas fa-play"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 wow {{$key%2==0?'fadeInRight  ':'fadeInLeft'}} ">
                    <div class="txt text-center">

                        @if($key==0)
                        <strong class="h2 d-block font-weight-bold title_color">About CUT<span>Z</span></strong>
                        @else
                         <strong class="h2 d-block font-weight-bold">{{$item->title}}</strong>
                        @endif
                        <p class="lead__txt">
                            {!!$item->description!!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mb-5">
            @if($setting->link_download)
            <a href="{{$setting->link_download}}"  target="_blank" class="btn-menu"><i class="fas fa-lg fa-file-download mx-2"></i> @lang('site.Download Menu') </a>
            @endif
        </div>
        <!-- <hr> -->
        <div class="clients-block pt-5">
            <div class="sec-title text-center mb-4">
                <strong class="title h1 d-block">@lang('site.parteners')</strong>
            </div>
            <div class="d-flex align-items-center justify-content-center flex-wrap">
                @foreach ($parteners as $item)
                <div class="img-client">
                    <img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- //END => Page About Us -->
@endsection
