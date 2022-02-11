<?php

namespace App\CryptoExchangeDrivers;

use Carbon\Carbon;

/**
 * Class BinanceDriver
 *
 * @package App\CryptoExchangeDrivers
 *
 * @property \ccxt\binance $api
 */
class BinanceDriver extends Driver
{

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        date_default_timezone_set ('UTC'); 
        $credentials = $this->getCredentials();
        $this->api = new \ccxt\binance([
            "apiKey" => \Arr::get($credentials, "apiKey"),
            "secret" => \Arr::get($credentials, "secret"),
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
        $balances = $this->fetchBalances();
        // Save balances
        $this->saveBalances($balances["total"]);
        
        \DB::transaction(function() use ($account, $since, $balances, $now) {

            $all_trades_for_all_symbols = array();
            $unique_symbols = $this->getMachingSymbols($balances);
            $cnt = 0;
            foreach ($unique_symbols as $symbol) {
                // fetch all trades for the $symbol, with pagination
                $cnt++;
                if($cnt > 1)
                {
                    break;
                }
                $this->fetchAllTransactions($symbol, $balances);
                sleep(3);
            }
        });

        return $this;
    }
}