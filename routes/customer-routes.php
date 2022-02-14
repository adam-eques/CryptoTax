<?php

use App\Http\Controllers;
use App\Http\Livewire;
use Illuminate\Support\Facades\Route;


Route::middleware('customer-setup')->group(function(){
    Route::get('dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // TODO routes
    Route::get('account', \App\Http\Livewire\Customer\Account\Accounts::class)->name('account');
    Route::view('portfolio', 'pages.customer.portfolio.portfolio')->name('portfolio');
    Route::view('taxes', 'pages.customer.taxes.taxes')->name('taxes');
    Route::view('advisor', 'pages.customer.advisor.advisor')->name('advisor');
    Route::view('services', 'pages.customer.service.service')->name('services');

    // Transactions
    Route::view('transactions', 'pages.customer.transactions.transactions')->name('transactions');

    // Specials]
    Route::view('account/new', 'pages.customer.account.new')->name('account.new');
    Route::view('taxes/tax-loss-harvesting', 'pages.customer.taxes.tax-loss-harvesting')->name('taxes.tax-loss-harvesting');
    Route::view('taxes/tax-saving-opportunities', 'pages.customer.taxes.tax-saving-opportunities')->name('taxes.tax-saving-opportunities');

    // Advisor
    Route::get('advisor/{id?}', \App\Http\Livewire\Customer\Advisor\Detail::class)->name('advisor.detail');

    // Invite Friends
    Route::view('invite', 'pages.customer.invite.invite')->name('invite');

    // Test only
    Route::prefix("test")->as("test.")->group(function() {
        Route::get('transactions', [Controllers\Customer\TransactionController::class, 'index'])
            ->name('transactions');

        // Test: buy credits
        Route::any("buy-credits", Livewire\Customer\Test\BuyCredit::class);
    });
});

// Settings
Route::redirect('user-setting', 'user-setting/profile');
Route::get('user-setting/{category?}', function($category = "profile"){
    return view('pages.user-setting.index', [
        "category" => $category
    ]);
})->name('user-setting');

//Message
Route::view('message', 'pages.user-setting.message')->name('message');

// Specials
Route::view('/todo', 'errors.todo')->name('todo');
