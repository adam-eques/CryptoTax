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
    /**
     * @return $this
     */
    public function update() : self
    {
        $balance = $this->fetchBalances();
        $this->saveBalances($balance);
        TestHelper::save2file('binance_credentials', $this->getApi()->exchange->requiredCredentials);
        TestHelper::save2file('binance_balance', $balance);
        TestHelper::save2file('binance_apis', $this->getApi()->exchange);

        // TestHelper::save2file('../test_balances.php', $balance);


        // $transactions = $this->fetchTransactions($this->account->fetched_at);
        // $this->saveTransactions($transactions);

        //  https://binance-docs.github.io/apidocs/spot/en/#account-trade-list-user_data
        $exchange = $this->getApi()->exchange;

        date_default_timezone_set ('UTC');
        $total = $balance;

        $all_matching_symbols = array();

        foreach ($total as $currency_code => $value) {

            echo "-------------------------------------------------------------------\n";
            echo "Currency code: ", $currency_code, " value: ", $value, "\n";

            // if ($value >= 0) {

                // get all related markets with
                //   either base currency === currency code from the balance structure
                //      or quote currency === currency code from the balance structure

                $matching_markets = array_filter(array_values($exchange->markets), function ($market) use ($currency_code) {
                    return ($market['base'] === $currency_code) || ($market['quote'] === $currency_code);
                });

                $matching_symbols = $exchange->pluck ($matching_markets, 'symbol');

                echo "Matching symbols:\n";
                print_r($matching_symbols);

                $all_matching_symbols = array_merge ($all_matching_symbols, $matching_symbols);
            // }
        }

        echo "========================================================================\n";
        $unique_symbols = $exchange->unique ($all_matching_symbols);
        print_r($unique_symbols);

        $all_trades_for_all_symbols = array();
        TestHelper::save2file('binance_unique_symbols', $unique_symbols);

        // ----------------------------------------------------------------------------
/*
        function fetch_all_my_trades($exchange, $symbol) {
            $exchange->verbose = true;

            $from_id = '0';
            $params = array('fromId' => $from_id);
            $previous_from_id = $from_id;

            $all_trades = array();

            while (true) {

                echo "------------------------------------------------------------------\n";
                echo "Fetching with params:\n";
                print_r($params);
                $trades = $exchange->fetch_my_trades($symbol, null, null, $params);
                echo "Fetched ", count($trades), ' ', $symbol, " trades\n";
                if (count($trades)) {
                    $last_trade = $trades[count($trades) - 1];
                    if ($last_trade['id'] == $previous_from_id) {
                        break;
                    } else {
                        $params['fromId'] = $last_trade['id'];
                        $previous_from_id = $last_trade['id'];
                        $all_trades = array_merge ($all_trades, $trades);
                    }
                } else {
                    break;
                }
            }

            echo "Fetched ", count($all_trades), ' ', $symbol, " trades\n";
            for ($i = 0; $i < count($all_trades); $i++) {
                $trade = $all_trades[$i];
                echo $i, ' ', $trade['symbol'], ' ', $trade['id'], ' ', $trade['datetime'], ' ', $trade['amount'], "\n";
            }

            return $all_trades;
        }

        // ----------------------------------------------------------------------------

  //      TestHelper::save2file('../binance_unique_symbols.php', $unique_symbols);

        foreach ($unique_symbols as $symbol) {

            echo "=================================================================\n";
            echo "Fetching all ", $symbol, " trades\n";

            // fetch all trades for the $symbol, with pagination
            $trades = fetch_all_my_trades($exchange, $symbol);

            echo count($trades), ' ' , $symbol, " trades\n";

            $all_trades_for_all_symbols = array_merge ($all_trades_for_all_symbols, $trades);

        }


        // var_dump($all_matching_symbols);
        TestHelper::save2file('binance_trades', $all_trades_for_all_symbols);
*/
        // $this->saveTransactions($all_trades_for_all_symbols);

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
        TestHelper::save2file('ccxt_balance_spot', $spot_balance);
        return $spot_balance;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        //  https://binance-docs.github.io/apidocs/spot/en/#account-trade-list-user_data
        $exchange = $this->getApi()->exchange;
        $all_trades = [];
        /*
        date_default_timezone_set ('UTC');
        $total = $balance;

        $all_matching_symbols = array();

        foreach ($total as $currency_code => $value) {

            echo "-------------------------------------------------------------------\n";
            echo "Currency code: ", $currency_code, " value: ", $value, "\n";

            // if ($value >= 0) {

                // get all related markets with
                //   either base currency === currency code from the balance structure
                //      or quote currency === currency code from the balance structure

                $matching_markets = array_filter(array_values($exchange->markets), function ($market) use ($currency_code) {
                    return ($market['base'] === $currency_code) || ($market['quote'] === $currency_code);
                });

                $matching_symbols = $exchange->pluck ($matching_markets, 'symbol');

                echo "Matching symbols:\n";
                print_r($matching_symbols);

                $all_matching_symbols = array_merge ($all_matching_symbols, $matching_symbols);
            // }
        }

        echo "========================================================================\n";
        $unique_symbols = $exchange->unique ($all_matching_symbols);
        print_r($unique_symbols);

        $all_trades_for_all_symbols = array();

        // ----------------------------------------------------------------------------

        function fetch_all_my_trades($exchange, $symbol) {
            $exchange->verbose = true;

            $from_id = '0';
            $params = array('fromId' => $from_id);
            $previous_from_id = $from_id;

            $all_trades = array();

            while (true) {

                echo "------------------------------------------------------------------\n";
                echo "Fetching with params:\n";
                print_r($params);
                $trades = $exchange->fetch_my_trades($symbol, null, null, $params);
                echo "Fetched ", count($trades), ' ', $symbol, " trades\n";
                if (count($trades)) {
                    $last_trade = $trades[count($trades) - 1];
                    if ($last_trade['id'] == $previous_from_id) {
                        break;
                    } else {
                        $params['fromId'] = $last_trade['id'];
                        $previous_from_id = $last_trade['id'];
                        $all_trades = array_merge ($all_trades, $trades);
                    }
                } else {
                    break;
                }
            }

            echo "Fetched ", count($all_trades), ' ', $symbol, " trades\n";
            for ($i = 0; $i < count($all_trades); $i++) {
                $trade = $all_trades[$i];
                echo $i, ' ', $trade['symbol'], ' ', $trade['id'], ' ', $trade['datetime'], ' ', $trade['amount'], "\n";
            }

            return $all_trades;
        }

        // ----------------------------------------------------------------------------

  //      TestHelper::save2file('../binance_unique_symbols.php', $unique_symbols);

        foreach ($unique_symbols as $symbol) {

            echo "=================================================================\n";
            echo "Fetching all ", $symbol, " trades\n";

            // fetch all trades for the $symbol, with pagination
            $trades = fetch_all_my_trades($exchange, $symbol);

            echo count($trades), ' ' , $symbol, " trades\n";

            $all_trades_for_all_symbols = array_merge ($all_trades_for_all_symbols, $trades);

        }
        */
        return $all_trades;

    }
}
