@extends('layouts.dashboard.app')
<?php
$page="users";
$title=trans('site.users');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
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

                <form action="{{ route('dashboard.users.update', $user->id) }}" method="post"
                    enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="form-group">
                        <label>@lang('site.first_name')</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.last_name')</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.email')</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    {{--
                        <div class="form-group">
                            <label>@lang('site.about user')</label>
                            <input type="text" name="aboutUser" class="form-control" value="{{ $user->aboutUser }}">
            </div> --}}

            {{--roles--}}
            <div class="form-group">
                <label>Roles</label>
                <select name="role_id" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label>@lang('site.image')</label>
                <input type="file" name="image" class="form-control image">
            </div>

            <div class="form-group">
                <img src="{{ $user->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
            </div>
            {{--roles--}}
            <div class="form-group">
                <label>Roles</label>
                <select name="role_id" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if(old('role_id',$user->role_id)) selected @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
                <a href="{{ route('dashboard.roles.create') }}">Create new role</a>
            </div>



            @php
            $models = getModels() ;
            $maps = ['create', 'read', 'update', 'delete'];
            @endphp

            {{--  <div class="form-group">
                <label>@lang('site.permissions')</label>



                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th> <input type="checkbox" name="" value="" id="select_all">اسم الصلاحية </th>
                            <th>@lang('site.create')</th>
                            <th>@lang('site.read')</th>
                            <th>@lang('site.update')</th>
                            <th>@lang('site.delete')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $index=>$model)
                        <tr>
                            <td class="bg-blue"> @lang('site.' . $model)</td>
                            <td class="bg-blue-gradient">
                                <label class="containercheckbox">
                                    <input class="checkbox" type="checkbox" name="permissions[]"
                                        {{ $user->hasPermission( 'create_' . $model) ? 'checked' : '' }}
                                        value="{{'create_' . $model }}">
                                    @lang('site.create')
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td class="bg-yellow-gradient">
                                <label class="containercheckbox">
                                    <input class="checkbox" type="checkbox" name="permissions[]"
                                        {{ $user->hasPermission( 'read_' . $model) ? 'checked' : '' }}
                                        value="{{'read_' . $model }}">
                                    @lang('site.read')
                                    <span class="checkmark"></span>
                                </label></td>
                            <td class=" bg-green-gradient">
                                <label class="containercheckbox">
                                    <input class="checkbox" type="checkbox" name="permissions[]"
                                        {{ $user->hasPermission( 'update_' . $model) ? 'checked' : '' }}
                                        value="{{'update_' . $model }}">
                                    @lang('site.update')
                                    <span class="checkmark"></span>
                                </label></td>
                            <td class="bg-red-gradient">
                                <label class="containercheckbox">
                                    <input class="checkbox" type="checkbox" name="permissions[]"
                                        {{ $user->hasPermission( 'delete_' . $model) ? 'checked' : '' }}
                                        value="{{'delete_' . $model }}">
                                    @lang('site.delete')
                                    <span class="checkmark"></span>
                                </label></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>  --}}

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
            </div>

            </form><!-- end of form -->

        </div><!-- end of box body -->

</div><!-- end of box -->

</section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
