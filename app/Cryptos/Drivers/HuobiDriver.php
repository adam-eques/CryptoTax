<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Helpers\TestHelper;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use phpDocumentor\Reflection\PseudoTypes\True_;

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
        $this->found_time = Carbon::create(2016, 1, 1, 0, 0, 0);
        $this->rate_limit = 10; // 10 times per second https://huobiapi.github.io/docs/spot/v1/en/#new-version-rate-limit-rule
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
        // $from = Carbon::create(2022, 2, 20, 0, 0, 0);
        $exchange = $this->api->exchange;
        $exchange->verbose = false;
        $since_limit = Carbon::now()->addDays(-120)->addMinutes(10);
        $since = $from != null || $since_limit->lessThanOrEqualTo($from) ? $from : $since_limit;
        var_dump($since->toAtomString());
        $all_trades = [];
        $counter = 0;
        while($since->isPast()) {
            if ($counter != 0 && $counter % $this->rate_limit == 0) {
                sleep(1);
            }
            var_dump($since->getTimestampMs());
            $trades = $exchange->fetchMyTrades(null, null, null, [
                'start-time' => $since->getTimestampMs(),
                'end-time' => $since->getTimestampMs() + 172800000
            ]);
            $all_trades = array_merge($all_trades, $trades);
            $since->addDays(2);
            $counter++;
        }
        // var_dump($since->getTimestampMs());
        // $all_trades = $exchange->fetchMyTrades(null, null, null, [
        //     'start-time' => $since->getTimestampMs(),
        //     'end-time' => $since->getTimestampMs() + 172800000
        // ]);
        // var_dump($all_trades);
        sleep(1);
        return $all_trades;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchWithdrawals(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;
        $exchange->verbose = true;
        $since = $from ? $from : $this->found_time;
        $all_withdrawals = [];
        $counter = 0;
        while($since->isPast()) {
            if ($counter != 0 && $counter % $this->rate_limit == 0) {
                sleep(1);
            }
            $withdrawals = $exchange->fetch_withdrawals(null, null, null, [
                'start-time' => $since->getTimestampMs(),
                'end-time' => $since->getTimestampMs() + 86400000
            ]);
            $all_withdrawals = array_merge($all_withdrawals, $withdrawals);
            $since->addDay();
            $counter++;
        }
        sleep(1);
        return $all_withdrawals;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;
        $exchange->verbose = true;
        $since = $from ? $from : $this->found_time;
        $all_deposits = [];
        $counter = 0;
        while($since->isPast()) {
            if ($counter != 0 && $counter % $this->rate_limit == 0) {
                sleep(1);
            }
            $deposits = $exchange->fetch_deposits(null, null, null, [
                'start-time' => $since->getTimestampMs(),
                'end-time' => $since->getTimestampMs() + 86400000
            ]);
            $all_deposits = array_merge($all_deposits, $deposits);
            $since->addDay();
            $counter++;
        }
        sleep(1);
        return $all_deposits;
    }
}
