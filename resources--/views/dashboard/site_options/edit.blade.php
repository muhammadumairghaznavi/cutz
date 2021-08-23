@extends('layouts.dashboard.app')
<?php
$page="site_options";
$title=trans('site.site_options');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{$title}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a></li>
            <li><a href="{{ route('dashboard.site_options.index') }}"> @lang('site.site_options')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>
    <section class="content">
        <div class="">
       
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.site_options.update', $site_options->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-primary  ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="">@lang('site.main_num') </label>
                                        <input type="text" name="num1" class="form-control" id="num1" value="{{ $site_options->num1  }}"
                                            placeholder="Enter main number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.main_sec') </label>
                                        <input type="text" name="num2" class="form-control" id="num1" value="{{ $site_options->num2  }}"
                                            placeholder="Enter Second Number or extra number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.email') </label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ $site_options->email  }}"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.address_ar') </label>
                                        <textarea name="address_ar" class="form-control" rows="10" cols="80">{{ $site_options->address_ar  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.address_en') </label>
                                        <textarea name="address_en" class="form-control" rows="10" cols="80">{{ $site_options->address_en  }}</textarea>
                                    </div>
                                    <hr>

                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-danger  ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> SEO </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="">@lang('site.seo_tit') </label>
                                        <input type="text" name="seo_tit" class="form-control" id="seo_tit" value="{{ $site_options->seo_tit  }}"
                                            placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.seo_key') </label>
                                        <textarea name="seo_key" class="form-control" rows="10" cols="80">{{ $site_options->seo_key  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('site.seo_des') </label>
                                        <textarea name="seo_des" class="form-control" rows="10" cols="80">{{ $site_options->seo_des  }}</textarea>
                                    </div>

                                    <hr>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.one -->
                    </div>
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-success  ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> DISPLAY </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>@lang('site.icon')</label>
                                        <input type="file" name="icon" class="form-control image">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{url('/')}}/uploads/{{ $site_options->icon }}" style="width: 100px"
                                            class="img-thumbnail  image-preview" alt="">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.logo')</label>
                                        <input type="file" name="logo" class="form-control image2">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{url('/')}}/uploads/{{ $site_options->logo }}" style="width: 100px"
                                            class="img-thumbnail  image-preview2" alt="">
                                    </div>




                                    <div class="form-group">
                                        <label for="">@lang('site.map') </label>
                                        <textarea name="map" class="form-control" rows="10" cols="80">{{ $site_options->map  }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""> @lang('site.google_ana') </label>
                                        <textarea name="seo_google_analatic" class="form-control" rows="10" cols="80">{{ $site_options->seo_google_analatic  }}</textarea>
                                    </div>
                                    <hr>



                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.one -->
                    </div>
                    <div class="col-md-12">

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary col-md-12"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>
                    </div>

                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
