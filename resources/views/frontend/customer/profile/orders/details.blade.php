@extends('layouts.app')
@section('title_page')
@lang('site.profile')
@php
$page='';
$profile_bar='profile';
$profile_page='orders';
@endphp
@endsection
@section('content')
<!-- START => Page Profile -->
<section class="page-profile py-5">
    <div class="container">
        <div class="profile-blocks">
            @include('partials.profile._profile_bar')
            <hr>

            <div class="row pt-2">
                <div class="col-lg-12 align-self-center">
                    <div class="box-profile profile-orders">
                        <div class="title-box-profile">
                            <strong class="h3 d-block">@lang('site.orders') (# {{$order->id}})</strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table v-middle">
                                <thead>
                                    <tr>

                                        <th>@lang('site.products')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.weights')</th>
                                        <th>@lang('site.quantity')</th>
                                        {{-- <th>@lang('site.price')</th> --}}
                                        <th>@lang('site.total')</th>

                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td># {{$item->product->title}}</td>
                                        <td>   <img src="{{$item->product->image_path}}" width="54"  height="54" alt=""></td>
                                        <td>{{$item->type}}  </td>
                                        <td> {{$item->qty}} </td>
                                        {{-- <td> {{$item->price_before_discount}} {{__('site.'.currncy())}}</td> --}}
                                        <td>{{$item->price}} {{__('site.'.currncy())}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- //END => Page Profile -->

@endsection
