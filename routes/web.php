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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', '\App\Http\Controllers\CodigoPostalController@index')->name('home');
Route::post('/search', '\App\Http\Controllers\CodigoPostalController@search')->name('search');
Route::get('/export', '\App\Http\Controllers\CodigoPostalController@export')->name('export');
Route::get('/apartados', '\App\Http\Controllers\ApartadoController@index')->name('apartados');
Route::get('/apartados-export', '\App\Http\Controllers\ApartadoController@export')->name('apartados.export');
Route::get('/codigo-postal', '\App\Http\Controllers\CodigoPostalController@all')->name('codigo-postal');
Route::get('/aleatorio', '\App\Http\Controllers\CodigoPostalController@aleatorio')->name('aleatorio');
