@extends('layouts.app')
@section('title_page')
@lang('site.tickets')
@php
$profile_bar='tickets';
@endphp
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
                <li><a href="{{route('customer.profile.index')}}">@lang('site.profile')</a></li>
                <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
                <li><a href="">@lang('site.Technical Support')</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- //END => Breadcrumb -->
<!-- START => Profile Page -->
<section class="page-profile py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials._profile_bar')
            </div>
            <div class="col-md-9">
                <div id="profileContent" class="profile-content">
                    <div class="title-profile px-2">
                        <strong class="h5 d-block">@lang('site.Technical Support') </strong>
                    </div>
                    <div class="box-bg">
                        <div class="title">
                            <strong>(@lang('site.Create Technical Support'))</strong>
                        </div>
                        <form action="{{route('customer.profile.tickets.create')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @include('partials._errors')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">@lang('site.The relevant department')</label>
                                        <select class="form-control" required='required' name="section">
                                            <option value="" selected disabled>@lang('site.The relevant department')
                                            </option>
                                            @foreach (ticket_option() as $key=>$item)
                                            <option value="{{$item}}">{{__('site.'.$item)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">@lang('site.Importance level')</label>
                                        <select class="form-control" required='required' name="type">
                                            <option value="" selected disabled>@lang('site.Importance level')</option>
                                            @foreach (ticket_type() as $key=>$item)
                                            <option value="{{$item}}">{{__('site.'.$item)}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" required='required' name="message"
                                            placeholder="@lang('site.message')">{{old('message')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn-started float-right">@lang('site.send')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> {{-- end box-bg --}}

                    <div class="box-bg">
                        <div class="title">
                            <strong>(@lang('site.tickets'))</strong>
                        </div>
                        @if ($tickets->count() > 0)
                        <table class="table table-hover " id="data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    {{-- <th>@lang('site.info')</th> --}}
                                    <th>@lang('site.section')</th>
                                    <th>@lang('site.type')</th>
                                    <th>@lang('site.status')</th>
                                    <th>@lang('site.created_at')</th>
                                    <th>@lang('site.message')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $index=>$ticket)
                                <tr style="background-color:{{ $ticket->status=="pending" ? '#f1d4d4' :'#04fb0938' }}">
                                    <td>{{ $index + 1 }}</td>
                                    {{-- <td> {{ $ticket->customer->full_name }} <br> {{ $ticket->customer->email }}
                                    <br>
                                    {{ $ticket->customer->phone }} <br></td> --}}
                                    <td> {{ __('site.'.$ticket->section) }} </td>
                                    <td>{{ __('site.'.$ticket->type) }} </td>
                                    <td> {{ __('site.'.$ticket->status) }} </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}



                                    </td>

                                    <td>
                                        <a href="" data-toggle="modal" data-target="#model_{{$index}}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="model_{{$index}}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <label for="" class="text-center"> @lang('site.message')</label>

                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{$setting->seo_title}} : {{ $ticket->reply }}</p>
                                                        <hr>
                                                        <p>{{authCustomer()->full_name}}:
                                                            {{ $ticket->message==null?__('site.Noreply'): $ticket->message }}
                                                        </p>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">@lang('site.Close')</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>{{-- end model --}}


                                    </td>


                                    <td> {{ __('site.'.$ticket->status) }} </td>


                                </tr>

                                @endforeach
                            </tbody>
                        </table><!-- end of table -->
                        @else
                        <label for=""
                            class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                        @endif


                    </div> {{-- end box-bg --}}

                </div>
            </div>
        </div>
    </div>
</section>
<!-- //END => Profile Page -->
@endsection
