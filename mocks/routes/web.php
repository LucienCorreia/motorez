<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/webmotors', [\App\Http\Controllers\VeiculoController::class, 'webmotors']);

Route::get('/revenda-mais', [\App\Http\Controllers\VeiculoController::class, 'revendaMais']);
