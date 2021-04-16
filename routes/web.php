<?php

use Illuminate\Support\Facades\Route;

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


require __DIR__.'/auth.php';

Route::get('/', 'Front\HomeController@index');

Route::get('register', 'Front\RegisterController@index');
Route::post('register', 'Front\RegisterController@store');
Route::get('register/success', 'Front\RegisterController@success');

Route::get('umkm', 'Front\UmkmController@index');
Route::get('umkm/{id}', 'Front\UmkmController@show');


Route::get('product', 'Front\ProductController@index');
Route::get('product/{id}', 'Front\ProductController@show');

Route::get('registration-umkm', 'Front\RegistrationUmkmController@index');
Route::post('registration-umkm', 'Front\RegistrationUmkmController@store');
Route::get('registration-umkm/success', 'Front\RegistrationUmkmController@success');


Route::resource('cart','Front\CartController');
Route::resource('checkout', 'Front\CheckoutController');
Route::post('checkout-process', 'Front\CheckoutController@proccesssuccess');
Route::get('checkout-success', 'Front\CheckoutController@success');

Route::resource('user-order', 'Front\UserOrderController');
Route::get('user-order-success', 'Front\UserOrderController@success');

Route::group(['middleware' => 'auth'], function () { 

	
	Route::get('after-login','Admin\DashboardController@afterLogin');

	Route::get('dashboard','Admin\DashboardController@index');

	Route::group(['namespace' => 'Admin','prefix' => 'admin'],function(){
		Route::resource('category','CategoryController');
		Route::resource('verify-umkm','VerifyUmkmController');
		Route::resource('data-umkm','DataUmkmController');
		Route::resource('user-umkm','UserUmkmController');
		Route::resource('verify-product','VerifyProductController');
		Route::resource('data-product','DataProductController');
		Route::resource('bank','BankController');
		Route::resource('payment-confirm','PaymentConfirmController');
		Route::get('statistik/product','StatistikProductController@index');
		Route::get('statistik/umkm','StatistikUmkmController@index');
	});

	Route::group(['namespace' => 'Umkm','prefix' => 'admin-umkm'],function(){
		Route::resource('product-submission','ProductSubmissionController');
		Route::resource('product','ProductController');
	});
	

	
});


