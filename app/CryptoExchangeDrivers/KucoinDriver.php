<?php

namespace App\CryptoExchangeDrivers;

use Lin\Ku\Kucoin;

/**
 * Class KucoinDriver
 *
 * @package App\CryptoExchangeDrivers
 *
 * @property \Lin\Ku\Kucoin $connection
 */
class KucoinDriver extends Driver
{

    public function connect(): self
    {
        $credentials = $this->getCredentials();
        if(!$credentials || !isset($credentials["key"])) {
            throw new \Exception("Missing credentials for KucoinDriver");
        }

        $this->connection = new Kucoin(
            \Arr::get($credentials, "key"),
            \Arr::get($credentials, "secret"),
            \Arr::get($credentials, "passphrase"),
            config("crypto-exchanges.kucoin.url")
        );

        return $this;
    }


    /**
     * @return \Lin\Ku\Api\Spot\Accounts
     */
    public function account()
    {
        return $this->query()->account();
    }



    /**
     * @return \Lin\Ku\Kucoin
     */
    public function query(): \Lin\Ku\Kucoin
    {
        return $this->connection;
    }
}
