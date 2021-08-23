@extends('layouts.dashboard.app')
<?php
$page="packages";
$title=trans('site.packages');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.packages')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.packages.index') }}"> @lang('site.packages')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.packages.update', $package->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                 <div class="col-md-6">
                        @foreach (config('translatable.locales') as $key=> $locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                            value="{{ $package->translate($locale)->title }}">
                    </div>
                        <div class="form-group">
                        <label>@lang('site.' . $locale . '.short_description')</label>
                        <textarea required="required"  name="{{ $locale }}[short_description]" id="" class="form-control   " cols="30" rows="5">{{$package->translate($locale)->short_description }}</textarea>
                        </div>

                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                            rows="15">{!!$package->translate($locale)->description!!}</textarea>
                    </div>
                    @endforeach
                    </div> {{-- end col md 6 --}}
                    <div class="col-md-6">


                        {{-- EGY Price --}}
                        <div class=" form-group col-md-6">
                            <label>@lang('site.price_egy_monthly') </label>
                            <input type="price" name="price_egy_monthly" style="background:#fff50030 ;font-weight: bold"
                                class="form-control {{ $errors->has('price_egy_monthly') ? ' is-invalid' : '' }}"
                                value="{{$package->price_egy_monthly}}">
                            @if ($errors->has('price_egy_monthly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('price_egy_monthly')}} </strong>
                            </span>
                            @endif
                        </div>
                        <div class=" form-group col-md-6">
                            <label>@lang('site.offer_egy_monthly') </label>
                            <input type="price" name="offer_egy_monthly" style="background:#fff50030 ;font-weight: bold"
                                class="form-control {{ $errors->has('offer_egy_monthly') ? ' is-invalid' : '' }}"
                                value="{{$package->offer_egy_monthly}}">
                            @if ($errors->has('offer_egy_monthly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('offer_egy_monthly')}} </strong>
                            </span>
                            @endif
                        </div>
                        <div class=" form-group col-md-6">
                            <label>@lang('site.price_egy_yearly') </label>
                            <input type="price" name="price_egy_yearly" style="background:#fff50030 ;font-weight: bold"
                                class="form-control {{ $errors->has('price_egy_yearly') ? ' is-invalid' : '' }}"
                                value="{{$package->price_egy_yearly}}">
                            @if ($errors->has('price_egy_yearly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('price_egy_yearly')}} </strong>
                            </span>
                            @endif
                        </div>
                        <div class=" form-group col-md-6">
                            <label>@lang('site.offer_egy_yearly') </label>
                            <input type="price" name="offer_egy_yearly" style="background:#fff50030 ;font-weight: bold"
                                class="form-control {{ $errors->has('offer_egy_yearly') ? ' is-invalid' : '' }}"
                                value="{{$package->offer_egy_yearly}}">
                            @if ($errors->has('offer_egy_yearly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('offer_egy_yearly')}} </strong>
                            </span>
                            @endif
                        </div>

                        {{-- dollar Price --}}

                          <div class=" form-group col-md-6">
                            <label>@lang('site.price_dollar_monthly') </label>
                            <input type="price" name="price_dollar_monthly" style="background:#d9ffdb ;font-weight: bold"
                                class="form-control {{ $errors->has('price_dollar_monthly') ? ' is-invalid' : '' }}"
                                value="{{$package->price_dollar_monthly}}">
                            @if ($errors->has('price_dollar_monthly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('price_dollar_monthly')}} </strong>
                            </span>
                            @endif
                        </div>
                          <div class=" form-group col-md-6">
                            <label>@lang('site.offer_dollar_monthly') </label>
                            <input type="price" name="offer_dollar_monthly" style="background:#d9ffdb ;font-weight: bold"
                                class="form-control {{ $errors->has('offer_dollar_monthly') ? ' is-invalid' : '' }}"
                                value="{{$package->offer_dollar_monthly}}">
                            @if ($errors->has('offer_dollar_monthly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('offer_dollar_monthly')}} </strong>
                            </span>
                            @endif
                        </div>
                          <div class=" form-group col-md-6">
                            <label>@lang('site.price_dollar_yearly') </label>
                            <input type="price" name="price_dollar_yearly" style="background:#d9ffdb ;font-weight: bold"
                                class="form-control {{ $errors->has('price_dollar_yearly') ? ' is-invalid' : '' }}"
                                value="{{$package->price_dollar_yearly}}">
                            @if ($errors->has('price_dollar_yearly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('price_dollar_yearly')}} </strong>
                            </span>
                            @endif
                        </div>
                          <div class=" form-group col-md-6">
                            <label>@lang('site.offer_dollar_yearly') </label>
                            <input type="price" name="offer_dollar_yearly" style="background:#d9ffdb ;font-weight: bold"
                                class="form-control {{ $errors->has('offer_dollar_yearly') ? ' is-invalid' : '' }}"
                                value="{{$package->offer_dollar_yearly}}">
                            @if ($errors->has('offer_dollar_yearly'))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first('offer_dollar_yearly')}} </strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label>@lang('site.falg') </label>
                            <select name="falg" id="" class="form-control">
                                <option value="" {{$package->flag==''? 'selected' : '' }}>@lang('site.not Popular')</option>
                                <option value="Popular" {{$package->flag=='Popular'? 'selected' : '' }}>@lang('site.Popular')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('site.status') </label>
                            <select required="required" name="status" id="" class="form-control">
                                <option value="not active" {{$package->status=='not active'? 'selected' : '' }}>@lang('site.NotActive')</option>
                                <option value="active" {{$package->status=='active'? 'selected' : '' }}>@lang('site.Active')</option>
                            </select>
                        </div>
                        <div class="form-group  ">
                        <label>@lang('site.background_color') </label>
                        <select  class="form-control" name="background_color" id="">
                            <option value="yellow" {{$package->background_color =='yellow'?'selected':''}} style=" background-color: #fbc841;">اصفر</option>
                            <option value="move" {{$package->background_color =='move'?'selected':''}} style=" background-color: #625ac2;">موف </option>
                            <option value="red" {{$package->background_color =='red'?'selected':''}} style=" background-color: #e84571;">red</option>

                        </select>
                     </div>
                    </div>{{-- end col md 6 --}}
                    <div class="col-md-6">
                        {{-- Image --}}
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image" enctype="multipart/form-data">
                        </div>
                        <div class="form-group">
                            <img src="{{$package->image_path}}" style="width: 100px"
                                class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>
                    </div>{{-- end col md 6 --}}







                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
