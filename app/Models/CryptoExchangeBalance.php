<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}