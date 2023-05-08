<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/data', [DataController::class, 'index']);
Route::get('/api/data', 'App\Http\Controllers\DataController@index');
