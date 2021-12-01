<?php

namespace App\Http\Controllers;

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

    public function show(CryptoExchangeAccount $exchangeAccount)
    {
        /**
         * @var \App\CryptoExchangeDrivers\Driver $driverClass
         */
        $driverClass = $exchangeAccount->cryptoExchange->driver;
        $driver = $driverClass::make($exchangeAccount)->connect();

        if($data = $driver->account()->getAll()) {
            $data =  $data["data"];
        }

        return view("pages.customer.crypto-exchange.show", [
            "data" => $data
        ]);
    }

    public function edit(CryptoExchangeAccount $exchangeAccount)
    {
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
}
