<?php

namespace Tests\Integration;

use App\Models\CryptoAccount;
use App\Models\User;
use Tests\TestCase;
use App\Helpers\TestHelper;

abstract class AbstractAddExchangeTest extends TestCase
{
    protected User $user;
    protected CryptoAccount $account;
    protected int $cryptoSourceId;
    protected array $credentials;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customSetUp();
    }

    protected function customSetUp(): void
    {
        $this->user = User::factory()->create();
        $this->account = CryptoAccount::create([
            "user_id" => $this->user->id,
            "crypto_source_id" => $this->cryptoSourceId,
            "credentials" => $this->credentials,
            "fetching_scheduled_at" => now()
        ]);

        echo "last fetch: " . $this->account->fetched_at . "\n";
        // Update the account
        $this->account->getApi()->update();

        // balances log
        // $exchange = $this->account->getApi()->getApi()->exchange;
        // $exchange->verbose = true;
        // $name = $exchange->name;
        // var_dump($name);
        // $types = [ 'trade', 'trading', 'spot', 'margin', 'main', 'funding', 'future', 'futures', 'contract', 'pool', 'pool-x' ];
        // foreach($types as $type)
        // {
        //     try {
        //         $balances = $exchange->fetchBalance([
        //             'type'=> $type
        //         ]);
        //         $tosave = array_filter($balances['total'], function($balance) {
        //             return $balance > 0;
        //         });
        //         TestHelper::save2file($name.'_balances_'.$type, $tosave);
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //         continue;
        //     }
        // }
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        #$this->user->delete();
    }


    public function test_asset_and_transaction_count(): void
    {
        $account = $this->account;
        $countBalance = $account->cryptoAssets()->count();
        $countTransactions = $account->cryptoTransactions()->count();

        // Output results
        echo "\nAccount id: " . $account->id . "\nfetched_at: " . $account->fetched_at . "\nCount transactions : "
        . $countTransactions. "\nCount balances: " . $countBalance . "\n";

        // Test if there are balances and transactions
        $this->assertGreaterThan(0, $countBalance, "no assets found");
        $this->assertGreaterThan(0, $countTransactions, "No transactions found");
    }
}
