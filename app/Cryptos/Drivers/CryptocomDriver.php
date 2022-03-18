<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;


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
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        $exchange_id = 'cryptocom';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey ' => $credentials['apiKey'],
            'secret' => $credentials['secret']
        ]);
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ['apiKey', 'secret'];
    }

}
