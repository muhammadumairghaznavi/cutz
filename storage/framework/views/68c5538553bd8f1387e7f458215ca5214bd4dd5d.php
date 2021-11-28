<?php
$page = 'products';
$title = trans('site.products');
?>

<?php $__env->startSection('title_page'); ?>
    <?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo app('translator')->getFromJson('site.products'); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->getFromJson('site.dashboard'); ?></a>
                </li>
                <li><a href="<?php echo e(route('dashboard.products.index')); ?>"> <?php echo app('translator')->getFromJson('site.products'); ?></a></li>
                <li class="active"><?php echo app('translator')->getFromJson('site.edit'); ?></li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo app('translator')->getFromJson('site.edit'); ?></h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    <?php echo $__env->make('partials._errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <form action="<?php echo e(route('dashboard.products.update', $product->id)); ?>" method="post"
                        enctype="multipart/form-data">
                        
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('put')); ?>

                        <div class="col-md-6">
                            <?php $__currentLoopData = config('translatable.locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                    <span class="label label-warning  "><?php echo e($key + 1); ?> </span>
                                    <label><?php echo app('translator')->getFromJson('site.' . $locale . '.title'); ?></label>
                                    <input type="text" required="required" name="<?php echo e($locale); ?>[title]"
                                        class="form-control" value="<?php echo e($product->translate($locale)->title); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('site.' . $locale . '.details'); ?></label>
                                    <textarea required="required" name="<?php echo e($locale); ?>[description]" id=""
                                        class="form-control summernote" cols="30"
                                        rows="5"><?php echo e($product->translate($locale)->description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('site.' . $locale . '.ingredients'); ?></label>
                                    <textarea name="<?php echo e($locale); ?>[extra_description]" id=""
                                        class="form-control summernote" cols="30"
                                        rows="5"><?php echo e($product->translate($locale)->extra_description); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->getFromJson('site.' . $locale . '.frozenInstructions'); ?></label>
                                    <textarea name="<?php echo e($locale); ?>[frozenInstructions]" id=""
                                        class="form-control summernote" cols="30"
                                        rows="5"><?php echo e($product->translate($locale)->frozenInstructions); ?></textarea>
                                </div>
                                <div class="  with-border"></div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.sections'); ?></label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value=""><?php echo app('translator')->getFromJson('site.sections'); ?></option>
                                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($item->id == $product->section_id ? 'selected' : ''); ?>

                                            value="<?php echo e($item->id); ?>">
                                            <?php echo e($item->title); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.categories'); ?></label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value=""><?php echo app('translator')->getFromJson('site.sections'); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($item->id == $product->category_id ? 'selected' : ''); ?>

                                            value="<?php echo e($item->id); ?>">
                                            <?php echo e($item->title); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> <!-- /.categories -->
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.subCategories'); ?></label>
                                <select name="subCategory_id" class="form-control">
                                    <option value=""><?php echo app('translator')->getFromJson('site.subCategories'); ?></option>
                                    <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($item->id == $product->subCategory_id ? 'selected' : ''); ?>

                                            value="<?php echo e($item->id); ?>">
                                            <?php echo e($item->title); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> <!-- /.subCategories -->
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.measr_unit'); ?> </label>
                                <select required name="measr_unit" id='measr_unit' onchange="showDiv('hidden_div', this)"
                                    class="form-control">
                                    <option value="measr_uni"><?php echo app('translator')->getFromJson('site.measr_unit'); ?></option>
                                    <option value="per_unit" <?php echo e($product->measr_unit == 'per_unit' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.per_unit'); ?>
                                    </option>
                                    <option value="byGram" <?php echo e($product->measr_unit == 'byGram' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.byGram'); ?>
                                    </option>
                                    <option value="byKilogram"
                                        <?php echo e($product->measr_unit == 'byKilogram' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.byKilogram'); ?>
                                    </option>
                                </select>
                            </div>

                            <?php if($product->measr_unit == 'byGram' || $product->measr_unit == 'byKilogram'): ?>
                                <ul>
                                    <?php $__currentLoopData = $productWeights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$productWeight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <li for=""><?php echo e($productWeight->weight->title); ?> = <?php echo e($productWeight->price); ?> L.E</li>
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                            <?php echo e($product->Total); ?> <?php echo e(__('site.'.currncy())); ?>/ <?php echo e($product->unitValue); ?>-<?php echo e($product->measr_unit); ?>

                            <?php endif; ?>
                            <div>

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
                                <label><?php echo app('translator')->getFromJson('site.unitValue'); ?> </label>
                                <input type="number" step='.5' name="unitValue"
                                    style="background:#00ddec30 ;font-weight: bold"
                                    class="form-control <?php echo e($errors->unitValue ? ' is-invalid' : ''); ?>"
                                    value="<?php echo e($product->unitValue); ?>">
                                <?php if($errors->has('unitValue')): ?>
                                    <span class="is-invalid" role="alert">
                                        <strong>* <?php echo e($errors->first('unitValue')); ?> </strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class=" form-group  ">
                                <label><?php echo app('translator')->getFromJson('site.price'); ?> </label>
                                <input type="price" name="price" style="background:#fff50030 ;font-weight: bold"
                                    class="form-control <?php echo e($errors->price ? ' is-invalid' : ''); ?>"
                                    value="<?php echo e($product->price); ?>">
                                <?php if($errors->has('price')): ?>
                                    <span class="is-invalid" role="alert">
                                        <strong>* <?php echo e($errors->first('price')); ?> </strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class=" form-group  ">
                                <label><?php echo app('translator')->getFromJson('site.discount'); ?> </label>
                                <input type="discount" name="discount" style="background:#fff50030 ;font-weight: bold"
                                    class="form-control <?php echo e($errors->discount ? ' is-invalid' : ''); ?>"
                                    value="<?php echo e($product->discount); ?>">
                                <?php if($errors->has('discount')): ?>
                                    <span class="is-invalid" role="alert">
                                        <strong>* <?php echo e($errors->first('discount')); ?> </strong>
                                    </span>
                                <?php endif; ?>
                            </div> 
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.stock'); ?> </label>
                                <input type="number" name="stock" min="1" class="form-control"
                                    value="<?php echo e($product->stock); ?>">
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.serve_number'); ?> </label>
                                <input type="number" name="serve_number" min="1" class="form-control"
                                    value="<?php echo e($product->serve_number); ?>">
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.provenances'); ?> </label>
                                <select name="provenance_id" class="form-control ">
                                    <option value=""> <?php echo app('translator')->getFromJson('site.provenances'); ?> </option>
                                    <?php $__currentLoopData = $provenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"
                                            <?php echo e($product->provenance_id == $item->id ? 'selected' : ''); ?>>
                                            <?php echo e($item->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.nutritionFact'); ?> </label>
                                <input type="file" name="nutritionFact" class="form-control image4"
                                    enctype="multipart/form-data">
                                <img src="<?php echo e($product->image_nutrition); ?>" style="width: 100px"
                                    class="img-thumbnail image-preview4" alt="">
                            </div>



                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.Our Best Sellers'); ?> </label>
                                <select name="best_seller" class="form-control ">
                                    <option value="not_active"
                                        <?php echo e($product->best_seller == 'not_active' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.not_active'); ?></option>
                                    <option value="active" <?php echo e($product->best_seller == 'active' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.active'); ?>
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.BBQ'); ?> </label>
                                <select name="falg" class="form-control ">
                                    <option value="no" <?php echo e($product->falg == 'no' ? 'selected' : ''); ?>> <?php echo app('translator')->getFromJson('site.no'); ?>
                                    </option>
                                    <option value="yes" <?php echo e($product->falg == 'yes' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.panSearing'); ?> </label>
                                <select name="panSearing" class="form-control ">
                                    <option value="no" <?php echo e($product->panSearing == 'no' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.no'); ?>
                                    </option>
                                    <option value="yes" <?php echo e($product->panSearing == 'yes' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.chilies'); ?> </label>
                                <select name="chilies" class="form-control ">
                                    <option value="no" <?php echo e($product->chilies == 'no' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.no'); ?>
                                    </option>
                                    <option value="yes" <?php echo e($product->chilies == 'yes' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.frozen'); ?> </label>
                                <select name="frozen" class="form-control ">
                                    <option value="no" <?php echo e($product->frozen == 'no' ? 'selected' : ''); ?>> <?php echo app('translator')->getFromJson('site.no'); ?>
                                    </option>
                                    <option value="yes" <?php echo e($product->frozen == 'yes' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.hermonFree'); ?> </label>
                                <select name="hermonFree" class="form-control ">
                                    <option value="yes" <?php echo e($product->hermonFree == 'yes' ? 'selected' : ''); ?>>
                                        <?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.spicail_pag'); ?> </label>
                                <select name="spicail_pag" class="form-control ">
                                    <option <?php echo e($product->spicail_pag == 'not_active' ? 'selected' : ''); ?>

                                        value="not_active">
                                        <?php echo app('translator')->getFromJson('site.not_active'); ?></option>
                                    <option <?php echo e($product->spicail_pag == 'active' ? 'selected' : ''); ?> value="active">
                                        <?php echo app('translator')->getFromJson('site.active'); ?>
                                    </option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.roasting'); ?> roasting</label>
                                <select name="roasting" class="form-control ">
                                    <option <?php echo e($product->roasting == 'no' ? 'selected' : ''); ?> value="no">
                                        <?php echo app('translator')->getFromJson('site.no'); ?>
                                    </option>
                                    <option <?php echo e($product->roasting == 'yes' ? 'selected' : ''); ?> value="yes">
                                        <?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.expiration'); ?> </label>
                                <textarea name="expiration" id="" class="form-control" cols="30"
                                    rows="10"><?php echo e($product->expiration); ?></textarea>
                            </div>



                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.sku'); ?> </label>
                                <input type="text" name="sku" class="form-control" value="<?php echo e($product->sku); ?>">
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.home_page'); ?> </label>
                                <select name="home_page" id="" class="form-control">
                                    <option <?php echo e($product->home_page == 'no' ? 'selected' : ''); ?> value="no">
                                        <?php echo app('translator')->getFromJson('site.no'); ?>
                                    </option>
                                    <option <?php echo e($product->home_page == 'yes' ? 'selected' : ''); ?> value="yes">
                                        <?php echo app('translator')->getFromJson('site.yes'); ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.status'); ?> </label>
                                <select required="required" name="status" id="" class="form-control">
                                    <option <?php echo e($product->status == 'not_active' ? 'selected' : ''); ?> value="not_active">
                                        <?php echo app('translator')->getFromJson('site.not_active'); ?>
                                    </option>
                                    <option <?php echo e($product->status == 'active' ? 'selected' : ''); ?> value="active">
                                        <?php echo app('translator')->getFromJson('site.Active'); ?></option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.image'); ?></label>
                                <input type="file" name="image" class="form-control image" enctype="multipart/form-data">
                            </div>
                            <div class="form-group">
                                <img src="<?php echo e($product->image_path); ?>" style="width: 100px"
                                    class="img-thumbnail image-preview" alt="">
                            </div>
                            <div class="form-group">
                                <label for="files"><?php echo app('translator')->getFromJson('site.images'); ?></label>
                                <input type="file" multiple name="images[]" class="form-control image2"
                                    id="gallery-photo-add">
                                <div class="gallery">
                                </div>
                            </div>
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imgs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('dashboard.products.image.delete', $imgs['id'])); ?>"
                                    onclick="return confirm('<?php echo e(trans('site.confirm_delete')); ?>')"
                                    class="confirm btn btn-danger img-thumbnail image-previewBL" style="width: 100px;"
                                    title="Delete this item">
                                    <i class="fa fa-trash"></i><br>
                                    <img src="<?php echo e($imgs->image_path); ?>" class="img-thumbnail image-previewBL" alt="">
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <br>
                                <br>
                                <div class="form-group" data-select2-id="25">
                                    <label for="files"><?php echo app('translator')->getFromJson('site.tags'); ?></label>
                                    <select autocomplete="false" class="form-control select2 select2-hidden-accessible"
                                        multiple="" data-placeholder="<?php echo app('translator')->getFromJson('site.tags'); ?>" style="width: 100%;"
                                        aria-hidden="true" name="tag_id[]">
                                        <?php $__currentLoopData = $tag_selects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tag->id); ?>" selected> <?php echo e($tag->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tag->id); ?>"> <?php echo e($tag->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="files"><?php echo app('translator')->getFromJson('site.pieces'); ?></label>
                                <label for="files" style="color:red"> أختيارك للتصنيف يظهر القطع المناسبة</label>
                                <?php $__currentLoopData = $piece_selects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="containercheckbox">
                                        <input class="checkbox" type="checkbox" checked name="piece_id[]"
                                            value="<?php echo e($item->id); ?>">
                                        <?php echo e($item->category->title); ?> / <?php echo e($item->title); ?> <span
                                            class="checkmark"></span></label>
                                    <br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $pieces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="containercheckbox">
                                        <input class="checkbox" type="checkbox" name="piece_id[]"
                                            value="<?php echo e($item->id); ?>">
                                        <?php echo e($item->category->title); ?> / <?php echo e($item->title); ?> <span
                                            class="checkmark"></span></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div> 
                        <div class="col-md-12">




                            <?php echo $__env->make('partials.products._addtions', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                    <?php echo app('translator')->getFromJson('site.edit'); ?></button>
                            </div>
                        </div>

                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
    <script type="text/javascript">
        $(document).ready(function() {

            $('select[name="section_id"]').on('change', function() {
                var item = $(this).val();
                $('select[name="category_id"]').empty();
                $('select[name="subCategory_id"]').empty();
                if (item) {
                    $.ajax({
                        url: '/dashboard/category_list/ajax/' + item,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="category_id"]').empty();
                            $('select[name="category_id"]').append('<option value=""> <?php echo app('translator')->getFromJson('
                                site.categories '); ?> </option>');
                            $.each(data, function(key, value) {
                                $('select[name="category_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .title + '</option>');
                            });
                        }
                    });
                }
            }); //end of  category
            $('select[name="category_id"]').on('change', function() {
                var item = $(this).val();
                $('select[name="subCategory_id"]').empty();
                if (item) {
                    $.ajax({
                        url: '/dashboard/sub_category_list/ajax/' + item,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subCategory_id"]').empty();
                            $('select[name="subCategory_id"]').append('<option value=""> <?php echo app('translator')->getFromJson('
                                site.subCategories '); ?> </option>');
                            $.each(data, function(key, value) {
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
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>