@extends('layouts.dashboard.app')
<?php
$page="customers";
$title=trans('site.customers');
?>
@section('title_page')
{{$title}}
@endsection


@section('content')


    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.customers')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.customers.index') }}"> @lang('site.customers')</a></li>
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

                    <form action="{{ route('dashboard.customers.update',$customer->id ) }}"  method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.full_name')</label>
                                    <input required="required"  type="text" name="full_name" class="form-control" value="{{old('full_name')??$customer->full_name}}"  >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.email')</label>
                                    <input required="required"   type="text" name="email" class="form-control" value="{{old('email')??$customer->email}}"  >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input required="required"  type="phone" name="phone" class="form-control"  value="{{old('phone')??$customer->phone}}"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  >
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image"   class="form-control image">
                                </div>

                                <div class="form-group">
                                    <img src="{{ $customer->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>@lang('site.status')</label>
                                    <select name='status' class="form-control"   required >
                                        <option value="1" @if( (old('status') == '1')||$customer->status=='1') selected @endif>@lang('site.Active')</option>
                                        <option value="2" @if( (old('status') == '2')||$customer->status=='2') selected @endif>@lang('site.In-Active')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>@lang('site.gender')</label>
                                    <select name='gender' class="form-control"   required >
                                        <option value="male" @if((old('gender') == 'male')||$customer->gender=='male')  == 'male') selected @endif>@lang('site.male')</option>
                                        <option value="female" @if((old('gender') == 'female')||$customer->gender=='female')  == 'female') selected @endif>@lang('site.female')</option>
                                    </select>
                                </div>

                                {{-- <div class="form-group">
                                    <label>@lang('site.city')</label>
                                    <select name='city_id' class="form-control city_id"   required >
                                    <option value="">@lang('site.city')</option>
                                    @foreach($cities as $city )
                                        <option value="{{$city->id}}" @if(old('city_id') == $city->id || $customer->city_id == $city->id  ) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <label>@lang('site.state')</label>
                                <div class="states">
                                    <select name='state_id' class="form-control state_id"   required >
                                        <option value="">@lang('site.state')</option>
                                        @foreach($states as $state )
                                            <option value="{{$state->id}}" @if(old('state_id') == $state->id || $customer->state_id == $state->id  ) selected @endif>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                {{-- <label>@lang('site.regoin')</label>
                                <div class="regoins">
                                    <select name='regoin_id' class="form-control regoin_id"   required >
                                        <option value="">@lang('site.regoin')</option>
                                        @foreach($regoins as $regoin )
                                            <option value="{{$regoin->id}}" @if(old('regoin_id') == $regoin->id || $customer->regoin_id == $regoin->id  ) selected @endif>{{$regoin->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit') </button>
                                </div>
                            </div>


                        </div>


                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
