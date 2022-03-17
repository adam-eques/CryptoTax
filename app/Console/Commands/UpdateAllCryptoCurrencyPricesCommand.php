<?php

namespace App\Console\Commands;

use App\Models\CryptoCurrency;
use Illuminate\Console\Command;

class UpdateAllCryptoCurrencyPricesCommand extends Command
{
    protected $signature = 'crypto:update-prices';
    protected $description = 'Command description';


    public function handle()
    {
        CryptoCurrency::updateAllRowsFromApi();
    }
}
