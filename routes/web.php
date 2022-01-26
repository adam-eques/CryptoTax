<?php

use App\Http\Controllers\Customer\SocialiteController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::view('/', 'pages.index')->name('index');


// Auth routes for socialize
Route::get('auth/facebook', [SocialiteController::class, 'facebookRedirect'])->name("auth.facebook");
Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback']);
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name("auth.google");
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
