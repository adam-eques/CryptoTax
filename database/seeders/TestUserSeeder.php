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
        collect([
            [
                'name' => "Administrator Test",
                'email' => "admin@example.com",
            ],
            [
                'name' => "Customer Test",
                'email' => "customer@example.com",
            ],
            [
                'name' => "Tax Advisor Test",
                'email' => "tax-advisor@example.com",
            ]
        ])->each(function($item){
            if(!User::query()->where("email", $item["email"])->exists()) {
                $item["password"] = bcrypt(isset($item["password"]) && $item["password"] ? $item["password"] : $item["email"]);
                $item["created_at"] = now();
                DB::table('users')->insert($item);
            }
        });
    }
}
