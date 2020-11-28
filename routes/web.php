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
Route::get('/published-category/{id}',[
    'uses' => 'backend\CategoryController@published',
    'as'   => 'published-category'
]);
// Route::get('/unPublished-category/{id}',[
//     'uses' => 'backend\CategoryController@unPublished',
//     'as'   => 'unPublished-category'
// ]);
Route::post('/updateCategory',[
    'uses' => 'backend\CategoryController@update',
    'as'   => 'updateCategory'
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
Route::post('/addPost',[
    'uses' => 'backend\PostController@store',
    'as'   => 'addPost'
]);
Route::get('/getPosts',[
    'uses' => 'backend\PostController@index',
    'as'   => 'getPosts'
]);
Route::get('/show-post/{slug}',[
    'uses' => 'backend\PostController@show',
    'as'   => 'show-category'
]);
Route::get('/published-category/{id}',[
    'uses' => 'backend\PostController@published',
    'as'   => 'published-category'
]);
// Route::get('/unPublished-category/{id}',[
//     'uses' => 'backend\CategoryController@unPublished',
//     'as'   => 'unPublished-category'
// ]);
// Route::post('/updateCategory',[
//     'uses' => 'backend\PostController@update',
//     'as'   => 'updateCategory'
// ]);
Route::get('/remove-post/{slug}',[
    'uses' => 'backend\PostController@destroy',
    'as'   => 'remove-post'
]);
Route::get('/{anypath}',[
    'uses'    => 'HomeController@index',
    'as'      => 'path','.*'
]);
// post
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
