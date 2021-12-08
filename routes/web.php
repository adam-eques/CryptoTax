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


// Only for UserAccountType::TYPE_ADMIN
Route::middleware(['auth:sanctum', 'verified'])->middleware("user-account-type:admin")->name("admin.")->group(function(){
    Route::get("/test", [\App\Http\Controllers\TestController::class, "index"]);
});


// Only for UserAccountType::TYPE_CUSTOMER
Route::middleware(['auth:sanctum', 'verified'])->middleware("user-account-type:customer")->name("customer.")->group(function(){
    // TODO routes
    Route::view('/wallet', 'pages.customer.wallets.index')->name('wallet');
    Route::view('/portfolio', 'errors.todo')->name('portfolio');
    Route::view('/taxes', 'errors.todo')->name('taxes');
    Route::view('/advisor', 'errors.todo')->name('advisor');
    Route::view('/services', 'errors.todo')->name('services');

    // Transactions
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])
        ->name('transactions');

    // Specials
    Route::view('/wallet/new', 'pages.customer.wallets.new')->name('wallet.new');
    Route::view('/taxes/tax-loss-harvesting', 'pages.customer.taxes.tax-loss-harvesting')->name('taxes.tax-loss-harvesting');
    Route::view('/taxes/tax-saving-opportunities', 'pages.customer.taxes.tax-saving-opportunities')->name('taxes.tax-saving-opportunities');
});


// Only for UserAccountType::TYPE_TAX_ADVISOR
Route::middleware(['auth:sanctum', 'verified'])->middleware("user-account-type:tax-advisor")->name("tax-advisor.")->group(function(){

});


// UserAccountType agnostic
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // Redirect / to dashboard
    Route::redirect("/", "/dashboard");

    // Specials
    Route::view('/todo', 'errors.todo')->name('todo');
});
