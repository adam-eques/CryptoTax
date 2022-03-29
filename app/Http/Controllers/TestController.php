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


    /**
     * Call : (new \App\Http\Controllers\TestController())->coingeckoGetCoinMarkets(10, 1);
     *
     * Latest Call on PROD:
     * 2022-03-29 10:50 Vienna (new \App\Http\Controllers\TestController())->coingeckoGetCoinMarkets(50, 11);
     *
     * @param int $perPage
     * @param int $page
     * @return void
     * @throws \Exception
     */
    public function coingeckoGetCoinMarkets(int $perPage = 300, int $page = 1)
    {
        set_time_limit(5000);
        $api = \App\Cryptos\Coingecko\CoingeckoAPI::make();
        $data = $api->client->coins()->getMarkets("usd", [
            "per_page" => $perPage,
            "page" => $page,
        ]);

        foreach ($data as $row) {
            $symbol = $row["symbol"];
            $coin = CryptoCurrency::findByShortName($symbol);
            $update = [
                "market_cap" => $row["market_cap"],
            ];

            // Check if we get price history
            $coinHistoryData = $api->coinHistory($coin->coingecko_id, now()->subDay()->format("Y-m-d"));
            if(isset($coinHistoryData["market_data"]["current_price"]) && $coinHistoryData["market_data"]["current_price"]) {
                $update["fetch_history"] = true;
            }

            // Update
            $coin->update($update);
            dump(
                "Updating $symbol setting market_cap to " . number_format($row["market_cap"], 0, ".", ",") .
                (isset($update["fetch_history"]) ? " and setting fetch_history" : "")
            );
        }
    }
}
