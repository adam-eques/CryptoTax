<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use Illuminate\Support\Arr;
use Carbon\Carbon;
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
            'apiKey' => Arr::get($credentials, "apiKey"),
            'secret' => Arr::get($credentials, "secret"),
        ]);
        $this->found_time = Carbon::create(2017, 1, 1);
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ["apiKey", "secret"];
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;
        // $exchange->verbose = true;
        $pfrom = $from != null ? $from : $this->found_time;

        $limit = 1000;
        $offset = 0;
        $from = $pfrom->getTimestampMs();
        $count = 0;
        $all_trades = [];
        do {
            $trades = $exchange->fetchMyTrades(null, null, null, [
                'by' => 'timestamp',
                'from' => $from,
                'limit' => $limit,
                'offset' => $offset,
            ]);
            $count = count($trades);
            var_dump($count);
            $all_trades = array_merge($all_trades, $trades);
            if ($count == $limit && $offset >= 100000) {
                $offset = 0;
                $from = $trades[$count-1]['timestamp'];
            }
        } while ($count == $limit && $offset <=100000);
        return $all_trades;
    }
}
