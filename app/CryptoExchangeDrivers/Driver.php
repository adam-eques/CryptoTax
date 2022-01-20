<?php

namespace App\CryptoExchangeDrivers;

use App\Models\CryptoCurrency;
use App\Models\CryptoExchangeAccount;
use App\Models\CryptoExchangeAsset;
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
        // Get Balance
        $balances = $this->fetchBalances();

        // Get transaction data
        $since = $this->exchangeAccount->fetched_at ?: Carbon::create(2010, 1, 1);
        $data = $this->fetchTransactions(null, $since);

        // Save it
        $this->saveTransactions($data, now(), $balances["total"]);

        return $this;
    }


    /**
     * @return \ccxt\Exchange
     */
    public function getApi()
    {
        return $this->api;
    }


    /**
     * @param array $data
     * @param \Carbon\Carbon $timestamp
     * @param float|null $balances
     * @return $this
     */
    protected function saveTransactions(array $data, Carbon $timestamp, ?array $balances = null): self
    {
        $account = $this->exchangeAccount;
        $data = collect($data)->map(function ($item){
            return $this->mapFetchedTransactions($item);
        })->toArray();

        \DB::transaction(function() use ($account, $data, $balances, $timestamp) {
            // Insert data
            if($data) CryptoExchangeTransaction::insert($data);

            // Update fetched_at
            $account->fetched_at = $timestamp;
            $account->fetching_scheduled_at = null;
            $account->save();

            // Save balances
            $this->saveBalances($balances);
        });

        return $this;
    }


    protected function saveBalances(?array $balances = null)
    {
        if(!is_null($balances)) {
            $account = $this->exchangeAccount;

            $account->cryptoExchangeAssets()->delete();
            foreach($balances AS $key => $val) {
                if($val && $val > 0) {
                    $currency = CryptoCurrency::findByShortName($key);
                    if($currency) {
                        $currency = $currency->id;
                    }
                    else {
                        $currency = 0;
                        logger("Missing crypto currency " . $key);
                    }

                    CryptoExchangeAsset::make([
                        "crypto_exchange_account_id" => $account->id,
                        "crypto_currency_id" => $currency,
                        "balance" => $val
                    ])->save();
                }
            }
        }
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
     * See https://docs.ccxt.com/en/latest/manual.html#balance-structure
     *
     * @return mixed
     */
    public function fetchBalances()
    {
        return $this->api->fetchBalance([
            "type" => "main"
        ]);
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
