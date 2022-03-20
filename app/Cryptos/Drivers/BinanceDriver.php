<?php

namespace App\Cryptos\Drivers;

use App\Blockchains\CCXTAPI;
use App\Helpers\TestHelper;


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
        // TestHelper::save2file('../test_balances.php', $balance);


        // $transactions = $this->fetchTransactions($this->account->fetched_at);
        // $this->saveTransactions($transactions);

        date_default_timezone_set ('UTC');
        $exchange = $this->api->exchange;
        $total = $balance['total'];
        $all_matching_symbols = array();

        foreach ($total as $currency_code => $value)
        {
            if ($value > 0)
            {
                $matching_markets = array_filter(array_values($exchange->markets), function ($market) use ($currency_code) {
                    return ($market['base'] === $currency_code) || ($market['quote'] === $currency_code);
                });

                $matching_symbols = $exchange->pluck ($matching_markets, 'symbol');
                $all_matching_symbols = array_merge ($all_matching_symbols, $matching_symbols);
            }
        }
        $unique_symbols = $exchange->unique ($all_matching_symbols);

        $all_trades_for_all_symbols = array();

        function fetch_all_my_trades($exchange, $symbol)
        {
            $from_id = '0';
            $params = array('fromId' => $from_id);
            $previous_from_id = $from_id;

            $all_trades = array();

            while (true)
            {
                $trades = $exchange->fetch_my_trades($symbol, null, null, $params);
                if (count($trades))
                {
                    $last_trade = $trades[count($trades) - 1];
                    if ($last_trade['id'] == $previous_from_id)
                    {
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

            for ($i = 0; $i < count($all_trades); $i++)
            {
                $trade = $all_trades[$i];
                echo $i, ' ', $trade['symbol'], ' ', $trade['id'], ' ', $trade['datetime'], ' ', $trade['amount'], "\n";
            }

            return $all_trades;
        }

        foreach ($unique_symbols as $symbol)
        {
            $trades = fetch_all_my_trades($exchange, $symbol);
            $all_trades_for_all_symbols = array_merge ($all_trades_for_all_symbols, $trades);
        }

        // TestHelper::save2file('../binance_test_trades.php', $all_trades_for_all_symbols);
        $this->saveTransactions($all_trades_for_all_symbols);

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
            'apiKey' => \Arr::get($credentials, "apiKey"),
            'secret' => \Arr::get($credentials, "secret"),
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
}
