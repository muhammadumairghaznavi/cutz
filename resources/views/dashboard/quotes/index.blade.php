@extends('layouts.dashboard.app')
<?php
$page="quotes";
$title=trans('site.quotes');
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
        <h1>@lang('site.quotes')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.quotes')</li>
        </ol>
    </section>
    <section class="content">



        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.quotes')
                    <small>
                        @lang('site.total_search')
                        ( {{  count($quotes) }} )
                    </small></h3>
                <form action="{{ route('dashboard.quotes.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                             <div class="col-md-4">
                                <select name="status" class="form-control">
                                <option value="">الحالة</option>
                                    <option value="notactive" {{ request()->status=="notactive" ? 'selected' :'' }}>لم يتم التواصل معه	   </option>
                                    <option value="active" {{ request()->status=="active" ? 'selected' :'' }}>تم التواصل	  </option>

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
                 <a style="float:left" href="{{ route('dashboard.quotes.export_quotations') }}" class="btn btn-success  btn-sm">
                            Export Excel Sheet
                            <i
                            class="fa fa-file-excel-o"></i>
                        </a>

                @if ($quotes->count() > 0)
                <table class="table table-hover " id="data_table" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.company')</th>
                            <th>@lang('site.specialization')</th>
                            <th>@lang('site.budget')</th>
                            <th>@lang('site.message')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes as $index=>$quote)
                        <tr  style="background-color:{{ $quote->status=="notactive" ? '#f1d4d4' :'#04fb0938' }}">
                            <td>{{ $index + 1 }}</td>
                            <td> {{ $quote->name }} </td>
                            <td> {{ $quote->phone }} </td>
                            <td> {{ $quote->email }} </td>
                            <td> {{ $quote->company }} </td>
                            <td> {{ $quote->specialization }}</td>
                            <td> {{ $quote->budget }}</td>
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
                                                    {{ $quote->name }}  /{{ $quote->email }} /{{ $quote->phone }}
                                                   </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $quote->message }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>{{-- end model --}}


                            </td>


                            <td> {{ $quote->status }}</td>
                            <td>

                            {{ \Carbon\Carbon::parse($quote->created_at)->diffForHumans() }}
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('update_quotes'))

                                <a href="{{ route('dashboard.quotes.edit', $quote->id) }}"
                                    class="btn btn-info btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_quotes'))
                                <form action="{{ route('dashboard.quotes.destroy', $quote->id) }}" method="post"
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
