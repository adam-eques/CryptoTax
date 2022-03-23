<?php

namespace App\Blockchains;
date_default_timezone_set('UTC');
use CCXT\Exchange;
use CCXT;
use Exception;

class CCXTAPI {
    public $exchange;
    protected $exchange_id;

    public function __construct() {
        $exchange = NULL;
        // var_dump (ccxt\Exchange::$exchanges);


        // $poloniex = new \ccxt\poloniex();
        // $bittrex  = new \ccxt\bittrex(array ('verbose' => true));
        // // $quoinex  = new \ccxt\quoinex();
        // $zaif     = new \ccxt\zaif     (array (
        //     'apiKey' => 'YOUR_PUBLIC_API_KEY',
        //     'secret' => 'YOUR_SECRET_PRIVATE_KEY',
        // ));
        // $hitbtc   = new \ccxt\hitbtc   (array (
        //     'apiKey' => 'YOUR_PUBLIC_API_KEY',
        //     'secret' => 'YOUR_SECRET_PRIVATE_KEY',
        // ));

        // $exchange_id = 'binance';
        // $exchange_class = "\\ccxt\\$exchange_id";
        // $exchange = new $exchange_class (array (
        //     'apiKey' => 'YOUR_API_KEY',
        //     'secret' => 'YOUR_SECRET',
        // ));

        // $poloniex_markets = $poloniex->load_markets ();

        // var_dump ($poloniex_markets);
        // var_dump ($bittrex->load_markets ());
        // // var_dump ($quoinex->load_markets ());

        // var_dump ($poloniex->fetch_order_book ($poloniex->symbols[0]));
        // var_dump ($bittrex->fetch_trades ('BTC/USD'));
        // // var_dump ($quoinex->fetch_ticker ('ETH/EUR'));
        // var_dump ($zaif->fetch_ticker ('BTC/JPY'));

        // var_dump ($zaif->fetch_balance ());

        // // sell 1 BTC/JPY for market price, you pay ¥ and receive ฿ immediately
        // var_dump ($zaif->id, $zaif->create_market_sell_order ('BTC/JPY', 1));

        // // buy BTC/JPY, you receive ฿1 for ¥285000 when the order closes
        // var_dump ($zaif->id, $zaif->create_limit_buy_order ('BTC/JPY', 1, 285000));

        // // set a custom user-defined id to your order
        // $hitbtc->create_order ('BTC/USD', 'limit', 'buy', 1, 3000, array ('clientOrderId' => '123'));
    }

    public function loadExchange($exchange_id, $credentials) {
        $flag = false;
        try {
            $exchange_class = "\\ccxt\\" . strtolower($exchange_id);
            $this->exchange = new $exchange_class($credentials);
            var_dump('before load', $credentials);
            $this->exchange->load_markets();
            $flag = true;
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->exchange_id = $exchange_id;
        return $flag;
    }

    public function getBalance() {
        // $this->exchange->verbose = true;
        // $this->exchange->options['defaultType'] = 'future';
        return $this->exchange->fetchBalance();
    }

    public function getBalanceAvailable() {
        return $this->exchange->has['fetchBalance'];
    }

    // $since -> timestamp in seconds
    public function getTrades($symbol, $since, $limit) {
        $all_trades = [];
        var_dump($since);
        var_dump($this->exchange->seconds());

        var_dump($since);
        while ($since < $this->exchange->seconds()) {
            $trades = $this->exchange->fetchMyTrades($symbol, $since*1000, $limit);
            // var_dump($symbol, $since, $limit);

            if (count($trades)) {
                $since = $trades[count($trades) - 1]['timestamp'] + 1;
                $all_trades = array_merge ($all_trades, $trades);
            } else {
                break;
            }
        }

        return $all_trades;
    }

    public function getTradesAvailable($fromSymbol, $toSymbol) {
        $flag = false;
        $symbol = $this->genSymbol($fromSymbol, $toSymbol);
        if ($this->exchange->has['fetchMyTrades'] && array_search($symbol, $this->exchange->symbols) > -1) {
            $flag = true;
        }
        return $flag;
    }

    public function getTransactions($since=NULL) : array {
        $code = NULL;
        $limit = NULL;
        $params = [
            'type' => 'withdrawal'
        ];
        $transactions = [];
        if ($this->exchange->has['fetchTransactions']) {
            $transactions = $this->exchange->fetch_transactions ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_transactions method');
        }
        return $transactions;
    }

    public function getTransactionsAvailable() {
        $flag = false;
        if ($this->exchange->has['fetchTransactions']) {
            $flag = true;
        }
        return $flag;
    }

    public function getDeposits($since) {
        $code = NULL;
        $limit = NULL;
        $params = [];
        $transactions = [];
        if ($this->exchange->has['fetchDeposits']) {
            $transactions = $this->exchange->fetch_deposits ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_deposits method');
        }
        return $transactions;
    }

    public function getDepositsAvailable()
    {
        return $this->exchange->has['fetchDeposits'];
    }

    public function getWithdrawals($since=NULL)
    {
        $code = NULL;
        $limit = NULL;
        $params = NULL;
        $transactions = [];
        if ($this->exchange->has['fetchWithdrawals']) {
            $transactions = $this->exchange->fetch_withdrawals ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_withdrawals method');
        }
        var_dump($transactions);
        return $transactions;
    }

    public function getWithdrawalsAvailable()
    {
        return $this->exchange->has['fetchWithdrawals'];
    }

    public function getTransfers($since=NULL)
    {
        $code = NULL;
        $limit = NULL;
        $params = [];
        $transactions = [];
        if ($this->exchange->has['fetchTransfers']) {
            $transactions = $this->exchange->fetch_transfers ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_transfers method');
        }
        return $transactions;
    }

    public function getTransfersAvailable() {
        return $this->exchange->has['fetchTransfers'];
    }

    public function getLedger($since=null) : array
    {
        $code = null;
        $limit = null;
        $params = [];
        $ledger = [];
        if ($this->exchange->has['fetchLedger']) {
            $ledger = $this->exchange->fetch_ledger ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_ledger method');
        }
        return $ledger;
    }

    public function getLedgerAvailable()
    {
        return $this->exchange->has['fetchLedger'];
    }

    public function genSymbol($fromSymbol, $toSymbol) {
        return $fromSymbol.'/'.$toSymbol;
    }

    public static function supportedList() {
        return Exchange::$exchanges;
    }

    public function getExchangeId() {
        return $this->exchange_id;
    }

    public function possibleMethods() {
        return $this->exchange->has;
    }


}
