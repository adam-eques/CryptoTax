<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;


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
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        // $exchange_id = 'hitbtc3';
        $exchange_id = 'hitbtc';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => $credentials["apiKey"],
            'secret' => $credentials["secret"]
            
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
