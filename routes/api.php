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

    Route::get('orders-products', 'OrderAPIController@products');

});



Route::resource('credits', 'CreditAPIController');

Route::resource('addresses', 'AddressAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('categories', 'CategoryAPIController');

Route::resource('sub_categories', 'SubCategoryAPIController');

Route::resource('galleries', 'GalleryAPIController');


Route::resource('user_products', 'UserProductAPIController');

Route::resource('order_products', 'OrderProductAPIController');
