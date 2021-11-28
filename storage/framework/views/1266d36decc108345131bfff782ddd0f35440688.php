<?php
if (authCustomer() != null) {
    $headerCarts = App\Cart::where('customer_id', authCustomer()->id)
        ->latest()
        ->get();
}
?>
<div class="right-header d-flex align-items-center">
    <div class="actions-mobile d-flex align-items-center">

        <div class="btn-login-downz">
            <a href="javascript:void(0)" class="d-flex align-items-center btnLogins"><i class="far fa-user mx-1"></i>
                <i class="fa fa-chevron-down"></i> </a>
            <ul class="menu-logins">
                <?php if(auth()->guard('customer')->check()): ?>

                    <li class="a-d"> <a href="<?php echo e(route('customer.profile.index')); ?>"><i
                                class="fa fa-user"></i><?php echo app('translator')->getFromJson('site.profile'); ?></a></li>
                    <li class="a-d"><a href="<?php echo e(route('customer.cart.index')); ?>"> <i
                                class="fas fa-shopping-cart"></i><?php echo app('translator')->getFromJson('site.cart'); ?></a>
                    </li>
                    <li class="a-d"><a href="<?php echo e(route('customer.profile.orders')); ?>"> <i
                                class="fas fa-clipboard-list"></i><?php echo app('translator')->getFromJson('site.orders'); ?></a></li>
                    <li class="a-d"><a href="<?php echo e(route('customer.wishlist.index')); ?>"> <i
                                class="fas fa-heart"></i><?php echo app('translator')->getFromJson('site.wishlist'); ?></a>
                    </li>
                    <li class="a-d"><a href="<?php echo e(route('customer.profile.logout')); ?>"> <i
                                class="fas fa-sign-out-alt"></i><?php echo app('translator')->getFromJson('site.Logout'); ?> </a>
                    </li>
                <?php else: ?>
                    <li class="btn-logins"><a href="<?php echo e(route('customer.login')); ?>"><?php echo app('translator')->getFromJson('site.login'); ?></a></li>
                    <li class="hr-or"><?php echo app('translator')->getFromJson('site.or'); ?></li>
                    <li class="btn-newaccount"><a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->getFromJson('site.Create an Account'); ?></a></li>
                <?php endif; ?>

            </ul>
        </div>

        <div class="block-cart">
            <?php if(auth()->guard('customer')->check()): ?>
                <a href="javascript:void(0)" class="cartsho-link"><i class="fas fa-shopping-cart"></i> <span
                        class="num-count"><?php echo e(count($headerCarts)); ?> </span></a>
                <div class="menu-cart">
                    <div class="title d-flex align-items-center justify-content-between">
                        <strong><?php echo app('translator')->getFromJson('site.My Cart'); ?></strong>
                        <a href="<?php echo e(route('customer.cart.index')); ?>" class="num-added" title=""><i
                                class="fas fa-cart-arrow-down"></i>
                            (<?php echo e(count($headerCarts)); ?>)</a>
                    </div>
                    <ul class="">
                        <li class=" scroll-y">
                        <?php
                            $sumCartAndDetail = 0;
                        ?>
                        <?php $__currentLoopData = $headerCarts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            <?php
                                $product = \App\Product::find($cart->product_id);
                            ?>
                            <?php if(!$product): ?>
                                <?php $cart->delete() ?>
                                <?php continue; ?>
                            <?php endif; ?>

                            <div class="item">
                                <div class="img">
                                    <img src="<?php echo e($cart->product->image_path); ?>" class="img-fluid" alt="">
                                </div>
                                <div class="txt">
                                    <a
                                        href="<?php echo e(route('product_details', ['id' => $cart->product->id, 'slug' => make_slug($cart->product->title)])); ?>"><?php echo e($cart->product->title); ?></a>
                                    
                                    
                                    <?php if($cart->productWeight_id): ?>
                                        <p class="qty"> <?php echo app('translator')->getFromJson('site.weights'); ?> =
                                            <?php echo e($cart->productWeight->weight->title); ?> </p>
                                        <p class="qty"> <?php echo app('translator')->getFromJson('site.price'); ?>
                                            = <?php echo e($cart->productWeight->price); ?>

                                        </p>
                                        <p class="qty"> <?php echo app('translator')->getFromJson('site.quantity'); ?> = <?php echo e($cart->qty); ?> </p>
                                        <p class="price">
                                            <?php echo e((int) $cart->productWeight->price * (int) $cart->qty); ?><?php echo e(__('site.' . currncy())); ?>

                                        </p>

                                    <?php else: ?>
                                        <?php echo e($cart->type == 'per_unit' ? 'Per Unit' : ''); ?>

                                        <p class="qty"> <?php echo app('translator')->getFromJson('site.price'); ?>
                                            =
                                            <?php if($cart->product->discount): ?>
                                                <?php echo e($cart->product->discount); ?>


                                            <?php else: ?>
                                                <?php echo e($cart->product->price); ?>

                                            <?php endif; ?>

                                        </p>
                                        <p class="qty"> <?php echo app('translator')->getFromJson('site.quantity'); ?> = <?php echo e($cart->qty); ?> </p>
                                        <p class="price">
                                            <?php echo e($cart->product->discount ? (int) $cart->product->discount * (int) $cart->qty : (int) $cart->product->price * (int) $cart->qty); ?><?php echo e(__('site.' . currncy())); ?>

                                        </p>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $cart->cart_detials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_detial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <strong> <?php echo e($cart_detial->addtion->title); ?></strong> +
                                        
                                        
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                </div>
                                <a href="<?php echo e(route('customer.cart.delete', ['id' => $cart->id])); ?>"
                                    class="mr-3"><i class="far fa-trash-alt del-item"></i> </a>
                            </div>
                            <?php
                                $sumCartAndDetail += $cart->SumCartWithCartDetails;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </li>
                        <li class="total d-flex align-items-center justify-content-between">
                            <strong><?php echo app('translator')->getFromJson('site.total'); ?></strong>

                            <strong class="price-total"><?php echo e($sumCartAndDetail); ?><?php echo e(__('site.' . currncy())); ?>

                            </strong>
                        </li>
                    </ul>
                    <a href="<?php echo e(route('customer.checkout.index')); ?>" class="title text-center"> <?php echo app('translator')->getFromJson('site.checkout'); ?>
                    </a>
                </div>
            <?php else: ?>
                <a href="javascript:void(0)" class="cartsho-link"><i class="fas fa-shopping-cart"></i> <span
                        class="num-count">0</span></a>
            <?php endif; ?>
        </div>

        <div>
            <a href="javascript:void(0)" class="searchs-link"><i class="fas fa-search"></i></a>
            <div class="form-search-header">
                <form action="<?php echo e(route('search')); ?>" method="GET">
                    <strong class="mb-3 h2 d-block"><?php echo app('translator')->getFromJson('site.search'); ?></strong>
                    <?php echo csrf_field(); ?>
                    <div class="form-group m-0">
                        <input type="text" class="" id=" IDSearch" name="keyword" required="required"
                            placeholder="<?php echo app('translator')->getFromJson('site.search'); ?> ...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <div id="searchList"></div>
                <i class="fas fa-times close-search"></i>
            </div>
        </div>

        <div class="langs">
            <?php if(LaravelLocalization::getCurrentLocale() == 'ar'): ?>
                <a rel="alternate" class="langs" hreflang="ar" data-toggle="tooltip" data-placement="bottom"
                    title="English" href="<?php echo e(LaravelLocalization::getLocalizedURL('en', null, [], true)); ?>">
                    <i class="fa fa-globe"><?php echo app('translator')->getFromJson('site.english'); ?></i></a>
            <?php elseif(LaravelLocalization::getCurrentLocale()=='en'): ?>
                <a rel="alternate " class="langs" hreflang="ar" data-toggle="tooltip" data-placement="bottom"
                    title="" href="<?php echo e(LaravelLocalization::getLocalizedURL('ar', null, [], true)); ?>">
                    <i class="fa fa-globe"><?php echo app('translator')->getFromJson('site.arabic'); ?></i> </a>
            <?php endif; ?>
        </div>

    </div>


    <!-- Toggle Menu In Mobile -->
    <i class="fas fa-2x fa-bars toggle-menu"></i>
</div>
