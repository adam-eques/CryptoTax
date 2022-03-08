<?php

namespace App\Blockchains;

use GuzzleHttp\Client;
use CryptoAPIs\Configuration;
use CryptoAPIs\Api\UnifiedEndpointsApi;
use CryptoAPIs\Api;

// reference https://packagist.org/packages/cryptoapis/sdk

class CryptoAPI {
    public $instance;
    public $config;

    public function __construct() {
        $client = new Client();
        // Configure API key authorization: ApiKey
        $this->config = Configuration::getDefaultConfiguration()->setApiKey('x-api-key', 'e9b60d3c77930ecd0e776b7edd604a887de3b918');

        // $this->instance = new AssetsApi(
        $this->instance = new UnifiedEndpointsApi(
            new Client(),
            $this->config
        );
    }

    public function get_transactions_bsc($address, $limit, $offset) {
        $result;
        $blockchain = 'binance-smart-chain'; // string | Represents the specific blockchain protocol name, e.g. Ethereum, Bitcoin, etc.
        $network = 'testnet'; // string | Represents the name of the blockchain network used; blockchain networks are usually identical as technology and software, but they differ in data, e.g. - \"mainnet\" is the live network with actual data while networks like \"testnet\", \"ropsten\" are test networks.
        // $address = '0x0243B2b953F18C7881d0B9A6cA0e4FCf34a22859'; // string | Represents the public address, which is a compressed and shortened form of a public key.
        $context = 'context_example'; // string | In batch situations the user can use the context to correlate responses with requests. This property is present regardless of whether the response was successful or returned as an error. `context` is specified by the user.
        // $limit = 3; // int | Defines how many items should be returned in the response per page basis.
        // $offset = 10; // int | The starting index of the response items, i.e. where the response should start listing the returned items.

        try {
            $result = $this->instance->listConfirmedTransactionsByAddress($blockchain, $network, $address, $context, $limit, $offset);
        } catch (Exception $e) {
            echo 'Exception when calling UnifiedEndpointsApi->listConfirmedTransactionsByAddress: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }
}