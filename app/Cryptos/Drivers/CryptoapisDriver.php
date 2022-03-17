<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use App\Models\CryptoAsset;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Blockchains\CryptoAPI;
use Carbon\Carbon;

class CryptoapisDriver implements ApiDriverInterface
{
    protected CryptoAccount $account;
    protected $api;
    protected $connected = false;

    /**
     * @param CryptoAccount $account
     * @return ApiDriverInterface
     */
    public static function make(CryptoAccount $account): ApiDriverInterface
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
        return ["address"];
    }

    /**
     * @return $this
     */
    public function update() : self
    {
        $balances = $this->fetchBalances();
        $transactions = $this->fetchTransactions($this->account->fetched_at, now());
        $assetId = $this->saveBalances($balances);
        $this->saveTransactions($transactions);
        $this->account->update(['fetched_at' => now()]);
        return $this;
    }

    /**
     * @return $this
     */
    protected function connect() : self
    {
        $this->api = new CryptoAPI();
        $this->connected = true;
        return $this;
    }

    /**
     * @return App\Blockchains\CryptoAPI
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return bool
     */
    public function isConnected() : bool
    {
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
     * @return string
     */
    public function getBlockchain() : string {
        $blockchain = '';
        switch($this->account->cryptoSource->id)
        {
            case CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM :
                $blockchain = 'ethereum';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN :
                $blockchain = 'litecoin';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_BITCOIN :
                $blockchain = 'bitcoin';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_BITCOINCASH :
                $blockchain = 'bitcoin-cash';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_DASH :
                $blockchain = 'dash';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_DOGE :
                $blockchain = 'dogecoin';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUMCLASSIC :
                $blockchain = 'ethereum-classic';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_ZCASH :
                $blockchain = 'zcash';
                break;
            default: break;
        }
        return $blockchain;
    }

    /**
     * @return array
     */
    public function fetchBalances() : array
    {
        $balances;
        $credentials = $this->getCredentials();
        $blockchain = $this->getBlockchain();
        $network = 'mainnet';
        $detail = $this->api->get_details($credentials['address'], $blockchain, $network, 'balances');
        $balances = [
            'amount' => $detail['data']['item']['confirmed_balance']['amount'],
            'unit' => $detail['data']['item']['confirmed_balance']['unit']
        ];
        return $balances;
    }

    /**
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     * @return array
     */
    public function fetchTransactions(Carbon $from = null, Carbon $to = null): array
    {
        $transactions = [];
        $fromTimestamp = 0;
        $toTimestamp = now()->timestamp;
        $context = 'not set';
        $blockchain = $this->getBlockchain();
        $network = 'mainnet';
        $limit = 50;
        $offset = 0;
        $total = 0;
        if ($from)
        {
            $fromTimestamp = $from->timestamp;
        }
        if ($to)
        {
            $toTimestamp = $to->timestamp;
        }
        $credentials = $this->getCredentials();

        do {
            $response = $this->api->get_transactionsByTime($credentials['address'], $limit, $offset, $blockchain, $network, $fromTimestamp, $toTimestamp, $context);
            foreach ($response->data->items as $transaction)
            {
                $transactions[] = $transaction;
            }
            $total = $response->data->total;
            $offset += $limit;
        } while ($offset <= $total);

        return $transactions;
    }

    /**
     * @param array $balance
     * @return bool
     */
    public function saveBalances($balance) : bool
    {
        $assets = $this->account->cryptoAssets();
        $currencyId = CryptoCurrency::findByShortName($balance['unit'])->id;
        $create = true;
        foreach($assets->get() as $asset)
        {
            if ($asset->crypto_currency_id === $currencyId)
            {
                // assets.bal
                $asset->update(['balance' => $balance['amount']]);
                $create = false;
            }
        }
        if ($create) {
            $asset = new CryptoAsset();
            $asset->balance = $balance['amount'];
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
            $currencyId = CryptoCurrency::findByShortName($transaction->fee->unit)->id;
            $costCurrencyId = $currencyId;
            $priceCurrencyId = $currencyId;
            $feeCurrencyId = $currencyId;
            $credentials = $this->getCredentials();
            $tradeType = 'N';
            $executed_at = new \DateTime();
            $executed_at->setTimestamp($transaction->timestamp);
            // var_dump($executed_at);
            // var_dump($transaction->timestamp);
            $trans = new CryptoTransaction();

            foreach($transaction->senders as $sender)
            {
                if ($credentials['address'] == $sender->address)
                {
                    $tradeType = 'S';
                    $trans->from_addr = $sender->address;
                    if (count($transaction->recipients) == 1)
                    {
                        $trans->to_addr = $transaction->recipients[0]->address;
                    }
                    $trans->amount = $sender->amount;
                    $trans->cost = $sender->amount;
                    break;
                }
            }
            foreach($transaction->recipients as $recipient)
            {
                if ($credentials['address'] == $recipient->address)
                {
                    $tradeType = 'B';
                    $trans->to_addr = $recipient->address;
                    if (count($transaction->senders) == 1)
                    {
                        $trans->from_addr = $transaction->senders[0]->address;
                    }
                    $trans->amount = $recipient->amount;
                    $trans->cost = $recipient->amount;
                    break;
                };
            }
            // var_dump($currencyId);
            $trans->crypto_account_id = $this->account->id;
            $trans->currency_id = $currencyId;
            $trans->cost_currency_id = $costCurrencyId;
            $trans->price_currency_id = $priceCurrencyId;
            $trans->fee_currency_id = $feeCurrencyId;
            $trans->trade_type = $tradeType;
            $trans->price = 1;
            $trans->fee = $transaction->fee->amount;
            $trans->raw_data = json_encode($transaction);
            $trans->executed_at = $executed_at;
            $trans->save();
        }
        return true;
    }
}
