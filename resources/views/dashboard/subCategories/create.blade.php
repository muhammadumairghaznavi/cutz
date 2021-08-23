@extends('layouts.dashboard.app')
<?php
$page="subCategories";
$title=trans('site.subCategories');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.subCategories')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.subCategories.index') }}"> @lang('site.subCategories')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.subCategories.store') }}"method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-group">
                          <label>@lang('site.sections')</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $item)
                                <option  value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach (config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{ $locale }}[title]" class="form-control" value="{{ old($locale . '.title') }}">
                            </div>
                        @endforeach
                         <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image" enctype="multipart/form-data"
                            >
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
