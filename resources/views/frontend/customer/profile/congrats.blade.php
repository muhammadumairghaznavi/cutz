@extends('layouts.app')
@section('title_page')
@lang('site.congratulations')
@php
$page='congratulations';
@endphp
@endsection
@section('content')


<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">@lang('site.congratulations')</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="">@lang('site.congratulations')</a></li>
    </ul>
</div>



  <!-- START => congratulations -->
  <section class="page-congrats py-5">
    <div class="container text-center">
      <img src="{{ url('/') }}/frontend/assets/imgs/icon-congrats.png" class="img-fluid" alt="congrats">
      <strong class="d-block">order complete</strong>
      <p>
        You can track the order delivery in the
        “Orders” section.
      </p>
      <p>
        Your Order Number: <span>#{{$order->id}}</span> <br>
    </p>

      <a href="{{route('home')}}" class="btn-backshop">Continue To Shopping</a>
    </div>
  </section>
  <!-- //END => Congrats -->




@endsection
