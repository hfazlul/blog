<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get ('demo', function(){
 return 'hello laravel api';
});

Route::get('/getCategories',[

'uses' => 'backend\apiController@getCategories',
'as'   => 'getCategories'

]);

Route::get('/getPosts',[

'uses' => 'backend\apiController@getPosts',
'as'   => 'getPosts'

]);