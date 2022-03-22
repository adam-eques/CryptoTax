<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Helpers\TestHelper;

/**
 * Class HuobiDriver
 *
 */
class HuobiDriver extends CcxtDriver
{

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        $exchange_id = 'huobi';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => Arr::get($credentials, "apiKey"),
            'secret' => Arr::get($credentials, "secret"),
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

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
        }
        $pfrom = Carbon::create(2017, 1, 1);
        // $trades = $this->api->getTrades(NULL, $pfrom->timestamp, NULL);
        $exchange = $this->api->exchange;
        $exchange->verbose = True;
        $trades = $exchange->fetchMyTrades(null, 1647798132000, null);
  //      TestHelper::save2file('..\CcxtDriver_trades.php', $trades);
        return $trades;
    }
}
