<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->middleware('auth:web')->group(function () {

    Route::get('/dashboard', function () {
        return 'user dashboard';
    })->name('dashboard');


    
});
