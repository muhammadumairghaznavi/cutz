@extends('layouts.app')
@section('title_page')
@lang('site.profile')
@php
$page='';
$profile_bar='profile';
$profile_page='Change_password';
@endphp
@endsection
@section('content')
<!-- START => Page Profile -->
<section class="page-profile py-5">
    <div class="container">
        <div class="profile-blocks">
            @include('partials.profile._profile_bar')
            <hr>
            <div class="row pt-2">
                <div class="col-lg-12 align-self-center">
                    <div class="box-profile profile-details">
                        <div class="title-box-profile">
                            <strong class="h3 d-block">@lang('site.Change_password')</strong>
                        </div>
                        <hr>

                        <form action="{{route('customer.profile.password.edit', authCustomer()->id)}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @include('partials._errors')
                            <div class="login-info">
                                <!-- <div class="title">
                                    <strong>(@lang('site.Login Info'))</strong>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">@lang('site.email')</label>
                                            <input type="email" class="input-control" required="required" readonly
                                                placeholder="@lang('site.email')" value="{{authCustomer()->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">@lang('site.old_password')</label>
                                            <input type="password" class="input-control" required="required"
                                                name="old_password" placeholder="@lang('site.old_password')">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">@lang('site.new_password')</label>
                                            <input type="password" class="input-control" required="required"
                                                name="password" placeholder="@lang('site.new_password')">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">@lang('site.confirm_password')</label>
                                            <input type="password" class="input-control" required="required"
                                                name="confirm_password" placeholder="@lang('site.confirm_password')">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                          <div class="form-group mt-4">
                                            <input type="submit" class="btn-filter" value="@lang('site.save changes')">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>


            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!-- //END => Page Profile -->

@endsection
