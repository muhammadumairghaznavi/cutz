@extends('layouts.dashboard.app')
<?php
$page = 'productWeights';
$title = trans('site.productWeights');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.productWeights')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a> @lang('site.productWeights')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">
                    <label for="">Note* : @lang('site.checkuncheck')</label>
                    @include('partials._errors')
                    <form action="{{ route('dashboard.postproductWeightsKG', ['product' => $product]) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                        </div>
                        <div class="form-group">
                            @foreach ($byKilogramWeights as $item)
                                <label style="padding: 5px;" for="">
                                    {!! Form::checkbox('kgweight[]', $item->id, in_array($item->id, $productWeights) ? true : false, ['class' => 'selectkg', 'id' => $item->title]) !!}
                                    {{ $item->title }}
                                    <input id="{{ $item->id }}" placeholder="Price for {{ $item->title }} KG"
                                        class="inputPriceKG form-control" name="kgprice[]" type="text">
                                    <br>
                                    <input placeholder="Stock for {{ $item->title }}" type="hidden" name="stock[]"
                                        class="{{ $item->id }} form-control">
                                </label>
                            @endforeach
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
    <script>
        var calculate500gm =
            @if ($product->discount)
                ({{ $product->discount }} / 2);
            @else
                ({{ $product->price }} / 2);

            @endif({{ $product->price }} / 2);

        $('input[class="selectkg"]').on('change', function checkkg() {
            $('input[class="selectkg"]').each(function(idx, el) {
                if ($(el).is(':checked')) {
                    var selectedValue = $(el).val();
                    switch (selectedValue) {
                        case '27':
                            $('#' + selectedValue).val(parseFloat(calculate500gm).toFixed(2));
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '28':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 2).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '29':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 3).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '30':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 4).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '31':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 5).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '32':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 6).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '33':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 7).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '34':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 8).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '35':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 9).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '36':
                            $('#' + selectedValue).val(parseFloat(calculate500gm * 10).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        default:
                            console.log('no buddy sucks');
                    }

                } else {
                    var selectedValue = $(el).val();
                    $('#' + selectedValue).val("");
                }
            });
        });
    </script>
@endsection
