@extends('layouts.dashboard.app')
<?php
$page="invoices";
$title=trans('site.invoices');
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
        <h1>@lang('site.invoices')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.invoices')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.invoices')
                    <small>
                        @lang('site.total_search')
                        ( {{ $invoices->count() }} )
                    </small></h3>
                <form action="{{ route('dashboard.invoices.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">

                                <select name="status" class="form-control">
                                    <option value="">الحالة</option>
                                        @foreach (status_invoice() as $index=>$status)
                                <option {{$status==request()->status ? 'selected':''}} value="{{$status}}">
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
                <a style="float:left" href="{{ route('dashboard.invoices.export_invoices') }}"
                    class="btn btn-success  btn-sm">
                    Export Excel Sheet
                    <i class="fa fa-file-excel-o"></i>
                </a>
                @if ($invoices->count() > 0)
                <table class="table table-hover " id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.info') @lang('site.customers') </th>
                            <th>@lang('site.Purchases')</th>
                            <th>@lang('site.payment_type')</th>
                            <th>@lang('site.invoice_number')</th>
                            <th>@lang('site.invoice_date')</th>
                            <th>@lang('site.due_date')</th>
                            <th>@lang('site.total')</th>

                            <th>@lang('site.payment_method')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $index=>$invoice)
                        <tr style="background-color:{{ $invoice->status=="pending" ? '#f1d4d4' :'#04fb0938' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                               <strong> "{{ $invoice->customer_country=='EG'?'Egypt' : 'Dollar' }}"</strong><br>
                                {{ $invoice->customer->full_name }} <br> {{ $invoice->customer->email }} <br>
                                {{ $invoice->customer->phone }} <br>
                            </td>



                            <td>
                                @if ($order->package_id!=null)
                                <a href="{{url('dashboard/products?search=').$order->package->title}}"
                                    target="_balnk">{{$order->package->title}}</a><br>
                                @endif
                                @if ($order->service_id!=null)
                                <a href="{{url('dashboard/services?search=').$order->service->title}}"
                                    target="_balnk">{{$order->service->title}}</a><br>
                                @endif
                                @if ($order->product_id!=null)
                                <a href="{{url('dashboard/products?search=').$order->product->title}}"
                                    target="_balnk">{{$order->product->title}}</a><br>
                                @endif
                            </td>
                               <td>{{ __('site.'. $invoice->payment_type)}}</td>
                            <td> {{ $invoice->invoice_number }} </td>
                            <td> {{ $invoice->invoice_date }} </td>
                            <td> {{ $invoice->due_date }} </td>
                            <td> {{ $order->total() }}
                                {{ $invoice->customer_country=="usd"?'$':'جنيه' }}

                            </td>

                            <td style="background: {{ $invoice->payment_status=='completed'?'green' :'red' }}">
                                {{ $invoice->payment_method }} <br>
                                {{ $invoice->payment_status }}
                            </td>
                            <td > {{ $invoice->status }}</td>
                            <td> {{ $invoice->created_at }} </td>
                            <td>
                                @if (auth()->user()->hasPermission('update_invoices'))
                                <a href="{{ route('dashboard.invoices.invoices.edit', $invoice->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-eye"></i> @lang('site.details')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.details')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_invoices'))
                                <form action="{{ route('dashboard.invoices.destroy', $invoice->id) }}" method="post"
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
