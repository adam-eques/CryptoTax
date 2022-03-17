<?php

namespace App\Cryptos\Drivers;



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
    // protected function connect(): self
    // {
    //     $credentials = $this->getCredentials();
    //     $this->api = new \ccxt\kucoin([
    //         "apiKey" => \Arr::get($credentials, "apiKey"),
    //         "secret" => \Arr::get($credentials, "secret"),
    //         "password" => \Arr::get($credentials, "password"),
    //     ]);

    //     return $this;
    // }

    /**
     * @return $this
     */
    public function update() : self {
        var_dump('KucoinDriver update');
        $balance = $this->fetchBalances();
        $this->saveBalances($balance);


        // $transactions = $this->fetchTransactions($this->account->fetched_at);
        // $this->saveTransactions($transactions);

        $account = $this->account;
        // $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2021, 9, 15);
        $counter = 0;

        while($since->isPast()) {
            $data = $this->fetchTransactions($since);
            var_dump($data);
            $this->saveTransactions($data);

            // Sleep because of Request Limit of 9 times/3s
            if($counter !== 0 && $counter % 7 === 0) { // Modulo 7 instead of 9, just to make sure
                sleep(3);
            }

            // Add a week aka 7 days and increment counter
            if (count($data) == 0) $since->addDays(7);
            else $since = Carbon::createFromTimestampMsUTC($data[count($data) - 1]['timestamp'] + 1);
            $counter++;
        }


        $this->account->update(['fetched_at' => now()]);

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
        $account = $this->account;

        // Get date: Kucoin max. prev date = 2019-02-18
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $now = now();

        // Balance
        $balances = $this->fetchBalances();

        \DB::transaction(function() use ($account, $since, $balances, $now) {
            $counter = 0;

            while($since->isPast()) {
                $data = $this->fetchTransactions(null, $since);
                $this->saveTransactions($data, $now);

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
