@extends('layouts.dashboard.app')
<?php
$page="additions";
$title=trans('site.additions');
// to hide any section please type -> close
$section_search=' ';
$section_add=' ';
$section_edit=' ';
$section_delete=' ';
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.additions')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.additions')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.additions')
                    <small>
                        @lang('site.total_search')
                        ( {{ $additions->count() }} )
                    </small></h3>
                <form action="{{ route('dashboard.additions.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-3">
                                <select name="product_id" class="form-control">
                                    <option value="">@lang('site.products')</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->id }}" {{ request()->product_id == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{$section_add=='close'?'hidden':''}}">
                            @if (auth()->user()->hasPermission('create_additions'))
                            <a href="{{ route('dashboard.additions.create',['product_id'=>request()->product_id]) }}" class="btn btn-primary"><i
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
                @if ($additions->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.price')</th>

                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($additions as $index=>$addition)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{$addition->title_en}}</td>
                            <td> {{ $addition->Total }} {{__('site.'.currncy())}}</td>

                            <td>
                                @if (auth()->user()->hasPermission('update_additions'))
                                    <a href="{{ route('dashboard.additions.duplicate', $addition->id) }}"
                                    class="btn btn-warning btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-copy"></i> @lang('site.duplicate')</a>

                                <a href="{{ route('dashboard.additions.edit', $addition->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_additions'))
                                <form action="{{ route('dashboard.additions.destroy', $addition->id) }}" method="post"
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
