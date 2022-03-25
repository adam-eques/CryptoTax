<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use App\Helpers\TestHelper;
use Carbon\Carbon;

/**
 * Class BinanceDriver
 *
 */
class BinanceDriver extends CcxtDriver
{
    protected array $balance;
    /**
     * @return $this
     */
    public function update() : self
    {
        $balance = $this->fetchBalances();
        $this->balance = $balance;
        $this->saveBalances($balance);
        TestHelper::save2file('binance_credentials', $this->getApi()->exchange->requiredCredentials);
        TestHelper::save2file('binance_balance', $balance);
        TestHelper::save2file('binance_apis', $this->getApi()->exchange);

        // TestHelper::save2file('../test_balances.php', $balance);


        // $transactions = $this->fetchTransactions($this->account->fetched_at);
        // $this->saveTransactions($transactions);

// */
        // $this->saveTransactions($all_trades_for_all_symbols);

        $since = $this->account->fetched_at;
        $transactions = [];
        $withdrawals = [];
        $deposits = [];
        $trades = $this->fetchTrades($this->account->fetched_at);
        // if ($this->api->getTransactionsAvailable())
        // {
        //     $transactions = $this->fetchTransactions($this->account->fetched_at);
        // }
        // if ($this->api->getWithdrawalsAvailable())
        // {
        //     $withdrawals = $this->fetchWithdrawals($this->account->fetched_at);
        // }
        // if ($this->api->getDepositsAvailable())
        // {
        //     $deposits = $this->fetchDeposits($this->account->fetched_at);
        // }

        TestHelper::save2file('binance_balance', $balance);
        // TestHelper::save2file('binance_trades', $trades);
        TestHelper::save2file('binance_transactions', $transactions);
        TestHelper::save2file('binance_withdrawals', $withdrawals);
        TestHelper::save2file('binance_deposits', $deposits);

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
        $exchange_id = 'binance';
        $credentials = $this->getCredentials();
        $this->connected = $this->api->loadExchange($exchange_id, [
            'apiKey' => $credentials["apiKey"],
            'secret' => $credentials["secret"],
        ]);
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
        $result = [];
        foreach ($spot_balance as $key => $value) {
            switch ($key) {
                case 'LDUSDT':
                    if (array_key_exists('USDT', $result)) {
                        $result['USDT'] += $value;
                    } else {
                        $result['USDT'] = $value;
                    }
                    break;
                case 'LDBNB':
                    if (array_key_exists('LDBNB', $result)) {
                        $result['BNB'] += $value;
                    } else {
                        $result['BNB'] = $value;
                    }
                    break;
                default:
                    if (array_key_exists($key, $result)) {
                        $result[$key] += $value;
                    }
                    break;
            }
        }
        TestHelper::save2file('ccxt_balance_spot', $result);
        return $result;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        $pfrom = $from != null ? $from : $this->found_time;
        //  https://binance-docs.github.io/apidocs/spot/en/#account-trade-list-user_data
        $exchange = $this->getApi()->exchange;
        // date_default_timezone_set ('UTC');
        $total = $this->balance;
        // var_dump($this->balance);
        $all_matching_symbols = [];

        foreach ($total as $currency_code => $value) {
            if ($value > 0) {
                var_dump($currency_code);
                $matching_markets = array_filter(array_values($exchange->markets), function ($market) use ($currency_code) {
                    return ($market['base'] === $currency_code) || ($market['quote'] === $currency_code);
                });
                $matching_symbols = $exchange->pluck ($matching_markets, 'symbol');
                $all_matching_symbols = array_merge ($all_matching_symbols, $matching_symbols);
            }
        }

        var_dump($all_matching_symbols);
        $unique_symbols = $exchange->unique ($all_matching_symbols);

        $all_trades_for_all_symbols = [];
        TestHelper::save2file('binance_matching_symbols', $all_matching_symbols);
        TestHelper::save2file('binance_unique_symbols', $unique_symbols);
        TestHelper::save2file('binance_exchange_symbols', $exchange->symbols);

        function fetch_all_my_trades($exchange, $symbol, $startTime) {
            $exchange->verbose = true;

            $since = $startTime;
            $from_id = '0';
            $limit = 1000;
            $params = [
                'fromId' => $from_id,
                'limit' => $limit
            ];

            $all_trades = [];
            $count = 0;
            do {
                $trades = $exchange->fetch_my_trades($symbol, $since, null, $params);
                $count = count($trades);
                if ($count > 0) {
                    $since = $trades[$count-1]['timestamp'];
                    $all_trades = array_merge($all_trades, $trades);
                }
            } while ($count == $limit);
            return $all_trades;
        }

        // Fetch all trades
        foreach ($unique_symbols as $symbol) {
            // fetch all trades for the $symbol, with pagination
            $trades = fetch_all_my_trades($exchange, $symbol, $pfrom->getTimestampMs());
            $all_trades_for_all_symbols = array_merge ($all_trades_for_all_symbols, $trades);
        }
        // $symbol = 'USDT/';
        // $all_trades_for_all_symbols = fetch_all_my_trades($exchange, $symbol, $pfrom->getTimestampMs());

        // var_dump($all_matching_symbols);
        TestHelper::save2file('binance_trades', $all_trades_for_all_symbols);
        return $all_trades_for_all_symbols;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        $exchange = $this->api->exchange;
        // $exchange->verbose = true;

        // https://exchange-docs.crypto.com/spot/index.html#rate-limits
        // https://binance-docs.github.io/apidocs/spot/en/#deposit-history-supporting-network-user_data

        $pfrom = $from != null ? $from : $this->found_time;

        $all_deposits = [];
        while ($pfrom->isPast()) {
            $count = 0;
            do {
                $deposits = $exchange->fetch_deposits(null, null, null, [
                    'startTime' => $pfrom->getTimestampMs(),
                    'endTime' => $pfrom->getTimestampMs() + 90 * 24 * 3600 * 1000,
                    'offset' => 0,
                ]);
                $all_deposits = array_merge($all_deposits, $deposits);
                $count = count($deposits);
            } while ($count == 1000);
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
        // $exchange->verbose = true;

        // https://exchange-docs.crypto.com/spot/index.html#rate-limits
        // https://binance-docs.github.io/apidocs/spot/en/#withdraw-history-supporting-network-user_data

        $pfrom = $from != null ? $from : $this->found_time;

        $all_withdrawals = [];
        while ($pfrom->isPast()) {
            $count = 0;
            do {
                $withdrawals = $exchange->fetch_withdrawals(null, null, null, [
                    'startTime' => $pfrom->getTimestampMs(),
                    'endTime' => $pfrom->getTimestampMs() + 90 * 24 * 3600 * 1000,
                    'offset' => 0,
                ]);
                $all_withdrawals = array_merge($all_withdrawals, $withdrawals);
                $count = count($withdrawals);
            } while ($count == 1000);
            $pfrom->addDays(90);
        }
        return $all_withdrawals;
    }
}
