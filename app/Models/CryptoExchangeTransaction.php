<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CryptoExchangeTransaction extends Model
{
    protected $casts = [
        "data" => "json"
    ];

    /**
     * @return BelongsTo
     */
    public function exchangeAccount(): BelongsTo
    {
        return $this->belongsTo(CryptoExchangeAccount::class);
    }
}
