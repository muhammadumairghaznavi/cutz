@extends('layouts.app')
@section('title_page')
    @lang('site.careers')
    @php
    $page = 'careers';
    @endphp

@endsection
@section('content')

    <div class="breadcrumb-pages" style="background-image: url({{ url('/') }}/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block">@lang('site.careers')</strong>
        <ul>
            <li><a href="{{ route('home') }}">@lang('site.home')</a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href="{{ route('careers.index') }}">@lang('site.careers')</a></li>
        </ul>
    </div>
    <section class="page-contact pt-5 pb-5">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-contact">
                                @if (session('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('careers.store') }}" method="post"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @csrf

                                    {{ method_field('post') }}
                                    <div class="row">
                                        <div class="col-xl-6 form-group">
                                            <input name="fullname" type="text"
                                                class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                                placeholder="@lang('site.fullname')">
                                            @if ($errors->has('fullname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('fullname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-xl-6 form-group">
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="@lang('site.email')">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-xl-12 form-group">
                                            <input name="contact" value="{{ old('phone') }}" id=""
                                                placeholder=" @lang('site.phone')"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                placeholder="@lang('site.phone')">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-xl-12 form-group">
                                            <textarea name='comments'
                                                class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                placeholder=" @lang('site.message') ...">{{ old('message') }}</textarea>
                                            @if ($errors->has('message'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('message') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-xl-12 form-group">
                                            <label for="file">@lang('site.cvupload')</label>
                                            <input type="file" name='file'
                                                class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}">
                                            @if ($errors->has('file'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-xl-12 form-group">
                                            @if (config('services.recaptcha.key'))
                                                <div class="form-group">
                                                    <div class="g-recaptcha"
                                                        data-sitekey="{{ config('services.recaptcha.key') }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-xl-12 form-group">
                                            <input type="submit" class="btn btn-primary btn-block"
                                                value="@lang('site.send')">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
