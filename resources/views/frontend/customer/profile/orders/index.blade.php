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
                            <strong class="h3 d-block">@lang('site.orders')</strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table v-middle">
                                <thead>
                                    <tr>
                                        <th>@lang('site.order_number')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.status')</th>
                                        <th>@lang('site.created_at')</th>

                                        <th>@lang('site.action')</th>
                                        <th>@lang('site.rates')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td># {{$order->id}}</td>
                                        <td> {{$order->total}} {{__('site.'.currncy())}}</td>
                                        <td>{{ __('site.' . $order->status) }}</td>

                                        <td> {{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                                         <td>
                                            <a href="{{route('customer.profile.orders.details',['order_id'=>$order->id])}}" class="btn-details">@lang('site.details')</a>
                                        </td>
                                        <td>
                                            @if(!$order->rate_delivery && $order->status=='completed')
                                            <a href="" class="btn-details btn-rating" data-toggle="modal"
                                                data-target="#ratingmodal_{{$order->id}}"><i class="far fa-star"></i> @lang('site.rate')</a>
                                            @endif
                                            <!-- Rating Modal -->
                                            <div class="modal fade" id="ratingmodal_{{$order->id}}" data-toggle="modal" tabindex="-1"
                                                aria-labelledby="ratingmodalLabel">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">

                                                            <form action="{{route('customer.profile.order.rate')}}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @include('partials._errors')
                                                            <input type="hidden" name="order_id" value="{{$order->id}}" id="">
                                                                <div class="item">
                                                                    <div class="row no-gutters align-items-center">
                                                                        <div class="col-md-4">
                                                                            <img src="{{url('/')}}/frontend/assets/imgs/icons/box.svg"
                                                                                class="img-fluid" alt="">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <strong class="h4 d-block mb-3">Order
                                                                                Rating</strong>
                                                                            <div
                                                                                class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                                                                <input type="radio"  id="star{{$order->id}}5" name="rate_order" value="5"><label for="star{{$order->id}}5" title="5 star"></label>
                                                                                <input type="radio"  id="star{{$order->id}}4" name="rate_order" value="4"><label for="star{{$order->id}}4" title="4 star "></label>
                                                                                <input type="radio"  id="star{{$order->id}}3" name="rate_order" value="3"><label for="star{{$order->id}}3" title="3 star"></label>
                                                                                <input type="radio"  id="star{{$order->id}}2"  name="rate_order" value="2"><label for="star{{$order->id}}2" title="2 star"></label>
                                                                                <input type="radio"  id="star{{$order->id}}1" name="rate_order" value="1"><label for="star{{$order->id}}1" title="1 star"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="item">
                                                                    <div class="row no-gutters align-items-center">
                                                                        <div class="col-md-4">
                                                                            <img src="{{url('/')}}/frontend/assets/imgs/icons/shipping.svg"
                                                                                class="img-fluid" alt="">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <strong class="h4 d-block mb-3">Delivary
                                                                                Rating</strong>
                                                                            <div
                                                                                class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                                                            <input type="radio"  id="star{{$order->id}}10"  name="rate_delivery" value="5"><label  for="star{{$order->id}}10" title="5 star"></label>
                                                                                <input type="radio"  id="star{{$order->id}}9" name="rate_delivery" value="4"><label for="star{{$order->id}}9" title="4 star"></label>
                                                                                <input type="radio"  id="star{{$order->id}}8" name="rate_delivery" value="3"><label for="star{{$order->id}}8" title="3 star"></label>
                                                                            <input type="radio"  id="star{{$order->id}}7"  name="rate_delivery" value="2"><label    for="star{{$order->id}}7" title="2 star"></label>
                                                                                <input type="radio"  id="star{{$order->id}}6" name="rate_delivery" value="1"><label for="star{{$order->id}}6" title="1 star"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-button-submit mt-4 text-right">
                                                                    <button type="submit"
                                                                        class="btn-details btn-rating btn-adding-rates"><i
                                                                            class="far fa-star"></i> Add Rate</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
