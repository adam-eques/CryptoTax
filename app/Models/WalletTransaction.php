<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Illuminate\Support\Collection<WalletAsset> $walletAssets
 */
class WalletTransaction extends Model
{
    const UPDATED_AT = null;

    protected $guarded = [];


    public function walletAsset(): BelongsTo
    {
        return $this->belongsTo(WalletAsset::class);
    }
}
