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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

});

// Route::resource('buckets', 'Api\ApiBucketController');
Route::get('buckets', 'Api\ApiBucketController@index');
Route::post('buckets', 'Api\ApiBucketController@store');
Route::put('buckets/{bucket}', 'Api\ApiBucketController@update');
Route::delete('buckets/{bucket}', 'Api\ApiBucketController@destroy');

Route
::prefix('buckets/{bucket}')
->group( function() {
    // Route::resource('files', 'FileController');
    Route::get('files', 'Api\ApiFileController@index');
    Route::post('files', 'Api\ApiFileController@store');
    Route::put('files/{file}', 'Api\ApiFileController@update');
    Route::delete('files/{file}', 'Api\ApiFileController@destroy');
    Route::get('files/{file}', 'Api\ApiFileController@download');

    Route::get('files/{file}/download', 'FileController@download')->name('files.download');
});

