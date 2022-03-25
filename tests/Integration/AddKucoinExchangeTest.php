<?php

namespace Tests\Integration;


use App\Models\CryptoSource;
use App\Models\CryptoAccount;
use App\Models\User;
use App\Helpers\TestHelper;
class AddKucoinExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_KUCOIN;
    protected array $credentials = [
        "apiKey" => "60042ffdad62470006b584d9",
        "secret" => "6588acc4-057a-43bb-9659-9a9afce88b89",
        "password" => "pt83144789"
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

    //     // Update the account
    //     $possibles = $this->account->getApi()->possibleMethods();
    //     TestHelper::save2file('../Kucoin_possibleMethods.php', $possibles);
    // }
}
