<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use App\Models\CryptoAsset;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Blockchains\CCXTAPI;
use Carbon\Carbon;
use GuzzleHttp\Client;


class CronosDriver implements ApiDriverInterface
{
    protected CryptoAccount $account;
    protected $api;
    protected float $UNIT = 0.0;

    function __construct() {
        $this->UNIT = pow(10, -18);
    }

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
    public function getRequiredCredentials(): array
    {
        return ['address'];
    }

    /**
     * @return array
     */
    protected function getCredentials() : array
    {
        return $this->account->credentials ?: [];
    }

    /**
     * @return $this
     */
    public function update(): self
    {
        $balance = $this->fetchBalances();
        $transactions = $this->fetchTransactions($this->account->fetched_at);
        $this->saveBalances($balance);
        $this->saveTransactions($transactions);
        $this->account->update(['fetched_at' => now()]);
        return $this;
    }

    /**
     * @return api
     */
    public function getApi() : Client {
        return $this->api;
    }


    /**
     * @return bool
     */
    public function isConnected() : bool {
        return true;
    }

    /**
     * @return $this
     */
    protected function connect(): self
    {
        $this->api = new Client([
            'base_uri' => 'https://cronos.org/explorer/api',
        ]);
        return $this;
    }

    /**
     * @return array
     */
    public function fetchBalance() : float
    {
        $address = $this->getCredentials()['address'];
        // https://cronos.org/explorer/api-docs
        $result = $this->api->request(
            'GET',
            '',
            [
                'query' => [
                    'module' => 'account',
                    'action' => 'balance',
                    'address' => $address,
                ]
            ]
        );
        $result = json_decode($result->getBody()->getContents());
        return floatval($result->result) * $this->UNIT;
    }

    /**
     * @param \Carbon\Carbon $from
     * @return array
     */
    public function fetchTransactions(Carbon $from = null): array {
        $address = $this->getCredentials()['address'];
        $sort = 'asc'; /**asc|desc */
        $page = 0;
        $offset = 0;
        $starttimestamp = $from->timestamp;
        $endtimestamp = now()->timestamp;
        // https://cronos.org/explorer/api-docs
        $result = $this->api->request(
            'GET',
            '',
            [
                'query' => [
                    'module' => 'account',
                    'action' => 'txlist',
                    'address' => $address,
                    'sort' => $sort,
                    'page' => $page,
                    'offset' => $offset,
                    'starttimestamp' => $starttimestamp,
                    'endtimestamp' => $endtimestamp,
                ]
            ]
        );
        $result = json_decode($result->getBody()->getContents());
        return $result->result;
    }


    /**
     * @param array $balance
     * @return bool
     */
    public function saveBalances($balance) : bool
    {
        $assets = $this->account->cryptoAssets();
        $currencyId = CryptoCurrency::findByShortName('CRO')->id;
        $create = true;
        foreach($assets->get() as $asset)
        {
            if ($asset->crypto_currency_id === $currencyId)
            {
                // assets.bal
                $asset->update(['balance' => $balance]);
                $create = false;
            }
        }
        if ($create) {
            $asset = new CryptoAsset();
            $asset->balance = $balance;
            $asset->crypto_account_id = $this->account->id;
            $asset->crypto_currency_id = $currencyId;
            $asset->save();
        }
        return true;
    }

    /**
     * @param array $transactions
     * @return bool
     */
    public function saveTransactions($transactions) : bool
    {
        foreach($transactions as $transaction)
        {
            // not sure
            $currencyId = CryptoCurrency::findByShortName('CRO')->id;
            $fee = 0;

            $costCurrencyId = $currencyId;
            $priceCurrencyId = $currencyId;
            $feeCurrencyId = $currencyId;
            $credentials = $this->getCredentials();
            $tradeType = 'N';
            $executed_at = new \DateTime();
            $executed_at->setTimestamp($transaction->timestamp);
            $trans = new CryptoTransaction();

            if ($credentials['address'] == $transaction->from) {
                $tradeType = 'S';
            }

            $trans->from_addr = $transaction->from;
            $trans->to_addr = $transaction->to;
            $trans->amount = $transaction->value * $this->UNIT;
            $trans->cost = $transaction->value * $this->UNIT;
            $trans->fee = $fee;
            $trans->crypto_account_id = $this->account->id;
            $trans->currency_id = $currencyId;
            $trans->cost_currency_id = $costCurrencyId;
            $trans->price_currency_id = $priceCurrencyId;
            $trans->fee_currency_id = $feeCurrencyId;
            $trans->trade_type = $tradeType;
            $trans->price = 1;
            $trans->raw_data = json_encode($transaction);
            $trans->executed_at = $executed_at;
            $trans->save();
        }
        return true;
    }
}
