<?php

namespace Database\Seeders;

use App\Models\UserAccountType;
use Illuminate\Database\Seeder;

class UserAccountTypeSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'id' => UserAccountType::TYPE_ADMIN,
                'name' => "Administrator",
                'duration_in_months' => null,
                'max_csv_upload' => null,
                'max_backups' => null,
                'price_per_month' => null,
                'price_per_year' => null,
                'is_customer' => false,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_CUSTOMER_FREE,
                'name' => "Customer Free",
                'duration_in_months' => null,
                'max_csv_upload' => 5,
                'max_backups' => 2,
                'price_per_month' => null,
                'price_per_year' => null,
                'is_customer' => true,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_TAX_ADVISOR,
                'name' => "Tax Advisor",
                'duration_in_months' => null,
                'max_csv_upload' => null,
                'max_backups' => null,
                'price_per_month' => null,
                'price_per_year' => null,
                'is_customer' => false,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_SUPPORT,
                'name' => "Support",
                'duration_in_months' => null,
                'max_csv_upload' => null,
                'max_backups' => null,
                'price_per_month' => null,
                'price_per_year' => null,
                'is_customer' => false,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_EDITOR,
                'name' => "Editor",
                'duration_in_months' => null,
                'max_csv_upload' => null,
                'max_backups' => null,
                'price_per_month' => null,
                'price_per_year' => null,
                'is_customer' => false,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_AFFILIATE,
                'name' => "Affiliate",
                'duration_in_months' => null,
                'max_csv_upload' => null,
                'max_backups' => null,
                'price_per_month' => null,
                'price_per_year' => null,
                'is_customer' => false,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_CUSTOMER_PREMIUM,
                'name' => "Customer Premium",
                'duration_in_months' => 12,
                'max_csv_upload' => 20,
                'max_backups' => 5,
                'price_per_year' => 10.99 * 12,
                'price_per_month' => 10.99,
                'is_customer' => true,
                'active' => true,
            ],
            [
                'id' => UserAccountType::TYPE_CUSTOMER_DEMO,
                'name' => "Customer Demo",
                'duration_in_months' => 12,
                'max_csv_upload' => 20,
                'max_backups' => 5,
                'price_per_year' => 10.99 * 12,
                'price_per_month' => 10.99,
                'is_customer' => true,
                'active' => true,
            ],
        ])->each(function ($data) {
            if(!UserAccountType::find($data["id"])) {
                UserAccountType::create($data);
            }
        });
    }
}
