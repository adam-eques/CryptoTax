<?php

namespace App\Blockchains;
date_default_timezone_set('UTC');
use CCXT\Exchange;
use CCXT;
use Exception;

class CCXTAPI {
    public $exchange;
    protected $exchange_id;

    // balance types
    const BALANCE_TYPE_TRADE =      'trade';
    const BALANCE_TYPE_TRADING =    'trading';
    const BALANCE_TYPE_SPOT =       'spot';
    const BALANCE_TYPE_MARGIN =     'margin';
    const BALANCE_TYPE_MAIN =       'main';
    const BALANCE_TYPE_FUNDING =    'funding';
    const BALANCE_TYPE_FUTURE =     'future';
    const BALANCE_TYPE_FUTURES =    'futures';
    const BALANCE_TYPE_CONTRACT =   'contract';
    const BALANCE_TYPE_POOL =       'pool';
    const BALANCE_TYPE_POOLX =      'pool-x';

    public function __construct()
    {
        $exchange = NULL;
    }

    public function loadExchange($exchange_id, $credentials)
    {
        $flag = false;
        try {
            $exchange_class = "\\ccxt\\" . strtolower($exchange_id);
            $this->exchange = new $exchange_class($credentials);
            $this->exchange->load_markets();
            $flag = true;
        } catch (\Throwable $th) {
            throw $th;
        }
        $this->exchange_id = $exchange_id;
        return $flag;
    }

    public function getBalance($type)
    {
        $balance = [];
        try {
            $tmp = $this->exchange->fetchBalance([
                'type'=> $type
            ]);
            $balance = $tmp['total'];
        } catch (\Throwable $th) {
            //throw $th;
            $balance = [];
        }
        return $balance;
    }

    public function getBalanceAvailable()
    {
        return $this->exchange->has['fetchBalance'];
    }

    // $since -> timestamp in seconds
    public function getTrades($symbol, $since, $limit)
    {
        $all_trades = [];
        while ($since < $this->exchange->seconds())
        {
            var_dump($since);
            $trades = $this->exchange->fetchMyTrades($symbol, $since*1000, $limit);

            if (count($trades))
            {
                $since = $trades[count($trades) - 1]['timestamp'] + 1;
                $all_trades = array_merge ($all_trades, $trades);
            } else {
                break;
            }
        }

        return $all_trades;
    }

    public function getTradesAvailable($fromSymbol, $toSymbol)
    {
        $flag = false;
        $symbol = $this->genSymbol($fromSymbol, $toSymbol);
        if ($this->exchange->has['fetchMyTrades'] && array_search($symbol, $this->exchange->symbols) > -1)
        {
            $flag = true;
        }
        return $flag;
    }

    public function getTransactions($since=NULL) : array
    {
        $code = NULL;
        $limit = NULL;
        $params = [
            // 'type' => 'withdrawal'
        ];
        $transactions = [];
        if ($this->exchange->has['fetchTransactions'])
        {
            $transactions = $this->exchange->fetch_transactions ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_transactions method');
        }
        return $transactions;
    }

    public function getTransactionsAvailable()
    {
        $flag = false;
        if ($this->exchange->has['fetchTransactions'])
        {
            $flag = true;
        }
        return $flag;
    }

    public function getDeposits($since)
    {
        $code = NULL;
        $limit = NULL;
        $params = [];
        $transactions = [];
        if ($this->exchange->has['fetchDeposits'])
        {
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
        if ($this->exchange->has['fetchWithdrawals'])
        {
            $transactions = $this->exchange->fetch_withdrawals ($code, $since, $limit, $params);
        } else {
            throw new Exception ($this->exchange->id . ' does not have the fetch_withdrawals method');
        }
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
        if ($this->exchange->has['fetchTransfers'])
        {
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
        if ($this->exchange->has['fetchLedger'])
        {
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

    public function genSymbol($fromSymbol, $toSymbol)
    {
        return $fromSymbol.'/'.$toSymbol;
    }

    public static function supportedList()
    {
        return Exchange::$exchanges;
    }

    public function getExchangeId()
    {
        return $this->exchange_id;
    }

    public function possibleMethods()
    {
        return $this->exchange->has;
    }
}
