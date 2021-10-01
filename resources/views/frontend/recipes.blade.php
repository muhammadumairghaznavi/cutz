@extends('layouts.app')
@section('title_page')
    @lang('site.recipes')
    @php
    $page = 'Recipes';
    @endphp
@endsection

@section('content')
    <div class="breadcrumb-pages" style="background-image: url({{ url('/') }}/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block">@lang('site.recipes')</strong>
        <ul>
            <li><a href="{{ route('home') }}">@lang('site.home')</a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li>@lang('site.recipes')</li>
        </ul>
    </div>

    <section style="padding-top: 8rem!important;" class="page-contact pt-5 pb-5">
        <div class="container">

            <div class="txt text-center">
                <h1 style="">@lang('site.ComingSoon')</h1>
            </div>

        </div>

    </section>

@endsection
