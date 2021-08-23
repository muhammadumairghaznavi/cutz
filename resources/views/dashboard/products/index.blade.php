@extends('layouts.dashboard.app')
<?php
$page="products";
$title=trans('site.products');
// to hide any section please type -> close
$section_search='';
$section_add=' ';
$section_edit=' ';
$section_delete=' ';
$section_duplicate='close';
$productLocation_edit='';
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.products')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products')
                    <small>
                        @lang('site.total_search')
                        ( {{  $countProducts }} )
                    </small></h3>
                <form action="{{ route('dashboard.products.index') }}" method="get">
                    <div class="row">
                        <div class="{{$section_search=='close'?'hidden':''}}">
                            <div class="col-md-2">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-1">
                                <input type="text" name="sku" class="form-control" placeholder="@lang('site.sku')"
                                    value="{{ request()->sku }}">
                            </div>
                            <div class="col-md-2">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name='status' class="form-control">
                                    <option value="">status</option>
                                    <option value="active" @if(request('status')=='active' ) selected @endif>
                                        @lang('site.Active')</option>
                                    <option value="not_active" @if(request('status')=='not_active' ) selected @endif>
                                        @lang('site.In-Active')</option>
                                </select>
                                <!--<select name="stock_stauts" class="form-control">-->
                                <!--    <option value="">@lang('site.stock_stauts')</option>-->
                                <!--    <option  {{ request()->stock_stauts =="OutOfStock" ? 'selected' : '' }} value="OutOfStock">@lang('site.OutOfStock')</option>-->
                                <!--    <option  {{ request()->stock_stauts =="LimitedOfStock" ? 'selected' : '' }} value="LimitedOfStock">@lang('site.LimitedOfStock')</option>-->
                                <!--    <option  {{ request()->stock_stauts =="AvailableOfStock" ? 'selected' : '' }} value="AvailableOfStock">@lang('site.AvailableOfStock')</option>-->
                                <!--</select>-->
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{$section_add=='close'?'hidden':''}}">
                            @if (auth()->user()->hasPermission('create_products'))
                            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                            
                              <a href="{{ route('dashboard.products.export') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                              @lang('site.export')</a>


                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($products->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>idRms</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.name')</th>
                            {{-- <th>@lang('site.description')</th> --}}
                            <th>@lang('site.price')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.stock')</th>
                            {{-- <th>@lang('site.additions')</th>
                            <th>@lang('site.weights')</th>
                            <th>@lang('site.instructions')</th>
                            <th>@lang('site.productLocation')</th> --}}
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index=>$product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $product->idRms }}</td>
                            <td>
                                {{ $product->section->title??"لا يوجد" }}>>
                                {{ $product->category->title??"لا يوجد" }}>>
                                {{ $product->subCategory->title??"لا يوجد" }}
                            </td>
                            <td>
                                {{ $product->title }}</td>
                            <td>
                                {{ $product->Total}} {{__('site.'.currncy())}}/ {{$product->unitValue}}-{{$product->measr_unit}}
                            </td>
                            <td>
                                {{__('site.'.$product->status)}}
                            </td>
                            <td>
                                <img src="{{$product->image_path}}" style="width: 100px;" class="img-thumbnail">
                            </td>
                            <td>
                                <span
                                    class="  btn-{{$product->stock_status=="AvailableOfStock"?'success':'warning'}} btn-sm ">
                                    ({{$product->stock_count}}){{ __('site.'.$product->stock_status) }}</span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true">
                                        @lang('site.action')
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li>
                                            @if (auth()->user()->hasPermission('update_products'))
                                            <a href="{{ route('dashboard.products.duplicate', $product->id) }}"
                                                class="warning btn-sm {{$section_duplicate=='close'?'hidden':''}}"><i
                                                    class="fa fa-copy"></i> @lang('site.duplicate')</a>
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                class="btn-success btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                                    class="fa fa-edit"></i> @lang('site.edit')</a>
                                            @else
                                            <a href="#" class="btn-success btn-sm disabled"><i class="fa fa-edit"></i>
                                                @lang('site.edit')</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a style="display: inline-block" href="{{ route('dashboard.productLocations.index',[
                                    'product_id'=>$product->id
                                ]) }}" class="danger btn-sm {{$productLocation_edit=='close'?'hidden':''}}"><i
                                                    class="fa fa-cock"></i> {{$product->productLocation->count()}}
                                                @lang('site.productLocations')</a>
                                        </li>
                                        <li>
                                            <a style="display: inline-block" href="{{ route('dashboard.instructions.index',[
                                    'product_id'=>$product->id
                                ]) }}" class="danger btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                                    class="fa fa-cock"></i> {{$product->instructions->count()}}
                                                @lang('site.instructions')</a>
                                        </li>
                                        <li>
                                            <a style="display: inline-block"
                                                href="{{ route('dashboard.productWeights.index',[ 'search'=>$product->id]) }}"
                                                class="warning btn-sm {{$section_edit=='close'?'hidden':''}}"><i
                                                    class="fa fa-cock"></i> {{$product->productWeights->count()}}
                                                @lang('site.productWeights')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard.additions.index',['product_id'=>$product->id]) }}"
                                                style="display: inline-block"
                                                class="success btn-sm {{$section_edit=='close'?'hidden':''}}">
                                                <i class="fa fa-cock"></i> {{$product->additions->count()}} additions
                                            </a>
                                        </li>
                                        <li>
                                            @if (auth()->user()->hasPermission('delete_products'))
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                                method="post" style=" ">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit"
                                                    class="btn-danger delete btn-sm {{$section_delete=='close'?'hidden':''}}"><i
                                                        class="fa fa-trash"></i> </button>
                                            </form><!-- end of form -->
                                            @else
                                            <button class="danger btn-sm disabled"><i class="fa fa-trash"></i>
                                                @lang('site.delete')</button>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- end of table -->
                {{ $products->appends(request()->query())->links() }}
                @else
                <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
