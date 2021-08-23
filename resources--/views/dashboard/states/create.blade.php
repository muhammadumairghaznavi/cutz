@extends('layouts.dashboard.app')
<?php
$page="states";
$title=trans('site.states');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.states')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.states.index') }}"> @lang('site.states')</a></li>
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
                <form action="{{ route('dashboard.states.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <span>@lang('site.countries')</span>
                        <select name="city_id" id="" class="form-control">
                            @foreach ($cites as $item)

                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach (config('translatable.locales') as $key=>$locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale . '.title')</label>
                        <input type="text" required="required" name="{{ $locale }}[title]" class="form-control"
                            value="{{ old($locale . '.title') }}">
                    </div>
                    @endforeach
                    <!--<div class="form-group">-->
                    <!--    <label>@lang('site.price')</label>-->
                    <!--    <input type="number" name="price" class="form-control" value="{{old('price')}}" id="">-->
                    <!--</div>-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
