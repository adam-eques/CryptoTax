<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserAccountType;
use Illuminate\Console\Command;

class RemovePremiumAfterSubscriptionEndsCommand extends Command
{
    protected $signature = 'remove-premium-after-subscription-ends';
    protected $description = 'This command changes premium users to free users, after subscription ends';


    public function handle()
    {
        $query = User::query()
            ->where("user_account_type_id", UserAccountType::TYPE_CUSTOMER_PREMIUM)
            ->where(function($q){
                $q->whereHas("subscriptions", function ($q) {
                    $q->where("ends_at", "<", now());
                })->orWhereDoesntHave("subscriptions");
            });
        $query->update([
            "user_account_type_id" => UserAccountType::TYPE_CUSTOMER_FREE
        ]);
    }
}
