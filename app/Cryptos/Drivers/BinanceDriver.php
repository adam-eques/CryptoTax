<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;


/**
 * Class BinanceDriver
 *
 */
class BinanceDriver extends CcxtDriver
{

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        $exchange_id = 'binance';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => \Arr::get($credentials, "apiKey"),
            'secret' => \Arr::get($credentials, "secret"),
        ]);
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ["apiKey", "secret"];
    }
}
