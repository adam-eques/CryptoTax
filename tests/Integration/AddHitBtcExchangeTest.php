<?php

namespace Tests\Integration;


use App\Models\CryptoSource;
use App\Models\CryptoAccount;
use App\Models\User;
use App\Helpers\TestHelper;
class AddHitBtcExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_HITBTC;
    protected array $credentials = [
        "apiKey" => "XnDHZ6n5ernQ6WuGy5iMuqKqDFlSyLdB",
        "secret" => "Vbxrl5JX-uIcS8RtF6r4lzoRNM2fLXdX"
    ];

    // protected function customSetUp(): void
    // {
    //     $this->user = User::factory()->create();
    //     $this->account = CryptoAccount::create([
    //         "user_id" => $this->user->id,
    //         "crypto_source_id" => $this->cryptoSourceId,
    //         "credentials" => $this->credentials,
    //         "fetching_scheduled_at" => now()
    //     ]);

    //     echo "tested1\n";

    //     // Update the account
    //     // $this->account->getApi()->update();
    //     $exchange = $this->account->getApi()->getApi();
    //     $transactions = $exchange->getTransactions();
    //     TestHelper::save2file('HitBtc_transactions', $transactions);
    //     // $withdrawls = $exchange->getTransfers();
    //     // TestHelper::save2file('HitBtc_withdrawls', $withdrawls);
    //     echo "tested2\n";
    // }
}
