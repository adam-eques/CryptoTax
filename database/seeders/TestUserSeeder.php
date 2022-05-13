<?php

namespace Database\Seeders;

use App\Models\TaxCostModel;
use App\Models\TaxCountry;
use App\Models\TaxCurrency;
use App\Models\Timezone;
use App\Models\User;
use App\Models\UserAccountType;
use App\Services\CreditCodeService;
use Illuminate\Database\Seeder;

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
                'user_account_type_id' => UserAccountType::TYPE_ADMIN,
            ],
            [
                'name' => "Customer Test",
                'email' => "customer@example.com",
                'user_account_type_id' => UserAccountType::TYPE_CUSTOMER_PREMIUM,
            ],
            [
                'name' => "Tax Advisor Test",
                'email' => "tax-advisor@example.com",
                'user_account_type_id' => UserAccountType::TYPE_TAX_ADVISOR,
            ],
            [
                'name' => "Editor Test",
                'email' => "editor@example.com",
                'user_account_type_id' => UserAccountType::TYPE_EDITOR,
            ],
            [
                'name' => "Support Test",
                'email' => "support@example.com",
                'user_account_type_id' => UserAccountType::TYPE_SUPPORT,
            ],
            [
                'name' => "Free User Test",
                'email' => "free-customer@example.com",
                'user_account_type_id' => UserAccountType::TYPE_CUSTOMER_FREE,
            ],
            [
                "name" => "Demo User",
                "email" => "demo@example.com",
                "user_account_type_id" => UserAccountType::TYPE_CUSTOMER_DEMO,
                "timezone_id" => Timezone::TIMEZONE_UTC,
                "tax_cost_model_id" => TaxCostModel::MODEL_FIFO,
                "tax_currency_id" => TaxCurrency::CURRENCY_USD,
                "tax_country_id" => TaxCountry::COUNTRY_USA,
                'credits' => [
                    [CreditCodeService::ACTION_ADD_PREMIUM_YEAR]
                ]
            ]
        ])->each(function($data){
            if(!User::query()->where("email", $data["email"])->exists()) {
                // Add missing values if needed
                $data["password"] = bcrypt(isset($data["password"]) && $data["password"] ? $data["password"] : $data["email"]);
                $data["created_at"] = $data["created_at"] ?? now();
                $data["email_verified_at"] = $data["email_verified_at"] ?? now();

                // Handle credits
                $credits = [];
                if(isset($data["credits"])) {
                    $credits = $data["credits"];
                    unset($data["credits"]);
                }

                // Create user
                /**
                 * @var User $user
                 */
                $user = User::create($data);

                // Add credits
                foreach($credits AS $credit) {
                    $user->creditAction($credit[0], $credit[1] ?? null, $credit[2] ?? null);
                }
            }
        });
    }
}
