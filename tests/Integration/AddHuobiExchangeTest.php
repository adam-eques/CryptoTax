<?php

namespace Tests\Integration;


use App\Models\CryptoSource;
use App\Models\CryptoAccount;
use App\Models\User;

class AddHuobiExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_HUOBI;
    protected array $credentials = [
        "apiKey" => "37bb62cf-5bb54675-20451a74-ed2htwf5tf",
        "secret" => "c5c993f0-d051315a-1ce0b748-99eb2"
    ];

    // protected function customSetUp(): void
    // {
    //     $id = 293;
    //     $account = CryptoAccount::find($id);

    //     $this->account = $account;

    //     // Update the account
    //     $this->account->getApi()->update();

    // }

}
