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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home',[
    'uses' => 'HomeController@index',
    'as'   => 'home'
]);
Route::post('/addCategory',[
    'uses' => 'backend\CategoryController@store',
    'as'   => 'addCategory'
]);
Route::get('/getCategories',[
    'uses' => 'backend\CategoryController@index',
    'as'   => 'getCategories'
]);
Route::get('/show-category/{slug}',[
    'uses' => 'backend\CategoryController@show',
    'as'   => 'show-category'
]);
Route::get('/remove-category/{slug}',[
    'uses' => 'backend\CategoryController@destroy',
    'as'   => 'remove-category'
]);
Route::get('/{anypath}',[
    'uses'    => 'HomeController@index',
    'as'      => 'path','.*'
]);
// Route::get('/categoryList',[
//     'uses' => 'backend\CategoryController@show',
//     'as'   => 'categoryList'
// ]);

// Route::get('/post', 'backend\PostController@index');
// Route::get('/category', 'backend\CategoryController@index');
