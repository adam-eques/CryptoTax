<?php

namespace App\CryptoExchangeDrivers;



use Carbon\Carbon;

/**
 * Class KucoinDriver
 *
 * @package App\CryptoExchangeDrivers
 *
 * @property \ccxt\kucoin $api
 */
class KucoinDriver extends Driver
{

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $credentials = $this->getCredentials();
        $this->api = new \ccxt\kucoin([
            "apiKey" => \Arr::get($credentials, "key"),
            "secret" => \Arr::get($credentials, "secret"),
            "password" => \Arr::get($credentials, "passphrase"),
        ]);

        return $this;
    }

    /**
     * @return $this
     * @throws \ccxt\ExchangeError
     */
    public function updateTransactions(): self
    {
        // Kucoin API used: https://docs.kucoin.com/#list-fills
        // "The system allows you to retrieve data up to one week (start from the last day by default)"
        $account = $this->exchangeAccount;

        // Get date: Kucoin max. prev date = 2019-02-18
        $since = $this->exchangeAccount->fetched_at ? $this->exchangeAccount->fetched_at : Carbon::create(2019, 2, 18);
        $now = now();

        \DB::transaction(function() use ($account, $since, $now) {
            $counter = 0;

            while($since->isPast()) {
                $data = $this->fetchTransactions(null, $since);
                $this->saveTransactions($data, $now);

                // Sleep because of Request Limit of 9 times/3s
                if($counter % 8 === 0) { // Modulo 8 instead of 9, just to make sure
                    sleep(3);
                }

                // Add a week aka 7 days and increment counter
                $since->addDays(7);
                $counter++;
            }
        });


        return $this;
    }

    ///**
    // * @param string|null $symbol
    // * @param \Carbon\Carbon|null $since
    // * @return array
    // * @throws \ccxt\ExchangeError
    // */
    //public function fetchTransactions(?string $symbol = null, ?Carbon $since = null): array
    //{
    //    // Kucoin API used: https://docs.kucoin.com/#list-fills
    //    // "The system allows you to retrieve data up to one week (start from the last day by default)"
    //    $data = [];
    //    $counter = 0;
    //
    //    for($i = 0; $i < 30; $i = $i + 7) {
    //        // Date
    //        $date = now()->subDays($i);
    //
    //        // Data
    //        $newData = $this->api->fetch_my_trades($symbol, null, null, [
    //            "endAt" => $date->timestamp * 1000
    //        ]);
    //        $data = array_merge($data, $newData);
    //
    //        // Sleep because of Request Limit of 9 times/3s
    //        if($counter % 8 === 0) { // Modulo 8 instead of 9, just to make sure
    //            sleep(3);
    //        }
    //        $counter++;
    //    }
    //
    //    return $data;
    //}
}
