<?php

namespace App\Models;

use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \App\Models\CryptoSource $cryptoSource
 * @property \Illuminate\Database\Eloquent\Collection<CryptoAsset> $cryptoTransactions
 */
class CryptoAccount extends Model
{
    use BelongsToUserTrait;


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'credentials' => 'json',
        'fetched_at' => 'datetime',
        'fetching_scheduled_at' => 'datetime',
    ];


    public function cryptoSource(): BelongsTo
    {
        return $this->belongsTo(CryptoSource::class);
    }


    public function cryptoTransactions(): HasMany
    {
        return $this->hasMany(CryptoAsset::class);
    }
}
