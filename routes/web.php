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


Route::group(['middleware' => 'auth'], function () { 

	Route::get('dashboard','Admin\DashboardController@index');

	Route::resource('admin/category','Admin\CategoryController');

	
});

