@extends('layouts.dashboard.app')
<?php
$page="sections";
$title=trans('site.sections');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.sections')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.sections.index') }}"> @lang('site.sections')</a></li>
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

                    <form action="{{ route('dashboard.sections.update', $section->id) }}" method="post"    enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[title]" class="form-control" value="{{ $section->translate($locale)->title }}">
                            </div>
                        @endforeach

                            <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ $section->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                            <div class="form-group">
                            <label>@lang('site.image')2</label>
                            <input type="file" name="icon" class="form-control image2">
                        </div>
                        <div class="form-group">
                            <img src="{{ $section->icon_path }}" style="width: 100px" class="img-thumbnail image-preview2" alt="">
                        </div>
                        
                        <div class="form-group">
                            <label>Sort Number </label>
                            <input type="number" name="sort" class="form-control  " value="{{$section->sort}}">
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
