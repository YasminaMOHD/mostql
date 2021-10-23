<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ProductController@index');

Route::prefix('products')->name('products.')->group(function(){
    // Route::get('/', 'ProductController@index')->name('index');
    Route::get('/getSubCategory', 'ProductController@getSubCategory')->name('getSubCategory');
    Route::get('/getSub2Category', 'ProductController@getSub2Category')->name('getSub2Category');
    Route::get('/products', 'ProductController@search')->name('search');
    Route::get('/categoryLanguage', 'ProductController@categoryLanguage')->name('categoryLanguage');
    Route::get('/fetch_data', 'ProductController@fetch_data')->name('fetch_data');
    Route::get('/fetch_ajax_data', 'ProductController@fetch_ajax_data')->name('fetch_ajax_data');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
