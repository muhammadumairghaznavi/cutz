<?php $__env->startSection('title_page'); ?>
    <?php echo app('translator')->getFromJson('site.search'); ?>
    <?php
    $page = 'shop';
    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages" style="background-image: url(<?php echo e(url('/')); ?>/frontend/assets/imgs/bg-pages.jpg)">
        <strong class="h1 d-block"><?php echo app('translator')->getFromJson('site.search'); ?></strong>
        <ul>
            <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->getFromJson('site.home'); ?></a></li>
            <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
            <li><a href="<?php echo e(route('products')); ?>"><?php echo app('translator')->getFromJson('site.search'); ?></a></li>
        </ul>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => Page Shop -->
    <section class="page-shop py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <form action="<?php echo e(route('search')); ?>" method="GET">
                            <?php echo method_field("GET"); ?>
                            <?php echo csrf_field(); ?>
                            <aside class="aside-filter">
                                <div class="title-filter text-center">
                                    <strong class="h4 d-block m-0"><?php echo app('translator')->getFromJson('site.search'); ?></strong>
                                    <i class="fas fa-3x fa-times btn-close-filter"></i>
                                </div>
                                <article style="display: none">
                                    <h4><?php echo app('translator')->getFromJson('site.tags'); ?></h4>
                                    <div class="">
                                        <ul class=" d-flex
                                        align-content-center justify-content-center flex-wrap tags-names">
                                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="">
                                                <input type="
                                                checkbox" name="tag_arr[]" id="chk<?php echo e($item->id); ?>"
                                                <?php echo e(in_array($item->id, (array) request('tag_arr')) ? 'checked' : ''); ?>

                                                class="checkbox-customser" value="<?php echo e($item->id); ?>">
                                                <label for="chk<?php echo e($item->id); ?>" class="checkbox-labeler">
                                                    <span><?php echo e($item->title); ?></span>
                                                </label>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </article>
                                <hr class="my-0">

                                <article>
                                    <h4><?php echo app('translator')->getFromJson('site.categories'); ?></h4>
                                    <div class="scroll-y">
                                        <ul class="px-2">
                                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <strong class="btn_show_acc"><?php echo e($section->title); ?> <i
                                                            class="fa fa-plus"></i></strong>
                                                    <?php $__currentLoopData = $section->category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="desc2">
                                                            <a
                                                                href="<?php echo e(route('search', ['category_id' => $category->id])); ?>">
                                                                <strong class="btn_show_acc2">
                                                                    <?php echo e($category->title); ?>

                                                                </strong>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </article>
                                <article class="d-none">
                                    <h4><?php echo app('translator')->getFromJson('site.categories'); ?></h4>
                                    <div class="scroll-y">
                                        <ul class="px-2">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <strong class="btn_show_acc"><?php echo e($category->title); ?> <i
                                                            class="fa fa-plus"></i></strong>
                                                    <div class="desc2">
                                                        <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="subCategory_arr[]"
                                                                    <?php echo e(in_array($subCategory->id, (array) request('subCategory_arr')) ? 'checked' : ''); ?>

                                                                    value='<?php echo e($subCategory->id); ?>'
                                                                    id="customCheck<?php echo e($subCategory->id); ?>">
                                                                <label class="custom-control-label"
                                                                    for="customCheck<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->title); ?>

                                                                </label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </article>
                                <hr class="my-0">
                                <article style="display: none">
                                    <h4><?php echo app('translator')->getFromJson('site.price'); ?></h4>
                                    <div class="mt-4 px-2">
                                        <div id="Range_price" class="range-slider">
                                            <input value="<?php echo e($price_min); ?>" min="<?php echo e($price_min); ?>"
                                                max="<?php echo e($price_max); ?>" step="500" type="range" />
                                            <input value="<?php echo e($price_max); ?>" min="<?php echo e($price_min); ?>"
                                                max="<?php echo e($price_max); ?>" step="0" type="range" />
                                            <svg width="100%" height="24">
                                                <line x1="4" y1="0" x2="300" y2="0" stroke="#444" stroke-width="12"
                                                    stroke-dasharray="1 28"></line>
                                            </svg>
                                            <div>
                                                <span class="float-left">
                                                    <!-- <label>From : </label> -->
                                                    <input type="number" name="price_rang_min" value="<?php echo e($price_min); ?>"
                                                        min="<?php echo e($price_min); ?>" max="<?php echo e($price_max); ?>" />
                                                </span>
                                                <span class="float-right">
                                                    <!-- <label>To : </label> -->
                                                    <input type="number" name="price_rang_max" value="<?php echo e($price_max); ?>"
                                                        min="<?php echo e($price_min); ?>" max="<?php echo e($price_max); ?>" />
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <hr class="my-0">
                                <article style="display: none">
                                    <div class="sortby px-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="price_sort" value="price_HtoL"
                                                class="custom-control-input">
                                            <label class="custom-control-label"
                                                for="customRadio2"><?php echo app('translator')->getFromJson('site.price_HtoL'); ?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="price_sort" value="price_LtoH"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3"><?php echo app('translator')->getFromJson('site.price_LtoH'); ?>
                                            </label>
                                        </div>
                                    </div>
                                </article>

                            </aside>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="products-items pb-5">
                        <div class="row">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="item-product">
                                        <div class="img">
                                            <a
                                                href="<?php echo e(route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)])); ?>"><img
                                                    src="<?php echo e($item->image_path); ?>" class="img-fluid"
                                                    alt="<?php echo e($item->title); ?>"></a>
                                        </div>
                                        <a href="<?php echo e(route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)])); ?>"
                                            class="title"><?php echo e($item->title); ?></a>
                                        
                                        <h3 class="prices">
                                            <?php if($item->discount): ?>

                                                <span><?php echo e($item->discount); ?> <?php echo e(__('site.' . currncy())); ?></span>
                                                <label><del><?php echo e($item->MainPrice); ?></del></label>

                                            <?php else: ?>
                                            <span><?php echo e($item->MainPrice); ?> <?php echo e(__('site.' . currncy())); ?></span>
                                            <?php endif; ?>

                                        </h3>
                                        <div class="add-cart d-flex align-items-center justify-content-around">
                                            <a href="<?php echo e(route('product_details', ['id' => $item->id, 'slug' => make_slug($item->title)])); ?>"
                                                class="btn-add-cart"> <i class="fas fa-lg fa-cart-plus"></i></a>
                                            <a href="<?php echo e(route('customer.wishlist', ['product_id' => $item->id])); ?>"
                                                class="btn-add-cart"> <i class="far fa-lg fa-heart"></i></a>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div> <!-- //END row -->
                        <!-- Paginations -->
                        <div class="paginations mt-5">
                            <?php echo e($products->appends(request()->query())->links()); ?>

                        </div><!-- // Paginations -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //END => Page Shop -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>