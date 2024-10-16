<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
})->middleware('auth:sanctum');

// User Authentication

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:sanctum');

// Products

Route::get('/products', 'App\Http\Controllers\ProductController@index')->middleware('auth:sanctum');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->middleware('auth:sanctum');
Route::post('/products', 'App\Http\Controllers\ProductController@store')->middleware('auth:sanctum');
Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update')->middleware('auth:sanctum');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy')->middleware('auth:sanctum');
