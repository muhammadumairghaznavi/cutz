@extends('layouts.dashboard.app')
<?php
$page="products";
$title=trans('site.products');
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
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
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
                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="col-md-6">
                        @foreach (config('translatable.locales') as $key=>$locale)
                        <div class="form-group">
                            <span class="label label-warning  ">{{$key+1}} </span>
                            <label>@lang('site.' . $locale . '.title')</label>
                            <input type="text" required="required" name="{{ $locale }}[title]" class="form-control"
                                value="{{ $product->translate($locale)->title }}">
                        </div>
                        {{-- <div class="form-group">
                                <label>@lang('site.' . $locale . '.short_description')</label>
                                        <textarea required="required" name="{{ $locale }}[short_description]" id=""
                        class="form-control summernote " cols="30"
                        rows="5">{{ $product->translate($locale)->short_description }}</textarea>
                    </div> --}}
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.details')</label>
                        <textarea required="required" name="{{ $locale }}[description]" id=""
                            class="form-control summernote" cols="30"
                            rows="5">{{ $product->translate($locale)->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.ingredients')</label>
                        <textarea name="{{ $locale }}[extra_description]" id="" class="form-control summernote"
                            cols="30" rows="5">{{ $product->translate($locale)->extra_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.' . $locale . '.frozenInstructions')</label>
                        <textarea name="{{ $locale }}[frozenInstructions]" id="" class="form-control summernote"
                            cols="30" rows="5">{{ $product->translate($locale)->frozenInstructions }}</textarea>
                    </div>
                    <div class="  with-border"></div><br>
                    @endforeach
            </div> {{-- end col md 6 --}}
            <div class="col-md-3">
                <div class="form-group">
                    <label>@lang('site.sections')</label>
                    <select name="section_id" id="section_id" class="form-control">
                        <option value="">@lang('site.sections')</option>
                        @foreach ($sections as $item)
                        <option {{$item->id==$product->section_id?'selected':''}} value="{{ $item->id }}">
                            {{ $item->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('site.categories')</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">@lang('site.sections')</option>
                        @foreach ($categories as $item)
                        <option {{$item->id==$product->category_id?'selected':''}} value="{{ $item->id }}">
                            {{ $item->title }}
                        </option>
                        @endforeach
                    </select>
                </div> <!-- /.categories -->
                <div class="form-group">
                    <label>@lang('site.subCategories')</label>
                    <select name="subCategory_id" class="form-control">
                        <option value="">@lang('site.subCategories')</option>
                        @foreach ($subCategories as $item)
                        <option {{$item->id==$product->subCategory_id?'selected':''}} value="{{ $item->id }}">
                            {{ $item->title }}
                        </option>
                        @endforeach
                    </select>
                </div> <!-- /.subCategories -->
                <div class="form-group">
                    <label>@lang('site.measr_unit') </label>
                    <select name="measr_unit" id='measr_unit' onchange="showDiv('hidden_div', this)"  class="form-control">
                       <option value="" >@lang('site.measr_unit')</option>
                        <option value="per_unit" {{$product->measr_unit=='per_unit'?'selected':''}}>@lang('site.per_unit')
                        </option>
                        <option value="weight" {{$product->measr_unit=='weight'?'selected':''}}>@lang('site.per_weight')
                        </option>
                    </select>
                </div>

                <style>
                    #hidden_div {
                        display: none;
                    }

                </style>
                <script>
                    function showDiv(divId, element) {

                        document.getElementById(divId).style.display = element.value == 'per_unit' ? 'block' : 'none';
                    }

                </script>

                <div class=" form-group   " id="hidden_div">
                    <label>@lang('site.unitValue') </label>
                    <input type="number" step='.5' name="unitValue" style="background:#00ddec30 ;font-weight: bold"
                        class="form-control {{ $errors->unitValue  ? ' is-invalid' : '' }}"
                        value="{{$product->unitValue}}">
                    @if ($errors->has('unitValue'))
                    <span class="is-invalid" role="alert">
                        <strong>* {{$errors->first('unitValue')}} </strong>
                    </span>
                    @endif
                </div>






                <div class=" form-group  ">
                    <label>@lang('site.price') </label>
                    <input type="price" name="price" style="background:#fff50030 ;font-weight: bold"
                        class="form-control {{ $errors->price  ? ' is-invalid' : '' }}" value="{{$product->price}}">
                    @if ($errors->has('price'))
                    <span class="is-invalid" role="alert">
                        <strong>* {{$errors->first('price')}} </strong>
                    </span>
                    @endif
                </div>
                <div class=" form-group  ">
                    <label>@lang('site.discount') </label>
                    <input type="discount" name="discount" style="background:#fff50030 ;font-weight: bold"
                        class="form-control {{ $errors->discount  ? ' is-invalid' : '' }}"
                        value="{{$product->discount}}">
                    @if ($errors->has('discount'))
                    <span class="is-invalid" role="alert">
                        <strong>* {{$errors->first('discount')}} </strong>
                    </span>
                    @endif
                </div> {{-- endfor price --}}
                <div class="form-group">
                    <label>@lang('site.stock') </label>
                    <input type="number" name="stock" min="1" class="form-control" value="{{$product->stock}}">
                </div>

                <div class="form-group">
                    <label>@lang('site.serve_number') </label>
                    <input type="number" name="serve_number" min="1" class="form-control"
                        value="{{$product->serve_number}}">
                </div>

                <div class="form-group">
                    <label>@lang('site.provenances') </label>
                    <select name="provenance_id" class="form-control ">
                        <option value=""> @lang('site.provenances') </option>
                        @foreach ($provenances as $item)
                        <option value="{{$item->id}}" {{$product->provenance_id==$item->id ?'selected':''}}>
                            {{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                <label>@lang('site.image_flag') </label>
                <input type="file" name="image_flag" class="form-control image3" enctype="multipart/form-data">
                <img src="{{$product->flag_path}}" style="width: 100px" class="img-thumbnail image-preview3"
                alt="">
            </div> --}}

            <div class="form-group">
                <label>@lang('site.nutritionFact') </label>
                <input type="file" name="nutritionFact" class="form-control image4" enctype="multipart/form-data">
                <img src="{{$product->image_nutrition}}" style="width: 100px" class="img-thumbnail image-preview4"
                    alt="">
            </div>



            <div class="form-group">
                <label>@lang('site.Our Best Sellers') </label>
                <select name="best_seller" class="form-control ">
                    <option value="not_active" {{$product->best_seller=='not_active'?'selected':''}}>
                        @lang('site.not_active')</option>
                    <option value="active" {{$product->best_seller=='active'?'selected':''}}>@lang('site.active')
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>@lang('site.BBQ') </label>
                <select name="falg" class="form-control ">
                    <option value="no" {{$product->falg=='no'?'selected':''}}> @lang('site.no')</option>
                    <option value="yes" {{$product->falg=='yes'?'selected':''}}>@lang('site.yes')</option>
                </select>
            </div>

            <div class="form-group">
                <label>@lang('site.panSearing') </label>
                <select name="panSearing" class="form-control ">
                    <option value="no" {{$product->panSearing=='no'?'selected':''}}> @lang('site.no')</option>
                    <option value="yes" {{$product->panSearing=='yes'?'selected':''}}>@lang('site.yes')</option>
                </select>
            </div>
            <div class="form-group">
                <label>@lang('site.chilies') </label>
                <select name="chilies" class="form-control ">
                    <option value="no" {{$product->chilies=='no'?'selected':''}}> @lang('site.no')</option>
                    <option value="yes" {{$product->chilies=='yes'?'selected':''}}>@lang('site.yes')</option>
                </select>
            </div>
            <div class="form-group">
                <label>@lang('site.frozen') </label>
                <select name="frozen" class="form-control ">
                    <option value="no" {{$product->frozen=='no'?'selected':''}}> @lang('site.no')</option>
                    <option value="yes" {{$product->frozen=='yes'?'selected':''}}>@lang('site.yes')</option>
                </select>
            </div>
            <div class="form-group">
                <label>@lang('site.hermonFree') </label>
                <select name="hermonFree" class="form-control ">
                    <option value="yes" {{$product->hermonFree=='yes'?'selected':''}}>@lang('site.yes')</option>
                    {{-- <option value="no" {{$product->panSearing=='no'?'selected':''}}>@lang('site.no')</option> --}}
                </select>
            </div>

            <div class="form-group">
                <label>@lang('site.spicail_pag') </label>
                <select name="spicail_pag" class="form-control ">
                    <option {{$product->spicail_pag=='not_active'?'selected':''}} value="not_active">
                        @lang('site.not_active')</option>
                    <option {{$product->spicail_pag=='active'?'selected':''}} value="active">@lang('site.active')
                    </option>
                </select>
            </div>


            <div class="form-group">
                <label>@lang('site.roasting') roasting</label>
                <select name="roasting" class="form-control ">
                    <option {{$product->roasting=='no'?'selected':''}} value="no">@lang('site.no')</option>
                    <option {{$product->roasting=='yes'?'selected':''}} value="yes">@lang('site.yes')</option>
                </select>
            </div>
            <div class="form-group">
                <label>@lang('site.expiration') </label>
                <textarea name="expiration" id="" class="form-control" cols="30"
                    rows="10">{{$product->expiration}}</textarea>
            </div>



        </div>{{-- col md 3 --}}
        <div class="col-md-3">
            <div class="form-group">
                <label>@lang('site.sku') </label>
                <input type="text" name="sku" class="form-control" value="{{$product->sku}}">
            </div>
            <div class="form-group">
                <label>@lang('site.home_page') </label>
                <select name="home_page" id="" class="form-control">
                    <option {{$product->home_page=='no'?'selected':''}} value="no">@lang('site.no')</option>
                    <option {{$product->home_page=='yes'?'selected':''}} value="yes">@lang('site.yes')</option>
                </select>
            </div>
            <div class="form-group">
                <label>@lang('site.status') </label>
                <select required="required" name="status" id="" class="form-control">
                    <option {{$product->status=='not_active'?'selected':''}} value="not_active">@lang('site.not_active')
                    </option>
                    <option {{$product->status=='active'?'selected':''}} value="active">@lang('site.Active')</option>
                </select>
            </div>
            {{-- Image --}}
            <div class="form-group">
                <label>@lang('site.image')</label>
                <input type="file" name="image" class="form-control image" enctype="multipart/form-data">
            </div>
            <div class="form-group">
                <img src="{{$product->image_path}}" style="width: 100px" class="img-thumbnail image-preview" alt="">
            </div>
            <div class="form-group">
                <label for="files">@lang('site.images')</label>
                <input type="file" multiple name="images[]" class="form-control image2" id="gallery-photo-add">
                <div class="gallery">
                </div>
            </div>
            @foreach ($product->images as $imgs)
            <a href="{{ route('dashboard.products.image.delete',$imgs['id']) }}"
                onclick="return confirm('{{trans('site.confirm_delete')}}')"
                class="confirm btn btn-danger img-thumbnail image-previewBL" style="    width: 100px;
                                                " title="Delete this item">
                <i class="fa fa-trash"></i><br>
                <img src="{{$imgs->image_path}}" class="img-thumbnail image-previewBL" alt="">
            </a>
            @endforeach
            <div>
                <br>
                <br>
                <div class="form-group" data-select2-id="25">
                    <label for="files">@lang('site.tags')</label>
                    <select autocomplete="false" class="form-control select2 select2-hidden-accessible" multiple=""
                        data-placeholder="@lang('site.tags')" style="width: 100%;" aria-hidden="true" name="tag_id[]">
                        @foreach ($tag_selects as $tag)
                        <option value="{{$tag->id}}" selected> {{$tag->title}}</option>
                        @endforeach
                        @foreach ($tags as $tag)
                        <option value="{{$tag->id}}"> {{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="files">@lang('site.pieces')</label>
                <label for="files" style="color:red"> أختيارك للتصنيف يظهر القطع المناسبة</label>
                @foreach ($piece_selects as $item)
                <label class="containercheckbox">
                    <input class="checkbox" type="checkbox" checked name="piece_id[]" value="{{$item->id}}">
                    {{$item->category->title}} / {{$item->title}} <span class="checkmark"></span></label>
                <br>
                @endforeach
                @foreach ($pieces as $item)
                <label class="containercheckbox">
                    <input class="checkbox" type="checkbox" name="piece_id[]" value="{{$item->id}}">
                    {{$item->category->title}} / {{$item->title}} <span class="checkmark"></span></label>
                @endforeach
            </div>
        </div> {{-- end col md 6 --}}
        <div class="col-md-12">




            @include('partials.products._addtions')

        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                    @lang('site.edit')</button>
            </div>
        </div>

        </form><!-- end of form -->
</div><!-- end of box body -->
</div><!-- end of box -->
</section><!-- end of content -->
</div><!-- end of content wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="section_id"]').on('change', function () {
            var item = $(this).val();
            $('select[name="category_id"]').empty();
            $('select[name="subCategory_id"]').empty();
            if (item) {
                $.ajax({
                    url: '/dashboard/category_list/ajax/' + item,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="category_id"]').empty();
                        $('select[name="category_id"]').append('<option value=""> @lang('
                            site.categories ') </option>');
                        $.each(data, function (key, value) {
                            $('select[name="category_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .title + '</option>');
                        });
                    }
                });
            }
        }); //end of  category
        $('select[name="category_id"]').on('change', function () {
            var item = $(this).val();
            $('select[name="subCategory_id"]').empty();
            if (item) {
                $.ajax({
                    url: '/dashboard/sub_category_list/ajax/' + item,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subCategory_id"]').empty();
                        $('select[name="subCategory_id"]').append('<option value=""> @lang('
                            site.subCategories ') </option>');
                        $.each(data, function (key, value) {
                            $('select[name="subCategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .title + '</option>');
                        });
                    }
                });
            }
        }); //end of  sub_category
    });

</script>
@endsection
