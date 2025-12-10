<?php

use Illuminate\Support\Facades\Route;

// Main route - New Figma Design
Route::get('/', function () {
    return view('barbershop.index');
});

// Original routes (backup)
Route::get('/old-dashboard', function () {
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

// New Barbershop SPA routes
Route::get('/barbershop', function () {
    return view('barbershop.index');
});

Route::get('/services', function () {
    return view('barbershop.index');
});

Route::get('/barbers', function () {
    return view('barbershop.index');
});

Route::get('/confirmation', function () {
    return view('barbershop.index');
});

Route::get('/notifications', function () {
    return view('barbershop.index');
});

Route::get('/admin', function () {
    return view('barbershop.index');
});
