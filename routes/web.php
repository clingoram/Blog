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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/','PagesController@index');
// Route::get('/{account}',function($account = null){
//     return 'PagesController@index';
// });

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/about','PagesController@about');

// db,articlecontroller
Route::resource('articles','ArticlesController');

Route::resource('sitesettings','SitesettingsController');

// Route::get('/users/{id}',function($id = null){
//     return 'This user id is:'.$id;
// });
