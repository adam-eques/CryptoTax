<?php

namespace App\Blockchains;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoingeckoAPI
{
    public CoinGeckoClient $client;

    /**
     * Get the api interface
     *
     * @return CoingeckoAPI $obj
     */
    public static function make() : self
    {
        $obj = new static();
        $obj->client = new CoinGeckoClient();

        return $obj;
    }

    /**
     * Check if the api server is available
     *
     * @return array
     */
    public function check() : array
    {
        return $this->client->ping() ?: [];
    }

    /**
     * Get historical data in the specific time and currency with fiat
     * @param
     */
    public function history()
    {
        // $result = $this->client->simple()->getPrice('0x,bitcoin', 'usd,rub');
        $result = $this->client->coins()->getHistory('bitcoin', '30-12-2017');
        return  $result;
    }
}