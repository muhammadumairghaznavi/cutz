@extends('layouts.dashboard.app')
<?php
$page="provenances";
$title=trans('site.provenances');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.provenances')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.provenances.index') }}"> @lang('site.provenances')</a></li>
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
                <form action="{{ route('dashboard.provenances.update', $provenance->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @foreach (config('translatable.locales') as $key=> $locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                            value="{{ $provenance->translate($locale)->title }}">
                    </div>
                    {{-- <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                            rows="5">{{ $provenance->translate($locale)->description }}</textarea>
                    </div> --}}
                    @endforeach
                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                    <div class="form-group">
                        <img src="{{ $provenance->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                            alt="">
                    </div>

                        <div class="col-md-12">

                <span class="label label-danger  "> @lang('site.description') </span>

                @include('partials.provenances._addtions')
            </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                            @lang('site.edit')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
