<?php

namespace App\Cryptos\Drivers;

use App\Models\CryptoAccount;
use App\Models\CryptoSource;
use App\Models\CryptoAsset;
use App\Models\CryptoCurrency;
use App\Models\CryptoTransaction;
use App\Blockchains\CCXTAPI;
use Carbon\Carbon;

class CcxtDriver implements ApiDriverInterface
{
    protected CryptoAccount $account;
    protected $api;

    public static function make(CryptoAccount $account): self
    {
        $obj = new static();
        $obj->account = $account;
        $obj->connect();

        return $obj;
    }

    public function getRequiredCredentials(): array
    {
        return ["apiKey", "secret"];
    }

    /**
     * @return $this
     */
    protected function connect(): self {

    }


    // /**
    //  * @return bool
    //  */
    // public function checkRequiredCredentials(): bool
    // {
    //     return $this->api->check_required_credentials();
    // }

    /**
     * @return $this
     */
    public function updateTransactions(): self
    {
        // Get transaction data
        $since = $this->account->fetched_at ?: Carbon::create(2010, 1, 1);
        $data = $this->fetchTransactions(null, $since);

        // Balances
        $balances = $this->fetchBalances();

        // Save it
        $this->saveTransactions($data, now(), $balances["total"]);

        return $this;
    }


    // /**
    //  * @return \ccxt\Exchange
    //  */
    // public function getApi()
    // {
    //     return $this->api;
    // }


    // /**
    //  * @param array $data
    //  * @param \Carbon\Carbon $timestamp
    //  * @param array|null $balances
    //  * @return $this
    //  */
    // protected function saveTransactions(array $data, Carbon $timestamp, ?array $balances = null): self
    // {
    //     $account = $this->account;
    //     $data = collect($data)->map(function ($item) {
    //         return $this->mapFetchedTransactions($item);
    //     })->toArray();

    //     \DB::transaction(function () use ($account, $data, $balances, $timestamp) {
    //         // Insert data
    //         if ($data) {
    //             CryptoTransaction::insert($data);
    //         }

    //         // Update fetched_at
    //         $account->fetched_at = $timestamp;
    //         $account->fetching_scheduled_at = null;
    //         $account->save();

    //         // Save balances
    //         $this->saveBalances($balances);
    //     });

    //     return $this;
    // }


    // protected function saveBalances(?array $balances = null)
    // {
    //     if (! is_null($balances)) {
    //         $account = $this->account;

    //         $account->cryptoAssets()->delete();
    //         foreach ($balances as $key => $val) {
    //             if ($val && $val > 0) {
    //                 $currency = CryptoCurrency::findByShortName($key);
    //                 if ($currency) {
    //                     $currency = $currency->id;
    //                 } else {
    //                     $currency = 0;
    //                     logger("Missing crypto currency ".$key);
    //                 }

    //                 CryptoAsset::make([
    //                     "crypto_account_id" => $account->id,
    //                     "crypto_currency_id" => $currency,
    //                     "balance" => $val,
    //                 ])->save();
    //             }
    //         }
    //     }
    // }


    // /**
    //  * @param array $data
    //  * @return array
    //  */
    // protected function mapFetchedTransactions(array $data)
    // {
    //     // Trade type
    //     if ($data["side"] == "sell") {
    //         $trade_type = "S";
    //     } else {
    //         if ($data["side"] == "buy") {
    //             $trade_type = "B";
    //         } else {
    //             $trade_type = "";
    //         }
    //     }

    //     // Currencies
    //     $currencies = explode("/", $data["symbol"]);
    //     $assetCurrency = CryptoCurrency::findByShortName($currencies[0]);
    //     $priceCurrency = CryptoCurrency::findByShortName($currencies[1]);
    //     $feeCurrency = CryptoCurrency::findByShortName(\Arr::get($data, "fee.currency"));

    //     // Return data
    //     return [
    //         "crypto_account_id" => $this->account->id,
    //         "currency_id" => optional($assetCurrency)->id,
    //         "price_currency_id" => optional($priceCurrency)->id,
    //         "fee_currency_id" => optional($feeCurrency)->id,
    //         "trade_type" => $trade_type,
    //         "from_addr" => null,
    //         "to_addr" => null,
    //         "amount" => $data["amount"],
    //         "price" => $data["price"],
    //         "fee" => \Arr::get($data, "fee.cost"),
    //         "raw_data" => json_encode($data),
    //         "executed_at" => substr($data["datetime"], 0, -1),
    //     ];
    // }


    // /**
    //  * See https://docs.ccxt.com/en/latest/manual.html#balance-structure
    //  *
    //  * @return mixed
    //  */
    // public function fetchBalances()
    // {
    //     return $this->api->fetchBalance([
    //         "type" => "main",
    //     ]);
    // }


    // /**
    //  * @return array
    //  */
    // protected function getCredentials(): array
    // {
    //     return $this->account->credentials ?: [];
    // }


    // /**
    //  * @param string|null $symbol
    //  * @param Carbon|null $since
    //  * @return array
    //  */
    // public function fetchTransactions(?string $symbol = null, ?Carbon $since = null): array
    // {
    //     return $this->api->fetch_my_trades(
    //         $symbol,
    //         $since ? $since->timestamp * 1000 : null
    //     );
    // }
}
