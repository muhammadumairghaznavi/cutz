@extends('layouts.dashboard.app')
<?php
$page="rates";
$title=trans('site.rates');
// to hide any section please type -> close
$section_search='';
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
        <h1>@lang('site.rates')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.rates')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.rates')
                    <small>
                        @lang('site.total_search')
                        ( {{  count($rates) }} )
                    </small></h3>
                <form action="{{ route('dashboard.rates.index') }}" method="get">
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
                            @if (auth()->user()->hasPermission('create_rates'))
                            <a href="{{ route('dashboard.rates.create') }}" class="btn btn-primary"><i
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
                @if ($rates->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.products')</th>
                            <th>@lang('site.rates')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rates as $index=>$rate)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td> {{ $rate->product->title??'' }}</td>
                            <td> {{ $rate->rate }}</td>
                            <td>

                                   <span class="  btn-{{$rate->status=="active"?'success':'danger'}} btn-sm ">{{ __('site.'.$rate->status) }}</span>


                            </td>
                             <td>
                                @if (auth()->user()->hasPermission('update_rates'))
                                   <a href="{{ route('dashboard.rates.duplicate', $rate->id) }}"
                                    class="btn btn-warning btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-copy"></i> @lang('site.duplicate')</a>

                                <a href="{{ route('dashboard.rates.edit', $rate->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_rates'))
                                <form action="{{ route('dashboard.rates.destroy', $rate->id) }}" method="post"
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
