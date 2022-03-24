<?php

namespace App\Console\Commands;

use App\Cryptos\CoingeckoAPI;
use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyConversion;
use Carbon\CarbonPeriod;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;

class CoingeckoHistoricalDataCommand extends Command
{
    protected $signature = 'coingecko:historical-data {currencyShortCode} {startDate} {endDate?}';
    protected $description = 'Command description';
    protected CoingeckoAPI $api;
    protected array $fiats;


    public function handle()
    {
        // Get input
        $currencyShortCode = $this->argument("currencyShortCode");
        $startDate = $this->argument("startDate", "2020-01-01");
        $endDate = $this->argument("endDate", now()->format("Y-m-d"));

        // Prepare everything
        $currency = CryptoCurrency::findByShortName($currencyShortCode);
        if (! $currency) {
            throw new \Exception("Unknown shortcode ".$currencyShortCode);
        }
        $this->fiats = $this->getFiatColumnNames();
        $this->api = CoingeckoAPI::make();

        // Fetch single coin
        $this->fetchCoin($currency, $startDate, $endDate);

        return static::SUCCESS;
    }


    private function fetchCoin(CryptoCurrency $currency, string $startDate, string $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);
        $counter = 0;
        $commit = [];

        foreach ($period as $date) {
            $counter++;
            $date = $date->format('Y-m-d');
            $data = $this->getApiData($currency, $date);

            if($data) {
                $commit[] = $data;
            }

            if($commit && (count($commit) > 30 || $counter == $period->count())) {
                CryptoCurrencyConversion::upsert(
                    $commit,
                    ["crypto_currency_id", "price_date"]
                );
                $commit = [];
            }
        }
    }


    private function getApiData(CryptoCurrency$currency, string $date): array
    {
        try {
            $data = $this->api->coinHistory($currency->coingecko_id, $date);
        }
        catch(RequestException $exception) {
            $retryAfter = $exception->getResponse()->getHeader("Retry-After")[0] + 1;
            $this->line("Getting API request limit for date $date. Will retry after $retryAfter seconds: " . now()->addSeconds($retryAfter)->format("H:i:s"));
            sleep($retryAfter);
            $data = $this->api->coinHistory($currency->coingecko_id, $date);
        }
        $data = $data["market_data"]["current_price"] ?? [];

        return $data ? $this->formatResult($data, $currency, $date) : [];
    }


    private function formatResult(array $conversions, CryptoCurrency $currency, string $date): array
    {
        $result = [];

        foreach($this->fiats AS $fiat) {
            $result[$fiat] = $conversions[substr($fiat, -3)] ?? null;
        }

        $result["crypto_currency_id"] = $currency->id;
        $result["price_date"] = $date;

        return $result;
    }


    private function getFiatColumnNames(): array
    {
        $array = CryptoCurrencyConversion::getFiatCurrencies();

        foreach($array AS &$fiat) {
            $fiat = "currency_" . $fiat;
        }

        return $array;
    }
}
