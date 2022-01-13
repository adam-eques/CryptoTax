<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    public function run()
    {
        AccountType::create([
            "name" => "Free",
            "duration" => 1,
            "included_credits" => 100,
            "max_csv_upload" => 5,
            "max_backups" => 2,
            "price_per_year" => 0,
            "active" => 1
        ]);

        AccountType::create([
            "name" => "Premium",
            "duration" => 12,
            "included_credits" => 1000,
            "max_csv_upload" => 20,
            "max_backups" => 5,
            "price_per_year" => 10.99 * 12,
            "active" => 1
        ]);
    }
}
