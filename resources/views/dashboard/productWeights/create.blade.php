@extends('layouts.dashboard.app')
<?php
$page="productWeights";
$title=trans('site.productWeights');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.productWeights')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.productWeights.index') }}"> @lang('site.productWeights')</a></li>
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
                <form action="{{ route('dashboard.productWeights.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <input type="hidden" name="product_id" value="{{$product_id}}" id="">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.weights')</label>
                        <select name="weight_id" class="form-control" id="">
                            @foreach ($weights as $weight)
                                <option value="{{$weight->id}}">{{$weight->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.price')</label>
                        <input type="number" name="price"  class="form-control" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="number" name="stock"  class="form-control" value="{{old('stock')}}">
                    </div>





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
