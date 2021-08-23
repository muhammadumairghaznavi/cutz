@extends('layouts.dashboard.app')
<?php
$page="tickets";
$title=trans('site.tickets');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.tickets')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.tickets.index') }}"> @lang('site.tickets')</a></li>
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
                <div class="col-md-12">
                    <div class="box box-primary   ">

                        @lang('site.name') &nbsp; : {{ $ticket->customer->full_name }} &nbsp; &nbsp; &nbsp; -
                        @lang('site.email') &nbsp; : {{ $ticket->customer->email }} &nbsp; &nbsp; &nbsp; -
                        @lang('site.phone') &nbsp; : {{ $ticket->customer->phone }} &nbsp; &nbsp; &nbsp; -
                        @lang('site.section') &nbsp; : {{ __('site.'.$ticket->section )}} &nbsp; &nbsp; &nbsp; -
                        @lang('site.type') &nbsp; : {{ __('site.'.$ticket->type) }} &nbsp; &nbsp; &nbsp; -
                        @lang('site.status') &nbsp; : {{ __('site.'.$ticket->status) }} &nbsp; &nbsp; &nbsp;
                    </div>


                    <!-- DIRECT CHAT WARNING -->
                    <div class="box box-primary box-solid direct-chat direct-chat-primary ">
                        <div class="box-header">
                            <h3 class="box-title">@lang('site.message')</h3>

                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" title="  New Messages" class="badge bg-light-blue"> </span>
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>



                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">{{$ticket->customer->full_name}}</span>
                                        <span class="direct-chat-timestamp pull-right">{{ $ticket->created_at }}</span>
                                    </div><!-- /.direct-chat-info -->

                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        {{ $ticket->message }}
                                    </div><!-- /.direct-chat-text -->
                                </div><!-- /.direct-chat-msg -->
                                @foreach ($tickets as $tickets)


                                <!-- Message to the right -->
                                <div class="direct-chat-msg {{$tickets->admin_id ==null?'':'right'}}  ">
                                    <div class="direct-chat-info clearfix">
                                        <span
                                            class="direct-chat-name pull-{{$tickets->admin_id ==null?'':'right'}}">{{$tickets->admin_id ==null? $ticket->customer->full_name:auth()->user()->full_name}}</span>
                                        <span
                                            class="direct-chat-timestamp pull-{{$tickets->admin_id ==null?'right':''}}">{{$tickets->created_at}}</span>
                                    </div><!-- /.direct-chat-info -->

                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        {{$tickets->message}}
                                    </div><!-- /.direct-chat-text -->
                                </div><!-- /.direct-chat-msg -->
                                @endforeach


                            </div>
                            <!--/.direct-chat-messages-->


                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <form action="{{ route('dashboard.tickets.create.reply') }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}




                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="Type Message ..."
                                        class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit"
                                            class="btn btn-primary btn-flat">@lang('site.send')</button>
                                    </span>
                                </div>
                            </form>{{-- end form --}}
                        </div><!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>

                <form action="{{ route('dashboard.tickets.update', $ticket->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class=" form-group ">
                        <label>@lang('site.status') </label>
                        <select name="status" class="form-control">
                            <option value="">@lang('site.status')</option>
                            @foreach (ticket_status() as $index=>$status)
                            <option {{$ticket->status==$status ? 'selected':''}} value="{{$status}}">
                                {{__('site.'.$status)}}</option>
                            @endforeach
                        </select>

                        
                    </div>
                       <div class="form-group">
                           <br>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>
                </form>

            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
