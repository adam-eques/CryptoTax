<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CryptoAccount;

class BinanceDriverTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $accounts = CryptoAccount::get();
        $this->assertTrue($accounts->count()>0, 'Crypto_account table is empty');
        $account = $accounts[12];
        $account->getApi()->update();

        // Test if there are balances and transactions
        $this->assertGreaterThan(0, $account->cryptoAssets()->count(), "no assets found");
        $this->assertGreaterThan(0, $account->cryptoTransactions()->count(), "No transactions found");
    }
}
