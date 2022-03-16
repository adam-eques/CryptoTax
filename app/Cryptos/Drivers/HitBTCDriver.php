<?php

namespace App\Cryptos\Drivers;



/**
 * Class HitBTC
 *
 * @property \ccxt\hitbtc3 $api
 */
class HitBTCDriver extends CcxtDriver
{

    /**
     * @return $this
     * @throws \Exception
     */
    // protected function connect(): self
    // {
    //     $credentials = $this->getCredentials();
    //     $this->api = new \ccxt\hitbtc([
    //         "apiKey" => \Arr::get($credentials, "apiKey"),
    //         "secret" => \Arr::get($credentials, "secret"),
    //     ]);

    //     return $this;
    // }
}
