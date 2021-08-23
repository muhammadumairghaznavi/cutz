@php
if (authCustomer() != null) {
    $headerCarts = App\Cart::where('customer_id', authCustomer()->id)
        ->latest()
        ->get();
}
@endphp
<div class="right-header d-flex align-items-center">
    <div class="actions-mobile d-flex align-items-center">

        <div class="btn-login-downz">
            <a href="javascript:void(0)" class="d-flex align-items-center btnLogins"><i class="far fa-user mx-1"></i>
                <i class="fa fa-chevron-down"></i> </a>
            <ul class="menu-logins">
                @auth('customer')

                    <li class="a-d"> <a href="{{ route('customer.profile.index') }}"><i
                                class="fa fa-user"></i>@lang('site.profile')</a></li>
                    <li class="a-d"><a href="{{ route('customer.cart.index') }}"> <i
                                class="fas fa-shopping-cart"></i>@lang('site.cart')</a>
                    </li>
                    <li class="a-d"><a href="{{ route('customer.profile.orders') }}"> <i
                                class="fas fa-clipboard-list"></i>@lang('site.orders')</a></li>
                    <li class="a-d"><a href="{{ route('customer.wishlist.index') }}"> <i
                                class="fas fa-heart"></i>@lang('site.wishlist')</a>
                    </li>
                    <li class="a-d"><a href="{{ route('customer.profile.logout') }}"> <i
                                class="fas fa-sign-out-alt"></i>@lang('site.Logout') </a>
                    </li>
                @else
                    <li class="btn-logins"><a href="{{ route('customer.login') }}">@lang('site.login')</a></li>
                    <li class="hr-or">@lang('site.or')</li>
                    <li class="btn-newaccount"><a href="{{ route('register') }}">@lang('site.Create an Account')</a></li>
                @endauth

            </ul>
        </div>

        <div class="block-cart">
            @auth('customer')
                <a href="javascript:void(0)" class="cartsho-link"><i class="fas fa-shopping-cart"></i> <span
                        class="num-count">{{ count($headerCarts) }} </span></a>
                <div class="menu-cart">
                    <div class="title d-flex align-items-center justify-content-between">
                        <strong>@lang('site.My Cart')</strong>
                        <a href="{{ route('customer.cart.index') }}" class="num-added" title=""><i
                                class="fas fa-cart-arrow-down"></i>
                            ({{ count($headerCarts) }})</a>
                    </div>
                    <ul class="">
                        <li class="scroll-y">
                            @php
                                $sumCartAndDetail = 0;
                            @endphp
                            @foreach ($headerCarts as $cart)


                                @php
                                    $product = \App\Product::find($cart->product_id);
                                @endphp
                                @if (!$product)
                                    @php $cart->delete() @endphp
                                    @continue
                                @endif

                                <div class="item">
                                    <div class="img">
                                        <img src="{{ $cart->product->image_path }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="txt">
                                        <a
                                            href="{{ route('product_details', ['id' => $cart->product->id, 'slug' => make_slug($cart->product->title)]) }}">{{ $cart->product->title }}</a>
                                        {{-- @if (!$cart->productWeight_id) --}}
                                        <p class="qty"> {{ $cart->type ? 'wheight  = ' . $cart->type . ' G' : '' }}</p>
                                        <p class="qty"> @lang('site.price')
                                            ={{ $cart->type ? ($cart->product->Total * (int) $cart->type) / 1000 : $cart->product->Total }}
                                        </p>
                                        <p class="qty"> @lang('site.quantity') = {{ $cart->qty }} </p>
                                        {{-- @if ($cart->type == 'gram')

                <p class="qty"> @lang('site.weights') = {{$cart->type=='gram'?'0.5 KG':'1KG'}} </p>
                @endif --}}

                                        {{-- @else
                <p class="qty">{{$cart->productWeight->price}}*{{$cart->qty}}</p>
                @endif --}}

                                        <p class="price">
                                            {{ $cart->type ? ($cart->product->Total * $cart->qty * (int) $cart->type) / 1000 : $cart->product->Total * $cart->qty }}{{ __('site.' . currncy()) }}
                                        </p>
                                        {{-- <strong>
                                   @lang('site.additions')
                               </strong><br> --}}
                                        @foreach ($cart->cart_detials as $cart_detial)
                                            <strong> {{ $cart_detial->addtion->title }}</strong> +
                                            {{-- {{$cart_detial->addtion->price}}*{{$cart_detial->qty}} --}}
                                            {{-- = {{$cart_detial->TotalCartDetails}} --}}
                                            <br>
                                        @endforeach

                                        {{-- <strong>
                                   @lang('site.total')
                               </strong>
                                <p class="price">{{$cart->SumCartDetails}}{{__('site.'.currncy())}}</p> --}}
                                    </div>
                                    <a href="{{ route('customer.cart.delete', ['id' => $cart->id]) }}" class="mr-3"><i
                                            class="far fa-trash-alt del-item"></i> </a>
                                </div>
                                @php
                                    $sumCartAndDetail += $cart->SumCartWithCartDetails;
                                @endphp
                            @endforeach


                        </li>
                        <li class="total d-flex align-items-center justify-content-between">
                            <strong>@lang('site.total')</strong>

                            <strong class="price-total">{{ $sumCartAndDetail }}{{ __('site.' . currncy()) }}</strong>
                        </li>
                    </ul>
                    <a href="{{ route('customer.checkout.index') }}" class="title text-center"> @lang('site.checkout')
                    </a>
                </div>
            @else
                <a href="javascript:void(0)" class="cartsho-link"><i class="fas fa-shopping-cart"></i> <span
                        class="num-count">0</span></a>
            @endauth
        </div>

        <div>
            <a href="javascript:void(0)" class="searchs-link"><i class="fas fa-search"></i></a>
            <div class="form-search-header">
                <form action="{{ route('search') }}" method="GET">
                    <strong class="mb-3 h2 d-block">@lang('site.search')</strong>
                    @csrf
                    <div class="form-group m-0">
                        <input type="text" class="" id="IDSearch" name="keyword" required="required"
                            placeholder="@lang('site.search') ...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <div id="searchList"></div>
                <i class="fas fa-times close-search"></i>
            </div>
        </div>

        <div class="langs d-none">
            @if (LaravelLocalization::getCurrentLocale() == 'ar')
                <a rel="alternate" class="langs" hreflang="ar" data-toggle="tooltip" data-placement="bottom"
                    title="English" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                    <i class="fa fa-globe"></i>@lang('site.english')</a>
            @elseif(LaravelLocalization::getCurrentLocale()=='en')
                <a rel="alternate " class="langs" hreflang="ar" data-toggle="tooltip" data-placement="bottom" title=""
                    href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                    <i class="fa fa-globe"></i> @lang('site.arabic') </a>
            @endif
        </div>

    </div>


    <!-- Toggle Menu In Mobile -->
    <i class="fas fa-2x fa-bars toggle-menu"></i>
</div>
