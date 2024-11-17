<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return 'Profile page';
})->name('profile');

Route::get('/hallo', function() {
    return redirect()->route('profile');
});

// Defining fallback routes;
Route::fallback( function () {
    return '404';
});