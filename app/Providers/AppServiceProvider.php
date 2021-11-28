<?php

namespace App\Providers;

use App\Cart;
use App\Page;

use App\Quote;
use App\Section;
use App\Setting;
use App\SocailMedia;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Victorybiz\GeoIPLocation\GeoIPLocation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        ############### Start Copyrigts ###################
        $copyright_left_bar = 'E';
        $copyright_right_bar = 'bakers';
        $copyright = 'E-bakers';
        $copyright_website = 'https://e-bakers.org/';
        View::share('copyright_left_bar', $copyright_left_bar);
        View::share('copyright_right_bar', $copyright_right_bar);
        View::share('copyright', $copyright);
        View::share('copyright_website', $copyright_website);
        ############### End Copyrigts ###################



        ############### Start Model  ###################
        //      check_vaild_date_promoCode(); //update status promo code if it not valid when make refresh
        $setting  = Setting::first();
        $socails   = SocailMedia::get();
        $header_sections   = Section::Sort()->get();

        View::share('header_sections', $header_sections);
        View::share('setting', $setting);
        View::share('socails', $socails);

        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');


        //     /////////////

        ############### End Model ###################

if (config('app.debug')) {
    error_reporting(E_ALL & ~E_USER_DEPRECATED);
} else {
    error_reporting(0);
}





    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
