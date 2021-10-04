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
                    <form action="{{ route('dashboard.postproductWeightsGM', ['product' => $product]) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                        </div>
                        <div class="form-group">
                            @foreach ($byGramWeights as $item)
                                <label style="padding: 5px;" for="">
                                    {!! Form::checkbox('gmweight[]', $item->id, in_array($item->id, $productWeights) ? true : false, ['class' => 'selectgm', 'id' => $item->title]) !!}
                                    {{ $item->title }}
                                    <input id="{{ $item->id }}" placeholder="Price for {{ $item->title }} Gm"
                                        class="inputPriceGM form-control" name="gmprice[]" type="text">
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
        var calculate50gm =
            @if ($product->discount)
                ({{ $product->discount }} * 50) / 1000;
            @else
                ({{ $product->price }} * 50) / 1000;
            @endif


        $('input[class="selectgm"]').on('change', function checkgm() {
            $('input[class="selectgm"]').each(function(idx, el) {
                if ($(el).is(':checked')) {
                    var selectedValue = $(el).val();
                    console.log(calculate50gm);
                    switch (selectedValue) {
                        case '14':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 3).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);

                            break;
                        case '15':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 4).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '16':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 5).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '17':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 6).toFixed(
                                2));
                                $('#' + selectedValue).prop('required', true);
                            break;
                        case '18':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 7).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '19':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 8).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '20':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 9).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '21':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 10).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '22':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 11).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '23':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 12).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '24':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 13).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '25':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 14).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        case '26':
                            $('#' + selectedValue).val(parseFloat(calculate50gm * 15).toFixed(
                                2));
                            $('.' + selectedValue).val({{ $product->stock }});
                            $('#' + selectedValue).prop('required', true);
                            break;
                        default:
                            console.log('no buddy sucks');
                    }


                } else {
                    var selectedValue = $(el).val();
                    $('#' + selectedValue).val("");
                    $('.' + selectedValue).val("");

                }
            });
        });
    </script>
@endsection
