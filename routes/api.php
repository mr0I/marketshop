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




Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdmController@index');
    Route::resource('/category', 'CategoryController');
    Route::resource('/products', 'ProductController');
    Route::resource('/colors', 'ColorController');
    Route::resource('/brands', 'BrandController');
    Route::get('del_brand_pic/{id}', 'BrandController@del_brand_pic');
    Route::get('gallery/{id}', 'ProductController@gallery')->name('gallery');
    Route::post('addgallery', 'ProductController@addGallery')->name('addgallery');

    Route::put('updateSpecification', 'ProductController@updateSpecification')->name('updateSpecification');

    Route::post('check_oldPass/{user_id}', 'AdmController@check_oldPass');
    Route::post('/videos/upload', 'videocontroller@store');
    Route::get('/videos/upload', 'videocontroller@uploadpage');


});

Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'SiteController@index')->name('home');
    Route::get('/category/{catid}', 'SiteController@cat');
    Route::get('/category/{catid}/{subcatid1}', 'SiteController@subcat1');
    Route::get(
        '/category/{catid}/{subcatid1}/{subcatid2}',
        'SiteController@subcat2'
    );
    Route::get('/product/{slug}', 'SiteController@product');
    
    Route::get('/brand/{name}', 'SiteController@brand');
});


Auth::routes();
// Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index');


Route::middleware('auth:api')->get('/user', 'HomeController@AuthRouteAPI');
