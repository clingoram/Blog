<?php
// user向Route發出請求
// Route決定要哪個Controller做動作

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

// Auth::routes();

// home
Route::get('/home', 'HomeController@index')->name('home');
// pages
Route::get('/','PagesController@index');

// login
Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'UsersController@showLogin');
    Route::post('/', 'UsersController@userLogin');
});
// logout
Route::group(['prefix'=>'logout'],function(){
    Route::post('/', 'UsersController@userLogout');
});
// register
Route::group(['prefix'=>'register'],function(){
    Route::get('/', 'UsersController@showRegister');
    Route::post('/', 'UsersController@userRegister');
});

// Route::get('/about','PagesController@about');

// articles
Route::resource('articles','ArticlesController');
// sitesettings
Route::resource('sitesettings','SitesettingsController');
