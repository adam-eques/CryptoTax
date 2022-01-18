<?php

namespace Database\Seeders;

use App\Models\CryptoCurrency;
use Illuminate\Database\Seeder;

class CryptoCurrencySeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'name' => "Bitcoin",
                'short_name' => "BTC",
            ],
            [
                'name' => "Ethereum",
                'short_name' => "ETH",
            ],
            [
                'name' => "Tether",
                'short_name' => "USDT",
            ],
            [
                'name' => "BNB",
                'short_name' => "BNB",
            ],
            [
                'name' => "Cardano",
                'short_name' => "ADA",
            ],
            [
                'name' => "USD Coin",
                'short_name' => "USDC",
            ],
            [
                'name' => "Solana",
                'short_name' => "SOL",
            ],
            [
                'name' => "XRP",
                'short_name' => "XRP",
            ],
            [
                'name' => "Terra",
                'short_name' => "LUNA",
            ],
            [
                'name' => "Polkadot",
                'short_name' => "DOT",
            ],
            [
                'name' => "governance ZIL",
                'short_name' => "GZIL",
            ],
            [
                'name' => "Proof Of Liquidity",
                'short_name' => "POL",
            ]
        ])->each(function($data){
            if(!CryptoCurrency::query()->where("short_name", $data["short_name"])->exists()) {
                CryptoCurrency::make($data)->save();
            }
        });
    }
}
