@extends('layouts.dashboard.app')
<?php
$page="galleries";
$title=trans('site.galleries');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.galleries')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.galleries.index') }}"> @lang('site.galleries')</a></li>
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
                <form action="{{ route('dashboard.galleries.update', $gallery->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                  <div class="form-group">
                        <label>@lang('site.category_galleries')</label>
                        <select name="category_gallery_id"  class="form-control" id="">
                            @foreach ($categoryGalleries as $item)
                            <option  {{ $gallery->category_gallery_id==$item->id ?'selected':'' }} value="{{ $item->id}}">{{ $item->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('site.link')</label>
                        <input type="text" name="link" class="form-control" value="{{ $gallery->link }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                    <div class="form-group">
                        <img src="{{ $gallery->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                            alt="">
                    </div>

             {{-- <div class="form-group">
                <label for="files">@lang('site.images')</label>
                <input type="file" multiple name="images[]" class="form-control image2" id="gallery-photo-add">
                <div class="gallery">
                </div>
            </div>
        @foreach ($gallery->galleries as $imgs)
  <a href="{{ route('dashboard.galleries.image.delete',$imgs['id']) }}"
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
