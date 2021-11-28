@extends('layouts.app')
@section('title_page')
    @lang('site.Reviews Page')
    @php
    $page = 'reviews_page';
    @endphp
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages"
        style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block">@lang('site.Reviews Page')</strong>
        <ul>
            <li><a href="{{ route('home') }}">@lang('site.home')</a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href="{{ url($page) }}">@lang('site.Reviews Page')</a></li>
        </ul>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => Page Shop -->
    <section class="page-shop py-5">
        <div class="container">
            <div class="txt text-center">
                <strong class="title h1 d-block">Our Clients Say</strong>
            </div>
            <div class="row">

                @foreach ($reviews as $item)
                    <div class="col-md-4" style="margin-bottom: 15px;">
                        <div class="card" style="min-height: 344px">
                            <div class="card-body">
                                <h4 class="card-title"><img
                                        src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png">
                                </h4>
                                <div class="template-demo">
                                    <p>{{ $item->comment }}</p>
                                </div>
                                <hr>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-2"> <img class="profile-pic"
                                            src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>
                                    <div class="col-sm-10">
                                        <div class="profile">

                                            <p class="cust-profession">

                                                @foreach (range(1, 5) as $i)
                                                    <span class="fa-stack" style="width:1em; color:rgb(223, 56, 89)">
                                                        <i class="far fa-star fa-stack-1x"></i>

                                                        @if ($item->review > 0)
                                                            @if ($item->review > 0.5)
                                                                <i class="fas fa-star fa-stack-1x"
                                                                    style="color:rgb(223, 56, 89)"></i>
                                                            @else
                                                                <i class="fas fa-star-half fa-stack-1x"
                                                                    style="color:rgb(223, 56, 89)"></i>
                                                            @endif
                                                        @endif
                                                        @php $item->review--; @endphp
                                                    </span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach


            </div>
            <div class="paginations mt-5">
                {{ $reviews->appends(request()->query())->links() }}
            </div>


    </section>
    <!-- //END => Page Shop -->
@endsection
