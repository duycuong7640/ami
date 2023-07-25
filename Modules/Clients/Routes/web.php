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

Route::feeds();

$lang = isset($_SESSION["lang"]) ? $_SESSION["lang"] : "";
$route = "";
switch ($lang){
//    case "_es":
//        $route = "es";
//        break;
//    case "_pt":
//        $route = "pt";
//        break;
    case "_en":
        $route = "en";
        break;
    default:
        $route = "";
        break;
}

$url = Request::url();
//if(strpos($url, "/es/")){
//    $_SESSION["lang"] = "_es";
//    $route = "es";
//}elseif(strpos($url, "/pt/")){
//    $_SESSION["lang"] = "_pt";
//    $route = "pt";
//}else
if(strpos($url, "/en/")){
    $_SESSION["lang"] = "_en";
    $route = "en";
}else{
    $_SESSION["lang"] = "";
    $route = "";
}

if(empty($route)){
//    if(strpos($url, "/es")){
//        $tmp = explode("/es", $url);
//        if(empty($tmp[1])) {
//            $_SESSION["lang"] = "_es";
//            $route = "es";
//        }
//    }elseif(strpos($url, "/pt")){
//        $tmp = explode("/pt", $url);
//        if(empty($tmp[1])) {
//            $_SESSION["lang"] = "_pt";
//            $route = "pt";
//        }
//    }else
    if(strpos($url, "/en")){
        $tmp = explode("/en", $url);
        if(empty($tmp[1])) {
            $_SESSION["lang"] = "_en";
            $route = "en";
        }
    }else{
        $_SESSION["lang"] = "";
        $route = "";
    }
}

Route::prefix($route)->group(function() {
    //user
    Route::prefix('users')->group(function () {
        Route::get('/dang-nhap', 'Auth\LoginController@login')->name('client.user.login');
        Route::post('/dang-nhap', 'Auth\LoginController@postLogin');
        Route::get('/dang-ky', 'Auth\RegisterController@register')->name('client.user.register');
        Route::post('/dang-ky', 'Auth\RegisterController@store');

        Route::group(['middleware' => 'user'], function () {
            Route::get('/show', 'UsersController@show')->name('client.user.show');
            Route::post('/update', 'UsersController@update')->name('client.user.update');
            Route::get('/logout', 'UsersController@logout')->name('client.user.logout');

            //cart
            Route::prefix('cart')->group(function () {
                //Route::post('/store', 'CartController@store')->name('client.card.store');
            });
        });
    });

    //cart
    Route::prefix('cart')->group(function () {
        Route::get('/', 'CartController@index')->name('client.card.index');
        Route::post('/create/{id}', 'CartController@create')->name('client.card.create');
        Route::post('/store', 'CartController@store')->name('client.card.store');
        Route::post('/update/{id}', 'CartController@update')->name('client.card.update');
        Route::get('/destroy/{id}', 'CartController@destroy')->name('client.card.destroy');
        Route::get('/success', 'CartController@success')->name('client.card.success');
    });

    //comment
    Route::prefix('comment')->group(function () {
        Route::post('/{id}/create/', 'CommentController@create')->name('client.comment.create');
        Route::post('/{id}/store', 'CommentController@store')->name('client.comment.store');
    });

    //contact
    Route::get('/lien-he', 'ContactController@create')->name('client.contact.create');
    Route::post('/lien-he', 'ContactController@store');

    //feed product
    Route::get('/product-feed', 'ProductsController@feed');

    // test Stripe
    Route::get('/test-stripe', 'HomeController@testStripe');
    Route::post('/test-stripe', 'HomeController@testStripe');

    Route::get('/test-stripe2', 'HomeController@testStripe');
    Route::post('/test-stripe2', 'HomeController@testStripe');


    //base
    Route::get('/', 'HomeController@index')->name('client.home');
    Route::get('/gia-tot-moi-ngay', 'ProductsController@giatotmoingay')->name('client.product.giatot');
    Route::get('/download/{slug}.htm', 'ProductsController@showDownload')->name('client.product.showDownload');
    Route::get('/download-app/{type}/{slug}.htm', 'ProductsController@showDownloadApp')->name('client.product.showDownloadApp');
    Route::get('/{slug}.htm', 'ProductsController@show')->name('client.product.show');
    Route::get('/{slug}.html', 'PostsController@show')->name('client.post.show');
    Route::get('/search', 'CategoriesController@search')->name('client.category.search');
    Route::get('/{slug}/{type}', 'CategoriesController@index')->name('client.category.type.index');
    Route::get('/{slug}', 'CategoriesController@index')->name('client.category.index');

});

//Route::get('/', 'HomeController@index')->name('client.home1');
