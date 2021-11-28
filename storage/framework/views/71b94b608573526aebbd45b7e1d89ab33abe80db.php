   <table class="table table-responsive table-striped table-bordered">
       <thead>
           <tr>
               <td style=""><?php echo app('translator')->getFromJson('site.additions'); ?></td>
               <td><?php echo app('translator')->getFromJson('site.price'); ?></td>
               <td><?php echo app('translator')->getFromJson('site.delete'); ?></td>
           </tr>
       </thead>
       <tbody id="TextBoxContainer">
           <?php if(isset($additions)): ?>

           <?php $__currentLoopData = $additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr  >
               <td style="">
                    <div class="form-group"><label><?php echo app('translator')->getFromJson('site.title_addition_en'); ?></label><input type="text" name="title_en[]" class="form-control" value="<?php echo e($item->title_en); ?>"></div>
                    <div class="form-group"><label><?php echo app('translator')->getFromJson('site.title_addition_ar'); ?></label><input type="text" name="title_ar[]" class="form-control" value="<?php echo e($item->title_ar); ?>"></div>
               </td>
               <td>
                   <div class=" form-group  ">
                       <label><?php echo app('translator')->getFromJson('site.price'); ?> </label>
                       <input type="number" name="price_addtion[]" style="background:#fff50030 ;font-weight: bold"
                           class="form-control " value="<?php echo e($item->price); ?>"
                         >

                   </div>

                </td>
              <td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>
           </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
       </tbody>
       <tfoot>
           <tr>
               <th colspan="5">
                   <button id="btnAdd" type="button" class="btn btn-warning" data-toggle="tooltip"
                       data-original-title="Add more controls">
                       <i class="glyphicon glyphicon-plus-sign"></i>&nbsp;
                       <?php echo app('translator')->getFromJson('site.additions'); ?>&nbsp;</button>
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
           return'<td style=""><div class="form-group"><label><?php echo app('translator')->getFromJson('site.title_addition_en'); ?></label><input type="text" name="title_en[]" required="required" class="form-control" value=""></div>'+
'<div class="form-group"><label><?php echo app('translator')->getFromJson('site.title_addition_ar'); ?></label><input type="text"  required="required"  name="title_ar[]" class="form-control" value=""></div></td>'+
'<td><div class="form-group"><label><?php echo app('translator')->getFromJson('site.price'); ?> </label><input type="number" value="" name="price_addtion[]" style="background:#fff50030 ;font-weight: bold"class="form-control"  required="required" ></div>'+
'<td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>'
       }
   </script>
