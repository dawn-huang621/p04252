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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('carts', 'CartController');
Route::resource('cart_items', 'CartItemController');
Route::resource('products', 'ProductController');
Route::post('signup', 'AuthController@signup');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', 'AuthController@user');
});

Route::get('/sendMail', function () {
    Mail::to('recipient@example.com')->send(new FirstMail());
});