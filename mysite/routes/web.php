<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::match(['get','post'],'/login', function () {
    return view('login');
});

Route::match(['get','post'],'/registration', function () {
    return view('login');
});

Route::get('/users/get', function () {
    return view('login');
});

Route::get('/token/get', function () {
    return view('login');
});

Route::get('/logout', function () {
    return view('login');
});