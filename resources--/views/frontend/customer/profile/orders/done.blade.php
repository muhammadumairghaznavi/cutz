@extends('layouts.app')
@section('title_page')
@lang('site.congratulations')

@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="head-pages">
    <div class="breadcrumb-bg"></div>
    <div class="container-fluid">
        <div class="breadcrumb-title">
            <strong>@lang('site.We keep pace with development to create an easier life')</strong>
        </div>
        <div class="breadcrumb-pages">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('home')}}">@lang('site.home')</a></li>
                <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
                <li><a href="">@lang('site.congratulations')</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- //END => Breadcrumb -->
<section class="page-checkout-success mt-4">
    <div class="container container-bg mb-5">
      <div class="box-chooseings text-center py-5">
        <img src="{{url('/')}}/frontend/assets/imgs/success.png" class="img-fluid d-block mx-auto mb-4" alt="">
        <strong class="h2 mb-4 d-block">@lang('site.Thank you for your order').</strong>
        <p>@lang('site.Your order has been placed successfully')</p>
      <p>@lang('site.Order Number is'):  </p>
      <p>@lang('site.A ticket has been opened on your profile to help you')</p>


      <a href="{{route('customer.profile.tickets')}}" class="btn-started">@lang('site.Go to the ticket')</a>
      </div>
    </div>
  </section>
@endsection
