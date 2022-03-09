<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property CryptoAsset $cryptoAsset
 * @property CryptoCurrency $feeCurrency
 */
class CryptoTransaction extends Model
{
    public function cryptoAsset(): BelongsTo
    {
        return $this->belongsTo(CryptoAsset::class);
    }


    public function feeCurrency(): BelongsTo
    {
        return $this->belongsTo(CryptoCurrency::class);
    }
}
