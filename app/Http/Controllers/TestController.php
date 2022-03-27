<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrency;

class TestController extends Controller
{
    public function currencyConversion()
    {
        $currency = \App\Models\CryptoCurrency::findByShortName("BTC");

        dd(
        // Get latest
            $currency->convertTo(1, "USD"),
            // With timestamp/date
            $currency->convertTo(1, "USD", 1648378197),
            $currency->convertTo(1, "USD", "2022-03-01"),
            $currency->convertTo(1, "USD", now()),
            $currency->convertTo(1, "USD", now()->subYears(1)),
        );
    }


    public function coingeckoTestApi()
    {
        $api = \App\Cryptos\Coingecko\CoingeckoAPI::make();

        dd(
            $api->ping(),
            $api->simple()->getPrice("litecoin,eth,ethereum-wormhole,crypto-com-chain", "EUR,USD"),
        );
    }


    public function coingeckoGetCoinMarkets()
    {
        $api = \App\Cryptos\Coingecko\CoingeckoAPI::make();
        $data = $api->client->coins()->getMarkets("usd", [
            "per_page" => 250,
        ]);

        foreach ($data as $row) {
            $coin = CryptoCurrency::findByShortName($row["symbol"]);
            $coin->update([
                "market_cap" => $row["market_cap"],
            ]);
        }

        dd($data);
    }
}
