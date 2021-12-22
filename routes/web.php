<?php

use App\Http\Controllers;
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
Route::middleware(['auth:sanctum', 'verified'])->middleware("user-account-type:admin")->name("admin.")->prefix("admin")->group(function(){
    // Resources: User
    Route::resource("customers", Controllers\Admin\CustomerController::class)->parameters([
        'customers' => 'user'
    ]);
    Route::resource("backenduser", Controllers\Admin\BackendUserController::class)->parameters([
        'backenduser' => 'user'
    ]);
    Route::resource("tax-advisors", Controllers\Admin\TaxAdvisorsController::class)->parameters([
        'tax-advisors' => 'user'
    ]);

    //// Other resoureces
    //Route::resource("api", Controllers\Admin\ApiController::class);
    \App\Resources\CryptoExchangeResource::routes();
});


// Only for UserAccountType::TYPE_CUSTOMER
Route::middleware(['auth:sanctum', 'verified'])->middleware("user-account-type:customer")->name("customer.")->group(function(){
    // TODO routes
    Route::view('/wallet', 'pages.customer.wallets.index')->name('wallet');
    Route::view('/portfolio', 'pages.customer.portfolio.portfolio')->name('portfolio');
    Route::view('/taxes', 'pages.customer.taxes.taxes')->name('taxes');
    Route::view('/advisor', 'pages.customer.advisor.advisor')->name('advisor');
    Route::view('/services', 'pages.customer.service.service')->name('services');

    // Transactions
    Route::get('/transactions', [Controllers\Customer\TransactionController::class, 'index'])
        ->name('transactions');

    // Specials
    Route::view('/wallet/new', 'pages.customer.wallets.new')->name('wallet.new');
    Route::view('/taxes/tax-loss-harvesting', 'pages.customer.taxes.tax-loss-harvesting')->name('taxes.tax-loss-harvesting');
    Route::view('/taxes/tax-saving-opportunities', 'pages.customer.taxes.tax-saving-opportunities')->name('taxes.tax-saving-opportunities');

    //Advisor
    Route::view('/advisor/detail', 'pages.customer.advisor.advisor-detail')->name('advisor.detail');

    //Invite Friends
    Route::view('/invite', 'pages.customer.invite.invite')->name('invite');
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

    // Just for testing/dev
    Route::prefix("dev")->name("dev.")->group(function(){
        Route::get("index", [Controllers\Admin\DevController::class, "index"])->name("index");
        Route::get("icons", [Controllers\Admin\DevController::class, "icons"])->name("icons");
    });
});
