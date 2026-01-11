<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::get('/products', function () {
//     return view('product');
// });

Route::get('/products', [ProductController::class, 'return_listing']);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('products/{id}', [ProductController::class, 'return_viewpage']);
