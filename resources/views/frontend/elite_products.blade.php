@extends('layouts.app')
@section('title_page')
@lang('site.Elite_Products')
@php
$page='elite_products';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.Elite_Products')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('elite_products')}}">@lang('site.Elite_Products')</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->
<!-- START => Page Shop -->
<section class="page-shop py-5">
    <div class="container">
        <div class="products-items pb-5">
            <div class="row">
                @foreach ($products as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="item-product">
                        <div class="img">
                            <a href="{{route('product_details',['id'=>$item->id,'slug'=>make_slug($item->title)])}}">
                                <img
                                    src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}"></a>
                            <img src="{{url('/')}}/frontend/assets/imgs/elite-stamp.png" class="elite-stamp" alt="">

                        </div>
                        <a href="{{route('product_details',['id'=>$item->id,'slug'=>make_slug($item->title)])}}"
                            class="title">{{$item->title}}</a>
                        <div class="rating">
                            @for($star=1 ; $star<=$item->AvgRate;$star ++)
                                <i class="fas fa-sm fa-star active"></i>
                                @endfor
                                @for($star_off=$item->AvgRate ; $star_off< 5 ;$star_off++) <i class="fas fa-sm fa-star">
                                    </i>
                                    @endfor
                                    <span>({{$item->rates->count()}} @lang('site.rates'))</span>
                        </div>
                        <h3 class="prices">
                            <span>{{$item->total}} {{__('site.'.currncy())}}</span>
                            @if($item->discount)
                            <del>{{$item->MainPrice}}</del>
                            @endif
                        </h3>
                        <div class="add-cart d-flex align-items-center justify-content-around">
                            <a href="{{route('product_details',['id'=>$item->id,'slug'=>make_slug($item->title)])}}" class="btn-add-cart"> <i class="fas fa-lg fa-cart-plus"></i></a>
                            <a href="{{route('customer.wishlist',['product_id'=>$item->id])}}" class="btn-add-cart"> <i class="far fa-lg fa-heart"></i></a>
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
</section>
<!-- //END => Page Shop -->
@endsection
