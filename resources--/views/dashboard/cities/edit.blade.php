@extends('layouts.dashboard.app')
<?php
$page="cities";
$title=trans('site.cities');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.cities')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.cities.index') }}"> @lang('site.cities')</a></li>
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
                <form action="{{ route('dashboard.cities.update', $city->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                       <div class="form-group">
                        <span>@lang('site.countries')</span>
                        <select name="country_id" id="" class="form-control">
                            @foreach ($countries as $item)
                            <option value="{{$item->id}}"  {{$city->country_id==$item->id?'selected':''}}>{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach (config('translatable.locales') as $key=> $locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                            value="{{ $city->translate($locale)->title }}">
                    </div>
                    @endforeach
                        <div class="form-group">
                          <label>@lang('site.price')</label>
                       <input type="number" name="price" class="form-control" value="{{$city->price}}" id="">
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
