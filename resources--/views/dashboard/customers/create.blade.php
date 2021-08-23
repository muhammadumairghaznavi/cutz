@extends('layouts.dashboard.app')
<?php
$page="customers";
$title=trans('site.customers');
?>
@section('title_page')
{{$title}}
@endsection


@section('content')


    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.customers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.customers.index') }}"> @lang('site.customers')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.customers.store') }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.full_name')</label>
                                    <input required="required"  type="text" name="full_name" class="form-control" value="{{old('full_name')}}"  >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input required="required"  type="text" name="email" class="form-control" value="{{old('email')}}"  >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input required="required"  type="phone" name="phone" class="form-control"  value="{{old('phone')}}"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  >
                                </div>
                             </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control"   required >
                                        <option value="1" @if(old('status') == '1') selected @endif>@lang('site.Active')</option>
                                        <option value="2" @if(old('status') == '2') selected @endif>@lang('site.In-Active')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.gender')</label>
                                    <select name='gender' class="form-control"   required >
                                        <option value="male" @if(old('gender') == 'male') selected @endif>@lang('site.male')</option>
                                        <option value="female" @if(old('gender') == 'female') selected @endif>@lang('site.female')</option>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label>@lang('site.password')</label>
                                    <input required="required"  type="password" name="password" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.password_confirmation')</label>
                                    <input required="required"  type="password" name="password_confirmation" class="form-control" >
                                </div>



                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add') </button>
                                </div>
                            </div>


                        </div>


                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
