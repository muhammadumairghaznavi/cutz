<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?php echo e($setting->image_icon); ?>" type="image/x-icon">
    
    <title> <?php echo $__env->yieldContent('title_page'); ?> | <?php echo e($setting->seo_title); ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('des_seo'); ?><?php echo e($setting->seo_des); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('key_seo'); ?><?php echo e($setting->seo_key); ?>">
    <meta name="author" content="<?php echo e($setting->seo_title); ?>">
    
    <meta property="og:image" content="<?php echo $__env->yieldContent('image_url_share'); ?>" />
    <meta property="og:title" content="<?php echo $__env->yieldContent('title_share'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description_share'); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website" />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/fonts/fontello-icons.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/libs/animate/animate.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/libs/selectric/selectric.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/libs/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/libs/owl.carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/libs/swipper/swiper.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/libs/popup/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/css/main.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/plugins/noty/noty.css')); ?>">
    <script src="<?php echo e(asset('dashboard/plugins/noty/noty.min.js')); ?>"></script>
    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/css/ar.css">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/css/responsive.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/css/darkmode.css">


    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        #demo {
            /* background: linear-gradient(112deg, #ffffff 50%, antiquewhite 50%); */
            max-width: 900px;
            margin: auto
        }

        .carousel-caption {
            position: initial;
            z-index: 10;
            padding: 5rem 8rem;
            color: rgba(78, 77, 77, 0.856);
            text-align: center;
            font-size: 1.2rem;
            font-style: italic;
            font-weight: bold;
            line-height: 2rem
        }

        @media(max-width:767px) {
            .carousel-caption {
                position: initial;
                z-index: 10;
                padding: 3rem 2rem;
                color: rgba(78, 77, 77, 0.856);
                text-align: center;
                font-size: 0.7rem;
                font-style: italic;
                font-weight: bold;
                line-height: 1.5rem
            }
        }

        .carousel-caption img {
            width: 6rem;
            border-radius: 5rem;
            margin-top: 2rem
        }

        @media(max-width:767px) {
            .carousel-caption img {
                width: 4rem;
                border-radius: 4rem;
                margin-top: 1rem
            }
        }

        #image-caption {
            font-style: normal;
            font-size: 1rem;
            margin-top: 0.5rem
        }

        @media(max-width:767px) {
            #image-caption {
                font-style: normal;
                font-size: 0.6rem;
                margin-top: 0.5rem
            }
        }

        .carousel-control-next>i,
        .carousel-control-prev>i {

            padding: 1.4rem
        }

        @media(max-width:767px) {
            i {
                padding: 0.8rem
            }
        }

        .carousel-control-prev {
            justify-content: flex-start
        }

        .carousel-control-next {
            justify-content: flex-end
        }

        .carousel-control-prev,
        .carousel-control-next {
            transition: none;
            opacity: unset
        }



        @media (max-width:991.98px) {
            .padding {
                padding: 1.5rem
            }
        }

        @media (max-width:767.98px) {
            .padding {
                padding: 1rem
            }
        }

        .padding {
            padding: 5rem
        }

        .card {
            position: relative;
            display: flex;
            width: ;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #d2d2dc;
            border-radius: 11px;
            -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
            box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
        }

        .card .card-body {
            padding: 1rem 1rem
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.25rem
        }

        p {
            font-size: 0.875rem;
            margin-bottom: .5rem;
            line-height: 1.5rem
        }

        h4 {
            line-height: .2 !important
        }

        .profile {
            margin-top: 16px;
            margin-left: 11px
        }

        .profile-pic {
            width: 58px
        }

        .cust-name {
            font-size: 18px
        }

        .cust-profession {
            font-size: 10px
        }

        .items {
            width: 90%;
            margin: 0px auto;
            margin-top: 100px
        }

        .slick-slide {
            margin: 10px
        }



    </style>
    <style type="text/css">
        h3.center-text {
            text-align: center;
        }
    </style>

</head>

<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->


