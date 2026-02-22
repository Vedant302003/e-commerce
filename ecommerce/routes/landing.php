<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.home');
});

Route::get('/shop', function () {
    return view('landing.shop');
});

Route::get('/product', function () {
    return view('landing.product');
});

Route::get('/wishlist', function () {
    return view('landing.wishlist');
});

Route::get('/contact', function () {
    return view('landing.contact');
});
