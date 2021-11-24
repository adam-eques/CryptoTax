<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // TODO routes
    Route::view('/todo', 'errors.todo')->name('todo');
    Route::view('/wallet', 'pages.wallets.index')->name('wallet');
    Route::view('/portfolio', 'errors.todo')->name('portfolio');
    Route::view('/taxes', 'errors.todo')->name('taxes');
    Route::view('/advisor', 'errors.todo')->name('advisor');
    Route::view('/services', 'errors.todo')->name('services');

    // Specials
    Route::view('/wallet/new', 'pages.wallets.new')->name('wallet.new');
    Route::view('/taxes/tax-loss-harvesting', 'pages.taxes.tax-loss-harvesting')->name('taxes.tax-loss-harvesting');
});
