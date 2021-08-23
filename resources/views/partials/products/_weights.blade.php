   <table class="table table-responsive table-striped table-bordered">
       <thead>
           <tr>
               <td style="">@lang('site.weights')</td>
               <td>@lang('site.price')</td>
               <td>@lang('site.stock')</td>
               <td>@lang('site.delete')</td>
           </tr>
       </thead>
       <tbody id="TextBoxContainerweight">
       </tbody>
       <tfoot>
           <tr>
               <th colspan="5">
                   <button id="btnAddweight" type="button" class="btn btn-warning" data-toggle="tooltip"
                       data-original-title="Add more controls">
                       <i class="glyphicon glyphicon-plus-sign"></i>&nbsp;
                       @lang('site.additions')&nbsp;</button>
               </th>
           </tr>
       </tfoot>
   </table>
   {{-- <script src="https://code.jquery.com/jquery-latest.js"></script> --}}
   {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
   {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
   <script>
       $(function () {
           $("#btnAddweight").bind("click", function () {
               var div = $("<tr />");
               div.html(GetDynamicTextBox(""));
               $("#TextBoxContainerweight").append(div);
           });
           $("body").on("click", ".remove", function () {
               $(this).closest("tr").remove();
           });
       });
       ///number width height price
       function GetDynamicTextBox(value) {
           return '<div class="form-group"><label>@lang('site.title_addition_ar')</label><input type="text"  required="required"  name="title_ar[]" class="form-control" value=""></div></td>'+
'<td><div class="form-group"><label>@lang('site.price') </label><input type="number" value="" name="price_addtion[]" style="background:#fff50030 ;font-weight: bold"class="form-control"  required="required" ></div>'+
'<td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>'
       }
   </script>
