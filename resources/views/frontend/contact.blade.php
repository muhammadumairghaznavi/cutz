@extends('layouts.app')
@section('title_page')
@lang('site.contact')
@php
$page='contact';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.contact')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('about')}}">@lang('site.contact')</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->
<!-- START => Page Contact Us -->
<section class="page-contact pt-5 pb-5">
    <div class="container">
        <div class="info-contact">
            <div class="row">
                <div class="col-md-3">
                    <div class="item text-center py-4 px-2">
                        <i class="fas fa-map-marked-alt fa-3x d-block"></i>
                        <strong class="d-block h5 my-3">@lang('site.address')</strong>
                        <p class="m-0 lead__txt">{!!$setting->address!!}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item text-center py-4 px-2">
                        <i class="fas fa-headset fa-3x d-block"></i>
                        <strong class="d-block h5 my-3">@lang('site.Call Us')</strong>
                        <p class="m-0 lead__txt">{{$setting->num1}}</p>
                        <p class="m-0 lead__txt">{{$setting->num2}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item text-center py-4 px-2">
                        <i class="fas fa-envelope-open-text fa-3x d-block"></i>
                        <strong class="d-block h5 my-3">@lang('site.email')</strong>
                        <p class="m-0 lead__txt">{{$setting->email}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item text-center py-4 px-2">
                        <i class="far fa-clock fa-3x d-block"></i>
                        <strong class="d-block h5 my-3"> @lang('site.worktimes')</strong>
                        <p class="m-0 lead__txt">{!!$setting->working_hours!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row align-items-center">
            <div class="col-md-6">
                <ul class="nav nav-tabs justify-content-around" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title text-uppercase active" id="home-tab" data-toggle="tab" href="#home"
                            role="tab" aria-controls="home" aria-selected="true">@lang('site.SEND YOUR MESSAGE')</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title text-uppercase" id="profile-tab" data-toggle="tab" href="#profile"
                            role="tab" aria-controls="profile" aria-selected="false"> @lang('site.request catering')</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title text-uppercase" id="wholesale-tab" data-toggle="tab" href="#wholesale"
                            role="tab" aria-controls="wholesale" aria-selected="false"> @lang('site.wholesale')</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-contact">
                            @if (session('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{route('contact')}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="row">
                                    <div class="col-xl-6 form-group">
                                        <input name="type" value="inbox" type="hidden">
                                        <input name="name" value="{{old('name')}}" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.name')">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-6 form-group">
                                        <input type="email" name="email" value="{{old('email')}}"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.email')">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <input name="phone" value="{{old('phone')}}" id=""
                                            placeholder=" @lang('site.phone')"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.email')">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <textarea name='message'
                                            class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                            placeholder=" @lang('site.message') ...">{{old('message')}}</textarea>
                                        @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <label>@lang('site.Im_Not_a_Robot')</label>
                                        <div class="chk-captcha">
                                            <img src="{{ url('/') }}/frontend/assets/imgs/recaptcha-icon.png" alt="recaptcha">
                                          <strong class="num-captcha">
                                            {{$num1}} + {{$num2}} =
                                          </strong>
                                          <div>
                                            <input name="num1" hidden value="{{$num1}}" type="text" class="form-control">
                                            <input name="num2" hidden value="{{$num2}}" type="text" class="form-control">
                                            <input name="result" value="" type="text"
                                                class="form-control {{ $errors->has('result') ? ' is-invalid' : '' }}">
                                            @if ($errors->has('result'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('result') }}</strong>
                                            </span>
                                            @endif
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <input type="submit" class="btn btn-primary btn-block" value="@lang('site.send')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="form-contact">
                            @if (session('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{route('contact')}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="row">
                                    <div class="col-xl-6 form-group">
                                        <input name="type" value="catering" type="hidden">
                                        <input name="name" value="{{old('name')}}" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.name')">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-6 form-group">
                                        <input type="email" name="email" value="{{old('email')}}"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.email')">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <input name="phone" value="{{old('phone')}}" id=""
                                            placeholder=" @lang('site.phone')"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.email')">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <textarea name='message'
                                            class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                            placeholder=" @lang('site.message') ...">{{old('message')}}</textarea>
                                        @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12 text-center">
                                      <label>@lang('site.Im_Not_a_Robot')</label>
                                      <div class="chk-captcha">
                                            <img src="{{ url('/') }}/frontend/assets/imgs/recaptcha-icon.png" alt="recaptcha">
                                        <strong class="num-captcha">
                                          {{$num1}} + {{$num2}} =
                                        </strong>
                                        <div>
                                          <input name="num1" hidden value="{{$num1}}" type="text" class="form-control">
                                          <input name="num2" hidden value="{{$num2}}" type="text" class="form-control">
                                          <input name="result" value="" type="text"
                                              class="form-control {{ $errors->has('result') ? ' is-invalid' : '' }}">
                                          @if ($errors->has('result'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('result') }}</strong>
                                          </span>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <input type="submit" class="btn btn-primary btn-block" value="@lang('site.send')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="wholesale" role="tabpanel" aria-labelledby="wholesale-tab">
                        <div class="form-contact">
                            @if (session('success'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{route('contact')}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <div class="row">
                                    <div class="col-xl-6 form-group">
                                        <input name="type" value="wholesale" type="hidden">
                                        <!-- wholesale -->
                                        <input name="name" value="{{old('name')}}" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.name')">
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-6 form-group">
                                        <input type="email" name="email" value="{{old('email')}}"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.email')">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <input name="phone" value="{{old('phone')}}" id=""
                                            placeholder=" @lang('site.phone')"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            placeholder="@lang('site.email')">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <textarea name='message'
                                            class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                            placeholder=" @lang('site.message') ...">{{old('message')}}</textarea>
                                        @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-12 text-center">
                                      <label>@lang('site.Im_Not_a_Robot')</label>
                                      <div class="chk-captcha">
                                            <img src="{{ url('/') }}/frontend/assets/imgs/recaptcha-icon.png" alt="recaptcha">
                                        <strong class="num-captcha">
                                            {{$num1}} + {{$num2}} =
                                        </strong>
                                        <div>
                                          <input name="num1" hidden value="{{$num1}}" type="text" class="form-control">
                                          <input name="num2" hidden value="{{$num2}}" type="text" class="form-control">
                                          <input name="result" value="" type="text"
                                              class="form-control {{ $errors->has('result') ? ' is-invalid' : '' }}">
                                          @if ($errors->has('result'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('result') }}</strong>
                                          </span>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xl-12 form-group">
                                        <input type="submit" class="btn btn-primary btn-block" value="@lang('site.send')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
            <div class="col-md-6">
                <div class="map">
                        <?=$setting->map?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //END => Page Contact Us -->


@endsection
