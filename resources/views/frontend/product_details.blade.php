@extends('layouts.app')
@section('title_page')
{{$product->title}}
@php
$page='';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">{{$product->title}}</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="{{route('products')}}">@lang('site.products')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a>{{$product->title}}</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->


<!-- START => Page Single -->
<section class="page-single py-5">
    <div class="container">
        <div class="product-single">
            <div class="row">
                <div class="col-md-5">
                    <div class="slides-images">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                               <!--<div class="swiper-slide">-->
                               <!--     <a data-fancybox="gallery" href="{{$product->image_path}}"-->
                               <!--         data-caption="{{$product->title}}">-->
                               <!--         <img src="{{$product->image_path}}" class="img-fluid" alt="{{$product->title}}">-->
                               <!--     </a>-->
                               <!-- </div>-->
                                @foreach ($product->images as $item)
                                <div class="swiper-slide">
                                    <a data-fancybox="gallery" href="{{$item->image_path}}"
                                        data-caption="{{$product->title}}">
                                        <img src="{{$item->image_path}}" class="img-fluid" alt="{{$product->title}}">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <!-- Add Arrows -->
                            @if(count($product->images)>0)

                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                            @endif
                        </div>

                        @if (count($product->images)>0)


                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <!-- <div class="swiper-slide">-->
                                <!--    <img src="{{$product->image_path}}" class="img-fluid" alt="{{$product->title}}">-->
                                <!--</div>-->

                                @foreach ($product->images as $item)
                                <div class="swiper-slide">
                                    <img src="{{$item->image_path}}" class="img-fluid" alt="{{$product->title}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                         @endif
                    </div>
                </div>
                <div class="col-md-6">

                    @if (session('success'))
                    <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                    </div>
                    @endif
                    <div class="product-details py-3 px-2">
                        <div class="title-prod">
                            <strong class="h4 mb-4 d-block">{{$product->title}}  </strong>

                            <div class="my-3">


                                 @if($product->provenance_id)
                                <strong class="bbq city-created"><img src="{{$product->provenance->image_path}}" alt="">
                                    <span>{{   $product->provenance->title ??""}}</span></strong>
                                @endif
                                @if($product->falg=="yes")
                                <strong class="bbq"><img src="{{url('/')}}/frontend/assets/imgs/icons/grill.png" alt="">
                                    <span>@lang('site.BBQ')</span></strong>
                                @endif
                                @if($product->chilies=="yes")
                                <strong class="bbq"><img src="{{url('/')}}/frontend/assets/imgs/icons/chilled.png" alt="">
                                    <span>@lang('site.chilled')</span></strong>
                                @endif
                                @if($product->hermonFree=="yes")
                                <strong class="bbq"><img src="{{url('/')}}/frontend/assets/imgs/icons/healthy.png" alt="">
                                    <span>@lang('site.hermonFree')</span></strong>
                                @endif
                                @if($product->panSearing=="yes")
                                <strong class="bbq"><img src="{{url('/')}}/frontend/assets/imgs/icons/panseearing.png" alt="">
                                    <span>@lang('site.panSearing')</span></strong>
                                @endif
                                @if($product->frozen=="yes")
                                <strong class="bbq"><img src="{{url('/')}}/frontend/assets/imgs/icons/frozen.png" alt="">
                                    <span>@lang('site.frozen')</span></strong>
                                @endif
                                @if($product->roasting=="yes")
                                <strong class="bbq"><img src="{{url('/')}}/frontend/assets/imgs/icons/roasting.png" alt="">
                                    <span>@lang('site.roasting')</span></strong>
                                @endif
                            </div>
                        </div>

                        <h3 class="prices">
                            <span>{{$product->total}} {{__('site.'.currncy())}} </span>
                            @if($product->discount)
                            <del>{{$product->MainPrice}}</del>
                            @endif

                        </h3>


                        <div class="d-flex justify-content-between align-items-center">

                            <strong class="h6 d-block">
                                @if ($product->measr_unit == 'per_unit')
                                {{['ar' => 'بالوحدة','en' => 'Per unit'][app()->getLocale()]}}
                                @else
                                @lang('site.weights') :{{$product->unitValue}}
                                KG
                                @endif

                                 </strong>
                           @if($product->serve_number>1)
                            <strong class="h6 d-block"> @lang('site.serve_number') : {{$product->serve_number}}
                                @lang('site.Individuals') </strong>
                            @endif
                            <!-- Add Class Active if added to wishlist-->
                            <a href="{{route('customer.wishlist',['product_id'=>$product->id])}}"
                                class="btn-add-cart add-wishlist">
                                <i class="far fa-lg fa-heart"></i>
                                @lang('site.Add To Wishlist')


                            </a>

                        </div>
                        <hr>
                    </div>
                    <div class="page-add-cart">
                        <form action="{{route('customer.cart.add')}}"  method="POST" >
                            @csrf
                            <input type="hidden" name="product_id"  value="{{$product->id}}" id="">
                            <div class="row no-gutters">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <div class="add-addition px-4">
                                            @foreach ($product->additions as $addition)
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <strong class="mr-3">{{$addition->Title}} <span> {{$addition->Total}}
                                                        {{__('site.'.currncy())}} </span>
                                                </strong>
                                                <div class="switch_box box_1">
                                                    <input type="checkbox" name="addition_id[]" value="{{$addition->id}}"
                                                        class="switch_1">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                 </div>
                                <div class="col-md-12 flex-column-xs in-mobile d-flex align-items-center justify-content-around">
                                 @if($product->measr_unit=='weight')
                                    <div class="w-50 d-flex align-items-center">
                                        <strong class="h5 d-inline-block mr-3">@lang('site.Weight'): </strong>
                                        <select name="type" class="adults" id="">
                                            {{-- <option value="per_unit">@lang('site.kg')/{{$product->total}}{{__('site.'.currncy())}}</option>
                                            <option value="gram">@lang('site.gram') /{{$product->total /2}}{{__('site.'.currncy())}} </option> --}}
                                            <option selected  ></option>
                                            <option value="150">{{['ar' => '150 ج','en' => '150 G'][app()->getLocale()]}} /{{$product->total *150/1000}}{{__('site.'.currncy())}} </option>
                                            <option value="200">{{['ar' => '200 ج','en' => '200 G'][app()->getLocale()]}} /{{$product->total *200/1000}}{{__('site.'.currncy())}} </option>
                                            <option value="300">{{['ar' => '300 ج','en' => '300 G'][app()->getLocale()]}} /{{$product->total *300/1000}}{{__('site.'.currncy())}} </option>
                                            <option value="500">{{['ar' => '500 ج','en' => '500 G'][app()->getLocale()]}} /{{$product->total *500/1000}}{{__('site.'.currncy())}} </option>
                                            {{-- <option value="1000">{{['ar' => '1 كجم','en' => '1 Kg'][app()->getLocale()]}} /{{$product->total}}{{__('site.'.currncy())}} </option> --}}
                                        </select>
                                    </div>
                                    @endif
                                    @if(count($product->productWeights)>0)
                                    <div class="w-50 d-flex align-items-center">
                                        {{-- <select name="productWeight_id" class="w-50">
                                            <option value="">@lang('site.weights')</option>
                                           @foreach ($product->productWeights as $productWeight)
                                            <option value="{{$productWeight->id}}">{{$productWeight->weight->title}}={{$productWeight->price}}{{__('site.'.currncy())}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    @endif


                                    <div class="min-add-button d-flex align-items-center">
                                        <strong class="h5 d-inline-block mr-3">@lang('site.quantity'): </strong>
                                        <a href="#" class="input-group-addon minus increment sub"><i
                                                class="fas fa-arrow-down" aria-hidden="true"></i></a>
                                        <input type="text" min="1" name="qty"   class="adults" size="10" value="1">
                                        <a href="#" class="input-group-addon plus increment add"><i
                                                class="fas fa-arrow-up" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <button type="submit" class="btn-add-cart mt-4 mx-3"> <i  class="fas fa-lg fa-cart-plus"></i> @lang('site.add to cart')</button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Description -->
            <div class="product-desc pt-4">
                <ul class="nav nav-tabs justify-content-around" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">@lang('site.description')</a>
                    </li>
                         @if(count($product->instructions)>0)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false"> @lang('site.HowToCock')
                            ({{$product->instructions->count()}})</a>
                    </li>
                    @endif

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="txt">
                            <strong>@lang('site.description')</strong>
                            <p class="lead__txt">
                                {!!$product->description!!}
                            </p>


                                @if($product->nutritionFact !== 'default.png' )
                                  <div class="text-center">
                                    <img src="{{$product->image_nutrition}}" class="img-thumbnail image-preview4" alt="Default Image">
                                  </div>
                                @endif
                        </div>
                        @if($product->frozenInstructions)
                        <div class="txt">
                            <strong>@lang('site.frozenInstructions')</strong>
                            <p class="lead__txt">
                                {!!$product->frozenInstructions!!}
                            </p>
                        </div>
                        @endif

                           @if($product->provenance_id)
                        <div class="txt">
                            <strong>@lang('site.provenances')</strong>
                            <p class="lead__txt"> {!!$product->provenance->title ??""!!}

                            </p>
                            @if(app()->getLocale() == 'ar')
                            <p class="lead__txt"> {!!$provenanceCategory->description_ar ??""!!}   </p>
                            @else
                            <p class="lead__txt"> {!!$provenanceCategory->description_en ??""!!}   </p>
                            @endif
                        </div>
                        @endif
                           @if($product->expiration)
                        <div class="txt">
                            <strong>@lang('site.expiration')</strong>
                            <p class="lead__txt"> {!!$product->expiration !!}   </p>

                        </div>
                        @endif


                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="items p-4">
                            @if($product->instructions->count()>0)
                            <h2 class="mb-4">@lang('site.HowToCock') </h2>
                            <hr>
                            @foreach ($product->instructions as $item)
                            <div class="item">
                                <h3 class="btn_show_acc">{{$item->title}} <i class="fa fa-plus"></i></h3>
                                <div class="desc">
                                    <p class="lead__txt">
                                        {!!$item->description!!}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>
<!-- //END => Page Single -->
@endsection
