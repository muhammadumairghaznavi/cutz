@extends('layouts.dashboard.app')
<?php
$page="roles";
$title=trans('site.roles');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.roles')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.roles')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.roles') <small>{{ $roles->total() }}</small></h3>

                    <form action="{{ route('dashboard.roles.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            {{--<div class="col-md-4">
                                <select name="role" class="form-control">
                                    <option value=""> @lang('site.role')  </option>
                                    <option value="admin" {{ ( request()->role  && request()->role=="admin" ) ? "selected" :'' }}>	@lang('site.admin')   </option>
                                    <option value="sales" {{ ( request()->role  && request()->role=="sales" ) ? "selected" :'' }}> 	@lang('site.sales') </option>
                                </select>
                            </div>--}}

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('create_users'))
                                    <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($roles->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.permissions')</th>
                                <th>@lang('site.Users Count')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($roles as $index=>$role)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $role->name }}  </td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            <h5 style="display: inline-block;"><span class="badge badge-primary">{{ $permission->name }}</span></h5>
                                        @endforeach
                                    </td>
                                    <td>{{ $role->users_count }}</td>
                                    <td >
                                        @if ($role->name!='super_admin')

                                        @if (auth()->user()->hasPermission('update_roles'))
                                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.Edit')</a>
                                        @else
                                            <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.Edit')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('delete_roles') )
                                            <form method="post" action="{{ route('dashboard.roles.destroy', $role->id) }}" style="display: inline-block;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.Delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <a href="#" disabled class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>@lang('site.Delete')</a>
                                        @endif

                                        @endif
                                    </td>
                                    </tr>
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $roles->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
