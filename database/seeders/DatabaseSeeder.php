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
            TestUserSeeder::class,
            UserAccountTypeSeeder::class,
            CryptoExchangeSeeder::class,
            CryptoExchangeAccountSeeder::class
        ]);
    }
}
