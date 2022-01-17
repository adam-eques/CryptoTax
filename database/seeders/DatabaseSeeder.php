<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Users
            TestUserSeeder::class,
            UserCreditActionSeeder::class,
            UserAccountTypeSeeder::class,

            // Crypto Exchanges
            CryptoExchangeSeeder::class,
            CryptoExchangeAccountSeeder::class,

            // Blockchains
            BlockchainSeeder::class
        ]);
    }
}
