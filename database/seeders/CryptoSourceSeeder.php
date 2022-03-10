<?php

namespace Database\Seeders;

use App\Blockchains\CryptoApisDriver;
use App\CryptoExchangeDrivers\HitBTCDriver;
use App\CryptoExchangeDrivers\KucoinDriver;
use App\Models\CryptoSource;
use Illuminate\Database\Seeder;

class CryptoSourceSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'id' => CryptoSource::SOURCE_EXCHANGE_KUCOIN,
                'name' => "Kucoin",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_EXCHANGE,
                'driver' => KucoinDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_EXCHANGE_HITBTC,
                'name' => "HitBTC",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_EXCHANGE,
                'driver' => HitBTCDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_EXCHANGE_BINANCE,
                'name' => "HitBTC",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_EXCHANGE,
                'driver' => HitBTCDriver::class,
                'active' => false
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM,
                'name' => "Ethereum Blockchain",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoApisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN,
                'name' => "Litecoin Blockchain",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoApisDriver::class,
                'active' => true
            ],
        ])->each(function($data){
            CryptoSource::firstOrCreate([
                "id" => $data["id"]
            ], $data);
        });
    }
}
