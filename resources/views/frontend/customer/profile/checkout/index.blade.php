@extends('layouts.app')
@section('title_page')
@lang('site.cart')
@php
$page='cart';
@endphp
@endsection
@section('content')
<!-- START Section => Products NEW ARRIVALS -->
<section class="page-checkout py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="payment-checkout">
                <hr style="background-color: #fff" />
                @if ($address)
                    @include('frontend.customer.profile.checkout.showAddress')
                    @include('frontend.customer.profile.checkout.formPromoCode')
                    @include('frontend.customer.profile.checkout.formPymentMethod')
                @else
                    @include('frontend.customer.profile.checkout.formCreateAddress')
                @endif
                </div>
            </div>
             <div class="col-md-5">
                <div class="box-cart">
                    <strong class="h5 d-block text-center">@lang('site.products')</strong>
                    <ul class="">
                        <li class="scroll-y">
                            @forelse ($carts as $cart)
                            <div class="item">
                                <div class="img">
                                    <img src="{{$cart->product->image_path}}" class="img-fluid"
                                        alt="{{$cart->product->title}}">
                                </div>
                                <div class="txt">
                                    <a
                                        href="{{route('product_details',['id'=>$cart->product->id,'slug'=>make_slug($cart->product->title)])}}">{{$cart->product->title}}</a>
                                @if(!$cart->productWeight_id)
                                <p class="qty">  {{$cart->type ? 'wheight  = '. $cart->type .' G':'' }}</p>
                                <p class="qty">{{$cart->type?$cart->product->Total *(int)($cart->type) /1000: $cart->product->Total}} * {{$cart->qty}}</p>
                                @else
                                    @php
                                        $productWeight=App\ProductWeight::find($cart->productWeight_id);
                                    @endphp

                                <p class="qty">{{$cart->productWeight->price}}* {{$cart->qty}}  -  {{$productWeight->weight->title}}   </p>
                                @endif

                                        {{-- <p class="qty">@lang('site.quantity'): {{$cart->product->total}}* {{$cart->qty}}</p> --}}
                                    <p class="price">{{$cart->type?$cart->product->Total *$cart->qty*(int)($cart->type) /1000: $cart->product->Total * $cart->qty}} {{__('site.'.currncy())}}</p>
                                    {{-- <p class="price">{{__('site.additions')}}</p> --}}
                                    @forelse ($cart->cart_detials as $cart_detial)
                                    <span> {{$cart_detial->addtion->title}} : </span>
                                    {{$cart_detial->addtion->price}}*{{$cart_detial->qty}}
                                    {{-- = {{$cart_detial->TotalCartDetails}} --}}
                                    <br>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            @empty
                            @lang('site.no_data_found')
                            @endforelse
                        </li>
                        <li class="li-promocode d-none">
                            <hr>
                            @if (!session()->has('coupon'))
                            @include('partials._errors')
                            <form action="{{route('customer.checkout.applyPromo')}}" method="POST">
                                @csrf
                                <input type="text" name="code" placeholder="@lang('site.Enter Your Coupon Code')">
                                <button type="submit"> @lang('site.apply') </button>
                            </form>
                            @endif
                        </li>
                        <li class="total-prices px-3">
                            @if (session()->has('coupon'))
                            <p class="d-flex align-items-center justify-content-between">
                              <span>@lang('site.coupon') </span>
                              <span class="price float-right">
                                ({{ session()->get('coupon')['name'] }})
                                <a href="{{route('customer.promocode.remove')}}"> @lang('site.delete')</a>
                              </span>
                            </p>
                            <p class="d-flex align-items-center justify-content-between">
                                <span>@lang('site.discount') </span>
                                <span> {{session()->get('coupon')['discount']}} {{__('site.'.currncy())}} </span>
                            </p>
                            @endif

                            @if (session()->has('delivery'))
                            <p class="d-flex align-items-center justify-content-between">
                                <span>@lang('site.Shipping Fees') </span>
                                <span class="price float-right">
                                    {{session()->get('delivery')['state']}}
                                   -
                                    {{session()->get('delivery')['amount']}} {{__('site.'.currncy())}}
                                    <a href="{{route('customer.calculate_delivery_cost.remove')}}" class="del_shipfess">
                                        @lang('site.chagne address')</a>
                                </span>
                            </p>
                            @endif

                            <hr>
                        </li>
                        <li class="total d-flex align-items-center justify-content-between">
                            <strong>@lang('site.total')</strong>
                            <strong class="price-total">{{$sum}}{{__('site.'.currncy())}} </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //END Section => Products NEW ARRIVALS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="city_id"]').on('change', function () {
            var item = $(this).val();
            //alert(item);
            $('select[name="state_id"]').empty();
            if (item) {
                $.ajax({
                    url: '/area_list/ajax/' + item,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('select[name="state_id"]').append(
                                `<option  value="${value.id}">${value.title}</option>`
                            ).selectric();
                        });
                    }
                });
            }
        }); //end of  city_id
    });
</script>
@endsection
