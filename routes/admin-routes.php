<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

//Route::middleware(['auth:admin', 'verified'])->middleware("user-account-type:admin")->name("admin.")->prefix("admin")->group(function(){
Route::redirect("/", "/admin/dashboard");

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Users
\App\Http\Livewire\Admin\Customer\CustomerResource::routes();
\App\Http\Livewire\Admin\TaxAdvisor\TaxAdvisorResource::routes();
\App\Http\Livewire\Admin\AffiliateUser\AffiliateUserResource::routes();
\App\Http\Livewire\Admin\BackendUser\BackendUserResource::routes();

// Other resources
\App\Http\Livewire\Admin\CryptoExchange\CryptoExchangeResource::routes();
\App\Http\Livewire\Admin\UserAccountType\UserAccountTypeResource::routes();
\App\Http\Livewire\Admin\UserCreditAction\UserCreditActionResource::routes();
\App\Http\Livewire\Admin\UserCreditLog\UserCreditLogResource::routes();

// Specials
Route::view('/todo', 'errors.todo')->name('todo');

// Just for testing/dev
Route::prefix("dev")->name("dev.")->group(function(){
    Route::get("index", [Controllers\Admin\DevController::class, "index"])->name("index");
    Route::get("icons", [Controllers\Admin\DevController::class, "icons"])->name("icons");
});
