<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Blockchains\CryptoapisDriver;
use App\Models\CryptoAccount;


class CryptoapisDriverTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getAccountTest() {
        $accounts = CryptoAccount::get();
        $this->assertTrue($accounts->count()>0, 'Crypto_account table is empty');
        $account = $accounts[0];
        $driver = CryptoapisDriver::make($account);
        $this->assertIsObject($driver, 'Failed to make CryptoapisDriver');
        $this->assertIsArray($driver->getRequiredCredentials(), 'Failed to get requiredCredentials for api');
        $this->assertIsObject($driver->getApi(), 'Failed to get api');

        // var_dump($account);
        var_dump();
    }
}
