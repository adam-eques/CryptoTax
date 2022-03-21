<?php

namespace Tests\Integration;

use App\Models\CryptoSource;
use App\Models\User;
use App\Models\CryptoAccount;
use Carbon\Carbon;


class AddCryptoComExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_CRYPTOCOM;
    protected array $credentials = [
        "apiKey" => "vJwZWxTPFAEXQqREpNXaGL",
        "secret" => "cbNwm8cEfYW7DYuKknDVKv"
    ];

    protected function customSetUp(): void
    {
        $this->user = User::factory()->create();
        $this->account = CryptoAccount::create([
            "user_id" => $this->user->id,
            "crypto_source_id" => $this->cryptoSourceId,
            "credentials" => $this->credentials,
            'fetched_at' => Carbon::create(2021, 3, 1, 0, 0, 0),
            "fetching_scheduled_at" => now()
        ]);

        echo "tested1\n";

        // Update the account
        $this->account->getApi()->update();
        echo "tested2\n";
    }
}
