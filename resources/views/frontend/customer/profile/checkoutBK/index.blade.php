@extends('layouts.app')
@section('title_page')
@lang('site.cart')
@php
$page='cart';
@endphp
@endsection
@section('content')
<!-- START => Page Checkout -->
<section class="sec-checkout pt-5 pb-5">
    <div class="container">
        <hr>
        <div class="row">
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

                                <p class="qty">{{$cart->product->total}}* {{$cart->qty}}</p>
                                @else
                                    @php
                                        $productWeight=App\ProductWeight::find($cart->productWeight_id);
                                    @endphp

                                <p class="qty">{{$cart->productWeight->price}}* {{$cart->qty}}  -  {{$productWeight->weight->title}}   </p>
                                @endif

                                        {{-- <p class="qty">@lang('site.quantity'): {{$cart->product->total}}* {{$cart->qty}}</p> --}}
                                    <p class="price">{{$cart->TotalCart}} {{__('site.'.currncy())}}</p>
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
                        <li class="li-promocode">
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
                                    <br>
                                    {{session()->get('delivery')['amount']}} {{__('site.'.currncy())}}
                                    <a href="{{route('customer.calculate_delivery_cost.remove')}}">
                                        @lang('site.delete')</a>
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
            <div class="col-md-7">

                @if (!session()->has('delivery'))
                <div class="box-cart">
                    <strong class="h5 d-block text-center">@lang('site.Calculate_shipping_cost')</strong>
                </div>
                <form action="{{route('customer.checkout.calculate_delivery_cost')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>@lang('site.cities')</label>
                        <select name='city_id' class="form-control city_id" required="required">
                            <option value="">@lang('site.cities')</option>
                            @foreach($cities as $city )
                            <option value="{{$city->id}}" @if(old('city_id')==$city->id ) selected
                                @endif>{{$city->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.states')</label>
                        <select name='state_id' class="form-control state_id" required="required">
                            <option value="">@lang('site.states')</option>
                            @foreach($states as $state )
                            <option value="{{$state->id}}" @if(old('state')==$state->id ) selected
                                @endif>{{$state->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-center mt-5">
                        <button class="btn-checkout">@lang('site.Calculate')</button>
                    </div>
                </form>



                @endif



   @if (session()->has('delivery'))
                <div class=" ">
                    <div class="box-cart">
                        <strong class="h5 d-block text-center">@lang('site.delivery_info')</strong>
                    </div>

                    <form method="post" action="{{route('customer.checkout')}}" class="checkout-form">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" required="required"
                                placeholder="@lang('site.name')" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" required="required"
                                placeholder="@lang('site.phone')" " value=""{{old('phone')}}
                                oninput=" this.value=this.value.replace(/[^0-9.]/g, '' );
                                this.value=this.value.replace(/(\..*)\./g, '$1' );">
                        </div>

                        <div class="form-group  ">
                            <input type="email" name="email" class="form-control" placeholder="@lang('site.email')"
                                value="{{old('email')}}">
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6   ">
                                <input type="text" name="customer_region" class="form-control"
                                    placeholder="@lang('site.customer_region')" value="{{old('customer_region')}}">
                            </div>

                            <div class="form-group col-lg-6  ">
                                <input type="text" name="customer_street" class="form-control"
                                    placeholder="@lang('site.customer_street')" value="{{old('customer_street')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" name="customer_home_number" class="form-control"
                                    placeholder="@lang('site.customer_home_number')"
                                    value="{{old('customer_home_number')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" name="customer_floor_number" class="form-control"
                                    placeholder="@lang('site.customer_floor_number')"
                                    value="{{old('customer_floor_number')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="text" name="customer_postal_code" class="form-control"
                                    placeholder="@lang('site.customer_postal_code')"
                                    value="{{old('customer_postal_code')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="customer_comments_extra" placeholder="@lang('site.customer_comments_extra')" "
                                class=" form-control" id="" cols="3" rows="3"></textarea>

                        </div>

                         {{-- <div class="form-group">
                            <label for="visa">@lang('site.by visa') </label>
                            <input type="radio"  id="visa" name="payment_method" value="visa" >
                        </div> --}}
                         <div class="form-group">
                            <input type="radio"  id="cach" name="payment_method" value="cach" >
                            <label for="cach">@lang('site.payment_method') @lang('site.cach')</label>
                        </div>
                        <div class="form-group text-center mt-5">
                            <button class="btn-checkout" type="submit"> @lang('site.Procced_to_Checkout')</button>
                        </div>




                    </form>

                </div>
  @endif


            </div>
        </div>
    </div>
</section>
<!-- //END => Page Checkout -->
@endsection
