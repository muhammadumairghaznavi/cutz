@extends('layouts.dashboard.app')
<?php
$page="instructions";
$title=trans('site.instructions');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.instructions')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.instructions.index') }}"> @lang('site.instructions')</a></li>
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

                    <form action="{{ route('dashboard.instructions.update', $instruction->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                          <label>@lang('site.sections')</label>
                            <select name="product_id" id="" class="form-control">
                                @foreach ($products  as $item)
                                <option  {{$item->id==$instruction->product_id?'selected':''}} value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[title]" class="form-control" value="{{ $instruction->translate($locale)->title }}">
                            </div>
                              <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea required="required" name="{{ $locale }}[description]" id=""
                            class="form-control summernote" cols="30"
                            rows="5">{{ $instruction->translate($locale)->description }}</textarea>
                    </div>

                        @endforeach

                            <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ $instruction->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
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
