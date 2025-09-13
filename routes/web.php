<?php

use Illuminate\Support\Facades\Route;

	Route::view('/', 'welcome')->name('home'); // проста головна

	Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
	});

	// Профіль (окрема наша сторінка)
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.page');
    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');