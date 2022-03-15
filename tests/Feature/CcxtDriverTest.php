<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Cryptos\Drivers\CcxtDriver;
use App\Models\CryptoAccount;
use App\Models\CryptoAsset;
use Carbon\Carbon;
use App\Helpers\TestHelper;
use Tests\TestCase;

class CcxtDriverTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ccxtDriver()
    {
        $accounts = CryptoAccount::get();
        $this->assertTrue($accounts->count() >= 4, 'Crypto_account table has not enough accounts');
        $account = $accounts[2];
        $driver = CcxtDriver::make($account);
        $this->assertIsObject($driver, 'Failed to make CcxtDriver');
        $this->assertIsArray($driver->getRequiredCredentials(), 'Failed to get requiredCredentials for api');
        $this->assertIsObject($driver->getApi(), 'Failed to get api');
        $this->assertTrue($driver->isConnected(), 'Failed to connect driver to api');

        $balance = $driver->fetchBalances();
        $this->assertTrue(count($balance) > 0, 'Failed to fetch balances for api');
        TestHelper::save2file('..\CcxtDriverTest_balances.php', $balance);

        $since = Carbon::create(2000, 1, 1, 0, 0, 0);
        $transactions = $driver->fetchTransactions($since);
        $this->assertTrue(count($transactions) > 0, 'Failed to fetch transactions for api');
        TestHelper::save2file('..\CcxtDriverTest_transactions.php', $transactions);

        // $success = $driver->saveBalances($balance);
        // $this->assertTrue($success, 'Failed to save balances in the DB');

        // $success = $driver->saveTransactions($transactions);
        // $this->assertTrue($success, 'Failed to save transactions in the DB');
        $driver->update();
    }
}
