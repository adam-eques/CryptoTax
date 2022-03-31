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
        ini_set('memory_limit', '-1');

        // Clear data
        CryptoCurrency::query()->truncate();
        CryptoCurrencyConversion::query()->truncate();
        CoingeckoSupportedVsCurrencies::query()->truncate();

        // Import from SQL files
        $path = base_path('/database/sql/');
        $db = [
            'username' => config("database.connections.mysql.username"),
            'password' => config("database.connections.mysql.password"),
            'host' => config("database.connections.mysql.host"),
            'database' => config("database.connections.mysql.database")
        ];
        $files = ["coingecko_supported_vs_currencies.sql", "crypto_currency_conversions.sql", "crypto_currencies.sql"];

        // Run queries
        foreach($files AS $file) {
            exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < " . $path . $file);
        }
    }
}
