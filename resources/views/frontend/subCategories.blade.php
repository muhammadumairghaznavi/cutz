@extends('layouts.app')
@section('title_page')
{{$category->title}}
@php
$page='';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url({{url('/')}}/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block">{{$category->title}}</strong>
    <ul>
        <li><a href="{{route('home')}}">@lang('site.home')</a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="">@lang('site.subCategories')</a></li>
    </ul>
</div>
<!-- //END => Breadcrumb -->
<section class="page-sup-catgs py-5">
    <div class="container">
        <div class="row">
            @foreach ($subCategories as $item)
            <div class="col-md-3">
                <div class="item-sup-catgs">
                    <a href="{{route('productsSubCategories',['id'=>$item->id , 'slug'=>make_slug($item->title)])}}">
                        <div class="img_subs">
                            <img src="{{$item->image_path}}" class="img-fluid" alt="{{$item->title}}">
                        </div>
                        <strong>{{$item->title}}  </strong>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
