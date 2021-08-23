@extends('layouts.dashboard.app')
<?php
$page="pages";
$title=trans('site.pages');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.pages')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.pages.index') }}"> @lang('site.pages')</a></li>
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
                    <form action="{{ route('dashboard.pages.update', $page_edit->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                         <div class="form-group">
                            <label>@lang('site.page_name')</label>

                            <select class="form-control" required="required"  name="type" id="">

                                <option value="">@lang('site.page_name')</option>
                                     @foreach (pages_name() as $index=>$item)
                                    <option {{$page_edit->type==$item ? 'selected':''}} value="{{$item}}">
                                        {{__('site.'.$item)}}</option>
                                    @endforeach

                             </select>
                        </div>



                        @foreach (config('translatable.locales') as $key=> $locale)
                            <div class="form-group">
                                    <span class="label label-warning  ">{{$key+1}}  </span>
                                <label>@lang('site.' . $locale .'.title')</label>
                                <input   type="text" name="{{ $locale }}[title]" class="form-control"    value="{{ $page_edit->translate($locale)->title }}">
                            </div>
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.description')</label>
                              <textarea     name="{{ $locale }}[description]" id="" class="form-control summernote"    cols="30" rows="5">{{ $page_edit->translate($locale)->description }}</textarea>
                            </div>
                        @endforeach
                                        <div class="form-group">
                                <label>@lang('site.link')</label>
                                <input type="text" name="link" class="form-control" value="{{$page_edit->link}}" id="">

                            </div>


                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ $page_edit->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.file')</label>
                            <input type="file" name="file" class="form-control file" enctype="multipart/form-data"
                            >

                            <a href="{{ $page_edit->file_path }}"> <span class="fa fa-file"></span> {{ $page_edit->file }}</a>

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
