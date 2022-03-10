<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property CryptoAsset $cryptoAsset
 * @property CryptoAccount $cryptoAccount
 * @property CryptoCurrency $feeCurrency
 * @property CryptoCurrency $priceCurrency
 */
class CryptoTransaction extends Model
{
    public function cryptoAsset(): BelongsTo
    {
        return $this->belongsTo(CryptoAsset::class);
    }


    public function cryptoAccount(): BelongsTo
    {
        return $this->belongsTo(CryptoAccount::class);
    }


    public function feeCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'fee_currency_id');
    }


    public function priceCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class, 'price_currency_id');
    }
}
