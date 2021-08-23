@extends('layouts.dashboard.app')
<?php
$page="rates";
$title=trans('site.rates');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.rates')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.rates.index') }}"> @lang('site.rates')</a></li>
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
                <form action="{{ route('dashboard.rates.update', $rate->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group">
                        <label>@lang('site.customers')</label>
                        <select name="customer_id" id="" class="form-control">
                            @foreach ($customers as $item)
                            <option {{ $rate->customer_id==$item->id ?'selected':'' }} value="{{$item->id}}">
                                {{$item->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.products')</label>
                        <select name="product_id" id="" class="form-control">
                            @foreach ($products as $item)
                            <option {{ $rate->product_id==$item->id ?'selected':'' }} value="{{$item->id}}">
                                {{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.rate')</label>
                        <select name="rate" id="" class="form-control">

                            <option value="1" {{ $rate->rate==1 ?'selected':'' }}> stars(1) </option>
                            <option value="2" {{ $rate->rate==2 ?'selected':'' }}> stars(2) </option>
                            <option value="3" {{ $rate->rate==3 ?'selected':'' }}> stars(3) </option>
                            <option value="4" {{ $rate->rate==4 ?'selected':'' }}> stars(4) </option>
                            <option value="5" {{ $rate->rate==5 ?'selected':'' }}> stars(5) </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('site.feedback')</label>
                        <textarea name="feedback" class="form-control" cols="30"
                            rows="10">{{ $rate->feedback }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.status')</label>
                        <select name="status" id="" class="form-control">

                            <option value="active" {{ $rate->status=="active" ?'selected':'' }}> @lang('site.active')
                            </option>
                            <option value="not_active" {{ $rate->status=="not_active" ?'selected':'' }}>
                                @lang('site.not_active') </option>
                        </select>
                    </div>

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
