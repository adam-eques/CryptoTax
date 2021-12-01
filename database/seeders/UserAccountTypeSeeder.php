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
                'name' => "Administrator",
                'users' => [
                    'admin@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_CUSTOMER,
                'name' => "Customer",
                'users' => [
                    'customer@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_TAX_ADVISOR,
                'name' => "Tax Advisor",
                'users' => [
                    'tax-advisor@example.com',
                ],
            ],
        ])->each(function ($item) {
            // Create Type
            $type = new UserAccountType([
                "id" => $item["id"],
                "name" => $item["name"],
            ]);
            $type->save();

            // Loop over users
            User::query()->whereIn("email", $item["users"])->get()->each(function ($user) use ($type) {
                $type->users()->save($user);
            });
        });
    }
}
