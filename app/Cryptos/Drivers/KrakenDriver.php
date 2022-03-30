<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Helpers\TestHelper;


/**
 * Class HitBTC
 *
 * @property \ccxt\hitbtc3 $api
 */
class KrakenDriver extends CcxtDriver
{
    const USER_STARTER = 0;
    const USER_INTERMEDIATE = 1;
    const USER_PRO = 2;

    // https://docs.kraken.com/rest/#section/Rate-Limits/REST-API-Rate-Limits
    protected int $api_counter = 0;
    protected array $api_delay = [ 3031, 2000, 1000]; // decay / 1 : unit ms
    protected int $userLevel = 0;

    protected array $balances = [];

    /**
     * @return $this
     */
    public function update() : self
    {
        $exchange = $this->api->exchange;

        TestHelper::save2file('ccxt_api', $exchange);
        TestHelper::save2file('ccxt_has', $exchange->has);

        $since = $this->account->fetched_at;
        $balance = [];
        // $balance = $this->fetchBalances();
        $trades = [];
        // $trades = $this->fetchTrades($since);
        $transactions = [];
        $withdrawals = [];
        $deposits = [];
        // $withdrawals = $this->fetchWithdrawals($since);
        // $deposits = $this->fetchDeposits($since);
        $ledgers = $this->fetchLedgers($since);

        TestHelper::save2file('ccxt_balance', $balance);
        echo "balance: ";
        // var_dump(count($balance));
        TestHelper::save2file('ccxt_trades', $trades);
        echo "trades: ";
        // var_dump(count($trades));
        TestHelper::save2file('ccxt_transactions', $transactions);
        echo "transactions: ";
        // var_dump(count($transactions));
        TestHelper::save2file('ccxt_withdrawals', $withdrawals);
        echo "withdrawals: ";
        // var_dump(count($withdrawals));
        TestHelper::save2file('ccxt_deposits', $deposits);
        echo "deposits: ";
        // var_dump(count($deposits));
        TestHelper::save2file('ccxt_ledgers', $ledgers);
        echo "ledgers: ";
        // var_dump(count($ledgers));

        $this->saveBalances($balance);
        $this->saveTrades($trades);
        $this->saveTransactions($transactions);
        $this->saveWithdrawals($withdrawals);
        $this->saveDeposits($deposits);
        $this->account->update(['fetched_at' => now()]);
        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    protected function connect(): self
    {
        $this->api = new CCXTAPI();
        // $exchange_id = 'hitbtc3';
        $exchange_id = 'kraken';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => Arr::get($credentials, "apiKey"),
            'secret' => Arr::get($credentials, "secret"),
        ]);
        $this->found_time = Carbon::create(2011, 7, 28);
        $this->userLevel = static::USER_STARTER;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequiredCredentials(): array
    {
        return ["apiKey", "secret"];
    }

    protected function safeCall(int $increase, $call, $paras=null) {
        $start_t = microtime(true);
        $ret = $call($paras);
        $end_t = microtime(true);
        $delay = $this->api_delay[$this->userLevel] * $increase - ($end_t - $start_t) * 1000;
        // echo 'delay: ';
        // var_dump($delay);
        if ($delay > 0) {
            usleep($delay);
        }
        $this->api_counter += $increase;
        return $ret;
    }

