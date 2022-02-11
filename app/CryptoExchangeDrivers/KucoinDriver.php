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
        date_default_timezone_set ('UTC'); 
        $credentials = $this->getCredentials();
        $this->api = new \ccxt\kucoin([
            "apiKey" => \Arr::get($credentials, "apiKey"),
            "secret" => \Arr::get($credentials, "secret"),
            "password" => \Arr::get($credentials, "password"),
            'verbose' => false,
            'enableRateLimit' => true,
            'rateLimit' => 100, // unified exchange property
            'options' => array(
                'adjustForTimeDifference' => true, // exchange-specific option
                'recvWindow'=> 60000,
            ),
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
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $now = now();

        // Balance
        $balances = $this->api->fetchBalance([
            "type" => "main"
        ]);  
        // Save balances
        $this->saveBalances($balances["total"]);  
        \DB::transaction(function() use ($account, $since, $balances, $now) {

            $counter = 0;

            while($since->isPast()) {
                $data = $this->fetchTransactions(null, $since);
                if(count($data) > 0)
                {
                    $this->saveTransactions($data, $now);
                }

                if($counter > 5)
                {
                    break;
                }

                // Sleep because of Request Limit of 9 times/3s
                if($counter !== 0 && $counter % 7 === 0) { // Modulo 7 instead of 9, just to make sure
                    sleep(3);
                }

                // Add a week aka 7 days and increment counter
                $since->addDays(7);
                $counter++;
            }

        });

        return $this;
    }
}
