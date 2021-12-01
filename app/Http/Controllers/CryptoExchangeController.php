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

        if($exchangeAccount->credentials) {
            $driverClass = $exchangeAccount->cryptoExchange->driver;
            try {
                $driver = $driverClass::make($exchangeAccount)->connect();

                if($data = $driver->account()->getAll()) {
                    $data =  $data["data"];
                }
            }
            catch (\Exception $e) {
                $error = json_decode($e->getMessage())->msg;
            }
        }

        return view("pages.customer.crypto-exchange.show", [
            "exchangeAccount" => $exchangeAccount,
            "data" => $data,
            "error" => $error
        ]);
    }

    public function edit(CryptoExchange $exchange)
    {

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
