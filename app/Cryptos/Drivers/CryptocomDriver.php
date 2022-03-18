<?php

namespace App\Cryptos\Drivers;



/**
 * Class Cryptocom
 *
 *
 */
class CryptocomDriver extends CcxtDriver
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

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ['apiKey', 'secret'];
    }

    

}
