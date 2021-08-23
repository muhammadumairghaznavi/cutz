@extends('layouts.app')
@section('title_page')
@lang('site.login')
@php
$page ='';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.login')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li><span> / </span></li>
        <li>@lang('site.login')</li>
    </ul>
</div>
<!-- //END => Breadcrumb -->
<!-- START => Page Signup -->
<section class="page-signup page-login pt-5 pb-5"
    style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-catgs.jpg);">
    <div class="container">
        <div class="signup-form">
            <div class="title text-center">
                <img src="{{ $setting->image_logo }}" class="img-fluid" alt="">
                <strong class="h1 d-block">@lang('site.Welcome Back')</strong>
                <p class="lead__txt">
                    {{-- @lang('site.Sign In to continue') --}}
                </p>
            </div>
            <form class="theme-form" action="{{route('customer.login.post')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @include('partials._errors')
                <div class="form-group">
                    <input type="email" name="email" required="required" class="" placeholder="@lang('site.email')">
                </div>
                <div class="form-group">
                    <input type="password" name="password" required="required" class="" placeholder="@lang('site.password')">
                </div>
                <div class="form-group text-center my-4"> <a href="">@lang('site.forget password')</a></div>
                <div class="form-group text-center">
                    <button class="btn-signup">@lang('site.login')</button>
                </div>
            </form>
            <hr>
            <div class="login-with-social text-center">
                <strong class="h6 d-block mb-3">@lang('site.Login With Social Media')</strong>
                <ul class="d-flex align-items-center justify-content-center">
                    <li><a href="{{url('customer/auth/redirect/facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{url('customer/auth/redirect/google')}}"><i class="fab fa-google"></i></a></li>
                </ul>
            </div>
            <hr>
            <div class="have-account text-center">
                <a href="{{route('register')}}" class="btn-started btn-create-new">@lang('site.Create Account')</a>
            </div>
        </div>
    </div>
</section>
<!-- //END => Page Signup -->
@endsection
