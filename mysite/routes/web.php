<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/registration', function () {
    return view('login');
});

Route::get('/users/get', function () {
    return view('login');
});

Route::get('/token/get', function () {
    return view('login');
});

// Route::get('/logout', function () {
//     return view('login');
// });