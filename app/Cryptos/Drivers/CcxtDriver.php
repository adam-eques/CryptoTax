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
    abstract public function getRequiredCredentials(): array;

    /**
     * @return $this
     */
    public function update() : self
    {
        $balance = $this->fetchBalances();
        $transactions = $this->fetchTransactions($this->account->fetched_at);
        $this->saveBalances($balance);
        $this->saveTransactions($transactions);
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
        $balances = $this->api->getBalance();
        return $balances;
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
        $transactions = $this->api->getTrades(NULL, $pfrom->timestamp, NULL);
        return $transactions;
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
        TestHelper::save2file('..\CcxtDriver_unsupported_balances.php', $unsupported);
        return $flag;
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

    public function possibleMethods() {
        return $this->api->possibleMethods();
    }
}
