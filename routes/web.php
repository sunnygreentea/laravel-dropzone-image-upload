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

Route::get('/image', 'ImageController@index')->name('image');
Route::post('/image/upload', 'ImageController@upload')->name('image.upload');
Route::get('/image/delete', 'ImageController@delete')->name('image.delete');

Route::get('/dropzone', 'DropzoneController@index')->name('dropzone');
Route::post('/dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
Route::get('/dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
Route::get('/dropzone/delete', 'DropzoneController@delete')->name('dropzone.delete');