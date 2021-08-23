@extends('layouts.app')
@section('title_page')
@lang('site.register')
@php
$page ='';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.register')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li><span> / </span></li>
        <li>@lang('site.register')</li>
    </ul>
</div>
<!-- //END => Breadcrumb -->
<!-- START => Page Signup -->
<section class="page-signup pt-5 pb-5" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-catgs.jpg);">
    <div class="container">
        <div class="signup-form">
            <div class="title text-center">
                <strong class="h1 d-block">@lang('site.register')</strong>
                <p class="lead__txt"> </p>
            </div>
            <form class="theme-form" action="{{route('customer.register.post')}}" method="post" enctype="multipart/form-data">

                @csrf
                @include('partials._errors')

                <div class=" form-group">
                    <input type="text" name="full_name" value="{{old('full_name')}}" class=""
                        placeholder="{{__('site.name')}}" required>
                </div>
                <div class=" form-group">
                    <input type="text" name="email" value="{{old('email')}}" class=""
                        placeholder="{{__('site.email')}}" required>
                </div>
                <div class=" form-group">
                    <input type="text" name="phone" value="{{old('phone')}}" class=""
                        placeholder="{{__('site.phone')}}"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                        required>
                </div>
                <div class=" form-group">
                    <select class="" name="gender" required>
                        <option value="">@lang('site.gender')</option>
                        <option value="male" {!! old("gender")=="male" ? 'selected' : '' !!}> {{__('site.male')}}
                        </option>
                        <option value="female" {!! old("gender")=="female" ? 'selected' : '' !!}>
                            {{__('site.female')}}</option>
                    </select>
                </div>
                <div class=" form-group">
                    <input type="password" name="password" class="" placeholder="{{__('site.password')}}" required>
                </div>
                <div class=" form-group">
                    <input type="password" name="password_confirmation" class="" placeholder="{{__('site.password_confirmation')}}" required>
                </div>
                <div class="form-group text-center my-4">
                    <div class="custom-control custom-checkbox border-0">
                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                        <label class="custom-control-label" for="customCheck3">
                            I agree to CUTZ, <a href="{{ route('privacies') }}"
                             target="_blank">Terms and services</a>, and <a href="{{ route('polices') }}" target="_blank">Privacy policy</a>.
                            <!--and <a href="" target="_blank">Content policy-->
                            </a>
                        </label>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn-signup">@lang('site.create Account')</button>
                </div>
            </form>
            <hr>
            <div class="have-account text-center">
                <a href="{{route('customer.login')}}">@lang('site.Already registered? Log in')</a>
            </div>
        </div>
    </div>
</section>
<!-- //END => Page Signup -->
@endsection
