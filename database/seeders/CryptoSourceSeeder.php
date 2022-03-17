<?php

namespace Database\Seeders;

use App\Cryptos\Drivers\CryptoapisDriver;
use App\Cryptos\Drivers\CcxtDriver;
use App\Cryptos\Drivers\HitBTCDriver;
use App\Cryptos\Drivers\KucoinDriver;
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
                'name' => "Binance",
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
        ])->each(function($data){
            CryptoSource::firstOrCreate([
                "id" => $data["id"]
            ], $data);
        });
    }
}
