<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\UserAccountType;
use App\Models\UserCreditAction;
use App\Services\CreditCodeService;
use Spark\Events\SubscriptionCreated;

class StripeSubscriptionListener
{
    public function handle(SubscriptionCreated $event)
    {
        /**
         * @var User $user
         */
        $user = $event->billable;

        // Set customer to premium
        $user->user_account_type_id = UserAccountType::TYPE_CUSTOMER_PREMIUM;
        $user->save();

        // Affiliate logic
        $user->buyCredits(
            $user->sparkPlan()->interval == 'monthly' ? CreditCodeService::ACTION_ADD_PREMIUM_MONTH : CreditCodeService::ACTION_ADD_PREMIUM_YEAR
        );
    }
}
