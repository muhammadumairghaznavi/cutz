@extends('layouts.dashboard.app')
<?php
$page="parteners";
$title=trans('site.parteners');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.parteners')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.parteners.index') }}"> @lang('site.parteners')</a></li>
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
                <form action="{{ route('dashboard.parteners.update', $partener->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @foreach (config('translatable.locales') as $key=> $locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale .'.title')</label>
                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                            value="{{ $partener->translate($locale)->title }}">
                    </div>
                    {{-- <div class="form-group">
                        <label>@lang('site.' . $locale . '.description')</label>
                        <textarea name="{{ $locale }}[description]" id="" class="form-control" cols="30"
                            rows="5">{{ $partener->translate($locale)->description }}</textarea>
                    </div> --}}
                    @endforeach

                    @php
                $links=['fb_link','tw_link','in_link','ln_link','yt_link','gh_link'];

                    @endphp

                    <div hidden>


                     <div class="form-group">
                        <label>{{ $links[0]}}</label>
                        <input type="text" name="{{$links[0]}}" value="<?= $partener->fb_link?>" class="form-control  ">
                     </div>
                     <div class="form-group">
                        <label>{{ $links[1]}}</label>
                        <input type="text" name="{{$links[1]}}" value="<?= $partener->tw_link?>" class="form-control  ">
                     </div>
                     <div class="form-group">
                        <label>{{ $links[2]}}</label>
                        <input type="text" name="{{$links[2]}}" value="<?= $partener->in_link?>" class="form-control  ">
                     </div>
                     <div class="form-group">
                        <label>{{ $links[3]}}</label>
                        <input type="text" name="{{$links[3]}}" value="<?= $partener->ln_link?>" class="form-control  ">
                     </div>
                     <div class="form-group">
                        <label>{{ $links[4]}}</label>
                        <input type="text" name="{{$links[4]}}" value="<?= $partener->yt_link?>" class="form-control  ">
                     </div>
                     <div class="form-group">
                        <label>{{ $links[5]}}</label>
                        <input type="text" name="{{$links[5]}}" value="<?= $partener->gh_link?>" class="form-control  ">
                     </div>
  </div>

            <div class="form-group">
                <label>@lang('site.image')</label>
                <input type="file" name="image" class="form-control image">
            </div>
            <div class="form-group">
                <img src="{{ $partener->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
            </div>
            </form><!-- end of form -->
        </div><!-- end of box body -->
</div><!-- end of box -->
</section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
