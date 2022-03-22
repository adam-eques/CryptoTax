<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Cryptos\Drivers\CronosDriver;
use App\Models\CryptoAccount;
use App\Helpers\TestHelper;

class CronosDriverTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $accounts = CryptoAccount::get();
        $this->assertTrue($accounts->count() >= 4, 'Crypto_account table has not enough accounts');
        $account = $accounts[10];
        $driver = $account->getApi();
        $since = Carbon::create(2000, 1, 1, 0, 0, 0);
        $transactions = $driver->fetchTransactions($since);
  //      TestHelper::save2file('../CronosDriverTest_transactions.php', $transactions);
        $balance = $driver->fetchBalance();
        var_dump($balance);
        $this->assertGreaterThan(0, count($transactions), "no transactions found");
    }
}
