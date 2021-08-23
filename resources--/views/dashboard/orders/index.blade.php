@extends('layouts.dashboard.app')
<?php
$page="orders";
$title=trans('site.orders');
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
        <h1>@lang('site.orders')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.orders')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.orders')
                    <small>
                        @lang('site.total_search')
                        ( {{  count($orders) }} )
                    </small></h3>
                <form action="{{ route('dashboard.orders.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">
                            <div class="col-md-3">
                                <input type="text" name="order_id" class="form-control"
                                    placeholder="@lang('site.order_number')" value="{{ request()->order_id }}">
                            </div>
                            <div class="col-md-3">
                                <select name="payment_status" class="form-control">
                                    <option value="">@lang('site.payment_status')</option>
                                    <option value="completed" {{request()->payment_status=='completed'?'selected':''}}>
                                        @lang('site.completed')</option>
                                    <option value="Not completed"
                                        {{request()->payment_status=='Not completed'?'selected':''}}>@lang('site.Not
                                        completed')</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">@lang('site.status')</option>
                                    @foreach (status_order() as $index=>$status)
                                    <option {{request()->status==$status ? 'selected':''}} value="{{$status}}">
                                        {{__('site.'.$status)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                <a style="float:left" href="{{ route('dashboard.orders.export_orders') }}"
                    class="btn btn-success  btn-sm">
                    Export Excel Sheet
                    <i class="fa fa-file-excel-o"></i>
                </a>
                @if ($orders->count() > 0)
                <table class="table table-hover " id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.order_number')</th>
                            <th>@lang('site.info') @lang('site.customers') </th>
                            <th>@lang('site.total')</th>
                            <th>@lang('site.payment_method')</th>
                            <th>@lang('site.payment_status')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.device_type')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index=>$order)
                        <tr style="background-color:{{ $order->status=="pending" ? '#f1d4d4' :'#04fb0938' }}">
                            <td>{{ $index + 1 }}</td>
                            <td> <code> {{  $order->id}} </code> </td>
                            <td>

                                {{ $order->customer->full_name ??""}} / {{ $order->created_at }}
                                <br><strong> @lang('site.phone'):{{ $order->customer->phone ??""}} </strong>
                            </td>
                            <td>
                                {{ $order->total }}
                            </td>
                            <td>
                                <span class=" label label-{{$order->payment_method=='visa'?'warning':'primary'}}">
                                    {{ __('site.'.$order->payment_method) }}</span>
                                </td>
                                <td>
                                    @if($order->payment_method=="visa")

                                <span class=" label label-{{$order->payment_status=='Complete'?'success':'danger'}}">
                                    {{ $order->payment_status.  __('site.'.$order->payment_status) }}

                                </span>
                                @endif
                                {{__('site.'.$order->payment_status)}}


                            </td>
                            <td> {{ __('site.'.$order->status) }}</td>
                            <td> {{$order->created_at}}</td>
                            <td> {{$order->device_type}}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_orders'))
                                <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-eye"></i>
                                    @lang('site.details')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-eye"></i>
                                    @lang('site.details')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_orders'))
                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post"
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
