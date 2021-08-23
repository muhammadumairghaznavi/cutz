@extends('layouts.dashboard.app')
<?php
$page="blogs";
$title=trans('site.blogs');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.blogs')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.blogs.index') }}"> @lang('site.blogs')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label>@lang('site.type') </label>
                            <select name="type" class="form-control ">
                                <option {{$blog->type=="useful_information"?'selected':''}} value="useful_information">@lang('site.useful_information')</option>
                                <option {{$blog->type=="recipes"?'selected':''}} value="recipes">@lang('site.recipes')</option>
                            </select>
                        </div>

                        @foreach (config('translatable.locales') as $key=> $locale)
                            <div class="form-group">
                                    <span class="label label-warning  ">{{$key+1}}  </span>
                                <label>@lang('site.' . $locale .'.title')</label>
                                <input   type="text" name="{{ $locale }}[title]" class="form-control"    value="{{ $blog->translate($locale)->title }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.short_description') </label>
                              <textarea     name="{{ $locale }}[short_description]" id="" class="form-control  "    cols="30" rows="5">{{ $blog->translate($locale)->short_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.description') </label>
                              <textarea     name="{{ $locale }}[description]" id="" class="form-control summernote "    cols="30" rows="5">{{ $blog->translate($locale)->description }}</textarea>
                            </div>
                        @endforeach
                              <div class="form-group">
                            <label>@lang('site.date')</label>
                            <input type="date" name="date" class="form-control "   value="{{$blog->date }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ $blog->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
