<?php

namespace App\Cryptos;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoingeckoAPI
{
    public CoinGeckoClient $client;


    /**
     * Get the api interface
     *
     * @return self $obj
     */
    public static function make(): self
    {
        $obj = new static();
        $obj->client = new CoinGeckoClient();

        return $obj;
    }


    /**
     * Check if the api server is available
     *
     * @return array
     * @throws \Exception
     */
    public function check(): array
    {
        return $this->client->ping() ?: [];
    }


    /**
     * Get historical data in the specific time and currency with fiat
     *
     * @return array
     * @throws \Exception
     */
    public function coinHistory(string $coingeckoCoinId, string $date)
    {
        // Fix weird date format: dd-mm-yyyy eg. 30-12-2017, so that we can use standard one (Y-m-d)
        $tmp = explode("-", $date);
        $date = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];

        return $this->client->coins()->getHistory($coingeckoCoinId, $date);
    }
}
