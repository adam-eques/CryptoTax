<?php

namespace Database\Seeders;

use App\Models\UserAccountType;
use App\Models\UserCreditAction;
use App\Services\CreditCodeService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCreditActionSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        collect([
            [
                'action_code' => CreditCodeService::ACTION_REGISTER,
                'name' => "Register as Free User",
                'name_public' => "Register",
                'value' => 2,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            // Add premium
            [
                'action_code' => CreditCodeService::ACTION_ADD_PREMIUM_YEAR,
                'name' => "Premium (Year)",
                "name_public" => "Become premium member",
                'value' => 100,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_ADD_PREMIUM_MONTH,
                'name' => "Premium (Month)",
                "name_public" => "Become premium member",
                'value' => 8.4,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            // Buy credits
            [
                'action_code' => CreditCodeService::ACTION_BUY_CREDITS,
                'name' => "Buy 100 Credits for 100$",
                "name_public" => "100 Credits for 100$",
                'value' => 100,
                'price' => 100,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_BUY_CREDITS,
                'name' => "Buy 300 Credits for 200$",
                "name_public" => "300 Credits for 200$",
                'value' => 300,
                'price' => 200,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_BUY_CREDITS,
                'name' => "Buy 700 Credits for 500$",
                "name_public" => "700 Credits for 500$",
                'value' => 700,
                'price' => 500,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_AFFILIATE_L1,
                'name' => "User Affiliate Earning Level 1",
                "name_public" => "Affiliate Earning Level 1",
                'value' => null,
                'price' => null,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_AFFILIATE_L2,
                'name' => "User Affiliate Earning Level 2",
                "name_public" => "Affiliate Earning Level 2",
                'value' => null,
                'price' => null,
                'valid_from' => $now,
                'valid_till' => null,
            ],
        ])->each(function($data){
            $exists = UserCreditAction::query()
                ->where("action_code", $data["action_code"])
                ->where("name", $data["name"])
                ->where("value", $data["value"])
                ->exists();

            if(!$exists) {
                DB::table(UserCreditAction::make()->getTable())->insert($data);
            }
        });
    }
}
