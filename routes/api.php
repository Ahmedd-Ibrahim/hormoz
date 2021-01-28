<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('register','UserAPIController@register');
    Route::post('login', 'UserAPIController@login');
    Route::post('forget-password', 'UserAPIController@forgetPassword');
    Route::post('set-password', 'UserAPIController@setPassword');
    Route::post('logout', 'UserAPIController@logout')->middleware('jwt.verify');
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::resource('users', 'UserAPIController');

    Route::resource('vendors', 'VendorAPIController');

    Route::post('vendors/legal', 'VendorAPIController@uploadLegal');

    Route::post('vendors/bank', 'VendorAPIController@bank');

//    orders dashboard

    Route::resource('orders', 'OrderAPIController');

    Route::get('orders-count', 'OrderAPIController@count');

    Route::get('orders-history', 'OrderAPIController@history');

    Route::get('orders-single/{id}', 'OrderAPIController@singleOrder');

    Route::get('orders-single-products/{id}', 'OrderAPIController@getSingleOrderProducts');

//    products on dashboard

    Route::get('products-dashboard', 'ProductAPIController@allProducts');

//    Vendor Balance
    Route::get('vendors-balance', 'VendorAPIController@totalBalance');

    Route::get('vendors-orders-history', 'OrderAPIController@vendorOrdersHistory');

//    vendor home

    Route::get('home-info', 'OrderAPIController@home');

    Route::get('home-waiting-orders', 'OrderAPIController@homeWainingOrders');

    Route::get('home-fast-info', 'OrderAPIController@fastInfo');

    Route::resource('galleries', 'GalleryAPIController');

//    user Card

    Route::resource('user_products', 'UserProductAPIController');

    Route::get('user_products-reduce/{id}', 'UserProductAPIController@reduce');

//    user profile

    Route::get('user-profile', 'UserAPIController@profile');

    Route::post('user-profile-update-password', 'UserAPIController@updatePassword');

    Route::post('user-profile', 'UserAPIController@updateProfile');

    Route::resource('favorites', 'FavoriteAPIController')->only(['destroy','store','index']);

//    address for users

    Route::resource('addresses', 'AddressAPIController');

    Route::post('addresses-update', 'AddressAPIController@updateAddress');

    Route::resource('sub_categories', 'SubCategoryAPIController');

    Route::resource('order_products', 'OrderProductAPIController');

    Route::resource('credits', 'CreditAPIController');


});

// phone

Route::resource('categories', 'CategoryAPIController');

Route::resource('products', 'ProductAPIController');

Route::get('products-sim', 'ProductAPIController@simCards');

Route::get('products-card', 'ProductAPIController@card');

Route::get('products-elect', 'ProductAPIController@elect');

Route::get('products-pc', 'ProductAPIController@pc');

Route::get('products-slide', 'ProductAPIController@slide');

Route::resource('mailings', 'mailingAPIController');

