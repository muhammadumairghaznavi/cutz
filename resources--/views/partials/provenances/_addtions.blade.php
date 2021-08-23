   <table class="table table-responsive table-striped table-bordered">
       <thead>
           <tr>
               <td>@lang('site.categories')</td>
               <td style="">@lang('site.description')</td>

               <td>@lang('site.delete')</td>
           </tr>
       </thead>
       <tbody id="TextBoxContainer">
           @if (isset($provenanceCategories))
           @foreach ($provenanceCategories as $item)
           <tr>
                <td>
    <select class="form-control" name="category_id[]" id="">
        @foreach ($categories as $category)
        <option  {{$item->category_id==$category->id?'selected':''}}  value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
    </select>
</td>
<td style="">
    <div class="form-group">
        <label>>@lang('site.description') - English </label>
            <textarea name="description_en[]" required="required" class="form-control "  cols="30" rows="10">{{$item->description_en}}</textarea>
        <label>>@lang('site.description') - Arabic</label>
        <textarea name="description_ar[]" required="required" class="form-control"  cols="30" rows="10">{{$item->description_ar}}</textarea>
    </div>
</td>
               <td><button type="button" class="btn btn-danger remove"><i
                           class="glyphicon glyphicon-remove-sign"></i></button></td>
           </tr>
           @endforeach
           @endif
       </tbody>
       <tfoot>
           <tr>
               <th colspan="5">
                   <button id="btnAdd" type="button" class="btn btn-warning" data-toggle="tooltip"
                       data-original-title="Add more controls">
                       <i class="glyphicon glyphicon-plus-sign"></i>&nbsp;
                       @lang('site.more')&nbsp;</button>
               </th>
           </tr>
       </tfoot>
   </table>
   <script>
       $(function () {
           $("#btnAdd").bind("click", function () {
               var div = $("<tr />");
               div.html(GetDynamicTextBox(""));
               $("#TextBoxContainer").append(div);
           });
           $("body").on("click", ".remove", function () {
               $(this).closest("tr").remove();
           });
       });
       ///number width height price
       function GetDynamicTextBox(value) {
           return `
        <td>
    <select class="form-control" name="category_id[]" id="">
        @foreach ($categories as $item)
        <option value="{{$item->id}}">{{$item->title}}</option>
        @endforeach
    </select>
</td>
<td style="">
    <div class="form-group">
        <label>>@lang('site.description') - English </label>
            <textarea name="description_en[]" required="required" class="form-control summernote"  cols="30" rows="10"></textarea>
        <label>>@lang('site.description') - Arabic</label>
        <textarea name="description_ar[]" required="required" class="form-control"  cols="30" rows="10"></textarea>
    </div>
</td>



     <td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>
    `
       }
   </script>
