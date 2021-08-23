@extends('layouts.dashboard.app')
<?php
$page="promocodes";
$title=trans('site.promocodes');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.promocodes')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.promocodes.index') }}"> @lang('site.promocodes')</a></li>
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
                <form action="{{ route('dashboard.promocodes.update', $promocode->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="col-md-6">
                        @foreach (config('translatable.locales') as $key=> $locale)
                        <div class="form-group">
                            <span class="label label-warning  ">{{$key+1}} </span>
                            <label>@lang('site.' . $locale .'.title')</label>
                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                value="{{ $promocode->translate($locale)->title }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.' . $locale . '.description')</label>
                            <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                                rows="5">{{ $promocode->translate($locale)->description }}</textarea>
                        </div>
                        @endforeach
                    </div>{{-- end col-md-6 --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.code')</label>
                            <input type="text" name="code" class="form-control" value="{{ $promocode->code }}">
                        </div>


                        <div class="form-group">
                            <label>@lang('site.startDate')</label>
                            <input type="date" name="startDate" class="form-control" value="{{ $promocode->startDate }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.endDate')</label>
                            <input type="date" name="endDate" class="form-control" value="{{ $promocode->endDate }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.type')</label>
                            <select name="type" class="form-control" id="">
                                <option value="amount" {{ $promocode->type=='amount'?'selected':''   }} >@lang('site.amount')</option>
                                <option value="percent" {{ $promocode->type=='percent'?'selected':''   }} >@lang('site.percent')</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.discount_amount')</label>
                            <input type="number" name="discount_amount" class="form-control"
                                value="{{ $promocode->discount_amount   }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.status')</label>
                            <select name="status" class="form-control" id="">
                                <option {{ $promocode->status=='active'?'selected':''   }}  value="active">@lang('site.active')</option>
                                <option {{ $promocode->status=='notActive'?'selected':''   }}  value="notActive">@lang('site.not_active')</option>
                            </select>
                        </div>



                    </div>{{-- end col-md-6 --}}


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                            @lang('site.edit')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
