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
    Route::post('login', 'UserAPIController@authenticate');
    Route::post('forget-password', 'UserAPIController@forgetPassword');
    Route::post('set-password', 'UserAPIController@setPassword');
    Route::post('logout', 'UserAPIController@logout')->middleware('jwt.verify');
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::resource('users', 'UserAPIController');

});




Route::resource('credits', 'CreditAPIController');

Route::resource('addresses', 'AddressAPIController');

Route::resource('vendors', 'VendorAPIController');

Route::resource('products', 'ProductAPIController');

Route::resource('categories', 'CategoryAPIController');

Route::resource('sub_categories', 'SubCategoryAPIController');

Route::resource('galleries', 'GalleryAPIController');

Route::resource('orders', 'OrderAPIController');

Route::resource('user_products', 'UserProductAPIController');

Route::resource('order_products', 'OrderProductAPIController');