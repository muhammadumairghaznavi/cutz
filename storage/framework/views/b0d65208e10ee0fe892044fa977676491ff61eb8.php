<?php
$page="categories";
$title=trans('site.categories');
// to hide any section please type -> close
$section_search=' ';
$section_add=' ';
$section_edit=' ';
$section_delete=' ';
?>
<?php $__env->startSection('title_page'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo app('translator')->getFromJson('site.categories'); ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->getFromJson('site.dashboard'); ?></a>
            </li>
            <li class="active"><?php echo app('translator')->getFromJson('site.categories'); ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px"><?php echo app('translator')->getFromJson('site.categories'); ?>
                    <small>
                        <?php echo app('translator')->getFromJson('site.total_search'); ?>
                        ( <?php echo e($categories->count()); ?> )
                    </small></h3>
                <form action="<?php echo e(route('dashboard.categories.index')); ?>" method="get">
                    <div class="row">
                        <div class="<?php echo e($section_search=='close'?'hidden':''); ?>">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="<?php echo app('translator')->getFromJson('site.search'); ?>"
                                    value="<?php echo e(request()->search); ?>">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    <?php echo app('translator')->getFromJson('site.search'); ?></button>
                            </div>
                        </div>
                        <div class="col-md-4 <?php echo e($section_add=='close'?'hidden':''); ?>">
                            <?php if(auth()->user()->hasPermission('create_categories')): ?>
                            <a href="<?php echo e(route('dashboard.categories.create')); ?>" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('site.add'); ?></a>
                            <?php else: ?>
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                <?php echo app('translator')->getFromJson('site.add'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                <?php if($categories->count() > 0): ?>
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th> </th>
                            <th><?php echo app('translator')->getFromJson('site.sections'); ?></th>
                            <th><?php echo app('translator')->getFromJson('site.name'); ?></th>
                            
                            <th><?php echo app('translator')->getFromJson('site.image'); ?></th>
                            <th>sort</th>
                            <th><?php echo app('translator')->getFromJson('site.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td> <?php echo e($category->section->title??""); ?></td>
                            <td> <?php echo e($category->title); ?></td>
                            
                            <td><img src="<?php echo e($category->image_path); ?>" style="width: 100px;" class="img-thumbnail" alt="">
                            </td>
                             <td> <?php echo e($category->sort); ?></td>                    

                            <td>
                                <?php if(auth()->user()->hasPermission('update_categories')): ?>
                                    <a href="<?php echo e(route('dashboard.categories.duplicate', $category->id)); ?>"
                                    class="btn btn-warning btn-sm <?php echo e($section_edit=='close'?'hidden':''); ?>"><i
                                        class="fa fa-copy"></i> <?php echo app('translator')->getFromJson('site.duplicate'); ?></a>

                                <a href="<?php echo e(route('dashboard.categories.edit', $category->id)); ?>"
                                    class="btn btn-info btn-sm <?php echo e($section_edit=='close'?'hidden':''); ?>"><i
                                        class="fa fa-edit"></i> <?php echo app('translator')->getFromJson('site.edit'); ?></a>
                                <?php else: ?>
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    <?php echo app('translator')->getFromJson('site.edit'); ?></a>
                                <?php endif; ?>
                                <?php if(auth()->user()->hasPermission('delete_categories')): ?>
                                <form action="<?php echo e(route('dashboard.categories.destroy', $category->id)); ?>" method="post"
                                    style="display: inline-block">
                                    <?php echo e(csrf_field()); ?>

                                    <?php echo e(method_field('delete')); ?>

                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm <?php echo e($section_delete=='close'?'hidden':''); ?>"><i
                                            class="fa fa-trash"></i> <?php echo app('translator')->getFromJson('site.delete'); ?></button>
                                </form><!-- end of form -->
                                <?php else: ?>
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    <?php echo app('translator')->getFromJson('site.delete'); ?></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table><!-- end of table -->

                <?php else: ?>
                <label for="" class="alert alert-danger col-xs-12 text-center"><?php echo app('translator')->getFromJson('site.no_data_found'); ?></label>
                <?php endif; ?>
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>