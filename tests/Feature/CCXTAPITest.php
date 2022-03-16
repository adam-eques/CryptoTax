<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Blockchains\CCXTAPI;
use App\Helpers\TestHelper;

class CCXTAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $exchange_id = 'HitBTC';
        $apiKey = 'XnDHZ6n5ernQ6WuGy5iMuqKqDFlSyLdB';
        $secret = 'Vbxrl5JX-uIcS8RtF6r4lzoRNM2fLXdX';
        $ccxtApi = new CCXTAPI();
        $success = $ccxtApi->loadExchange($exchange_id, $apiKey, $secret);
        $this->assertTrue($success, 'Failed to load Exchange');
        // var_dump($ccxtApi->exchange->has['fetchTrades']);
        // var_dump($ccxtApi->exchange);

        // balance
        $balances = $ccxtApi->getBalance();
        TestHelper::save2file('../test_balances.php', $balances);
        // var_dump($balance);

        $trades = $ccxtApi->getTrades(NULL, 1584194760, NULL);
        TestHelper::save2file('../test_trades.php', $trades);

        $transactions = $ccxtApi->getTransactions(1584194760);
        TestHelper::save2file('../test_transactinon.php', $transactions);

        // $withdrawals = $ccxtApi->getWithdrawals(1584194760);
        // var_dump($withdrawals);
        // TestHelper::save2file('../test_withdrawals.php', $withdrawals);

        // $deposits = $ccxtApi->getDeposits(1584194760);
        // var_dump($deposits);
        // TestHelper::save2file('../test_deposits.php', $deposits);

        // var_dump($ccxtApi->exchange->has);
        // TestHelper::save2file('../test_has.php', $ccxtApi->exchange->has);
        // var_dump($ccxtApi->exchange->name);
        // var_dump($ccxtApi->exchange->countries);
        // // var_dump($ccxtApi->exchange->urls);

        $markets = $ccxtApi->exchange->markets;
        TestHelper::save2file('../test_markets.php', $markets);

        // var_dump($ccxtApi->exchange->symbols);
        // var_dump($ccxtApi->exchange->currencies);
        // var_dump($ccxtApi->exchange->uid);
        // var_dump($ccxtApi->exchange->requiredCredentials);
    }
}
