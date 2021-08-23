@extends('layouts.dashboard.app')
<?php
$page="site_options";
$title=trans('site.site_options');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <!-- title head  -->
        <h1>{{$title}}</h1>
        <!-- breadcrumb  -->
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>@lang('site.Dashboard')</a></li>
            <li class="active">{{$title}}</li>
        </ol>
        <!--/* breadcrumb  -->
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">{{$title}} <small>@lang('site.total_search')
                        ( {{$site_options->total()}} )
                    </small></h3>
            </div><!-- end of box header -->
            <div class="box-body">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th style="width: 10px">#</th>
                            
                            <th>@lang('site.main_num')</th>
                            <th>@lang('site.logo')</th>
                            <th>@lang('site.icon')</th>
                           
                            
                    
                            
                            <th>@lang('site.updated_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        {{-- check if there are row supersliders or not --}}
                        @if ($site_options->count() >0)
                        @foreach ($site_options as $index=>$site_option)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            
                            <td> {{ $site_option->num1 }} - {{ $site_option->num2 }}</td>
                            <td>
                                
                                    <img src="{{asset('uploads/'.$site_option->logo)}}" style="width: 60px" class="img-thumbnail  "
                                    alt="">
                            </td>
                        
                            <td>
                                
                                    <img src="{{asset('uploads/'.$site_option->icon)}}" style="width: 60px" class="img-thumbnail  "
                                    alt="">
                            </td>
                        
                            
                            
                            <td>{{ $site_option->updated_at }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_options'))
                                <a href="{{ route('dashboard.site_options.edit', $site_option->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="alert alert-danger">
                                    <strong> @lang('site.no_data_found')</strong>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </table> <!-- /end of table -->
                </div>
                {{ $site_options->appends(request()->query())->links()}}
                <!-- /.box-body -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
