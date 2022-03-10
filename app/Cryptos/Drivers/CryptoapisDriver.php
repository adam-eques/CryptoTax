<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;
use App\Blockchains\CryptoAPI;
use Carbon\Carbon;

class CryptoapisDriver implements ApiDriverInterface
{
    protected CryptoAccount $account;
    protected $api;

    public static function make(CryptoAccount $account): ApiDriverInterface
    {
        $obj = new static();
        $obj->account = $account;
        $obj->connect();

        return $obj;
    }


    public function getRequiredCredentials(): array
    {
        return ["address"];
    }


    public function updateTransactions(): ApiDriverInterface
    {
        // TODO: Implement updateTransactions() method.
    }

    protected function connect() : self {
        $this->api = new CryptoAPI();
        return $this;
    }

    public function getApi()
    {
        return $this->api;
    }

    protected function getCredentials() : array
    {
        return $this->account->credentials ?: [];
    }

    public function fetchBalances() {
        $balances;
        $credentials = $this->getCredentials();
        // var_dump($credentials);
        switch($this->account->cryptoSource->name) {
            case 'Ethereum Blockchain':
                $detail = $this->api->get_details($credentials['address'], 'ethereum', 'mainnet', 'balances');
                $balances = [
                    'amount' => $detail['data']['item']['confirmed_balance']['amount'],
                    'ETH' => $detail['data']['item']['confirmed_balance']['unit']
                ];
                break;
            default: break;
        }
        return $balances;
    }

    public function fetchTransactions(Carbon $from = null, Carbon $to = null): array {
        $transactions = [];
        $fromTimestamp = 0;
        $toTimestamp = now()->timestamp;
        $context = 'not set';
        $blockchain = '';
        $network = 'mainnet';
        $limit = 50;
        $offset = 0;
        $total = 0;
        if ($from) $fromTimestamp = $from->timestamp;
        if ($to) $toTimestamp = $to->timestamp;
        $credentials = $this->getCredentials();
        switch($this->account->cryptoSource->name) {
            case 'Ethereum Blockchain':
                $context = 'ethereum';
                $blockchain = 'ethereum';
                $network = 'mainnet';
                break;
            default: break;
        }

        do {
            $response = $this->api->get_transactionsByTime($credentials['address'], $limit, $offset, 'ethereum', $network, $fromTimestamp, $toTimestamp, $context);
            foreach ($response->data->items as $transaction) {
                $transactions[] = $transaction;
            }
            $total = $response->data->total;
            $offset += $limit;
        } while ($offset <= $total);

        return $transactions;
    }
}
