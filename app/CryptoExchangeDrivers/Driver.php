<?php

namespace App\CryptoExchangeDrivers;

use App\Models\CryptoExchangeAccount;

abstract class Driver
{
    protected CryptoExchangeAccount $exchangeAccount;
    protected $connection;

    /**
     * @param \App\Models\CryptoExchangeAccount $exchangeAccount
     * @return static
     */
    public static function make(CryptoExchangeAccount $exchangeAccount): self
    {
        $obj = new static();
        $obj->exchangeAccount = $exchangeAccount;

        return $obj;
    }


    protected function getCredentials() : array
    {
        return $this->exchangeAccount->credentials ?: [];
    }


    public function query()
    {
        return $this->connection;
    }


    /**
     * @return $this
     */
    abstract public function connect(): self;
}
