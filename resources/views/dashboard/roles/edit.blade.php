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
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.roles.index') }}"> @lang('site.roles')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->

            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.roles.update', $role->id) }}" method="post"
                    enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    {{--name--}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
                    </div>

                    {{--permissions--}}
                    <div class="form-group">
                        <h4>Permissions</h4>
                        @php
                        $models = getModels();
                        @endphp

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 15%;">Model</th>
                                    <th>action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($models as $index=>$model)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $model }}</td>
                                    <td>
                                        @php
                                        $permission_maps = ['create', 'read', 'update', 'delete'];
                                        @endphp

                                        @if ($model == 'settings')
                                        @php
                                        $permission_maps = ['create', 'read'];
                                        @endphp
                                        @endif
                                        <select name="permissions[]" class="form-control  " multiple>
                                            @foreach ($permission_maps as $permission_map)
                                            <option
                                                {{ $role->hasPermission($permission_map . '_' . $model) ? 'selected' : '' }}
                                                value="{{ $permission_map . '_' . $model }}">{{ $permission_map }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table><!-- end of table -->
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
