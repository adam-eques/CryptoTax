<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CryptoSource;
use App\Models\CryptoAccount;
use Carbon\Carbon;

class CryptoAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $fetched_at = Carbon::create(2000, 1, 1, 0, 0, 0);

        collect([
            [
                'crypto_source_id' => CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM,
                'user_id' => 2,
                'credentials' => '{"address" : "0xcf72b431d5a471255c208b65c15798d5577eeaed"}',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'crypto_source_id' => CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN,
                'user_id' => 2,
                'credentials' => '{"address" : "MV9pffMixgbGF4XzPnjFky74kgEWJUcKqj"}',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'crypto_source_id' => CryptoSource::SOURCE_EXCHANGE_HITBTC,
                'user_id' => 2,
                'credentials' => '{
                    "apiKey" : "XnDHZ6n5ernQ6WuGy5iMuqKqDFlSyLdB",
                    "secret" : "Vbxrl5JX-uIcS8RtF6r4lzoRNM2fLXdX"
                }',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'crypto_source_id' => CryptoSource::SOURCE_EXCHANGE_KUCOIN,
                'user_id' => 2,
                'credentials' => '{
                    "apiKey" : "60042ffdad62470006b584d9",
                    "secret" : "6588acc4-057a-43bb-9659-9a9afce88b89",
                    "password" : "pt83144789"
                }',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'crypto_source_id' => CryptoSource::SOURCE_BLOCKCHAIN_BITCOIN,
                'user_id' => 2,
                'credentials' => '{"address" : "0xcf72b431d5a471255c208b65c15798d5577eeaed"}',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ])->each(function($data){
            // var_dump($data);
            DB::table(CryptoAccount::make()->getTable())->insert($data);
        });
    }
}
