<?php

namespace Tests\Feature;

use App\Blockchains\CryptoAPI;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class CryptoAPITest extends TestCase
{
    public $cryptoApi;
    /**
     * Initialize test
     *
     * @return void
     */
    public function test_initialize()
    {
        $this->cryptoApi = new CryptoAPI();
        $this->assertTrue(gettype($this->cryptoApi->config) == 'object', 'config Error');
        $this->assertTrue(gettype($this->cryptoApi->instance) == 'object', 'instance Error');
    }

    public function test_bsc_transaction() {
        $this->cryptoApi = new CryptoAPI();
        $result = $this->cryptoApi->get_transactions_bsc(
            '0x0243B2b953F18C7881d0B9A6cA0e4FCf34a22859',
            3,
            0
        );
        $this->assertTrue(gettype($result) === 'object', 'Can not get any result');
        // $this->assertTrue(gettype($result) != NULL, 'Can not get any result');
        var_dump($result['api_version']);
        var_dump($result['request_id']);
        var_dump($result['context']);
        var_dump($result['data']['offset']);
        var_dump($result['data']['limit']);
        var_dump($result['data']['total']);
        var_dump($result['data']['items']);
        // var_dump($result->apiVersion );
    }

    public function test_bsc_balance() {
        $this->cryptoApi = new CryptoAPI();
        $result = $this->cryptoApi->get_balance_bsc('0x0243B2b953F18C7881d0B9A6cA0e4FCf34a22859');
        $this->assertTrue(gettype($result) === 'object', 'Can not get any result');
        var_dump($result['data']['item']['confirmed_balance']);
    }
}
