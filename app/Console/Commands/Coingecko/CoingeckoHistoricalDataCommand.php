<?php

namespace App\Console\Commands\Coingecko;

use App\Cryptos\Coingecko\HistoricalConversionRateFetcher;
use App\Models\CryptoCurrency;
use Carbon\Carbon;
use Illuminate\Console\Command;
use function now;

class CoingeckoHistoricalDataCommand extends Command
{
    protected $signature = 'coingecko:historical-data {startDate?} {endDate?} {--silent} {--coins=} {--all} ';
    protected $description = 'Fetches the coingecko api for historical price data.';
    private HistoricalConversionRateFetcher $fetcher;

    public function handle()
    {
        // Get dates
        $startDate = $this->argument("startDate") ?: now()->format("Y-m-d");
        $endDate = $this->argument("endDate") ?: now()->format("Y-m-d");

        // Prepare everything
        date_default_timezone_set(config("app.timezone"));
        $this->fetcher = HistoricalConversionRateFetcher::make();
        $this->fetcher->setLogger([$this, "line"]);

        // Shortcodes or all
        if($this->option("all")) {
            // Prepare queries
            $currencies = CryptoCurrency::query()
                ->whereNotNull("fetched_history_date")
                ->where("fetched_history_date", "<", $startDate)
                ->get(["id", "short_name", "coingecko_id", "fetched_history_date"]);

            foreach ($currencies as $currency) {
                $newStartDate = Carbon::make($currency->fetched_history_date)->addDays(1)->format("Y-m-d");
                $this->fetchCoin($currency, $newStartDate, $endDate);
            }
        }
        else if($currencyShortCodes = $this->option("coins")) {
            $currencies = $this->getCurrencies($currencyShortCodes, $startDate);

            foreach ($currencies as $currency) {
                $this->fetchCoin($currency, $startDate, $endDate);
            }
        }
        else {
            $this->error("Need either --coins=ETH,BNB,.. OR --all option");

            return static::FAILURE;
        }

        return static::SUCCESS;
    }


    private function fetchCoin($currency, string $startDate, string $endDate)
    {
        $this->info("Starting to fetch ".$currency->short_name." for dates $startDate to $endDate at ".now()->format("H:i:s"));
        $this->fetcher->fetchCoin($currency, $startDate, $endDate);
    }


    /**
     * @param string $currencyShortCodes
     * @param string $startDate
     * @return CryptoCurrency[]
     * @throws \Exception
     */
    private function getCurrencies(string $currencyShortCodes, string $startDate): array
    {
        $currencyShortCodesArray = array_unique(explode(",", $currencyShortCodes));
        $currencies = [];

        foreach ($currencyShortCodesArray as $currencyShortCode) {
            $currency = CryptoCurrency::findByShortName($currencyShortCode);
            if (! $currency) {
                throw new \Exception("Unknown shortcode ".$currencyShortCode);
            }

            // Check if there is already data for it
            if ($currency->cryptoCurrencyConversions()->where("price_date", $startDate)->first()) {
                if ($this->option("silent") || $this->confirm("We have already conversions for currency ".$currency->short_name." for startdate $startDate. Skip this currency?", true)) {
                    continue;
                }
            }

            $currencies[] = $currency;
        }

        return $currencies;
    }
}
