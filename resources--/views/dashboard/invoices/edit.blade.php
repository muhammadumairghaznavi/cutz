@extends('layouts.dashboard.app')
<?php
$page="invoices";
$title=trans('site.orders');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{$title}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.invoices.index') }}">{{$title}}</a></li>
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
                    <i class="fa fa-globe"></i> <b> @lang('site.order_number') </b>: {{ $invoice->invoice_number }}
                    <small class="pull-right"> @lang('site.created_at') : {{ $invoice->created_at }} </small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-3 invoice-col">
                <address>
                    <b> @lang('site.name') </b>: {{ $invoice->customer->full_name }} <br>
                    <b> @lang('site.email') </b>: {{ $invoice->customer->email }} <br>
                    <b> @lang('site.phone') </b>: {{ $invoice->customer->phone }} <br>
                    <b> @lang('site.status') </b>: {{ $invoice->status }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <address>
                    <b> @lang('site.total') </b>: {{ $invoice->total() }}
                    {{ $invoice->customer_country=="usd"?'$':'جنيه' }} <del>
                        {{ $invoice->old_price()==0?'':$invoice->old_price() }}</del><br>
                    <b> @lang('site.coupon') </b>: <code>{{$invoice->coupon_code}}</code> <br>
                    <b> @lang('site.discount') </b>:
                    <code>{{$invoice->old_price()==0?'':$invoice->old_price()-$invoice->total()}}</code> <br>
                    <b> @lang('site.payment_method') </b>: {{ $invoice->payment_method }} <br>
                    <b> @lang('site.payment_status') </b>: {{ $invoice->payment_status }} <br>
                    <b> @lang('site.fees') </b>: {{ $invoice->fees }} <br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <b> @lang('site.invoice_number') </b>: {{ $invoice->invoice_number }} <br>
                <b> @lang('site.invoice_date') : </b>{{ $invoice->invoice_date }} <br>
                <b> @lang('site.due_date') :</b> {{ $invoice->due_date }} <br>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <img src="{{$setting->image_logo}}" class="" width="80" height="80" alt="">
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
                                <th>@lang('site.payment_type')</th>
                                <th>@lang('site.item_price')</th>
                                <th>@lang('site.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    @if ($invoice->package_id!=null)
                                    <a href="{{url('dashboard/products?search=').$invoice->package->title}}"
                                        target="_balnk">{{$invoice->package->title}}</a><br>
                                    @endif
                                    @if ($invoice->service_id!=null)
                                    <a href="{{url('dashboard/services?search=').$invoice->service->title}}"
                                        target="_balnk">{{$invoice->service->title}}</a><br>
                                    @endif
                                    @if ($invoice->product_id!=null)
                                    <a href="{{url('dashboard/products?search=').$invoice->product->title}}"
                                        target="_balnk">{{$invoice->product->title}}</a><br>
                                    @endif
                                </td>
                                <td>{{__('site.'.$invoice->payment_type)}}</td>
                                <td>{{$invoice->item_price}}</td>
                                <td>{{ $invoice->status }} </td>
                            </tr>
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
                <form action="{{ route('dashboard.invoices.update', $invoice->id) }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                              {{ method_field('put') }}
                    <div class="col-md-12">
                        <div class=" form-group ">
                            <label>@lang('site.status') </label>
                            <select class="form-control" name="status" id="">
                                <option value="">@lang('site.status')</option>
                                @foreach (status_invoice() as $index=>$status)
                                <option {{$invoice->status==$status ? 'selected':''}} value="{{$status}}">
                                    {{__('site.'.$status)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" form-group ">
                            <label>@lang('site.notes') </label>
                            <textarea name="note" class="form-control summernote" id="" cols="30"
                                rows="10">{{$invoice->note}}</textarea>
                        </div>
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
