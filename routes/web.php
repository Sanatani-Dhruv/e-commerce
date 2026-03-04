<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/services', function () {
    return view('index');
});

Route::get('/contact', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('index');
});
