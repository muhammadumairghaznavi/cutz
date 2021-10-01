@extends('layouts.dashboard.app')
<?php
$page = 'orders';
$title = trans('site.orders');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.orders.index') }}">{{ $title }}</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        @include('partials._errors')
        <!-- Main content -->
        <section class="invoice ">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <b> @lang('site.order_number') </b>: {{ $order->id }}
                        <small class="pull-right"> @lang('site.created_at') : {{ $order->created_at }} </small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                    <address>
                        <b> @lang('site.name') </b>: {{ $order->customer->full_name ?? '' }} <br>
                        <b> @lang('site.email') </b>: {{ $order->customer->email ?? '' }} <br>
                        <b> @lang('site.phone') </b>: {{ $order->customer->phone ?? '' }} <br>
                        <b> @lang('site.status') </b>: {{ __('site.' . $order->status) }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    <address>
                        <b> @lang('site.total') </b>: {{ $order->total }}
                        <b> @lang('site.coupon') </b>: <code>{{ $order->promocode }}</code> <br>
                        <b> @lang('site.payment_method') </b>: {{ __('site.' . $order->payment_method) }} <br>
                        <b> @lang('site.payment_status') </b>: {{ __('site.' . $order->payment_status) }} <br>
                        <b> @lang('site.delivery_fees') </b>: {{ $order->delivery_fees }} <br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    <b> @lang('site.customer_address') </b>: {{ $order->customer_address }} <br>
                    <b> @lang('site.customer_region') : </b>{{ $order->customer_region }} <br>
                    <b> @lang('site.customer_street') : </b>{{ $order->customer_street }} <br>
                    <b> @lang('site.customer_home_number') : </b>{{ $order->customer_home_number }} <br>
                    <b> @lang('site.customer_floor_number') : </b>{{ $order->customer_floor_number }} <br>
                    <b> @lang('site.customer_appartment_number') : </b>{{ $order->customer_appartment_number }} <br>
                    <b> @lang('site.notes') : </b>{{ $order->customer_comments_extra }} <br>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    <img src="{{ $setting->image_logo }}" class="" width="80" height="80" alt="">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row  ">
                <div class="box box-primary">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.Purchases')</th>
                                    {{-- <th>@lang('site.item_price')</th> --}}
                                    <th>@lang('site.quantity')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.weights')</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $key => $item)

                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->title ?? '' }} </td>
                                        {{-- <td>{{ $item->product->total  ??""}} </td> --}}
                                        <td>{{ $item->qty }} </td>
                                        <td>{{ $item->price }} </td>
                                        {{-- <td>{{ $item->type=='gram'?'0.5 KG ':'1 KG'}}   </td> --}}
                                        <td>{{ $item->type }} </td>



                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        @lang('site.additions')
                                    </td>
                                </tr>
                                @foreach ($order->orderAddtions as $key => $item)

                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->addition->title ?? '' }} </td>
                                        <td>{{ $item->addition->total ?? '' }} </td>
                                        <td>{{ $item->qty }} </td>
                                        <td>{{ $item->price }} </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <button onclick="window.print();" class="btn btn-primary"><i
                            class="fa fa-print"></i>@lang('site.print')</button>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="box box-default no-print">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div>
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.orders.update', $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="col-md-12">
                            <div class=" form-group ">
                                <label>@lang('site.status') </label>
                                <select class="form-control" name="status" id="">
                                    <option value="">@lang('site.status')</option>
                                    @foreach (status_order() as $index => $status)
                                        <option {{ $order->status == $status ? 'selected' : '' }}
                                            value="{{ $status }}">
                                            {{ __('site.' . $status) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" form-group ">
                                <label>@lang('site.shipping_number') </label>
                                <input type="text" name="shipping_number" class="form-control"
                                    value="{{ $order->shipping_number }}" id="">
                            </div>
                            {{-- <div class=" form-group ">
                            <label>@lang('site.notes') </label>
                            <textarea name="note" class="form-control summernote" id="" cols="30"
                                rows="10">{{$order->note}}</textarea>
                        </div> --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div><!-- end of content wrapper -->
@endsection
