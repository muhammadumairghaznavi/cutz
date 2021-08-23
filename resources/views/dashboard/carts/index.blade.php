@extends('layouts.dashboard.app')
<?php
$page="carts";
$title=trans('site.carts');
// to hide any section please type -> close
$section_search='close';
$section_add='close';
$section_edit='close';
$section_delete='close';
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.carts')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.carts')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.carts')
                    <small>
                        @lang('site.total_search')
                        ( {{  count($carts) }} )
                    </small></h3>
                <form action="{{ route('dashboard.carts.index') }}" method="get">
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
                            @if (auth()->user()->hasPermission('create_carts'))
                            <a href="{{ route('dashboard.carts.create') }}" class="btn btn-primary"><i
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
                @if ($carts->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.customers')</th>
                            <th>@lang('site.products')</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $index=>$customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $customer->full_name }} <br>
                                {{ $customer->phone }} <br>
                                {{ $customer->email }}
                            </td>
                            <td>
                                <button data-toggle="collapse" class="btn btn-success" data-target="#demo_{{$customer->id}}">@lang('site.products')
                                    {{count($customer->carts)}}</button>
                                <div id="demo_{{$customer->id}}" class="collapse">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th >#</th>
                                                <th >@lang('site.title')</th>
                                                <th >@lang('site.price') * @lang('site.quantity')</th>
                                                <th >@lang('site.created_at')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer->carts as $key=>$cart)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$cart->product->title??''}}</td>
                                                <td>{{$cart->product->total ??'' }}*{{$cart->qty}}</td>
                                                <td>{{$cart->created_at}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>



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
