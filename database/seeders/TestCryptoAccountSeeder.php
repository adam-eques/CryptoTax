<?php

namespace Database\Seeders;

use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestCryptoAccountSeeder extends Seeder
{
    public function run()
    {
        $user = User::query()->where("email", "customer@example.com")->first();

        // Kucoin
        $account = CryptoAccount::make([
            "crypto_source_id" => CryptoSource::SOURCE_EXCHANGE_KUCOIN,
            "user_id" => $user->id,
            "credentials" => [
                "apiKey" => "60042ffdad62470006b584d9",
                "secret" => "6588acc4-057a-43bb-9659-9a9afce88b89",
                "password" => "pt83144789",
            ],
        ]);
        $account->save();

        // HitBTC
        $account = CryptoAccount::make([
            "crypto_source_id" => CryptoSource::SOURCE_EXCHANGE_HITBTC,
            "user_id" => $user->id,
            "credentials" => [
                "apiKey" => "XnDHZ6n5ernQ6WuGy5iMuqKqDFlSyLdB",
                "secret" => "Vbxrl5JX-uIcS8RtF6r4lzoRNM2fLXdX"
            ],
        ]);
        $account->save();

    }
}
