<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property CryptoCurrency $cryptoCurrency
 */
class CryptoCurrencyConversion extends Model
{
    public const UPDATED_AT = null;


    public function cryptoCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class);
    }


    public static function getFiatCurrencies(): array
    {
        return [
            "usd", "eur", "chf", "aud", "cad", "jpy", "cny", "gbp", "btc"
        ];
    }
}
