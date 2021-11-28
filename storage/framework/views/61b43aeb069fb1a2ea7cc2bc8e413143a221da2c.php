<?php
$page = 'products';
$title = trans('site.products');
// to hide any section please type -> close
$section_search = '';
$section_add = ' ';
$section_edit = ' ';
$section_delete = ' ';
$section_duplicate = 'close';
$productLocation_edit = '';
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
                <li class="active"><?php echo app('translator')->getFromJson('site.products'); ?></li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px"><?php echo app('translator')->getFromJson('site.products'); ?>
                        <small>
                            <?php echo app('translator')->getFromJson('site.total_search'); ?>
                            ( <?php echo e($countProducts); ?> )
                        </small>
                    </h3>
                    <form action="<?php echo e(route('dashboard.products.index')); ?>" method="get">
                        <div class="row">
                            <div class="<?php echo e($section_search == 'close' ? 'hidden' : ''); ?>">
                                <div class="col-md-2">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="<?php echo app('translator')->getFromJson('site.search'); ?>" value="<?php echo e(request()->search); ?>">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" name="sku" class="form-control" placeholder="<?php echo app('translator')->getFromJson('site.sku'); ?>"
                                        value="<?php echo e(request()->sku); ?>">
                                </div>
                                <div class="col-md-2">
                                    <select name="category_id" class="form-control">
                                        <option value=""><?php echo app('translator')->getFromJson('site.all_categories'); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"
                                                <?php echo e(request()->category_id == $category->id ? 'selected' : ''); ?>>
                                                <?php echo e($category->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name='status' class="form-control">
                                        <option value="">status</option>
                                        <option value="active" <?php if(request('status') == 'active'): ?> selected <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('site.Active'); ?></option>
                                        <option value="not_active" <?php if(request('status') == 'not_active'): ?> selected <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('site.In-Active'); ?></option>
                                    </select>
                                    <!--<select name="stock_stauts" class="form-control">-->
                                    <!--    <option value=""><?php echo app('translator')->getFromJson('site.stock_stauts'); ?></option>-->
                                    <!--    <option  <?php echo e(request()->stock_stauts == 'OutOfStock' ? 'selected' : ''); ?> value="OutOfStock"><?php echo app('translator')->getFromJson('site.OutOfStock'); ?></option>-->
                                    <!--    <option  <?php echo e(request()->stock_stauts == 'LimitedOfStock' ? 'selected' : ''); ?> value="LimitedOfStock"><?php echo app('translator')->getFromJson('site.LimitedOfStock'); ?></option>-->
                                    <!--    <option  <?php echo e(request()->stock_stauts == 'AvailableOfStock' ? 'selected' : ''); ?> value="AvailableOfStock"><?php echo app('translator')->getFromJson('site.AvailableOfStock'); ?></option>-->
                                    <!--</select>-->
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        <?php echo app('translator')->getFromJson('site.search'); ?></button>
                                </div>
                            </div>
                            <div class="col-md-4 <?php echo e($section_add == 'close' ? 'hidden' : ''); ?>">
                                <?php if(auth()->user()->hasPermission('create_products')): ?>
                                    <a href="<?php echo e(route('dashboard.products.create')); ?>" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('site.add'); ?></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                        <?php echo app('translator')->getFromJson('site.add'); ?></a>
                                <?php endif; ?>

                                <a href="<?php echo e(route('dashboard.products.export')); ?>" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>
                                    <?php echo app('translator')->getFromJson('site.export'); ?></a>


                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                <div class="box-body">
                    <?php if($products->count() > 0): ?>
                        <table class="table table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>idRms</th>
                                    <th><?php echo app('translator')->getFromJson('site.category'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('site.name'); ?></th>
                                    
                                    <th><?php echo app('translator')->getFromJson('site.price'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('site.status'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('site.image'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('site.stock'); ?></th>
                                    
                                    <th><?php echo app('translator')->getFromJson('site.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td>
                                            <?php echo e($product->idRms); ?></td>
                                        <td>
                                            <?php echo e($product->section->title ?? 'لا يوجد'); ?>>>
                                            <?php echo e($product->category->title ?? 'لا يوجد'); ?>>>
                                            <?php echo e($product->subCategory->title ?? 'لا يوجد'); ?>

                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo e(route('dashboard.products.edit', $product->id)); ?>"><?php echo e($product->title); ?></a>
                                        </td>
                                        <td>
                                            <?php
                                                $product = App\Product::find($product->id);
                                                $productWeights = App\ProductWeight::where('product_id', $product->id)->get();
                                                // dd($productWeights);
                                            ?>

                                            <?php if($product->measr_unit == 'byGram' || $product->measr_unit == 'byKilogram'): ?>

                                                <?php $__currentLoopData = $productWeights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $productWeight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    

                                                    <?php echo e($productWeight->weight->title); ?> =
                                                    <?php echo e($productWeight->price); ?> L.E
                                                    <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php else: ?>
                                                <?php echo e($product->Total); ?> <?php echo e(__('site.' . currncy())); ?>/
                                                <?php echo e($product->unitValue); ?>-<?php echo e($product->measr_unit); ?><br />
                                                <?php if($product->discount): ?>

                                                    <?php echo app('translator')->getFromJson('site.discounted'); ?> : <?php echo e($product->discount); ?>


                                                <?php endif; ?>

                                            <?php endif; ?>



                                        </td>
                                        <td>
                                            <?php echo e(__('site.' . $product->status)); ?>

                                        </td>
                                        <td>
                                            <img src="<?php echo e($product->image_path); ?>" style="width: 100px;"
                                                class="img-thumbnail">
                                        </td>
                                        <td>
                                            <span
                                                class="  btn-<?php echo e($product->stock_status == 'AvailableOfStock' ? 'success' : 'warning'); ?> btn-sm ">
                                                (<?php echo e($product->stock_count); ?>)<?php echo e(__('site.' . $product->stock_status)); ?></span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="true">
                                                    <?php echo app('translator')->getFromJson('site.action'); ?>
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenu1">
                                                    <li>
                                                        <?php if(auth()->user()->hasPermission('update_products')): ?>
                                                            <a href="<?php echo e(route('dashboard.products.duplicate', $product->id)); ?>"
                                                                class="warning btn-sm <?php echo e($section_duplicate == 'close' ? 'hidden' : ''); ?>"><i
                                                                    class="fa fa-copy"></i> <?php echo app('translator')->getFromJson('site.duplicate'); ?></a>
                                                            <a href="<?php echo e(route('dashboard.products.edit', $product->id)); ?>"
                                                                class="btn-success btn-sm <?php echo e($section_edit == 'close' ? 'hidden' : ''); ?>"><i
                                                                    class="fa fa-edit"></i> <?php echo app('translator')->getFromJson('site.edit'); ?></a>
                                                        <?php else: ?>
                                                            <a href="#" class="btn-success btn-sm disabled"><i
                                                                    class="fa fa-edit"></i>
                                                                <?php echo app('translator')->getFromJson('site.edit'); ?></a>
                                                        <?php endif; ?>
                                                    </li>
                                                    <li>
                                                        <a style="display: inline-block"
                                                            href="<?php echo e(route('dashboard.productLocations.index', [
    'product_id' => $product->id,
])); ?>"
                                                            class="danger btn-sm <?php echo e($productLocation_edit == 'close' ? 'hidden' : ''); ?>"><i
                                                                class="fa fa-cock"></i>
                                                            <?php echo e($product->productLocation->count()); ?>

                                                            <?php echo app('translator')->getFromJson('site.productLocations'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a style="display: inline-block"
                                                            href="<?php echo e(route('dashboard.instructions.index', [
    'product_id' => $product->id,
])); ?>"
                                                            class="danger btn-sm <?php echo e($section_edit == 'close' ? 'hidden' : ''); ?>"><i
                                                                class="fa fa-cock"></i>
                                                            <?php echo e($product->instructions->count()); ?>

                                                            <?php echo app('translator')->getFromJson('site.instructions'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a style="display: inline-block"
                                                            href="<?php echo e(route('dashboard.productWeights.index', ['search' => $product->id])); ?>"
                                                            class="warning btn-sm <?php echo e($section_edit == 'close' ? 'hidden' : ''); ?>"><i
                                                                class="fa fa-cock"></i>
                                                            <?php echo e($product->productWeights->count()); ?>

                                                            <?php echo app('translator')->getFromJson('site.productWeights'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(route('dashboard.additions.index', ['product_id' => $product->id])); ?>"
                                                            style="display: inline-block"
                                                            class="success btn-sm <?php echo e($section_edit == 'close' ? 'hidden' : ''); ?>">
                                                            <i class="fa fa-cock"></i>
                                                            <?php echo e($product->additions->count()); ?> additions
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <?php if(auth()->user()->hasPermission('delete_products')): ?>
                                                            <form
                                                                action="<?php echo e(route('dashboard.products.destroy', $product->id)); ?>"
                                                                method="post" style=" ">
                                                                <?php echo e(csrf_field()); ?>

                                                                <?php echo e(method_field('delete')); ?>

                                                                <button type="submit"
                                                                    class="btn-danger delete btn-sm <?php echo e($section_delete == 'close' ? 'hidden' : ''); ?>"><i
                                                                        class="fa fa-trash"></i> </button>
                                                            </form><!-- end of form -->
                                                        <?php else: ?>
                                                            <button class="danger btn-sm disabled"><i
                                                                    class="fa fa-trash"></i>
                                                                <?php echo app('translator')->getFromJson('site.delete'); ?></button>
                                                        <?php endif; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table><!-- end of table -->
                        <?php echo e($products->appends(request()->query())->links()); ?>

                    <?php else: ?>
                        <label for="" class="alert alert-danger col-xs-12 text-center"><?php echo app('translator')->getFromJson('site.no_data_found'); ?></label>
                    <?php endif; ?>
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>