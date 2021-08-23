@extends('layouts.app')
@section('title_page')
@lang('site.cart')
@php
$page='congratulations';
@endphp
@endsection
@section('content')


  <!-- START Section => Breadcrumbs Pages -->
  <div class="breadcrumbs-pages py-4 px-5">
    <ul class="d-flex align-items-center">
      <li><a href="{{route('home')}}"> Home </a></li>
      <li> <span> / </span> </li>
      <li> <strong>@lang('site.congratulations')</strong> </li>
    </ul>
  </div>
  <!-- //END Section => Breadcrumbs Pages -->

  <!-- START => Congrats -->
  <section class="page-congrats py-5">
    <div class="container text-center">
      <img src="{{url('/')}}/frontend/assets/imgs/congrats-icon.png" class="img-fluid" alt="congrats">
      <strong class="d-block">order complete</strong>
      <p>
        your order is completed. Thanks for purchasing. <br>
        your order will be shipped in 24 hours
      </p>
      <a href="{{route('home')}}" class="btn-backshop">Continue To Shopping</a>
    </div>
  </section>
  <!-- //END => Congrats -->

  @endsection
