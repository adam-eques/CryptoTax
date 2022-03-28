<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property CryptoAccount $cryptoAccount
 * @property CryptoCurrency $cryptoCurrency
 * @property \Illuminate\Database\Eloquent\Collection<CryptoTransaction> $cryptoTransactions
 */
class CryptoAsset extends Model
{

    public function cryptoAccount(): BelongsTo
    {
        return $this->belongsTo(CryptoAccount::class);
    }


    public function cryptoCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class);
    }


    public function cryptoTransactions(): HasMany
    {
        return $this->hasMany(CryptoTransaction::class);
    }


    public function convertTo(string $currency = "USD"): float|null
    {
        return $this->cryptoCurrency?->convertTo($this->balance, $currency);
    }


    public static function findByCurrency_Account(int $accountId, int $currencyId)
    {
        return static::query()
            ->where("crypto_account_id", $accountId)
            ->where("crypto_currency_id", $currencyId)
            ->first();
    }
}
