<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Blockchains\CryptoAPI;
use App\Models\CryptoSources;

use Database\Seeders\CryptoAccountSeeder;


class CryptoAPITest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Initialize test
     *
     * @return void
     */
    // public function test_initialize()
    // {
    //     $this->cryptoApi = new CryptoAPI();
    //     $this->assertTrue(gettype($this->cryptoApi->config) == 'object', 'config Error');
    //     $this->assertTrue(gettype($this->cryptoApi->chainInstance) == 'object', 'chainInstance Error');
    //     $this->assertTrue(gettype($this->cryptoApi->tokenInstance) == 'object', 'tokenInstance Error');
    // }

    // public function test_bsc_transaction() {
    //     $this->cryptoApi = new CryptoAPI();
    //     $result = $this->cryptoApi->get_transactions_bsc(
    //         '0x0243B2b953F18C7881d0B9A6cA0e4FCf34a22859',
    //         3,
    //         0
    //     );
    //     $this->assertTrue(gettype($result) === 'object', 'Can not get any result');
    //     // var_dump($result['api_version']);
    //     // var_dump($result['request_id']);
    //     // var_dump($result['context']);
    //     // var_dump($result['data']['offset']);
    //     // var_dump($result['data']['limit']);
    //     // var_dump($result['data']['total']);
    //     // var_dump($result['data']['items']);
    // }

    // public function test_bsc_balance() {
    //     $this->cryptoApi = new CryptoAPI();
    //     $result = $this->cryptoApi->get_balance_bsc('0x0243B2b953F18C7881d0B9A6cA0e4FCf34a22859');
    //     $this->assertTrue(gettype($result) === 'object', 'Can not get any result');
    //     // var_dump($result['data']['item']['confirmed_balance']);
    // }

    // public function test_tokens_balance() {
    //     $this->cryptoApi = new CryptoAPI();
    //     $result = $this->cryptoApi->get_balance_tokens_eth('0x1CBE958156FF6FEbD4465018772fD3c0652c409b');
    //     $this->assertTrue(gettype($result) === 'object', 'Can not get any result');
    //     // var_dump($result);
    // }

    // public function test_token_transfers() {
    //     $this->cryptoApi = new CryptoAPI();
    //     $result = $this->cryptoApi->get_token_transfers_eth('0x1CBE958156FF6FEbD4465018772fD3c0652c409b', 50, 0);
    //     $this->assertTrue(gettype($result) === 'object', 'Can not get any result');
    //     // var_dump($result);
    // }

    public function test_supported_asset_list() {
        $this->cryptoApi = new CryptoAPI();
        $result = $this->cryptoApi->get_supported_cryptoAssets(50, 0);
        $this->assertTrue(gettype($result) === 'object', 'Can not get supported assets list.');
        var_dump($result);
    }

    // public function test_migrate_to_db() {
    //     CryptoSources::updateFromApi();
    //     $this->assertTrue(true, 'Migration success');
    // }

    // public function test_CryptoAccountSeeder_Test() {
    //     $this->seed(CryptoAccountSeeder::class);
    // }

    public function test_get_transactions_by_time() {
        $this->cryptoApi = new CryptoAPI();
        $address = '0xcf72b431d5a471255c208b65c15798d5577eeaed';
        $limit = 50;
        $offset = 0;
        $blockchain = 'ethereum';
        $network = 'mainnet';
        $from = 0;
        $to = now()->timestamp;
        $context = 'ethereum';
        $transactions = $this->cryptoApi->get_transactionsByTime($address, $limit, $offset, $blockchain, $network, $from, $to, $context);
        $this->assertIsArray($transactions->data->items, 'Failed to get transactions by address and time range');
        var_dump($transactions);
    }
}
