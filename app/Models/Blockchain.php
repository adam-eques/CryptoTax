<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \Illuminate\Support\Collection<BlockchainAsset> $blockchainAssets
 * @property \Illuminate\Support\Collection<User> $users
 */
class Blockchain extends Model
{
    protected $casts = [
        'fetched_at' => 'datetime',
        'fetching_scheduled_at' => 'datetime',
    ];


    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $item) {
            $item->blockchainAssets()->delete();
        });
    }


    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function blockchainAssets(): HasMany
    {
        return $this->hasMany(BlockchainAsset::class);
    }


    public function getName(): string
    {
        return $this->address;
    }
}
