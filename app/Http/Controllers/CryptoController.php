<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyConversion;

class CryptoController extends Controller
{
    public function currency_stats()
    {
        $coins = CryptoCurrency::query()
            ->where("fetch_history", true)
            ->orderBy("market_cap", "DESC")
            ->get();
        $today = now()->format("Y-m-d");

        return view("admin.crypto.currency-stats", [
            "coins" => $coins,
            "today" => $today
        ]);
    }
}
