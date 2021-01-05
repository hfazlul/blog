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

// category

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
Route::post('/updateCategory',[
    'uses' => 'backend\CategoryController@update',
    'as'   => 'updateCategory'
]);
Route::get('/status-category/{id}',[
    'uses' => 'backend\CategoryController@status',
    'as'   => 'status-category'
]);
Route::get('/remove-category/{slug}',[
    'uses' => 'backend\CategoryController@destroy',
    'as'   => 'remove-category'
]);
Route::post('/categories/remove-items',[
    'uses' => 'backend\CategoryController@removeItems',
    'as'   => 'remove-items'
]);
Route::post('/categories/change-status',[
    'uses' => 'backend\CategoryController@changeStatus',
    'as'   => 'change-status'
]);

// category


// post
Route::get('/getActiveCategories',[
    'uses' => 'backend\CategoryController@getActiveCategories',
    'as'   => 'getActiveCategories'
]);

Route::post('/addPost',[
    'uses' => 'backend\PostController@store',
    'as'   => 'addPost'
]);
Route::get('/getPosts',[
    'uses' => 'backend\PostController@index',
    'as'   => 'getPosts'
]);
Route::get('/remove-post/{slug}',[
    'uses' => 'backend\PostController@destroy',
    'as'   => 'remove-post'
]);
Route::get('/postEdit/{slug}',[
    'uses' => 'backend\PostController@show',
    'as'   => 'postEdit'
]);
Route::post('/updatePost',[
    'uses' => 'backend\PostController@update',
    'as'   => 'updatePost'
]);
Route::get('/status-post/{id}',[
    'uses' => 'backend\PostController@status',
    'as'   => 'status-post'
]);

Route::post('/posts/remove-items',[
    'uses' => 'backend\PostController@removeItems',
    'as'   => 'remove-items'
]);
Route::post('/posts/change-status',[
    'uses' => 'backend\PostController@changeStatus',
    'as'   => 'change-status'
]);
Route::get('/{anypath}',[
    'uses'    => 'HomeController@index',
    'as'      => 'path','.*'
]);
// post

