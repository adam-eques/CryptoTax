<?php

namespace Database\Seeders;

// Exchange drivers
// use App\Cryptos\Drivers\CcxtDriver;
use App\Cryptos\Drivers\BinanceDriver;
use App\Cryptos\Drivers\HitBTCDriver;
use App\Cryptos\Drivers\KucoinDriver;
use App\Cryptos\Drivers\CryptocomDriver;
use App\Cryptos\Drivers\HuobiDriver;

// Blockchain drivers
use App\Cryptos\Drivers\CryptoapisDriver;
use App\Cryptos\Drivers\CronosDriver;

use App\Models\CryptoSource;
use Illuminate\Database\Seeder;

class CryptoSourceSeeder extends Seeder
{
    public function run()
    {
        CryptoSource::truncate();
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
                'name' => "Binance",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_EXCHANGE,
                'driver' => BinanceDriver::class,
                'active' => false
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM,
                'name' => "Ethereum Blockchain",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN,
                'name' => "Litecoin Blockchain",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ], [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_BITCOIN,
                'name' => "Bitcoin",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_BITCOINCASH,
                'name' => "Bitcoin Cash",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_DASH,
                'name' => "Dash",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_DOGE,
                'name' => "Doge",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUMCLASSIC,
                'name' => "Ethereum classic",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_ZCASH,
                'name' => "Zcash",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CryptoapisDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_BLOCKCHAIN_CRONOS,
                'name' => "Cronos",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_BLOCKCHAIN,
                'driver' => CronosDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_EXCHANGE_CRYPTOCOM,
                'name' => "Cryptocom",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_EXCHANGE,
                'driver' => CryptocomDriver::class,
                'active' => true
            ],
            [
                'id' => CryptoSource::SOURCE_EXCHANGE_HUOBI,
                'name' => "Huobi",
                'icon' => '',
                'type' => CryptoSource::SOURCE_TYPE_EXCHANGE,
                'driver' => HuobiDriver::class,
                'active' => true
            ],
        ])->each(function($data){
            CryptoSource::firstOrCreate([
                "id" => $data["id"]
            ], $data);
        });
    }
}
