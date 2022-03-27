<?php

namespace App\Cryptos\Coingecko;

use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyConversion;
use Carbon\CarbonPeriod;
use GuzzleHttp\Exception\RequestException;
use function now;

class HistoricalConversionRateFetcher
{
    protected array $fiats;
    protected CoingeckoAPI $api;
    protected $logger;


    public function __construct()
    {
        $this->fiats = $this->getFiatColumnNames();
        $this->api = CoingeckoAPI::make();
    }


    public static function make(): static
    {
        return new static();
    }


    public function fetchCoin(CryptoCurrency $currency, string $startDate, string $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);
        $counter = 0;
        $commit = [];

        foreach ($period as $date) {
            $counter++;
            $date = $date->format('Y-m-d');
            $data = $this->getApiData($currency, $date);

            if ($data) {
                $commit[] = $data;
            }

            if ($commit && (count($commit) > 30 || $counter == $period->count())) {
                CryptoCurrencyConversion::upsert(
                    $commit,
                    ["crypto_currency_id", "price_date"]
                );
                $currency->update(["fetched_history_date" => $date]);
                $commit = [];
            }
        }
    }


    private function getApiData(CryptoCurrency $currency, string $date): array
    {
        try {
            $data = $this->api->coinHistory($currency->coingecko_id, $date);
        } catch (RequestException $exception) {
            $retryAfter = $exception->getResponse()->getHeader("Retry-After")[0] + 1;
            $this->log("Getting API request limit for coin ".$currency->short_name." date $date. Will retry after $retryAfter seconds: ".now()->addSeconds($retryAfter)->format("H:i:s"));
            sleep($retryAfter);
            $data = $this->api->coinHistory($currency->coingecko_id, $date);
        }
        $data = $data["market_data"]["current_price"] ?? [];

        return $data ? $this->formatResult($data, $currency, $date) : [];
    }


    private function formatResult(array $conversions, CryptoCurrency $currency, string $date): array
    {
        $result = [];

        foreach ($this->fiats as $fiat) {
            $result[$fiat] = $conversions[substr($fiat, -3)] ?? null;
        }

        $result["crypto_currency_id"] = $currency->id;
        $result["price_date"] = $date;

        return $result;
    }


    private function getFiatColumnNames(): array
    {
        $array = CryptoCurrencyConversion::getFiatCurrencies();

        foreach ($array as &$fiat) {
            $fiat = "currency_".$fiat;
        }

        return $array;
    }


    public function setLogger(callable $logger): static
    {
        $this->logger = $logger;

        return $this;
    }


    private function log(string $msg): static
    {
        if(is_callable($this->logger)) {
            call_user_func($this->logger, $msg);
        }
        else {
            \Log::info($msg);
        }

        return $this;
    }
}