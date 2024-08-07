<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstMail;

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
//     return view('welcome');
// });
Route::group(['middleware' => 'check.dirty'], function () {
    Route::resource('products', 'ProductController');
});
Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
    Route::resource('carts', 'CartController');
    Route::post('carts/checkout', 'CartController@checkout');
    Route::resource('cart-items', 'CartItemController');
});

Route::get('/sendMail', function () {
    Mail::to('recipient@example.com')->send(new FirstMail());
});