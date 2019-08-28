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

// Route::get('/', function () {
//     return view('pages.home');
// });

Auth::routes();

//Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm');
Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin-login');
Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::prefix('products')->group(function(){
            Route::get('/','AdminController@allProducts')->name('all-products');
            Route::get('add','AdminController@addProduct')->name('add-product');
            Route::get('delete/{id}','AdminController@removeProduct')->name('delete-product');
            Route::any('edit/{id}','AdminController@editProduct')->name('edit-product');
            Route::POST('save','AdminController@saveProduct')->name('save-product');
            Route::POST('update/{id}','AdminController@updateProduct')->name('update-product');

            Route::get('categories','AdminController@allCategories')->name('all-categories');
            Route::get('categories/add','AdminController@addCategory');
            Route::post('categories/save', 'AdminController@saveCategory')->name('save-category');
            Route::post('categories/update/{id}', 'AdminController@updateCategory')->name('update-category');
            Route::get('categories/delete/{id}', 'AdminController@removeCategory')->name('delete-category');
            Route::get('categories/edit/{id}', 'AdminController@editCategory')->name('edit-category');

            Route::get('deals','AdminController@allDeals')->name('all-deals');
            Route::get('deals/add','AdminController@addDeal');
            Route::post('deals/save', 'AdminController@saveDeal')->name('save-deal');
            Route::post('deals/update/{id}', 'AdminController@updateDeal')->name('update-deal');
            Route::get('deals/delete/{id}', 'AdminController@removeDeal')->name('delete-deal');
            Route::get('deals/edit/{id}', 'AdminController@editDeal')->name('edit-deal');

            Route::post('image-upload', 'AdminController@storeImg')->name('image.upload.post');
            Route::post('widget-upload', 'AdminController@widgetUpload')->name('widget.upload.post');
            
            Route::get('ajaxRequest', 'AdminController@ajaxRequest');
            Route::post('ajaxRemoveRequest', 'AdminController@ajaxRequestPost')->name('ajaxRemove');
            Route::post('ajaxSaveRequest', 'AdminController@ajaxSavePost')->name('ajaxSave');
            Route::post('ajaxUpdateRequest', 'AdminController@ajaxUpdatePost')->name('ajaxUpdate');
        });
        Route::prefix('orders')->group(function(){
            Route::get('/', 'AdminController@allOrders')->name('all-orders');
            Route::get('{order_id}','AdminController@orderDetail')->name('order-detail');
            Route::post('save','AdminController@changeOrderStatus')->name('save-order-status');
            Route::post('delete','AdminController@deleteOrder')->name('delete-order');
            Route::any('status/{stt}','AdminController@getOrdersByStatus')->name('orders-by-status');
        });

        Route::prefix('appearance')->group(function(){
            Route::get('banner','AdminController@changeBanner');
            Route::get('vertical-banner','AdminController@changeVerticalBanner');
            Route::get('slider','AdminController@changeSlider');
            Route::post('ajaxRemove', 'AdminController@removeWidget')->name('ajax-remove-widget');
        });
    });
});





Route::prefix('/')->group(function(){
    Route::get('/','HomeController@index')->name('homepage');
    Route::get('contact','HomeController@showContact');
    Route::get('product/{id}','HomeController@showProduct')->name('product-detail');
    Route::get('products','HomeController@allProducts');
    Route::get('cart','HomeController@shoppingCart')->name('shoppingCart');
    Route::any('checkout','HomeController@checkout')->name('checkout');
    Route::get('profile', 'UserController@showProfile')->name('show-profile')->middleware('auth');
    Route::any('profile/update', 'UserController@updateProfile')->name('update-profile')->middleware('auth');
    Route::any('profile/order-history', 'UserController@getOrderHistory')->name('order-history');
    Route::post('ajaxAddToCart', 'HomeController@ajaxAddToCart')->name('ajaxAddToCart');
    Route::post('ajaxRemoveFromCart', 'HomeController@ajaxRemoveFromCart')->name('ajaxRemoveFromCart');
    Route::post('ajaxChangeQtyCart', 'HomeController@ajaxChangeQtyCart')->name('ajaxChangeQtyCart');
    Route::post('ajaxRemoveAllCart', 'HomeController@ajaxRemoveAllCart')->name('ajaxRemoveAllCart');
    Route::post('place-an-order', 'HomeController@placeAnOrder')->name('placeAnOrder');
    Route::any('live-search','SearchController@liveSearch')->name('live-search');
    Route::post('search','HomeController@search')->name('search');
    Route::get('search/q={keyword}','HomeController@showSearchResult')->name('show-search-result');

    Route::get('{category}','HomeController@cateProduct')->name('products-by-cate');
});
