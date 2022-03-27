<?php

namespace App\Console\Commands\Coingecko;

use App\Models\CryptoCurrency;
use Illuminate\Console\Command;

class CoingeckoUpdateAllRealtimePrices extends Command
{
    protected $signature = 'coingecko:update-realtime-prices';
    protected $description = 'Command description';


    public function handle()
    {
        // IMPORTANT: This command is currently not used to save the API Request limits of Coingecko, but prepared for later
        // CryptoCurrency::updateAllRowsFromApi();
    }
}
