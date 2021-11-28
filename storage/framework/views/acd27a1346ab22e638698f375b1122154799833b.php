   <table class="table table-responsive table-striped table-bordered">
       <thead>
           <tr>
               <td><?php echo app('translator')->getFromJson('site.categories'); ?></td>
               <td style=""><?php echo app('translator')->getFromJson('site.description'); ?></td>

               <td><?php echo app('translator')->getFromJson('site.delete'); ?></td>
           </tr>
       </thead>
       <tbody id="TextBoxContainer">
           <?php if(isset($provenanceCategories)): ?>
           <?php $__currentLoopData = $provenanceCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr>
                <td>
    <select class="form-control" name="category_id[]" id="">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option  <?php echo e($item->category_id==$category->id?'selected':''); ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</td>
<td style="">
    <div class="form-group">
        <label>><?php echo app('translator')->getFromJson('site.description'); ?> - English </label>
            <textarea name="description_en[]" required="required" class="form-control "  cols="30" rows="10"><?php echo e($item->description_en); ?></textarea>
        <label>><?php echo app('translator')->getFromJson('site.description'); ?> - Arabic</label>
        <textarea name="description_ar[]" required="required" class="form-control"  cols="30" rows="10"><?php echo e($item->description_ar); ?></textarea>
    </div>
</td>
               <td><button type="button" class="btn btn-danger remove"><i
                           class="glyphicon glyphicon-remove-sign"></i></button></td>
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
                       <?php echo app('translator')->getFromJson('site.more'); ?>&nbsp;</button>
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
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</td>
<td style="">
    <div class="form-group">
        <label>><?php echo app('translator')->getFromJson('site.description'); ?> - English </label>
            <textarea name="description_en[]" required="required" class="form-control summernote"  cols="30" rows="10"></textarea>
        <label>><?php echo app('translator')->getFromJson('site.description'); ?> - Arabic</label>
        <textarea name="description_ar[]" required="required" class="form-control"  cols="30" rows="10"></textarea>
    </div>
</td>



     <td><button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove-sign"></i></button></td>
    `
       }
   </script>
