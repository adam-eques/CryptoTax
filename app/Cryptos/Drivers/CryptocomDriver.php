<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use Carbon\Carbon;
use App\Helpers\TestHelper;


/**
 * Class Cryptocom
 *
 *
 */
class CryptocomDriver extends CcxtDriver
{
    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        $exchange_id = 'cryptocom';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => $credentials['apiKey'],
            'secret' => $credentials['secret']
        ]);
        $this->found_time = Carbon::create(2020, 6, 1);
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ['apiKey', 'secret'];
    }

    /**
     * @return array
     */
    protected function fetchBalances() : array
    {
        return $this->api->getBalance(CCXTAPI::BALANCE_TYPE_SPOT);
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;
        $exchange->verbose = true;

        // https://exchange-docs.crypto.com/spot/index.html#rate-limits
        // https://exchange-docs.crypto.com/spot/index.html#private-get-trades

        $pfrom = $from != null ? $from : $this->found_time;
        $page_size = 200;
        $all_trades = [];

        $spot_error_dates = [];

        while($pfrom->isPast()){
            var_dump($pfrom->toDateString());
            $count = 0;
            $page = 0;
            do {
                $start_t = microtime(true);
                $trades = [];
                try {
                    $trades = $exchange->fetchMyTrades(null, null, null, [
                        // 'instrument_name' => 'all',
                        'page_size' => $page_size,
                        'page' => $page,
                        'start_ts' => $pfrom->getTimestampMs(),
                        'end_ts' => $pfrom->getTimestampMs() + 86400000
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                    $trades = [];
                    array_push($spot_error_dates, $pfrom->toDateString());
                }
                $count = count($trades);
                $page++;
                $all_trades = array_merge($all_trades, $trades);

                $end_t = microtime(true);
                if ($end_t - $start_t < 1)
                {
                    var_dump((1 - $end_t + $start_t) * 1000);
                    usleep((1 - $end_t + $start_t) * 1000);
                }
            } while ($count == $page_size);
            $pfrom->addDay();   // duration between start and end is 24hours
            // if ($pfrom->equalTo(Carbon::create(2022, 1, 3))) {
            //     break;
            // }
        }
        TestHelper::save2file('cryptocom_spot_errors_date', $spot_error_dates);
        return $all_trades;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;

        // https://exchange-docs.crypto.com/spot/index.html#rate-limits
        // https://exchange-docs.crypto.com/spot/index.html#private-get-deposit-history

        $pfrom = $from != null ? $from : $this->found_time;
        $page_size = 200;
        $all_deposits = [];

        $req_counter = 0;


        $start_t = 0;
        $end_t = 0;
        while($pfrom->isPast()) {
            $count = 0;
            $page = 0;
            $start_ts = $pfrom->getTimestampMs();
            $end_ts = $pfrom->getTimestampMs() + 90 * 24 * 3600 * 1000;

            do {
                if ($req_counter == 0)
                {
                    $start_t = microtime(true);
                }

                $deposits = $exchange->fetch_deposits(null, null, null, [
                    'page_size' => $page_size,
                    'page' => $page,
                    'start_ts' => $start_ts,
                    'end_ts' => $end_ts
                ]);
                $req_counter++;
                $count = count($deposits);
                var_dump($count);
                $page++;
                $all_deposits = array_merge($all_deposits, $deposits);

                if ($req_counter % 3 == 0) {
                    $end_t = microtime(true);
                    if ($end_t - $start_t < 0.1) {
                        var_dump((1 - $end_t + $start_t) * 1000);
                        usleep((1 - $end_t + $start_t) * 1000);
                    }
                    $start_t = microtime(true);
                }
            } while ($count == $page_size);
            $pfrom->addDays(90);
        }

        return $all_deposits;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchWithdrawals(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;

        // https://exchange-docs.crypto.com/spot/index.html#rate-limits
        // https://exchange-docs.crypto.com/spot/index.html#private-get-withdrawal-history

        $pfrom = $from != null ? $from : $this->found_time;
        $page_size = 200;
        $all_withdrawals = [];

        $req_counter = 0;


        $start_t = 0;
        $end_t = 0;
        while($pfrom->isPast()) {
            $count = 0;
            $page = 0;
            $start_ts = $pfrom->getTimestampMs();
            $end_ts = $pfrom->getTimestampMs() + 90 * 24 * 3600 * 1000;

            do {
                if ($req_counter == 0)
                {
                    $start_t = microtime(true);
                }

                $withdrawals = $exchange->fetch_withdrawals(null, null, null, [
                    'page_size' => $page_size,
                    'page' => $page,
                    'start_ts' => $start_ts,
                    'end_ts' => $end_ts
                ]);
                $req_counter++;
                $count = count($withdrawals);
                $page++;
                $all_withdrawals = array_merge($all_withdrawals, $withdrawals);

                if ($req_counter % 3 == 0) {
                    $end_t = microtime(true);
                    if ($end_t - $start_t < 0.1) {
                        var_dump((1 - $end_t + $start_t) * 1000);
                        usleep((1 - $end_t + $start_t) * 1000);
                    }
                    $start_t = microtime(true);
                }
            } while ($count == $page_size);
            $pfrom->addDays(90);
        }

        return $all_withdrawals;
    }
}
