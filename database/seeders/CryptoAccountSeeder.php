<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CryptoSource;
use App\Models\CryptoAccount;

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

        collect([
            [
                'crypto_source_id' => CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM,
                'user_id' => 1,
                'credentials' => '{"address" : "0xcf72b431d5a471255c208b65c15798d5577eeaed"}',
                'fetched_at' => $now,
                'fetched_scheduled_at' => NULL,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'crypto_source_id' => CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN,
                'user_id' => 1,
                'credentials' => '{"address" : "MV9pffMixgbGF4XzPnjFky74kgEWJUcKqj"}',
                'fetched_at' => $now,
                'fetched_scheduled_at' => NULL,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ])->each(function($data){
            // var_dump($data);
            DB::table(CryptoAccount::make()->getTable())->insert($data);
        });
    }
}
