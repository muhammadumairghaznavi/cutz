@extends('layouts.app')
@section('title_page')
@lang('site.wishlist')
@php
$page='wishlist';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.wishlist')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="">@lang('site.wishlist')</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->

<!-- START => Page Wishlist -->
<section class="page-wishlist">
    <div class="container">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="table-head">
                        <th scope="col">@lang('site.image')</th>
                        <th scope="col">@lang('site.title')</th>
                        <th scope="col">@lang('site.price')</th>
                        <th scope="col">@lang('site.action')</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($wishlists as $wishlist)
                    <tr>
                        <td>
                            <a
                                href="{{route('product_details',['id'=>$wishlist->product->id,'slug'=>make_slug($wishlist->product->title)])}}"><img
                                    src="{{$wishlist->product->image_path}}" alt=""></a>
                        </td>
                        <td>
                            <a
                                href="{{route('product_details',['id'=>$wishlist->product->id,'slug'=>make_slug($wishlist->product->title)])}}">{{$wishlist->product->title}}</a>
                        </td>
                        <td>
                            <h2>{{$wishlist->product->total}} {{__('site.'.currncy())}}</h2>
                        </td>
                        <td class="actions">
                            <a href="{{route('customer.wishlist.delete',['id'=>$wishlist->id])}}" class="mr-3"><i
                                    class="fas fa-lg fa-times"></i> </a>
                            <a href="{{route('product_details',['id'=>$wishlist->product->id,'slug'=>make_slug($wishlist->product->title)])}}"
                                class=""><i class="fas fa-lg fa-cart-plus"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            @lang('site.no_data_found')

                        </td>
                    </tr>

                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-left" colspan="2"><a href="{{route('products')}}" class="btn-checkout my-4">
                                @lang('site.Back To Shop')
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</section>
<!-- //END => Page Wishlist -->
@endsection
