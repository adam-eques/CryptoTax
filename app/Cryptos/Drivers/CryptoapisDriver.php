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

    public static function make(CryptoAccount $account): ApiDriverInterface
    {
        $obj = new static();
        $obj->account = $account;
        $obj->connect();

        return $obj;
    }


    public function getRequiredCredentials(): array
    {
        return ["address"];
    }


    public function updateTransactions(): ApiDriverInterface
    {
        // TODO: Implement updateTransactions() method.
    }

    protected function connect() : self {
        $this->api = new CryptoAPI();
        return $this;
    }

    public function getApi()
    {
        return $this->api;
    }

    protected function getCredentials() : array
    {
        return $this->account->credentials ?: [];
    }

    public function fetchBalances() {
        $balances;
        $credentials = $this->getCredentials();
        $blockchain = '';
        $network = 'mainnet';
        // var_dump($credentials);
        switch($this->account->cryptoSource->id) {
            case CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM :
                $blockchain = 'ethereum';
                $network = 'mainnet';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN :
                $blockchain = 'litecoin';
                $network = 'mainnet';
                break;
            default: break;
        }
        $detail = $this->api->get_details($credentials['address'], $blockchain, $network, 'balances');
        var_dump($detail['data']);
        $balances = [
            'amount' => $detail['data']['item']['confirmed_balance']['amount'],
            'unit' => $detail['data']['item']['confirmed_balance']['unit']
        ];
        return $balances;
    }

    public function fetchTransactions(Carbon $from = null, Carbon $to = null): array {
        $transactions = [];
        $fromTimestamp = 0;
        $toTimestamp = now()->timestamp;
        $context = 'not set';
        $blockchain = '';
        $network = 'mainnet';
        $limit = 50;
        $offset = 0;
        $total = 0;
        if ($from) $fromTimestamp = $from->timestamp;
        if ($to) $toTimestamp = $to->timestamp;
        $credentials = $this->getCredentials();
        switch($this->account->cryptoSource->id) {
            case CryptoSource::SOURCE_BLOCKCHAIN_ETHEREUM :
                $context = 'ethereum transactions';
                $blockchain = 'ethereum';
                $network = 'mainnet';
                break;
            case CryptoSource::SOURCE_BLOCKCHAIN_LITECOIN :
                $context = 'litecoin transactions';
                $blockchain = 'litecoin';
                $network = 'mainnet';
                break;
            default: break;
        }

        do {
            $response = $this->api->get_transactionsByTime($credentials['address'], $limit, $offset, $blockchain, $network, $fromTimestamp, $toTimestamp, $context);
            foreach ($response->data->items as $transaction) {
                $transactions[] = $transaction;
            }
            $total = $response->data->total;
            $offset += $limit;
        } while ($offset <= $total);

        return $transactions;
    }

    public function saveBalances($balance) {
        $this->account->update(['fetched_at' => now()]);
        $assets = $this->account->cryptoAssets();
        $currencyId = CryptoCurrency::findByShortName($balance['unit'])->id;
        $create = true;
        $cryptoAssetId = 0;
        foreach($assets->get() as $asset) {
            if ($asset->crypto_currency_id === $currencyId) {
                // assets.bal
                $asset->update(['balance' => $balance['amount']]);
                $cryptoAssetId = $asset->id;
                $create = false;
            }
        }
        if ($create) {
            $asset = new CryptoAsset();
            $asset->balance = $balance['amount'];
            $asset->crypto_account_id = $this->account->id;
            $asset->crypto_currency_id = $currencyId;
            $asset->save();
            $cryptoAssetId = $asset->id;
        }
        var_dump($cryptoAssetId);
        return $cryptoAssetId;
    }

    public function saveTransactions($transactions, $cryptoAssetId) {
        // var_dump($transactions);
        foreach($transactions as $transaction) {
            $currencyId = CryptoCurrency::findByShortName($transaction->fee->unit)->id;
            $feeCurrencyId = CryptoCurrency::findByShortName($transaction->fee->unit)->id;
            $credentials = $this->getCredentials();
            $tradeType = 'N';
            $executed_at = new \DateTime();
            $executed_at->setTimestamp($transaction->timestamp);

            foreach($transaction->senders as $sender) {
                if ($credentials['address'] == $sender->address) $tradeType = 'S';
            }
            foreach($transaction->recipients as $recipient) {
                if ($credentials['address'] == $recipient->address) $tradeType = 'B';
            }
            // var_dump($currencyId);
            $trans = new CryptoTransaction();
            $trans->crypto_account_id = $cryptoAssetId;
            $trans->currency_id = $currencyId;
            $trans->price_currency_id = NULL;
            $trans->fee_currency_id = $feeCurrencyId;
            $trans->trade_type = $tradeType;
            $trans->from_addr = $transaction->senders[0]->address;
            $trans->to_addr = $transaction->recipients[0]->address;
            $trans->amount = $transaction->recipients[0]->amount;
            $trans->price = NULL;
            $trans->fee = $transaction->fee->amount;
            $trans->raw_data = json_encode($transaction);
            $trans->executed_at = $executed_at;
            $trans->save();
        }
    }

    public function update() {
        $balances = $this->fetchBalances();
        $transactions = $this->fetchTransactions($this->account->fetched_at, now());
        $assetId = $this->saveBalances($balances);
        $this->saveTransactions($transactions, $assetId);
    }
}
