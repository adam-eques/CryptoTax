<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrency;

class TestController extends Controller
{
    public function coinStats()
    {
        $coins = CryptoCurrency::query()
            ->whereNotNull("fetched_history_date")
            ->orderBy("market_cap", "DESC")
            ->get();
        $today = now()->format("Y-m-d");
        $counter = 1;

        echo "<style>tr:nth-child(even) {background-color: #f2f2f2;} tr:hover { background-color: #FFFF99}</style>";
        echo "<table border='1' style='border-collapse: collapse' cellpadding='3'>";
        echo "<tr>
                <th>#</th>
                <th>ID</th>
                <th>Coin</th>
                <th>Coin-Short</th>
                <th>CoinGeckoId</th>
                <th>Market cap</th>
                <th>Latest Fetched History</th>
                <th>Latest Price Date</th>
                <th>Oldest Price Date</th>
                <th>Price Row Count</th>
            </tr>";
        foreach($coins AS $coin) {
            $latest = $coin->cryptoCurrencyConversions()->orderBy("price_date", "DESC")->first();
            $oldest = $coin->cryptoCurrencyConversions()->orderBy("price_date", "ASC")->first();
            $priceRowCount = $coin->cryptoCurrencyConversions()->count();

            echo "<tr>";
            echo "<td style='text-align: right'>" . $counter++ ."</td>";
            echo "<td style='text-align: right'>" . $coin->id ."</td>";
            echo "<td>" . $coin->name ."</td>";
            echo "<td>" . $coin->short_name ."</td>";
            echo "<td>" . $coin->coingecko_id ."</td>";
            echo "<td style='text-align: right'>" . number_format($coin->market_cap) ."</td>";
            echo "<td>";
            echo $coin->fetched_history_date;
            if($today != $coin->fetched_history_date) echo " *";
            echo "</td>";
            echo "<td>" . optional($latest)->price_date ."</td>";
            echo "<td>" . optional($oldest)->price_date ."</td>";
            echo "<td>" . $priceRowCount ."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }


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
