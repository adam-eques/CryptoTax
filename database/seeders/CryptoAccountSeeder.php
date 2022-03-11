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
                'user_id' => 1,
                'credentials' => '{"address" : "0xcf72b431d5a471255c208b65c15798d5577eeaed"}',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'crypto_source_id' => CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN,
                'user_id' => 1,
                'credentials' => '{"address" : "MV9pffMixgbGF4XzPnjFky74kgEWJUcKqj"}',
                'fetched_at' => $fetched_at,
                'fetching_scheduled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ])->each(function($data){
            // var_dump($data);
            DB::table(CryptoAccount::make()->getTable())->insert($data);
        });
    }
}
