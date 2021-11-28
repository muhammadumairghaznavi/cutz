<?php $__env->startSection('title_page'); ?>
    <?php echo app('translator')->getFromJson('site.home'); ?>
    <?php
    $page = 'home';
    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(isset($message)): ?>
        <div class="alert alert-success">
            <strong><?php echo e(@message); ?></strong>
        </div>
        <?php endif; ?>
        <!-- START => Home Slider -->
        <section class="sec-slider">
            <div class="container-fluid"
                style="padding-right: 0px; padding-left: 0px; padding-bottom: 0px; padding-top: 0px; margin-right: 0px; margin-left: 0px; margin-top: 0px; margin-bottom: -10px;">
                <video autoplay muted playsinline loop
                    style="pointer-events: none;  height: 100%; width:100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <source src="<?php echo e('livevideo.mp4'); ?>" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video>

            </div>
        </section>
        <!-- //END => Home Slider -->

        <?php if($setting->link_youtube): ?>
            <!-- START => BG Parallax -->
            <div class="bg-customize parallax-window-one" data-parallax="scroll"
                data-image-src="<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-after-slider-2.jpg">
                <a href="<?php echo e($setting->link_youtube); ?>" class="btn-play-vid" data-fancybox>
                    <i class="fas fa-play"></i>
                </a>
            </div>
            <!-- //END => BG Parallax -->
        <?php endif; ?>


        <!-- START => Meat packaged -->

        </div>
        </section>
        <a href="search?section_id=11">
            <section class="sec-meat-packaged parallax-window-two"
                style="background-image:url('<?php echo e(url('/')); ?>/frontend/assets/imgs/meatbg.png')">

            </section>
        </a>
        <!-- //END => Meat packaged -->
        <?php if(count($bestSellers) > 0): ?>
            <section class="sec-related sec_seller_bg py-5">
                <div class="container">
                    <div class="sec-title text-left mb-4">
                        <strong class="title h3 d-block"><?php echo app('translator')->getFromJson('site.Our Best Sellers'); ?></strong>
                    </div>

                    <div class="slides-related owl-carousel owl-theme">
                        <?php $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item-product">
                                <div class="img">
                                    <a
                                        href="<?php echo e(route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)])); ?>"><img
                                            src="<?php echo e($item->image_path); ?>" class="img-fluid"
                                            alt="<?php echo e($item->title); ?>"></a>
                                </div>
                                <a href="<?php echo e(route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)])); ?>"
                                    class="title"><?php echo e($item->title); ?></a>
                                <div class="rating">
                                    <?php for($star = 1; $star <= $item->AvgRate; $star++): ?>
                                        <i class="fas fa-sm fa-star active"></i>
                                    <?php endfor; ?>
                                    <?php for($star_off = $item->AvgRate; $star_off < 5; $star_off++): ?> <i
                                            class="fas fa-sm fa-star"></i>
                                    <?php endfor; ?>
                                    <span>(<?php echo e($item->rates->count()); ?> <?php echo app('translator')->getFromJson('site.rates'); ?>)</span>
                                </div>
                                <h3 class="prices">
                                    <span><?php echo e($item->total); ?> <?php echo e(__('site.' . currncy())); ?></span>
                                    <?php if($item->discount): ?>
                                        <del><?php echo e($item->MainPrice); ?></del>
                                    <?php endif; ?>
                                </h3>
                                <div class="add-cart d-flex align-items-center justify-content-around">
                                    <a href="<?php echo e(route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)])); ?>"
                                        class="btn-add-cart"> <i class="fas fa-lg fa-cart-plus"></i></a>
                                    <a href="<?php echo e(route('customer.wishlist', ['product_id' => $item->id])); ?>"
                                        class="btn-add-cart">
                                        <i class="far fa-lg fa-heart"></i></a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                    </div>

                </div>
            </section>
        <?php endif; ?>



        <!-- START => Poultry is packaged -->
        <a href="">
            <section class="sec-poultry-packaged parallax-window-two"
                style="background-image:url('<?php echo e(url('/')); ?>/frontend/assets/imgs/Poultry.png')">

            </section>
        </a>
        <!-- //END => Poultry is packaged -->



        <!-- START => Seafood packaged -->


        <a href="">
            <section class="sec-seafood-packaged parallax-window-two"
                style="background-image:url('<?php echo e(url('/')); ?>/frontend/assets/imgs/seafoodbg.png')">

            </section>
        </a>
        <!-- //END => Seafood packaged -->
        <section class="sec-care-customers parallax-window-two" data-speed=".2" data-parallax="scroll"
            data-image-src="<?php echo e(url('/')); ?>/frontend/assets/imgs/ourclientsays.jpeg"
            style="background-size: cover; display: grid; align-items: center; justify-content: center; height: 100vh;">

            <div class="txt text-center">
                <strong class="title h1 d-block"><?php echo app('translator')->getFromJson('site.our_client_say'); ?></strong>
            </div>
            <div class="container"
                style="box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); border-radius: 5px; background-color: rgba(255, 255, 255, .15); backdrop-filter: blur(5px);">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                                <div class="carousel-caption">


                                    <h5 class="txt">“<?php echo e($slider->comment); ?>”</h5>

                                    <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="fa-stack" style="width:1em; color:rgb(173 30 49)">
                                            <i class="far fa-star fa-stack-1x"></i>

                                            <?php if($slider->review > 0): ?>
                                                <?php if($slider->review > 0.5): ?>
                                                    <i class="fas fa-star fa-stack-1x" style="color:rgb(173 30 49)"></i>
                                                <?php else: ?>
                                                    <i class="fas fa-star-half fa-stack-1x" style="color:rgb(173 30 49)"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php $slider->review--; ?>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <br>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div> <a class="carousel-control-prev" href="#demo" data-slide="prev"> <i class='fas fa-arrow-left'></i>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next"> <i class='fas fa-arrow-right'></i> </a>
                </div>
            </div>
            <div class="txt text-center">
                <a href="<?php echo e(url('reviews_page')); ?>" class="btn btn-primary"><?php echo app('translator')->getFromJson('site.View_All'); ?></a>

            </div>
        </section>

        <!-- START => Categories Site -->
        <section class="sec-catgs-sites parallax-window-two" data-speed=".2" data-parallax="scroll"
            data-image-src="<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-catgs.jpg">
            <div class="container">
                <div class="row align-items-center align-content-center text-center hvh-100">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-4 col-6">
                            
                            <a href="<?php echo e(route('search', ['category_id' => $item->id])); ?>" class="catgss-item">
                                <div class="img">
                                    <img src="<?php echo e($item->image_path); ?>" alt="">
                                </div>
                                <strong class="h5"><?php echo e($item->title); ?></strong>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- //END => Categories Site -->


        <!-- START => Care for our Customers -->
        <section class="sec-care-customers parallax-window-two" data-speed=".2" data-parallax="scroll"
            data-image-src="<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-care-customer.jpg">
            <div class="container-fluid d-flex justify-content-center align-items-center hvh-100">
                <div class="txt text-center">
                    <strong class="title h1 d-block"><?php echo app('translator')->getFromJson('site.Our_Specialty'); ?></strong>
                    <div class="care-icons d-flex align-items-center justify-content-between">
                        <div class="text-center">



                            <!--<a href="<?php echo e(route('page', ['type' => 'greenFeed'])); ?>">-->
                            <strong>
                                <i class="icon-lamb"></i>
                                <strong><?php echo app('translator')->getFromJson('site.greenFeed'); ?></strong>
                            </strong>
                        </div>
                        <div class="text-center">

                            <!--<a href="<?php echo e(route('page', ['type' => 'convenientVacuum'])); ?>">-->
                            <strong>
                                <i class="icon-box"></i>
                                <strong><?php echo app('translator')->getFromJson('site.convenientVacuum'); ?></strong>
                            </strong>
                        </div>
                        <div class="text-center">

                            <a href="<?php echo e(route('page', ['type' => 'internationalQualityCertificates'])); ?>">

                                <i class="icon-certification"></i>
                                <strong><?php echo app('translator')->getFromJson('site.internationalQualityCertificates'); ?></strong>
                            </a>
                        </div>
                        <div class="text-center">
                            <!--<a href="<?php echo e(route('page', ['type' => 'professionalCutting'])); ?>">-->
                            <strong>
                                <i class="icon-cleaver-knife"></i>
                                <strong><?php echo app('translator')->getFromJson('site.professionalcutty'); ?></strong>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //END => Care for our Customers -->



    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>