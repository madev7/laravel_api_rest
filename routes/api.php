<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show');
Route::post('/products', 'App\Http\Controllers\ProductController@store');
Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy');
