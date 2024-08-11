<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', '\App\Http\Controllers\CodigoPostalController@index')->name('home');
Route::post('/search', '\App\Http\Controllers\CodigoPostalController@search')->name('search');
Route::get('/export', '\App\Http\Controllers\ExportController@index')->name('export');
Route::post('/export', '\App\Http\Controllers\ExportController@export')->name('export.run');
Route::get('/apartados', '\App\Http\Controllers\ApartadoController@index')->name('apartados');
Route::get('/codigo-postal', '\App\Http\Controllers\CodigoPostalController@all')->name('codigo-postal');
Route::get('/aleatorio', '\App\Http\Controllers\CodigoPostalController@aleatorio')->name('aleatorio');
