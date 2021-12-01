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
        $driverClass = $exchangeAccount->cryptoExchange->driver;
        $driver = $driverClass::make($exchangeAccount)->connect();

        if($data = $driver->account()->getAll()) {
            $data =  $data["data"];
        }

        return view("pages.customer.crypto-exchange.show", [
            "data" => $data
        ]);
    }

    public function edit(CryptoExchange $exchange)
    {
        $exchangeAccount = $this->getAccount($exchange);

        return view("pages.customer.crypto-exchange.edit", [
            "exchangeAccount" => $exchangeAccount
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
        return request()->user()->cryptoExchangeAccounts()->whereBelongsTo($exchange)->first();
    }
}
