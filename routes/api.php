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

Route::get('/v1/post/data', 'App\Http\Controllers\api\v1\PostController@index');
Route::get('/v1/post/data/{id}', 'App\Http\Controllers\api\v1\PostController@dataById');
Route::get('/v1/post/search-data/{search}', 'App\Http\Controllers\api\v1\PostController@searchMenu');
Route::post('/v1/post/save-data', 'App\Http\Controllers\api\v1\PostController@save');
Route::post('/v1/post/update-data', 'App\Http\Controllers\api\v1\PostController@update');
Route::post('/v1/post/delete-data/{id}', 'App\Http\Controllers\api\v1\PostController@delete');
