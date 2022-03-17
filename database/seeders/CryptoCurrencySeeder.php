<?php

namespace Database\Seeders;

use App\Models\CoingeckoSupportedVsCurrencies;
use App\Models\CryptoCurrency;
use Illuminate\Database\Seeder;

class CryptoCurrencySeeder extends Seeder
{
    public function run()
    {
        // Get all currencies
        CryptoCurrency::updateListFromApi();

        // Get all vs currencies
        CoingeckoSupportedVsCurrencies::updateFromApi();

        // Get all current prices
        CryptoCurrency::updateAllRowsFromApi();
    }
}
