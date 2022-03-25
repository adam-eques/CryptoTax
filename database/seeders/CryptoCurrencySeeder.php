<?php

namespace Database\Seeders;

use App\Models\CoingeckoSupportedVsCurrencies;
use App\Models\CryptoCurrency;
use App\Models\CryptoCurrencyConversion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CryptoCurrencySeeder extends Seeder
{
    public function run()
    {
        // Clear data
        CryptoCurrency::query()->truncate();
        CryptoCurrencyConversion::query()->truncate();

        // Get all vs currencies
        CoingeckoSupportedVsCurrencies::updateFromApi();

        // Import from SQL
        DB::unprepared(file_get_contents(__DIR__ . "/../sql/crypto_currencies.sql"));
        DB::unprepared(file_get_contents(__DIR__ . "/../sql/crypto_currency_conversions.sql"));
    }
}
