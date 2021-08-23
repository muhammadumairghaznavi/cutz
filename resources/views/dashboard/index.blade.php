@extends('layouts.dashboard.app')
<?php
$page="dashboard";
$title=trans('site.dashboard');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.dashboard')</h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.orders')</span>
                                <span class="info-box-number">{{$orders}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion-ios-chatbubble-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.inbox')</span>
                                <span class="info-box-number">{{$inbox}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.customers')</span>
                                <span class="info-box-number">{{$customers}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-th-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.sections')</span>
                                <span class="info-box-number">{{$sections}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-align-left"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.categories')</span>
                                <span class="info-box-number">{{$categories}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i
                                    class="glyphicon glyphicon-align-center"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.subCategories')</span>
                                <span class="info-box-number">{{$subCategories}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-align-right"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.products')</span>
                                <span class="info-box-number">{{$products}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-align-justify"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">@lang('site.additions')</span>
                                <span class="info-box-number">{{$additions}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>
                </div>
                <!-- /.row -->
            </div>

            <div class="col-md-6">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{$orders_pending}}</h3>
                                <p>@lang('site.orders_pending')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                           
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{$orders_total}}</h3>
                                <p>@lang('site.total_orders')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                         </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{$customers}}</h3>
                                <p>@lang('site.customers')</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                         </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{$products}}</h3>
                                <p>@lang('site.products')</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-building-o"></i>
                            </div>
                         </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>


            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"> @lang('site.customers')</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-danger"> @lang('site.customers')( {{count($customers_list)}} )
                            </span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            @foreach ($customers_list as $item)
                            <li>
                                <img src="{{$item->image_path}}" alt="User Image">
                                <a class="users-list-name" href="#">{{$item->full_name}}</a>
                                <span class="users-list-date">
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{url('dashboard/customers')}}" class="uppercase">@lang('site.customers')</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!--/.box -->
            </div>


            
        </div>
        <div class="container-fluid">
            <h3 class="box-title">اخر المنتجات</h3>
            <div class="box">
                <div class="box-body table-responsive no-padding table-responsiveAll">
                    <table class="table table-hover">
                        <tbody>
                           <tr>
                            <th>#</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.name')</th>
                            {{-- <th>@lang('site.description')</th> --}}
                            <th>@lang('site.price')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.image')</th>
              
                        </tr>
                            
                                @foreach ($products_list as $index=>$product)
                                     <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $product->section->title??"لا يوجد" }}>>
                                {{ $product->category->title??"لا يوجد" }}>>
                                {{ $product->subCategory->title??"لا يوجد" }}

                            </td>
                            <td> {{ $product->title }}</td>

                            <td>
                                {{ $product->Total}} {{__('site.'.currncy())}}
                            </td>

                            <td>
                                {{__('site.'.$product->status)}}
                            </td>
                            <td>
                                <img src="{{$product->image_path}}" style="width: 100px;" class="img-thumbnail">

                            </td>
                          
                        </tr>
                                @endforeach
                                
                          
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
 
</div><!-- end of content wrapper -->
@endsection