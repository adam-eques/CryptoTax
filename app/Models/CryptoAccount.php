<?php

namespace App\Models;

use App\Cryptos\Drivers\ApiDriverInterface;
use App\Models\Traits\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \App\Models\CryptoSource $cryptoSource
 * @property \Illuminate\Database\Eloquent\Collection<CryptoAsset> $cryptoAssets
 * @property \Illuminate\Database\Eloquent\Collection<CryptoTransaction> $cryptoTransactions
 */
class CryptoAccount extends Model
{
    use BelongsToUserTrait;

    public ?ApiDriverInterface $api = null;
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


    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $item) {
            $item->cryptoAssets()->cascadeDelete();
        });
    }


    public function cryptoSource(): BelongsTo
    {
        return $this->belongsTo(CryptoSource::class);
    }


    public function cryptoAssets(): HasMany
    {
        return $this->hasMany(CryptoAsset::class);
    }


    public function cryptoTransactions(): HasMany
    {
        return $this->hasMany(CryptoTransaction::class);
    }


    public function getName(): string
    {
        return $this->cryptoSource ? $this->cryptoSource->getName() : "";
    }


    public function getBalanceSum(string $currency = "USD"): float
    {
        $sum = 0;

        $this->cryptoAssets->each(function (CryptoAsset $asset) use (&$sum, $currency) {
            if ($asset->balance) {
                $sum += $asset->convertTo($currency);
            }
        });

        return $sum;
    }


    public function hasAllCredentials(): bool
    {
        $api = $this->getApi();
        $requiredCredentials = $api->getRequiredCredentials();

        foreach ($requiredCredentials as $key) {
            if (empty($this->credentials[$key])) {
                return false;
            }
        }

        return true;
    }


    public function getApi(bool $forceReload = false): ApiDriverInterface
    {
        if (! $this->api || $forceReload) {
            $driverClass = $this->cryptoSource->driver;
            $this->api = $driverClass::make($this);
        }

        return $this->api;
    }
}
