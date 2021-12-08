<?php

namespace App\CryptoExchangeDrivers;

use App\Models\CryptoExchangeAccount;
use App\Models\CryptoExchangeTransaction;
use Carbon\Carbon;

abstract class Driver
{
    protected CryptoExchangeAccount $exchangeAccount;
    protected $api;

    /**
     * @param \App\Models\CryptoExchangeAccount $exchangeAccount
     * @return static
     */
    public static function make(CryptoExchangeAccount $exchangeAccount): self
    {
        $obj = new static();
        $obj->exchangeAccount = $exchangeAccount;
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
        // Get data
        $since = $this->exchangeAccount->fetched_at ? $this->exchangeAccount->fetched_at : Carbon::create(2010, 1, 1);
        $data = $this->fetchTransactions(null, $since);

        // Save it
        $this->saveTransactions($data, now());

        return $this;
    }

    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param array $data
     * @param \Carbon\Carbon $timestamp
     * @return $this
     */
    protected function saveTransactions(array $data, Carbon $timestamp): self
    {
        $account = $this->exchangeAccount;
        $data = collect($data)->map(function ($item){
            return $this->mapFetchedTransactions($item);
        })->toArray();

        \DB::transaction(function() use ($account, $data, $timestamp) {
            // Insert data
            if($data) CryptoExchangeTransaction::insert($data);

            // Update fetched_at
            $account->fetched_at = $timestamp;
            $account->save();
        });

        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function mapFetchedTransactions(array $data)
    {
        $info = \Arr::get($data, "info");

        return [
            "crypto_exchange_account_id" => $this->exchangeAccount->id,
            "external_id" => $data["id"],
            "order" => $data["order"],
            "executed_at" => $data["timestamp"],
            "symbol" => $data["symbol"],
            "type" => $data["type"],
            "side" => $data["side"],
            "taker_or_maker" => $data["takerOrMaker"],
            "price" => $data["price"],
            "amount" => $data["amount"],
            "cost" => $data["cost"],
            "fee_cost" => \Arr::get($data, "fee.cost"),
            "fee_rate" => \Arr::get($data, "fee.rate"),
            "fee_currency" => \Arr::get($data, "fee.currency"),
            "data" => $info ? json_encode($info) : null,
        ];
    }

    /**
     * @return mixed
     */
    public function fetchBalance()
    {
        return $this->api->fetch_balance();
    }

    /**
     * @return array
     */
    protected function getCredentials() : array
    {
        return $this->exchangeAccount->credentials ?: [];
    }

    /**
     * @param string|null $symbol
     * @param Carbon|null $since
     * @return array
     */
    public function fetchTransactions(?string $symbol = null, ?Carbon $since = null): array
    {
        return $this->api->fetch_my_trades(
            $symbol,
            $since ? $since->timestamp * 1000 : null
        );
    }
}