<body class="">


    




    <?php if($setting->whatsapp): ?>
        <!-- Whatsapp -->
        <div class="chat-whatsapp">
            <a href="<?php echo e($setting->whatsapp); ?>"><img src="<?php echo e(url('/')); ?>/frontend/assets/imgs/whatsapp.png"
                    alt="whatsapp"></a>
        </div>
        <!-- //Whatsapp -->
    <?php endif; ?>
    <!-- Loader -->
    <!-- <div class="loaders">
    <div class="preloaders">
      <div class="face face1">
        <div class="circle"></div>
      </div>
      <div class="face face2">
        <div class="circle">
          <img src="<?php echo e($setting->image_footer); ?>" alt="">
        </div>
      </div>
    </div>
  </div> -->
    <!-- // Loader -->
    <!-- START => Header -->
    <header>
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo">
                    <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e($setting->image_logo); ?>" class="img-fluid" alt=""></a>
                </div>
                <nav>
                    <img src="<?php echo e($setting->image_logo); ?>" class="img-fluid logo-mobile" alt="">
                    <hr class="on-mobile">
                    <ul class="d-flex align-content-center">

                        <li>
                            <!-- Sidebar Menu -->
                            <div class="menu-nav" id="sidemenunav">

                                <nav id="main-nav2">
                                    <ul id="main-menu2">

                                        <div class="layer_overlay"></div>

                                        <li>
                                            <div class="desc-back text-left"><i class="fa fa-angle-left px-2"></i> Back
                                            </div>
                                        </li>

                                        <?php $__currentLoopData = $header_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="has-collapsible">
                                                <a href="#" class="btn-supdown"><?php echo e($header_section->title); ?></a>
                                                <ul class="sup_menu">
                                                    <?php $__currentLoopData = $header_section->category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a
                                                                href="<?php echo e(route('search', ['category_id' => $category->id])); ?>"><?php echo e($category->title); ?></a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>
                                </nav>
                            </div>
                            <!-- // Sidebar Menu -->
                        </li>

                        <li><a href="<?php echo e(route('home')); ?>"
                                class="<?php echo e($page == 'home' ? 'active' : ''); ?>"><?php echo app('translator')->getFromJson('site.home'); ?></a>
                        </li>

                        <li class="has_dropdown">
                             <a href="#"><?php echo app('translator')->getFromJson('site.about'); ?> CUT<strong>Z</strong></a>
                                <ul class="dropdown_menu in_drb">
                                    <li><a href="<?php echo e(route('about')); ?>"><?php echo app('translator')->getFromJson('site.about'); ?></a></li>
                                    <li><a href="<?php echo e(route('reviews_page')); ?>"><?php echo app('translator')->getFromJson('site.reviews'); ?></a></li>

                                    <li><a href="<?php echo e(route('careers.index')); ?>"><?php echo app('translator')->getFromJson('site.careers'); ?></a></li>
                                </ul>
                        </li>
                        <li class="has-dropdown <?php echo e($page == 'shop' ? 'active' : ''); ?>">
                            <a href="javascript:void(0)"><?php echo app('translator')->getFromJson('site.shop'); ?></a>
                            <div class="mega_menu in_drb">
                                <ul class="row">
                                    <?php $__currentLoopData = $header_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="col_md_5 col-sm-12 col-12">
                                            <a href="<?php echo e(route('search', ['section_id' => $header_section->id])); ?>"
                                                class="title_catg"><?php echo e($header_section->title); ?></a>
                                            <ul>
                                                <?php $__currentLoopData = $header_section->category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        

                                                        
                                                        <a
                                                            href="<?php echo e(route('search', ['category_id' => $category->id])); ?>"><?php echo e($category->title); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </li>

                        
                        <li><a href="<?php echo e(route('elite_products')); ?>"
                                class="<?php echo e($page == 'elite_products' ? 'active' : ''); ?> "><?php echo app('translator')->getFromJson('site.Elite_Products'); ?></a>
                        </li>
                        <!-- <li><a href="<?php echo e(route('galleries')); ?>"
                class="<?php echo e($page == 'galleries' ? 'active' : ''); ?> "><?php echo app('translator')->getFromJson('site.galleries'); ?></a>
            </li> -->

                        <li><a href="<?php echo e(route('blogs')); ?>"
                                class="<?php echo e($page == 'useful_information' ? 'active' : ''); ?> "><?php echo app('translator')->getFromJson('site.useful_information'); ?></a>
                        </li>

                        <li><a href="<?php echo e(route('recipes')); ?>"
                                class="<?php echo e($page == 'recipes' ? 'active' : ''); ?> "><?php echo app('translator')->getFromJson('site.recipes'); ?></a>
                        </li>

                        <li class="has_dropdown">
                            <a href="javascript:void(0)"><?php echo app('translator')->getFromJson('site.galleries'); ?></a>
                            <ul class="dropdown_menu in_drb">
                                <li> <a href="<?php echo e(route('galleriesImages')); ?>"><?php echo app('translator')->getFromJson('site.images'); ?></a> </li>
                                <li> <a href="<?php echo e(route('galleriesVideos')); ?>"><?php echo app('translator')->getFromJson('site.videos'); ?></a> </li>
                            </ul>
                        </li>

                        <li><a href="<?php echo e(route('contact')); ?>"
                                class="<?php echo e($page == 'contact' ? 'active' : ''); ?> "><?php echo app('translator')->getFromJson('site.contact'); ?></a>
                        </li>


                    </ul>
                </nav>


                <?php echo $__env->make('partials.header._customer_profile', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


            </div>
        </div>
    </header>
    <!-- //END => Header -->
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('partials._session', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- START => Footer -->
    <footer class="" style="background-image: url(<?php echo e(url('/')); ?>/frontend/assets/imgs/footer_map-03.png)">
        <div class="container">
            <div class="text-center py-5">
                <a href="" class="logo"><img src="<?php echo e($setting->image_footer); ?>" class="img-fluid" alt=""></a>
                <p class="my-5">
                    <?php echo app('translator')->getFromJson('site.footer_slug'); ?>
                    <br> <?php echo app('translator')->getFromJson('site.footer_slug2'); ?>
                </p>

                <div class="headset-phone">
                    <a href="tel:<?php echo e($setting->hotLine); ?>">
                        <i class="fas fa-4x fa-headset"></i>
                        <span class=""><?php echo e($setting->hotLine); ?></span>
                    </a>
                </div>

                <div class="link-emial">
                    <a href="mailto:<?php echo e($setting->email); ?>"><i class="fas fa-envelope"></i>
                        <?php echo e($setting->email); ?></a>
                </div>

                <ul class="social-footer d-flex align-items-center justify-content-center mt-4">
                    <?php $__currentLoopData = $socails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($socail->link != null): ?>
                            <li><a href="<?php echo e($socail->link); ?>" target="_blank"><i
                                        class="fab fa-lg <?php echo e($socail->icon); ?>"></i></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <div class="subscribe-form">
                    <strong><?php echo app('translator')->getFromJson('site.SUBSCRIBE_TO_OUR_NEWSLETTER'); ?></strong>
                    <form action="<?php echo e(route('subscribe')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('post')); ?>

                        <input type="text" name="email" placeholder="<?php echo app('translator')->getFromJson('site.Enter_Email'); ?>">
                        <button class="btn-subscribe"><?php echo app('translator')->getFromJson('site.subscribe'); ?></button>
                    </form>
                </div>

                <div class="app-downloading">
                    <strong><?php echo app('translator')->getFromJson('site.Download_app_link'); ?></strong>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="<?php echo e($setting->link_android); ?>"><img
                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/google-play.png" alt=""></a>
                        <a href="<?php echo e($setting->link_ios); ?>"><img
                                src="<?php echo e(url('/')); ?>/frontend/assets/imgs/appstore.png" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="copyright-footer">
            <div class="container d-flex align-items-center justify-content-between">
                <p class="m-0"> &copy; <?php echo app('translator')->getFromJson('site.copyright'); ?> - <?php echo date('Y'); ?></p>
                <ul class="d-flex align-items-center justify-content-between">
                    <li><a href="<?php echo e(route('privacies')); ?>"><?php echo e(__('site.privacies')); ?></a></li>
                    <li><a href="<?php echo e(route('polices')); ?>"><?php echo e(__('site.polices')); ?></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- //END => Footer -->
    <!-- Button Scroll To Top -->
    <!-- <a href="" class="scrollToTop"><i class="fas fa-chevron-up"></i></a> -->
    <!-- <a href="#" class="ltx-go-top floating ltx-go-top-icon show"><span class="go-top-icon-v2 icon icon-top"></span><span class="txt">go top</span></a> -->
    <!-- // Button Scroll To Top -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php echo $__env->yieldContent('extra-js'); ?>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/selectric/jquery.selectric.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/swipper/swiper.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/wow/wow.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/mixitup/mixitup.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/popup/jquery.fancybox.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/numscroller-1.0.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/libs/parallax.min.js"></script>
    <script src="<?php echo e(url('/')); ?>/frontend/assets/js/main.js"></script>



    <script>
        $(document).ready(function() {

            $('#IDSearch').keyup(function() {
                var key = $(this).val();
                if (key != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "<?php echo e(route('autocomplete.fetch')); ?>",
                        method: "POST",
                        data: {
                            query: key,
                            _token: _token
                        },
                        success: function(data) {
                            $('#searchList').fadeIn();
                            $('#searchList').html(data);
                        }
                    });
                }
            });

            $(document).on('click', 'li', function() {
                $('#IDSearch').val($(this).text());
                $('#searchList').fadeOut();
            });

        });
    </script>

  <script>
        $('#login_form').show();
        $('#guest_form').hide();
        $('#login').hide();

        $('#guestcheckout').on('click', function(){
            $('#guest_form').show(1000);
            $('#login_form').hide(1000);
            $('#guestcheckout').hide(1000);
            $('#login').show(1000);
        });
        $('#login').on('click', function(){
            $('#login_form').show(1000);
            $('#guest_form').hide(1000);
            $('#login').hide(1000);
            $('#guestcheckout').show(1000);
        });

        if ($(window).width() < 767){
        //    $('#sec_n_id').attr('data-image-src','').css('background-image','<?php echo e(url('/')); ?>/frontend/assets/imgs/Image2.png').css('background-size','cover').css('background-position','center')
        }

    </script>

</body>

</html>
