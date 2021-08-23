<?php

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth' => 'web'])->group(function () {



            Route::get('/index', 'DashboardController@index')->name('index');

            Route::resource('sections', 'SectionController')->except(['show']);
            Route::get('/sections/duplicate/{id?}', 'SectionController@duplicate')->name('sections.duplicate');

            Route::resource('categories', 'CategoryController')->except(['show']);
            Route::get('/categories/duplicate/{id?}', 'CategoryController@duplicate')->name('categories.duplicate');
            Route::get('/categories/export', 'CategoryController@export')->name('categories.export');

            Route::resource('subCategories', 'SubCategoryController')->except(['show']);
            Route::get('/subCategories/duplicate/{id?}', 'SubCategoryController@duplicate')->name('subCategories.duplicate');


            Route::resource('products', 'ProductController')->except(['show']);
            Route::get('/products/duplicate/{id?}', 'ProductController@duplicate')->name('products.duplicate');
            Route::get('category_list/ajax/{id}', array('as' => 'category_list.ajax', 'uses' => 'ProductController@category_list'));
            Route::get('sub_category_list/ajax/{id}', array('as' => 'sub_category_list.ajax', 'uses' => 'ProductController@sub_category_list'));
            Route::get('products/image/{id}', 'ProductController@delete_image')->name('products.image.delete');


            Route::resource('instructions', 'InstructionController')->except(['show']);
            Route::get('/instructions/duplicate/{id?}', 'InstructionController@duplicate')->name('instructions.duplicate');

            Route::resource('locations', 'LocationController')->except(['show']);
            Route::resource('productLocations', 'ProductLocationController')->except(['show']);


            Route::resource('additions', 'AdditionController')->except(['show']);
            Route::get('/additions/duplicate/{id?}', 'AdditionController@duplicate')->name('additions.duplicate');

            Route::resource('pieces', 'PieceController')->except(['show']);
            Route::get('/pieces/duplicate/{id?}', 'PieceController@duplicate')->name('pieces.duplicate');
            Route::get('pieces/ajax/{id}', array('as' => 'pieces.ajax', 'uses' => 'ProductController@pieces'));


            Route::resource('category_galleries', 'CategoryGalleryController')->except(['show']);


            Route::resource('galleries', 'GalleryController')->except(['show']);
            Route::get('/galleries/duplicate/{id?}', 'GalleryController@duplicate')->name('galleries.duplicate');
            Route::get('galleries/image/{id}', 'GalleryController@delete_image')->name('galleries.image.delete');



            Route::resource('countries', 'CountryController')->except(['show']);
            Route::resource('cities', 'CityController')->except(['show']);
            Route::resource('states', 'StateController')->except(['show']);


            Route::resource('sliders', 'SliderController')->except(['show']);
            Route::resource('provenances', 'ProvenanceController')->except(['show']);
            Route::get('/provenances/duplicate/{id?}', 'ProvenanceController@duplicate')->name('provenances.duplicate');

            Route::resource('customers', 'CustomerController')->except(['show']);
            Route::get('/customers/export', 'CustomerController@export')->name('customers.export');




            Route::resource('quotes', 'QuoteController')->except(['show']);
            Route::get('quotes/export', 'QuoteController@export_quotations')->name('quotes.export_quotations');


            Route::resource('tickets', 'TicketController')->except(['show']);
            Route::get('tickets/export', 'TicketController@export_quotations')->name('tickets.export_tickets');
            Route::post('tickets/reply', 'TicketController@reply')->name('tickets.create.reply');

            Route::resource('subscribe', 'SubscribeController')->except(['show']);
            Route::get('subscribe/export', 'SubscribeController@export_subscribe')->name('subscribe.export_subscribe');

            Route::resource('orders', 'OrderController')->except(['show']);
            Route::get('orders/export', 'OrderController@export')->name('orders.export_orders');
            Route::get('orders/export/details', 'OrderController@export_orderDetails')->name('orders.export_orderDetails');
            #Cart
            Route::resource('carts', 'CartController')->except(['show']);
            #invoices
            Route::get('invoices/lists/{id}', 'InvoiceController@list_invoices')->name('invoices.invoices.index');
            Route::get('invoices/edit/{id}', 'InvoiceController@edit_invoices')->name('invoices.invoices.edit');
            Route::put('invoices/edit/{invoice}', 'InvoiceController@update_invoices')->name('invoices.invoices.update');
            Route::get('invoices/export', 'InvoiceController@export_invoices')->name('invoices.export_invoices');
            Route::resource('invoices', 'InvoiceController')->except(['show']);

            Route::resource('promocodes', 'PromoCodeController')->except(['show']);


            Route::resource('services', 'ServiceController')->except(['show']);
            Route::get('services/image/{id}', 'ServiceController@delete_image')->name('services.image.delete');
            Route::get('/services/duplicate/{id?}', 'ServiceController@duplicate')->name('services.duplicate');

            Route::resource('collections', 'CollectionController')->except(['show']);
            Route::get('/collections/duplicate/{id?}', 'CollectionController@duplicate')->name('collections.duplicate');

            Route::resource('ads', 'AdController')->except(['show']);
            Route::get('/ads/duplicate/{id?}', 'AdController@duplicate')->name('ads.duplicate');


            Route::resource('settings', 'SettingController')->except(['show']);

            Route::resource('plans', 'PlanController')->except(['show']);
            Route::get('/plans/duplicate/{id?}', 'PlanController@duplicate')->name('plans.duplicate');

            Route::resource('packages', 'PackageController')->except(['show']);
            Route::get('/packages/duplicate/{id?}', 'PackageController@duplicate')->name('packages.duplicate');

            Route::resource('pages', 'PageController')->except(['show']);
            Route::get('/pages/duplicate/{id?}', 'PageController@duplicate')->name('pages.duplicate');

            Route::resource('tags', 'TagController')->except(['show']);

            Route::resource('abouts', 'AboutController')->except(['show']);

            Route::get('/abouts/duplicate/{id?}', 'AboutController@duplicate')->name('abouts.duplicate');

            Route::resource('blogs', 'BlogsController')->except(['show']);
            Route::get('/blogs/duplicate/{id?}', 'BlogsController@duplicate')->name('blogs.duplicate');



            Route::resource('weights', 'WeightController')->except(['show']);
            Route::get('/weights/duplicate/{id?}', 'WeightController@duplicate')->name('weights.duplicate');

            Route::resource('productWeights', 'ProductWeightController')->except(['show']);


            Route::resource('rates', 'RateController')->except(['show']);
            Route::get('/rates/duplicate/{id?}', 'RateController@duplicate')->name('rates.duplicate');

            Route::resource('testimonails', 'TestimonailsController')->except(['show']);

            Route::resource('parteners', 'PartenersController')->except(['show']);


            Route::resource('brands', 'BrandsController')->except(['show']);



            Route::resource('socail', 'SocailMediaController');


            Route::resource('site_options', 'SiteOptionController');

            Route::resource('inbox', 'InboxController');

            Route::get('export_inbox', 'InboxController@export_inbox');


            Route::resource('clients', 'ClientController')->except(['show']);

            ######################## start roles routes ########################

            Route::resource('roles', 'RoleController')->except(['show']);
            ######################## end roles routes ########################


            ######################## start permissions routes ########################
            Route::get('users/permissions/index', 'UserController@index_permissions')->name('users.permissions.index');

            Route::get('users/permissions/create', 'UserController@create_permissions')->name('users.permissions.create');
            Route::post('users/permissions/store', 'UserController@store_permissions')->name('users.permissions.store');

            Route::get('users/permissions/{id}/edit', 'UserController@edit_permissions')->name('users.permissions.edit');
            Route::put('users/permissions/update/{id}', 'UserController@update_permissions')->name('users.permissions.update');

            Route::delete('users/permissions/{id}/destroy', 'UserController@destroy_permissions')->name('users.permissions.destroy');
            ######################## start permissions routes ########################



            ######################## start user routes ########################
            Route::resource('users', 'UserController')->except(['show']);
            ######################## End  user routes ########################



        }); //end of dashboard routes
    }
);
