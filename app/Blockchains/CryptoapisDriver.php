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

    }

    public function fetchTransactions(?string $symbol = null, ?Carbon $since = null): array {

    }

}
