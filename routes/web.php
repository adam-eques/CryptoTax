<?php

use App\Http\Controllers\Customer\SocialiteController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::view('/', 'pages.index')->name('index');

// Affilate Page
Route::view('/affiliate', 'pages.affiliate')->name('affiliate');

// Logout
Route::get('logout', function() {
    auth()->logout();

    return redirect(route("customer.dashboard"));
});


// Auth routes for socialize
Route::get('auth/facebook', [SocialiteController::class, 'facebookRedirect'])->name("auth.facebook");
Route::get('auth/facebook/callback', [SocialiteController::class, 'facebookCallback']);
Route::get('auth/google', [SocialiteController::class, 'googleRedirect'])->name("auth.google");
Route::get('auth/google/callback', [SocialiteController::class, 'googleCallback']);
