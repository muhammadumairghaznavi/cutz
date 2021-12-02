<?php
$page="sliders";
$title=trans('site.sliders');
?>
<?php $__env->startSection('title_page'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo app('translator')->getFromJson('site.sliders'); ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->getFromJson('site.dashboard'); ?></a></li>
                <li><a href="<?php echo e(route('dashboard.sliders.index')); ?>"> <?php echo app('translator')->getFromJson('site.sliders'); ?></a></li>
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
                    <form action="<?php echo e(route('dashboard.sliders.update', $slider->id)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('put')); ?>

                        <?php $__currentLoopData = config('translatable.locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <span class="label label-warning  "><?php echo e($key+1); ?>  </span>
                                <label><?php echo app('translator')->getFromJson('site.' . $locale .'.title'); ?></label>
                                <input type="text" name="<?php echo e($locale); ?>[title]" class="form-control "  value="<?php echo e($slider->translate($locale)->title); ?>" id="">
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.' . $locale . '.title'); ?> 2 </label>
                                <input type="text" name="<?php echo e($locale); ?>[short_description]" class="form-control "  value="<?php echo e($slider->translate($locale)->short_description); ?>" id="">

                             </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->getFromJson('site.' . $locale . '.description'); ?></label>
                              <textarea     name="<?php echo e($locale); ?>[description]" id="" class="form-control "    cols="30" rows="5"><?php echo e($slider->translate($locale)->description); ?></textarea>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group">
                            <label><?php echo app('translator')->getFromJson('site.link'); ?></label>
                            <input type="text" name="link" class="form-control image" value="<?php echo e($slider->link); ?>">
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->getFromJson('site.image'); ?></label>
                            <input type="file" name="image" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="<?php echo e($slider->image_path); ?>" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> <?php echo app('translator')->getFromJson('site.edit'); ?></button>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>