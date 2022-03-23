<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use App\Models\CryptoAsset;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Blockchains\CCXTAPI;
use Carbon\Carbon;
use App\Helpers\TestHelper;


abstract class CcxtDriver implements ApiDriverInterface
{
    protected CryptoAccount $account;
    protected $api;
    protected $connected = false;
    protected Carbon $found_time;   /**Datetime exchange found */
    protected $rate_limit;   /**rate limit persecond => miliseconds per request */

    /**
     * @param CryptoAccount $account
     * @return ApiDriverInterface
     */
    public static function make(CryptoAccount $account): self
    {
        $obj = new static();
        $obj->account = $account;
        $obj->connect();

        return $obj;
    }

    /**
     * @return array
     */
    // abstract public function getRequiredCredentials(): array;
    public function getRequiredCredentials(): array {
        return [];
    }

    /**
     * @return $this
     */
    public function update() : self
    {
        $exchange = $this->api->exchange;

        TestHelper::save2file('ccxt_api', $exchange);
        TestHelper::save2file('ccxt_has', $exchange->has);

        $since = $this->account->fetched_at;
        $balance = $this->fetchBalances();
        $trades = $this->fetchTrades($since);
        $transactions = [];
        $withdrawals = [];
        $deposits = [];
        if ($this->api->getTransactionsAvailable()) {
            $transactions = $this->fetchTransactions($since);
            // TestHelper::save2file('../HitBtc_transactions.php', $transactions);
        }
        if ($this->api->getWithdrawalsAvailable()) {
            $withdrawals = $this->fetchWithdrawals($since);
        }
        if ($this->api->getDepositsAvailable()) {
            $deposits = $this->fetchDeposits($since);
        }

        TestHelper::save2file('ccxt_balance', $balance);
        TestHelper::save2file('ccxt_trades', $trades);
        TestHelper::save2file('ccxt_transactions', $transactions);
        TestHelper::save2file('ccxt_withdrawals', $withdrawals);
        TestHelper::save2file('ccxt_deposits', $deposits);

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
     */
    abstract protected function connect(): self;

    /**
     * @return App\Blockchains\CCXTAPI
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return bool
     */
    public function isConnected() : bool {
        return $this->connected;
    }

    /**
     * @return array
     */
    protected function getCredentials() : array
    {
        return $this->account->credentials ?: [];
    }

    /**
     * @return array
     */
    protected function fetchBalances() : array
    {
        var_dump("fetchBalance");
        $balances = $this->api->getBalance();
        return $balances;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTrades(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
            $pfrom = Carbon::create(2017, 1, 1);
        }
        $trades = $this->api->getTrades(NULL, $pfrom->timestamp, NULL);
  //      TestHelper::save2file('..\CcxtDriver_trades.php', $trades);
        return $trades;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTransactions(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
            $pfrom = Carbon::create(2000, 1, 1);
        }
        $transactions = $this->api->getTransactions($pfrom->timestamp);
        return $transactions;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchDeposits(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
            $pfrom = Carbon::create(2000, 1, 1);
        }
        $deposits = $this->api->getDeposits($pfrom->timestamp);
        return $deposits;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchWithdrawals(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
            $pfrom = Carbon::create(2000, 1, 1);
        }
        $withdrawals = $this->api->getWithdrawals($pfrom->timestamp);
        return $withdrawals;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    protected function fetchTransfers(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
            $pfrom = Carbon::create(2000, 1, 1);
        }
        $transfers = $this->api->getTransfers($pfrom->timestamp);
        return $transfers;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    public function fetchLedger(Carbon $from = null): array
    {
        $pfrom = $from;
        if ($from == null)
        {
            $pfrom = Carbon::create(2000, 1, 1);
        }
        $ledger = $this->api->getLedger($pfrom->timestamp);
        return $ledger;
    }


    /**
     * @param array $balance
     * @return bool
     */
    protected function saveBalances($balanceData) : bool
    {
        $flag = false;
        $balances = $balanceData['total'];
        $unsupported = [];
        foreach($balances as $currency => $value)
        {
            $cc = CryptoCurrency::findByShortName($currency);
            if ($cc == NULL)
            {
                // var_dump($currency);
                array_push($unsupported, [
                    'currency' => $currency,
                    'value' => $value
                ]);
            } else {
                $currencyId = $cc->id;
                $row = CryptoAsset::findByCurrency_Account($this->account->id, $currencyId);
                if ($row) {
                    $row->update([
                        'balance' => $value
                    ]);
                } else {
                    $row = new CryptoAsset();
                    $row->balance = $value;
                    $row->crypto_account_id = $this->account->id;
                    $row->crypto_currency_id = $currencyId;
                    $row->save();
                }
                $flag = true;
            }
        }
  //      TestHelper::save2file('..\CcxtDriver_balances.php', $balanceData);
  //      TestHelper::save2file('..\CcxtDriver_unsupported_balances.php', $unsupported);
        return $flag;
    }

    /**
     * @param array $transactions
     * @return bool
     */
    protected function saveTrades($transactions=[]) : bool
    {
        // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);
        $unsupported = [];
        foreach($transactions as $transaction)
        {
            $currencyId = -1;
            $costCurrencyId = -1;
            $priceCurrencyId = -1;
            $feeCurrencyId = -1;
            $tradeType = 'N';
            $executed_at = Carbon::createFromTimestampMsUTC($transaction['timestamp']);
            // $executed_at = new \DateTime();
            // $executed_at->setTimestamp($transaction['timestamp']);

            if ($transaction['side'] == 'sell') $tradeType = 'S';
            elseif ($transaction['side'] == 'buy') $tradeType = 'B';

            [$fromCurrency, $toCurrency] = explode('/', $transaction['symbol']);
            $fromCC = CryptoCurrency::findByShortName($fromCurrency);
            $toCC = CryptoCurrency::findByShortName($toCurrency);
            $feeCC = CryptoCurrency::findByShortName($transaction['fee']['currency']);
            if ( $fromCC == NULL || $toCC == NULL || $tradeType == 'N' || $fromCC->id < 0 || $toCC->id < 0 || $feeCC->id < 0)
            {
                array_push($transaction);
            } else {
                // var_dump($fromCC->id);
                $currencyId = $fromCC->id;
                $priceCurrencyId = $toCC->id;
                $costCurrencyId = $priceCurrencyId;
                $feeCurrencyId = $feeCC->id;

                // var_dump($currencyId);
                $trans = new CryptoTransaction();
                $trans->crypto_account_id = $this->account->id;
                $trans->currency_id = $currencyId;
                $trans->cost_currency_id = $costCurrencyId;
                $trans->price_currency_id = $priceCurrencyId;
                $trans->fee_currency_id = $feeCurrencyId;
                $trans->trade_type = $tradeType;
                $trans->from_addr = NULL;
                $trans->to_addr = NULL;
                $trans->amount = $transaction['amount'];
                $trans->price = $transaction['price'];
                $trans->cost = $transaction['cost'];
                $trans->fee = $transaction['fee']['cost'];
                $trans->raw_data = json_encode($transaction);
                $trans->executed_at = $executed_at;
                // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);

                $trans->save();
            }
        }
        // TestHelper::save2file('..\CcxtDriver_unsupported_transactions.php', $unsupported);
        return true;
    }


    /**
     * @param array $transactions
     * @return bool
     */
    protected function saveTransactions($transactions=[]) : bool
    {
        // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);
        $unsupported = [];
        foreach($transactions as $transaction)
        {
            if ($transaction['status'] != 'ok') continue;
            $currencyId = -1;
            $costCurrencyId = -1;
            $priceCurrencyId = -1;
            $feeCurrencyId = -1;
            $tradeType = 'N';
            $executed_at = Carbon::createFromTimestampMsUTC($transaction['timestamp']);

            if ($transaction['type'] == 'withdrawal') $tradeType = 'W';
            elseif ($transaction['type'] == 'deposit') $tradeType = 'D';

            $curCC = CryptoCurrency::findByShortName($transaction['currency']);
            $feeCC = NULL;
            if ($transaction['fee'] == NULL) {
                $feeCC = $curCC;
            } else {
                $feeCC = CryptoCurrency::findByShortName($transaction['fee']['currency']);
            }
            if ( $curCC == NULL || $tradeType == 'N' || $curCC->id < 0 )
            {
                array_push($unsupported, $transaction);
            } else {
                // var_dump($fromCC->id);
                $currencyId = $curCC->id;
                $priceCurrencyId = $currencyId;
                $costCurrencyId = $currencyId;
                $feeCurrencyId = $feeCC->id;

                // var_dump($currencyId);
                $trans = new CryptoTransaction();
                $trans->crypto_account_id = $this->account->id;
                $trans->currency_id = $currencyId;
                $trans->cost_currency_id = $costCurrencyId;
                $trans->price_currency_id = $priceCurrencyId;
                $trans->fee_currency_id = $feeCurrencyId;
                $trans->trade_type = $tradeType;
                $trans->from_addr = NULL;
                $trans->to_addr = NULL;
                $trans->amount = $transaction['amount'];
                $trans->price = 1;
                $trans->cost = $trans->amount;
                if ($transaction['fee'] == NULL) $trans->fee = 0;
                else $trans->fee = $transaction['fee']['cost'];
                $trans->raw_data = json_encode($transaction);
                $trans->executed_at = $executed_at;
                // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);

                $trans->save();
            }
        }
  //      TestHelper::save2file('..\CcxtDriver_unsupported_transactions.php', $unsupported);
        return true;
    }

        /**
     * @param array $transactions
     * @return bool
     */
    protected function saveWithdrawals($withdrawals=[]) : bool
    {
        // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);
        $unsupported = [];
        foreach($withdrawals as $withdrawal)
        {
            if ($withdrawal['status'] != 'ok') continue;
            $currencyId = -1;
            $costCurrencyId = -1;
            $priceCurrencyId = -1;
            $feeCurrencyId = -1;
            $tradeType = 'W';
            $executed_at = Carbon::createFromTimestampMsUTC($withdrawal['timestamp']);

            $curCC = CryptoCurrency::findByShortName($withdrawal['currency']);
            $feeCC = NULL;
            if ($withdrawal['fee'] == NULL) {
                $feeCC = $curCC;
            } else {
                $feeCC = CryptoCurrency::findByShortName($withdrawal['fee']['currency']);
            }
            if ( $curCC == NULL || $tradeType == 'N' || $curCC->id < 0 )
            {
                array_push($unsupported, $withdrawal);
            } else {
                // var_dump($fromCC->id);
                $currencyId = $curCC->id;
                $priceCurrencyId = $currencyId;
                $costCurrencyId = $currencyId;
                $feeCurrencyId = $feeCC->id;

                // var_dump($currencyId);
                $trans = new CryptoTransaction();
                $trans->crypto_account_id = $this->account->id;
                $trans->currency_id = $currencyId;
                $trans->cost_currency_id = $costCurrencyId;
                $trans->price_currency_id = $priceCurrencyId;
                $trans->fee_currency_id = $feeCurrencyId;
                $trans->trade_type = $tradeType;
                $trans->from_addr = $this->account->addressFrom;
                $trans->to_addr = $this->account->addressTo;
                $trans->amount = $withdrawal['amount'];
                $trans->price = 1;
                $trans->cost = $trans->amount;
                if ($withdrawal['fee'] == NULL) $trans->fee = 0;
                else $trans->fee = $withdrawal['fee']['cost'];
                $trans->raw_data = json_encode($withdrawal);
                $trans->executed_at = $executed_at;
                // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);

                $trans->save();
            }
        }
  //      TestHelper::save2file('..\CcxtDriver_unsupported_withdrawals.php', $unsupported);
        return true;
    }

    protected function saveDeposits($deposits=[]) : bool
    {
        // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);
        $unsupported = [];
        foreach($deposits as $deposit)
        {
            if ($deposit['status'] != 'ok') continue;
            $currencyId = -1;
            $costCurrencyId = -1;
            $priceCurrencyId = -1;
            $feeCurrencyId = -1;
            $tradeType = 'D';
            $executed_at = Carbon::createFromTimestampMsUTC($deposit['timestamp']);

            $curCC = CryptoCurrency::findByShortName($deposit['currency']);
            $feeCC = NULL;
            if ($deposit['fee'] == NULL) {
                $feeCC = $curCC;
            } else {
                $feeCC = CryptoCurrency::findByShortName($deposit['fee']['currency']);
            }
            if ( $curCC == NULL || $tradeType == 'N' || $curCC->id < 0 )
            {
                array_push($unsupported, $deposit);
            } else {
                // var_dump($fromCC->id);
                $currencyId = $curCC->id;
                $priceCurrencyId = $currencyId;
                $costCurrencyId = $currencyId;
                $feeCurrencyId = $feeCC->id;

                // var_dump($currencyId);
                $trans = new CryptoTransaction();
                $trans->crypto_account_id = $this->account->id;
                $trans->currency_id = $currencyId;
                $trans->cost_currency_id = $costCurrencyId;
                $trans->price_currency_id = $priceCurrencyId;
                $trans->fee_currency_id = $feeCurrencyId;
                $trans->trade_type = $tradeType;
                $trans->from_addr = $this->account->addressFrom;
                $trans->to_addr = $this->account->addressTo;
                $trans->amount = $deposit['amount'];
                $trans->price = 1;
                $trans->cost = $trans->amount;
                if ($deposit['fee'] == NULL) $trans->fee = 0;
                else $trans->fee = $deposit['fee']['cost'];
                $trans->raw_data = json_encode($deposit);
                $trans->executed_at = $executed_at;
                // TestHelper::save2file('..\CcxtDriver_transactions.php', $transactions);

                $trans->save();
            }
        }
  //      TestHelper::save2file('..\CcxtDriver_unsupported_deposits.php', $unsupported);
        return true;
    }

    public function possibleMethods() {
        return $this->api->possibleMethods();
    }
}
