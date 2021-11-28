<?php $__env->startSection('title_page'); ?>
    <?php echo app('translator')->getFromJson('site.Reviews Page'); ?>
    <?php
    $page = 'reviews_page';
    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages"
        style="background-image: url(<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block"><?php echo app('translator')->getFromJson('site.Reviews Page'); ?></strong>
        <ul>
            <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->getFromJson('site.home'); ?></a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href="<?php echo e(url($page)); ?>"><?php echo app('translator')->getFromJson('site.Reviews Page'); ?></a></li>
        </ul>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => Page Shop -->
    <section class="page-shop py-5">
        <div class="container">
            <div class="txt text-center">
                <strong class="title h1 d-block">Our Clients Say</strong>
            </div>
            <div class="row">

                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4" style="margin-bottom: 15px;">
                        <div class="card" style="min-height: 344px">
                            <div class="card-body">
                                <h4 class="card-title"><img
                                        src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png">
                                </h4>
                                <div class="template-demo">
                                    <p><?php echo e($item->comment); ?></p>
                                </div>
                                <hr>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-2"> <img class="profile-pic"
                                            src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>
                                    <div class="col-sm-10">
                                        <div class="profile">

                                            <p class="cust-profession">

                                                <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="fa-stack" style="width:1em; color:rgb(223, 56, 89)">
                                                        <i class="far fa-star fa-stack-1x"></i>

                                                        <?php if($item->review > 0): ?>
                                                            <?php if($item->review > 0.5): ?>
                                                                <i class="fas fa-star fa-stack-1x"
                                                                    style="color:rgb(223, 56, 89)"></i>
                                                            <?php else: ?>
                                                                <i class="fas fa-star-half fa-stack-1x"
                                                                    style="color:rgb(223, 56, 89)"></i>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php $item->review--; ?>
                                                    </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
            <div class="paginations mt-5">
                <?php echo e($reviews->appends(request()->query())->links()); ?>

            </div>


    </section>
    <!-- //END => Page Shop -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>