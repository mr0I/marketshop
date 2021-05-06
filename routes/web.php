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


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'islogedin'], function () {
    Route::get('/', 'AdmController@index');
    Route::resource('/category', 'CategoryController');
    Route::resource('/products', 'ProductController');
    Route::resource('/colors', 'ColorController');
    Route::resource('/brands', 'BrandController');
    Route::resource('/specs', 'Specscontroller');
    Route::resource('/discounts', 'DiscountController');
    Route::resource('/videos', 'videocontroller');
    Route::resource('/sliders', 'SliderController');
    Route::post('/videos/upload', 'videocontroller@upload');
    Route::post('/videos/update', 'videocontroller@AjaxUpdate');
    Route::get('video_upload/{video_id}', 'videocontroller@uploadpage');
    Route::get('specifications/{id}', 'Specscontroller@specifications')->name('specifications');
    Route::get('deleteSpecification/{id}', 'Specscontroller@deleteSpecification');
    Route::get('del_brand_pic/{id}', 'BrandController@del_brand_pic');
    Route::get('gallery/{id}', 'ProductController@gallery')->name('gallery');
    Route::post('addgallery', 'ProductController@addGallery')->name('addgallery');
    Route::get('reviews', 'Admcontroller@reviews');
    Route::post('cat_bulk_delete', 'CategoryController@cat_bulk_delete');
    Route::get('edit_profile', 'AdmController@edit_profile');
    Route::post('editProfile/{user_id}', 'AdmController@editProfile');
    Route::post('remove_profile_pic/', 'AdmController@remove_profile_pic');
});


// Route::group(['namespace' => 'Site', 'middleware' => 'verified'], function () {
Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'SiteController@index')->name('home');
    Route::get('/category/{catid}', 'SiteController@cat');
    Route::get('/category/{catid}/{subcatid1}', 'SiteController@subcat1');
    Route::get(
        '/category/{catid}/{subcatid1}/{subcatid2}',
        'SiteController@subcat2'
    );
    Route::get('/product/{slug}', 'SiteController@product');
    Route::get('/restricted', 'SiteController@restricted');
	
    Route::get('/brand/{name}', 'SiteController@brand'); //do not forget to check {name} for 404 error
    Route::get('captcha', 'siteController@myCaptcha');
    Route::get('addFavotite/{product_id}', 'siteController@addFavotite');
    Route::post('/addReviews', 'ReviewController@store');
    Route::get('accept_review/{id}', 'ReviewController@accept_review');
    Route::get('reject_review/{id}', 'ReviewController@reject_review');
    Route::get('aboutus', 'SiteController@aboutus');
    Route::resource('/cart', 'CartController');
    Route::post('addToCart', 'CartController@addToCart');
    Route::get('/delCartProduct/{id}', 'CartController@destroy');
    Route::get('/checkout', 'CheckoutController@index');
    Route::post('discount_check', 'CheckoutController@discount_check');
    Route::post('/clearCoupon', 'CheckoutController@clearCoupon');
    Route::post('refreshCart', 'CheckoutController@refreshCart');
    Route::post('delivery_method', 'CheckoutController@delivery_method');
    Route::post('/checkout', 'CheckoutController@store')->name('checkout_store');
    Route::get('/sort/{col}/{ascdesc}/{sort_catId}/{paginate}', 'siteController@sort');
    Route::get('/sortbrand/{col}/{ascdesc}/{brand}/{paginate}', 'siteController@sort_brand');
    Route::post('/compare', 'siteController@compare');
    Route::get('/compare', 'siteController@compare_index');
    Route::get('remove_compare/{id}', 'siteController@remove_compare');
    Route::get('search', 'siteController@search');
    Route::get('Ajax_search/{phrase}', 'siteController@Ajax_search');
    Route::get('contact_us', 'siteController@contact_us');
    Route::post('contact_us_mail', 'siteController@contact_us_mail')->name('CUMail');
    Route::post('selectCity', 'siteController@selectCity');
    Route::post('clearWishProduct', 'siteController@clearWishProduct');
    Route::get('wishlist', 'siteController@wishlist');
});


Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->middleware('verified'); //temporaily
