@extends('layouts.dashboard.app')
<?php
$page="subCategories";
$title=trans('site.subCategories');
// to hide any section please type -> close
$subCategory_search='';
$subCategory_add=' ';
$subCategory_edit=' ';
$subCategory_delete=' ';
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.subCategories')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.subCategories')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.subCategories')
                    <small>
                        @lang('site.total_search')
                        ( {{ $subCategories->count() }} )
                    </small></h3>
                <form action="{{ route('dashboard.subCategories.index') }}" method="get">
                    <div class="row">
                        <div class="{{$subCategory_search=='close'?'hidden':''}}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{$subCategory_add=='close'?'hidden':''}}">
                            @if (auth()->user()->hasPermission('create_subCategories'))
                            <a href="{{ route('dashboard.subCategories.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($subCategories->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>@lang('site.categories')</th>
                            <th>@lang('site.name')</th>
                            {{-- <th>@lang('site.description')</th> --}}
                            <th>@lang('site.image')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subCategories as $index=>$subCategory)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{ $subCategory->category->title }}</td>
                            <td> {{ $subCategory->title }}</td>
                            {{-- <td> {{ $subCategory->description }}</td> --}}
                            <td><img src="{{ $subCategory->image_path }}" style="width: 100px;" class="img-thumbnail" alt="">
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('update_subCategories'))
                                    <a href="{{ route('dashboard.subCategories.duplicate', $subCategory->id) }}"
                                    class="btn btn-warning btn-sm {{$subCategory_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-copy"></i> @lang('site.duplicate')</a>

                                <a href="{{ route('dashboard.subCategories.edit', $subCategory->id) }}"
                                    class="btn btn-info btn-sm {{$subCategory_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_subCategories'))
                                <form action="{{ route('dashboard.subCategories.destroy', $subCategory->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{$subCategory_delete=='close'?'hidden':''}}"><i
                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                </form><!-- end of form -->
                                @else
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    @lang('site.delete')</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- end of table -->

                @else
                <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
