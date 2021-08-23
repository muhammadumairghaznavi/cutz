@extends('layouts.app')
@section('title_page')
@lang('site.profile')
@php
$page='';
$profile_bar='profile';
$profile_page='profile';
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
                            <strong class="h3 d-block">@lang('site.Basic Info')</strong>
                        </div>
                        <hr>
                        <form action="{{route('customer.profile.edit', authCustomer()->id)}}" class="pt-4" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @include('partials._errors')
                            <div class="basic-info">

                                <div class="row">
                                    {{-- <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">@lang('site.User Profile Image')</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                    id="customFileLangHTML">
                                                <label class="custom-file-label" for="customFileLangHTML"
                                                    data-browse="Upload Image">Upload Image</label>
                                            </div>
                                                <img src="{{authCustomer()->image_path}}" class="img-fluid" alt="" width="10">
                                        </div>
                                    </div> --}}


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">@lang('site.full_name')</label>
                                            <input type="text" name="full_name" required="required" class="input-control"
                                                placeholder="@lang('site.full_name')"
                                                value="{{authCustomer()->full_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">@lang('site.phone')</label>
                                            <input type="text" name="phone" required="required" class="input-control"
                                                placeholder="@lang('site.phone')" value="{{authCustomer()->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">@lang('site.gender')</label>
                                            <div class="input-group mt-2">
                                                <div class="custom-control custom-radio w-25">
                                                    <input type="radio" id="customRadio1" {{authCustomer()->gender=='male' ?'checked' :''}} name="gender"
                                                        value="male" class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="customRadio1">@lang('site.male')</label>
                                                </div>
                                                <div class="custom-control custom-radio w-25">
                                                    <input type="radio" id="customRadio2"
                                                        {{authCustomer()->gender=='female' ?'checked' :''}}
                                                        name="gender" value="female" class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="customRadio2">@lang('site.female')</label>
                                                </div>
                                            </div>
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
