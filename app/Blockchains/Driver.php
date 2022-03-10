<?php

namespace App\Blockchains;

use App\Models\CryptoAccount;
use App\Models\CryptoAsset;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;

abstract class Driver
{
    protected CryptoAccount $account;
    protected $api;

    /**
     * @param \App\Models\CryptoAccount $account
     * @return static
     */
    public static function make(CryptoAccount $account): self
    {
        $obj = new static();
        $obj->account = $account;
        $obj->connect();

        return $obj;
    }

    /**
     * @return $this
     */
    abstract protected function connect(): self;

    /**
     * @return bool
     */
    public function checkRequiredCredentials(): bool
    {
        return $this->api->check_required_credentials();
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return $this->api->requiredCredentials;
    }

    /**
     * @return $this
     */
    public function updateTransactions(): self
    {
        // Get Balance
        $balances = $this->fetchBalances();

        // Get transaction data
        $since = $this->account->fetched_at ?: Carbon::create(2010, 1, 1);
        $data = $this->fetchTransactions(null, $since);

        // Save it
        $this->saveTransactions($data, now(), $balances["total"]);

        return $this;
    }


    /**
     * @return $api
     */
    public function getApi()
    {
        return $this->api;
    }


    /**
     * @param array $data
     * @param \Carbon\Carbon $timestamp
     * @param array|null $balances
     * @return $this
     */
    abstract protected function saveTransactions(array $data, Carbon $timestamp, ?array $balances = null): self;

    abstract protected function saveBalances(?array $balances = null);

    /**
     * @param array $data
     * @return array
     */
    abstract protected function mapFetchedTransactions(array $data);

    /**
     * @return mixed
     */
    abstract public function fetchBalances();

    /**
     * @return array
     */
    protected function getCredentials() : array
    {
        return $this->account->credentials ?: [];
    }

    /**
     * @param string|null $symbol
     * @param Carbon|null $since
     * @return array
     */
    abstract public function fetchTransactions(?string $symbol = null, ?Carbon $since = null): array;
}
