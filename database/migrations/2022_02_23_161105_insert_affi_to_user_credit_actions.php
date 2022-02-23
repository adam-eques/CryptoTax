<?php

use App\Services\CreditCodeService;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration{
    public function up()
    {
        $now = now();

        \App\Models\UserCreditAction::create(            [
            'action_code' => CreditCodeService::ACTION_AFFILIATE_L1,
            'name' => "User Affiliate Earning Level 1",
            "name_public" => "Affiliate Earning Level 1",
            'value' => null,
            'price' => null,
            'valid_from' => $now,
            'valid_till' => null,
        ]);
        \App\Models\UserCreditAction::create(            [
            'action_code' => CreditCodeService::ACTION_AFFILIATE_L2,
            'name' => "User Affiliate Earning Level 2",
            "name_public" => "Affiliate Earning Level 2",
            'value' => null,
            'price' => null,
            'valid_from' => $now,
            'valid_till' => null,
        ]);
    }
};
