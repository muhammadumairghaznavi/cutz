<table class="table table-hover" id="data_table">
  <thead>
      <tr>
          <th>#</th>
          <th>idRms</th>
          <th>@lang('site.category')</th>
          <th>@lang('site.name')</th>
          <th>@lang('site.sku')</th>
          {{-- <th>@lang('site.description')</th> --}}
          <th>@lang('site.price')</th>
          <th>@lang('site.status')</th>
          {{-- <th>@lang('site.image')</th> --}}
          <th>@lang('site.stock')</th>
          {{-- <th>@lang('site.additions')</th>
          <th>@lang('site.weights')</th>
          <th>@lang('site.instructions')</th>
          <th>@lang('site.productLocation')</th> --}}
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
              {{ $product->sku}}
          </td>
              
          <td>
              {{ $product->Total}} {{__('site.'.currncy())}}/ {{$product->unitValue}}-{{$product->measr_unit}}
          </td>
          <td>
              {{__('site.'.$product->status)}}
          </td>
          {{-- <td>
              <img src="{{$product->image_path}}" style="width: 100px;" class="img-thumbnail">
          </td> --}}
          <td>
              <span
                  class="  btn-{{$product->stock_status=="AvailableOfStock"?'success':'warning'}} btn-sm ">
                  ({{$product->stock_count}}){{ __('site.'.$product->stock_status) }}</span>
          </td>
      </tr>
      @endforeach
  </tbody>
</table><!-- end of table -->
