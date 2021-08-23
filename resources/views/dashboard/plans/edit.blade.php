@extends('layouts.dashboard.app')
<?php
$page="plans";
$title=trans('site.plans');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.plans')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.plans.index') }}"> @lang('site.plans')</a></li>
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
                <form action="{{ route('dashboard.plans.update', $plan->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="form-group">
                        <label>@lang('site.services')</label>
                        <select required="required" name="service_id" id="" class="form-control">
                            <option value="">@lang('site.services')</option>

                            @foreach ($services as $service)
                            <option value="{{$service->id}}" {{$plan->service_id == $service->id ?'selected' : ''}} >{{$service->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach (config('translatable.locales') as $key=> $locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                            value="{{ $plan->translate($locale)->title }}">
                    </div>
                        <div class="form-group">
                        <label>@lang('site.' . $locale . '.short_description')</label>
                        <textarea required="required"  name="{{ $locale }}[short_description]" id="" class="form-control   " cols="30" rows="5">{{$plan->translate($locale)->short_description }}</textarea>
                        </div>

                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                            rows="15">{{ $plan->translate($locale)->description }}</textarea>
                    </div>
                    @endforeach

                        {{-- EGY Price --}}
                    <div class="form-group col-md-6">
                        <label>@lang('site.price_egy') </label>
                        <input type="price" name="price_egy" class="form-control" required="required"
                            value="{{ $plan->price_egy}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('site.offer_egy') </label>
                        <input type="price" name="offer_egy" class="form-control" value="{{ $plan->offer_egy }}">
                    </div>
                    {{-- USD Price --}}

                    <div class="form-group col-md-6">
                        <label>@lang('site.price_usd') </label>
                        <input type="price" name="price_usd" class="form-control" required="required"
                            value="{{ $plan->price_usd }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang('site.offer_usd') </label>
                        <input type="price" name="offer_usd" class="form-control" value="{{ $plan->offer_usd }}">
                    </div>

                    {{-- time_period --}}

                    <div class="form-group  ">
                        <label>@lang('site.time_period') </label>
                        <select name="time_period" class="form-control" id="">
                            <option value="Monthly"  {{$plan->time_period=='Monthly'?'selected' : ''}}>Monthly</option>
                            <option value="Yearly"  {{$plan->time_period=='Yearly'?'selected' : ''}}>Yearly</option>
                            <option value="Once"  {{$plan->time_period=='Once'?'selected' : ''}}>Once</option>
                        </select>
                     </div>

                      <div class="form-group  ">
                        <label>@lang('site.background_color') </label>
                        <select  class="form-control" name="background_color" id="">
                            <option value="green" {{$plan->background_color =='green'?'selected':''}} style=" background-color: #00BFA1;">اخضر</option>
                            <option value="blue" {{$plan->background_color =='blue'?'selected':''}} style=" background-color: #2368FF;">ازرق </option>
                            <option value="orange" {{$plan->background_color =='orange'?'selected':''}} style=" background-color: #FF6515;">برتقالي</option>

                        </select>
                     </div>

                    {{-- Image --}}

                    {{-- <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                    <div class="form-group">
                        <img src="{{ $plan->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                            alt="">
                    </div> --}}






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
