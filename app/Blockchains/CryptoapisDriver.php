<?php

namespace App\Blockchains;

use App\Blockchains\Driver;
use App\Blockchains\CryptoAPI;

class CryptoapisDriver extends Driver
{
    protected function connect() : self {
        $this->api = new CryptoAPI();
        return $this;
    }

    protected function saveTransactions(array $data, Carbon $timestamp, ?array $balances = null): self {

    }

    protected function saveBalances(?array $balances = null) {

    }

    protected function mapFetchedTransactions(array $data) {

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

    public function fetchTransactions(?string $symbol = null, ?Carbon $since = null): array {

    }

}
