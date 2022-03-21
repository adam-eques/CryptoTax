<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;


use Carbon\Carbon;
use function now;

/**
 * Class KucoinDriver
 *
 * @property \ccxt\kucoin $api
 */
class KucoinDriver extends CcxtDriver
{

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        $exchange_id = 'kucoin';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            "apiKey" => \Arr::get($credentials, "apiKey"),
            "secret" => \Arr::get($credentials, "secret"),
            "password" => \Arr::get($credentials, "password"),
        ]);
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ["apiKey", "secret", "password"];
    }

    /**
     * @return $this
     */
    public function update() : self {
        var_dump('KucoinDriver update');
        $balance = $this->fetchBalances();
        $this->saveBalances($balance);

        $account = $this->account;
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2017, 1, 1);
        $counter = 0;
        $exchange = $this->api->exchange;

        while($since->isPast()) {
            $data = $exchange->fetchMyTrades(NULL, $since->timestamp*1000);
            $this->saveTrades($data);

            if($counter !== 0 && $counter % 7 === 0) { // Modulo 7 instead of 9, just to make sure
                sleep(3);
            }

            $since->addDays(7);
            $counter++;
        }

        $this->account->update(['fetched_at' => now()]);

        return $this;
    }

}