<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAccountType;
use Illuminate\Database\Seeder;

class UserAccountTypeSeeder extends Seeder
{
    public function run()
    {
        UserAccountType::query()->truncate();

        collect([
            [
                'id' => UserAccountType::TYPE_ADMIN,
                'data' => [
                    'name' => "Administrator",
                    'duration_in_months' => null,
                    'included_credits' => null,
                    'max_csv_upload' => null,
                    'max_backups' => null,
                    'price_per_year' => null,
                    'is_customer' => false,
                    'active' => true,
                ],
                'users' => [
                    'admin@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_CUSTOMER_PREMIUM,
                'data' => [
                    'name' => "Customer Premium",
                    'duration_in_months' => 12,
                    'included_credits' => 1000,
                    'max_csv_upload' => 20,
                    'max_backups' => 5,
                    'price_per_year' => 10.99 * 12,
                    'is_customer' => true,
                    'active' => true,
                ],
                'users' => [
                    'customer@example.com',
                    'premium-customer@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_CUSTOMER_FREE,
                'data' => [
                    'name' => "Customer Free",
                    'duration_in_months' => null,
                    'included_credits' => 100,
                    'max_csv_upload' => 5,
                    'max_backups' => 2,
                    'price_per_year' => null,
                    'is_customer' => true,
                    'active' => true,
                ],
                'users' => [
                    'free-customer@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_TAX_ADVISOR,
                'data' => [
                    'name' => "Tax Advisor",
                    'duration_in_months' => null,
                    'included_credits' => null,
                    'max_csv_upload' => null,
                    'max_backups' => null,
                    'price_per_year' => null,
                    'is_customer' => false,
                    'active' => true,
                ],
                'users' => [
                    'tax-advisor@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_SUPPORT,
                'data' => [
                    'name' => "Support",
                    'duration_in_months' => null,
                    'included_credits' => null,
                    'max_csv_upload' => null,
                    'max_backups' => null,
                    'price_per_year' => null,
                    'is_customer' => false,
                    'active' => true,
                ],
                'users' => [
                    'support@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_EDITOR,
                'data' => [
                    'name' => "Editor",
                    'duration_in_months' => null,
                    'included_credits' => null,
                    'max_csv_upload' => null,
                    'max_backups' => null,
                    'price_per_year' => null,
                    'is_customer' => false,
                    'active' => true,
                ],
                'users' => [
                    'editor@example.com',
                ],
            ],
        ])->each(function ($data) {
            if(!$type = UserAccountType::find($data["id"])) {
                $data["data"]["id"] = $data["id"];

                // Create Type
                $type = new UserAccountType($data["data"]);
                $type->save();
            }

            // Loop over users
            User::query()->whereIn("email", $data["users"])->get()->each(function ($user) use ($type) {
                $type->users()->save($user);
            });
        });
    }
}
