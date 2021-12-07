<?php

namespace App\Http\Controllers;

use App\Models\CryptoExchange;
use App\Models\CryptoExchangeAccount;
use Illuminate\Http\Request;

class CryptoExchangeController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CryptoExchange $exchange)
    {
        /**
         * @var \App\CryptoExchangeDrivers\Driver $driverClass
         */
        $exchangeAccount = $this->getAccount($exchange);
        $data = [];
        $error = "";
        $driverClass = $exchangeAccount->cryptoExchange->driver;
        $driver = $driverClass::make($exchangeAccount);


        // Check for credentials
        if(!$driver->checkRequiredCredentials()) {
            return redirect(route("customer.crypto-exchange.edit", [
                "exchange" => $exchange
            ]))->with("error", __("Please provide all credentials"));
        }


        $driver->updateTransactions();
        exit;

        //dd(
        //    $driver->fetchTransactions()
        //);


        return view("pages.customer.crypto-exchange.show", [
            "name" => $exchangeAccount->cryptoExchange->name,
            "exchangeAccount" => $exchangeAccount,
            "data" => $data,
            "error" => $error
        ]);
    }

    /**
     * @param \App\Models\CryptoExchange $exchange
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(CryptoExchange $exchange)
    {
        $exchangeAccount = $this->getAccount($exchange);
        $error = "";

        return view("pages.customer.crypto-exchange.edit", [
            "name" => $exchangeAccount->cryptoExchange->name,
            "exchangeAccount" => $exchangeAccount,
            "error" => $error
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


    /**
     * @param \App\Models\CryptoExchange $exchange
     * @return \App\Models\CryptoExchangeAccount|null
     */
    private function getAccount(CryptoExchange $exchange): ?CryptoExchangeAccount
    {
        $user = request()->user();
        $account = $user->cryptoExchangeAccounts()->whereBelongsTo($exchange)->first();

        // Just for presentation purpose
        if(!$account) {
            $account = new CryptoExchangeAccount();
            $account->crypto_exchange_id = $exchange->id;
            $account->user_id = $user->id;
            $account->credentials = [];
            $account->save();
        }

        return $account;
    }
}
