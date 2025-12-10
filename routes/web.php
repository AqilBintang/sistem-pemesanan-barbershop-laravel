<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.dashboard');
});

Route::get('/layanan', function () {
    return view('users.layanan');
});

Route::get('/booking', function () {
    return view('users.booking');
});

Route::get('/history', function () {
    return view('users.history');
});

Route::get('/profile', function () {
    return view('users.profile');
});
