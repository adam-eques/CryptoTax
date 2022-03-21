<?php

namespace Tests\Integration;

use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use App\Models\User;
use Carbon\Carbon;
use App\Helpers\TestHelper;

class AddBinanceExchangeTest extends AbstractAddExchangeTest
{
    protected int $cryptoSourceId = CryptoSource::SOURCE_EXCHANGE_BINANCE;
    protected array $credentials = [
        "apiKey" => "OxUHNMyYuIoIgoyjp8QCEnw4j3C3Yxuu157tYVfrUfPj3lnCsKBZcjxbt3pLToL2",
        "secret" => "zBPfdJqCZZXHoHj8Bnm5ItDib02RvZ5wYk57OWDOC9StFsxBJv9cczLbap7gSK5C"
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

        var_dump($this->account->fetched_at);
        // Update the account
        $this->account->getApi()->update();
        // $exchange = $this->account->getApi()->getApi();
        // $withdrawls = $exchange->getDeposits(1488851410000);
        TestHelper::save2file('../binance_withdraws.php', $withdrawls);

        echo "tested2\n";
    }
}
