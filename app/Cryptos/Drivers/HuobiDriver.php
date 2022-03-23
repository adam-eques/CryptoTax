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
     * @return array
     */
    protected function fetchBalances() : array
    {
        $spot_balance = $this->api->getBalance(CCXTAPI::BALANCE_TYPE_SPOT);
        return $spot_balance;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        // https://huobiapi.github.io/docs/spot/v1/en/#search-match-results
        $exchange = $this->api->exchange;
        $exchange->verbose = false;
        $since_limit = Carbon::now()->addDays(-120)->addMinutes(10);
        $since = $from != null && $since_limit->lessThanOrEqualTo($from) ? $from : $since_limit;
        $all_trades = [];
        $counter = 0;

        while($since->isPast()) {
            if ($counter != 0 && $counter % $this->rate_limit == 0) {
                sleep(1);
            }
            // $since = Carbon::create(2022, 2, 20, 0, 0, 0);
            $trades = $exchange->fetchMyTrades(null, $since->getTimestampMs(), null, [
                // 'start-time' => $since->getTimestampMs(),
                // 'end-time' => $since->getTimestampMs() + 172800000
            ]);
            $all_trades = array_merge($all_trades, $trades);
            $since->addDays(2);
            $counter++;
        }

        sleep(1);
        return $all_trades;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchWithdrawals(Carbon $from = null): array
    {
        // https://huobiapi.github.io/docs/spot/v1/en/#search-for-existed-withdraws-and-deposits
        $exchange = $this->api->exchange;
        // $exchange->verbose = true;
        $withdrawals = [];

        $from = $this->account->getLastSendTransactionId() + 1;
        $size = 500;
        $total_withdrawals = [];
        $withdrawals = [];
        $count = 0;
        $counter = 0;
        do {
            if ($counter != 0 && $counter % $this->rate_limit == 0) {
                sleep(1);
            }
            $withdrawals = $exchange->fetch_withdrawals(null, null, null, [
                'from' => $from,
                'size' => $size,
                'direct' => 'prev'
            ]);
            $count = count($withdrawals);
            $total_withdrawals = array_merge($total_withdrawals, $withdrawals);
            if ($count > 0) {
                $from = $withdrawals[$count-1]['id'] + 1;
            }
            $counter++;
        } while ($count >= $size);
        sleep(1);
        return $total_withdrawals;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        // https://huobiapi.github.io/docs/spot/v1/en/#search-for-existed-withdraws-and-deposits
        $exchange = $this->api->exchange;
        // $exchange->verbose = true;
        $deposits = [];

        $from = $this->account->getLastReceiveTransactionId() + 1;
        $size = 500;
        $total_deposits = [];
        $deposits = [];
        $count = 0;
        $counter = 0;
        do {
            if ($counter != 0 && $counter % $this->rate_limit == 0) {
                sleep(1);
            }
            $deposits = $exchange->fetch_deposits(null, null, null, [
                'from' => $from,
                'size' => $size,
                'direct' => 'prev'
            ]);
            $count = count($deposits);
            $total_deposits = array_merge($total_deposits, $deposits);
            if ($count > 0) {
                $from = $deposits[$count-1]['id'] + 1;
            }
            $counter++;
        } while ($count >= $size);
        sleep(1);
        return $total_deposits;
    }
}
