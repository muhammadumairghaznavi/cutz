<?php $__env->startSection('title_page'); ?>
<?php echo app('translator')->getFromJson('site.abouts'); ?>
<?php
$page='abouts';
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- START => Breadcrumb -->
<div class="breadcrumb-pages" style="background-image: url(<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-pages.jpg)">
    <strong class="h1 d-block"><?php echo app('translator')->getFromJson('site.abouts'); ?></strong>
    <ul>
        <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->getFromJson('site.home'); ?></a></li>
        <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
        <li><a href="<?php echo e(route('about')); ?>"><?php echo app('translator')->getFromJson('site.abouts'); ?></a></li>
    </ul>
</div>


<!-- //END => Breadcrumb -->
<!-- START => Page About Us -->
<section class="sec-about pt-5 pb-5">
    <div class="container">
        <div class="block-vision block-mission pt-3">
            <?php $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row   <?php echo e($key%2==0?' align-items-center py-3 ':'align-items-center py-3 flex-row-reverse'); ?>">
                <div class="col-md-6  wow   <?php echo e($key%2==0?' fadeInLeft ':'fadeInRight'); ?> ">
                    <div class="img-block">
                        <img src="<?php echo e($item->image_path); ?>" class="img-fluid" alt="<?php echo e($item->title); ?>">
                        <?php if($item->link): ?>
                        <a href="<?php echo e($item->link); ?>" class="btn-play-vid" data-fancybox>
                            <i class="fas fa-play"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 wow <?php echo e($key%2==0?'fadeInRight  ':'fadeInLeft'); ?> ">
                    <div class="txt text-center">
                       
                        <?php if($key==0): ?>
                        <strong class="h2 d-block font-weight-bold title_color">About CUT<span>Z</span></strong>
                        <?php else: ?>
                         <strong class="h2 d-block font-weight-bold"><?php echo e($item->title); ?></strong>
                        <?php endif; ?>
                        <p class="lead__txt">
                            <?php echo $item->description; ?>

                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mb-5">
            <?php if($setting->link_download): ?>
            <a href="<?php echo e($setting->link_download); ?>"  target="_blank" class="btn-menu"><i class="fas fa-lg fa-file-download mx-2"></i> <?php echo app('translator')->getFromJson('site.Download Menu'); ?> </a>
            <?php endif; ?>
        </div>
        <!-- <hr> -->
        <div class="clients-block pt-5">
            <div class="sec-title text-center mb-4">
                <strong class="title h1 d-block"><?php echo app('translator')->getFromJson('site.parteners'); ?></strong>
            </div>
            <div class="d-flex align-items-center justify-content-center flex-wrap">
                <?php $__currentLoopData = $parteners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="img-client">
                    <img src="<?php echo e($item->image_path); ?>" class="img-fluid" alt="<?php echo e($item->title); ?>">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<!-- //END => Page About Us -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>