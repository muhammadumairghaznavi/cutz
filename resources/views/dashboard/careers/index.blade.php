@extends('layouts.dashboard.app')
<?php
$page = 'careers';
$title = trans('site.careers');
// to hide any section please type -> close
$careers_search = '';
$careers_add = ' ';
$careers_edit = ' ';
$careers_delete = ' ';
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.careers')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.careers')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.careers')
                        <small>
                            @lang('site.total_search')
                            ( {{ $career->count() }} )
                        </small>
                    </h3>
                    <form action="{{ route('dashboard.careers.index') }}" method="get">
                        <div class="row">
                            <div class="{{ $career == 'close' ? 'hidden' : '' }}">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="@lang('site.search')" value="{{ request()->search }}">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        @lang('site.search')</button>
                                </div>
                            </div>

                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                <div class="box-body">
                    @if ($career->count() > 0)
                        <table class="table table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th> </th>

                                    <th>Full Name</th>
                                    {{-- <th>@lang('site.description')</th> --}}
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>CV</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($career as $index => $career)
                                    <tr>
                                        <td> {{ $index + 1 }}</td>
                                        <td> {{ $career->fullname }}</td>
                                        <td> {{ $career->email }}</td>
                                        <td> {{ $career->contact }}</td>
                                        <td><a href="{{ route('dashboard.careers.downloadcv', $career->id) }}">{{ $career->filename }}
                                                <i class="fa fa-download"></i></a></td>
                                        <td>
                                            @if (auth()->user()->hasPermission('delete_careers'))
                                                <form action="{{ route('dashboard.careers.destroy', $career->id) }}"
                                                    method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form><!-- end of form -->

                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i
                                                        class="fa fa-trash"></i>
                                                    @lang('site.delete')</button>
                                            @endif
                                            @if (auth()->user()->hasPermission('read_careers'))
                                                <a type="button" data-toggle="modal"
                                                    data-target="#exampleModal-{{ $career->id }}"
                                                    class="btn btn-warning view btn-sm"><i class="fa fa-eye"></i>
                                                    @lang('site.view')
                                                </a>

                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal-{{ $career->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="pull-right close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        @lang('site.candetails')
                                                    </h3>
                                                    <h5>{{ $career->fullname }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Full Name :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{ $career->fullname }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Email :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{ $career->email }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Contact :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{ $career->contact }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Comments :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">{{ $career->comments }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">CV :</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for=""><a
                                                                        href="{{ route('dashboard.careers.downloadcv', $career->id) }}">{{ $career->filename }}
                                                                        <i class="fa fa-download"></i></a></label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
