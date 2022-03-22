<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;


use Carbon\Carbon;
use function now;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Helpers\TestHelper;
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
        $account = $this->account;
        $balance = $this->fetchBalances();
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $trades = $this->fetchTrades($since);
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $withdrawals = $this->fetchWithdrawals($since);
        $since = $account->fetched_at ? $account->fetched_at : Carbon::create(2019, 2, 18);
        $deposits = $this->fetchDeposits($since);

        // // $counter = 0;
        // // $exchange = $this->api->exchange;

        $this->saveBalances($balance);
        $this->saveTrades($trades);
        $this->saveWithdrawals($withdrawals);
        $this->saveDeposits($deposits);

        // $total_ledger = [];
        // // var_dump($exchange->getTransfersAvailable());
        // while($since->isPast()) {
        //     var_dump($since->timestamp);
        //     $ledger = $exchange->fetch_ledger(null, $since->getTimestampMs());
        //     $total_ledger = array_merge($total_ledger, $ledger);
        //     var_dump($ledger);
        //     if($counter !== 0 && $counter % 7 === 0) { // Modulo 7 instead of 9, just to make sure
        //         sleep(3);
        //     }
        //     $counter++;
        //     $since->addDays(1);
        // }
        // TestHelper::save2file('..\Kucoin_ledger.php', $total_ledger);

        $this->account->update(['fetched_at' => now()]);

        return $this;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        $since = $from ? $from : Carbon::create(2019, 2, 18);
        var_dump($since->toDateTimeString());
        $counter = 0;
        $exchange = $this->api->exchange;

        $trades = [];
        $dates = [];
        while($since->isPast()) {
            var_dump($since->timestamp);
            $count = 0;
            do {
                $data = $exchange->fetchMyTrades(NULL, $since->timestamp*1000);
                $trades = array_merge($trades, $data);
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
                array_push($dates, $since->toDateTimeString());
                var_dump($since->toDateTimeString());
                $counter++;
            } while ($count > 0);
            if ($since->isPast()) {
                var_dump($since->toDateTimeString());
            }
        }
        sleep(3);
        TestHelper::save2file('..\Kucoin_trade.php', $trades);
        TestHelper::save2file('..\Kucoin_dates.php', $dates);
        return $trades;
    }


    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchWithdrawals(Carbon $from = null): array
    {
        $since = $from ? $from : Carbon::create(2019, 2, 18);
        var_dump($since->toDateTimeString());
        $counter = 0;
        $exchange = $this->api->exchange;

        $withdrawals = [];
        $dates = [];
        while($since->isPast()) {
            var_dump($since->timestamp);
            $count = 0;
            do {
                $data = $exchange->fetch_withdrawals(NULL, $since->timestamp*1000);
                $withdrawals = array_merge($withdrawals, $data);
                $count = count($data);
                var_dump($count);
                if($counter !== 0 && $counter % 5 === 0) { // Modulo 5 instead of 6, just to make sure
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
                array_push($dates, $since->toDateTimeString());
                var_dump($since->toDateTimeString());
                $counter++;
            } while ($count > 0);
            if ($since->isPast()) {
                var_dump($since->toDateTimeString());
            }
        }
        sleep(3);
        TestHelper::save2file('..\Kucoin_withdrawals.php', $withdrawals);
        return $withdrawals;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        $since = $from ? $from : Carbon::create(2019, 2, 18);
        var_dump($since->toDateTimeString());
        $counter = 0;
        $exchange = $this->api->exchange;

        $deposits = [];
        $dates = [];
        while($since->isPast()) {
            var_dump($since->timestamp);
            $count = 0;
            do {
                $data = $exchange->fetch_deposits(NULL, $since->timestamp*1000);
                $deposits = array_merge($deposits, $data);
                $count = count($data);
                var_dump($count);
                if($counter !== 0 && $counter % 5 === 0) { // Modulo 5 instead of 6, just to make sure
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
                array_push($dates, $since->toDateTimeString());
                var_dump($since->toDateTimeString());
                $counter++;
            } while ($count > 0);
            if ($since->isPast()) {
                var_dump($since->toDateTimeString());
            }
        }
        sleep(3);
        TestHelper::save2file('..\Kucoin_deposites.php', $deposits);
        return $deposits;
    }
}