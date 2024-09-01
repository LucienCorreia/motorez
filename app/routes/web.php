<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\VeiculoController@index')->name('index');

Route::get('/vehicles', 'App\Http\Controllers\VeiculoController@list')->name('list');

Route::view('/import', 'import')->name('import.get');

Route::post('/import', 'App\Http\Controllers\VeiculoController@import')->name('import.post');

Route::get('/export', 'App\Http\Controllers\VeiculoController@export')->name('export.get');
