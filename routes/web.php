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

Route::get('umkm', 'Front\UmkmController@index');

Route::get('registration-umkm', 'Front\RegistrationUmkmController@index');
Route::post('registration-umkm', 'Front\RegistrationUmkmController@store');
Route::get('registration-umkm/success', 'Front\RegistrationUmkmController@success');

Route::group(['middleware' => 'auth'], function () { 

	Route::get('dashboard','Admin\DashboardController@index');

	Route::group(['namespace' => 'Admin','prefix' => 'admin'],function(){
		Route::resource('category','CategoryController');
		Route::resource('verify-umkm','VerifyUmkmController');
		Route::resource('data-umkm','DataUmkmController');
		Route::resource('user-umkm','UserUmkmController');
	});

	Route::group(['namespace' => 'Umkm','prefix' => 'umkm'],function(){
		Route::resource('product-submission','ProductSubmissionController');
	});
	

	
});


