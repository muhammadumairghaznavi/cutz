@extends('layouts.app')
@section('title_page')
    @lang('site.search')
    @php
    $page = 'shop';
    @endphp
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages" style="background-image: url({{ url('/') }}/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block">@lang('site.search')</strong>
        <ul>
            <li><a href="{{ route('home') }}">@lang('site.home')</a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href="{{ route('products') }}">@lang('site.search')</a></li>
        </ul>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => Page Shop -->
    <section class="page-shop py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <form action="{{ route('search') }}" method="GET">
                            @method("GET")
                            @csrf
                            <aside class="aside-filter">
                                <div class="title-filter text-center">
                                    <strong class="h4 d-block m-0">@lang('site.search')</strong>
                                    <i class="fas fa-3x fa-times btn-close-filter"></i>
                                </div>
                                <article style="display: none">
                                    <h4>@lang('site.tags')</h4>
                                    <div class="">
                                        <ul class=" d-flex
                                        align-content-center justify-content-center flex-wrap tags-names">
                                        @foreach ($tags as $item)
                                            <li class="">
                                                <input type="
                                                checkbox" name="tag_arr[]" id="chk{{ $item->id }}"
                                                {{ in_array($item->id, (array) request('tag_arr')) ? 'checked' : '' }}
                                                class="checkbox-customser" value="{{ $item->id }}">
                                                <label for="chk{{ $item->id }}" class="checkbox-labeler">
                                                    <span>{{ $item->title }}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </article>
                                <hr class="my-0">

                                <article>
                                    <h4>@lang('site.categories')</h4>
                                    <div class="scroll-y">
                                        <ul class="px-2">
                                            @foreach ($sections as $section)
                                                <li>
                                                    <strong class="btn_show_acc">{{ $section->title }} <i
                                                            class="fa fa-plus"></i></strong>
                                                    @foreach ($section->category as $category)
                                                        <div class="desc2">
                                                            <a
                                                                href="{{ route('search', ['category_id' => $category->id]) }}">
                                                                <strong class="btn_show_acc2">
                                                                    {{ $category->title }}
                                                                </strong>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </article>
                                <article class="d-none">
                                    <h4>@lang('site.categories')</h4>
                                    <div class="scroll-y">
                                        <ul class="px-2">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <strong class="btn_show_acc">{{ $category->title }} <i
                                                            class="fa fa-plus"></i></strong>
                                                    <div class="desc2">
                                                        @foreach ($category->subCategories as $subCategory)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="subCategory_arr[]"
                                                                    {{ in_array($subCategory->id, (array) request('subCategory_arr')) ? 'checked' : '' }}
                                                                    value='{{ $subCategory->id }}'
                                                                    id="customCheck{{ $subCategory->id }}">
                                                                <label class="custom-control-label"
                                                                    for="customCheck{{ $subCategory->id }}">{{ $subCategory->title }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </article>
                                <hr class="my-0">
                                <article style="display: none">
                                    <h4>@lang('site.price')</h4>
                                    <div class="mt-4 px-2">
                                        <div id="Range_price" class="range-slider">
                                            <input value="{{ $price_min }}" min="{{ $price_min }}"
                                                max="{{ $price_max }}" step="500" type="range" />
                                            <input value="{{ $price_max }}" min="{{ $price_min }}"
                                                max="{{ $price_max }}" step="0" type="range" />
                                            <svg width="100%" height="24">
                                                <line x1="4" y1="0" x2="300" y2="0" stroke="#444" stroke-width="12"
                                                    stroke-dasharray="1 28"></line>
                                            </svg>
                                            <div>
                                                <span class="float-left">
                                                    <!-- <label>From : </label> -->
                                                    <input type="number" name="price_rang_min" value="{{ $price_min }}"
                                                        min="{{ $price_min }}" max="{{ $price_max }}" />
                                                </span>
                                                <span class="float-right">
                                                    <!-- <label>To : </label> -->
                                                    <input type="number" name="price_rang_max" value="{{ $price_max }}"
                                                        min="{{ $price_min }}" max="{{ $price_max }}" />
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <hr class="my-0">
                                <article style="display: none">
                                    <div class="sortby px-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="price_sort" value="price_HtoL"
                                                class="custom-control-input">
                                            <label class="custom-control-label"
                                                for="customRadio2">@lang('site.price_HtoL')</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="price_sort" value="price_LtoH"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">@lang('site.price_LtoH')
                                            </label>
                                        </div>
                                    </div>
                                </article>

                            </aside>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="products-items pb-5">
                        <div class="row">
                            @foreach ($products as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="item-product">
                                        <div class="img">
                                            <a
                                                href="{{ route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}"><img
                                                    src="{{ $item->image_path }}" class="img-fluid"
                                                    alt="{{ $item->title }}"></a>
                                        </div>
                                        <a href="{{ route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}"
                                            class="title">{{ $item->title }}</a>
                                        {{-- <div class="rating">
                                    @for ($star = 1; $star <= $item->AvgRate; $star++)
                                        <i class="fas fa-sm fa-star active"></i>
                                        @endfor
                                        @for ($star_off = $item->AvgRate; $star_off < 5; $star_off++) <i
                                            class="fas fa-sm fa-star"></i>
                                            @endfor
                                            <span>({{$item->rates->count()}} @lang('site.rates'))</span>
                                </div> --}}
                                        <h3 class="prices">
                                            @if ($item->discount)

                                                <span>{{ $item->discount }} {{ __('site.' . currncy()) }}</span>
                                                <label><del>{{ $item->MainPrice }}</del></label>

                                            @else
                                            <span>{{ $item->MainPrice }} {{ __('site.' . currncy()) }}</span>
                                            @endif

                                        </h3>
                                        <div class="add-cart d-flex align-items-center justify-content-around">
                                            <a href="{{ route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}"
                                                class="btn-add-cart"> <i class="fas fa-lg fa-cart-plus"></i></a>
                                            <a href="{{ route('customer.wishlist', ['product_id' => $item->id]) }}"
                                                class="btn-add-cart"> <i class="far fa-lg fa-heart"></i></a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> <!-- //END row -->
                        <!-- Paginations -->
                        <div class="paginations mt-5">
                            {{ $products->appends(request()->query())->links() }}
                        </div><!-- // Paginations -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //END => Page Shop -->
@endsection
