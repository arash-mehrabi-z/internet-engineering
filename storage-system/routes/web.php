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

Route::get('/', 'HomeController@index')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('buckets', 'BucketController');

Route
    ::prefix('buckets/{bucket}')
    ->group( function() {
        Route::resource('files', 'FileController');

        Route::get('files/{file}/download', 'FileController@download')->name('files.download');

        Route::get('files/{file}/stream', 'FileController@stream')->name('files.stream');
    });
