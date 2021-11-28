<?php $__env->startSection('title_page'); ?>
    <?php echo e($product->title); ?>

    <?php
    $page = '';
    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages" style="background-image: url(<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block"><?php echo e($product->title); ?></strong>
        <ul>
            <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->getFromJson('site.home'); ?></a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href=""> <?php echo e($product->section->title ?? 'لا يوجد'); ?> </a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href=""> <?php echo e($product->category->title ?? 'لا يوجد'); ?> </a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href=""> <?php echo e($product->subCategory->title ?? 'لا يوجد'); ?> </a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a><?php echo e($product->title); ?></a></li>
        </ul>
    </div>
    <!-- //END => Breadcrumb -->


    <!-- START => Page Single -->
    <section class="page-single py-5">
        <div class="container">
            <div class="product-single">
                <div class="row">
                    <div class="col-md-5">
                        <div class="slides-images">
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <!--<div class="swiper-slide">-->
                                    <!--     <a data-fancybox="gallery" href="<?php echo e($product->image_path); ?>"-->
                                    <!--         data-caption="<?php echo e($product->title); ?>">-->
                                    <!--         <img src="<?php echo e($product->image_path); ?>" class="img-fluid" alt="<?php echo e($product->title); ?>">-->
                                    <!--     </a>-->
                                    <!-- </div>-->
                                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="swiper-slide">
                                            <a data-fancybox="gallery" href="<?php echo e($item->image_path); ?>"
                                                data-caption="<?php echo e($product->title); ?>">
                                                <img src="<?php echo e($item->image_path); ?>" class="img-fluid"
                                                    alt="<?php echo e($product->title); ?>">
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <!-- Add Arrows -->
                                <?php if(count($product->images) > 0): ?>

                                    <div class="swiper-button-next swiper-button-white"></div>
                                    <div class="swiper-button-prev swiper-button-white"></div>
                                <?php endif; ?>
                            </div>

                            <?php if(count($product->images) > 0): ?>


                                <div class="swiper-container gallery-thumbs">
                                    <div class="swiper-wrapper">
                                        <!-- <div class="swiper-slide">-->
                                        <!--    <img src="<?php echo e($product->image_path); ?>" class="img-fluid" alt="<?php echo e($product->title); ?>">-->
                                        <!--</div>-->

                                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="swiper-slide">
                                                <img src="<?php echo e($item->image_path); ?>" class="img-fluid"
                                                    alt="<?php echo e($product->title); ?>">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <?php if(session('success')): ?>
                            <div class="alert alert-success text-center" role="alert">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="product-details py-3 px-2">
                            <div class="title-prod">
                                <strong class="h4 mb-4 d-block"><?php echo e($product->title); ?> </strong>

                                <div class="my-3">


                                    <?php if($product->provenance_id): ?>
                                        <strong class="bbq city-created"><img
                                                src="<?php echo e($product->provenance->image_path); ?>" alt="">
                                            <span><?php echo e($product->provenance->title ?? ''); ?></span></strong>
                                    <?php endif; ?>
                                    <?php if($product->falg == 'yes'): ?>
                                        <strong class="bbq"><img
                                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/icons/grill.png" alt="">
                                            <span><?php echo app('translator')->getFromJson('site.BBQ'); ?></span></strong>
                                    <?php endif; ?>
                                    <?php if($product->chilies == 'yes'): ?>
                                        <strong class="bbq"><img
                                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/icons/chilled.png" alt="">
                                            <span><?php echo app('translator')->getFromJson('site.chilled'); ?></span></strong>
                                    <?php endif; ?>
                                    <?php if($product->hermonFree == 'yes'): ?>
                                        <strong class="bbq"><img
                                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/icons/healthy.png" alt="">
                                            <span><?php echo app('translator')->getFromJson('site.hermonFree'); ?></span></strong>
                                    <?php endif; ?>
                                    <?php if($product->panSearing == 'yes'): ?>
                                        <strong class="bbq"><img
                                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/icons/panseearing.png"
                                                alt="">
                                            <span><?php echo app('translator')->getFromJson('site.panSearing'); ?></span></strong>
                                    <?php endif; ?>
                                    <?php if($product->frozen == 'yes'): ?>
                                        <strong class="bbq"><img
                                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/icons/frozen.png" alt="">
                                            <span><?php echo app('translator')->getFromJson('site.frozen'); ?></span></strong>
                                    <?php endif; ?>
                                    <?php if($product->roasting == 'yes'): ?>
                                        <strong class="bbq"><img
                                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/icons/roasting.png" alt="">
                                            <span><?php echo app('translator')->getFromJson('site.roasting'); ?></span></strong>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h3 class="prices">
                                
                                <?php if($product->measr_unit == 'per_unit'): ?>


                                    <?php if($product->discount): ?>
                                        <span><?php echo e($product->discount); ?> <?php echo app('translator')->getFromJson('site.pound'); ?></span>
                                        <del><?php echo e($product->MainPrice); ?></del>
                                    <?php else: ?>
                                        <span><?php echo e($product->MainPrice); ?> <?php echo app('translator')->getFromJson('site.pound'); ?></span>
                                    <?php endif; ?>
                                <?php elseif($product->measr_unit == 'byKilogram' || $product->measr_unit == 'byGram'): ?>
                                    <span id="toPrice">Please Select Weight </span>
                                <?php endif; ?>



                            </h3>


                            <div class="d-flex justify-content-between align-items-center">

                                <strong class="h6 d-block">
                                    <?php if($product->measr_unit == 'per_unit'): ?>
                                        <?php echo e(['ar' => 'بالوحدة', 'en' => 'Per unit'][app()->getLocale()]); ?>

                                    <?php else: ?>
                                        <?php echo app('translator')->getFromJson('site.weights'); ?> : <label for="" id="toWeight">
                                            
                                        </label>


                                    <?php endif; ?>
                                </strong>
                                <?php if($product->serve_number > 1): ?>
                                    <strong class="h6 d-block"> <?php echo app('translator')->getFromJson('site.serve_number'); ?> :
                                        <?php echo e($product->serve_number); ?>

                                        <?php echo app('translator')->getFromJson('site.Individuals'); ?> </strong>
                                <?php endif; ?>
                                <!-- Add Class Active if added to wishlist-->
                                <a href="<?php echo e(route('customer.wishlist', ['product_id' => $product->id])); ?>"
                                    class="btn-add-cart add-wishlist">
                                    <i class="far fa-lg fa-heart"></i>
                                    <?php echo app('translator')->getFromJson('site.Add To Wishlist'); ?>
                                </a>
                            </div>
                            <hr>
                        </div>
                        <div class="page-add-cart">
                            <form action="<?php echo e(route('customer.cart.add')); ?>" method="POST">
                                
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" id="">
                                <div class="row no-gutters">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="add-addition px-4">
                                                <?php $__currentLoopData = $product->additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                                        <strong class="mr-3"><?php echo e($addition->Title); ?> <span>
                                                                <?php echo e($addition->Total); ?>

                                                                <?php echo e(__('site.' . currncy())); ?> </span>
                                                        </strong>
                                                        <div class="switch_box box_1">
                                                            <input type="checkbox" name="addition_id[]"
                                                                value="<?php echo e($addition->id); ?>" class="switch_1">
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div
                                        class="col-md-12 flex-column-xs in-mobile d-flex align-items-center justify-content-around">

                                        <?php if(count($product->productWeights) > 0): ?>
                                            <label for="" class="priceset"></label>
                                            <div class="w-50 d-flex align-items-center">
                                                <select id="selectElementID" onchange="changeSelect()"
                                                    name="productWeight_id" class="w-50" required>
                                                    <option value=""><?php echo app('translator')->getFromJson('site.weights'); ?></option>
                                                    <?php $__currentLoopData = $product->productWeights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productWeight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        

                                                        <option value="<?php echo e($productWeight->id); ?>">
                                                            <?php echo e($productWeight->weight->title); ?>

                                                            = <?php echo e($productWeight->price); ?>

                                                            <?php echo e(__('site.' . currncy())); ?>

                                                            <label style="font-size:11px;"></label>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        <?php endif; ?>


                                        <div class="min-add-button d-flex align-items-center">
                                            <strong class="h5 d-inline-block mr-3"><?php echo app('translator')->getFromJson('site.quantity'); ?>: </strong>
                                            <a href="#" class="input-group-addon minus increment sub"><i
                                                    class="fas fa-arrow-down" aria-hidden="true"></i></a>
                                            <input type="text" min="1" name="qty" class="adults" size="10"
                                                value="1">
                                            <a href="#" class="input-group-addon plus increment add"><i
                                                    class="fas fa-arrow-up" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-add-cart mt-4 mx-3"> <i
                                            class="fas fa-lg fa-cart-plus"></i> <?php echo app('translator')->getFromJson('site.add to cart'); ?></button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Description -->
                <div class="product-desc pt-4">
                    <ul class="nav nav-tabs justify-content-around" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link title active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true"><?php echo app('translator')->getFromJson('site.description'); ?></a>
                        </li>
                        <?php if(count($product->instructions) > 0): ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link title" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false"> <?php echo app('translator')->getFromJson('site.HowToCock'); ?>
                                    (<?php echo e($product->instructions->count()); ?>)</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="txt">
                                <strong><?php echo app('translator')->getFromJson('site.description'); ?></strong>
                                <p class="lead__txt">
                                    <?php echo $product->description; ?>

                                </p>


                                <?php if($product->nutritionFact !== 'default.png'): ?>
                                    <div class="text-center">
                                        <img src="<?php echo e($product->image_nutrition); ?>" class="img-thumbnail image-preview4"
                                            alt="Default Image">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if($product->frozenInstructions): ?>
                                <div class="txt">
                                    <strong><?php echo app('translator')->getFromJson('site.frozenInstructions'); ?></strong>
                                    <p class="lead__txt">
                                        <?php echo $product->frozenInstructions; ?>

                                    </p>
                                </div>
                            <?php endif; ?>

                            <?php if($product->provenance_id): ?>
                                <div class="txt">
                                    <strong><?php echo app('translator')->getFromJson('site.provenances'); ?></strong>
                                    <p class="lead__txt"> <?php echo $product->provenance->title ?? ''; ?>


                                    </p>
                                    <?php if(app()->getLocale() == 'ar'): ?>
                                        <p class="lead__txt"> <?php echo $provenanceCategory->description_ar ?? ''; ?> </p>
                                    <?php else: ?>
                                        <p class="lead__txt"> <?php echo $provenanceCategory->description_en ?? ''; ?> </p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if($product->expiration): ?>
                                <div class="txt">
                                    <strong><?php echo app('translator')->getFromJson('site.expiration'); ?></strong>
                                    <p class="lead__txt"> <?php echo $product->expiration; ?> </p>

                                </div>
                            <?php endif; ?>


                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="items p-4">
                                <?php if($product->instructions->count() > 0): ?>
                                    <h2 class="mb-4"><?php echo app('translator')->getFromJson('site.HowToCock'); ?> </h2>
                                    <hr>
                                    <?php $__currentLoopData = $product->instructions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <h3 class="btn_show_acc"><?php echo e($item->title); ?> <i class="fa fa-plus"></i>
                                            </h3>
                                            <div class="desc">
                                                <p class="lead__txt">
                                                    <?php echo $item->description; ?>

                                                </p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <script>
            function changeSelect() {
                var e = document.getElementById("selectElementID");
                var value = e.options[e.selectedIndex].value; // get selected option value
                var text = e.options[e.selectedIndex].text;

                if (text == "weight") {
                    $('#toPrice').html("Please Select Weight");
                    $('#toWeight').html("");
                } else {
                    var textArr = text.split(' ');

                    //textArr[0] = weight in number;
                    //textArr[1] = string unit eg: Kilogram, gram;
                    //textArr[2] = return '=' string;
                    //textArr[3] = price;
                    //textArr[4] = price unit;
                    // textArr[5] = discount;

                    console.log(textArr[3] + textArr[5]);


                    $('#toPrice').html(textArr[3] + ' ' + textArr[4]);
                    $('#toWeight').html(textArr[0] + ' ' + textArr[1]);

                    // $('#todiscountPrice').html(Number(textArr[3])+Number(textArr[5]));
                }
            }
        </script>
    </section>
    <!-- //END => Page Single -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>