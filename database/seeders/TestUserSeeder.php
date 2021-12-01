<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => "Tax Advisor Test",
                'email' => "tax-advisor@example.com",
                'password' => bcrypt("tax-advisor@example.com"),
            ],
            [
                'name' => "Customer Test",
                'email' => "customer@example.com",
                'password' => bcrypt("customer@example.com"),
            ],
            [
                'name' => "Administrator Test",
                'email' => "admin@example.com",
                'password' => bcrypt("admin@example.com"),
            ]
        ];

        foreach($users AS $user) {
            if(!User::query()->where("email", $user["email"])->exists()) {
                $user["created_at"] = now();
                DB::table('users')->insert($user);
            }
        }
    }
}
