<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'name' => "Tax Advisor Test",
            'email' => "tax-advisor@example.com",
            'password' => bcrypt("tax-advisor@example.com"),
        ]);
        DB::table('users')->insert([
            'name' => "Customer Test",
            'email' => "customer@example.com",
            'password' => bcrypt("customer@example.com"),
        ]);
        DB::table('users')->insert([
            'name' => "Administrator Test",
            'email' => "admin@example.com",
            'password' => bcrypt("admin@example.com"),
        ]);
    }
}
