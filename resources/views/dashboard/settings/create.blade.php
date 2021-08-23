@extends('layouts.dashboard.app')
<?php
$page="settings";
$title=trans('site.settings');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.settings')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.settings.index') }}"> @lang('site.settings')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>
    <section class="content">
        <div class="">
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.settings.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-primary ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="">@lang('site.main_num') </label>
                                        <input type="text" name="num1" class="form-control" id="num1"
                                            value="{{  old('num1')  }}" placeholder="Enter main number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.main_sec') </label>
                                        <input type="text" name="num2" class="form-control" id="num1"
                                            value="{{old('num2')  }}" placeholder="Enter Second Number or extra number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.email') </label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{old('email')  }}" placeholder="Enter email">
                                    </div>
                                    @foreach (config('translatable.locales') as $key=>$locale)
                                    <div class="form-group">
                                        <span class="label label-warning  ">{{$key+1}} </span>
                                        <label>@lang('site.' . $locale . '.title_site')</label>
                                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                                            value="{{ old($locale . '.title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.working_hours')</label>
                                        <input type="text" name="{{ $locale }}[working_hours]" class="form-control"
                                            value="{{ old($locale . '.working_hours') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.address')</label>
                                        <textarea name="{{ $locale }}[address]" id="" class="form-control" cols="30"
                                            rows="5">{{ old($locale . '.address') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.seo_title')</label>
                                        <input type="text" name="{{ $locale }}[seo_title]" class="form-control"
                                            value="{{ old($locale . '.seo_title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.seo_key')</label>
                                        <input type="text" name="{{ $locale }}[seo_title]" class="form-control"
                                            value="{{ old($locale . '.seo_key') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.seo_des')</label>
                                        <textarea name="{{ $locale }}[seo_des]" id="" class="form-control" cols="30"
                                            rows="5">{{ old($locale . '.seo_des') }}</textarea>
                                    </div>
                                    <div class="  with-border"></div><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md 4 --}}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-danger ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> DISPLAY</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>@lang('site.image')</label>
                                        <input type="file" name="logo" class="form-control image"
                                            enctype="multipart/form-data">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                            class="img-thumbnail image-preview" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.footer_logo')</label>
                                        <input type="file" name="footer_logo" class="form-control image2"
                                            enctype="multipart/form-data">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                            class="img-thumbnail image-preview2" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.icon')</label>
                                        <input type="file" name="icon" class="form-control image3"
                                            enctype="multipart/form-data">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                            class="img-thumbnail image-preview3" alt="">
                                    </div>
                                    <div class="  with-border"></div><br>

                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md 4 --}}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-success ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> Data</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">


                                    <div class="form-group">
                                        <label>@lang('site.map')</label>
                                        <textarea name="map" id="" class="form-control" cols="30"
                                            rows="5">{{ old( 'map') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.seo_google_analatic')</label>
                                        <textarea name="seo_google_analatic" id="" class="form-control" cols="30"
                                            rows="5">{{ old( 'seo_google_analatic') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.facebook_messanger')</label>
                                        <textarea name="facebook_messanger" id="" class="form-control" cols="30"
                                            rows="5">{{ old( 'facebook_messanger') }}</textarea>
                                    </div>

                                    <div class="  with-border"></div><br>

                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md 4 --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
