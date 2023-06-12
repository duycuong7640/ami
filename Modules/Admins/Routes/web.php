<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Api for WP

//Route::post('/api/store','ApiController@store')->name('api.store');
//Route::get('/api/categories','ApiController@list');
//Route::get('/api/list_post','ApiController@getListPost')->name('api.getListPost');
Route::post('/load-data', 'ApiController@loadData')->name('api.product.loadData');

Route::prefix('ami-admin')->group(function () {
    Route::get('/sign-in', 'Auth\LoginController@login')->name('admin.login');
    Route::post('/sign-in', 'Auth\LoginController@postLogin');

//    Route::group(['middleware' => 'ckfinderAuth'], function () {
//        Route::get('/ckfinder/browser1', 'Auth\LoginController@browser')->name('admin.browser');
//    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/sign-out', 'Auth\LoginController@index')->name('admin.logout');
        Route::get('/', 'AdminsController@index')->name('admin.index');

        //Account
        Route::prefix('accounts')->group(function () {
            Route::get('/', 'AccountsController@index')->name('admin.account.index');
            Route::get('/create', 'AccountsController@create')->name('admin.account.create');
            Route::post('/create', 'AccountsController@store');
            Route::get('/edit/{id}', 'AccountsController@edit')->name('admin.account.edit');
            Route::post('/edit/{id}', 'AccountsController@update');
            Route::get('/status/{id}/{status}', 'AccountsController@status')->name('admin.account.status');
            Route::get('/show/{id}', 'AccountsController@show')->name('admin.account.show');
            Route::get('/destroy/{id}', 'AccountsController@destroy')->name('admin.account.destroy');
            Route::get('/logout', 'AccountsController@logout')->name('admin.account.logout');
        });

        //Advertisement
        Route::prefix('advertisements')->group(function () {
            Route::get('/', 'AdvertisementsController@index')->name('admin.advertisement.index');
            Route::get('/create', 'AdvertisementsController@create')->name('admin.advertisement.create');
            Route::post('/create', 'AdvertisementsController@store');
            Route::get('/edit/{id}', 'AdvertisementsController@edit')->name('admin.advertisement.edit');
            Route::post('/edit/{id}', 'AdvertisementsController@update');
            Route::get('/status/{id}/{status}', 'AdvertisementsController@status')->name('admin.advertisement.status');
            Route::get('/show/{id}', 'AdvertisementsController@show')->name('admin.advertisement.show');
            Route::get('/destroy/{id}', 'AdvertisementsController@destroy')->name('admin.advertisement.destroy');
        });

        Route::prefix('advones')->group(function () {
            Route::get('/', 'AdvonesController@index')->name('admin.advone.index');
            Route::get('/create', 'AdvonesController@create')->name('admin.advone.create');
            Route::post('/create', 'AdvonesController@store');
            Route::get('/edit/{id}', 'AdvonesController@edit')->name('admin.advone.edit');
            Route::post('/edit/{id}', 'AdvonesController@update');
            Route::get('/status/{id}/{status}', 'AdvonesController@status')->name('admin.advone.status');
            Route::get('/show/{id}', 'AdvonesController@show')->name('admin.advone.show');
            Route::get('/destroy/{id}', 'AdvonesController@destroy')->name('admin.advone.destroy');
        });
        
        //Mail template        
        Route::prefix('mailtemplates')->group(function () {
            Route::get('/', 'MailtemplatesController@index')->name('admin.mailtemplate.index');
            Route::get('/create', 'MailtemplatesController@create')->name('admin.mailtemplate.create');
            Route::post('/create', 'MailtemplatesController@store');
            Route::get('/edit/{id}', 'MailtemplatesController@edit')->name('admin.mailtemplate.edit');
            Route::post('/edit/{id}', 'MailtemplatesController@update');
            Route::get('/status/{id}/{status}', 'MailtemplatesController@status')->name('admin.mailtemplate.status');
            Route::get('/show/{id}', 'MailtemplatesController@show')->name('admin.mailtemplate.show');
            Route::get('/destroy/{id}', 'MailtemplatesController@destroy')->name('admin.mailtemplate.destroy');
        });

        //Logo
        Route::prefix('logos')->group(function () {
            Route::get('/', 'LogosController@index')->name('admin.logo.index');
            Route::get('/create', 'LogosController@create')->name('admin.logo.create');
            Route::post('/create', 'LogosController@store');
            Route::get('/edit/{id}', 'LogosController@edit')->name('admin.logo.edit');
            Route::post('/edit/{id}', 'LogosController@update');
            Route::get('/status/{id}/{status}', 'LogosController@status')->name('admin.logo.status');
            Route::get('/show/{id}', 'LogosController@show')->name('admin.logo.show');
            Route::get('/destroy/{id}', 'LogosController@destroy')->name('admin.logo.destroy');
        });

        //Fix one
        Route::prefix('fixones')->group(function () {
            Route::get('/', 'FixonesController@index')->name('admin.fixone.index');
            Route::get('/create', 'FixonesController@create')->name('admin.fixone.create');
            Route::post('/create', 'FixonesController@store');
            Route::get('/edit/{id}', 'FixonesController@edit')->name('admin.fixone.edit');
            Route::post('/edit/{id}', 'FixonesController@update');
            Route::get('/status/{id}/{status}', 'FixonesController@status')->name('admin.fixone.status');
            Route::get('/show/{id}', 'FixonesController@show')->name('admin.fixone.show');
            Route::get('/destroy/{id}', 'FixonesController@destroy')->name('admin.fixone.destroy');
        });

        //Fix two
        Route::prefix('fixtwos')->group(function () {
            Route::get('/', 'FixtwosController@index')->name('admin.fixtwo.index');
            Route::get('/create', 'FixtwosController@create')->name('admin.fixtwo.create');
            Route::post('/create', 'FixtwosController@store');
            Route::get('/edit/{id}', 'FixtwosController@edit')->name('admin.fixtwo.edit');
            Route::post('/edit/{id}', 'FixtwosController@update');
            Route::get('/status/{id}/{status}', 'FixtwosController@status')->name('admin.fixtwo.status');
            Route::get('/show/{id}', 'FixtwosController@show')->name('admin.fixtwo.show');
            Route::get('/destroy/{id}', 'FixtwosController@destroy')->name('admin.fixtwo.destroy');
        });

        //Fix three
        Route::prefix('fixthrees')->group(function () {
            Route::get('/', 'FixthreesController@index')->name('admin.fixthree.index');
            Route::get('/create', 'FixthreesController@create')->name('admin.fixthree.create');
            Route::post('/create', 'FixthreesController@store');
            Route::get('/edit/{id}', 'FixthreesController@edit')->name('admin.fixthree.edit');
            Route::post('/edit/{id}', 'FixthreesController@update');
            Route::get('/status/{id}/{status}', 'FixthreesController@status')->name('admin.fixthree.status');
            Route::get('/show/{id}', 'FixthreesController@show')->name('admin.fixthree.show');
            Route::get('/destroy/{id}', 'FixthreesController@destroy')->name('admin.fixthree.destroy');
        });

        //Fix fourth
        Route::prefix('fixfourths')->group(function () {
            Route::get('/', 'FixfourthsController@index')->name('admin.fixfourth.index');
            Route::get('/create', 'FixfourthsController@create')->name('admin.fixfourth.create');
            Route::post('/create', 'FixfourthsController@store');
            Route::get('/edit/{id}', 'FixfourthsController@edit')->name('admin.fixfourth.edit');
            Route::post('/edit/{id}', 'FixfourthsController@update');
            Route::get('/status/{id}/{status}', 'FixfourthsController@status')->name('admin.fixfourth.status');
            Route::get('/show/{id}', 'FixfourthsController@show')->name('admin.fixfourth.show');
            Route::get('/destroy/{id}', 'FixfourthsController@destroy')->name('admin.fixfourth.destroy');
        });

        //Logo
        Route::prefix('slideshows')->group(function () {
            Route::get('/', 'SlideshowsController@index')->name('admin.slideshow.index');
            Route::get('/create', 'SlideshowsController@create')->name('admin.slideshow.create');
            Route::post('/create', 'SlideshowsController@store');
            Route::get('/edit/{id}', 'SlideshowsController@edit')->name('admin.slideshow.edit');
            Route::post('/edit/{id}', 'SlideshowsController@update');
            Route::get('/status/{id}/{status}', 'SlideshowsController@status')->name('admin.slideshow.status');
            Route::get('/show/{id}', 'SlideshowsController@show')->name('admin.slideshow.show');
            Route::get('/destroy/{id}', 'SlideshowsController@destroy')->name('admin.slideshow.destroy');
        });

        //Logo
        Route::prefix('links')->group(function () {
            Route::get('/', 'LinksController@index')->name('admin.link.index');
            Route::get('/create', 'LinksController@create')->name('admin.link.create');
            Route::post('/create', 'LinksController@store');
            Route::get('/edit/{id}', 'LinksController@edit')->name('admin.link.edit');
            Route::post('/edit/{id}', 'LinksController@update');
            Route::get('/status/{id}/{status}', 'LinksController@status')->name('admin.link.status');
            Route::get('/show/{id}', 'LinksController@show')->name('admin.link.show');
            Route::get('/destroy/{id}', 'LinksController@destroy')->name('admin.link.destroy');
        });

        //Danh muc
        Route::prefix('categories')->group(function () {
            Route::get('/', 'CategoriesController@index')->name('admin.category.index');
            Route::get('/create', 'CategoriesController@create')->name('admin.category.create');
            Route::post('/create', 'CategoriesController@store');
            Route::get('/edit/{id}', 'CategoriesController@edit')->name('admin.category.edit');
            Route::post('/edit/{id}', 'CategoriesController@update');
            Route::get('/status/{id}/{field}', 'CategoriesController@status')->name('admin.category.status');
            Route::get('/show/{id}', 'CategoriesController@show')->name('admin.category.show');
            Route::get('/destroy/{id}', 'CategoriesController@destroy')->name('admin.category.destroy');
        });

        //Redirect
        Route::prefix('redirect-urls')->group(function () {
            Route::get('/', 'RedirectUrlsController@index')->name('admin.redirect.index');
            Route::get('/create', 'RedirectUrlsController@create')->name('admin.redirect.create');
            Route::post('/create', 'RedirectUrlsController@store');
            Route::get('/edit/{id}', 'RedirectUrlsController@edit')->name('admin.redirect.edit');
            Route::post('/edit/{id}', 'RedirectUrlsController@update');
            Route::get('/status/{id}/{field}', 'RedirectUrlsController@status')->name('admin.redirect.status');
            Route::get('/show/{id}', 'RedirectUrlsController@show')->name('admin.redirect.show');
            Route::get('/destroy/{id}', 'RedirectUrlsController@destroy')->name('admin.redirect.destroy');
        });

        //Comment
        Route::prefix('comments')->group(function () {
            Route::get('/', 'CommentController@index')->name('admin.comment.index');
            Route::get('/status/{id}/{field}', 'CommentController@status')->name('admin.comment.status');
            Route::get('/destroy/{id}', 'CommentController@destroy')->name('admin.comment.destroy');
        });

        //Bài viet
        Route::prefix('posts')->group(function () {
            Route::get('/', 'PostsController@index')->name('admin.post.index');
            Route::post('/', 'PostsController@actionIndex');
            Route::get('/create', 'PostsController@create')->name('admin.post.create');
            Route::post('/create', 'PostsController@store');
            Route::get('/edit/{id}', 'PostsController@edit')->name('admin.post.edit');
            Route::post('/edit/{id}', 'PostsController@update');
            Route::get('/status/{id}/{field}', 'PostsController@status')->name('admin.post.status');
            Route::get('/show/{id}', 'PostsController@show')->name('admin.post.show');
            Route::get('/destroy/{id}', 'PostsController@destroy')->name('admin.post.destroy');
        });

        //Bài viet
        Route::prefix('posttwos')->group(function () {
            Route::get('/', 'PosttwosController@index')->name('admin.posttwo.index');
            Route::post('/', 'PosttwosController@actionIndex');
            Route::get('/create', 'PosttwosController@create')->name('admin.posttwo.create');
            Route::post('/create', 'PosttwosController@store');
            Route::get('/edit/{id}', 'PosttwosController@edit')->name('admin.posttwo.edit');
            Route::post('/edit/{id}', 'PosttwosController@update');
            Route::get('/status/{id}/{field}', 'PosttwosController@status')->name('admin.posttwo.status');
            Route::get('/show/{id}', 'PosttwosController@show')->name('admin.posttwo.show');
            Route::get('/destroy/{id}', 'PosttwosController@destroy')->name('admin.posttwo.destroy');
        });

        Route::prefix('postthrees')->group(function () {
            Route::get('/', 'PostthreesController@index')->name('admin.postthree.index');
            Route::post('/', 'PostthreesController@actionIndex');
            Route::get('/create', 'PostthreesController@create')->name('admin.postthree.create');
            Route::post('/create', 'PostthreesController@store');
            Route::get('/edit/{id}', 'PostthreesController@edit')->name('admin.postthree.edit');
            Route::post('/edit/{id}', 'PostthreesController@update');
            Route::get('/status/{id}/{field}', 'PostthreesController@status')->name('admin.postthree.status');
            Route::get('/show/{id}', 'PostthreesController@show')->name('admin.postthree.show');
            Route::get('/destroy/{id}', 'PostthreesController@destroy')->name('admin.postthree.destroy');
        });

        //Products
        Route::prefix('products')->group(function () {
            Route::get('/', 'ProductsController@index')->name('admin.product.index');
            Route::post('/', 'ProductsController@actionIndex');
            Route::get('/create', 'ProductsController@create')->name('admin.product.create');
            Route::post('/create', 'ProductsController@store');
            Route::get('/edit/{id}', 'ProductsController@edit')->name('admin.product.edit');
            Route::post('/edit/{id}', 'ProductsController@update');
            Route::get('/status/{id}/{field}', 'ProductsController@status')->name('admin.product.status');
            Route::get('/show/{id}', 'ProductsController@show')->name('admin.product.show');
            Route::get('/destroy/{id}', 'ProductsController@destroy')->name('admin.product.destroy');
        });

        Route::prefix('versions')->group(function () {
            Route::get('/', 'ProductsController@index_version')->name('admin.version.index_version');
        });

        //Products
        Route::prefix('carts')->group(function () {
            Route::get('/', 'CartsController@index')->name('admin.cart.index');
        });

        // Cấu hình
        Route::get('/settings/{id}', 'SettingsController@edit')->name('admin.setting.update');
        Route::post('/settings/{id}', 'SettingsController@update');

        //Crawler
        Route::prefix('crawlers')->group(function () {
            Route::prefix('websites')->group(function () {
                Route::get('/', 'Crawlers\WebsitesController@index')->name('admin.crawler.website.index');
                Route::get('/create', 'Crawlers\WebsitesController@create')->name('admin.crawler.website.create');
                Route::post('/create', 'Crawlers\WebsitesController@store');
                Route::get('/edit/{id}', 'Crawlers\WebsitesController@edit')->name('admin.crawler.website.edit');
                Route::post('/edit/{id}', 'Crawlers\WebsitesController@update');
                Route::get('/status/{id}/{field}', 'Crawlers\WebsitesController@status')->name('admin.crawler.website.status');
                Route::get('/show/{id}', 'Crawlers\WebsitesController@show')->name('admin.crawler.website.show');
                Route::get('/destroy/{id}', 'Crawlers\WebsitesController@destroy')->name('admin.crawler.website.destroy');
            });

            Route::prefix('categories')->group(function () {
                Route::get('/{crawler_website_id}', 'Crawlers\CategoriesController@index')->name('admin.crawler.category.index');
                Route::get('/{crawler_website_id}/create', 'Crawlers\CategoriesController@create')->name('admin.crawler.category.create');
                Route::post('/{crawler_website_id}/create', 'Crawlers\CategoriesController@store');
                Route::get('/{crawler_website_id}/edit/{id}', 'Crawlers\CategoriesController@edit')->name('admin.crawler.category.edit');
                Route::post('/{crawler_website_id}/edit/{id}', 'Crawlers\CategoriesController@update');
                Route::get('/{crawler_website_id}/status/{id}/{field}', 'Crawlers\CategoriesController@status')->name('admin.crawler.category.status');
                Route::get('/{crawler_website_id}/show/{id}', 'Crawlers\CategoriesController@show')->name('admin.crawler.category.show');
                Route::get('/{crawler_website_id}/destroy/{id}', 'Crawlers\CategoriesController@destroy')->name('admin.crawler.category.destroy');
            });
        });


    });
});

