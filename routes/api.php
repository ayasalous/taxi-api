<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('login', 'PageController@login');
Route::any('register','PageController@register');
Route::any('looooginnn','PageController@looooginnn');
Route::any('MangerAddDriver','PageController@MangerAddDriver');
Route::any('knowtype','PageController@knowtype');
Route::any('showDriver','PageController@showDriver');
Route::any('deleteDriver','PageController@deleteDriver');