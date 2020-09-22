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

Route::get('/','MainController@index');
Route::post('create-cabinet','MainController@createCabinet');
Route::get('cabinet-{id}','MainController@enterCabinet');



Route::get('cabinet-{cabinet_id}/cell-{cell_id}','MainController@enterCell');
Route::post('create-cell','MainController@createCell');

Route::post('folder_create','MainController@createFolder');
Route::get('cabinet-{cabinet_id}/cell-{cell_id}/folder-{id}','MainController@enterFolder')->name('folder');


Route::post('search-file','MainController@searchFile');


Route::post('file_create','MainController@createFile');

Route::post('/get-all-data','MainController@getAllData');

Route::post('/changeFolderPlace','MainController@changeFolderPlace');