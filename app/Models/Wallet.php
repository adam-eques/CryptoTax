<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \Illuminate\Support\Collection<WalletAsset> $walletAssets
 * @property \Illuminate\Support\Collection<User> $users
 */
class Wallet extends Model
{
    protected $casts = [
        'fetched_at' => 'datetime',
        'fetching_scheduled_at' => 'datetime',
    ];


    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $item) {
            $item->walletAssets()->delete();
        });
    }


    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function walletAssets(): HasMany
    {
        return $this->hasMany(WalletAsset::class);
    }


    public function getName(): string
    {
        return $this->address;
    }
}
