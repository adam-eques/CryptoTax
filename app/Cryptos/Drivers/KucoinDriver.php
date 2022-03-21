<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;


use Carbon\Carbon;
use function now;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
            "apiKey" => Arr::get($credentials, "apiKey"),
            "secret" => Arr::get($credentials, "secret"),
            "password" => Arr::get($credentials, "password"),
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
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $counter = 0;
        $exchange = $this->api->exchange;

        while($since->isPast()) {
            var_dump($since->timestamp);
            $count = 0;
            do {
                $data = $exchange->fetchMyTrades(NULL, $since->timestamp*1000);
                $this->saveTrades($data);
                $count = count($data);
                var_dump($count);
                if($counter !== 0 && $counter % 7 === 0) { // Modulo 7 instead of 9, just to make sure
                    sleep(3);
                }
                if ($count > 0 )
                {
                    $since->timestamp($data[$count-1]['timestamp'] * 0.001 + 1);
                    // var_dump($data[$count-1]['timestamp'] + 1);
                } else {
                    $since->addDays(7);
                    // var_dump('Since: ');
                }
                var_dump($since->toDateTimeString());
                $counter++;
            } while ($count > 0);
            if ($since->isPast()) {
                var_dump($since->toDateTimeString());
            }

            // $counter++;
        }

        $this->account->update(['fetched_at' => now()]);

        return $this;
    }

    /**
     * @return $this
     * @throws \ccxt\ExchangeError
     */
    public function updateTrades(): self
    {
        // Kucoin API used: https://docs.kucoin.com/#list-fills
        // "The system allows you to retrieve data up to one week (start from the last day by default)"
        $account = $this->account;

        // Get date: Kucoin max. prev date = 2019-02-18
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $now = now();

        // Balance
        $balances = $this->fetchBalances();

        DB::transaction(function() use ($account, $since, $balances, $now) {
            $counter = 0;

            while($since->isPast()) {


                // Sleep because of Request Limit of 9 times/3s
                if($counter !== 0 && $counter % 7 === 0) { // Modulo 7 instead of 9, just to make sure
                    sleep(3);
                }

                // Add a week aka 7 days and increment counter
                $since->addDays(7);
                $counter++;
            }

            // Save balances
            $this->saveBalances($balances["total"]);
        });

        return $this;
    }
}