    /**
     * @return array
     */
    protected function fetchBalances() : array
    {
        $this->balances = $this->safeCall(1, function() {
            $main_balance = $this->api->getBalance(CCXTAPI::BALANCE_TYPE_MAIN);
            $result = [];
            foreach ($main_balance as $key => $value) {
                $rkey = preg_replace('/[.][MmSs]/', '', $key);
                if (key_exists($rkey, $result)) {
                    $result[$rkey] += $value;
                } else {
                    $result[$rkey] = $value;
                }
            }
            return $result;
        });
        return $this->balances;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        // https://docs.kraken.com/rest/#section/Rate-Limits/REST-API-Rate-Limits
        // https://docs.kraken.com/rest/#operation/getTradeHistory

        $exchange = $this->api->exchange;
        $pfrom = $from != null ? $from : $this->found_time;
        $ofs = 0;
        $limit = 50;
        $count = 0;
        $all_trades = [];

        $callback = function ( $para ) {
            [$exchange, $pfrom, $ofs] = $para;
            return $exchange->fetchMyTrades(null, $pfrom->getTimestampMs(), null, [
                'ofs' => $ofs
            ]);
        };

        do {
            $trades = $this->safeCall(2, $callback, [$exchange, $pfrom, $ofs]);
            $count = count($trades);
            // var_dump($count);
            if ($count > 0) {
                $all_trades = array_merge($all_trades, $trades);
            }
            $ofs += $limit;
        } while ($count >= $limit);
        TestHelper::save2file('Kraken_trades', $all_trades);
        return $all_trades;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        // https://docs.kraken.com/rest/#operation/getStatusRecentDeposits

        $pfrom = $from != null ? $from : $this->found_time;
        // var_dump($pfrom->toDateString());
        $exchange = $this->api->exchange;
        // $exchange->verbose = true;
        $all_deposits = [];

        $callback = function ( $para ) {
            [$exchange, $code, $pfrom] = $para;
            return $exchange->fetch_deposits($code, $pfrom->getTimestampMs(), null, []);
        };

        foreach ($this->balances as $key => $value) {
            $code = $key;
            if (preg_match('/.HOLD/', $code) > 0) {
                // var_dump($code);
                continue;
            }
            $deposits = $this->safeCall(1, $callback, [$exchange, $code, $pfrom]);
            $all_deposits = array_merge($all_deposits, $deposits);
        }
        TestHelper::save2file('Kraken_currencies', $exchange->currencies);
        TestHelper::save2file('Kraken_deposits', $all_deposits);

        return $all_deposits;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchWithdrawals(Carbon $from = null): array
    {
        // https://docs.kraken.com/rest/#operation/getStatusRecentWithdrawals

        $pfrom = $from != null ? $from : $this->found_time;
        $exchange = $this->api->exchange;
        // $exchange->verbose = true;
        $all_withdrawals = [];

        $callback = function ( $para ) {
            [$exchange, $code, $pfrom] = $para;
            return $exchange->fetch_withdrawals($code, $pfrom->getTimestampMs(), null, []);
        };

        foreach ($this->balances as $key => $value) {
            $code = $key;
            if (preg_match('/.HOLD/', $code) > 0) {
                // var_dump($code);
                continue;
            }
            $withdrawals = $this->safeCall(1, $callback, [$exchange, $code, $pfrom]);
            $all_withdrawals = array_merge($all_withdrawals, $withdrawals);
        }
        TestHelper::save2file('Kraken_withdrawals', $all_withdrawals);

        return $all_withdrawals;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchLedgers(Carbon $from = null): array
    {
        // https://docs.kraken.com/rest/#section/Rate-Limits/REST-API-Rate-Limits
        // https://docs.kraken.com/rest/#operation/getLedgers

        $exchange = $this->api->exchange;
        $pfrom = $from != null ? $from : $this->found_time;
        $ofs = 0;
        $limit = 50;
        $count = 0;
        $all_ledgers = [];

        $callback = function ( $para ) {
            [$exchange, $pfrom, $ofs] = $para;
            return $exchange->fetch_ledger(null, $pfrom->getTimestampMs(), null, [
                'ofs' => $ofs
            ]);
        };

        do {
            $ledgers = $this->safeCall(2, $callback, [$exchange, $pfrom, $ofs]);
            $count = count($ledgers);
            // var_dump($count);
            if ($count > 0) {
                $all_ledgers = array_merge($all_ledgers, $ledgers);
            }
            $ofs += $limit;
        } while ($count >= $limit);
        TestHelper::save2file('Kraken_ledgers', $all_ledgers);
        return $all_ledgers;
    }
}
