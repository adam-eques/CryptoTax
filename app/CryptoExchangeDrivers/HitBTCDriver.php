<?php

namespace App\CryptoExchangeDrivers;



/**
 * Class HitBTC
 *
 * @package App\CryptoExchangeDrivers
 *
 * @property \ccxt\hitbtc3 $api
 */
class HitBTCDriver extends Driver
{

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $credentials = $this->getCredentials();
        $this->api = new \ccxt\hitbtc([
            "apiKey" => \Arr::get($credentials, "apiKey"),
            "secret" => \Arr::get($credentials, "secret"),
        ]);

        return $this;
    }
}
