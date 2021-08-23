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
                <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
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
                        {{-- <div class="form-group">
                                <label>@lang('site.' . $locale . '.short_description')</label>
                                        <textarea required="required" name="{{ $locale }}[short_description]" id=""
                                class="form-control summernote " cols="30"
                                rows="5">{{ old($locale . '.short_description') }}</textarea>
                           </div> --}}
                        <div class="form-group">
                            <label>@lang('site.' . $locale . '.details')</label>
                            <textarea required="required" name="{{ $locale }}[description]" id=""
                                class="form-control summernote" cols="30"
                                rows="5">{{ old($locale . '.description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>@lang('site.' . $locale . '.ingredients')</label>
                            <textarea  name="{{ $locale }}[extra_description]" id=""
                                class="form-control summernote" cols="30"
                                rows="5">{{ old($locale . '.extra_description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.' . $locale . '.frozenInstructions')</label>
                            <textarea  name="{{ $locale }}[frozenInstructions]" id=""
                                class="form-control summernote" cols="30"
                                rows="5">{{ old($locale . '.frozenInstructions') }}</textarea>
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
                        <option value="{{ $item->id }}" {{ old('section_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>@lang('site.categories')</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">@lang('site.categories') </option>
                    </select>
                </div> <!-- /.categories -->
                <div class="form-group">
                    <label>@lang('site.subCategories')</label>
                    <select name="subCategory_id" class="form-control">
                        <option value="">@lang('site.subCategories') </option>
                    </select>
                </div> <!-- /.subCategories -->

             <div class="form-group">
                <label>@lang('site.measr_unit') </label>
                <select name="measr_unit" class="form-control">
                    <option value="unit"  >@lang('site.per_unit')</option>
                    <option value="weight"  >@lang('site.per_weight')</option>
                </select>
             </div>

                @php
                $egy=[ 'price' ,'discount' , ];
                @endphp
                @for ($i = 0; $i < 2; $i++) <div class=" form-group  ">
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
            @endfor {{-- endfor price --}}

            <div class="form-group">
                <label>@lang('site.stock') </label>
                <input type="number" name="stock"  min="1" class="form-control" value="{{old('stock')}}">
            </div>
            <div class="form-group">
                <label>@lang('site.serve_number') </label>
                <input type="number" name="serve_number" min="1"  class="form-control" value="{{old('serve_number')}}">
            </div>
               <div class="form-group">
                <label>@lang('site.provenances') </label>
                 <select name="provenance_id" class="form-control ">
                     <option value=""  > @lang('site.provenances') </option>
                     @foreach ($provenances as $item)
                     <option value="{{$item->id}}" > {{$item->title}}</option>
                     @endforeach
                 </select>
             </div>

            <div class="form-group">
                <label>@lang('site.country') </label>
                <input type="text" name="country" class="form-control" value="{{old('country')}}">
            </div>
            <div class="form-group">
                <label>@lang('site.image_flag') </label>
                <input type="file" name="image_flag" class="form-control image3" enctype="multipart/form-data">
                <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview3"
                    alt="">
            </div>
            <div class="form-group">
                <label>@lang('site.nutritionFact') </label>
                <input type="file" name="nutritionFact" class="form-control image4" enctype="multipart/form-data">
                <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview4"
                    alt="">
            </div>


            {{-- select tage   --}}
             @include('partials.products._selection')


        </div>{{-- col md 3 --}}

        <div class="col-md-3">
            <div class="form-group">
                <label>@lang('site.sku') </label>
                <input type="text" name="sku" class="form-control" value="{{old('sku')}}">
            </div>

            <div class="form-group">
                <label>@lang('site.home_page') </label>
                <select name="home_page" id="" class="form-control">
                    <option value="no">@lang('site.no')</option>
                    <option value="yes">@lang('site.yes')</option>
                </select>
            </div>
            <div class="form-group">
                <label>@lang('site.status') </label>
                <select required="required" name="status" id="" class="form-control">
                    <option value="not_active">@lang('site.not_active')</option>
                    <option value="active">@lang('site.Active')</option>
                </select>
            </div>
            {{-- Image --}}
            <div class="form-group">
                <label>@lang('site.image')</label>
                <input type="file" name="image" required="required" class="form-control image" enctype="multipart/form-data">
            </div>
            <div class="form-group">
                <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview"
                    alt="">
            </div>
            <div class="form-group">
                <label for="files">@lang('site.images')</label>
                <input type="file" multiple name="images[]" class="form-control image2" id="gallery-photo-add">
                <div class="gallery">
                </div>
            </div>
            <div class="form-group">


            <div class="form-group" data-select2-id="25">
                  <label for="files">@lang('site.tags')</label>
                <select autocomplete="false" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="@lang('site.tags')" style="width: 100%;"   aria-hidden="true" name="tag_id[]" >
                    @foreach ($tags as $tag)
                    <option  value="{{$tag->id}}">{{$tag->title}}</option>
                    @endforeach
                </select>
              </div>


            </div>
            <hr>
          <div class="form-group"  >

                {{-- @foreach ($pieces as $piece)
                <label class="containercheckbox">
                    <input class="checkbox" type="checkbox" name="piece_id[]" value="{{$piece->id}}">
                    {{$piece->title}} <span class="checkmark"></span></label>
                @endforeach --}}

                <label for="files">@lang('site.pieces')</label>
                <label for="files" style="color:red"> أختيارك للتصنيف يظهر القطع المناسبة</label>
                <div id="pieces"></div>
            </div>


        </div>{{-- end col md 3 --}}

<div class="col-md-12">

    <span class="label label-danger  "> @lang('site.additions') </span>

 @include('partials.products._addtions')
 </div>
    {{-- <div class="col-md-6">
    <span class="label label-danger  "> @lang('site.instructions') </span>

           @include('partials.products._instructions')
            </div> --}}
<div class="col-md-12">
  <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('site.add')</button>
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
                    url: '/dashboard/category_list/ajax/'+item,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="category_id"]').empty();
                        $('select[name="category_id"]').append('<option value=""> @lang('site.categories') </option>');
                        $.each(data, function (key, value) {
                            $('select[name="category_id"]').append(
                                '<option value="' + value.id + '">'+ value.title + '</option>');
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
                        $('select[name="subCategory_id"]').append('<option value=""> @lang('site.subCategories') </option>');
                        $.each(data, function (key, value) {
                            $('select[name="subCategory_id"]').append(
                                '<option value="' + value.id + '">' + value.title + '</option>');
                        });
                    }
                });
                ////////// pieces

                $.ajax({
                    url: '/dashboard/pieces/ajax/' + item,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                          $('#pieces').empty();
                          $.each(data, function (key, value) {
                         $('#pieces')
                            .append('<label class="containercheckbox"><input type="checkbox" id="car" name="piece_id[]" value="' + value.id + '">' + value.title + '<span class="checkmark"></span></label>');
                        });
                    }
                });
                ////// END pieces
            }
        }); //end of  sub_category




     });
</script>
@endsection
