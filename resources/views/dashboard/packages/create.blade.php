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
                <form action="{{ route('dashboard.packages.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="col-md-6">
                        @foreach (config('translatable.locales') as $key=>$locale)
                        <div class="form-group">
                            <span class="label label-warning  ">{{$key+1}} </span>
                            <label>@lang('site.' . $locale . '.title')</label>
                            <input type="text" required="required" name="{{ $locale }}[title]" class="form-control"
                                value="{{ old($locale . '.title') }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.' . $locale . '.short_description')</label>
                            <textarea required="required" name="{{ $locale }}[short_description]" id=""
                                class="form-control  " cols="30"
                                rows="5">{{ old($locale . '.short_description') }}</textarea>
                        </div>
                        <div class="form-group">

                            <label>@lang('site.' . $locale . '.description')


                            </label>

                            <textarea required="required" name="{{ $locale }}[description]" id=""
                                class="form-control summernote" cols="30"
                                rows="5"> {{ old($locale . '.description') }}</textarea>
                        </div>
                        <div class="  with-border"></div><br>
                        @endforeach
                    </div> {{-- end col md 6 --}}
                    <div class="col-md-6">

                        @php
                        $egy=[
                        'price_egy_monthly' ,'offer_egy_monthly' ,
                        'price_egy_yearly' ,'offer_egy_yearly' ,
                        ];
                        $dollar=[
                        'price_dollar_monthly' ,'offer_dollar_monthly' ,
                        'price_dollar_yearly','offer_dollar_yearly',
                        ];
                        @endphp
                        {{-- EGY Price --}}
                        @for ($i = 0; $i < 4; $i++)
                        <div class=" form-group col-md-6">
                            <label>@lang('site.'.$egy[$i]) </label>
                            <input type="price" name="{{$egy[$i]}}" style="background:#fff50030 ;font-weight: bold"
                                class="form-control {{ $errors->has($egy[$i]) ? ' is-invalid' : '' }}"
                                value="{{old($egy[$i])}}">
                            @if ($errors->has($egy[$i]))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first($egy[$i])}} </strong>
                            </span>
                            @endif
                        </div>
                         @endfor
                        {{-- dollar Price --}}
                        @for ($i = 0; $i < 4; $i++)
                        <div class=" form-group col-md-6">
                            <label>@lang('site.'.$dollar[$i]) </label>
                            <input type="price" name="{{$dollar[$i]}}" style="background:#d9ffdb ;font-weight: bold"
                                class="form-control {{ $errors->has($dollar[$i]) ? ' is-invalid' : '' }}"
                                value="{{old($dollar[$i])}}">
                            @if ($errors->has($dollar[$i]))
                            <span class="is-invalid" role="alert">
                                <strong>* {{$errors->first($dollar[$i])}} </strong>
                            </span>
                            @endif
                        </div>
                        @endfor
                        <div class="form-group">
                            <label>@lang('site.falg') </label>
                            <select   name="falg" id="" class="form-control">
                                <option value="">@lang('site.not Popular')</option>
                                <option value="Popular">@lang('site.Popular')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('site.status') </label>
                            <select required="required" name="status" id="" class="form-control">
                                <option value="not active">@lang('site.NotActive')</option>
                                <option value="active">@lang('site.Active')</option>
                            </select>
                        </div>


                        <div class="form-group  ">

                        <label>@lang('site.background_color') </label>

                        <select  class="form-control" name="background_color" id="">
                            <option value="yellow"  style=" background-color: #fbc841;">اصفر</option>
                            <option value="move"   style=" background-color: #625ac2;">موف </option>
                            <option value="red" style=" background-color: #e84571;">red</option>

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
                            <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.add')</button>
                        </div>
                    </div>{{-- end col md 6 --}}
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
