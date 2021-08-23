<!DOCTYPE html>
<html lang="en">

<head>
    {{-- new  --}}
    <title> @yield('title_page') | {{$setting->seo_title }}</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('des_seo'){{$setting->seo_des}}">
    <meta name="keywords" content="@yield('key_seo'){{$setting->seo_key}}">
    <meta name="author" content="{{$setting->seo_title}}">
    {{-- start share button  --}}
    <meta property="og:image" content="@yield('image_url_share')" />
    <meta property="og:title" content="@yield('title_share')">
    <meta property="og:description" content="@yield('description_share')" />
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:type" content="website" />
    {{-- end share button  --}}
    <link rel="icon" href="{{$setting->image_icon}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{$setting->image_icon}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/all.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/animate/animate.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/owl.carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/selectric.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/swipper/swiper.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/popup/magnific-popup.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/slick-slider/slick.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/libs/slick-slider/slick-theme.css">
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/main.css">
    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>
    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/ar.css">
    @endif
    <link rel="stylesheet" href="{{url('/')}}/frontend/assets/css/responsive.css">
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet"> --}}
</head>

<body>
    <!-- START => Header -->
    <header>
        <!-- START => Top Head -->
        <div class="top-head">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="left-head"></div>
                    <div class="right-head">
                        @if (LaravelLocalization::getCurrentLocale()=='ar')
                        <a rel="alternate" class="langs" hreflang="ar" data-toggle="tooltip" data-placement="bottom" title="English" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                            <i class="fa fa-globe"></i>
                            En
                        </a>
                        @elseif(LaravelLocalization::getCurrentLocale()=='en')
                        <a rel="alternate " class="langs" hreflang="ar" data-toggle="tooltip" data-placement="bottom" title="" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                            <i class="fa fa-globe"></i>
                            Ar
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- //END => Top Head -->
        <div class="main-header">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo-header"><a href=""><img src="{{$setting->image_logo}}" class="img-fluid" alt=""></a></div>
                    <div class="nav-menu">
                        <ul class="d-flex">
                            <li><a href="{{route('home')}}">@lang('site.home')</a></li>
                            <li><a href="{{route('website')}}">@lang('site.website')</a></li>
                            <li><a href="{{route('services')}}">@lang('site.services')</a></li>
                            <li><a href="{{route('app-packages')}}">@lang('site.App Packages')</a></li>
                            <li><a href="{{route('customize-solution')}}">@lang('site.Customize Solution')</a></li>
                            <li><a href="{{route('about')}}">@lang('site.abouts')</a></li>
                        </ul>
                    </div>
                    <div class="right-actions">
                        @auth('customer')
                        <a href="{{route('customer.profile.index')}}" class="link-my-profile">@lang('site.welcome') ( {{substr(authCustomer()->full_name,0,11)}}) <img src="{{authCustomer()->image_path}}" class="img-fluid" alt="Image"></a>
                        <i class="toggle-menu-mobile fas fa-bars"></i>
                        {{-- <a href="{{route('customer.profile.index')}}" class="link-login">@lang('site.welcome')
                        ( {{substr(authCustomer()->full_name,0,11)}})
                        </a> --}}
                        @else
                        <a href="{{route('customer.login')}}" class="link-login">@lang('site.login')
                        </a>
                        @endif
                        {{-- <a href="register.html" class="link-cyws">Create your website</a> --}}
                        <i class="toggle-menu-mobile fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- //END => Header -->
    @yield('content')
    @include('partials._session')
    <!-- START => Footer -->
    <footer class="">
        <div class="box-callus">
            <a href="mailto:{{$setting->email}}" class="item-supporting col-md-4 d-flex align-items-center justify-content-center wow bounceIn">
                <i class="far fa-lg fa-envelope"></i>
                <strong class="h6 d-block m-0">{{$setting->email}}</strong>
            </a>
            <a href="tel:{{$setting->num1}}" class="item-supporting col-md-4 d-flex align-items-center justify-content-center wow bounceIn">
                <i class="fas fa-lg fa-headphones-alt"></i>
                <strong class="h6 d-block m-0">{{$setting->num1}}</strong>
            </a>
            <a href=" http://wa.me/{{$setting->num2}}" target="_blank" class="item-supporting col-md-4 d-flex align-items-center justify-content-center wow bounceIn">
                <i class="fab fa-lg fa-whatsapp"></i>
                <strong class="h6 d-block m-0">{{$setting->num2}}</strong>
            </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-wedget">
                        <img src="{{url('/')}}/frontend/assets/imgs/logo.png" class="img-fluid logo-footer" alt="">
                        <strong class="h6 d-block my-4"> @lang('site.Digital Solution Company') </strong>
                        <p>
                            @lang('site.footer_flag')
                        </p>
                        <div class="payments-imgs">
                            <img src="{{url('/')}}/frontend/assets/imgs/payments.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-wedget">
                        <h5 class="mb-4 d-block">@lang('site.Quick Links')</h5>
                        <ul class="links-footer">
                            <li><a href="{{route('home')}}">@lang('site.home')</a></li>
                            <li><a href="{{route('website')}}">@lang('site.website')</a></li>
                            <li><a href="{{route('services')}}">@lang('site.services')</a></li>
                            <li><a href="{{route('app-packages')}}">@lang('site.App Packages')</a></li>
                            <li><a href="{{route('customize-solution')}}">@lang('site.Customize Solution')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-wedget">
                        <h5 class="mb-4 d-block"></h5>
                        <ul class="links-footer">
                            <li><a href="{{route('about')}}">@lang('site.abouts')</a></li>
                            <li><a href="{{route('contact')}}">@lang('site.contact')</a></li>
                            <li><a href="{{route('privacies')}}">@lang('site.privacies')</a></li>
                            <li><a href="{{route('polices')}}">@lang('site.polices')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-wedget subscribe-footer">
                        <h5 class="mb-4 d-block">@lang('site.Stay Connected')</h5>
                        <form action="{{route('subscribe')}}" method="post">
                            @csrf
                            <input type="email" name="email" required='required' placeholder="@lang('site.email')">
                            <button>@lang('site.subscribe now')</button>
                        </form>
                        <div class="social-links mt-4 d-flex">
                            @foreach($socails as $socail)
                            @if($socail->link!=null)
                            <li><a href="{{$socail->link}}" target="_blank"><i class="fab {{$socail->icon}}"></i></a>
                            </li>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights mt-4 clearfix text-center">
            <p class="m-0">
                Copyright &copy; <script type="text/javascript">
                    var d = new Date();
                    document.write(d.getFullYear());
                </script>
                {{$setting->seo_title}}. All Rights Reserved.
            </p>
        </div>
    </footer>
    <!-- //END => Footer -->
    <script src="{{url('/')}}/frontend/assets/js/jquery-1.12.4.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/js/bs-custom-file-input.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/wow/wow.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/js/jquery.selectric.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/swipper/swiper.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/popup/jquery.magnific-popup.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/parallax.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/numscroller-1.0.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/fancybox/jquery.fancybox.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/slick-slider/slick.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/libs/mixitup/mixitup.min.js"></script>
    <script src="{{url('/')}}/frontend/assets/js/main.js"></script>
</body>

</html>
