<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home'); // проста головна

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard'); // user dashboard
});
