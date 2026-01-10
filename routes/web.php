<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::get('/products', function () {
//     return view('product');
// });

Route::get('/products', [ProductsController::class, 'return_listing']);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('products/{id}', [ProductsController::class, 'return_viewpage']);
