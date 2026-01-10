<?php

use App\Http\Controllers\ProductListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::get('/products', function () {
//     return view('product');
// });

Route::get('/products', [ProductListController::class, 'return_listing' ]);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
});
