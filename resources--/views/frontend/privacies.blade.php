@extends('layouts.app')
@section('title_page')
@lang('site.privacies')
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">Terms </strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a>Terms </a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->
<!-- START => About Us -->
<section class="sec-about py-3">
    <div class="container container-bg">
                <div class="about-txt">
                    <strong class="h1 d-block text-center">{{$item->title}}</strong>
                    <p class="m-0">
                        {!!$item->description!!}
                    </p>
                 </div>
       {{-- <div class="row align-items-center  ">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="about-img">
                    <img src="{{$item->image_path}}" class="img-fluid" alt="">

                </div>
            </div>
        </div> --}}
    </div>
</section>
<!-- //END => About Us -->
@endsection
