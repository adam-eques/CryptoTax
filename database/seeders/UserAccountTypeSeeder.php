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
            [
                'id' => UserAccountType::TYPE_SUPPORT,
                'name' => "Support",
                'users' => [
                    'support@example.com',
                ],
            ],
            [
                'id' => UserAccountType::TYPE_EDITOR,
                'name' => "Editor",
                'users' => [
                    'editor@example.com',
                ],
            ],
        ])->each(function ($data) {
            if(!$type = UserAccountType::find($data["id"])) {
                // Create Type
                $type = new UserAccountType([
                    "id" => $data["id"],
                    "name" => $data["name"],
                ]);
                $type->save();
            }

            // Loop over users
            User::query()->whereIn("email", $data["users"])->get()->each(function ($user) use ($type) {
                $type->users()->save($user);
            });
        });
    }
}
