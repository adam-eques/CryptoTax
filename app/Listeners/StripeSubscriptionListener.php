<?php

namespace App\Listeners;

use App\Models\User;
use Spark\Events\SubscriptionCreated;

class StripeSubscriptionListener
{
    public function __construct()
    {
        //
    }


    public function handle(SubscriptionCreated $event)
    {
        /**
         * @var User $user
         */
        $user = $event->billable;
    }
}
