@extends('layouts.dashboard.app')
<?php
$page="settings";
$title=trans('site.settings');
// to hide any section please type -> close
$section_search='close';
$section_add='close';
$section_edit=' ';
$section_delete='close';
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.settings')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.settings')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.settings')
                    <small>
                        @lang('site.total_search')
                        ( {{  count($settings) }} )
                    </small></h3>
                <form action="{{ route('dashboard.settings.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{$section_add=='close'?'hidden':''}}">
                            @if (auth()->user()->hasPermission('create_settings'))
                            <a href="{{ route('dashboard.settings.create') }}" class="btn btn-primary"><i
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
                @if ($settings->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.phone')2</th>

                            <th>@lang('site.image_logo')</th>
                            <th>@lang('site.image_icon')</th>
                            <th>@lang('site.footer_logo')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $index=>$setting)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $setting->address }} </td>
                            <td>
                                {{ $setting->email }} </td>
                            <td>
                                {{ $setting->num1 }} </td>
                            <td>
                                {{ $setting->num2 }}

                            </td>
                            <td>

                                <img src="{{ $setting->image_logo }}" style="width: 100px;" class="img-thumbnail"
                                    alt="">
                            </td>
                            <td>
                                <img src="{{ $setting->image_icon }}" style="width: 100px;" class="img-thumbnail"
                                    alt="">
                            </td>
                            <td>
                                <img src="{{ $setting->image_footer }}" style="width: 100px;" class="img-thumbnail"
                                    alt="">
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('update_settings'))
                                <a href="{{ route('dashboard.settings.edit', $setting->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_settings'))
                                <form action="{{ route('dashboard.settings.destroy', $setting->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{$section_delete=='close'?'hidden':''}}"><i
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
