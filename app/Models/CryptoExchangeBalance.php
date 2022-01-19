<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property CryptoExchangeAccount $cryptoExchangeAccount
 * @property CryptoCurrency $cryptoCurrency
 */
class CryptoExchangeBalance extends Model
{
    protected $guarded = [];


    /**
     * @return BelongsTo
     */
    public function cryptoExchangeAccount(): BelongsTo
    {
        return $this->belongsTo(CryptoExchangeAccount::class);
    }


    /**
     * @return BelongsTo
     */
    public function cryptoCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class);
    }


    public function convertTo(string $currency = "USD")
    {
        return $this->cryptoCurrency->convertTo($this->balance, $currency);
    }
}
