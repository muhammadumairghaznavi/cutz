@extends('layouts.dashboard.app')
<?php
$page="tickets";
$title=trans('site.tickets');
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
        <h1>@lang('site.tickets')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.tickets')</li>
        </ol>
    </section>
    <section class="content">



        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.tickets')
                    <small>
                        @lang('site.total_search')
                        ( {{  count($tickets) }} )
                    </small></h3>
                <form action="{{ route('dashboard.tickets.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">

                              <div class="col-md-3">
                                <select name="section" class="form-control">
                                    <option value="">@lang('site.section')</option>
                                @foreach (ticket_option() as $index=>$type)
                                <option {{request()->section==$type ? 'selected':''}} value="{{$type}}">
                                    {{__('site.'.$type)}}</option>
                                @endforeach
                                </select>
                            </div>

                              <div class="col-md-3">
                                <select name="type" class="form-control">
                                    <option value="">@lang('site.type')</option>
                                @foreach (ticket_type() as $index=>$type)
                                <option {{request()->type==$type ? 'selected':''}} value="{{$type}}">
                                    {{__('site.'.$type)}}</option>
                                @endforeach
                                </select>
                            </div>
                              <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">@lang('site.status')</option>
                                @foreach (ticket_status() as $index=>$status)
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
                 <a style="float:left" href="{{ route('dashboard.tickets.export_tickets') }}" class="btn btn-success  btn-sm">
                            Export Excel Sheet
                            <i
                            class="fa fa-file-excel-o"></i>
                        </a>

                @if ($tickets->count() > 0)
                <table class="table table-hover " id="data_table" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.info')</th>
                            <th>@lang('site.section')</th>
                            <th>@lang('site.type')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.message')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $index=>$ticket)
                        <tr  style="background-color:{{ $ticket->status=="pending" ? '#f1d4d4' :'#04fb0938' }}">
                            <td>{{ $index + 1 }}</td>
                            <td> {{ $ticket->customer->full_name }} <br> {{ $ticket->customer->email }} <br> {{ $ticket->customer->phone }} <br></td>
                            <td> {{ __('site.'.$ticket->section) }} </td>
                            <td>{{ __('site.'.$ticket->type) }}     </td>
                            <td> {{ $ticket->status }} </td>
                            <td>
                                {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}



                            </td>

                            <td>
                                <a href="" data-toggle="modal" data-target="#model_{{$index}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="model_{{$index}}" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                {{ $ticket->customer->full_name }} <br> {{ $ticket->customer->email }} <br> {{ $ticket->customer->phone }} <br>
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $ticket->message }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>{{-- end model --}}


                            </td>


                            <td> {{ $ticket->status }}</td>

                            <td>
                                @if (auth()->user()->hasPermission('update_tickets'))

                                <a href="{{ route('dashboard.tickets.edit', $ticket->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_tickets'))
                                <form action="{{ route('dashboard.tickets.destroy', $ticket->id) }}" method="post"
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
