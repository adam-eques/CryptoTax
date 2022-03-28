<?php

namespace Tests\Integration;


use App\Models\CryptoSource;
use App\Models\CryptoAccount;
use App\Models\User;
use Carbon\Carbon;
use App\Helpers\TestHelper;

class AddKrakenExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_KRAKEN;
    protected array $credentials = [
        "apiKey" => "B2d671aaxiIMcKbxahmzU893pf2cCZ2mAFmfoiQ8f1Mfbd/SEpFbsSJW",
        "secret" => "bUeN5GVr64ujMFCVCafC8eoYaHAXDUqhxIkh9hK2/jqPoVE5WkjEIlLM773S2MyOR+X2WGrZj0IBZ1VvckHNcA==",
    ];

    protected function customSetUp(): void
    {
        $this->user = User::factory()->create();
        $this->account = CryptoAccount::create([
            "user_id" => $this->user->id,
            "crypto_source_id" => $this->cryptoSourceId,
            "credentials" => $this->credentials,
            'fetched_at' => Carbon::create(2021, 1, 1, 0, 0, 0),
            "fetching_scheduled_at" => now()
        ]);

        echo "tested1\n";
        $this->account->getApi()->update();
        echo "tested2\n";
    }
}
