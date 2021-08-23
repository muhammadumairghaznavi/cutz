@extends('layouts.dashboard.app')
<?php
$page="productLocations";
$title=trans('site.productLocations');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.productLocations')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.productLocations.index') }}"> @lang('site.productLocations')</a></li>
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
                <form action="{{ route('dashboard.productLocations.update', $productLocation->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                  <div class="form-group">
                        <label>@lang('site.products')</label>

                    <select class="form-control" name="product_id">
                        @foreach ($products as $product)
                        <option {{$productLocation->product_id==$product->id?'selected':''}} value="{{$product->id}}">{{$product->title}}</option>
                        @endforeach
                    </select>
                         </div>
                         <div class="form-group">
                        <label>@lang('site.locations')</label>

                    <select class="form-control" name="location_id">
                        @foreach ($locations as $location)
                        <option {{$productLocation->location_id==$location->id?'selected':''}} value="{{$location->id}}">{{$location->title}} | {{$location->address}}</option>
                        @endforeach
                    </select>
                         </div>
                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock" class="form-control" value="{{$productLocation->stock }}">
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
