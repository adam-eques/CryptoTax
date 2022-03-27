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
        set_time_limit(5000);
        $api = \App\Cryptos\Coingecko\CoingeckoAPI::make();
        $data = $api->client->coins()->getMarkets("usd", [
            "per_page" => 300,
        ]);

        foreach ($data as $row) {
            $coin = CryptoCurrency::findByShortName($row["symbol"]);

            // Check if we get price history
            $coinHistoryData = $api->coinHistory($coin->coingecko_id, now()->subDay()->format("Y-m-d"));
            if(!isset($coinHistoryData["market_data"]["current_price"]) || !$coinHistoryData["market_data"]["current_price"]) {
                continue;
            }

            // Update
            $update = [
                "market_cap" => $row["market_cap"],
            ];

            if(!$coin->fetched_history_date) {
                $update["fetched_history_date"] = "2019-12-31";
            }

            $coin->update($update);
        }
    }
}
