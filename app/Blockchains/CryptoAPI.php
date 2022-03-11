<?php

namespace App\Blockchains;

use GuzzleHttp\Client;
use CryptoAPIs\Configuration;
use CryptoAPIs\Api\UnifiedEndpointsApi;
use CryptoAPIs\Api\TokensApi;
use CryptoAPIs\Api\MetadataApi;

// reference https://packagist.org/packages/cryptoapis/sdk

class CryptoAPI {
    public $requiredCredentials=['x-api-key' => 'e9b60d3c77930ecd0e776b7edd604a887de3b918'];
    public $config;
    public $transactionInterface;
    public $chainInstance;
    public $tokenInstance;
    public $metaDataInstance;


    public function __construct() {
        $client = new Client();
        // Configure API key authorization: ApiKey
        $this->config = Configuration::getDefaultConfiguration()->setApiKey('x-api-key', $this->requiredCredentials);

        $this->chainInstance = new UnifiedEndpointsApi(
            new Client(),
            $this->config
        );

        $this->tokenInstance = new TokensApi(
            new Client(),
            $this->config
        );

        $this->metaDataInstance = new MetadataApi(
            new Client(),
            $this->config
        );

        $this->transactionInterface = new Client([
            'base_uri' => 'https://rest.cryptoapis.io/v2/blockchain-data/',
            'headers' => $this->requiredCredentials
        ]);
    }

    /**
     * $from: string -> cryptocurrency symbol ex: btc
     * $to: string -> money symbol ex: usd
     * $time: int -> timestamp of date
     */
    public function get_exrateBySymbol($from, $to, $time) {

    }

    // get supported market assets
    public function get_supported_cryptoAssets($limit, $offset) {
        $context = 'supported assets'; // string | In batch situations the user can use the context to correlate responses with requests. This property is present regardless of whether the response was successful or returned as an error. `context` is specified by the user.
        $asset_type = 'crypto'; // string | Defines the type of the supported asset. This could be either \"crypto\" or \"fiat\".

        try {
            $result = $this->metaDataInstance->listSupportedAssets($context, $asset_type, $limit, $offset);
        } catch (Exception $e) {
            echo 'Exception when calling MetadataApi->listSupportedAssets: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }

    // get transactions by time
    public function get_transactionsByTime($address, $limit, $offset, $blockchain, $network, $from, $to, $context) {
        $result;
        try {
            $result = $this->transactionInterface->request(
                'GET',
                ''.$blockchain.'/'.$network.'/addresses/'.$address.'/transactions-by-time-range',
                [
                    'query' => [
                        'fromTimestamp' => $from,
                        'toTimestamp' => $to,
                        'context' => $context,
                        'limit' => $limit,
                        'offset' => $offset,
                    ]
                ]
            );
            $result = json_decode($result->getBody()->getContents());
        } catch (Exception $e) {
            echo 'Exception when calling get Transaction by time: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }

    // get transactions
    public function get_transactions($address, $limit, $offset, $blockchain, $network, $context) {
        $result;
        try {
            $result = $this->chainInstance->listConfirmedTransactionsByAddress($blockchain, $network, $address, $context, $limit, $offset);
        } catch (Exception $e) {
            echo 'Exception when calling UnifiedEndpointsApi->listConfirmedTransactionsByAddress: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }

    // get balances of the blockchain
    public function get_details($address, $blockchain, $network, $context) {
        $result;
        try {
            $result = $this->chainInstance->getAddressDetails($blockchain, $network, $address, $context);
        } catch (Exception $e) {
            echo 'Exception when calling UnifiedEndpointsApi->getAddressDetails: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }

    public function get_token_transfers($address, $limit, $offset, $blockchain, $network, $context) {
        $result;
        try {
            $result = $this->tokenInstance->listConfirmedTokensTransfersByAddress($blockchain, $network, $address, $context, $limit, $offset);
        } catch (Exception $e) {
            echo 'Exception when calling TokensApi->listConfirmedTokensTransfersByAddress: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }

    // get balance of the tokens
    public function get_balance_tokens($address, $limit, $offset, $blockchain, $network, $context) {
        $result;
        try {
            $result = $this->tokenInstance->listTokensByAddress($blockchain, $network, $address, $context, $limit, $offset);
        } catch (Exception $e) {
            echo 'Exception when calling TokensApi->listTokensByAddress: ', $e->getMessage(), PHP_EOL;
        }
        return $result;
    }


    // get bsc testnet transactions of $address
    public function get_transactions_bsc($address, $limit, $offset) {
        return $this->get_transactions($address, $limit, $offset, 'binance-smart-chain', 'testnet', 'bsc transactions');
    }

    // get bsc testnet balance of $address
    public function get_balance_bsc($address) {
        return $this->get_details($address, 'binance-smart-chain', 'testnet', 'bsc balance');
    }

    // get binance-smart-chain based token transfers by $address
    public function get_token_transfers_eth($address, $limit, $offset) {
        return $this->get_token_transfers($address, $limit, $offset, 'binance-smart-chain', 'testnet', 'bsc transactions');
    }

    // get binance-smart-chain based token balance of $address
    public function get_balance_tokens_eth($address) {
        return $this->get_balance_tokens($address, 50, 0, 'binance-smart-chain', 'testnet', 'balance of bsc tokens');
    }
}