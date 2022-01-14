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
                'user_account_type_id' => UserAccountType::TYPE_CUSTOMER_FREE,
                'name' => "Register",
                'value' => 200,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_REGISTER,
                'user_account_type_id' => UserAccountType::TYPE_CUSTOMER_PREMIUM,
                'name' => "Register",
                'value' => 200,
                'valid_from' => $now,
                'valid_till' => null,
            ],
            [
                'action_code' => CreditCodeService::ACTION_SUBSCRIBE_ACCOUNT_TYPE,
                'user_account_type_id' => UserAccountType::TYPE_CUSTOMER_PREMIUM,
                'name' => "Premium account",
                'value' => 2500,
                'valid_from' => $now,
                'valid_till' => null,
            ],
        ])->each(function($data){
            $exists = UserCreditAction::query()
                ->where("action_code", $data["action_code"])
                ->where("user_account_type_id", $data["user_account_type_id"])
                ->exists();

            if(!$exists) {
                DB::table(UserCreditAction::make()->getTable())->insert($data);
            }
        });
    }
}
