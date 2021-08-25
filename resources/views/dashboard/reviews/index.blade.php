@extends('layouts.dashboard.app')
<?php
$page = 'reviews';
$title = trans('site.reviews');
// to hide any section please type -> close
$reviews_search = '';
$reviews_add = ' ';
$reviews_edit = ' ';
$reviews_delete = ' ';
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.reviews')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('site.reviews')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.reviews')
                        <small>
                            @lang('site.total_search')
                            ( {{ $reviews->count() }} )
                        </small>
                    </h3>
                    <form action="{{ route('dashboard.reviews.index') }}" method="get">
                        <div class="row">
                            <div class="{{ $reviews == 'close' ? 'hidden' : '' }}">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                        value="{{ request()->search }}">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        @lang('site.search')</button>
                                </div>
                            </div>
                            <div class="col-md-4 {{ $reviews_add == 'close' ? 'hidden' : '' }}">
                                @if (auth()->user()->hasPermission('reviews'))
                                    <a href="{{ route('dashboard.reviews.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add')</a>
                                @endif
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                <div class="box-body">
                    @if ($reviews->count() > 0)
                        <table class="table table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>Review</th>
                                    {{-- <th>@lang('site.description')</th> --}}
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $index => $review)
                                    <tr>

                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @foreach (range(1, 5) as $i)
                                                <span class="fa-stack" style="width:1em; color:rgb(223, 56, 89)">
                                                    <i class="far fa-star fa-stack-1x"></i>

                                                    @if ($review->review > 0)
                                                        @if ($review->review > 0.5)
                                                            <i class="fas fa-star fa-stack-1x"
                                                                style="color:rgb(223, 56, 89)"></i>
                                                        @else
                                                            <i class="fas fa-star-half fa-stack-1x"
                                                                style="color:rgb(223, 56, 89)"></i>
                                                        @endif
                                                    @endif
                                                    @php $review->review--; @endphp
                                                </span>
                                            @endforeach
                                        </td>
                                        <td> {{ $review->comment }}</td>
                                        <td> <input type="checkbox" data-id="{{ $review->id }}" name="status"
                                                class="js-switch" {{ $review->status == 1 ? 'checked' : '' }}></td>
                                        <td>
                                            @if (auth()->user()->hasPermission('delete_reviews'))
                                                <form action="{{ route('dashboard.reviews.destroy', $review->id) }}"
                                                    method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form><!-- end of form -->
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                                    @lang('site.delete')</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- end of table -->

                    @else
                        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                    @endif
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
