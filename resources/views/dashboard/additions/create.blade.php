@extends('layouts.dashboard.app')
<?php
$page="additions";
$title=trans('site.additions');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.additions')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.additions.index') }}"> @lang('site.additions')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.additions.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}


                    <div class="form-group">
                        <label>@lang('site.products')</label>
                        <select name="product_id" id="" class="form-control">
                            @foreach ($products as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>@lang('site.title_addition_en')</label>
                        <input type="text" name="title_en" class="form-control" value="{{old('title_en')}}">
                    </div>
                    <div class="form-group">

                        <label>@lang('site.title_addition_ar')</label>
                        <input type="text" name="title_ar" class="form-control" value="{{old('title_ar')}}">
                    </div>
                    <div class=" form-group  ">
                        <label>@lang('site.price') </label>
                        <input type="price" name="price" style="background:#fff50030 ;font-weight: bold"
                            class="form-control  "
                            value="{{old('price')}}">

                    </div>



            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('site.add')</button>
            </div>

            </form><!-- end of form -->

        </div><!-- end of box body -->

</div><!-- end of box -->

</section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
