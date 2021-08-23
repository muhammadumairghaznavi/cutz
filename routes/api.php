<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



################## Auth Area #################
Route::group(['namespace' => "Customer"], function () {

    Route::get('logout', 'AuthController@logout');
    Route::post('social_login', 'AuthController@social_login');
    Route::post('login', 'AuthController@login');
    Route::post('signupCustomer', 'AuthController@signupCustomer')->name('signupCustomer');
    Route::post('verifyAccount', 'AuthController@verifyAccount');
    Route::post('checkPhone', 'AuthController@checkPhone');
    Route::post('RestPasswordByPhone', 'AuthController@RestPasswordByPhone');
});


Route::group(['namespace' => "Customer", 'prefix' => 'customer/', 'middleware' => 'auth:customer-api'], function () {

    Route::post('profile', 'AuthController@profile');
    Route::post('editCustomerProfile', 'AuthController@editCustomerProfile');
    Route::post('changePassword', 'AuthController@changePassword');
    Route::get('logout', 'AuthController@logout');
    Route::post('updateFirebaseToken', 'AuthController@updateFirebaseToken');


    #######    Favourite   ###########
    Route::post('addTofavourite', 'OrderController@addTofavourite');
    Route::post('deleteFavourite', 'OrderController@deleteFavourite');
    Route::post('listDatafavourite', 'OrderController@listDatafavourite');
    ####### End Favourite ################


    ####### start  Cart   ################
    Route::post('addToCart', 'OrderController@addToCart');
Route::post('listDataCart', 'OrderController@listDataCart');
    Route::post('totalCartWithAdidtion', 'OrderController@totalCartWithAdidtion');
    Route::post('deleteCart', 'OrderController@deleteCart');
    Route::post('editCart', 'OrderController@editCart');
    ####### End Cart ######################

    ####### start PromoCode ################
    Route::post('addPromoCode', 'OrderController@addPromoCode');
    ####### End PromoCode ##################


    #######    Order   #####################
    Route::post('createOrder', 'OrderController@createOrder');
    Route::post('listOrder', 'OrderController@listOrder');
    Route::post('update_payment_status', 'OrderController@update_payment_status');
    ####### End Order ######################

    #######    Rating Start   #####################
    Route::post('createRateProduct', 'OrderController@createRateProduct');
    ####### End Rating ######################



    ####### Start Address ######################
    Route::post('createAddress', 'AuthController@createAddress');
    Route::get('listAddress', 'AuthController@listAddress');
    Route::post('activatAddress', 'AuthController@activatAddress');
    Route::post('editAddress', 'AuthController@editAddress');
    ####### End Address ######################





});

################## Auth Area #################


Route::group(
    [
        'namespace' => 'General', 'middleware' => 'localization',
    ],
    function () {

        Route::get('/listBranches', 'MainController@listBranches')->name('listBranches');
        Route::get('/productLocation', 'MainController@productLocation')->name('productLocation');
        Route::get('/nearstBranch', 'MainController@nearstBranch')->name('nearstBranch');

        Route::get('/bestSeller', 'MainController@bestSeller');



        Route::get('/sliders', 'MainController@sliders')->name('sliders');
        Route::get('/blogs', 'MainController@blogs')->name('blogs');
        Route::get('/sections', 'MainController@sections');
        Route::get('/categories', 'MainController@categories');
        Route::get('/sub_categories', 'MainController@sub_categories');
        Route::get('/products', 'MainController@products');
        Route::get('/relatedProduct', 'MainController@relatedProduct');

        Route::get('/offers', 'MainController@offers');
        Route::get('/collections', 'MainController@collections');
        Route::get('/addtions', 'MainController@addtions');
        Route::get('/tags', 'MainController@tags');
        Route::get('/about', 'MainController@about');
        Route::get('/pages', 'MainController@pages');
        Route::get('/countries', 'MainController@countries');
        Route::get('/search', 'MainController@search');
        Route::get('/filter', 'MainController@filter');
        Route::post('/contact', 'MainController@contact');


    }
);


################# RMS API #################
Route::group(
    [
        'namespace' => 'Rms', 'prefix' => 'rms/', 'middleware' => 'localization',
    ],
    function () {

        Route::get('/sliders', 'RmsController@sliders')->name('sliders');
        Route::get('/sections', 'RmsController@sections')->name('sections');
        Route::get('/products', 'RmsController@products')->name('products');

    }
);
