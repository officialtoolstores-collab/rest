<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillingController;


	Route::view('/', 'welcome')->name('home'); // проста головна

	Route::middleware('auth')->group(function () {
	    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	    // заглушка для поповнення — пізніше підключимо Fondy/LiqPay
	        Route::get('/billing/topup', [BillingController::class, 'create'])->name('billing.topup');
						
	});

	// Профіль (окрема наша сторінка)
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.page');
    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');