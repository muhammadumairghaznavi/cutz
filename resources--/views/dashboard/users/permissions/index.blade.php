@extends('layouts.dashboard.app')
<?php
$page="users";
$title=trans('site.permissions');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{$title}}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">{{$title}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">{{$title}}  <small>  {{ $permissions->count() }}</small></h3>
                    <form action="{{ route('dashboard.users.permissions.index') }}" method="get">
                         <div class="row">
                            <div class="col-md-4">
                                 @if (auth()->user()->hasPermission('create_users'))
                                    <a href="{{ route('dashboard.users.permissions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                <div class="box-body">
                    @if ($permissions->count() > 0)
                        <table class="table table-hover"  id="data_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.created_at')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $index=>$permission)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $permission->name }} <br>
                                        {{ $permission->display_name }} <br>
                                        {{ $permission->description }}
                                    </td>
                                    <td>{{  $permission->created_at  }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_users'))
                                            <a href="{{ route('dashboard.users.permissions.edit', $permission->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_users'))
                                            <form action="{{ route('dashboard.users.permissions.destroy', $permission->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table><!-- end of table -->
                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
