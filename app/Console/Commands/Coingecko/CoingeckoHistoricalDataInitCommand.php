<?php

namespace App\Console\Commands\Coingecko;

use App\Cryptos\Coingecko\HistoricalConversionRateFetcher;
use App\Models\CryptoCurrency;
use Carbon\Carbon;
use Illuminate\Console\Command;
use function now;

class CoingeckoHistoricalDataInitCommand extends Command
{
    protected $signature = 'coingecko:historical-data-init {--new-only}';
    protected $description = 'Fetches the coingecko api for historical price data for inital setup.';
    private HistoricalConversionRateFetcher $fetcher;

    public function handle()
    {
        // Prepare everything
        $oldestDate = "2020-01-01";
        $newestDate = now()->format("Y-m-d");
        date_default_timezone_set(config("app.timezone"));
        $this->fetcher = HistoricalConversionRateFetcher::make();
        $this->fetcher->setLogger([$this, "line"]);

        // Prepare queries
        $query = CryptoCurrency::query()
            ->where("fetch_history", true)
            ->where(function($q) use ($oldestDate){
                $q->where("fetched_history_date_from", ">", $oldestDate)
                    ->orWhereNull("fetched_history_date_from");
            })
            ->orderBy("market_cap", "DESC");
        if($this->option("new-only")) {
            $query->whereNull("fetched_history_date_till");
        }
        $currencies = $query
            ->get(["id", "short_name", "coingecko_id", "fetched_history_date_from", "fetched_history_date_till"]);

        foreach ($currencies as $currency) {
            $this->info("Starting to fetch ".$currency->short_name." for dates $newestDate to $oldestDate at ".now()->format("H:i:s"));
            if(!$currency->fetched_history_date_till) {
                $currency->update([
                    "fetched_history_date_till" => $newestDate
                ]);
            }
            $this->fetcher->fetchCoinReverse($currency, $newestDate, $oldestDate);
        }

        return static::SUCCESS;
    }
}
