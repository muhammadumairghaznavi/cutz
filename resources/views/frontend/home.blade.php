@extends('layouts.app')
@section('title_page')
    @lang('site.home')
    @php
    $page = 'home';
    @endphp
@endsection
@section('content')
    @isset($message)
        <div class="alert alert-success">
            <strong>{{ @message }}</strong>
        </div>
        @endif
        <!-- START => Home Slider -->
        <section class="sec-slider">
            <div class="container-fluid">
                <div id="slider-home" class="home-slider owl-carousel owl-theme">
                    @foreach ($sliders as $item)
                        <!-- Block Item -->
                        <div class="item" style="background-image: url('{{ $item->image_path }}');">
                            <!--<img src="" class="img-fluid img-slide" alt="Image"> -->
                            <div class="item-txt text-left">
                                <h1 data-animation-in="fadeInDown animate-300ms" data-animation-out="">
                                    <span>{{ $item->title }}</span>
                                    <span>{{ $item->short_description }}</span>
                                </h1>
                                <div class="fade-text">
                                    <p data-animation-in="fadeInDown animate-500ms" data-animation-out="">
                                        {{ $item->description }}
                                    </p>
                                </div>
                                @if ($item->link)

                                    <a href="{{ $item->link }}" class="btn-slider">Shop Now</a>
                                @endif
                            </div>
                        </div>
                        <!-- //=> Block Item -->
                    @endforeach
                </div>
            </div>
        </section>
        <!-- //END => Home Slider -->

        @if ($setting->link_youtube)
            <!-- START => BG Parallax -->
            <div class="bg-customize parallax-window-one" data-parallax="scroll"
                data-image-src="{{ url('/') }}/frontend/assets/imgs/bg-after-slider-2.jpg">
                <a href="{{ $setting->link_youtube }}" class="btn-play-vid" data-fancybox>
                    <i class="fas fa-play"></i>
                </a>
            </div>
            <!-- //END => BG Parallax -->
        @endif


        <!-- START => Meat packaged -->

        </div>
        </section>
        <a href="search?section_id=11">
            <section class="sec-meat-packaged parallax-window-two"
                style="background-image:url('{{ url('/') }}/frontend/assets/imgs/meatbg.png')">

            </section>
        </a>
        <!-- //END => Meat packaged -->
        @if (count($bestSellers) > 0)
            <section class="sec-related sec_seller_bg py-5">
                <div class="container">
                    <div class="sec-title text-left mb-4">
                        <strong class="title h3 d-block">@lang('site.Our Best Sellers')</strong>
                    </div>

                    <div class="slides-related owl-carousel owl-theme">
                        @foreach ($bestSellers as $item)
                            <div class="item-product">
                                <div class="img">
                                    <a
                                        href="{{ route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}"><img
                                            src="{{ $item->image_path }}" class="img-fluid"
                                            alt="{{ $item->title }}"></a>
                                </div>
                                <a href="{{ route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}"
                                    class="title">{{ $item->title }}</a>
                                <div class="rating">
                                    @for ($star = 1; $star <= $item->AvgRate; $star++)
                                        <i class="fas fa-sm fa-star active"></i>
                                    @endfor
                                    @for ($star_off = $item->AvgRate; $star_off < 5; $star_off++) <i
                                            class="fas fa-sm fa-star"></i>
                                    @endfor
                                    <span>({{ $item->rates->count() }} @lang('site.rates'))</span>
                                </div>
                                <h3 class="prices">
                                    <span>{{ $item->total }} {{ __('site.' . currncy()) }}</span>
                                    @if ($item->discount)
                                        <del>{{ $item->MainPrice }}</del>
                                    @endif
                                </h3>
                                <div class="add-cart d-flex align-items-center justify-content-around">
                                    <a href="{{ route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}"
                                        class="btn-add-cart"> <i class="fas fa-lg fa-cart-plus"></i></a>
                                    <a href="{{ route('customer.wishlist', ['product_id' => $item->id]) }}"
                                        class="btn-add-cart">
                                        <i class="far fa-lg fa-heart"></i></a>
                                </div>
                            </div>
                        @endforeach




                    </div>

                </div>
            </section>
        @endif



        <!-- START => Poultry is packaged -->
        <a href="search?section_id=14">
            <section class="sec-poultry-packaged parallax-window-two"
                style="background-image:url('{{ url('/') }}/frontend/assets/imgs/Poultry.png')">

            </section>
        </a>
        <!-- //END => Poultry is packaged -->



        <!-- START => Seafood packaged -->


        <a href="search?section_id=13">
            <section class="sec-seafood-packaged parallax-window-two"
                style="background-image:url('{{ url('/') }}/frontend/assets/imgs/seafoodbg.png')">

            </section>
        </a>
        <!-- //END => Seafood packaged -->
        <section class="sec-care-customers parallax-window-two" data-speed=".2" data-parallax="scroll"
            data-image-src="{{ url('/') }}/frontend/assets/imgs/ourclientsays.jpeg"
            style="background-size: cover; display: grid; align-items: center; justify-content: center; height: 100vh;">

            <div class="txt text-center">
                <strong class="title h1 d-block">@lang('site.our_client_say')</strong>
            </div>
            <div class="container"
                style="box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); border-radius: 5px; background-color: rgba(255, 255, 255, .15); backdrop-filter: blur(5px);">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($reviews as $key => $slider)

                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="carousel-caption">


                                    <h5 class="txt">“{{ $slider->comment }}”</h5>

                                    @foreach (range(1, 5) as $i)
                                        <span class="fa-stack" style="width:1em; color:rgb(173 30 49)">
                                            <i class="far fa-star fa-stack-1x"></i>

                                            @if ($slider->review > 0)
                                                @if ($slider->review > 0.5)
                                                    <i class="fas fa-star fa-stack-1x" style="color:rgb(173 30 49)"></i>
                                                @else
                                                    <i class="fas fa-star-half fa-stack-1x" style="color:rgb(173 30 49)"></i>
                                                @endif
                                            @endif
                                            @php $slider->review--; @endphp
                                        </span>
                                    @endforeach
                                    <br>

                                </div>
                            </div>
                        @endforeach

                    </div> <a class="carousel-control-prev" href="#demo" data-slide="prev"> <i class='fas fa-arrow-left'></i>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next"> <i class='fas fa-arrow-right'></i> </a>
                </div>
            </div>
            <div class="txt text-center">
                <a href="{{ url('reviews_page') }}" class="btn btn-primary">@lang('site.View_All')</a>

            </div>
        </section>

        <!-- START => Categories Site -->
        <section class="sec-catgs-sites parallax-window-two" data-speed=".2" data-parallax="scroll"
            data-image-src="{{ url('/') }}/frontend/assets/imgs/bg-catgs.jpg">
            <div class="container">
                <div class="row align-items-center align-content-center text-center hvh-100">
                    @foreach ($categories as $item)
                        <div class="col-lg-3 col-md-4 col-6">
                            {{-- <a href="{{route('subCategories',['id'=>$item->id,'title'=>make_slug($item->title)])}}" --}}
                            <a href="{{ route('search', ['category_id' => $item->id]) }}" class="catgss-item">
                                <div class="img">
                                    <img src="{{ $item->image_path }}" alt="">
                                </div>
                                <strong class="h5">{{ $item->title }}</strong>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- //END => Categories Site -->


        <!-- START => Care for our Customers -->
        <section class="sec-care-customers parallax-window-two" data-speed=".2" data-parallax="scroll"
            data-image-src="{{ url('/') }}/frontend/assets/imgs/bg-care-customer.jpg">
            <div class="container-fluid d-flex justify-content-center align-items-center hvh-100">
                <div class="txt text-center">
                    <strong class="title h1 d-block">@lang('site.Our_Specialty')</strong>
                    <div class="care-icons d-flex align-items-center justify-content-between">
                        <div class="text-center">



                            <!--<a href="{{ route('page', ['type' => 'greenFeed']) }}">-->
                            <strong>
                                <i class="icon-lamb"></i>
                                <strong>@lang('site.greenFeed')</strong>
                            </strong>
                        </div>
                        <div class="text-center">

                            <!--<a href="{{ route('page', ['type' => 'convenientVacuum']) }}">-->
                            <strong>
                                <i class="icon-box"></i>
                                <strong>@lang('site.convenientVacuum')</strong>
                            </strong>
                        </div>
                        <div class="text-center">

                            <a href="{{ route('page', ['type' => 'internationalQualityCertificates']) }}">

                                <i class="icon-certification"></i>
                                <strong>@lang('site.internationalQualityCertificates')</strong>
                            </a>
                        </div>
                        <div class="text-center">
                            <!--<a href="{{ route('page', ['type' => 'professionalCutting']) }}">-->
                            <strong>
                                <i class="icon-cleaver-knife"></i>
                                <strong>@lang('site.professionalcutty')</strong>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //END => Care for our Customers -->



    @endsection
