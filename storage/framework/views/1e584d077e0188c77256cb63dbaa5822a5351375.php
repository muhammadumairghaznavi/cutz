<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(asset('dashboard/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> <?php echo e(auth()->user()->first_name .auth()->user()->last_name); ?> </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
        <li class=" <?php if($page =='dashboard'): ?>   active  <?php endif; ?> "><a href="<?php echo e(route('dashboard.index')); ?>"><i
        class="fa fa-th"></i><span><?php echo app('translator')->getFromJson('site.dashboard'); ?></span></a></li>
            <?php $__currentLoopData = getModels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->user()->hasPermission('read_'.$section)): ?>
            <li class=" <?php if($page ==$section): ?>   active  <?php endif; ?> "><a
                    href="<?php echo e(route('dashboard.'.$section.'.index')); ?>"><i
                        class="fa fa-th"></i><span><?php echo app('translator')->getFromJson('site.'.$section); ?></span></a></li>
                        
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        
        </ul>
    </section>
</aside>

