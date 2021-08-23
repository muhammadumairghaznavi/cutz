@extends('layouts.dashboard.app')
<?php
$page="category_galleries";
$title=trans('site.category_galleries');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.category_galleries')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.category_galleries.index') }}"> @lang('site.category_galleries')</a></li>
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
                <form action="{{ route('dashboard.category_galleries.update', $category->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @foreach (config('translatable.locales') as $key=> $locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                            value="{{ $category->translate($locale)->title }}">
                    </div>
                    {{-- <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                            rows="5">{{ $category->translate($locale)->description }}</textarea>
                    </div> --}}
                    @endforeach
                    {{-- <div class="form-group">
                        <label>@lang('site.link')</label>
                        <input type="text" name="link" class="form-control" value="{{ $category->link }}">
                    </div> --}}

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                    <div class="form-group">
                        <img src="{{ $category->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                            alt="">
                    </div>

             {{-- <div class="form-group">
                <label for="files">@lang('site.images')</label>
                <input type="file" multiple name="images[]" class="form-control image2" id="category_gallery-photo-add">
                <div class="category_gallery">
                </div>
            </div>
        @foreach ($category->category_galleries as $imgs)
  <a href="{{ route('dashboard.category_galleries.image.delete',$imgs['id']) }}"
                            onclick="return confirm('{{trans('site.confirm_delete')}}')"
                            class="confirm btn btn-danger img-thumbnail image-previewBL" style="    width: 100px;
                                                " title="Delete this item">
                            <i class="fa fa-trash"></i><br>
                            <img src="{{$imgs->image_path}}" class="img-thumbnail image-previewBL" alt="">
                        </a>

            @endforeach --}}


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
