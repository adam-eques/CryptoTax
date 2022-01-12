<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Illuminate\Support\Collection<BlockchainAsset> $blockchainAssets
 */
class BlockchainTransaction extends Model
{
    const UPDATED_AT = null;

    protected $guarded = [];


    public function blockchainAssets(): BelongsTo
    {
        return $this->belongsTo(BlockchainAsset::class);
    }
}
